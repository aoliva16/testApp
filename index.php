<!DOCTYPE html>
<html>
<head><title>Accessing App Settings from PHP</title></head>
<body>

<h1>Website node version: <?php echo getenv("WEBSITE_NODE_DEFAULT_VERSION"); ?></h1>

<?php $connStr = getenv("SQLAZURECONNSTR_defaultConnection"); ?>
<p>SQL connection string: <?php echo $connStr; ?></p>

<?php
	$conn = odbc_connect($connStr);

	if($conn)
        echo "Connected!";

	$tsql= "SELECT CATEGORY FROM Expense_Categories";
	
	$getResults= sqlsrv_query($conn, $tsql);

	echo ("Reading data from table" . PHP_EOL);
	if ($getResults == FALSE)
		die(FormatErrors(sqlsrv_errors()));
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
		echo ($row['CATEGORY'] . PHP_EOL);

	}
	sqlsrv_free_stmt($getResults);
?>


</body>
</html>