
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="../header/style/style.css" />
	</head>
	<body>
		<img src="../image/images(14).jpg" style="width: 100%;height: 100px;">
		<ul>
			<li style="color: white"><h3>ImageStego</h3></li>
			<?php
			if(!isset($_SESSION))
			{
				session_start();
			}
			if (isset($_GET['logout'])) {
				session_destroy();
				unset($_SESSION['username']);
				header("location: ../user/login.php");
			}
			if(isset($_SESSION['username']))
			{
				?>
				<li ><a href="../home/index.php">Home</a></li>
				<li ><a href="../image_stego/encrypt.php">Hide Message</a></li>
				<li ><a href="../image_stego/decrypt.php">Retrieve Message</a></li>
				<li ><a href="../aes/index.php">AES</a></li>
				<li ><a href="../des/index.php">DES</a></li>
				<li ><a href="../help/index.php">Help</a></li>

  				<li style="float:right" ><a href="?logout='1'">Logout</a></li>
  				<!--li style="float:right" >welecome <?php //echo $_SESSION['username'] ?></li-->
  			<?php
  			}
  			else
  			{
  			?>
  			<li><a href="../home/index.php">Home</a></li>
  			<li><a href="../about/index.php">About us</a></li>
  			<li ><a href="../help/index.php">Help</a></li>
  			<li style="float:right" ><a href="../user/login.php">Login</a></li>
  			<li style="float:right" ><a href="../user/register.php">Signup</a></li>
  			<?php
  				}
  			?>
		</ul>
