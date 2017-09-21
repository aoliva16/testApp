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

	// Create a DateTime object based on inputted data
	$dateObj= DateTime::createFromFormat('Y-m-d', $expenseYear . "-" . $expenseMonth . "-" . $expenseDay);

	// Get the name of the month (e.g. January) of this expense
	$expenseMonthName= $dateObj->format('F');

	// Get the day of the week (e.g. Tuesday) of this expense
	$expenseDayOfWeekNum= $dateObj->format('w');
	$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
	$expenseDayOfWeek = $days[$expenseDayOfWeekNum];


	// Build SQL query to insert new expense data into SQL database
	$tsql="INSERT INTO Expenses (ExpenseDay,
								 ExpenseDayOfWeek,
							     ExpenseMonth,
								 ExpenseMonthName,
								 ExpenseYear,
								 ExpenseCategory,
								 ExpenseAmount,
								 Notes)
			VALUES ('" . $expenseDay . "', 
					'" . $expenseDayOfWeek . "', 
					'" . $expenseMonth . "', 
					'" . $expenseMonthName . "', 
					'" . $expenseYear . "', 
					'" . $expenseCategory . "', 
					'" . $expenseAmount . "', 
					'" . $expenseNote . "')";

	// Run query
	$sqlQueryStatus= sqlsrv_query($conn, $tsql);

	// Close SQL database connection
	sqlsrv_close ($conn);

	// Initialize an array of previously-posted info
	$prevSelections = array();

	// Populate array with key-value pairs
	$prevSelections['prevExpenseMonth']= $expenseMonth;
	$prevSelections['prevExpenseCategory']= $expenseCategory;

	// Start session and store previously-selected data as part of info to carry over after URL redirection
	session_start();
	$_SESSION['prevSelections'] = $expenseMonth;

	/* Redirect browser to home page */
	header("Location: /"); 
?>