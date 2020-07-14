<?php
	ini_set('post_max_size', '100M');
	if (!isset($_SESSION)) {
		session_start();
	}
	if(isset($_SESSION['username']))
	{
	if(isset($_POST['submit']) )
	{
		$content =pack("H*",$_POST['hello']);
		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename= IMG_'.rand(1000,100000).'.png');
		echo $content;
	}
}
		
	else
	{
		echo'<script type="text/javascript">
		var url = "http://"+location.hostname+":"+location.port+"/stegano/home/index.php";
		window.location = url;
	</script>';
		
			
	}

?>