<?php
// Start output buffering to capture any output
ob_start();
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

    <?php
    include('navbar.php');
    ?>




    <!-- login error message -->
    <?php
    //   Show Alert  
    if (!empty($_GET['error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid Username or Password....!</strong> Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    ?>


    <!-- <h1>Welcome</h1> -->
    <!-- <div class="carousel-box"> -->
    <div class="container-fluid">
        <div class="row">
            <!-- Apply the "rounded-container" class here -->
            <!-- <div class="col-lg-30 col-md-60 mx-auto rounded-container"> -->
            <div class="col-lg-4 col-md-8 col-12">
                <!-- <div class="carousel-wrapper"> -->
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="enroll-button-container">
                                <img src="images/c1.jpg" alt="Service-1">
                                <div class="carousel-overlay"></div>
                                <a href="#" class="enroll-button" data-bs-toggle="modal"
                                    data-bs-target="#signupModal">Enroll</a>
                            </div>
                            <!-- <div class="carousel-caption">
                                    <h3>Service-1</h3>
                                    <p>We had such a great time with us!</p>
                                </div> -->
                        </div>
                        <div class="carousel-item">
                            <div class="enroll-button-container">
                                <img src="images/c2.jpg" alt="Service-2">
                                <div class="carousel-overlay"></div>
                                <a href="#" class="enroll-button" data-bs-toggle="modal"
                                    data-bs-target="#signupModal">Enroll</a>
                            </div>
                            <!-- <div class="carousel-caption bg-white text-dark">
                                    <h3>Service-2</h3>
                                    <p>Thank you.</p>
                                </div> -->
                        </div>
                        <div class="carousel-item">
                            <div class="enroll-button-container">
                                <img src="images/c3.jpg" alt="Service-3">
                                <div class="carousel-overlay"></div>
                                <a href="#" class="enroll-button" data-bs-toggle="modal"
                                    data-bs-target="#signupModal">Enroll</a>
                            </div>
                            <!-- <div class="carousel-caption">
                                    <h3>Service-3</h3>
                                    <p>We love this Service !</p>
                                </div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <!-- Rounded Corner Image Card Column -->
            <div class="col-lg-2 col-md-4 custom-card">
                <div class="card">
                    <img src="images/s.jpg" class="card-img-top" alt="Card Image">
                </div>
            </div>
            <div class="col-lg-2 col-md-4 custom-card">
                <div class="card">
                    <img src="images/s2.jpg" class="card-img-top" alt="Card Image">
                </div>
            </div>
            <div class="col-lg-2 col-md-4 custom-card">
                <div class="card">
                    <img src="images/s3.jpg" class="card-img-top" alt="Card Image">
                </div>
            </div>
            <div class="col-lg-2 col-md-4 custom-card">
                <div class="card">
                    <img src="images/s4.jpg" class="card-img-top" alt="Card Image">
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->


    <!-- Centered Images Row -->

    <div class="container-fluid pt-5 d-flex justify-content-center" id="categoryDropdownButton">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Car"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #6D0E33;">directions_car</span>
                        <span style="margin-top: -2px; color: black">Car</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="House"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color:  #d4ac0d;">cottage</span>
                        <span style="margin-top: -2px; color: black">House</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">

                <a class="categoryLink" href="#" data-category="Hotel"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #283747;">bed</span>
                        <span style="margin-top: -2px; color: black">Hotel</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Restaurant"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #0E6655;">restaurant_menu</span>
                        <span style="margin-top: -2px; color: black">Restaurant</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Hospital"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #5B2C6F;">local_hospital</span>
                        <span style="margin-top: -2px; color: black">Hospital</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Collage"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #4E8A06;">school</span>
                        <span style="margin-top: -2px; color: black">Collage</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Astrology"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #DE3163;">star_half</span>
                        <span style="margin-top: -2px; color: black">Astrology</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Bakery"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #FF00FF;">cake</span>
                        <span style="margin-top: -2px; color: black">Bakery</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Bank"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #808080;">account_balance</span>
                        <span style="margin-top: -2px; color: black">Bank</span>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-2 text-center">
                <a class="categoryLink" href="#" data-category="Computer"
                    style="text-align: center; display: inline-block; text-decoration: none;">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <span class="material-icons" style="font-size: 68px; color: #E9967A;">computer</span>
                        <span style="margin-top: -2px; color: black">Computer</span>
                    </div>
                </a>
            </div>
        </div>
    </div>



    <section class="py-5">
        <div class="row container-fluid">
            <div class="col text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="icon-box mb-5 mr-5 ml-5"
                        style="display: flex; justify-content: center; align-items: center;">
                        <span class="material-icons" style="font-size: 78px; color: blue;">directions_car</span>
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/piggy.png" alt="Image 2" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/rocket.png" alt="Image 3" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/gold.png" alt="Image 1" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/piggy.png" alt="Image 2" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/rocket.png" alt="Image 3" class="icon-image">
                    </div>
                </div>
            </div>
        </div>


        <!-- Centered Images Row -->
        <div class="row container-fluid">
            <div class="col text-center">
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="icon-box mb-5 mr-5 ml-5">
                        <img src="images/icons/gold.png" alt="Image 1" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/piggy.png" alt="Image 2" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/rocket.png" alt="Image 3" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/gold.png" alt="Image 1" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/piggy.png" alt="Image 2" class="icon-image">
                    </div>
                    <div class="icon-box mb-5 mr-5">
                        <img src="images/icons/rocket.png" alt="Image 3" class="icon-image">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="my-5">
        <!-- <div class="py-5"> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <img src="images/c2.jpg" class="img-fluid service-img" alt="Service-2">
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <h2 class="display-4">Our Services</h2>
                    <p class="py-1">WebLorem ipsum is a dummy text without any sense. It is a sequence of Latin words
                        that, as they are positioned, do not form sentences with a complete sense, but give life to a
                        test text useful to fill spaces that will subsequently be occupied from ad hoc texts composed by
                        WebLorem ipsum is a dummy text without any sense. It is a sequence of Latin words that, as they
                        are positioned, do not form sentences with a complete sense, but give life to a test text useful
                        to fill spaces that will subsequently be occupied from ad hoc texts composed by …</p>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </section>


    <div class="container-fluid">
        <footer class="footer">

            <!-- Admin login Modal opening button -->
            <!-- <a type="button" class="btn btn-primary float-right mb-10" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Admin Login
            </a> -->
            <!-- <a class="btn btn-primary float-right" type="submit">Login</a> -->
            <!-- <a href="adminlogin.php" class="float-right text-white mt-2 mr-2">Admin Login</a> -->
            <a href="#" id="openAdminLogin" class="float-right text-white mt-2 mr-2">Admin Login</a>

            <p class="p-2 bg-dark text-white text-center">@abc</p>


        </footer>
    </div>

    <!-- open signup modal -->
    <div class="container-fluid">
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Sign Up</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="signupp.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group row">
                                <!-- <div class="col-md-6">
                                    <input type="text" id="firstName" class="form-control mb-3" placeholder="First Name"
                                        name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="lastName" class="form-control mb-3" placeholder="Last Name"
                                        name="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="addr" class="form-control mb-3" placeholder="Address"
                                        name="addr" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="phone" class="form-control mb-3" placeholder="Phone"
                                        name="phone"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only" required>
                                </div>
                                <div class="col-md-6">

                                    <input type="text" id="aadhaar" class="form-control mb-3" placeholder="Aadhaar"
                                        name="aadhaar"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 12) this.value = this.value.slice(0, 12);"
                                        maxlength="12" pattern="[0-9]{12}" title="Please enter 12 digits Aadhaar Number"
                                        required>
                                </div> -->

                                <!-- <div class="col-md-6"> -->

                                <p class="mb-2">Mobile No.</p>
                                <div>

                                    <input type="text" id="mobile" class="form-control mb-3" placeholder="Mobile"
                                        name="mobile"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only" required>
                                    <small id="mobileAvailability" class="form-text"></small>
                                </div>
                                <!-- </div> -->

                                <!-- <div class="col-md-6">
                                    <input type="text" id="whatsApp" class="form-control mb-3"
                                        placeholder="Whats App Number" name="whatsApp"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only" required>
                                </div> -->

                                <!-- <div class="col-md-6"> -->
                                <div class="mb-3">
                                    <div class="d-flex">
                                        <input type="text" id="referralCode" class="form-control"
                                            placeholder="Refferal Code" name="refferalCode" required>
                                        <button type="button" class="btn btn-primary btn-sm ml-2"
                                            id="applyReferralCode">Apply</button>
                                        <!-- <div id="referralCodeStatus"></div> -->
                                    </div>
                                    <small id="referralCodeStatus" class="form-text"></small>
                                </div>
                                <!-- </div> -->

                                <!-- <div class="col-md-6"> -->
                                <div class="mb-3">
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        name="password" required>
                                    <div class="mb-3">
                                        <input type="password" id="conf-password" class="form-control"
                                            placeholder="Confirm-Password" name="conf-password" required>
                                        <!-- For password and confirm-password message -->
                                        <small id="password-match-message" class="form-text"></small>
                                    </div>
                                </div>
                                <!-- </div> -->

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="registerButton"
                                name="register">Register</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="loginModalLabel">User Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="uslgp.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="loginMobile" class="form-control mb-3" placeholder="Mobile"
                                    name="mobile" required>
                                <input type="password" id="loginPassword" class="form-control" placeholder="Password"
                                    name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- admin Login Modal -->
    <div class="modal fade" id="adminloginModal" tabindex="-1" role="dialog" aria-labelledby="adminloginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adminloginModalLabel">Admin Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="algp.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="admin_user_name" class="form-control mb-3"
                                    placeholder="User Name" name="user_name" required>
                                <input type="password" id="adminl_Password" class="form-control" placeholder="Password"
                                    name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="adminlogin">Login</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>










    <!-- <div class="container">
              <footer class="footer">
                <button class="btn btn-primary float-right">Sign Up</button>
                <p class="bg-dark text-center">Copyright 2023</p>
            </footer>
        </div> -->


    <!-- <h1>Welcome</h1> -->



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Open login modal when link is clicked -->
    <script>
        $(document).ready(function () {
            $('#openAdminLogin').click(function () {
                $('#adminloginModal').modal('show');
            });



            // to auto dissapear alert
            $(document).ready(function () {

                window.setTimeout(function () {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                        $(this).remove();
                    });
                }, 5000);

            });

            //  check password and confirm-password is matched  
            $('#conf-password').keyup(function () {
                var password = $('#password').val();
                var confirmPassword = $('#conf-password').val();

                if (password === confirmPassword) {
                    $('#password-match-message').text('Passwords Matched.');
                    $('#password-match-message').removeClass('text-danger').addClass(
                        'text-success');
                } else {
                    $('#password-match-message').text('Passwords do not Matched.');
                    $('#password-match-message').removeClass('text-success').addClass(
                        'text-danger');
                }
            });

            // to check referral code is present in database or not
            $('#applyReferralCode').click('input', function () {
                var referralCode = $('#referralCode').val();
                // var referralCode = $(this).val();

                // Perform AJAX check for referral code
                $.ajax({
                    url: 'check_referral.php',
                    type: 'POST',
                    data: {
                        checkType: 'referralCode',
                        value: referralCode
                    },
                    success: function (response) {
                        if (response === 'valid') {
                            $('#referralCodeStatus').removeClass('text-danger').addClass(
                                'text-success');
                            $('#referralCodeStatus').text('Valid Referral Code.');
                        } else {
                            $('#referralCodeStatus').removeClass('text-success').addClass(
                                'text-danger');
                            $('#referralCodeStatus').text('Invalid Referral Code.');
                        }
                    }
                });
            });

            $('#mobile').on('input', function () {
                var mobile = $(this).val();

                // Perform AJAX check for mobile number
                $.ajax({
                    url: 'check_referral.php',
                    type: 'POST',
                    data: {
                        checkType: 'mobile',
                        value: mobile
                    },
                    success: function (response) {
                        if (response === 'exist') {
                            $('#mobileAvailability').text('Mobile number already exists.');
                            $('#mobileAvailability').removeClass('text-success').addClass(
                                'text-danger');
                        } else {
                            $('#mobileAvailability').text('Mobile number available.');
                            $('#mobileAvailability').removeClass('text-danger').addClass(
                                'text-success');
                        }
                    }
                });
            });



            // Category icon select
            // $('.category-icon').click(function() {
            //     var selectedCategory = $(this).data('category');
            //     loadListings(selectedCategory);
            // });


            // Fetch pincode suggestions when dropdown is opened
            $.ajax({
                url: "php/fetch_pin_data.php",
                dataType: "html",
                success: function (data) {
                    $("#dropdownContent").html(data);
                }
            });

            var selectedPin = ""; // Initialize variable for selected pincode

            // Handle pincode selection
            $(document).on("click", ".dropdown-item", function (e) {
                e.preventDefault();
                selectedPin = $(this).text();
                $("#dropdownMenuButton").text(selectedPin);
                selectedPin = $(this).text(); // Store the selected pincode
            });


            $("#searchInput").on("input", function () {
                var searchValue = $(this).val().toLowerCase();
                $(".dropdown-item").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });

            // Handle category icon click to navigate to listing page
            $(".categoryLink").click(function () {
                // e.preventDefault();
                // var categoryLink = $(this).link();

                var category = $(this).data("category");
                if (selectedPin !== "") {
                    var sectedLink = window.location.href = "listingpage.php?pincode=" + encodeURIComponent(
                        selectedPin) +
                        "&category=" + encodeURIComponent(category);
                } else {
                    var sectedLink = window.location.href = "listingpage.php?" +
                        "&category=" + encodeURIComponent(category);
                }
            });
            // // Handle pincode selection
            // $(document).on("click", "#dropdownContent .dropdown-item", function(e) {
            //     e.preventDefault();
            //     var selectedPin = $(this).text();
            //     $("#dropdownMenuButton").text("Pincode: " + selectedPin);
            // });




        });

    // // Add an event listener to the pincode dropdown
    // const pincodeDropdown = document.getElementById('dropdownMenuButton');
    // pincodeDropdown.addEventListener('change', function() {
    //     const selectedPincode = this.value;
    //     // Redirect to the listingpage.php page with the selected pincode as a query parameter
    //     window.location.href = `listingpage.php?pincode=${selectedPincode}`;
    // });




    // Function to open the signup modal with the referral code
    // function openSignupModalWithReferral() {
    //     var modal = document.getElementById('signupModal');

    //     modal.style.display = "block";
    // }


    // $(document).ready(function() {
    //     // Check if the 'refer' query parameter is present in the URL
    //     const urlParams = new URLSearchParams(window.location.search);
    //     const referralCode = urlParams.get('refer');

    //     // If referralCode is present, open the modal and populate the referral code
    //     if (referralCode) {
    //         $('#signupModal').modal('show');
    //         $('#referralCode').val(referralCode);
    //     }
    // });
    </script>


    <?php
    //ob_start(); // Start output buffering
    session_start();

    require_once 'db_conn.php';

    // Check if the user is not logged in and a referral code is provided
    
    // Check if the user is logged in
    if (!isset($_SESSION['uId'])) {
        // Open the modal with referral code
        if (isset($_GET['refer']) && $_GET['refer'] != '') {
            // Check if the user is not logged in before opening the modal
            if (!isset($_SESSION['LOG_AUTH'])) {
                $query = "SELECT * FROM user_tbl WHERE auto_referralCode = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $_GET['refer']);
                $stmt->execute();
                $result = $stmt->get_result();

                // echo ($_GET['refer']);
                // echo ($_SESSION['LOG_AUTH']);
    
                // If the referral code exists in the database, open the signup modal and populate the referral code
                if ($result->num_rows == 1) {
                    echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                        var referralCode = "' . $_GET['refer'] . '";
                        var signupModal = new bootstrap.Modal(document.getElementById("signupModal"));
                        signupModal.show();
                        document.getElementById("referralCode").value = referralCode;
                });
    </script>';
                }
            }
        }
    }
    ob_end_flush(); // End output buffering and send the captured output to the browser
    
    ?>

    <?php
    // End output buffering and send the captured output to the browser
    ob_end_flush();
    ?>
</body>

</html>