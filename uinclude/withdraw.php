<?php
session_start();
include_once("../db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['uId'];
    $withdrawAmount = $_POST['withdrawAmount'];

    // Validate the withdrawal amount
    if (!is_numeric($withdrawAmount) || $withdrawAmount <= 0) {
        // Handle invalid amount, e.g., show an error message
        echo "Invalid withdrawal amount";
        exit;
    }

    // Retrieve the user's wallet balance
    $query = "SELECT amount FROM wallet WHERE uId = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $walletBalance = $row['amount'];

        // Validate if the withdrawal amount is within the available balance
        if ($withdrawAmount <= $walletBalance) {
            // Insert a record into the withdraw table
            $insertQuery = "INSERT INTO withdraw (uId, amount, status) VALUES ('$user_id', '$withdrawAmount', 0)";
            mysqli_query($conn, $insertQuery);

            // Redirect or display a success message
            header("Location: dashboard.php");
            exit;
        } else {
            // Handle insufficient balance, e.g., show an error message
            echo "Insufficient balance";
            exit;
        }
    } else {
        // Handle wallet balance retrieval failure, e.g., show an error message
        echo "Failed to retrieve wallet balance";
        exit;
    }
} else {
    // Handle non-POST requests, e.g., redirect to an error page
    header("Location: error.php");
    exit;
}
?>
