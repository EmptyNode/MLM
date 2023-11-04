<?php
require_once 'db_conn.php'; // Include the database connection file

if (isset($_POST['checkType']) && isset($_POST['value'])) {
    $checkType = $_POST['checkType'];
    $value = $_POST['value'];

    if ($checkType === 'referralCode') {
        // SQL query to check if referral code exists in the database
        $sql = "SELECT * FROM user_tbl WHERE auto_referralCode = '$value'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo 'valid';
        } else {
            echo 'invalid';
        }
    } elseif ($checkType === 'mobile') {
        // SQL query to check if mobile number exists in the database
        $sql = "SELECT * FROM user_tbl WHERE mobile = '$value'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo 'exist';
        } else {
            echo 'available';
        }
    }
    
    $conn->close(); // Close the database connection
}
?>