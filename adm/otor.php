<?php
$link=mysqli_connect("dbaas-db-3534850-do-user-16515205-0.c.db.ondigitalocean.com","doadmin","AVNS_z7C1c6HDbgnmPh8zck_","defaultdb","25060");

if (mysqli_connect_error()) {
$logMessage = 'MySQL Error: ' . mysqli_connect_error();
// Call your logger here.
die('Could not connect to the database');
}

?>
