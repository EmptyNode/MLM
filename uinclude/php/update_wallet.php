<?php
// update_wallet.php

// Include or require your database connection file
include('db_conn.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment'])) {
    // Get the userId and amount from the POST data
    $userId = $_POST['userId'];
    $amount = $_POST['amount'];
    $referralCode = $_POST['referel'];
    // Validate and sanitize the input if needed


    // Insert a new row into your wallet table
    // Replace the following lines with your actual database insert logic
    // Make sure to handle errors appropriately

    // Example: Insert a new row into a hypothetical 'wallet_transactions' table
    $sql = "INSERT INTO wallet (uId, amount) VALUES ($userId, $amount)";

    if ($conn->query($sql) === TRUE) {
        echo "Payment successful.";
         // Construct the SQL query to find userId based on referral code
        $findUserIdQuery = "SELECT uId FROM user_tbl WHERE auto_referralcode = '$referralCode'";
        $result = $conn->query($findUserIdQuery);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usrId = $row['uId'];
            $referalCode = $row['referralCode'];
    
            // Insert a new row into your wallet table
            $insertWalletQuery = "INSERT INTO wallet (uId, amount) VALUES ($usrId, $amount)";
            if($conn->query($insertWalletQuery) === TRUE) {
                echo "Payment successful.";

                // For loop
                for ($i = 0; $i < 15; $i++) {
                    echo "Iteration $i<br>"; // Debug statement
                  
                    $findUIdQuery = "SELECT uId, referralCode FROM user_tbl WHERE auto_referralCode = '$referalCode'";
                    $res = $conn->query($findUIdQuery);

                    if ($res === FALSE) {
                        echo "Error in query: " . $conn->error;
                        break; // Exit the loop on query error
                    }
        
                    if ($res && $res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $usrId = $row['uId'];
                        $referalCode = $row['referralCode'];
                        $bonusAmount = 0.53;
        
                        // Insert a new row into your wallet table
                        // Adding .53 rs to the user's wallet
                        $InsertWalletQuery = "INSERT INTO wallet (uId, amount) VALUES ($usrId, $bonusAmount)";

                        echo "Executing query: $InsertWalletQuery<br>"; // Debug statement
                        
                        if ($conn->query($InsertWalletQuery) === TRUE) {
                            echo "Added .53 rs to the user's wallet (UserID: $usrId)";
                        } else {
                            echo "Error adding .53 rs to the user's wallet: " . $conn->error;
                        }
                    } else {
                        // No user found for the given referral code
                        echo "No user found for referral code: $referalCode";
                        break; // Exit the loop
                    }
                }
            } else {
                echo "Error: " . $insertWalletQuery . "<br>" . $conn->error;
            }
        }
        // Redirect to dashboard.php
        header("Location: /MLM/uinclude/dashboard.php");
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // $conn->close();
} else {
    // Handle non-POST requests
    echo "Invalid request method";
}
?>
