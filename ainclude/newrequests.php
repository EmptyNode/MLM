<?php
include('../db_conn.php');

include('../auth.php');
?>

<?php
include('../ainclude/sidebar.php');
?>

<!-- 
<div>
    <h1>Dashboard</h1>
</div> -->

<div class="container-fluid p-5">

    <?php
    if (isset($_SESSION['status'])) {
        echo "<h4>" . $_SESSION['status'] . "</h4>";
        unset($_SESSION['status']);
    }

    ?>

    <div class="table-responsive" style="height: 70vh; overflow-y: auto;">
        <table class="table">
            <div class=" p-1">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#Sl.</th>
                        <th scope="col">Approval Status</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Area</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image1</th>
                        <th scope="col">Image2</th>
                        <th scope="col">Image3</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="p-5">
                    <?PHP
                    // require_once '../uinclude/php/db_conn.php';
                    
                    $user_id = $_SESSION['id'];
                    // echo "id : " . $user_id;
                    $query = "SELECT * FROM new_service_request";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {

                        $serialNumber = 0; // Initialize the serial number counter
                    
                        foreach ($query_run as $row) {

                            $status = $row['status'];
                            $rowColorClass = ($status == 0) ? 'table-danger' : 'table-success';

                            $serialNumber++; // Increment the serial number for the next row
                    
                            ?>
                            <tr class="<?php echo $rowColorClass ?>">
                                <th scope="row">
                                    <?php echo $serialNumber ?>
                                </th>
                                <!-- <td><? //php echo $row['uId'] ?></td> -->
                                <td>
                                    <?php if ($row['status'] == 0) {
                                        echo ('Pending');
                                    } else {
                                        echo ('Approved');
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['pincode'] ?>
                                </td>
                                <!-- <td>
                            <? //php echo $row['addr'] ?>
                        </td> -->
                                <td>
                                    <?php echo $row['description'] ?>
                                </td>
                                <!-- <td>
                            <? //php echo $row['email'] ?>
                        </td>
                        <td>
                            <? //php echo $row['dob'] ?>
                        </td>
                        <td>
                            <? //php echo $row['pan'] ?>
                        </td>
                        <td>
                            <? //php echo $row['aadhaar'] ?>
                        </td>
                        <td>
                            <? //php echo $row['bank_name'] ?>
                        </td>
                        <td>
                            <? //php echo $row['ac_number'] ?>
                        </td>
                        <td>
                            <? //php echo $row['ifsc_code'] ?>
                        </td> -->
                        <td>
                              <img src="<?php echo $row['image1'] ?>" alt="Service Image" width="50">
                           </td>
                           <td>
                              <img src="<?php echo $row['image2'] ?>" alt="Service Image" width="50">
                           </td>
                           <td>
                              <img src="<?php echo $row['image3'] ?>" alt="Service Image" width="50">
                           </td>
                            
                                <!-- <td><//?php echo $row['img']?></td> -->
                                <!-- <td><img src="/AnkanDa/uinclude/userUploads/<//?php echo $row['img']?>" alt="Service Image" width="50"> -->

                                <td><button href="" type="button" value="<?php echo $row['id'] ?>"
                                        class="badge bg-primary approvalBtn">Approval</button></td>

                            </tr>
                            <!-- <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr> -->
                            <?php
                        }
                    }
                    ?>


                    <!-- open approval modal -->
                    <div class="container-fluid">
                        <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog"
                            aria-labelledby="loginModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Approval</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="php/approval.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group row">

                                                <div class="col-md-12">
                                                    <label for="">Approval Status</label>
                                                    <input type="text" id="view_approval" class="form-control mb-3"
                                                        placeholder="Approval Status" disabled>
                                                    <input type="text" id="view_approval_get" class="form-control mb-3"
                                                        placeholder="Approval Status" name="approval_status" hidden>
                                                    <input type="text" id="view_uId" class="form-control mb-3"
                                                        placeholder="User Id" name="uId" hidden>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <input type="text" id="view_uId" class="form-control mb-3"
                                                        placeholder="User Id" name="uId" hidden>
                                                </div> -->
                                                <div class="col-md-6">
                                                    <label for="">First Name</label>
                                                    <input type="text" id="view_firstName" class="form-control mb-3"
                                                        placeholder="First Name" name="firstName" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Last Name</label>
                                                    <input type="text" id="view_lastName" class="form-control mb-3"
                                                        placeholder="Last Name" name="lastName" disabled>
                                                </div>
                                                <p class="mb-2">Mobile No.</p>
                                                <div>
                                                    <input type="text" id="view_mobile" class="form-control mb-3"
                                                        placeholder="Mobile" name="mobile"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Address</label>
                                                    <input type="text" id="view_addr" class="form-control mb-3"
                                                        placeholder="Address" name="addr" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" id="view_phone" class="form-control mb-3"
                                                        placeholder="Phone" name="phone"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Whats App</label>
                                                    <input type="text" id="view_whatsApp" class="form-control mb-3"
                                                        placeholder="Whats App Number" name="whatsApp"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">E-mail</label>
                                                    <input type="email" id="view_email" class="form-control mb-3"
                                                        placeholder="E-mail" name="email" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Date of Birth</label>
                                                    <input type="date" id="view_dob" class="form-control mb-3"
                                                        placeholder="Date of Birth" name="dob" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Pan Number</label>
                                                    <input type="text" id="view_pan" class="form-control mb-3"
                                                        placeholder="Pan Number" name="pan"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter Valid Pan Number" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Aadhaar Number</label>
                                                    <input type="text" id="view_aadhaar" class="form-control mb-3"
                                                        placeholder="Aadhaar" name="aadhaar"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 12) this.value = this.value.slice(0, 12);"
                                                        maxlength="12" pattern="[0-9]{12}"
                                                        title="Please enter 12 digits Aadhaar Number" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Bank Name</label>
                                                    <input type="text" id="view_bank_name" class="form-control mb-3"
                                                        placeholder="Bank Name" name="bank_name" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">IFSC Code</label>
                                                    <input type="text" id="view_ifsc" class="form-control mb-3"
                                                        placeholder="IFSC Code" name="ifsc_code" disabled>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Account Number</label>
                                                    <input type="text" id="view_acNumber" class="form-control mb-3"
                                                        placeholder="Account Number" name="ac_number" disabled>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Verification Image</label>
                                                    <img class="float-end" src="" id="view_verificationImg"
                                                        alt="Verification Image" width="100" height="100"
                                                        data-toggle="modal" data-target="#fullImageModal">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Bank Image</label>
                                                    <img class="float-end" src="" id="view_bankImg" alt="Bank Image"
                                                        width="100" height="100" data-toggle="modal"
                                                        data-target="#fullImageModal">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Profile Image</label>
                                                    <img class="float-end" src="" id="view_profileImg"
                                                        alt="Profile Image" width="100" height="100" data-toggle="modal"
                                                        data-target="#fullImageModal">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="approveBtn"
                                                name="give_approval">Approve</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        <!-- The Full Image Modal -->
                        <div class="modal fade" id="fullImageModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="" id="fullImage" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </div>
        </table>
    </div>
