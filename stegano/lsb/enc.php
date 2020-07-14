<?php
	include('function.php');
	$im = imagecreatefromjpeg('images(2).jpg');
	$m = "hello from me track on this i can helip56464648$%%^&**@#%&&*****::::::;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;";
	$mhex = string2hex($m);
	echo $mhex;
	$mhexl = strlen($mhex);
	$x = imagesx($im);
	$y = imagesy($im);
	$mlen = strlen($m);
	$mlenx = $mlen*2;
	echo '<br>'.$mlenx;
	$elen = $x*$y;
	if ($mlenx <= $elen) 
	{
		echo '<table style="width:100%">
  			<tr>
    		<th>old b</th>
    		<th>new b</th> 
    		<th>new b in dec</th>
  			</tr><tr>';
  		$cont = 0;
		for ($i=0; $i < $mlenx; $i++)
		{ 
			
			for ($f=0; $f <$y ; $f++) 
			{ 
				$rgb = imagecolorat($im,$i,$f);
				echo '<td>'.$i.'<td>';
	  			$r = ($rgb >>16) & 0xFF;
	  			$g = ($rgb >>8) & 0xFF;
	  			$b = $rgb & 0xFF;
	  			$newR = $r;
	  			$newG = $g;
	  			$newB = toHex($b);
	  			echo '<td>'.$f.'<td>';
	  			if ($cont < $mhexl) {
	  				$newB[1] = $mhex[$cont];
	  				
	  				$cont++;
	  			}
	  			else
	  			{
	  				$ew = 1;
	  				break;
	  			}
	  			
	  			$newB = toDec($newB);
	  			echo '<td>'.$newB.'</td></tr>';
	  			$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  			
	  			imagesetpixel($im, $i, $f,$new_color);
	  			//imagefill($im, x, y, color)
			}
			if ($ew == 1)
			{
				break;
			}
		}
		echo '</table>';
		echo $i.'<br>'.$f.'<br>'.$cont;
		$content1 = ob_get_contents();
							//echo $content1;
							ob_clean();
							ob_start();
							imagepng($im,'1.png');
							$content = ob_get_contents();
							ob_clean();
							//echo "hello";
							echo $content1;
							//echo $content;
							//$im1 = imagecreatefromstring($content);
							//imagepng($im1,'1.png');
							$content = implode("",unpack("H*",$content));
							include('../download/index2.php');
							
		die();
	}
?>