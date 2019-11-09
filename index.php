<?php
require "./SETUP.php";
require "./security/encryption.php";
require "./security/checkCookieValid.php";

require "./database/header.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Café au lait">
	<meta name="author" content="Café au lait">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo TITLE; ?> - Café au lait</title>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./css/index.css" />
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-2.1.1.js" integrity="sha256-FA/0OOqu3gRvHOuidXnRbcmAWVcJORhz+pv3TX2+U6w=" crossorigin="anonymous"></script>
</head>
<body>

	<?php if($banned): ?>
		<h1 style="text-align: center;margin-top: 200px;color:white;">You Were Kicked From <?php echo TITLE; ?>!</h1>
	<?php else: ?>

		<div class="side-bar">
			<h1 class="title"><?php echo TITLE; ?></h1>

			<div class="nav d-flex justify-content-center">
				<?php if($_GET["sort"] == "2") : ?>
					<a href="./?sort=1"><i class="icon fas fa-users"></i>
				<?php else: ?>
					<a href="./?sort=2"><i class="icon fas fa-users"></i>
				<?php endif; ?>
				<a href="./?logout"><i title="Logout" class="icon fas fa-sign-out-alt"></i></a>
			</div>

			<hr/>

			<div class="users-list">
				<?php require "./database/getAccounts.php"; ?>
			</div>

		</div>

		<div class="main-chat">

			<div id="public-chats" class="public-chats">
				<?php require "./getChats.php"; ?>
			</div>

			<div class="post-area">
					<form class="input-group mb-3" method="POST" action="index.php">
						<input name="postInput" type="text" class="form-control" placeholder="What are you thinking about?" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button name="postButton" type="submit" class="btn btn-dark">Post</button>
						</div>
					</form>
				</div>

		</div>

		<script type="text/javascript" src="./js/home.js"></script>
		<script type="text/javascript">
			setInterval(function() {
				$("#public-chats").load("getChats.php");
			}, 1500);
		</script>
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<?php
		$errorCode = $_GET["error"];

		if ($errorCode == "too-short") {
			echo "<script type='text/javascript'>alert('Sorry, that post was too short!');</script>";
		}
		?>

	<?php endif ?>
</body>
</html>