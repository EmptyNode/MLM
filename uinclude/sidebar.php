<?php
include('../db_conn.php');
$user_id = $_SESSION['uId'];
// echo "id : " . $user_id;
$query = "SELECT * FROM user_tbl WHERE uId = '$user_id'";
$query_run = mysqli_query($conn, $query);
if (mysqli_num_rows($query_run) > 0) {
    $result = mysqli_fetch_assoc($query_run);
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
                    <div class="user">
                        <img src="<?php echo $result['profile_img']; ?>" alt="">
                    </div>

                </div>


                <!-- </div>
    </div> -->