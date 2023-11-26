<?php

session_start();

// include('auth.php');
require_once('../../db_conn.php');

// Retrive credentials to edit profile modal

if (isset($_POST['check_approval_btn'])) {

    $id = $_POST['id'];

    $result_array = [];

    $query = "SELECT * FROM new_service_request WHERE id = '$id'";
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


if (isset($_POST['give_approval'])) {

    // $user_id = $_POST['userId'];

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING); // Sanitize input
    $approval = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    if ($approval === "0") {
        $bool_approval = 1;
    } else if ($approval === "1") {
        $bool_approval = 0;
    }

    // Update data into the table with Image
    $sql = "UPDATE new_service_request SET status = ? WHERE id = ?";

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $stmt = $conn->prepare($sql);
    }
    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt,
            "ii",
            $bool_approval,
            $id
        );
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['status'] = "Service Approved successfully";
            header('Location: ../newrequests.php');

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


?>