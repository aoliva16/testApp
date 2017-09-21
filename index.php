<!DOCTYPE html>
<html>
<head>
<title> Carlos' Expense Input Tool </title>
<style>.error {color: #FF0000;}</style>
</head>
<body>
<h3> Input Expense</h3>

<?php
	
	require 'connectToDatabase.php';
	require 'insertToDb.php';

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get data for expense categories
	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$expenseCategories= sqlsrv_query($conn, $tsql);

	// Populate dropdown menu options 
	$options = '';
	while($row = sqlsrv_fetch_array($expenseCategories)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}

	// Close SQL database connection
	sqlsrv_close ($conn);

	// Get the session data from the previously selected Expense Month, if it exists
	session_start();
	if ( !empty( $_SESSION['prevSelections'] ))
	{ 
		$prevSelections = $_SESSION['prevSelections'];
		unset ( $_SESSION['prevSelections'] );
	}

	// Extract previously-selected Month
	$prevExpenseMonth= $prevSelections['prevExpenseMonth'];
?>

<!-- Define web form. 
The array $_POST is populated after the HTTP POST method.
The PHP script insertToDb.php will be executed after the user clicks "Submit"-->
<form action="insertToDb.php" method="post">

	Expense Day (1-31):<br>
		<input type="text" name="expense_day" required><br>

	<!-- Dropdown menu for expense month, remembering previously selected month -->
	Expense Month:<br>
	<select name="expense_month">
		<option value="-1">Month:</option>
		<option value="01"<?php echo $prevExpenseMonth == 1 ? 'selected="selected"' : ''; ?>>Jan</option>
		<option value="02"<?php echo $prevExpenseMonth == 2 ? 'selected="selected"' : ''; ?>>Feb</option>
		<option value="03"<?php echo $prevExpenseMonth == 3 ? 'selected="selected"' : ''; ?>>Mar</option>
		<option value="04"<?php echo $prevExpenseMonth == 4 ? 'selected="selected"' : ''; ?>>Apr</option>
		<option value="05"<?php echo $prevExpenseMonth == 5 ? 'selected="selected"' : ''; ?>>May</option>
		<option value="06"<?php echo $prevExpenseMonth == 6 ? 'selected="selected"' : ''; ?>>Jun</option>
		<option value="07"<?php echo $prevExpenseMonth == 7 ? 'selected="selected"' : ''; ?>>Jul</option>
		<option value="08"<?php echo $prevExpenseMonth == 8 ? 'selected="selected"' : ''; ?>>Aug</option>
		<option value="09"<?php echo $prevExpenseMonth == 9 ? 'selected="selected"' : ''; ?>>Sep</option>
		<option value="10"<?php echo $prevExpenseMonth == 10 ? 'selected="selected"' : ''; ?>>Oct</option>
		<option value="11"<?php echo $prevExpenseMonth == 11 ? 'selected="selected"' : ''; ?>>Nov</option>
		<option value="12"<?php echo $prevExpenseMonth == 12 ? 'selected="selected"' : ''; ?>>Dec</option>
	</select><br>

	Expense Year (YYYY):<br>
		<input type="text" name="expense_year" required><br>
 
	Expense Amount (US$):<br>
		<input type="" name="expense_amount" required><br>

	Expense Category:<br>
		<select name="expense_category">
			<?php echo " . $options . " ?>
		</select><br>

	Notes (optional):<br>
		<input type="text" name="input_note" ><br>

	<br>
	<input type="submit" value="Submit"><br>
</form>

<h3> Previous Input (if any):</h3>
<p> Expense Day: <?php echo $prevSelections['prevExpenseDay'] ?> </p>
<p> Expense Month: <?php echo $prevSelections['prevExpenseMonth'] ?> </p>
<p> Expense Year: <?php echo $prevSelections['prevExpenseYear'] ?> </p>
<p> Expense Category: <?php echo $prevSelections['prevExpenseCategory'] ?> </p>
<p> Expense Amount: <?php echo $prevSelections['prevExpenseAmount'] ?> </p>
<p> Expense Note: <?php echo $prevSelections['prevExpenseNote'] ?> </p>
<p> <?php echo $prevSelections['errorMessage'] ?> </p>

</body>
</html>
