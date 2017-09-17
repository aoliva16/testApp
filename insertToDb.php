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
	$expenseDay= (int) ($_POST['expense_day']);
	$expenseMonth= (int) ($_POST['expense_month']);
	$expenseYear= (int) ($_POST['expense_year']);
	$expenseAmount= (float) ($_POST['expense_amount']);
	$expenseNote= ($_POST['input_note']);
	$expenseCategory= ($_POST['expense_category']);

	// Get also expense month name
	$dateObj= DateTime::createFromFormat('!m', $expenseMonth);
	$expenseMonthName= $dateObj->format('F'); // March

	$tsql="SELECT CATEGORY FROM Expense_Categories";

	echo $expenseDay;
	echo $expenseMonth;
	echo $expenseMonthName;
	echo $expenseYear;
	echo $expenseAmount;
	echo $expenseNote;
	echo $expenseCategory;

	// Close SQL database connection
	sqlsrv_close ($conn);

	//header("Location: /"); /* Redirect browser to home page */
 
?>