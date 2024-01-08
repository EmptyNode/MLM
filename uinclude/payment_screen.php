<?php
include('../auth.php');

include('../uinclude/sidebar.php');
include('../uinclude/php/cal_profile_percentage.php');
?>









    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="fixed-height-container">
                    <div class="card p-4 border rounded shadow overflow-auto" style="max-height: 800px;">
                        <h5 class="card-title text-center mb-4">User Information</h5>
                        <?PHP
                        // require_once '../uinclude/php/db_conn.php';
                        
                        $user_id = $_SESSION['uId'];
                        // echo "id : " . $user_id;
                        $query = "SELECT * FROM user_tbl WHERE uId = '$user_id'";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            // foreach($query_run as $row) {
                            $row = mysqli_fetch_assoc($query_run);
                            ?>

                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Name:</div>
                                <div class="col-8">
                                    <?php echo $row['firstName'] ?>
                                    <?php echo $row['lastName'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Mobile:</div>
                                <div class="col-8">
                                    <?php echo $row['mobile'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Address:</div>
                                <div class="col-8">
                                    <?php echo $row['addr'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Phone:</div>
                                <div class="col-8">
                                    <?php echo $row['phone'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Whats App:</div>
                                <div class="col-8">
                                    <?php echo $row['whatsApp'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">E-mail:</div>
                                <div class="col-8">
                                    <?php echo $row['email'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Date of Birth:</div>
                                <div class="col-8">
                                    <?php echo $row['dob'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Pan Number:</div>
                                <div class="col-8">
                                    <?php echo $row['pan'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Aadhaar Number:</div>
                                <div class="col-8">
                                    <?php echo $row['aadhaar'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Bank Name:</div>
                                <div class="col-8">
                                    <?php echo $row['bank_name'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Account Number:</div>
                                <div class="col-8">
                                    <?php echo $row['ac_number'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Ifsc Code:</div>
                                <div class="col-8">
                                    <?php echo $row['ifsc_code'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Verification Image:</div>
                                <div class="col-8">
                                    <a href="<?php echo $row['verification_img'] ?>">
                                        <img src="<?php echo $row['verification_img'] ?>" alt="Verification Image"
                                            width="100" height="100">
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Bank Image:</div>
                                <div class="col-8">
                                    <a href="<?php echo $row['bank_img'] ?>">
                                        <img src="<?php echo $row['bank_img'] ?>" alt="Bank Image" width="100" height="100">
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 fw-bold">Profile Image:</div>
                                <div class="col-8">
                                    <a href="<?php echo $row['profile_img'] ?>">
                                        <img src="<?php echo $row['profile_img'] ?>" alt="Profile Image" width="100"
                                            height="100">
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                            <div class="col-4 fw-bold">
                                <!-- Payment Status: -->

                            </div>
                            <?php 
                                include("../db_conn.php");
                                $set_query = "SELECT mf FROM settings";
                                $set_res = mysqli_query($conn, $set_query);
                                if ($set_res && mysqli_num_rows($set_res) > 0) {
                                    $setrow = mysqli_fetch_assoc($set_res);
                                    $mf = $setrow['mf'];
                                }
                            ?>
                            <div class="col-8">
                                <?php if ($row['approval_status'] == 'completed'): ?>
                                    <span class="text-success">Payment Completed</span>
                                <?php else: ?>
                                    <button class="btn btn-success" id="paymentButton">Pay Rs. <?php echo $mf; ?></button>
                                <?php endif; ?>
                        </div>
                        </div>

                            <?php
                        }
                        // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
 -->

 <?php


// Check if the user_id is set in the session
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Handle the case where user_id is not set (redirect to login, display an error, etc.)
    $userId = null;
}
?>

    <script>
        // Payment button click handler
    document.getElementById('paymentButton').addEventListener('click', function() {
    // Assuming you have a function to handle the payment process
    // You can replace this with your actual payment logic
    // For example, show a toast message and add 20 rs to the wallet
    showToast();

    // Assuming you have a function to update the wallet balance via AJAX
    // You can replace this with your actual AJAX request
    updateWalletBalance();
});

function showToast() {
    // You can use a library like Toastify or any other method to show a toast message
    // Example using Toastify library
    // Toastify({
    //     text: message,
    //     duration: 3000, // 3 seconds
    //     close: true,
    //     gravity: "bottom", // or "top"
    //     position: "center", // or "left" or "right"
    // }).showToast();
    alert('Payment Successful!. ₹20 added to your wallet.');
}

function updateWalletBalance() {
    // Assuming you have jQuery available for AJAX
    // You can replace this with vanilla JavaScript or any other AJAX method

    var userId = <?php echo $row['uId']; ?>;
    var referel = '<?php echo $row['referralCode']; ?>';
    if (userId !== null) {
        $.ajax({
            url: '/MLM/uinclude/php/update_wallet.php',
            method: 'POST',
            data: {
                payment: true, // Add this line to include the 'payment' parameter
                userId: userId,
                referel: referel,
                amount: 20
            },
            success: function(response) {
                console.log(response);
                // Show your success toast here
                alert('Transaction successful!'); // Temporary alert, replace with your toast code
            },
            error: function(error) {
                console.error(error);
                // Show your error toast here
                alert('Transaction failed!'); // Temporary alert, replace with your toast code
            }
        });
    } else {
        // Handle the case where userId is null
        console.error('User ID is not set.');
    }
}


    </script>


    <?php
    include('../uinclude/footer.php');
    ?>