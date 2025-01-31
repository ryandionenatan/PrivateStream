<?php
$link=mysqli_connect("host","user","password","db","port");

if (mysqli_connect_error()) {
$logMessage = 'MySQL Error: ' . mysqli_connect_error();
// Call your logger here.
die('Could not connect to the database');
}

?>
