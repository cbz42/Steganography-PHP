<?php
 include('server.php');
 include('../header/index.php');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<script type="text/javascript">
	document.title = "login";
</script>
<link rel="stylesheet" type="text/css" href="../user/style/style.css" />
</head>
<body>
	<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(!isset($_SESSION['username']))
		{

	?>
	<div style="height: 500px;background-image: url('../image/images(11).jpg');background-repeat: no-repeat;background-size: 100% 100%">
		<div id="center">
		<h2>Member Login</h2>
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

			<label>Username</label>
			<input type="text" name="username" >
			<br>
			<label>Password</label>
			<input type="password" name="password">
			<br>
			<button id="hell" type="submit" class="btn" name="login_user">Login</button>
		<p>
			<a id="hell" href="forget.php">Forget password</a>
		</p>
		<p>
			Not yet a member? <a id="hell" href="register.php">Sign up</a>
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