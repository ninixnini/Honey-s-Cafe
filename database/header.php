<?php

if (isset($_GET["logout"])) {
	setcookie("userLoggedIn", "", time()-3600);
	setcookie("usercookieid", "", time()-3600);
	header("location: ./login.php");
}
// NOTE: $isAdmin is declared in checkcookievalid.php

if (isset($_POST["postButton"]) && $cookieValid && !$banned) {
	$postInput = $_POST["postInput"];
	$username = $_COOKIE["userLoggedIn"];

	if(strlen($postInput) < 1) {
		// Length is too short
		header("location: ./index.php?error=too-short");
	} else {

		// Do admin stuff
		if (substr($postInput, 0, 5) == "/kick" && $isAdmin) {
			$kickingUser = encryptString(substr($postInput, 6), "e");
			$absoluteTime = time();
			$formattedTime = encryptString(date("h:i A") . "  " . date("m/d/Y"), "e");
			$kickQuery = mysqli_query($database, "UPDATE cafeusers SET role='banned' WHERE name='" . $kickingUser . "';") or die(mysqli_error($database));
			$deleteKickQuery = mysqli_query($database, "DELETE FROM publicchat WHERE name='" . $kickingUser . "';") or die(mysqli_error($database));

			if ($kickQuery && $deleteKickQuery) {
				// Kicking was successful, now display some funny stuff.
				$addData = mysqli_query($database, "INSERT INTO publicchat VALUES('" . encryptString($username, "e") . "', '" . encryptString("KICK=" . $kickingUser, "e") . "', '$absoluteTime', '$formattedTime', 'KICK', '');");

				if ($addData) {
					header("location: ./?error=unknown");
				}
			} else {
				header("location: ./?error=unknown");
			}
			
		
			
			echo "<h1 style='margin-left:280px'>UPDATE cafeusers SET role='banned' WHERE name='" . $kickingUser . "';</h1>";
			// header("location: ./");
		} elseif (substr($postInput, 0, 8) == "/promote" && $isAdmin) {
			// Admin is promoting user
			$absoluteTime = time();
			$formattedTime = encryptString(date("h:i A") . "  " . date("m/d/Y"), "e");

			$promotingUser = substr($postInput, 9);
			$promotion = mysqli_query($database, "UPDATE cafeusers SET role='admin' WHERE name='" . encryptString($promotingUser, "e") . "'") or die(mysqli_error($database));
			
			if ($promotion) {
				// Add message as well
				$addData = mysqli_query($database, "INSERT INTO publicchat VALUES('" . encryptString($username, "e") . "', '" . encryptString("PROMOTE=" . $promotingUser, "e") . "', '$absoluteTime', '$formattedTime', 'PROMOTE', '');");
				// Redirect user
				header("location: ./");
			} else {
				header("location: ./?error=unknown");
			}

		} else {
			// Not admin stuff... Awww...
			$name = encryptString($username, "e");
			$post = encryptString($postInput, "e");
			$absoluteTime = time();
			$formattedTime = encryptString(date("h:i A") . "  " . date("m/d/Y"), "e");
			$hash = encryptString($name . $post . $absoluteTime, "e");
			
			$addData = mysqli_query($database, "INSERT INTO publicchat VALUES('$name', '$post', '$absoluteTime', '$formattedTime', '$hash', '$ROLE');");

			if (!$addData) {
				header("location: ./?error=unknown");
			}

			header("location: ./");
		}
	}
}


?>