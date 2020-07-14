<?php
 include('../header/index.php');
 // header("refresh: 3;");
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
		<h2>Hide Message</h2> 
	
	<form method="post" action="e_message.php" enctype="multipart/form-data">
		<div>
			<h3>method:</h3>
			<select name="stype" style="background-color: #f2f2f2;padding: 10px">
			<option  value="des" >hide with 8 letter password </option>
			<option value="aes"> hide with 16 letter password</option>
			<!--label>Des</label>
			<input type="radio" name="stype" value="des"-->
		</select>
		</div>
		<br>
		<div>
			<h3>Password:</h3>
			<input id="input1" type="password" name="skey" placeholder="enter the key" maxlength="16">
			<!--p>Enter 8 char key for des and 12 char key for lsb.</p-->
		</div>
		<div>
			<h3>Enter messages:</h3>
			<textarea name="smessage" style="margin: 0px; height: 125px; width: 227px;" placeholder="enter the messages" maxlength="100"></textarea>
		</div>
		<br>
		<div>
			<h3>Select image to hide message:</h3>
			<input type="file" name="upload" multiple accept=".jpg,.jpeg,.png">
		</div>
		<br>
		<input id ="hell"type="submit" name="encbtn" value="Hide" >
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