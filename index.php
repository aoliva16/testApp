<!DOCTYPE html>
<html>
<head><title>Accessing App Settings from PHP</title></head>
<body>

<h1>Website node version: <?php echo getenv("WEBSITE_NODE_DEFAULT_VERSION"); ?></h1>

<?php $connStr = getenv("SQLAZURECONNSTR_defaultConnection"); ?>
<p>SQL connection string: <?php echo $connStr; ?></p>

<?php
	$connection = odbc_connect($connStr);


if ($connection){
	echo "all OK!"
}
else{
	echo "no good"
};

?>
</body>
</html>