<?php
session_start();
if (!isset($_SESSION['LOG_AUTH']))
{
    header('location:../index.php');
}
?>