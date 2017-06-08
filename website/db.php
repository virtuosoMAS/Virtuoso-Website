<?php
	$hostname = 'sql311.byethost7.com';
	$username = 'b7_20017270';
	$password =  'abcnotation';
 	$conn = mysql_connect($hostname, $username, $password);
 	$db   = mysql_select_db('b7_20017270_QandA');
 	if (!$conn || !$db)
 		header("Location: index.php");
?>
