<!DOCTYPE html>
<html>
<head>
<title> Carlos' Expense Input Tool </title>
<style>.error {color: #FF0000;}</style>
</head>
<body>
<h3> Input Expense</h3>

<?php
	
	/* Note about variable scope in PHP: file boundaries do NOT separate scope */

	require 'ConnectToDatabase.php';

	// Remember the last selected drop down menu option in months
	$selectedMonth = $_POST['expense_month'];

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
?>

<!-- Define web form. 
The array $_POST is populated after the HTTP POST method.
The PHP script insertToDb.php will be executed after the user clicks "Submit"-->
<form action="insertToDb.php" method="post">

	Expense Day (1-31):<br>
		<input type="text" name="expense_day" required><br>

	Expense Month:<br>
	<select name="expense_month">
		<option value="-1">Month:</option>
		<option value="01"<?php echo $selectedMonth == '01' ? 'selected="selected"' : ''; ?>>Jan</option>
		<option value="02"<?php echo $selectedMonth == '02' ? 'selected="selected"' : ''; ?>>Feb</option>
		<option value="03"<?php echo $selectedMonth == '03' ? 'selected="selected"' : ''; ?>>Mar</option>
		<option value="04"<?php echo $selectedMonth == '04' ? 'selected="selected"' : ''; ?>>Apr</option>
		<option value="05"<?php echo $selectedMonth == '05' ? 'selected="selected"' : ''; ?>>May</option>
		<option value="06"<?php echo $selectedMonth == '06' ? 'selected="selected"' : ''; ?>>Jun</option>
		<option value="07"<?php echo $selectedMonth == '07' ? 'selected="selected"' : ''; ?>>Jul</option>
		<option value="08"<?php echo $selectedMonth == '08' ? 'selected="selected"' : ''; ?>>Aug</option>
		<option value="09"<?php echo $selectedMonth == '09' ? 'selected="selected"' : ''; ?>>Sep</option>
		<option value="10"<?php echo $selectedMonth == '10' ? 'selected="selected"' : ''; ?>>Oct</option>
		<option value="11"<?php echo $selectedMonth == '11' ? 'selected="selected"' : ''; ?>>Nov</option>
		<option value="12"<?php echo $selectedMonth == '12' ? 'selected="selected"' : ''; ?>>Dec</option>
	</select>

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

	<br><br>
	<input type="submit" value="Submit"><br>
</form>

</body>
</html>
