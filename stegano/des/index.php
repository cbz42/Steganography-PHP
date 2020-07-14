<?php
 include('../header/index.php');
 include('server.php');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<script type="text/javascript">
	document.title = "Hide message ";
</script>
<link rel="stylesheet" type="text/css" href="../image_stego/style/style.css" />
</head>
<body>
</body>
	<div style="height: 600px;background-image: url('../image/images(4).jpg');background-repeat: no-repeat;background-size: 100% 100%;color: white;"> 
	<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(isset($_SESSION['username']))
		{

	?>
	<div id="center">
		<h2>Encrypt or Decrypt message</h2> 
	<?php
			include('../image_stego/errors.php');
			//echo $smessage;
		?>
	<form method="post" action="index.php" >
	
		<div>
			<h3>Password:</h3>
			<input id="input1" type="password" name="skey" placeholder="enter the key" maxlength="8">
			<!--p>Enter 8 char key for des and 12 char key for lsb.</p-->
		</div>
		<div>
			<h3>Enter text:</h3>
			<textarea name="smessage" style="margin: 0px; height: 125px; width: 227px;" placeholder="enter the messages"  ><?php echo  $smessage; ?></textarea>
		</div>
		<br>
		<br>
		<input id ="hell"type="submit" name="encbtn" value="Encrypt" >
		<input id ="hell"type="submit" name="decbtn" value="Decrypt" >
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