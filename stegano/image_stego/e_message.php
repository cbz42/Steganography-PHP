<?php
	
	include('../header/index.php');
	include('server.php');
	
?><!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="../image_stego/style/style.css" />
	<script type="text/javascript">
	document.title = "Encryption message ";
</script>
</head>
<body>
	<div style="height: 500px;background-image: url('../image/images(16).jpg');background-repeat: no-repeat;background-size: 100% 100%">
		<?php
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(isset($_SESSION['username'])) //& count($errors) > 0
		{

	?>
	<div id="center" >
	<div >
		<?php
			include('errors.php');
		?>
	</div> 
	<?php
		if (count($errors) == 0) {

			echo '<h1>'.$emes.'</h1>';
	?>

	<form method="post" action="../download/index.php">

	<input  type="hidden" name="hello" value="<?php echo $content; ?>" >

	<input id="hell" type="submit" name="submit" value="download image">
</form>
<form method="post" action="../preview/index.php" target="_blank">

	<input  type="hidden" name="hello" value="<?php echo $content; ?>" >

	<input id="hell" type="submit" name="submit" value="preview">
</form>
<?php
	}

?>
<a id="hell" href="encrypt.php" >go back </a>
</div></div>
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