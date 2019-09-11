<?php
session_start();
include 'connect.html';
include 'initial.html';
$_SESSION['signed_in'] = false;
echo "<div class='login'>";
	echo	"<div class ='test'>";
echo "<h5 class = 'container'> You have succesfully signed out</h5>";
echo "<h2 class = 'container'><a href='index.php'><button class = 'logbtn'>Go to login page</button></a></h2>";
$_SESSION['signed_in'] = false;


?>

