<?php
require "./SETUP.php";
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
	<link rel="stylesheet" type="text/css" href="./css/login.css" />
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<?php if(!isset($_GET["login"])) : ?>

		<div class="create-account">

			<div class="team-image">
				<img src=<?php echo "'" . TEAM_IMAGE_URL . "'"; ?> />
			</div>

			<h1>You've Been Invited To Join <?php echo TITLE; ?> Café</h1>

			<form style="margin-top:20px;margin-bottom: 10px;" method="POST" action="createaccount.php">
			  <div class="form-group">
			    <input type="username" name="username" class="form-control" placeholder="Username">
			    <input type="email" name="email" class="form-control" placeholder="Email">
			    <input type="password" name="password" class="form-control" placeholder="Password">
			  </div>
			  <!-- <button type="submit" class="btn btn-primary">Join</button> -->
			  <button style="background-color:#68263b;border-color:#582032;width: 100%;" type="submit" class="btn btn-dark">Join</button>
			</form>
			<a style="color: white;" href="login.php?login">Already Have An Account?</a>
		</div>


	<?php else : ?>

		<div class="create-account">

			<div class="team-image">
				<img src=<?php echo "'" . TEAM_IMAGE_URL . "'"; ?> />
			</div>

			<h1>Sign Back Into <?php echo TITLE; ?> Café</h1>

			<form style="margin-top:20px;margin-bottom: 10px;" method="POST" action="signin.php">
			  <div class="form-group">
			    <input type="email" name="email" class="form-control" placeholder="Email">
			    <input type="password" name="password" class="form-control" placeholder="Password">
			  </div>
			  <!-- <button type="submit" class="btn btn-primary">Join</button> -->
			  <button style="background-color:#68263b;border-color:#582032;width: 100%;" type="submit" class="btn btn-dark">Join</button>
			</form>
			<a style="color: white;" href="login.php">Don't Have An Account?</a>
		</div>

		<?php
		if (isset($_GET["success"])) {
			echo "<script type='text/javascript'>alert('Success! Please login to your new account.');</script>";
		}
		?>

	<?php endif; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<?php
	$errorCode = $_GET["error"];

	if ($errorCode == "too-short") {
		echo "<script type='text/javascript'>alert('Sorry, that post was too short!');</script>";
	} elseif ($errorCode == "incorrect-password-username") {
		echo "<script type='text/javascript'>alert('Incorrect Username Or Password!');</script>";
	} elseif ($errorCode == "user-not-found") {
		echo "<script type='text/javascript'>alert('Oops! It looks like that user has not registered yet..');</script>";
	}


	?>
</body>
</html>