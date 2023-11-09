<?php
// Include your database connection file
require_once 'db_conn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $service = mysqli_real_escape_string($conn, $_POST["service"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $addr = mysqli_real_escape_string($conn, $_POST["addr"]);
    $pin = mysqli_real_escape_string($conn, $_POST["pincode"]);
    $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
    $whatsapp = mysqli_real_escape_string($conn, $_POST["whatsapp"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Assuming sm_id is passed in the form or retrieved from session
    $sm_id = mysqli_real_escape_string($conn, $_POST["update_sm_id"]);

    // Use prepared statement to prevent SQL injection
    $query = $conn->prepare("UPDATE service_master SET service=?, location=?, addr=?, pin=?, mobile=?, whatsapp=?, email=? WHERE sm_id = ?");
    $query->bind_param("sssssssi", $service, $location, $addr, $pin, $mobile, $whatsapp, $email, $sm_id);
    $query->execute();

    // Check if the update was successful
    if ($query->affected_rows > 0) {
        // Update successful
        session_start();
        $_SESSION['status'] = "Service updated successfully";
        header("Location: ../areamaster.php"); // Redirect to your page
        exit();
    } else {
        // Update failed
        session_start();
        $_SESSION['status'] = "Error updating service: " . $query->error;
        header("Location: ../areamaster.php"); // Redirect to your page
        exit();
    }
} else {
    // Redirect if accessed directly without form submission
    header("Location: ../areamaster.php");
    exit();
}
?>
