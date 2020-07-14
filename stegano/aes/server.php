<?php
include('aes_function.php');
$errors = array();
$smessage = '';
if (isset($_POST['encbtn']))
{
	$skey = $_POST['skey'];
	$smessage = $_POST['smessage'];
	if (empty($skey)) { array_push($errors, "Enter the key"); }
	if (empty($smessage)) { array_push($errors, "Enter the message"); }
	if(!empty($skey) & strlen($skey) != 16 )
	{
		array_push($errors,'password size should be 16 letter');
	}
	if(count($errors) == 0)
	{
		//echo 'hello';
		$smessage = encrypt_loop($skey,$smessage);
		//echo $smessage;
		$smessage = base64_encode($smessage);
		//echo $smessage;
	}
}
if (isset($_POST['decbtn']))
{
	$skey = $_POST['skey'];
	$smessage = $_POST['smessage'];
	if (empty($skey)) { array_push($errors, "Enter the key"); }
	if (empty($smessage)) { array_push($errors, "Enter the message"); }
	if(!empty($skey) & strlen($skey) != 16  )
	{
		array_push($errors,'password size should be 16 letter');
	}
	if(count($errors) == 0)
	{
		//echo 'hello';
		$smessage = base64_decode($smessage);
		//echo $smessage;
		$smessage = decrypt_loop($skey,$smessage);
		//echo $smessage;
		
		//echo $smessage;
	}
}
?>