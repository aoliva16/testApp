<?php
 
	require 'ConnectToDatabase.php';

	// define variables and set to empty values
	$date = $expenseAmount = $expenseNote = $expenseCategory = "";

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get input variables
	$date= ($_POST['input_date']);
	$expenseAmount= ($_POST['expense_amount']);
	$expenseNote= ($_POST['input_note']);
	$expenseCategory= ($_POST['expense_category']);

	$tsql="SELECT CATEGORY FROM Expense_Categories";

	// echo ("$tsql");

	// Close SQL database connection
	sqlsrv_close ($conn);

	header("Location: index.php"); /* Redirect browser */
 
?>