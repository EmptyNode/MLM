<?php
include('../db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $joiningBonus = $_POST['joiningBonus'];
    $moneyDistribute = $_POST['moneyDistribute'];
    $memberFees = $_POST['memberFees'];

    $query = "UPDATE settings SET jb = '$joiningBonus', md = '$moneyDistribute', mf = '$memberFees' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Settings updated successfully';
    } else {
        echo 'Error updating settings';
    }
}
?>
