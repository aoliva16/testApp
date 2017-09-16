<!DOCTYPE html>
<html>
<head>
<title> Simple PHP contact form with MySQL and Form Validation </title>
</head>
<body>
<h3> Contact US</h3>

<?php

	require 'connectToDatabase.php';
	$conn = ConnectToDabase()

	// Get data for expense categories
	$tsql="SELECT CATEGORY FROM Expense_Categories";
	$expenseCategories= sqlsrv_query($conn, $tsql);

	// Populate dropdown menu 
	$options = '';
	while($row = sqlsrv_fetch_array($expenseCategories)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}

	$menu="<form id='filter' name='filter' method='post' action=''>
	  <p><label>Filter</label></p>
		<select name='filter' id='filter'>
		  " . $options . "
		</select>
	</form>";

	//echo $menu;
?>

<form action="thankyou.php" method="post">
	Name:<br>
		<input type="text" name="u_name" required><br>
 
	Email:<br>
		<input type="email" name="u_email" required><br>
 
	Subject:<br>
		<input type="text" name="subj" required><br>
 
	Message:<br>
		<input type="text" name="message" required><br>

	<label>Fruits</label><br>
		<select name="Fruits">
		 " . $options . "

<input type="submit" value="Submit"><br>
</form>
</body>
</html>
