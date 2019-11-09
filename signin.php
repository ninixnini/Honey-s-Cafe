<?php
require "./SETUP.php";
require "./security/encryption.php";

$email = $_POST["email"];
$password = $_POST["password"];

// TURN EMAIL TO LOWERCASE
$email = strtolower($email);

$encrypted_email = encryptString($email, "e");

$find_user = mysqli_query($database, "SELECT * FROM cafeusers WHERE email='" . $encrypted_email . "';");

if (mysqli_num_rows($find_user) != 0) {
	while($row = mysqli_fetch_assoc($find_user)) {

		$user_name = $row["name"];
		$pass_word = $row["password"];
	  	$e_mail = $row["email"];
	  	$userid = $row["id"];
		$salt = $row["salt"];

		// DECRYPT ALL DATA
		$user_name = encryptString($user_name, "d");
		$pass_word = encryptString($pass_word, "d");
		$e_mail = encryptString($e_mail, "d");
		$userid = encryptString($userid, "d");
		$salt = encryptString($salt, "d");

		// HASH THE PASSWORD TO START TESTS
		$hashed_password = hash('sha256', $password . $salt);

		// NOW CHECK THE LOGIN
		if($email == $e_mail && $hashed_password == $pass_word) {

			$find_FRESH_QUERY_user = mysqli_query($database, "SELECT * FROM cafeusers WHERE email='" . $encrypted_email . "';");

			$FRESH_ROW = mysqli_fetch_assoc($find_FRESH_QUERY_user);

			$database_userid = $FRESH_ROW["id"];

			$cookie_completeHash = hash("sha512", $database_userid . "-CAFE-" . $user_name);

			// CREATE THE COOKIES
			setcookie("userLoggedIn", $user_name, time() + (86400 * 30) * 1, "/");
			setcookie("usercookieid", $cookie_completeHash, time() + (86400 * 30) * 1, "/");
			// REDIRECT THE USER
			header("location: ./index.php");
		} else {
			// OOPS! WRONG PASSWORD!!
			header("location: ./login.php?error=incorrect-password-username");
		}
	}
} else {
	header("location: ./login.php?error=user-not-found");
}
?>