<?php 

$username = "dbuser";
$password = "powerpc";
$hostname= "localhost";
$database = "test_imex";	


$dbh = mysql_connect($hostname, $username, $password) 
	or die("Unable to connect to MySQL");


	
mysql_select_db($database) or die("couldn't open database");
?> 