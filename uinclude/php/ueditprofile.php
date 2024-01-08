<?php

session_start();

// include('auth.php');
require_once('db_conn.php');

// Retrive credentials to edit profile modal

if (isset($_POST['check_proifleedit_btn'])) {

    $user_id = $_POST['userId'];

    $result_array = [];

    $query = "SELECT * FROM user_tbl WHERE uId = '$user_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_assoc($query_run);
        // while ($row = mysqli_fetch_assoc($query_run)) {
        array_push($result_array, $row);
        // }
        header('Content-Type: application/json');
        echo json_encode($result_array);

    } else {
        // echo $return = "<script>alert('Invalid Referral Code')</script>";
        echo $return = "<h5>No Record Found</h5>";
    }
}



// Update profile information
if (isset($_POST['update_profile'])) {

    // $user_id = $_POST['userId'];

    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING); // Sanitize input
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $addr = filter_input(INPUT_POST, 'addr', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $whatsApp = filter_input(INPUT_POST, 'whatsApp', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $pan = filter_input(INPUT_POST, 'pan', FILTER_SANITIZE_STRING);
    $aadhaar = filter_input(INPUT_POST, 'aadhaar', FILTER_SANITIZE_STRING);
    $bank_name = filter_input(INPUT_POST, 'bank_name', FILTER_SANITIZE_STRING);
    $ac_number = filter_input(INPUT_POST, 'ac_number', FILTER_SANITIZE_STRING);
    $ifsc_code = filter_input(INPUT_POST, 'ifsc_code', FILTER_SANITIZE_STRING);

    // $profile_img = filter_input(INPUT_POST, 'profile_img', FILTER_SANITIZE_STRING);

    $user_id = $_SESSION['uId'];

    // Function to generate a unique filename
    function generateUniqueFileName($originalFileName, $index = '')
    {
        $datetime = date('YmdHis'); // Using YmdHis format for a unique filename
        $randomString = substr(md5(mt_rand()), 0, 5);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Get the file extension
        $originalFileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME); // Get the original filename without extension
        return $datetime . '_' . $randomString . '_' . $index . '_' . $originalFileNameWithoutExtension . '.' . $extension;
    }

    // Function to handle image uploads
    function handleImageUpload($file, $index, $targetDirectory)
    {
        global $conn;

        $originalFileName = $file['name'];
        $uniqueFileName = generateUniqueFileName($originalFileName, $index);
        $targetPath = $targetDirectory . $uniqueFileName;

        move_uploaded_file($file['tmp_name'], $targetPath);

        return $targetPath;
    }

    // Handle Verification Image
    $verifyImgPath = handleImageUpload($_FILES['verify_image'], 'verify', '../userUploads/profile/');

    // Handle Bank Image
    $bankImgPath = handleImageUpload($_FILES['bank_image'], 'bank', '../userUploads/profile/');

    // Handle Profile Image
    $profileImgPath = handleImageUpload($_FILES['image'], 'profile', '../userUploads/profile/');

    // Update data into the table with Images
    $sql = "UPDATE user_tbl SET firstName = ?,  lastName = ?, addr = ?, 
            phone = ?, whatsApp = ?, email = ?, dob = ?, pan = ?, 
            aadhaar = ?, bank_name = ?, ac_number = ?,  ifsc_code = ?, 
            verification_img = ?, bank_img = ?, profile_img = ? WHERE uId = ?";

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssssssssssi",
            $firstName,
            $lastName,
            $addr,
            $phone,
            $whatsApp,
            $email,
            $dob,
            $pan,
            $aadhaar,
            $bank_name,
            $ac_number,
            $ifsc_code,
            $verifyImgPath,
            $bankImgPath,
            $profileImgPath,
            $user_id
        );

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Profile Update successfully With Profile Image";
            header('Location: ../userProfile.php');
            exit;
        } else {
            echo "Execution Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
