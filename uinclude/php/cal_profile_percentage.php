<?php
include '../db_conn.php';

// Retrieve user data from the database based on the logged-in user's ID
$user_id = $_SESSION['uId']; // Assuming user ID is stored in the session
//echo ($user_id);
//$user_id = $_SESSION['LOG_AUTH']; // Assuming user ID is stored in the session
$sql = "SELECT * FROM user_tbl WHERE uId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user data
$userData = $result->fetch_assoc();
$stmt->close();

// Calculate profile completion percentage based on filled fields
$totalFields = 14; // Total number of fields contributing to the profile completion
$filledFields = 0; // Count the number of filled fields

// Check each field and count filled fields
if (!empty($userData['firstName'])) {
    $filledFields++;
}
if (!empty($userData['lastName'])) {
    $filledFields++;
}
if (!empty($userData['mobile'])) {
    $filledFields++;
}
if (!empty($userData['addr'])) {
    $filledFields++;
}
if (!empty($userData['phone'])) {
    $filledFields++;
}
if (!empty($userData['whatsApp'])) {
    $filledFields++;
}
if (!empty($userData['email'])) {
    $filledFields++;
}
if (!empty($userData['dob'])) {
    $filledFields++;
}
if (!empty($userData['pan'])) {
    $filledFields++;
}
if (!empty($userData['aadhaar'])) {
    $filledFields++;
}
if (!empty($userData['bank_name'])) {
    $filledFields++;
}
if (!empty($userData['ac_number'])) {
    $filledFields++;
}
if (!empty($userData['ifsc_code'])) {
    $filledFields++;
}
if (!empty($userData['profile_img'])) {
    $filledFields++;
}

// Calculate the profile completion percentage
$profileCompletionPercentage = ($filledFields / $totalFields) * 100;
$profileCompletionPercentage = round($profileCompletionPercentage); // Round to the nearest integer
//echo ($profileCompletionPercentage);

// Calculate the completion percentage (replace 100 with the actual completion percentage)
if ($profileCompletionPercentage >= 99.5) {
    $completionPercentage = 100;
} else {
    $completionPercentage = $profileCompletionPercentage;
}
//echo ($completionPercentage);


// Determine the bar color based on completion percentage
$barColor = $completionPercentage === 100 ? 'green' : 'red';

// Determine the text color and size based on completion percentage
$textColor = $completionPercentage === 100 ? 'white' : 'white';
$textSize = $completionPercentage === 100 ? '16px' : '16px';

?>