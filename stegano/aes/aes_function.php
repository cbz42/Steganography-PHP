<?php
	include("aes_c_function.php");
	include('aes_arrays.php');

	function encrypt_loop($key,$message)
	{
		$keys = change_key($key);
		$message_arr = str_split($message,16);
		//print_r($message_arr);
		$cipher = '';
		for ($i=0; $i < count($message_arr) ; $i++) { 
			$cipher .= encode_128bit_data($keys,$message_arr[$i]);
		}
		return $cipher;
	}
	//$cipher  = encrypt_loop('hello from me yo','hello from  dfhdsjfgdsfhgddshfgdsgfhsdghfhdshghgghghhghhjjhghh 27');

	function decrypt_loop($key,$message)
	{
		$keys = change_key($key);
		$message_arr = str_split($message,16);
		//print_r($message_arr);
		$cipher = '';
		for ($i=0; $i < count($message_arr) ; $i++) { 
			$cipher .= decode_128bit_data($keys,$message_arr[$i]);
		}
		return $cipher;
	}
	//echo decrypt_loop('hello from me yo',$cipher);

?>