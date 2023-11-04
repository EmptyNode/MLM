<?php
// session_start();
$dbHost = 'localhost';
$dbName = 'mlm_database';
$dbUsername = 'root';
$dbPassword = '';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    echo "Connection Failed";
    exit();
}

?>