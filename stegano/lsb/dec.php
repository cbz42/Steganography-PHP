<?php
	include('function.php');
	$im = imagecreatefrompng('1.png');
	$x = imagesx($im);
	$y = imagesy($im);
	//$m = 370;
	$rmessage = '';
	$rmessagex = '';
	$cont = 0;
	echo '<table style="width:100%">
  			<tr>
    		<th>old b</th>
    		<th>new b</th> 
    		<th>new b in dec</th>
  			</tr><tr>';
	for ($i=0; $i < $x; $i++)
	{ 

		for ($f=0; $f <$y ; $f++) 
		{ 

			$rgb = imagecolorat($im,$i,$f);
			echo '<td>'.$rgb.'<td>';
	  		$r = ($rgb >>16) & 0xFF;
	  		$g = ($rgb >>8) & 0xFF;
	  		$b = $rgb & 0xFF;
	  		$newR = $r;
	  		$newG = $g;
	  		$newB = toHex($b);
	  		echo '<td>'.$newB.'<td>';
	  		if ($cont < 24) {
	  			$rmessagex .= $newB[1];
	  				
	  				$cont++;
	  			}
	  			else
	  			{
	  				$ew = 1;
	  				break;
	  			}
	  			
	  			$newB = toDec($newB);
	  			echo '<td>'.$cont.'<td></tr>';
			}
			if ($ew == 1)
			{
				break;
			}
		
	}
	echo '</table>';
	echo strlen($rmessagex);
	$rmessage = hex2string($rmessagex);
	echo 'message:' .$rmessage;
?>