<?php
	$serverName = getenv("msSqlServer");
	$connectionOptions = array(
		"Database" => getenv("databaseName"),
		"Uid" => getenv("dbUserName"),
		"PWD" => getenv("dbPassword")
	);

	$conn = sqlsrv_connect($serverName, $connectionOptions);

	// Select data
	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$filter= sqlsrv_query($conn, $tsql);

	$options = '';
	while($row = sqlsrv_fetch_array($filter)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}

	$menu="<form id='filter' name='filter' method='post' action=''>
	  <p><label>Filter</label></p>
		<select name='filter' id='filter'>
		  " . $options . "
		</select>
	</form>";

	echo $menu;
?>