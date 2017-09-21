<?php

	// Define function to parse basic input from form
	function parse_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
 
	// PHP script used to connect to backend Azure SQL database
	require 'ConnectToDatabase.php';

	// Define variables and set to empty values
	$expenseDay = $expenseMonth = $expenseYear = $expenseAmount = $expenseNote = $expenseCategory = NULL;

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get input variables
	$expenseDay= (int) ($_POST['expense_day']);
	$expenseMonth= (int) ($_POST['expense_month']);
	$expenseYear= (int) ($_POST['expense_year']);
	$expenseAmount= (float) ($_POST['expense_amount']);
	$expenseNote= ($_POST['input_note']);
	$expenseCategory= ($_POST['expense_category']);

	// Get also expense month name
	$dateObj= DateTime::createFromFormat('!m', $expenseMonth);
	$expenseMonthName= $dateObj->format('F'); // March

	// Build SQL query to insert new expense data into SQL database
	$tsql="INSERT INTO Expenses (ExpenseDay,
							     ExpenseMonth,
								 ExpenseMonthName,
								 ExpenseYear,
								 ExpenseCategory,
								 ExpenseAmount,
								 Notes)
			VALUES ('" . $expenseDay . "', 
					'" . $expenseMonth . "', 
					'" . $expenseMonthName . "', 
					'" . $expenseYear . "', 
					'" . $expenseCategory . "', 
					'" . $expenseAmount . "', 
					'" . $expenseNote . "')";

	// Run query
	$sqlQueryStatus = sqlsrv_query($conn, $tsql);

	// Close SQL database connection
	sqlsrv_close ($conn);

	// Start session and store previously-selected Expense Month as part of data to carry over after URL redirection
	session_start();
	$_SESSION['prevExpenseMonth'] = $expenseMonth;

	/* Redirect browser to home page */
	header("Location: /"); 
?>