<?php
 include('server.php');
 include('../header/index.php');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>forget password</title>
	<link rel="stylesheet" type="text/css" href="../user/style/style.css" />
</head>
<script type="text/javascript">
	document.title = "forget password";
</script>
<body>
	<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(!isset($_SESSION['username']))
		{
	?>
	<div style="height: 500px;background-image: url('../image/images(10).jpg');background-repeat: no-repeat;background-size: 100% 100%">
	<div id="center">
		<h2>forget password</h2>
	<form method="post" action="forget.php">

		<?php include('errors.php'); ?>

			<label>Enter Email</label>
			<input type="email" name="email" >
			<br>
			<button id="hell" type="submit" class="btn" name="forget">submit</button>
			
		<p>
			Login now <a id="hell" href="login.php">Login</a>
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