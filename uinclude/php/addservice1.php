<?php
session_start();
include('db_conn.php');

if (isset($_POST['saveService'])){

    $service = $_POST['service'];
    $location = $_POST['location'];
    $addr = $_POST['addr'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];

    $user_query = "INSERT INTO service_master (service, location, addr, pin, mobile, whatsapp, email) VALUES ('$service', '$location', '$addr', '$pincode', '$mobile', '$whatsapp', '$email')";
    $user_query_run = mysqli_query($conn, $user_query);

    if ($user_query_run)
    {
        $_SESSION['status']="Service added successfully";
        header("Location: ../areamaster.php");
    }else{
        $_SESSION['status']="Something went wrong";
        header("Location: ../areamaster.php");
    }
}


?>