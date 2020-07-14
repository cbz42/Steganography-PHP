<?php 
function toBin($str){
  $str = (string)$str;
  $l = strlen($str);
  $result = '';
  while($l--){
    $result = str_pad(decbin(ord($str[$l])),8,"0",STR_PAD_LEFT).$result;
  }
  return $result;
}
function toString($binary){
  return pack('H*',base_convert($binary,2,16));
}
function tostring1($binary)
{
	$binary = str_split($binary);
	$str = '';
	for ($i=0; $i < count($binary); $i++) { 
		$str .= pack('H*',base_convert($binary[$i], 2, 16));
	}
	return $str;
}
?>