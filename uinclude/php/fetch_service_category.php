<?php
// Connect to your database here
require_once('db_conn.php');

$query = "SELECT s_category FROM service_category";
$result = $conn->query($query);

$options = array();
while ($row = $result->fetch_assoc()) {
    $options[] = $row;
}

echo json_encode($options);
?>