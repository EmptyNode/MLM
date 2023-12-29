<?php
include_once("../db_conn.php");
$connString = $conn;

// Fetch records based on the date range
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : null;

$sql_query = "SELECT iTime, firstName, parent_id, mobile, auto_referralCode FROM user_tbl";

if ($startDate && $endDate) {
    $sql_query .= " WHERE iTime BETWEEN '$startDate' AND '$endDate'";
}

$resultset = mysqli_query($connString, $sql_query) or die("database error:" . mysqli_error($conn));
$tasks = array();

while ($rows = mysqli_fetch_assoc($resultset)) {
    $tasks[] = $rows;
}

if (isset($_POST["ExportType"]) && $_POST["ExportType"] === "export-to-excel") {
    $filename = "user_report_" . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($tasks);
    exit();
}

function ExportFile($records) {
    $heading = false;
    if (!empty($records)) {
        foreach ($records as $row) {
            if (!$heading) {
                // Display field/column names as the first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit;
}
?>
