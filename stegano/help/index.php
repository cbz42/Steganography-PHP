<?php
 include('../header/index.php');
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<script type="text/javascript">
	document.title = "home";
</script>
<link rel="stylesheet" type="text/css" href="../help/style/style.css" />
</head>
<body>
</body>
	<div style="height: 500px;background-image: url('../image/images(9).jpg');background-repeat: no-repeat;background-size: 100% 100%">
		<div id="center">

			<h1>Help</h1>
			<p >
				<ul style="margin-left: 25%;margin-right: 25%;">
					<li>1)What is 8 letter password?</li></ul>
					<p style="margin-left: 25%;margin-right: 25%;" > In 8 letter password, we are are using the DES (data encryption standard)  algorithm to encrypt your data and the finally hide the encrypted data to image.For retrieving use the same key which is use for encryption and hiding.</p>
				<ul style="margin-left: 25%;margin-right: 25%;">
					<li>2)What is 16 letter password?</li></ul>
					<p style="margin-left: 25%;margin-right: 25%;" > In 16 letter password, we are are using the AES (advanced encryption standard)  algorithm to encrypt your data and the finally hide the encrypted data to image.For retrieving use the same key which is use for encryption and hiding.</p>
				<ul style="margin-left: 25%;margin-right: 25%;">
					<li>3)DES vs AES</li></ul>
					<p style="margin-left: 25%;margin-right: 25%;" > </p>
					<table style="color: white;margin-left: 25%;margin-right: 25%;">
<tbody >
<tr>
<td>&nbsp;</td>
<td><strong>DES</strong></td>
<td><strong>AES</strong></td>
</tr>
<tr>
<td>Developed</td>
<td>1977</td>
<td>2000</td>
</tr>
<tr>
<td>Key Length</td>
<td>56 bits</td>
<td>128, 192, or 256 bits</td>
</tr>
<tr>
<td>Cipher Type</td>
<td>Symmetric block cipher</td>
<td>Symmetric block cipher</td>
</tr>
<tr>
<td>Block Size</td>
<td>64 bits</td>
<td>128 bits</td>
</tr>

</tbody>
</table>

			</p>

		</div>

	</div>
</div>
	<?php
include('../footer/index.php');
?>
</body>
</html>