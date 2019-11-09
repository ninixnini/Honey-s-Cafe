<?php
// SIGNUP.PHP
require "./SETUP.php";
require "./security/encryption.php";

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$email = strtolower($email);
$password_verify = $_POST["password_verify"];
$date_joined = date("m/d/Y");

// THE USERNAME CAN'T HAVE SPACES IN IT BECAUSE
// IT WILL BREAK MY DATABASE
// $username = preg_replace("#[^0-9a-z]#i", "", $username);

// +------------+------+------+-----+---------+-------+
// | Field      | Type | Null | Key | Default | Extra |
// +------------+------+------+-----+---------+-------+
// | name       | text | YES  |     | NULL    |       |
// | email      | text | YES  |     | NULL    |       |
// | password   | text | YES  |     | NULL    |       |
// | ipAddress  | text | YES  |     | NULL    |       |
// | dateJoined | text | YES  |     | NULL    |       |
// | id         | text | YES  |     | NULL    |       |
// +------------+------+------+-----+---------+-------+


// GET IPADDRESS
$IMPORTANT_ipaddress = $_SERVER['REMOTE_ADDR'];

// GET LENGTH OF VARIABLES
$form_username_length = strlen($username);

// SALT ID
$salt = bin2hex(random_bytes(8));
$randomUserID = bin2hex(random_bytes(6));

// MAKE SURE USER DOESN'T EXIST YET
$encrypted_FORM_email = encryptString($email, "e");
$check_user_existing = mysqli_query($database, "SELECT * FROM cafeusers WHERE email='$encrypted_FORM_email';");
$check_user_existing_COUNT = mysqli_num_rows($check_user_existing);


if ($check_user_existing_COUNT == 0) {
	if ($form_username_length <= 40) {

		// FIND IF USERNAME IS ALREADY TAKEN
		$find_user = mysqli_query($database, 'SELECT * FROM cafeusers WHERE name="' . $username . '";');
		$find_username = mysqli_fetch_assoc($find_user);
	  	$taken_user_name = $find_username['name'];

	  	if ($username == $taken_user_name) {
	  		// USERNAME IS TAKEN
	  		header("location: ./?error=username_taken");
	  	} else {
	  		// USERNAME ISN'T TAKEN

	  		// // CREATE A TABLE FOR NEW USER
	  		// $create_USER_TABLE_sql = "CREATE TABLE USER_". $username . "(username TEXT, isFriend BOOLEAN);";
	  		// $create_USER_TABLE_sql_EXECUTE = mysqli_query($database, $create_USER_TABLE_sql);

	  		// CONTINUE
	  		$hashed_password = hash('sha256', $password . $salt);

	  		// ENCRYPT ALL DATA!!
	  		$encrypted_username = encryptString($username, "e");
	  		$encrypted_password = encryptString($hashed_password, "e");
	  		$encrypted_email = encryptString($email, "e");
	  		$encrypted_salt = encryptString($salt, "e");
	  		$encrypted_userid = encryptString($randomUserID, "e");
	  		$encrypted_ipaddr = encryptString($IMPORTANT_ipaddress, "e");

	  		// Generate user fingerprint/id
	  		$user_fingerprint = encryptString(hash("sha256", $username . $date_joined . $encrypted_ipaddr), "e");

	  		
			$query = "INSERT INTO cafeusers VALUES('$encrypted_username', '$encrypted_email', '$encrypted_password', '$encrypted_salt', '$encrypted_ipaddr', '$date_joined', '$user_fingerprint', 'member');";

		  	$sql = mysqli_query($database, $query);

		  	if (!$sql) {
		  		echo "<h1>Error creating user!</h1>";
		  	}

		  	// REDIRECT USER IF EVERYTHING FINSIHES
		  	header("location: ./login.php?login&success");
	  	}
	} else {
		// USERNAME IS TOO SHORT
		header("location: ./login.php?error=username_long");
	}
} else {
	header("location: ./login.php?error=email_taken");
}

?>