<?php
include('../db_conn.php');
include('../auth.php');
?>

<?php include('../ainclude/sidebar.php'); ?>

<div class="container-fluid p-5">
    <?php
    if (isset($_SESSION['status'])) {
        echo "<h4>" . $_SESSION['status'] . "</h4>";
        unset($_SESSION['status']);
    }
    ?>

    <div id="toggleIcons" class="toggle-icons">
        <ion-icon id="tableIcon" name="grid-outline"></ion-icon>
        <ion-icon id="treeIcon" name="contract-outline"></ion-icon>
    </div>

    <div id="treeView" class="view-container">
        <?php
        $query = "SELECT * FROM user_tbl";
        $users = [];
        $query_run = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($query_run)) {
            $users[$row['uId']]["mobile"] = $row["mobile"];
            $users[$row['uId']]["approval_status"] = $row["approval_status"];
            $users[$row['uId']]["parent_id"] = $row["parent_id"];
        }
        buildTreeView($users, 0);
        function buildTreeView($users, $parent, $level = 0, $prelevel = -1)
        {
            foreach ($users as $id => $data) {
                if ($parent == $data["parent_id"]) {
                    echo "<div class='user-item' data-level='$level' data-parent='$parent'>";
                    echo "<div class='arrow'></div>";
                    echo "<div class='user-info'>";
                   echo "uId: " . $id . " - " . $data["mobile"] . " - Approval Status: " . getApprovalStatus($data["approval_status"]);
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='child-list' data-level='$level' data-parent='$parent'>";
                    $level++;
                    buildTreeView($users, $id, $level, $prelevel);
                    $level--;
                    echo "</div>";
                }
            }
        }

        function getApprovalStatus($status)
{
    return $status == 1 ? "Approved" : "Pending";
}
        ?>
    </div>
</div>

<?php include('../ainclude/jscript.php'); ?>

<script>
    $(document).ready(function () {
        // Toggle between tree and table views
        $("#treeIcon").click(function () {
            // Already on tree view, no need to redirect
        });

        $("#tableIcon").click(function () {
            window.location.href = 'dashboard.php';
        });

        // Add click function to arrows
        $(".arrow").click(function () {
            var $item = $(this).closest('.user-item');
            var level = $item.data('level');
            var parent = $item.data('parent');
            var $childList = $item.next('.child-list');

            if ($childList.is(':visible')) {
                // Collapse
                $childList.hide();
                $item.removeClass('expanded');
            } else {
                // Expand
                $childList.show();
                $item.addClass('expanded');
            }
        });
    });
</script>

<style>
    /* Add the styles here */
    .toggle-icons {
        text-align: right;
        z-index: 1000;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 30px;
    }

    ion-icon {
        font-size: 24px;
        cursor: pointer;
    }

    ion-icon.active {
        color: #007bff;
    }

    ion-icon:hover {
        color: #007bff;
    }

    #treeView {
        margin-left: 20px;
    }

    .user-list {
        list-style-type: none;
        padding-left: 0;
    }

    .user-item {
        margin-bottom: 20px;
        border-left: 1px solid #ccc;
        padding-left: 10px;
        position: relative;
    }

    .user-info {
        font-weight: bold;
        font-size: 1.5rem;
        margin-left: 20px;
    }

    .arrow {
        position: absolute;
        left: -15px;
        top: 50%;
        cursor: pointer;
        transform: translateY(-50%);
        border: solid #007bff;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 3px;
    }

    .arrow::before {
        content: "";
        position: absolute;
        top: -6px;
        left: -3px;
        width: 12px;
        height: 12px;
        border-left: 2px solid #007bff;
        border-bottom: 2px solid #007bff;
        transform: rotate(45deg);
    }

    .child-list {
        list-style-type: none;
        padding-left: 20px;
        display: none;
    }

    .child-item {
        margin-bottom: 10px;
        border-left: 1px solid #ccc;
        padding-left: 10px;
        position: relative;
    }

    .child-info {
        font-size: 90%;
    }

    .no-referrals,
    .not-referred,
    .no-users {
        color: #888;
        font-style: italic;
    }

    .expanded .arrow::before {
        transform: rotate(-135deg);
    }
</style>

<?php include('../ainclude/footer.php'); ?>
