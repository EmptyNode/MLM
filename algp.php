<?php
session_start();
require_once 'db_conn.php'; // Include the database connection file

if (isset($_POST['adminlogin'])) {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    // SQL query to fetch user data based on the provided mobile
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        $session_id = session_id();
        $_SESSION['LOG_AUTH'] = $session_id;


        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['id'] = $row['id'];
            // $_SESSION['mobile'] = $row['mobile'];
            $admin_id = $_SESSION['id'];
            // Redirect to dashboard with user data
            header('Location: ainclude/dashboard.php', $_SESSION['LOG_AUTH']);
            exit();
        } else {
            // Password is incorrect, show error message
            header('Location: index.php?error=1'); // Redirect to login page with error parameter
            exit();
        }
    } else {
        // User not found, show error message
        header('Location: index.php?error=1'); // Redirect to login page with error parameter
        exit();
    }
}

$conn->close(); // Close the database connection
?>