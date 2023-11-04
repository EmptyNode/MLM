<?php
session_start();
unset($_SESSION['LOG_AUTH']);
session_destroy(); // Destroy the session

header('location: index.php');
exit();
?>