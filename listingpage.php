<?php
require_once('db_conn.php');

// Get selected pincode and category from GET parameters
$pincode = isset($_GET['pincode']) ? $_GET['pincode'] : '';
$service = isset($_GET['service']) ? $_GET['service'] : '';


// Modify your database query to fetch data based on pincode and/or category
$sql = "SELECT * FROM service_master WHERE 1"; // Initial query

if (!empty($pincode)) {
    $sql .= " AND pin = '$pincode'";
}

if (!empty($service)) {
    $sql .= " AND service = '$service'";
}

$result = $conn->query($sql);
// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Document</title>
</head>

<body>

    <?php include('./navbar.php'); ?>

    <div class="container">
        <h1 class="mt-4 mb-4">Listings</h1>
        <div class="row row-cols-8 row-cols-md-8 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="row mb-4">
                            <div class="col p-1">
                                <div class="card p-3" style="max-width: 1000px; height: 270px; background-color: #f8f9fa;">
                                    <div class="row no-gutters ">
                                        <div class="col-md-3" style="width: 100px; height: 100px;">
                                            <img src=' . $row["img"] . ' class="card-img img-fluid rounded"></img>
                                        </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . $row["service"] . '</h5>
                                                    <P class="card-title">' . $row["addr"] . '</P>
                                                    <div class="d-flex justify-content-end">
                                                       <!-- <a href="#" class="btn btn-primary">View</a> -->
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>';
                }
            } else {
                echo '<p>No listings found for this category.</p>';
            }
            ?>
        </div>
    </div>


</body>