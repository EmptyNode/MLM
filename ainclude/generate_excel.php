<?php
// Include database connection file
include_once("../db_conn.php");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

// echo "Start Date: $start_date\n";
// echo "End Date: $end_date\n";

// Fetch records based on the date range
$sql_query = "SELECT firstName, parent_id, mobile, auto_referralCode FROM user_tbl";

if (!empty($start_date) && !empty($end_date)) {
    $sql_query .= " WHERE iTime BETWEEN '$start_date' AND '$end_date'";
}

$resultset = mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));
$tasks = array();

while ($rows = mysqli_fetch_assoc($resultset)) {
    $tasks[] = $rows;
}

$networkQuery = "SELECT uId, parent_id FROM user_tbl WHERE parent_id IS NOT NULL";
$networkResultset = mysqli_query($conn, $networkQuery) or die("database error:" . mysqli_error($conn));
$networkTasks = array();
while ($networkRows = mysqli_fetch_assoc($networkResultset)) {
    $networkTasks[] = $networkRows;
}


$paymentQuery = "SELECT * FROM withdraw";
if (!empty($start_date) && !empty($end_date)) {
    $paymentQuery .= " WHERE date BETWEEN '$start_date' AND '$end_date'";
}
$paymentResultset = mysqli_query($conn, $paymentQuery) or die("database error:" . mysqli_error($conn));
$paymentTasks = array();
while ($paymentRows = mysqli_fetch_assoc($paymentResultset)) {
    $paymentTasks[] = $paymentRows;
}

$pinQuery = "SELECT pincode, user_id FROM new_service_request";
$pinResultset = mysqli_query($conn, $pinQuery) or die("database error:" . mysqli_error($conn));
$pintTasks = array();
while ($pinRows = mysqli_fetch_assoc($pinResultset)) {
    $pinTasks[] = $pinRows;
}

$pnlQuery = "SELECT amount FROM withdraw WHERE status = 1";
$pnlResultset = mysqli_query($conn, $pnlQuery) or die("Database error: " . mysqli_error($conn));
$pnlTasks = array();
while ($pnlRows = mysqli_fetch_assoc($pnlResultset)) {
    $pnlTasks[] = $pnlRows['amount'];
}

// Calculating the total amount
$totalAmount = array_sum($pnlTasks);

// Fetching uId from the "user_tbl" table where payment_status is 1
$uidQuery = "SELECT uId FROM user_tbl WHERE payment_status = 1";
$uidResultset = mysqli_query($conn, $uidQuery) or die("Database error: " . mysqli_error($conn));

// Counting the number of rows in the resultset
$userCount = mysqli_num_rows($uidResultset);

// Multiplying the user count by 99
$finalValue = $userCount * 99;

$pnlarray = [
    'User Count' => $userCount,
    'Final Value' => $finalValue,
    'Payment' => $totalAmount,
    'Diffrence' => $finalValue - $totalAmount
];

// Check if ExportType is set in the POST request
if (isset($_POST["ExportType"])) {
    switch ($_POST["ExportType"]) {
        case "export-joining-excel":
            generateExcel("user_report", $tasks, ['firstName', 'parent_id', 'mobile', 'auto_referralCode']);
            break;
        case "export-network-excel":
            generateExcel("network_report", $networkTasks, ['userId', 'parent']);
            break;
        case "export-payment-excel":
            generateExcel("payment_report", $paymentTasks, ['req_id', 'user_id', 'amount', 'status', 'date']);
            break;
        case "export-pnl-excel":
            generateExcel("pnl_report", [$pnlarray], ['User Count', 'Final Value', "Payment", "Diffrence"]);
            break;
        case "export-pincode-excel":
            generateExcel("pincode", $pinTasks, ['pincode', 'user_id']);
            break;
            // Add more cases for other export options as needed
        default:
            // Handle the default case or additional cases here
            break;
    }
}

// Close the database connection
mysqli_close($conn);


function generateExcel($reportType, $records, $columns = [])
{
    $filename = $reportType . "_" . date('Ymd') . ".xls";

    // Set appropriate Content-Type header based on the Excel format
    header("Content-Type: application/vnd.ms-excel");
    // OR header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($records, $columns);
    exit();
}

function ExportFile($records, $columns)
{
    $heading = false;
    if (!empty($records)) {
        foreach ($records as $row) {
            if (!$heading) {
                // Display field/column names as the first row
                echo implode("\t", $columns) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit;
}
