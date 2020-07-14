<?php
	require("des_c_function.php");
	
	function Encrypt($key,$message)
	{
		//include("des_arrays.php");
		$ciphertext = 0;
		$keys = array();
		$error  = array();
		$password = key_validate($key);
		//$password = "133457799BBCDFF1";
		//$password = pack("H*",$password);
		$plaintext = message_validate($message);
		//plaintext = "0123456789ABCDEF";
		//$plaintext = pack("H*",$plaintext);
		if ($password != "NULL" && strlen($password) == 8) {
			$keys = generatekeys($password); // 48 bit each
			//print_r(implode("", $keys[0]));
		}
		else
		{
			array_push($error, "Error : key is not proper");
		}
		if($plaintext != "NULL" && strlen($plaintext) == 8 && is_null($keys) == false)
		{
			$ciphertext = encode_64_data($plaintext,$keys);
		}
		else
		{
			array_push($error, "error : message is not proper");
		}
		/*echo $ciphertext;
		echo "<br>";

		print_r(implode("",$keys[15]));
		echo count($keys[15]);
		echo "<br>";
		//echo $ciphertext;
		//echo strlen($ciphertext);	
		/*$a = bindec($ciphertext);
		echo "<br>" . $a;
		$a = dechex($a);
		echo $a;
		echo "<br>";
		$c = base_convert($a,16,2);
		echo $c;
		echo strlen($c);*/
		//echo hex_bin($ciphertext);
		//print_r($error);
		return pack("H*",$ciphertext);
	}
	/*$password = "133457799BBCDFF1";
	$password = hex_bin($password);
	$a = str_pad($password, 64,"0",STR_PAD_LEFT);
	//print_r($a);
	echo "<br>";
	$a = chunk_split($password,1,",");
	$a = explode(",", $a);
	array_pop($a);
	$keys = generatekeys($a);
	print_r(implode("", $keys[15]));*/
	//$cipher = Encrypt("Hello w2","hello r");
	//$a = base64_encode($cipher);
	//echo base64_decode($a);
	//implode();
	function Decrypt($key,$message)
	{
		//$password = "133457799BBCDFF1";
		//$key = pack("H*",$password);
		$keys = generatekeys($key);
		$plaintext = decode_64data($message,$keys);
		return pack("H*",$plaintext);
	}
	//$decipher = Decrypt("Hello w2",$cipher);
	//echo "<br>";
	//echo $decipher;

	function encrypt_loop($key,$message)
	{
		$keys = generatekeys($key);
		$message_arr = str_split($message,8);
		//print_r($message_arr);
		$cipher = '';
		for ($i=0; $i < count($message_arr) ; $i++) { 
			$cipher .= encode_64_data($message_arr[$i],$keys);
		}
		return pack("H*",$cipher);
	}
	//$cipher = encrypt_loop('hello we','hello');
	//echo $cipher;

	function decrypt_loop($key,$message)
	{
		$keys = generatekeys($key);
		$message_arr = str_split($message,8);
		//print_r($message_arr);
		$cipher = '';
		for ($i=0; $i < count($message_arr) ; $i++) { 
			$cipher .= decode_64data($message_arr[$i],$keys);
		}
		return pack("H*",$cipher);
	}
	//$plaintext = decrypt_loop('hello we',$cipher);
	//echo $plaintext;
?>