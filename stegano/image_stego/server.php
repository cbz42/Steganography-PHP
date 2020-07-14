	<?php
		ini_set('max_execution_time', '-1');
		include('../lsb/function.php');
		if(!isset($_SESSION))
		{
				session_start();
		}
		$errors = array();
		$content = '';
		$emes = '';
		if(isset($_SESSION['username']))
		{
			if (isset($_POST['encbtn']))
			{
			
				$stype = $_POST['stype'];
				$skey = $_POST['skey'];
				$smessage = $_POST['smessage'];
				//echo $_FILES['upload']['tmp_name'];

				if (empty($stype)) { array_push($errors, "Select the Lsb or des method"); }
				if (empty($skey)) { array_push($errors, "Enter the key"); }
				if (empty($smessage)) { array_push($errors, "Enter the message"); }
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
				if(!empty($smessage) & strlen($smessage) > 100)
				{
					array_push($errors,'message is greater than 100 letter');
				}
				//echo strlen($stype);
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
				//echo strlen($skey);
				//print_r($_FILES['upload']);
				if(count($errors) == 0)
				{
					if ($stype == 'lsb' & strlen($skey) == 12 & strlen($smessage) <=100 ) {
						//echo 'hello';
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						$msize =str_pad(strlen($smessage),3,"0",STR_PAD_LEFT);
						//echo $msize;
						$r_message = $skey.$msize.$smessage;
						//echo $r_message;
						//echo $r_message;
						$mhex = string2hex($r_message);
						//echo strlen($mhex);
						$rlenx = strlen($r_message)*2;
						//echo $rlenx;
						$elen = $x*$y;
						$ew = 0;
						if ($rlenx < $elen) {
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
	  									$newB[1] = $mhex[$count];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								$newB = toDec($newB);
	  								$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								imagesetpixel($im,$qw,$f,$new_color);

	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						//echo '<br>'.$qw .'<br>'.$f;
							$content1 = ob_get_contents();
							ob_clean();
							ob_start();
							imagepng($im);
							$content = ob_get_contents();
							ob_clean();
							echo $content1;
							$content = implode("",unpack("H*",$content));
							$emes = "Hiding successfully...";
						}
						else
						{
							array_push($errors, 'message to too big for image');
						}
					
					}
					elseif($stype == 'des' & strlen($skey) == 8 & strlen($smessage) <=100 )
					{
						//echo 'hello';
						include('../des/des_function.php');
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						$smessage = encrypt_loop($skey,$smessage);
						//echo $smessage;
						$msize =str_pad(strlen($smessage),3,"0",STR_PAD_LEFT);
						//echo $msize;
						$r_message = $skey.$msize.$smessage;
						//echo '<br>'.$r_message;
						//echo $r_message;
						$mhex = string2hex($r_message);
						//echo strlen($mhex);
						$rlenx = strlen($r_message)*2;
						//echo $rlenx;
						$elen = $x*$y;
						$ew = 0;
						if ($rlenx < $elen) {
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
	  									$newB[1] = $mhex[$count];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								$newB = toDec($newB);
	  								$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								imagesetpixel($im,$qw,$f,$new_color);

	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						//echo '<br>'.$qw .'<br>'.$f;
							$content1 = ob_get_contents();
							ob_clean();
							ob_start();
							imagepng($im);
							$content = ob_get_contents();
							ob_clean();
							echo $content1;
							$content = implode("",unpack("H*",$content));
							$emes = "Hiding successfully...";
						}
						else
						{
							array_push($errors, 'message to too big for image');
						}
					}
					elseif ($stype == 'aes' & strlen($skey) == 16 & strlen($smessage) <=100 ) 
					{
						//echo 'hello';
						include('../aes/aes_function.php');
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						$smessage = encrypt_loop($skey,$smessage);
						//echo $smessage;
						$msize =str_pad(strlen($smessage),3,"0",STR_PAD_LEFT);
						//echo $msize;
						$r_message = $skey.$msize.$smessage;
						//echo '<br>'.$r_message;
						//echo $r_message;
						$mhex = string2hex($r_message);
						//echo strlen($mhex);
						$rlenx = strlen($r_message)*2;
						//echo $rlenx;
						$elen = $x*$y;
						$ew = 0;
						if ($rlenx < $elen) {
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
	  									$newB[1] = $mhex[$count];
	  									$count++;
	  								}
	  								else
	  								{
	  									$ew = 1;
	  									break;
	  								}
	  								$newB = toDec($newB);
	  								$new_color = imagecolorallocate($im,$newR,$newG,$newB);
	  								imagesetpixel($im,$qw,$f,$new_color);

	  							}
	  							if ($ew == 1)
								{
									break;
								}
	  						}
	  						//echo $count;
	  						//echo '<br>'.$qw .'<br>'.$f;
							$content1 = ob_get_contents();
							ob_clean();
							ob_start();
							imagepng($im);
							$content = ob_get_contents();
							ob_clean();
							echo $content1;
							$content = implode("",unpack("H*",$content));
							$emes = "Hiding successfully...";
						}
						else
						{
							array_push($errors, 'message to too big for image');
						}
					}
					else
					{
						array_push($errors, 'error occur during hiding');
					}
				}
			}
			/*if (isset($_POST['decbtn'])) 
			{	
				echo 'heloo';
				$stype = $_POST['stype'];
				$skey = $_POST['skey'];
				echo "hello";
				if (empty($stype)) { array_push($errors, "Select the Lsb or des method"); }
				if (empty($skey)) { array_push($errors, "Enter the key"); }
				if (empty($_FILES['upload']['tmp_name'])) { array_push($errors, "select the image to encrypt"); $a = 1; }
				else
				{
					$a = 0;
				}
				if (isset($_FILES['upload']['tmp_name']) & $a != 1) 
				{
					if ($_FILES['upload']['type'] == 'image/jpeg' || $_FILES['upload']['type'] == 'image/png') 
					{
						$mime = substr($_FILES['upload']['type'], 6);
						//echo $mime;
					}
					else
					{
						array_push($errors, 'File type is not image in jpeg and png format.');
					}
				}	
				echo "hello";
				if (count($errors) == 0)
				{
					if ($stype == 'lsb' & strlen($skey) == 12 )
					{	
						//echo "hello";
						$im = file_get_contents($_FILES['upload']['tmp_name']);
						$im = imagecreatefromstring($im);
						$x = imagesx($im);
						$y = imagesy($im);
						$rmessage = '';
						$rmessagex = '';
						$cont = 0;
						$key = '';
						$keyx = '';
						$len = '';
						$message = '';
						for ($g=0; $g <$x ; $g++) 
						{ 
							for ($f=0; $f < $y; $f++)
							{ 
								//echo "hello";
								$rgb = imagecolorat($im,$g,$f);
	  							$r = ($rgb >>16) & 0xFF;
	  							$g = ($rgb >>8) & 0xFF;
	  							$b = $rgb & 0xFF;
	  							$newR = $r;
	  							$newB = $g;
	  							$newB = toHex($b);
	  							if ($cont < 24) {
	  								$keyx .= $newB[1];
	  				
	  								$cont++;
	  							}
	  							else
	  							{
	  								$ew = 1;
	  								break;
	  							}
							}
						}
						$key = hex2string($keyx);
						echo "<br>";
						echo $key;
					}		
					elseif($stype == 'des' & strlen($skey) == 8  )
					{
						echo "des";
					}
					elseif ($stype == 'aes' & strlen($skey) == 16 ) 
					{
						echo "aes";
					}
					else
					{
						array_push($errors, 'error occur during retrieve');
					}
				
				}
				else
				{
					array_push($errors, 'error occur during retrieve');
				}
			}*/
		}
	?>