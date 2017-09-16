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

	while($row = mysql_fetch_array($getResults)) {
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