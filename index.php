<!DOCTYPE html>
<html>
<head>
<title> Carlos' Expense Input Tool </title>
</head>
<body>
<h3> Input Expense</h3>

<?php

	require 'ConnectToDatabase.php';

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get data for expense categories
	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$expenseCategories= sqlsrv_query($conn, $tsql);

	// Populate dropdown menu 
	$options = '';
	while($row = sqlsrv_fetch_array($expenseCategories)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}

	// Close SQL database connection
	sqlsrv_close ($conn);
?>

<form action="insertToDb.php" method="post">

	Date:<br>
		<input type="text" name="input_date" required><br>
 
	Expense Amount (US$):<br>
		<input type="email" name="expense_amount" required><br>

	Notes (optional):<br>
		<input type="text" name="input_note" required><br>

	<label>Expense Category</label><br>
		<select name="expense_category">
		 <?php echo " . $options . " ?><br>
	
<input type="submit" value="Submit"><br>
</form>
</body>
</html>
