<?php
	ini_set('memory_limit','-1');
	function g_mul($a)
	{
		//echo $a;

		//do
		//{
			/*if(($b & 1) != 0)
			{
				$p ^= $a;
			}*/
			//echo '$a & 0x80 ' . ($a & 0x80) . '<br>';
			//echo ($a << 1) .'<br>';
			//$a = $a << 1;
			//echo ($a & 0x80);
			//echo $a;
			if($a & 0x80 )
			{
					//echo 'hello ';
				$a = $a << 1;
				//echo 'hello';
				$a = $a ^ 0x1b ;
				$a = $a & 0xff;
			}
			else
			{
				$a = $a << 1;
			}
			//$b >>= 1;
			//echo $a.'<br>';
			//$a = (($a << 1) ^ ((($a >> 7 ) & 1) * 0x11b));
		////}while($a & 0x80);
		//echo $a.'<br>';
		//$a = (($a << 1) ^ ((($a >> 7 ) & 1) * 0x1b));
		return $a;
	}
	/*function g_mul($a,$b)
	{
		$p = 0;
		while($a&$b)
		{
			if($b&1)
			{
				$p ^= $a;
			}
			if($a & 0x80)
			{
				$a = ($a << 1 ) ^ 0x11b;
			}
			else
			{
				$a <<=1;
			}
			$b >>= 1;
		}
		return $p;
	}*/
	function text2matrix($mkey)
	{
		$key = array();
		for($j = 0;$j < 16;$j++)
		{
			$key[$j] = ord($mkey[$j]);
		}
		$keys = array_chunk($key,4);
		return $keys;
	}
	function mix_single_column($a)
	{
		//print_r($a);
		$t = $a[0] ^ $a[1] ^ $a[2] ^ $a[3];
		//echo $t.'<br>';
		//echo $a[1].'<br>';
        $u = $a[0];
        //echo g_mul($a[0]^$a[1]).'<br>';
        $a[0] ^= $t ^ g_mul($a[0]^$a[1]);
        //echo g_mul($a[0]^$a[1]).'<br>';
        $a[1] ^= $t ^ g_mul($a[1]^$a[2]);
       //echo g_mul($a[1]^$a[2]).'<br>end';
        $a[2] ^= $t ^ g_mul($a[2]^$a[3]);
        $a[3] ^= $t ^ g_mul($a[3]^$u);
        //rint_r($a);
        return $a;
	}
	/*
	ss[0, c] = (byte)(GMul(0x02, s[0, c]) ^ GMul(0x03, s[1, c]) ^ s[2, c] ^ s[3, c]);
        ss[1, c] = (byte)(s[0, c] ^ GMul(0x02, s[1, c]) ^ GMul(0x03, s[2, c]) ^ s[3,c]);
        ss[2, c] = (byte)(s[0, c] ^ s[1, c] ^ GMul(0x02, s[2, c]) ^ GMul(0x03, s[3, c]));
        ss[3, c] = (byte)(GMul(0x03, s[0,c]) ^ s[1, c] ^ s[2, c] ^ GMul(0x02, s[3, c]));
	*/
	function mix_column($a)
	{	//print_r($a);
		/*for($i = 0;$i <4 ;$i++)
		{
			$a[0][$i]= g_mul(0x02 ,$a[0][$i]) ^ g_mul(0x03 , $a[1][$i]) ^ $a[2][$i] ^ $a[3][$i];
			$a[1][$i]= $a[0][$i] ^ g_mul(0x02 , $a[1][$i]) ^ g_mul(0x03 , $a[2][$i]) ^ $a[3][$i];
			$a[2][$i]= $a[0][$i] ^ $a[1][$i] ^ g_mul(0x02 , $a[2][$i]) ^ g_mul(0x03 , $a[3][$i]);
			$a[3][$i] =  g_mul(0x03 , $a[0][$i]) ^ $a[1][$i] ^ $a[2][$i] ^  g_mul(0x02 , $a[3][$i]);
		}*/
		for($i = 0;$i < 4;$i++)
		{
			$a[$i] = mix_single_column($a[$i]);
		}
		//echo matrix2text($a);
		//echo "<br>";
		//print_r($a);
		return $a;
	}
	function shiftrows($s)
	{
		//2 column
		$u = $s[0][1];
		$s[0][1] = $s[1][1];
		$s[1][1] = $s[2][1];
		$s[2][1] = $s[3][1];
		$s[3][1] = $u;
		// 3 colmn
		$u = $s[0][2];
		$t = $s[1][2];
		$s[0][2] = $s[2][2];
		$s[1][2] = $s[3][2];
		$s[2][2] = $u;
		$s[3][2] = $t;
		//4 row
		$u = $s[0][3];
		$t = $s[1][3];
		$y = $s[2][3];
		$s[0][3] = $s[3][3];
		$s[1][3] = $u;
		$s[2][3] = $t;
		$s[3][3] = $y;
		//echo matrix2text($s);
		//echo "<br>";
		return $s;
	}
	function inv_shiftrows($s)
	{
		//3 column
		$u = $s[3][1] ;
		$s[3][1] = $s[2][1];
		$s[2][1] = $s[1][1];
		$s[1][1] = $s[0][1];
		$s[0][1] = $u;

		// 3 row
		$u = $s[2][2];
		$v = $s[3][2];
		$s[3][2] = $s[1][2];
		$s[2][2] = $s[0][2];
		$s[0][2] = $u;
		$s[1][2] = $v;

		$u = $s[1][3];
		$t = $s[2][3];
		$y = $s[3][3];
		$s[3][3] = $s[0][3];
		$s[0][3] = $u;
		$s[1][3] = $t;
		$s[2][3] = $y;
		//echo matrix2text($s);
		//echo '<br>';
		return $s;
	}
	function sub_bytes($s)
	{
		include("aes_arrays.php");
		for($i = 0; $i < 4;$i++)
		{
			for($j = 0;$j < 4;$j++)
			{
				$s[$i][$j] = $Sbox[$s[$i][$j]];
			}
		}
		//echo matrix2text($s);
		//echo "<br>";
		return $s;
	}
	function add_round_key($s,$k)
	{
		//print_r($s);
		//print_r($k);
		for($i = 0; $i < 4;$i++)
		{
			for($j = 0;$j < 4;$j++)
			{
				$s[$i][$j]  ^= $k[$i][$j];
			}
		}
		//print_r($s);
		//echo matrix2text($s);
		//echo "<br>";
		return $s;
	}
	function round_encrypt($s,$k)
	{
		$s = sub_bytes($s);
		$s = shiftrows($s);
		$s = mix_column($s);
		$s = add_round_key($s,$k);
		//echo 'end <br>';
		return $s;
	}
	function change_key($mkey)
	{
		include("aes_arrays.php");
		$round_key = text2matrix($mkey);
		//$round_keys = array();
		//$four = array();
		for($i = 4 ;$i < 44 ; $i++)
		{
			$round_key[$i] = array();
			//echo $i;
			if($i % 4 == 0)
			{	

				$byte = $round_key[$i-4][0] ^ $Sbox[$round_key[$i - 1][1]] ^ $Rcon[($i/4)];
				array_push($round_key[$i], $byte);
				for($j = 1;$j < 4; $j++)
				{
					$byte = $round_key[$i - 4][$j]  ^ $Sbox[$round_key[$i - 1][($j + 1) % 4]];
					array_push($round_key[$i], $byte);
				}
			}
			else
			{
				for($z = 0 ;$z <4 ;$z++)
				{
					$byte = $round_key[$i - 4][$z] ^ $round_key[$i - 1][$z];
					array_push($round_key[$i], $byte);
				}
			}
			//array_merge($round_key,$four);
		}
		//array_merge($round_key,$round_keys);
		return $round_key;
	}
	function matrix2text($s)
	{
		$hex = '';
		for($i = 0;$i <4;$i++)
		{
			for($j = 0;$j<4;$j++)
			{
				$hex .= str_pad(base_convert($s[$i][$j], 10, 16),2,"0",STR_PAD_LEFT);
			}
		}
		return $hex;
	}
	function encode_128bit_data($keys,$message)
	{
		$message = str_pad($message, 16, " ", STR_PAD_RIGHT);
		$plaintext = text2matrix($message);
		$round_keys = $keys;

		$s = add_round_key($plaintext,array_slice($round_keys, 0,4));
		//print_r($s);
		for($i = 1 ;$i < 10;$i++ )
		{
			$b = (4*$i);
			$s = round_encrypt($s,array_slice($round_keys,$b,4));
		}

		$s = sub_bytes($s);
		$s = shiftrows($s);
		$s = add_round_key($s,array_slice($round_keys, 40,4));
		//$s = add_round_key($s,array_slice($round_keys, 40,4));
		//print_r($s);
		$hello = matrix2text($s);
		//print_r($hello);
		return pack("H*",$hello);

	}
	function inv_mix_column($s)
	{	
		//echo matrix2text($s);
		for ($i=0; $i <4 ; $i++) { 
			//echo $s[$i][0] .'<br>'. $s[$i][2];
			$u = g_mul(g_mul($s[$i][0] ^ $s[$i][2]));
			$v = g_mul(g_mul($s[$i][1] ^ $s[$i][3]));
			//echo '<br>'.$u.'<br>'. $v.'<br>';
			$s[$i][0] ^= $u;
            $s[$i][1] ^= $v;
            $s[$i][2] ^= $u;
			$s[$i][3] ^= $v;
		}
		/*for($i = 0;$i <4 ;$i++)
		{
			$a[0][$i]= g_mul(0x0e^$a[0][$i]) ^ g_mul(0x0b ^ $a[1][$i]) ^ g_mul(0x0d ^ $a[2][$i]) ^ g_mul(0x09 ^ $a[3][$i]);
			$a[1][$i]= g_mul(0x09^$a[0][$i]) ^ g_mul(0x0e ^ $a[1][$i]) ^ g_mul(0x0b ^ $a[2][$i]) ^ g_mul(0x0d ^ $a[3][$i]);
			$a[2][$i]= g_mul(0x0d^$a[0][$i]) ^ g_mul(0x09 ^ $a[1][$i]) ^ g_mul(0x0e ^ $a[2][$i]) ^ g_mul(0x0b ^ $a[3][$i]);
			$a[3][$i] =g_mul(0x0b^$a[0][$i]) ^ g_mul(0x0d ^ $a[1][$i]) ^ g_mul(0x09 ^ $a[2][$i]) ^ g_mul(0x0e ^ $a[3][$i]);
		}*/
		$s = mix_column($s);
		//print_r($s);
		//echo matrix2text($s);
		//echo '<br>';
		return $s;
	}
	function inv_sub_bytes($s)
	{
		include('aes_arrays.php');
		for($i = 0 ; $i <4 ;$i++)
		{
			for($j = 0 ; $j<4 ; $j++)
			{
				$s[$i][$j] = $InvSbox[$s[$i][$j]]; 
			}
		}
		//echo matrix2text($s);
		//echo '<br>';
		return $s;
	}
	function round_decrypt($s,$k)
	{
		$s = add_round_key($s,$k);
		//print_r('helllo');
		$s = inv_mix_column($s);
		$s = inv_shiftrows($s);	
		
		
		$s = inv_sub_bytes($s);
		//echo 'end<br>';
		return $s;
		
	}
	function decode_128bit_data($keys,$message)
	{
		//print_r(strlen($message));
		//print_r($message);
		$message = str_pad($message, 16, " ", STR_PAD_RIGHT);
		$plaintext = text2matrix($message);
		$round_keys = $keys;
		
		//print_r($round_keys);
		//print_r($plaintext);
		$s = add_round_key($plaintext,array_slice($round_keys,40,4));
		$s = inv_shiftrows($s);
		$s = inv_sub_bytes($s);
		//print_r($s);
		
		for ($i=9; $i > 0; $i--) { 
			$b = 4 * $i;
			//echo $b;
			$s = round_decrypt($s,array_slice($round_keys,$b,4));
		}
		
		$s = add_round_key($s,array_slice($round_keys, 0,4));
		//$s = add_round_key($plaintext,array_slice($round_keys, 0,4));
		$hello = matrix2text($s);
		//print_r($hello);
		//print_r($hello);
		return pack("H*",$hello);
	}

	
?>