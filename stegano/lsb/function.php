<?php
function toHex($num)
{
	$hex = str_pad(base_convert($num, 10, 16),2,"0",STR_PAD_LEFT);
	return $hex;
}
function string2hex($string)
{
	$hex = '';
	for ($i=0; $i < strlen($string) ; $i++) { 
		$hex .= str_pad(base_convert(ord($string[$i]),10,16),2,"0",STR_PAD_LEFT);
	}
	return $hex;
}
function toDec($hex)
{
	$num = base_convert($hex,16,10);
	return $num;
}
function hex2string($hex)
{
	$string = pack('H*',$hex);
	return $string;
}
?>