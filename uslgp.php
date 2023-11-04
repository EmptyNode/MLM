<?php
session_start();
require_once 'db_conn.php'; // Include the database connection file

if (isset($_POST['login'])) {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // SQL query to fetch user data based on the provided mobile
    $sql = "SELECT * FROM user_tbl WHERE mobile = '$mobile'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        
        $session_id=session_id();
        $_SESSION['LOG_AUTH']=$session_id;


        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['uId'] = $row['uId'];
            $_SESSION['mobile'] = $row['mobile'];
            $user_id = $_SESSION['uId'];
            // Redirect to dashboard with user data
            header('Location: uinclude/dashboard.php?uId=' . $row['uId'] . '&mobile=' . $row['mobile'], $_SESSION['LOG_AUTH']);
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