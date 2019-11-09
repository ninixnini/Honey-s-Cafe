<?php

// Fetch all accounts and list them
if ($_GET["sort"] == "2") {
	$fetchUserQuery = mysqli_query($database, "SELECT name, role FROM cafeusers ORDER BY name DESC");
} else {
	$fetchUserQuery = mysqli_query($database, "SELECT name, role FROM cafeusers ORDER BY name ASC");
}

while($fetchUserRow = mysqli_fetch_assoc($fetchUserQuery)) {
	$username = encryptString($fetchUserRow["name"], "d");
	$role = $fetchUserRow["role"];
	
	$you = "";

	if ($username == $_COOKIE["userLoggedIn"]) {
		$you = "(You)";
	}

	if ($role == "admin") {
	echo "<div class=\"user\"><img src=\"http://identicon-1132.appspot.com/" . $username . "?s=7\"><span class=\"admin\">" . $username . "</span> <span class=\"small\">$you</span></div>";
	} else {
		echo "<div class=\"user\"><img src=\"http://identicon-1132.appspot.com/" . $username . "?s=7\">" . $username . " <span class=\"small\">$you</span></div>";
	}
}


?>