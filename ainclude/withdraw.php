<?php
include('../db_conn.php');
include('../auth.php');
?>

<?php
include('../ainclude/sidebar.php');
?>

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
                        <th scope="col">Payment Status</th>
                        <th scope="col">Amount</th>
                        <th scope="col">UserID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="p-5">
                    <?php
                    $user_id = $_SESSION['id'];
                    $query = "SELECT * FROM withdraw";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $serialNumber = 0;
                        foreach ($query_run as $row) {
                            $status = $row['status'];
                            $rowColorClass = ($status == 0) ? 'table-danger' : 'table-success';
                            $serialNumber++;
                            ?>
                            <tr class="<?php echo $rowColorClass ?>">
                                <th scope="row"><?php echo $serialNumber ?></th>
                                <td><?php echo ($row['status'] == 0) ? 'Pending' : 'Completed'; ?></td>
                                <td><?php echo $row['amount'] ?></td>
                                <td><?php echo $row['uId'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td>
                                    <button type="button" class="badge bg-primary approvalBtn"
                                            data-uid="<?php echo $row['req_id'] ?>">Approval
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </div>
        </table>
    </div>
</div>

<?php include('../ainclude/jscript.php'); ?>

<script>
    $(document).ready(function () {
        $('.approvalBtn').click(function () {
            var uid = $(this).data('uid');
            var confirmation = confirm("Update payment status for user with ID " + uid + "?");
            
            if (confirmation) {
                // If the user clicks OK in the confirmation dialog, make an AJAX request to update the status
                $.ajax({
                    type: "POST",
                    url: "update_payment_status.php", // Replace with the actual PHP file to handle the update
                    data: {uid: uid},
                    success: function (response) {
                        alert(response); // Display the response from the server (e.g., success message)
                        // You may want to reload the table or perform other actions based on the response
                    }
                });
            }
        });
    });
</script>

<?php include('../ainclude/footer.php'); ?>
