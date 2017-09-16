<!DOCTYPE html>
<html>
<head>
<title> Simple PHP contact form with MySQL and Form Validation </title>
</head>
<body>
<h3> Contact US</h3>

<form action="thankyou.php" method="post">
	Name:<br>
		<input type="text" name="u_name" required><br>
 
	Email:
		<input type="email" name="u_email" required><br>
 
	Subject:<br>
		<input type="text" name="subj" required><br>
 
	Message:<br>
		<input type="text" name="message" required><br>

	<label>Fruits</label>
		<select name="Fruits">
		<option value="Ap">Apple</option>
		<option value="BN">Banana</option>
		<option value="OR">Orange</option>

<input type="submit" value="Submit"><br>
</form>
</body>
</html>
