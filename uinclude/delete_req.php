<?php

include('php/db_conn.php');
echo "hi";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $smId = $_POST["id"];

    // Include your existing database connection

    $sql = "DELETE FROM new_service_request WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $smId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Close the database connection (if not using persistent connection)
    mysqli_close($conn);
}
?>