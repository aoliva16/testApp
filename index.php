<!DOCTYPE html>
<html>
<head>
<title> Simple PHP contact form with MySQL and Form Validation </title>
</head>
<body>
<h3> Contact US</h3>

<?php

	$serverName = getenv("msSqlServer");
	$connectionOptions = array(
		"Database" => getenv("databaseName"),
		"Uid" => getenv("dbUserName"),
		"PWD" => getenv("dbPassword")
	);

	// Connect to Azure SQL Database
	$conn = sqlsrv_connect($serverName, $connectionOptions);

	// Get data for expense categories
	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$expenseCategories= sqlsrv_query($conn, $tsql);

	// Populate dropdown menu 
	$options = '';
	while($row = sqlsrv_fetch_array($expenseCategories)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}
?>

<form action="insertToDb.php" method="post">

	Date:<br>
		<input type="text" name="u_name" required><br>
 
	Expense Amount (US$):<br>
		<input type="email" name="u_email" required><br>

	Message:<br>
		<input type="text" name="message" required><br>

	<label>Expense Category</label><br>
		<select name="Fruits">
		 <?php echo " . $options . " ?>
	<br>



<input type="submit" value="Submit"><br>
</form>
</body>
</html>
