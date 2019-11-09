<?php

// Fetch all accounts and list them
if ($_GET["sort"] == "2") {
	$fetchUserQuery = mysqli_query($database, "SELECT name, role FROM cafeusers ORDER BY (role = 'admin') ASC, name ASC;");
} else {
	$fetchUserQuery = mysqli_query($database, "SELECT name, role FROM cafeusers ORDER BY (role = 'admin') DESC, name DESC;");
}

while($fetchUserRow = mysqli_fetch_assoc($fetchUserQuery)) {
	$username = encryptString($fetchUserRow["name"], "d");
	$role = $fetchUserRow["role"];
	
	$you = "";

	if ($username == $_COOKIE["userLoggedIn"]) {
		$you = "(You)";
	}

	if ($role == "admin") {
		if ($you == "(You)") {
			echo "<div class=\"user\"><img src=\"http://identicon-1132.appspot.com/" . $username . "?s=7\">" . $username . " <span style=\"color:#c5c5c5;\" class=\"small\">$you</span></div>";
		} else {
			echo "<div class=\"user\"><img src=\"http://identicon-1132.appspot.com/" . $username . "?s=7\">" . $username . " <span style=\"color:#c5c5c5;\" class=\"small\">(Admin)</span></div>";
		}
	} else {
		echo "<div class=\"user\"><img src=\"http://identicon-1132.appspot.com/" . $username . "?s=7\">" . $username . " <span class=\"small\">$you</span></div>";
	}
}


?>