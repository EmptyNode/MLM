<?php

session_start();

if (!isset($_SESSION['uId'])) {
    header('Location: login.php');
    // exit;
}

require_once 'db_conn.php';


if (isset($_POST['saveService'])) {
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING); // Sanitize input
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING); // Sanitize input
    $addr = filter_input(INPUT_POST, 'addr', FILTER_SANITIZE_STRING); // Sanitize input
    $pincode = filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING); // Sanitize input
    $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING); // Sanitize input
    $whatsapp = filter_input(INPUT_POST, 'whatsapp', FILTER_SANITIZE_STRING); // Sanitize input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); // Sanitize input

    $user_id = $_SESSION['uId'];


    // Check if the image file was uploaded without errors
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedFormats)) {
            $image = $_FILES['image']['tmp_name'];


            // Get the current directory path
            // $currentDir = __DIR__;
            $datetime = date('Y-m-d H:i:s') . '_';
            $compr = 'compre_';

            // Compress the image using imagejpeg() for JPEG images and imagepng() for PNG images
            $compressedImage = $datetime . $_FILES['image']['name'];
            // $uniqueFileName = 'compressed_' . $_FILES['image']['name'];

            // Generate unique filename
            // $originalFileName = $_FILES['image']['name'];
            $originalFileName = $_FILES['image']['name'];
            $uniqueFileName = generateUniqueFileName($originalFileName);

            $targetPath = "../userUploads/" . $uniqueFileName; // Set the target path            



            if ($imageFileType === "jpeg" || $imageFileType === "jpg") {
                $source = imagecreatefromjpeg($image);
                imagejpeg($source, $targetPath, 60); // Compression quality of 60%
            } elseif ($imageFileType === "png") {
                $source = imagecreatefrompng($image);
                imagepng($source, $targetPath, 6); // Compression level of 6 (0-9)
            }

            $imagetargetPath = 'MLM/AnkanDa/uinclude/userUploads/' . $targetPath;



            // Validate input
            if (empty($service)) {
                echo "Service is required.";
                exit;
            }

            // Insert new data into the table along with user_id using prepared statement
            $sql = "INSERT INTO service_master (service, location, addr, pin, mobile, whatsapp, email, img, user_id) VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // ('$service', '$location', '$addr', '$pincode', '$mobile', '$whatsapp', '$email', '$user_id')";
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            } else {
                $stmt = $conn->prepare($sql);
            }

            if ($stmt) {
                $stmt->bind_param("ssssssssi", $service, $location, $addr, $pincode, $mobile, $whatsapp, $email, $imagetargetPath, $user_id);
                // $stmt->bind_param("ssssssssi", $service, $location, $addr, $pincode, $mobile, $whatsapp, $email, $user_id);
                // $stmt->bind_param(':service', $service);
                // $stmt->bind_param(':location', $location);
                // $stmt->bind_param(':addr', $addr);
                // $stmt->bind_param(':pincode', $pincode);
                // $stmt->bind_param(':mobile', $mobile);
                // $stmt->bind_param(':whatsapp', $whatsapp);
                // $stmt->bind_param(':email', $email);
                // $stmt->bind_param(':user_id', $user_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $_SESSION['status'] = "Service added successfully";
                    header('Location: ../areamaster.php');
                    exit;
                } else {
                    echo "Execution Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error();
            }

            $conn->close();
        } else {
            echo "Invalid image format. Allowed formats: jpg, jpeg, png, gif.";
        }
    } else {
        echo "Error uploading image: " . $_FILES['image']['error'];
    }
}


// function generateUniqueFileName($originalFileName, $index = '') {
//     // $timestamp = time();
//     $datetime = date('Y-m-d H:i:s');
//     $randomString = substr(md5(mt_rand()), 0, 5);
//     // return '_' . $datetime . $randomString . $index . $originalFileName;
//     return '_' . $datetime . $randomString . $index;
// }


function generateUniqueFileName($originalFileName, $index = '')
{
    $datetime = date('YmdHis'); // Using YmdHis format for a unique filename
    $randomString = substr(md5(mt_rand()), 0, 5);
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Get the file extension
    $originalFileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME); // Get the original filename without extension
    return $datetime . '_' . $randomString . '_' . $index . '_' . $originalFileNameWithoutExtension . '.' . $extension;
}
?>