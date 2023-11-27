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

                                    <form action="php_r/req_approval.php" method="POST" enctype="multipart/form-data">
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
                                                <div class="mb-2">
                                                    <label for="">Service Name</label>
                                                    <input type="text" id="view_firstName" class="form-control mb-3"
                                                        placeholder="Service Name" name="firstName" disabled>
                                                </div>
                                        
                                                <!-- <p class="mb-2">Mobile No.</p> -->
                                                <!-- <div>
                                                    <input type="text" id="view_mobile" class="form-control mb-3"
                                                        placeholder="Mobile" name="mobile"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <label for="">Pincode</label>
                                                    <input type="text" id="view_addr" class="form-control mb-3"
                                                        placeholder="Pincode" name="addr" disabled>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" id="view_phone" class="form-control mb-3"
                                                        placeholder="Phone" name="phone"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div> -->
                                                <!-- <div class="col-md-6">
                                                    <label for="">Whats App</label>
                                                    <input type="text" id="view_whatsApp" class="form-control mb-3"
                                                        placeholder="Whats App Number" name="whatsApp"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                                        maxlength="10" pattern="[0-9]{10}"
                                                        title="Please enter 10 Digit Phone Number only" disabled>
                                                </div> -->

                                                <div class="mb-2">
                                                    <label for="">Description</label>
                                                    <textarea type="text" id="view_email" class="form-control mb-3"
                                                        placeholder="Description" name="email" disabled>
                                                    </textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Image 1 </label>
                                                    <img class="float-end" src="" id="view_verificationImg"
                                                        alt="Image1" width="100" height="100"
                                                        data-toggle="modal" data-target="#fullImageModal">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Image 2</label>
                                                    <img class="float-end" src="" id="view_bankImg" alt="Image2"
                                                        width="100" height="100" data-toggle="modal"
                                                        data-target="#fullImageModal">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Image 3</label>
                                                    <img class="float-end" src="" id="view_profileImg"
                                                        alt="Image3" width="100" height="100" data-toggle="modal"
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
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: "POST",
                url: "php_r/req_approval.php",
                data: {
                    'check_approval_btn': true,
                    'id': id,
                },
                success: function (response) {
                    console.log(response);

                    $.each(response, function (key, value) {
                        $('#view_id').val(value['id']);
                        view_approval_get
                        var approvalAtatus = value['status'];
                        // Get the input element by its ID
                        var modalInput = document.getElementById('view_approval');

                        if (approvalAtatus == 0) {
                            $('#view_approval').val("Pending");
                            modalInput.style.backgroundColor = '#F99486';
                        } else if (approvalAtatus == 1) {
                            $('#view_approval').val("Approved");
                            modalInput.style.backgroundColor = '#86F9CF';
                        }
                        $('#view_approval_get').val(value['status']);

                        $('#view_firstName').val(value['name']);
                        
                        $('#view_mobile').val(value['mobile']);
                        $(
                            '#view_addr').val(value['pincode']);
                        $('#view_phone').val(value[
                            'phone']);
                        $('#view_whatsApp').val(value['whatsApp']);
                        $(
                            '#view_email').val(value['description']);
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
                            'image1_img']);
                        $("#view_bankImg").attr("src", value['image2_img']);
                        $("#view_profileImg").attr("src", value['image3_img']);

                        // $('#view_profileImg').val(value['profile_img']);
                    });

                    $('#approvalModal').modal('show');

                }
            });
        });

    });

    document.getElementById("approveBtn").onclick = function () {
        var approvalStatus = document.getElementById("view_approval_get").value;
        var uId = document.getElementById("view_uId").value;
       $.ajax({
            type: "POST",
            url: "php_r/req_approval.php",
            data: {
                'give_approval': true,
                'status': approvalStatus,
                'uId': uId,
            },
            success: function (response) {
                console.log(response);
                // $('#approvalModal').modal('hide');
                // location.reload();
            }
        });
    }

    // When user clicks on image in the modal, show it in full size modal
    $(document).on("click", "#view_profileImg", function () {
        var fullImagePath = $(this).attr("src");
        $("#fullImage").attr("src", fullImagePath);
        $("#fullImageModal").modal("show");
    });
</script>


<?php include('../ainclude/footer.php'); ?>