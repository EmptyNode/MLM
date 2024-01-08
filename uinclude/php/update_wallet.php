<?php
// update_wallet.php

// Include or require your database connection file
include('db_conn.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment'])) {
    // Get the userId, amount, and referral code from the POST data
    $userId = $_POST['userId'];
    $amount = $_POST['amount'];
    $referralCode = $_POST['referel'];

    // Validate and sanitize the input if needed

    // Function to get parent information recursively
function getParentInfo($userId, $conn, &$hierarchy, $maxSize) {
    // Fetch user information based on userId
    $query = "SELECT uId, parent_id FROM user_tbl WHERE uId = $userId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userInfo = array('uId' => $row['uId'], 'parent_id' => $row['parent_id']);

        // If parent_id is not 0 and hierarchy size is less than maxSize, recursively get parent information
        if ($row['parent_id'] != 0 && count($hierarchy) < $maxSize) {
            $parentInfo = getParentInfo($row['parent_id'], $conn, $hierarchy, $maxSize);
            $userInfo['parentInfo'] = $parentInfo;
        }

        // Add the user information to the hierarchy array
        $hierarchy[] = $userInfo;
    }

    return $userInfo;
}

// Your database connection code here
// $conn = mysqli_connect("localhost", "username", "password", "database");

// Assuming you have the current user's ID
$currentUser = $userId; // Replace with the actual userId

// Set the maximum hierarchy size you want to retrieve
$maxHierarchySize = 10;

// Initialize the hierarchy array
$userHierarchy = array();

// Call the function to get parent information
getParentInfo($currentUser, $conn, $userHierarchy, $maxHierarchySize);

// Calculate the hierarchy size
$hierarchySize = count($userHierarchy);

// Output the result
echo "User Hierarchy: ";
print_r($userHierarchy);
echo "Hierarchy Size: $hierarchySize";

$settings_query = "SELECT jb, md FROM settings";
$set_res = mysqli_query($conn, $settings_query);
if ($set_res && mysqli_num_rows($set_res) > 0) {
    $setrow = mysqli_fetch_assoc($set_res);
    $jb = $setrow['jb'];
    $md = $setrow['md'];
}

    // Use prepared statements to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO wallet (uId, amount, details) VALUES (?, ?, 'joining bonus')");
    $sql->bind_param("id", $userId, $jb);

    if ($sql->execute()) {
        echo "Payment successful.";
         // Update payment status in another table
         $updatePaymentStatusQuery = $conn->prepare("UPDATE user_tbl SET payment_status = 1 WHERE uId = ?");
         $updatePaymentStatusQuery->bind_param("i", $userId);
         $updatePaymentStatusQuery->execute();

        // Find userId based on referral code
        $findUserIdQuery = $conn->prepare("SELECT uId FROM user_tbl WHERE auto_referralcode = ?");
        $findUserIdQuery->bind_param("s", $referralCode);
        $findUserIdQuery->execute();
        $result = $findUserIdQuery->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usrId = $row['uId'];

            // Insert a new row into your wallet table for the referrer
            $insertWalletQuery = $conn->prepare("INSERT INTO wallet (uId, amount) VALUES (?, ?)");
            $insertWalletQuery->bind_param("id", $usrId, $jb);

            $dis_am = $md / $hierarchySize;
            if ($insertWalletQuery->execute()) {
                echo "Payment successful.";

                // For loop
                for ($i = 0; $i < 15; $i++) {
                    echo "Iteration $i<br>"; // Debug statement

                    // Find userId and referral code based on the referral code
                    $findUIdQuery = $conn->prepare("SELECT uId, referralCode FROM user_tbl WHERE auto_referralCode = ?");
                    $findUIdQuery->bind_param("s", $referralCode);
                    $res = $findUIdQuery->execute();
                    $res = $findUIdQuery->get_result();

                    if ($res === FALSE) {
                        echo "Error in query: " . $conn->error;
                        break; // Exit the loop on query error
                    }

                    if ($res && $res->num_rows > 0) {
                        $row = $res->fetch_assoc();
                        $usrId = $row['uId'];
                        $referralCode = $row['referralCode'];
                        $bonusAmount = ($i === 0) ? 0 : $dis_am; // Assign different bonus amounts based on the level

                        // Insert a new row into your wallet table
                        // Adding the calculated bonus amount to the user's wallet
                        $insertWalletQuery = $conn->prepare("INSERT INTO wallet (uId, amount, details) VALUES (?, ?, 'child referral bonus')");
                        $insertWalletQuery->bind_param("id", $usrId, $bonusAmount);

                        echo "Executing query: $InsertWalletQuery<br>"; // Debug statement

                        if ($insertWalletQuery->execute()) {
                            echo "Added $bonusAmount rs to the user's wallet (UserID: $usrId)";
                        } else {
                            echo "Error adding $bonusAmount rs to the user's wallet: " . $conn->error;
                        }
                    } else {
                        // No user found for the given referral code
                        echo "No user found for referral code: $referralCode";
                        break; // Exit the loop
                    }
                }
            } else {
                echo "Error: " . $conn->error;
            }
        }

        // Redirect to dashboard.php
        header("Location: /MLM/uinclude/dashboard.php");
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $conn->error;
    }

    // Close prepared statements
    $sql->close();
    $findUserIdQuery->close();
    $insertWalletQuery->close();
    $updatePaymentStatusQuery->close();
} else {
    // Handle non-POST requests
    echo "Invalid request method";
}
?>
