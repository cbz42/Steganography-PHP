<?php
 include('server.php');
 include('../header/index.php');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<script type="text/javascript">
	document.title = "Register";
</script>
<link rel="stylesheet" type="text/css" href="../user/style/style.css" />
</head>
<body>
</body>

	<div style="height: 500px;background-image: url('../image/images(13).jpg');background-repeat: no-repeat;background-size: 100% 100%"> 
	<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(!isset($_SESSION['username']))
		{

	?>
	<div id="center">
		<h2>Registeration form</h2>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
			<br>
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
			<br>
			<label>Password</label>
			<input type="password" name="password_1">
			<br>

			<label>Confirm password</label>
			<input type="password" name="password_2">

			<br>
			<button id="hell"type="submit" class="btn" name="reg_user">Register</button>

		<p>
			Already a member? <a id="hell" href="login.php">Login</a>
		</p>
	</form>
</div>
	<?php
		}
		else
		{
			?>
			<script type="text/javascript">
		var url = "http://"+location.hostname+":"+location.port+"/stegano/home/index.php";
		window.location = url;
	</script>
			<?php
			
		}

	?>
</div>
	<?php
include('../footer/index.php');
?>
</body>
</html>