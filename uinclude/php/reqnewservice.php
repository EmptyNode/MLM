<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include necessary files and perform authentication checks
if (!isset($_SESSION['uId'])) {
    header('Location: login.php');
    // exit;
}

require_once 'db_conn.php';

if (isset($_POST['reqService'])) {
    // Retrieve form inputs and perform basic sanitation
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $pincode = filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    // Check if the image files were uploaded without errors
    $image1 = $_FILES['image1'];
    $image2 = $_FILES['image2'];
    $image3 = $_FILES['image3'];

    $validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    // Function to check if an uploaded file is a valid image
    function isImageValid($file)
    {
        global $validImageTypes;

        if ($file['error'] === UPLOAD_ERR_OK && in_array($file['type'], $validImageTypes)) {
            return true;
        }
        return false;
    }

    if (isImageValid($image1) && isImageValid($image2) && isImageValid($image3)) {
        // All uploaded images are valid

        // Generate unique file names for images
        $image1FileName = generateUniqueFileName($image1['name'], 1, $conn);
        $image2FileName = generateUniqueFileName($image2['name'], 2, $conn);
        $image3FileName = generateUniqueFileName($image3['name'], 3, $conn);


        // Define the target paths for the images
        $targetPath1 = "../userUploads/" . $image1FileName;
        $targetPath2 = "../userUploads/" . $image2FileName;
        $targetPath3 = "../userUploads/" . $image3FileName;

        // Move the uploaded images to their target paths
        move_uploaded_file($image1['tmp_name'], $targetPath1);
        move_uploaded_file($image2['tmp_name'], $targetPath2);
        move_uploaded_file($image3['tmp_name'], $targetPath3);

        // Get the user ID from the session
        $user_id = $_SESSION['uId'];

        // Insert the new service request into the database
        $sql = "INSERT INTO new_service_request (name, pincode, description, image1, image2, image3, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if (!$conn) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error in preparing statement: " . $conn->error);
            }
        }
        

        if ($stmt) {
            $stmt->bind_param("ssssssi", $name, $pincode, $addr, $image1FileName, $image2FileName, $image3FileName, $user_id);

            if ($stmt->execute()) {
                $_SESSION['status'] = "Service request added successfully";
                header('Location: ../areamaster.php');
                exit;
            } else {
                echo "Execution Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;

        }
    } else {
        echo "Invalid image format. Allowed formats: jpg, jpeg, png.";
    }
}

// Function to generate a unique filename
function generateUniqueFileName($originalFileName, $index, $conn)
{
    // if ($conn) {
    //     $conn->close(); // Close the connection when done
    // }
    
    $datetime = date('YmdHis'); // Using YmdHis format for a unique filename
    $randomString = substr(md5(mt_rand()), 0, 5);
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Get the file extension
    $originalFileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME); // Get the original filename without extension
    return $datetime . '_' . $randomString . '_' . $index . '_' . $originalFileNameWithoutExtension . '.' . $extension;
}
?>
