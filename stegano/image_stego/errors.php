<?php
	if(count($errors)>0)
	{
?>
<div >
<?php 
	foreach($errors as $error)
	{
		echo "<h3>".$error."</h3>";
	}
 ?>
</div>
<?php
	}
?>
