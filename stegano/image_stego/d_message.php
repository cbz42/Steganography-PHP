<?php
	include('../header/index.php');
	include('server2.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="../image_stego/style/style.css" />
	<script type="text/javascript">
	document.title = "Decryption message ";
</script>
</head>
<body>
	<div style="height: 500px;background-image: url('../image/images(17).jpg');background-repeat: no-repeat;background-size: 100% 100%">
		<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(isset($_SESSION['username']) )
		{

	?>
	<div id="center1" >
	<div >
		<?php
			include('errors.php');
			if (count($errors) == 0) {
				echo '<h1>message is:-</h1><div style = "width : 100px"> <h4>'.$content.'</h4></div>';
			}
			
		?>
		<a id="hell" href="decrypt.php" >go back </a>
	</div> 
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