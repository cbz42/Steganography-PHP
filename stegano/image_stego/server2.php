	<?php
		ini_set('max_execution_time', '-1');
		ini_set('memory_limit','-1');
		include('../lsb/function.php');
		/*if(!isset($_SESSION))
		{
				session_start();
		}*/
		$errors = array();
		$content = '';
		//if(isset($_SESSION['username']))
		//{
			if (isset($_POST['decbtn']))
			{
			
				$stype = $_POST['stype'];
				$skey = $_POST['skey'];
				//$smessage = $_POST['smessage'];
				//echo $_FILES['upload']['tmp_name'];

				if (empty($stype)) { array_push($errors, "Select the Lsb or des method"); }
				if (empty($skey)) { array_push($errors, "Enter the key"); }
				//if (empty($smessage)) { array_push($errors, "Enter the message"); }
				if (empty($_FILES['upload']['tmp_name'])) { array_push($errors, "select the image to encrypt"); $a = 1; }
				else
				{
					$a = 0;
				}
				if (isset($_FILES['upload']['tmp_name']) & $a != 1) 
				{
					if ($_FILES['upload']['type'] == 'image/jpeg' || $_FILES['upload']['type'] == 'image/png') {
						$mime = substr($_FILES['upload']['type'], 6);
					//echo $mime;
					}
					else
					{
						array_push($errors, 'File type is not image in jpeg and png format.');
					}
				}

				//echo $_FILES['upload']['size'];
				if (isset($_FILES['upload']['size'] )& $a != 1) {
					if ($_FILES['upload']['size'] > 500000) {
						array_push($errors, 'file size is too large');
					}
					# code...
				}
				if(!empty($skey) & strlen($skey) != 12 &  $stype == 'lsb' )
				{
					array_push($errors,'password size should be 12 letter');
				}
				if(!empty($skey) & strlen($skey) != 8 &  $stype == 'des' )
				{
					array_push($errors,'password size should be 8 letter');
				}
				if(!empty($skey) & strlen($skey) != 16 &  $stype == 'aes' )
				{
					array_push($errors,'password size should be 16 letter');
				}
				//print_r($_FILES['upload']);
				if(count($errors) == 0)
				{
					if ($stype == 'lsb' & strlen($skey) == 12 ) {
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						//$rmessage = '';
						//$rmessagex = '';
						//$cont = 0;
						$key = '';
						$keyx = '';
						//$len = '';
						$message = '';
						//if ($rlenx < $elen) {
							$count = 0;
							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < 30)
	  								{
	  									$keyx .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo '<br>'.hex2string($keyx).'<br>';
	  						//echo substr(hex2string($keyx),0,12);
	  						if ($skey == substr(hex2string($keyx),0,12) ){
	  							$rlenx1 = (int)substr(hex2string($keyx),12,3);
	  							//echo $rlenx1;
	  							$rlenx = 30 + ($rlenx1*2);
	  							//echo $rlenx;
	  							$count = 0;
	  							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < $rlenx)
	  								{
	  									$message .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						$content = substr(hex2string($message), 15);
	  							//echo strlen($content);
	  						}
	  						else
	  						{
	  							array_push($errors, 'key is not match');
	  						}
	  						
					
					}
					elseif($stype == 'des' & strlen($skey) == 8 )
					{
						include('../des/des_function.php');
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						//$rmessage = '';
						//$rmessagex = '';
						//$cont = 0;
						$key = '';
						$keyx = '';
						//$len = '';
						$message = '';
						//if ($rlenx < $elen) {
							$count = 0;
							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < 22)
	  								{
	  									$keyx .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo '<br>'.hex2string($keyx).'<br>';
	  						//echo substr(hex2string($keyx),0,12);
	  						if ($skey == substr(hex2string($keyx),0,8) ){
	  							$rlenx1 = (int)substr(hex2string($keyx),8,3);
	  							//echo $rlenx1;
	  							$rlenx = 22 + ($rlenx1*2);
	  							//echo $rlenx;
	  							$count = 0;
	  							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < $rlenx)
	  								{
	  									$message .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						$content = substr(hex2string($message), 11);
	  						//echo '<br>'.$content;
	  						$content = decrypt_loop(substr(hex2string($keyx),0,8),$content);
	  							//echo strlen($content);
	  						}
	  						else
	  						{
	  							array_push($errors, 'key is not match');
	  						}
	  						
					}
					elseif ($stype == 'aes' & strlen($skey) == 16  ) 
					{
						include('../aes/aes_function.php');
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						//$rmessage = '';
						//$rmessagex = '';
						//$cont = 0;
						$key = '';
						$keyx = '';
						//$len = '';
						$message = '';
						//if ($rlenx < $elen) {
							$count = 0;
							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < 38)
	  								{
	  									$keyx .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo '<br>'.hex2string($keyx).'<br>';
	  						//echo substr(hex2string($keyx),0,16);
	  						if ($skey == substr(hex2string($keyx),0,16) ){
	  							$rlenx1 = (int)substr(hex2string($keyx),16,3);
	  							//echo $rlenx1;
	  							$rlenx = 38 + ($rlenx1*2);
	  							//echo $rlenx;
	  							$count = 0;
	  							for ($qw=0; $qw < $x; $qw++) 
							{ 
								for ($f=0; $f < $y; $f++) 
								{ 
									$rgb = imagecolorat($im,$qw,$f);
	  								$r = ($rgb >>16) & 0xFF;
	  								$g = ($rgb >>8) & 0xFF;
	  								$b = $rgb & 0xFF;
	  							
	  								$newR = $r;
	  								$newG = $g;
	  								$newB = toHex($b);
	  								if($count < $rlenx)
	  								{
	  									$message .= $newB[1];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								//$newB = toDec($newB);
	  								//$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								//imagesetpixel($im,$qw,$f,$new_color);
	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						$content = substr(hex2string($message), 19);
	  						//echo '<br>'.$content;
	  						$content = decrypt_loop(substr(hex2string($keyx),0,16),$content);
	  							//echo strlen($content);
	  						}
	  						else
	  						{
	  							array_push($errors, 'key is not match');
	  						}
					}
					else
					{
						array_push($errors, 'error occur during hiding');
					}
				}
			}
		//}
	?>