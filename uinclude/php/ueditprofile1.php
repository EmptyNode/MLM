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


    // Handle Verification Images
    if ($_FILES['verify_image']['error'] === UPLOAD_ERR_OK && isset($_FILES['verify_image'])) {

        // if (!empty($_FILES['verify_image']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES['verify_image']['name'], PATHINFO_EXTENSION));
        // Check if the uploaded file is an image
        $allowedFormats = array("jpg", "jpeg", "png", "pdf");
        if (in_array($imageFileType, $allowedFormats)) {
            $image = $_FILES['verify_image']['tmp_name'];

            // Compress the image using imagejpeg() for JPEG images and imagepng() for PNG images
            $compressedImage = $datetime . $_FILES['verify_image']['name'];

            // Generate unique filename
            // $originalFileName = $_FILES['image']['name'];
            $originalFileName = $_FILES['verify_image']['name'];
            $uniqueFileName = generateUniqueFileName($originalFileName);

            $targetPath = "../userUploads/verificationImg/" . $uniqueFileName; // Set the target path            

            if ($imageFileType === "jpeg" || $imageFileType === "jpg") {
                $source = imagecreatefromjpeg($image);
                imagejpeg($source, $targetPath, 60); // Compression quality of 60%
            } elseif ($imageFileType === "png") {
                $source = imagecreatefrompng($image);
                imagepng($source, $targetPath, 6); // Compression level of 6 (0-9)
            }

            $verifyimgtargetPath = '/AnkanDa/uinclude/userUploads/verificationImg/' . $uniqueFileName;

            // Update data into the table with Image
            $sql = "UPDATE user_tbl SET verification_img = ? WHERE uId = ?";

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $stmt = $conn->prepare($sql);
            }
            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "si",
                    $verifyimgtargetPath,
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
                echo "Error: " . $conn->error();
            }

            // $conn->close();
            mysqli_stmt_close($stmt);

        } else {
            echo "Invalid image format. Allowed formats: jpg, jpeg, png, pdf.";
        }
    } else {
        // echo "Error uploading image: " . $_FILES['image']['error'];

        // Update data into the table with Image
        $sql = "UPDATE user_tbl SET firstName = ?,  lastName = ?, addr = ?, 
        phone = ?, whatsApp = ?, email = ?, dob = ?, pan = ?, 
        aadhaar = ?, bank_name = ?, ac_number = ?,  ifsc_code = ? WHERE uId = ?";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $stmt = $conn->prepare($sql);
        }
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssssssssssssi",
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
                $user_id
            );
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = "Profile Update successfully";
                header('Location: ../userProfile.php');
                exit;
            } else {
                echo "Execution Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error();
        }

        // $conn->close();
        mysqli_stmt_close($stmt);
    }





    // Handle Bank Images
    if ($_FILES['bank_image']['error'] === UPLOAD_ERR_OK && isset($_FILES['bank_image'])) {

        // if (!empty($_FILES['bank_image']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES['bank_image']['name'], PATHINFO_EXTENSION));
        // Check if the uploaded file is an image
        $allowedFormats = array("jpg", "jpeg", "png", "pdf");
        if (in_array($imageFileType, $allowedFormats)) {
            $image = $_FILES['bank_image']['tmp_name'];

            // Compress the image using imagejpeg() for JPEG images and imagepng() for PNG images
            $compressedImage = $datetime . $_FILES['bank_image']['name'];

            // Generate unique filename
            // $originalFileName = $_FILES['image']['name'];
            $originalFileName = $_FILES['bank_image']['name'];
            $uniqueFileName = generateUniqueFileName($originalFileName);

            $targetPath = "../userUploads/bankImg/" . $uniqueFileName; // Set the target path            

            if ($imageFileType === "jpeg" || $imageFileType === "jpg") {
                $source = imagecreatefromjpeg($image);
                imagejpeg($source, $targetPath, 60); // Compression quality of 60%
            } elseif ($imageFileType === "png") {
                $source = imagecreatefrompng($image);
                imagepng($source, $targetPath, 6); // Compression level of 6 (0-9)
            }

            $bankimgtargetPath = '/AnkanDa/uinclude/userUploads/bankImg/' . $uniqueFileName;

            // Update data into the table with Image
            $sql = "UPDATE user_tbl SET bank_img = ? WHERE uId = ?";

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $stmt = $conn->prepare($sql);
            }
            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "si",
                    $bankimgtargetPath,
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
                echo "Error: " . $conn->error();
            }

            // $conn->close();
            mysqli_stmt_close($stmt);

        } else {
            echo "Invalid image format. Allowed formats: jpg, jpeg, png, pdf.";
        }
    } else {
        // echo "Error uploading image: " . $_FILES['image']['error'];

        // Update data into the table with Image
        $sql = "UPDATE user_tbl SET firstName = ?,  lastName = ?, addr = ?, 
        phone = ?, whatsApp = ?, email = ?, dob = ?, pan = ?, 
        aadhaar = ?, bank_name = ?, ac_number = ?,  ifsc_code = ? WHERE uId = ?";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $stmt = $conn->prepare($sql);
        }
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssssssssssssi",
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
                $user_id
            );
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = "Profile Update successfully";
                header('Location: ../userProfile.php');
                exit;
            } else {
                echo "Execution Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error();
        }

        // $conn->close();
        mysqli_stmt_close($stmt);
    }



    // Check if the image file was uploaded without errors
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK && isset($_FILES['image'])) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $allowedFormats = array("jpg", "jpeg", "png", "pdf");
        if (in_array($imageFileType, $allowedFormats)) {
            $image = $_FILES['image']['tmp_name'];


            // Get the current directory path
            // $currentDir = __DIR__;
            //$datetime = date('Y-m-d H:i:s') . '_';
            //$compr = 'compre_';

            // Compress the image using imagejpeg() for JPEG images and imagepng() for PNG images
            $compressedImage = $datetime . $_FILES['image']['name'];
            // $uniqueFileName = 'compressed_' . $_FILES['image']['name'];

            // Generate unique filename
            // $originalFileName = $_FILES['image']['name'];
            $originalFileName = $_FILES['image']['name'];
            $uniqueFileName = generateUniqueFileName($originalFileName);

            $targetPath = "../userUploads/profileImg/" . $uniqueFileName; // Set the target path            



            if ($imageFileType === "jpeg" || $imageFileType === "jpg") {
                $source = imagecreatefromjpeg($image);
                imagejpeg($source, $targetPath, 60); // Compression quality of 60%
            } elseif ($imageFileType === "png") {
                $source = imagecreatefrompng($image);
                imagepng($source, $targetPath, 6); // Compression level of 6 (0-9)
            }

            $imagetargetPath = '/AnkanDa/uinclude/userUploads/profileImg/' . $uniqueFileName;


            // Update data into the table with Image
            $sql = "UPDATE user_tbl SET firstName = ?,  lastName = ?, addr = ?, 
            phone = ?, whatsApp = ?, email = ?, dob = ?, pan = ?, 
            aadhaar = ?, bank_name = ?, ac_number = ?,  ifsc_code = ?, 
            profile_img = ? WHERE uId = ?";

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $stmt = $conn->prepare($sql);
            }
            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssssssssi",
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
                    $imagetargetPath,
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
                echo "Error: " . $conn->error();
            }

            // $conn->close();
            mysqli_stmt_close($stmt);

        } else {
            echo "Invalid image format. Allowed formats: jpg, jpeg, png, gif.";
        }
    } else {
        // echo "Error uploading image: " . $_FILES['image']['error'];

        // Update data into the table with Image
        $sql = "UPDATE user_tbl SET firstName = ?,  lastName = ?, addr = ?, 
        phone = ?, whatsApp = ?, email = ?, dob = ?, pan = ?, 
        aadhaar = ?, bank_name = ?, ac_number = ?,  ifsc_code = ? WHERE uId = ?";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $stmt = $conn->prepare($sql);
        }
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "ssssssssssssi",
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
                $user_id
            );
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = "Profile Update successfully";
                header('Location: ../userProfile.php');
                exit;
            } else {
                echo "Execution Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error();
        }

        // $conn->close();
        mysqli_stmt_close($stmt);
    }
}




function generateUniqueFileName($originalFileName, $index = '')
{
    $datetime = date('YmdHis'); // Using YmdHis format for a unique filename
    $randomString = substr(md5(mt_rand()), 0, 5);
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Get the file extension
    $originalFileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME); // Get the original filename without extension
    return $datetime . '_' . $randomString . '_' . $index . '_' . $originalFileNameWithoutExtension . '.' . $extension;
}

?>