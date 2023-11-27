<?php
include('../db_conn.php');
$user_id = $_SESSION['uId'];
// echo "id : " . $user_id;
$query = "SELECT * FROM user_tbl WHERE uId = '$user_id'";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    $result = mysqli_fetch_assoc($query_run);
}


if (isset($_SESSION['uId'])) {
    $user_id = $_SESSION['uId'];

    $query = "SELECT approval_status, profile_img FROM user_tbl WHERE uId = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $approvalStatus, $profileImg);

        if (mysqli_stmt_fetch($stmt)) {
            $profilepic = ($approvalStatus == 1) ? 'green' : 'red';
        } else {
            // Handle the case where the user is not found or an error occurred
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the case where the statement couldn't be prepared
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/upanel.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf-8"></script>
</head>


<body>
    <div class="col-md-10" style="padding-left: 0; padding-right: 0">
        <div class="container-fluid" style="padding-left: 0; padding-right: 0">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="logo-apple-appstore"></ion-icon>
                            </span>
                            <span class="title">Brand Name</span>
                        </a>
                    </li>
                    <li>
                        <a href="../uinclude/dashboard.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../uinclude/areamaster.php">
                            <span class="icon">
                                <ion-icon name="locate-outline"></ion-icon>
                            </span>
                            <span class="title">Area Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="../uinclude/newservicemaster.php">
                            <span class="icon">
                                <ion-icon name="add-circle-outline"></ion-icon>
                            </span>
                            <span class="title">Request Service</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="../uinclude/userProfile.php">
                            <span class="icon">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <span class="title">User Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="../auth_out.php">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">LogOut</span>
                        </a>
                    </li>
                </ul>
            </div>



            <!-- main -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="grid-outline"></ion-icon>
                    </div>

                    <!-- Referral Link -->
                    <div>

                        <div class="d-flex">
                            <div style="width: 400px; border: 1px solid #05a722; padding: 5px;">
                                <a href="<?php echo 'http://localhost/ankanda/?refer=' . $result['auto_referralCode']; ?>"
                                    target="_blank">
                                    http://localhost/ankanda/?refer=
                                    <?php echo $result['auto_referralCode']; ?>
                                </a>
                            </div>

                        </div>
                        <!-- </label> -->
                    </div>


                    <!-- userImage -->
                    <div style="display: flex; align-items: center;">
                    <?php
// Fetch rows for the particular user
$query = "SELECT amount FROM wallet WHERE uId = '$user_id'";
$result = mysqli_query($conn, $query);

// Initialize a variable to store the total amount
$total_amount = 0;

// Check if there are rows
if (mysqli_num_rows($result) > 0) {
    // Loop through the rows and sum up the amounts
    while ($row = mysqli_fetch_assoc($result)) {
        $total_amount += $row['amount'];
    }
}
// Close the database connection
// mysqli_close($conn);

// Output the total amount
// echo "Total Amount for User ID $user_id: $total_amount";
?>
                        <!-- Wallet Icon (Outlined and Increased Size) -->
                        <ion-icon name="wallet-outline" style="font-size: 2em;"></ion-icon>

                        <!-- Amount Text -->
                        <p style="margin-left: 5px;"><?php echo $total_amount; ?></p>
                    </div>
                    <div class="user" style="background-color: <?php echo $profilepic?>; border-radius: 50%;"></div>




                </div>


            <!-- </div>
        </div>
    </div>
</body> -->