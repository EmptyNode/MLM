<?php
include('../auth.php');

include('../uinclude/sidebar.php');
include('../uinclude/php/cal_profile_percentage.php');
?>






<div class="container-fluid pe-4">
    <h4>User Profile </h4>
    <div class="pb-2 edit_btn">
        <strong>
            <a class="btn btn-primary btn-sm float-end fw-bolder edit_btn" href="#">Edit Profile</a>
        </strong>
    </div>

    <!-- Display the progress bar -->
    <h5>Profile Completed</h5>

    <div class="progress">
        <div class="progress-bar pt-1" role="progressbar" aria-valuenow="<?php echo $completionPercentage; ?>"
            aria-valuemin="0" aria-valuemax="100"
            style="width: <?php echo $completionPercentage; ?>%; background-color: <?php echo $barColor; ?>;">
            <strong><span style="color: <?php echo $textColor; ?>; 
                font-size: <?php echo $textSize; ?>; font-style: bold;">
                    <?php echo $completionPercentage; ?>%
                </span>
            </strong>
        </div>
    </div>
    <!-- </div> -->


    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="fixed-height-container">
                    <div class="card p-4 border rounded shadow overflow-auto" style="max-height: 400px;">
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
                            <div class="row mb-3">
                            <div class="col-4 fw-bold">Payment Status:</div>
                            <div class="col-8">
                                <?php if ($row['approval_status'] == 0): ?>
                                    <span class="text-error"> Approval needed</span>
                                <?php elseif ($row['payment_status'] == 1): ?>
                                    <span class="text-success">Payment done</span>
                                <?php else: ?>
                                    <button class="btn btn-success" id="paymentButton" onclick="redirectToPayment()">Make Payment</button>
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


    <!-- open edit profile modal -->
    <div class="container-fluid">
        <div class="modal fade" id="edit_profileModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="php/ueditprofile.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" id="edit_firstName" class="form-control mb-3"
                                        placeholder="First Name" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" id="edit_lastName" class="form-control mb-3"
                                        placeholder="Last Name" name="lastName" required>
                                </div>
                                <!--<p class="mb-2">Mobile No.</p>
                                 <div>
                                    <input type="text" id="edit_mobile" class="form-control mb-3" placeholder="Mobile"
                                        name="mobile"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only" required>
                                    <small id="mobileAvailability" class="form-text"></small>
                                </div> -->
                                <div class="col-md-12">
                                    <label for="">Address</label>
                                    <input type="text" id="edit_addr" class="form-control mb-3" placeholder="Address"
                                        name="addr" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="text" id="edit_phone" class="form-control mb-3" placeholder="Phone"
                                        name="phone"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Whats App</label>
                                    <input type="text" id="edit_whatsApp" class="form-control mb-3"
                                        placeholder="Whats App Number" name="whatsApp"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}"
                                        title="Please enter 10 Digit Phone Number only" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">E-mail</label>
                                    <input type="email" id="edit_email" class="form-control mb-3" placeholder="E-mail"
                                        name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Date of Birth</label>
                                    <input type="date" id="edit_dob" class="form-control mb-3"
                                        placeholder="Date of Birth" name="dob" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Pan Number</label>
                                    <input type="text" id="edit_pan" class="form-control mb-3" placeholder="Pan Number"
                                        name="pan"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                        maxlength="10" pattern="[0-9]{10}" title="Please enter Valid Pan Number"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Aadhaar Number</label>
                                    <input type="text" id="edit_aadhaar" class="form-control mb-3" placeholder="Aadhaar"
                                        name="aadhaar"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 12) this.value = this.value.slice(0, 12);"
                                        maxlength="12" pattern="[0-9]{12}" title="Please enter 12 digits Aadhaar Number"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Bank Name</label>
                                    <input type="text" id="edit_bank_name" class="form-control mb-3"
                                        placeholder="Bank Name" name="bank_name" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="">IFSC Code</label>
                                    <input type="text" id="edit_ifsc" class="form-control mb-3" placeholder="IFSC Code"
                                        name="ifsc_code" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="">Account Number</label>
                                    <input type="text" id="edit_acNumber" class="form-control mb-3"
                                        placeholder="Account Number" name="ac_number" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="">Verification Image</label>
                                    <input type="file" id="edit_verify_img" class="form-control mb-3"
                                        name="verify_image" title="Image Size Max 5 MB"
                                        accept="image/*, application/pdf">
                                </div>
                                <div class="invalid-feedback" id="verifyimgFeedback">
                                    Please select a valid file (JPG, JPEG, PNG or PDF) with a maximum size of 5MB.
                                </div>

                                <div class="col-md-12">
                                    <label for="">Bank Image</label>
                                    <input type="file" id="edit_bank_img" class="form-control mb-3" name="bank_image"
                                        title="Image Size Max 5 MB" accept="image/*, application/pdf">
                                </div>
                                <div class="invalid-feedback" id="bankimgFeedback">
                                    Please select a valid file (JPG, JPEG, PNG or PDF) with a maximum size of 5MB.
                                </div>

                                <div class="col-md-12">
                                    <label for="">Profile Image</label>
                                    <input type="file" id="edit_img" class="form-control mb-3" name="image"
                                        title="Image Size Max 5 MB" accept="image/*">
                                </div>
                                <div class="invalid-feedback" id="imageFeedback">
                                    Please select a valid image (JPG, JPEG, PNG) with a maximum size of 5MB.
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="updateProfleBtn"
                                name="update_profile">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </form>

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

    <script>
        $(document).ready(function () {

            $('.edit_btn').click(function (e) {
                e.preventDefault();
                var userId = <?php echo $_SESSION['uId']; ?>;

                // $('#edit_profileModal').modal('show');
                // console.log("User ID:", userId);

                $.ajax({
                    type: "POST",
                    url: "php/ueditprofile.php",
                    data: {
                        'check_proifleedit_btn': true,
                        'userId': userId,
                    },
                    success: function (response) {
                        console.log(response);

                        $.each(response, function (key, value) {
                            $('#edit_firstName').val(value['firstName']);
                            $('#edit_lastName').val(value['lastName']);
                            $('#edit_addr').val(value['addr']);
                            $('#edit_phone').val(value['phone']);
                            $('#edit_whatsApp').val(value['whatsApp']);
                            $('#edit_email').val(value['email']);
                            $('#edit_dob').val(value['dob']);
                            $('#edit_pan').val(value['pan']);
                            $('#edit_aadhaar').val(value['aadhaar']);
                            $('#edit_bank_name').val(value['bank_name']);
                            $('#edit_acNumber').val(value['ac_number']);
                            $('#edit_ifsc').val(value['ifsc_code']);
                        });

                        $('#edit_profileModal').modal('show');

                    }
                });
            });
        });


        //  To check image size and proper image and pdf format for Verification
        const verifyimgInput = document.getElementById('edit_verify_img');
        const verifyimgFeedback = document.getElementById('verifyimgFeedback');

        verifyimgInput.addEventListener('change', function () {
            const file = this.files[0];
            const allowedFormats = ['image/jpeg', 'image/png', 'application/pdf'];

            if (file) {
                if (!allowedFormats.includes(file.type)) {
                    verifyimgInput.setCustomValidity(
                        'Invalid image format. Please select a JPG, JPEG, PNG or PDF file.');
                    verifyimgFeedback.style.display = 'block';
                } else if (file.size > 5 * 1024 * 1024) {
                    verifyimgInput.setCustomValidity('Image size exceeds the maximum limit of 5MB.');
                    verifyimgFeedback.style.display = 'block';
                } else {
                    verifyimgInput.setCustomValidity('');
                    verifyimgFeedback.style.display = 'none';
                }
            }
        });

        //  To check image size and proper image and pdf format for Bank
        const bankimgInput = document.getElementById('edit_bank_img');
        const bankimgFeedback = document.getElementById('bankimgFeedback');

        bankimgInput.addEventListener('change', function () {
            const file = this.files[0];
            const allowedFormats = ['image/jpeg', 'image/png', 'application/pdf'];

            if (file) {
                if (!allowedFormats.includes(file.type)) {
                    bankimgInput.setCustomValidity(
                        'Invalid image format. Please select a JPG, JPEG, PNG or PDF file.');
                    bankimgFeedback.style.display = 'block';
                } else if (file.size > 5 * 1024 * 1024) {
                    bankimgInput.setCustomValidity('Image size exceeds the maximum limit of 5MB.');
                    bankimgFeedback.style.display = 'block';
                } else {
                    bankimgInput.setCustomValidity('');
                    bankimgFeedback.style.display = 'none';
                }
            }
        });

        //  To check image size and proper image format 
        const imageInput = document.getElementById('edit_img');
        const imageFeedback = document.getElementById('imageFeedback');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            const allowedFormats = ['image/jpeg', 'image/png'];

            if (file) {
                if (!allowedFormats.includes(file.type)) {
                    imageInput.setCustomValidity(
                        'Invalid image format. Please select a JPG, JPEG, or PNG image.');
                    imageFeedback.style.display = 'block';
                } else if (file.size > 5 * 1024 * 1024) {
                    imageInput.setCustomValidity('Image size exceeds the maximum limit of 5MB.');
                    imageFeedback.style.display = 'block';
                } else {
                    imageInput.setCustomValidity('');
                    imageFeedback.style.display = 'none';
                }
            }
        });

        function redirectToPayment() {
        // Redirect to the payment screen (update the URL accordingly)
        window.location.href = ' /MLM/uinclude/payment_screen.php';
    }

    </script>


    <?php
    include('../uinclude/footer.php');
    ?>