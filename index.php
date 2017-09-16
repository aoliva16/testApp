<!DOCTYPE html>
<html>
<body>

<?php  
	$connstr = getenv('SQLAZURECONNSTR_defaultConnection')
	
	echo "Hello world"
?>

<tr><td> <input type="hidden" name="type" value="<?= $connstr ?>" ></td></tr>

</body>
</html>
