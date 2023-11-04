<?php
// Include database connection and other necessary files

require_once('../db_conn.php');

$sql = "SELECT * FROM listings WHERE category = '$category'";
$result = $conn->query($sql);

$listings = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listings[] = $row;
    }
}

// Include the HTML template
include "listingpage.php";
?>