<?php

session_start();
require_once('../../db_conn.php');

if (isset($_POST['check_approval_btn'])) {
    $id = $_POST['id'];

    $result_array = [];

    $query = "SELECT * FROM new_service_request WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        array_push($result_array, $row);

        header('Content-Type: application/json');
        echo json_encode($result_array);
    } else {
        echo "<h5>No Record Found</h5>";
    }
}

if (isset($_POST['give_approval'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $approval = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    // Toggle the status value
    $bool_approval = ($approval === "0") ? 1 : 0;

    $sql = "UPDATE new_service_request SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $bool_approval, $id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Service Approved successfully";
            header('Location: ../newrequests.php');
            exit;
        } else {
            echo "Execution Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
