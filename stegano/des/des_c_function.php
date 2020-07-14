<?php
	ini_set('memory_limit','-1');
	//validating the keys
	function key_validate($key)
	{
		if(strlen($key) < 8 )
		{
			$key = null;
			var_dump($key);
			return $key;
		}	
		if(strlen($key) > 8)
		{
			$key = substr($key, 0, 8);
			return $key;
		}
		else
		{
			return $key;
		}

	}
	//validating the message
	function message_validate($message)
	{
		if(strlen($message) < 8 )
		{
			$message = str_pad($message, 8, " ", STR_PAD_RIGHT);
			return $message;
		}
		if(strlen($message) > 8 )
		{	
			$message = null;
			var_dump($message);
			return $message;
		}
		else
		{
			return $message;
		}
		
	}
	function String2char2bit_array($pwd)
	{	
		$pwd = (string)$pwd;
		$l = strlen($pwd);
		$sub_key = array();
		$binval = null;
		$l1 = null;
		for ($i=0 ; $i < $l ; $i++) { 
			$a = substr($pwd,$i,1);
			$binval = str_pad(decbin(ord($a)),8,"0",STR_PAD_LEFT);
			$l1 = strlen($binval);
			for($j = 0 ; $j < $l1 ;$j++){
				$b = substr($binval, $j,1);
				array_push($sub_key,$b);
			}
		}
		return $sub_key;
	}
	function Bit2string($array)
	{
		$array = implode("", $array);
		return $array;
	}
	function addpad($str)
	{
		$str = str_pad($str,4,"0",STR_PAD_LEFT);
		return $str;
	}
	function bin_hex($str)
	{
		$hex1 = "";
		$a = array_chunk($str,4);
		for($i = 0;$i < count($a);$i++)
		{
			$b = $a[$i];
			$b = implode("", $b);
			$b = addpad($b);
			$b = base_convert($b, 2, 16);
			$hex1 .= $b; 
		}
		return $hex1;
	}
	function hex_bin($str)
	{
		$bin1 = "";
		$a = chunk_split($str,1,",");
		$a = explode(",", $a);
		array_pop($a);
		//print_r($a);
		for($i = 0;$i < count($a);$i++)
		{
			$b = $a[$i];
			$b = base_convert($b, 16,2);
			$b = addpad($b);
			$bin1 .= $b; 
		}
		return $bin1;
	}
	function permut($block,$IniPer)
	{
		$key = array();
		for($i = 0 ; $i < count($IniPer) ; $i++){
			$b = array_slice($IniPer, $i,1);
			$z = $b[0];
			$c = array_slice($block, --$z,1);
			$e = $c[0];
			array_push($key, $e );
		}
		return $key;
 	}
 	function expand($block,$IniPer)
 	{
 		$d_e = array();
 		for($i = 0 ; $i < count($IniPer) ; $i++){
			$b = array_slice($IniPer, $i,1);
			$z = $b[0];
			$c = array_slice($block, --$z,1);
			$e = $c[0];
			array_push($d_e,$e);
		}
		return $d_e;
 	}
 	function shift($g,$n)
 	{
 		$tmp = 0;
 		$l = count($g);
 		$l = $l - $n;
 		$g1 = array_slice($g, $n ,$l );
 		$g2 = array_slice($g, 0,$n);
 		$tmp = array_merge($g1,$g2);
 		return $tmp;
 	}
 	function binval($val)
 	{
 		$val = str_pad(decbin($val),4,"0",STR_PAD_LEFT);
 		return $val;
 	}
 	function substitute($d_e)
 	{
 		include("des_arrays.php");
 		$result = array();
 		$result1 = array();
 		$subblock = array_chunk($d_e, 6);
 		for($i = 0 ; $i < 8;$i++)
 		{
 			$block = $subblock[$i];
 			$row = bindec((string)$block[0].(string)$block[5]);
 			$column = (string)$block[1].(string)$block[2].(string)$block[3].(string)$block[4];
 			$column = bindec($column);
 			$val = $S_BOX[$i][$row][$column];
 			$bin = binval($val);
 			$result1 = str_split($bin);
 			$result  = array_merge($result,$result1);
 		}
 		return $result;
 	}
 	function generatekeys($password)
 	{
 		include("des_arrays.php");
 		$key = array();
 		$key1 = String2char2bit_array($password);
 		//$key1 = $password;
 		$keys = permut($key1,$CP_1);
 		//print_r(implode("", $keys));
 		//echo "<br>";
		$g = array_slice($keys,0,28);
		//echo count($g);
		//$g = shift($g,1);
		//echo count($g);
		//print_r(implode("", $g));
		$d = array_slice($keys,28,28);
		//echo count($d);
		for ($i =0 ; $i <16 ;$i++)
		{
			$g = shift($g,$SHIFT[$i]);
			$d = shift($d,$SHIFT[$i]);
			$tmp = array_merge($g,$d);
			$tmp = permut($tmp,$CP_2);
			array_push($key, $tmp);
		}
		return $key;
 	}
 	function xor1($t1,$t2)
 	{
 		$tmp = array();
 		for($i = 0 ; $i < count($t1); $i++)
 		{
 			$a = array_slice($t1,$i,1);
 			$b = $a[0];
 			$c = array_slice($t2,$i,1);
 			$d = $c[0];
 			if ($b xor $d)
 			{
 				array_push($tmp,1);
 			}
 			else
 			{
 				array_push($tmp, 0);
 			}
 			
 		}
 		return $tmp;
 	}
 	function encode_64_data($plaintext,$keys)
 	{
 		include("des_arrays.php");
 		$plaintext = str_pad($plaintext, 8, " ", STR_PAD_RIGHT);
 		$block = String2char2bit_array($plaintext);
 		$block = permut($block,$PI);
 		$g = array_slice($block,0,32);
		$d = array_slice($block,32,32);
		/*$d_e = expand($d,$E);
		print_r(implode("", $d_e));
		echo "<br>";
		//echo count(xor1($keys[0],$d_e));
		//echo "<br>";
		//print_r(xor1($keys[0],$d_e));
		//print_r(implode(xor1($keys[0],$d_e)));
		print_r(implode("",substitute(xor1($keys[0],$d_e))));
		echo "<br>";
		//echo count(substitute(xor1($keys[0],$d_e)));
		print_r(implode("", permut(substitute(xor1($keys[0],$d_e)),$P)));
		echo "<br>";
		print_r(implode("", xor1($g,permut(substitute(xor1($keys[0],$d_e)),$P))));
		echo "<br>";*/
		$tmp = 0;
		for($i = 0 ; $i < 16 ;$i++)
		{
			$d_e = expand($d,$E); //48 bit
			$tmp = xor1($keys[$i],$d_e); //48 bit
			$tmp = substitute($tmp);
			$tmp = permut($tmp,$P); // it gives the  32 bit of data
			$tmp = xor1($g,$tmp);
			$g = $d; // R0 = L0 = f(R0,K1)
			$d = $tmp; // rn =  
			//$g = $d;
		}

		$d_g = array_merge($d,$g);
		$d_g = permut($d_g,$PI_1);
		//echo count($d_g);
		$d_g = bin_hex($d_g);
		return $d_g;
 	}
 	function decode_64data($plaintext,$keys)
 	{
 		include("des_arrays.php");
 		$plaintext = str_pad($plaintext, 8, " ", STR_PAD_RIGHT);
 		$block = String2char2bit_array($plaintext);
 		//print_r(implode("", $block));
 		$block = permut($block,$PI);
 		$g = array_slice($block,0,32);
		$d = array_slice($block,32,32);
		/*$d_e = expand($d,$E);
		print_r(implode("", $d_e));
		echo "<br>";
		//echo count(xor1($keys[0],$d_e));
		//echo "<br>";
		//print_r(xor1($keys[0],$d_e));
		//print_r(implode(xor1($keys[0],$d_e)));
		print_r(implode("",substitute(xor1($keys[0],$d_e))));
		echo "<br>";
		//echo count(substitute(xor1($keys[0],$d_e)));
		print_r(implode("", permut(substitute(xor1($keys[0],$d_e)),$P)));
		echo "<br>";
		print_r(implode("", xor1($g,permut(substitute(xor1($keys[0],$d_e)),$P))));
		echo "<br>";*/
		$tmp = 0;
		for($i = 15 ; $i >= 0 ;$i--)
		{
			//echo "<br>" . $i;
			$d_e = expand($d,$E); //48 bit
			$tmp = xor1($keys[$i],$d_e); //48 bit
			$tmp = substitute($tmp);
			$tmp = permut($tmp,$P); // it gives the  32 bit of data
			$tmp = xor1($g,$tmp);
			$g = $d; // R0 = L0 = f(R0,K1)
			$d = $tmp; // rn =  
			//$g = $d;
		}

		$d_g = array_merge($d,$g);
		$d_g = permut($d_g,$PI_1);
		//echo count($d_g);
		$d_g = bin_hex($d_g);
		return $d_g;
 	}
?> 
