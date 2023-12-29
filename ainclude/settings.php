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
                            <tr class="<?php echo $rowColorClass ?>">
                                <th scope="row"><?php echo $serialNumber ?></th>
                                <td><?php echo $row['jb'] ?></td>
                                <td><?php echo $row['md'] ?></td>
                                <td><?php echo $row['mf'] ?></td>
                                <td>
                                    <button type="button" class="badge bg-primary approvalBtn">Update
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
  
</script>

<?php include('../ainclude/footer.php'); ?>
