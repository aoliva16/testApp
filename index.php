<!DOCTYPE html>
<html>
<head><title>Accessing App Settings from PHP</title></head>
<body>

<h1>Website node version: <?php echo getenv("WEBSITE_NODE_DEFAULT_VERSION"); ?></h1>

<?php $connStr = getenv("SQLAZURECONNSTR_defaultConnection"); ?>
<p>SQL connection string: <?php echo $connStr; ?></p>

<p>SQL connection string: <?php echo "attempting connection..."; ?></p>
<?php
	$conn = odbc_connect($connStr);
?>
<p>Connection: <?php echo $conn; ?></p>

<?php
	$sql="SELECT * FROM Expense_Categories";
	$rs=odbc_exec($conn,$sql);

	if (!$rs)
		{exit("Error in SQL");}
?>
</body>
</html>