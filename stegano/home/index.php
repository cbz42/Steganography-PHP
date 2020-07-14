<?php
 include('../header/index.php');
// header("refresh: 3;");
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="../home/style/style.css" />
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script type="text/javascript">

	document.title = "home";
</script>
</head>
<body>
</body>

	<div style="height: 500px;background-image: url('../image/images(7).jpg');background-repeat: no-repeat;background-size: 100% 100%" > 
	<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(isset($_SESSION['username']))
		{

	?>	 
  <div id="button1"><a class="button" href = "../image_stego/decrypt.php">Retrieve message</a></div>


  <div id="button2"><a class="button" href = "../image_stego/encrypt.php">Hide message</a></div>

	<?php
		}
		else
		{
			?>
			 <div id="button1"><a class="button" href = "../user/login.php">Retrieve message</a></div>


  <div id="button2"><a class="button" href = "../user/login.php">Hide message</a></div>
			<?php
			
		}

	?>
</div>
	<?php
include('../footer/index.php');
?>
</body>
</html>