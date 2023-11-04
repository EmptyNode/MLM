<?php

require_once('../db_conn.php');

// Fetch pincode suggestions from the database
$sql = "SELECT DISTINCT pin FROM service_master";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<ul class="list-unstyled">';

    while ($row = $result->fetch_assoc()) {
        echo '<li><a class="dropdown-item" href="#">' . $row['pin'] . '</a></li>';
    }

    echo '</ul>';
} else {
    echo 'No results found.';
}

?>