</div>

<?php include('../ainclude/jscript.php'); ?>

<script>
    //  Approval script
    $(document).ready(function () {
        $(".approvalBtn").click(function () {
            // e.preventDefault();
            var user_id = $(this).val();
            console.log(user_id);
            $.ajax({
                type: "POST",
                url: "php/approval.php",
                data: {
                    'check_approval_btn': true,
                    'userId': user_id,
                },
                success: function (response) {
                    console.log(response);

                    $.each(response, function (key, value) {
                        $('#view_uId').val(value['uId']);
                        view_approval_get
                        var approvalAtatus = value['approval_status'];
                        // Get the input element by its ID
                        var modalInput = document.getElementById('view_approval');

                        if (approvalAtatus == 0) {
                            $('#view_approval').val("Pending");
                            modalInput.style.backgroundColor = '#F99486';
                        } else if (approvalAtatus == 1) {
                            $('#view_approval').val("Approved");
                            modalInput.style.backgroundColor = '#86F9CF';
                        }
                        $('#view_approval_get').val(value['approval_status']);

                        $('#view_firstName').val(value['firstName']);
                        $('#view_lastName')
                            .val(value['lastName']);
                        $('#view_mobile').val(value['mobile']);
                        $(
                            '#view_addr').val(value['addr']);
                        $('#view_phone').val(value[
                            'phone']);
                        $('#view_whatsApp').val(value['whatsApp']);
                        $(
                            '#view_email').val(value['email']);
                        $('#view_dob').val(value[
                            'dob']);
                        $('#view_pan').val(value['pan']);
                        $('#view_aadhaar')
                            .val(value['aadhaar']);
                        $('#view_bank_name').val(value[
                            'bank_name']);
                        $('#view_acNumber').val(value['ac_number']);
                        $('#view_ifsc').val(value['ifsc_code']);

                        $("#view_verificationImg").attr("src", value[
                            'verification_img']);
                        $("#view_bankImg").attr("src", value['bank_img']);
                        $("#view_profileImg").attr("src", value['profile_img']);

                        // $('#view_profileImg').val(value['profile_img']);
                    });

                    $('#approvalModal').modal('show');

                }
            });
        });

    });

    // When user clicks on image in the modal, show it in full size modal
    $(document).on("click", "#view_profileImg", function () {
        var fullImagePath = $(this).attr("src");
        $("#fullImage").attr("src", fullImagePath);
        $("#fullImageModal").modal("show");
    });
</script>


<?php include('../ainclude/footer.php'); ?>