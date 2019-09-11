<?php
session_start();
//connect.php
$servername = 'localhost:3306';
$username   = 'thecsboa';
$password   = 'Moreno2043!';
$dbname     = 'thecsboa_discussion';
 
 
/*$conn = new mysqli($server, $username, $password, $database)
    or die('Error connecting to MySQL server.');*/
    
    $conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>
