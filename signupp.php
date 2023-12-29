<?php
require_once "db_conn.php"; // Include the database connection file

if (isset($_POST['register'])) {
    // $firstName = $_POST['firstName'];
    // $lastName = $_POST['lastName'];
    // $addr = $_POST['addr'];
    // $phone = $_POST['phone'];
    // $aadhaar = $_POST['aadhaar'];
    $mobile = $_POST['mobile'];
    // $whatsApp = $_POST['whatsApp'];
    $referralCode = $_POST['refferalCode'];
    $password = $_POST['password'];
    $confPassword = $_POST['conf-password'];

    // Confirm password validation
    if ($password !== $confPassword) {
        echo "Password and confirm password do not match.";
        exit;
    }

    // check if already exists
    $checkSql = "SELECT COUNT(*) as count FROM user_tbl WHERE mobile = '$mobile'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult === false) {
        echo "Error executing query: " . $conn->error;
        exit;
    }

    $row = $checkResult->fetch_assoc();
    if ($row['count'] > 0) {
        echo "Error: Mobile number already exists.";
        exit;
    }

    if (!empty($referralCode)) {
        // Find the user with the given referral code
        $referralSql = "SELECT uId FROM user_tbl WHERE auto_referralCode = '$referralCode'";
        $referralResult = $conn->query($referralSql);

        if ($referralResult === false) {
            echo "Error executing query: " . $conn->error;
            exit;
        }

        $referralRow = $referralResult->fetch_assoc();
        if ($referralResult->num_rows > 0) {
            $parentId = $referralRow['uId'];
        } else {
            echo "Error: Referral code not found.";
            exit;
        }
    } else {
        $parentId = 0; // No referral code provided, set parent_id to 0
    }

    // Generate a unique 6-digit alphanumeric referral code
    $auto_referralCode = generateReferralCode($conn);

    // Hash the password before storing in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the database
    // $sql = "INSERT INTO user_tbl (firstName, lastName, addr, phone, aadhaar, mobile, whatsApp, referralCode, auto_referralCode, password) VALUES ('$firstName', '$lastName', '$addr', '$phone', '$aadhaar', '$mobile', '$whatsApp', '$referralCode', '$auto_referralCode', '$hashedPassword')";
    $sql = "INSERT INTO user_tbl (mobile, referralCode, auto_referralCode, password, parent_id) VALUES ('$mobile', '$referralCode', '$auto_referralCode', '$hashedPassword', '$parentId')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error();
    }

    $conn->close(); // Close the database connection
}

// Function to generate a unique 6-digit alphanumeric referral code
function generateReferralCode($conn)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $auto_referralCode = '';
    $codeLength = 6;

    // Generate the referral code
    for ($i = 0; $i < $codeLength; $i++) {
        $auto_referralCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Check if the generated code already exists in the database
    $sql = "SELECT COUNT(*) as count FROM user_tbl WHERE auto_referralCode = '$auto_referralCode'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
        return null;
    }

    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        // If the code exists, generate a new one
        return generateReferralCode($conn);
    } else {
        // If the code is unique, return it
        return $auto_referralCode;
    }
}
?>