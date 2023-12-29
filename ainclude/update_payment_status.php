<?php
include('../db_conn.php');

// Check if the POST data 'uid' is set
if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];

    // Update the 'status' field in the 'withdraw' table
    $updateQuery = "UPDATE withdraw SET status = 1 WHERE req_id = $uid";

    if (mysqli_query($conn, $updateQuery)) {
        // If the update is successful, update the balance in the 'wallet' table
        $getUserQuery = "SELECT uId, amount FROM withdraw WHERE req_id = $uid";
        $userResult = mysqli_query($conn, $getUserQuery);

        if ($userResult && $userRow = mysqli_fetch_assoc($userResult)) {
            $userId = $userRow['uId'];
            $withdrawAmount = $userRow['amount'];

            // Add a row with the negative amount to the 'wallet' table
            $updateWalletQuery = "INSERT INTO wallet (uId, amount, details) VALUES ($userId, -$withdrawAmount, 'Withdrawal of rs.$withdrawAmount')";
            if (mysqli_query($conn, $updateWalletQuery)) {
                echo "Payment status updated successfully! Wallet updated.";
            } else {
                echo "Error updating wallet: " . mysqli_error($conn);
            }
        } else {
            echo "Error fetching user information: " . mysqli_error($conn);
        }
    } else {
        // If the update fails, return an error message
        echo "Error updating payment status: " . mysqli_error($conn);
    }
} else {
    // If 'uid' is not set in the POST data, return an error message
    echo "Error: User ID not provided!";
}

// Close the database connection
mysqli_close($conn);
?>
