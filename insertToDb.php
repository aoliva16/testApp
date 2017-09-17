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
	$expenseDay = $expenseMonth = $expenseYear = $expenseAmount = $expenseNote = $expenseCategory = "";

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get input variables
	$expenseDay= ($_POST['expense_day']);
	$expenseMonth= ($_POST['expense_month']);
	$expenseYear= ($_POST['expense_year']);
	$expenseAmount= ($_POST['expense_amount']);
	$expenseNote= ($_POST['input_note']);
	$expenseCategory= ($_POST['expense_category']);

	$tsql="SELECT CATEGORY FROM Expense_Categories";

	echo $expenseDay .PHP_EOL. ;
	echo $expenseMonth .PHP_EOL. ;
	echo $expenseYear .PHP_EOL. ;
	echo $expenseAmount .PHP_EOL. ;
	echo $expenseNote .PHP_EOL. ;
	echo $expenseCategory .PHP_EOL. ;

	// Close SQL database connection
	sqlsrv_close ($conn);

	//header("Location: /"); /* Redirect browser to home page */
 
?>