<?php
session_start();
require_once('../../db_conn.php');

if (isset($_POST['check_approval_btn'])) {
    $id = $_POST['id'];

    $result_array = [];

    $query = "SELECT * FROM new_service_request WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $result_array[] = $row;

            header('Content-Type: application/json');
            echo json_encode($result_array);
        } else {
            echo json_encode(["error" => "No Record Found"]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["error" => "Error in preparing statement"]);
    }
}

if (isset($_POST['give_approval'])) {
    $id = filter_input(INPUT_POST, 'uId', FILTER_SANITIZE_STRING); // Fix parameter name to match AJAX request
    $approval = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    // Toggle the status value
    $bool_approval = ($approval === "0") ? 1 : 0;

    $sql = "UPDATE new_service_request SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $bool_approval, $id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Service Approved successfully";
            echo json_encode(["success" => "Service Approved successfully"]);
        } else {
            echo json_encode(["error" => "Execution Error: " . mysqli_stmt_error($stmt)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["error" => "Error in preparing statement"]);
    }
}

mysqli_close($conn);
?>
