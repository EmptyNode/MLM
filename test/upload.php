<?php
// Include or require your database connection file
session_start();

require_once('db_conn.php');

if(isset($_POST['submit'])){
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);

    $sql = $conn->prepare("INSERT INTO user_tbl (bank_image) VALUES (?)");
    $sql->bind_param("s", $image);

    if($sql->execute()){
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>