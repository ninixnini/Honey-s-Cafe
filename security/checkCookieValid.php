<?php
$username = encryptString($_COOKIE["userLoggedIn"], "e");
$username_DEC = $_COOKIE["userLoggedIn"];
$fingerprint = $_COOKIE["usercookieid"];

// Find user in database
$user_db = mysqli_query($database, "SELECT id, role FROM cafeusers WHERE name='$username';");

if (mysqli_num_rows($user_db) == 0) {
	// User was not found
	setcookie("userLoggedIn", "", time()-3600);
	setcookie("usercookieid", "", time()-3600);
	header("location: ./login.php");
} else {
	// User was found
	$user_row = mysqli_fetch_assoc($user_db);
	$valid_fingerprint = $user_row["id"];

	if ($user_row["role"] == "admin") {
		$isAdmin = true;
	} elseif($user_row["role"] == "banned") {
		$banned = true;
	}

	$ROLE = $user_row["role"];

	// Real fingerprint
	$real_fingerprint = hash("sha512", $valid_fingerprint . "-CAFE-" . $username_DEC);
	
	if ($fingerprint != $real_fingerprint) {
		// Cookie is not valid
		setcookie("userLoggedIn", "", time()-3600);
		setcookie("usercookieid", "", time()-3600);
		header("location: ./login.php");
	} else {
		$cookieValid = true;
	}
}?>