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

	// Start session for this particular PHP script execution.
	session_start();

	// Define variables and set to empty values
	$expenseDay = $expenseMonth = $expenseYear = $expenseAmount = $expenseNote = $expenseCategory = $errorMessage = NULL;

	if (isset($_POST["submit"]))
	{

		// Get input variables
		$expenseDay= (int) parse_input($_POST['expense_day']);
		$expenseMonth= (int) parse_input($_POST['expense_month']);
		$expenseYear= (int) parse_input($_POST['expense_year']);
		$expenseAmount= (float) parse_input($_POST['expense_amount']);
		$expenseNote= parse_input($_POST['input_note']);
		$expenseCategory= parse_input($_POST['expense_category']);

		////////////////////////////////////////////////////////
		//////////////////// INPUT VALIDATION /////////////////
		///////////////////////////////////////////////////////

		//Initialize variable to keep track of any errors
		$anyErrors= FALSE;
	
		// Check date validity
		$isValidDate= checkdate($expenseMonth, $expenseDay, $expenseYear);
		if (!$isValidDate) {$errorMessage= "Error: Invalid Date"; $anyErrors= TRUE;}

		// Only input information into database if there are no errors
		if ( !$anyErrors ) 
		{
			// Create a DateTime object based on inputted data
			$dateObj= DateTime::createFromFormat('Y-m-d', $expenseYear . "-" . $expenseMonth . "-" . $expenseDay);

			// Get the name of the month (e.g. January) of this expense
			$expenseMonthName= $dateObj->format('F');

			// Get the day of the week (e.g. Tuesday) of this expense
			$expenseDayOfWeekNum= $dateObj->format('w');
			$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
			$expenseDayOfWeek = $days[$expenseDayOfWeekNum];

			// Connect to Azure SQL Database
			$conn = ConnectToDabase();


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
		}

		// Initialize an array of previously-posted info
		$prevSelections = array();

		// Populate array with key-value pairs
		$prevSelections['errorMessage']= $errorMessage;
		$prevSelections['prevExpenseDay']= $expenseDay;
		$prevSelections['prevExpenseMonth']= $expenseMonth;
		$prevSelections['prevExpenseYear']= $expenseYear;
		$prevSelections['prevExpenseCategory']= $expenseCategory;
		$prevSelections['prevExpenseAmount']= $expenseAmount;
		$prevSelections['prevExpenseNote']= $expenseNote;

		// Store previously-selected data as part of info to carry over after URL redirection
		$_SESSION['prevSelections'] = $prevSelections;

	} //end of if (isset($_POST["submit"]))

	/* Redirect browser to home page */
	header("Location: /"); 
?>