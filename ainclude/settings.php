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
                        <th scope="col">Joining Bonus</th>
                        <th scope="col">Money Distribute Amount</th>
                        <th scope="col">Member Fees</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="p-5">
                    <?php
                    $user_id = $_SESSION['id'];
                    $query = "SELECT * FROM settings";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        $serialNumber = 0;
                        foreach ($query_run as $row) {
                            $serialNumber++;
                            ?>
                            <tr class="<?php echo $rowColorClass ?>" data-row-id="<?php echo $row['id']; ?>">
                                <th scope="row"><?php echo $serialNumber ?></th>
                                <td><?php echo $row['jb'] ?></td>
                                <td><?php echo $row['md'] ?></td>
                                <td><?php echo $row['mf'] ?></td>
                                <td>
                                    <button type="button" class="badge bg-primary approvalBtn updateBtn" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        Update
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Fetch the current data for the selected row
                $selectedId = isset($_GET['id']) ? $_GET['id'] : '';
                $query = "SELECT * FROM settings";
                $result = mysqli_query($conn, $query);
                $rowData = mysqli_fetch_assoc($result);
                ?>
                <form id="updateForm" data-row-id="">
                    <div class="mb-3">
                        <label for="joiningBonus" class="form-label">Joining Bonus</label>
                        <input type="text" class="form-control" id="joiningBonus" name="joiningBonus" value="<?php echo $rowData['jb']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="moneyDistribute" class="form-label">Money Distribute Amount</label>
                        <input type="text" class="form-control" id="moneyDistribute" name="moneyDistribute" value="<?php echo $rowData['md']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="memberFees" class="form-label">Member Fees</label>
                        <input type="text" class="form-control" id="memberFees" name="memberFees" value="<?php echo $rowData['mf']; ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.updateBtn');
        const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
        const updateForm = document.getElementById('updateForm');

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const settingsId = this.closest('tr').getAttribute('data-row-id');
                // You can use settingsId to fetch specific data if needed
                // and populate the modal fields

                // Example: Fetch data using AJAX
                // const xhr = new XMLHttpRequest();
                // xhr.open('GET', 'fetch_settings.php?id=' + settingsId, true);
                // xhr.onload = function () {
                //   if (xhr.status == 200) {
                //     const data = JSON.parse(xhr.responseText);
                //     // Populate modal fields here
                //     // Example: document.getElementById('updatedValue').value = data.updatedValue;
                //   }
                // };
                // xhr.send();

                // Open the modal
                updateForm.setAttribute('data-row-id', settingsId);
                updateModal.show();
            });
        });

        const updateBtn = document.getElementById('updateBtn');
        updateBtn.addEventListener('click', function () {
            const formData = new FormData(updateForm);
            formData.append('id', updateForm.getAttribute('data-row-id'));

            // Send update data using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_settings.php', true);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    // Handle success
                    console.log(xhr.responseText);
                } else {
                    // Handle error
                    console.error(xhr.statusText);
                }
            };
            xhr.send(formData);

            // Close the modal after the update
            updateModal.hide();
        });

        // Fix for modal overlay staying issue
        document.addEventListener('hidden.bs.modal', function (e) {
            document.body.classList.remove('modal-open');
        });
    });
</script>

<?php include('../ainclude/footer.php'); ?>
