<?php
	$serverName = getenv("msSqlServer");
	$connectionOptions = array(
		"Database" => getenv("databaseName"),
		"Uid" => getenv("dbUserName"),
		"PWD" => getenv("dbPassword")
	);

	$conn = sqlsrv_connect($serverName, $connectionOptions);

	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$getResults= sqlsrv_query($conn, $tsql);

	echo ("Reading data from table");
	if ($getResults == FALSE)
		echo (sqlsrv_errors());
	while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
		echo ($row['CATEGORY'])
	}
	sqlsrv_free_stmt($getResults);
?>