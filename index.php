<!DOCTYPE html>
<html>
<head><title>Accessing App Settings from PHP</title></head>
<body>

<h1>Website node version: <?php echo getenv("WEBSITE_NODE_DEFAULT_VERSION"); ?></h1>

<?php
	$serverName = getenv("msSqlServer");
	$connectionOptions = array(
		"Database" => getenv("databaseName"),
		"Uid" => getenv("dbUserName"),
		"PWD" => getenv("dbPassword")
	);
?>


<?php
	$conn = sqlsrv_connect($serverName, $connectionOptions);
?>

<p>Connection: <?php echo $conn; ?></p>

<?php
	$tsql="SELECT * FROM Expense_Categories";
	$getResults= sqlsrv_query($conn, $tsql);

	echo ("Reading data from table" . PHP_EOL);
	if ($getResults == FALSE)
		echo (sqlsrv_errors());
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
		echo ($row['CATEGORY'] . PHP_EOL);
	}
	sqlsrv_free_stmt($getResults);
?>
</body>
</html>