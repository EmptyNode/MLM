<?php 
include_once("generate_excel.php");
?>

<meta charset="UTF-8" />
<title>Reports</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<title>phpflow.com </title>
<style>
    /* Custom CSS for equal height of dropdown buttons */
    .btn-group .btn {
        height: 34px; /* Adjust the height as needed */
    }

    .btn-group .dropdown-toggle {
        height: 34px !important; /* Adjust the height as needed */
    }
</style>

<div id="container">
    <div class="col-sm-6 pull-left">
        <div class="well well-sm col-sm-12">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-info">Action</button>
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>

                <ul class="dropdown-menu" role="menu" id="export-menu">
                    <li id="export-to-excel"><a href="#">Export to excel</a></li>

                    <li class="divider"></li>

                    <li><a href="#">Other</a></li>
                </ul>
            </div>
        </div>

        <form action="generate_excel.php" method="post" id="export-form">
            <input type="hidden" value="" id="hidden-type" name="ExportType" />
        </form>

        <table id="" class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th>Name</th>

                    <th>Parent</th>

                    <th>Contact</th>

                    <th>Refferel</th>
                </tr>
            </tbody>
            <tbody>
                <?php foreach($tasks as $row):?>

                <tr>
                    <td><?php echo $row ['firstName']?></td>

                    <td><?php echo $row ['parent_id']?></td>

                    <td><?php echo $row ['mobile']?></td>

                    <td><?php echo $row ['auto_referralCode']?></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('#export-to-excel').bind("click", function() {
        var target = $(this).attr('id');
        switch(target) {
            case 'export-to-excel':
                $('#hidden-type').val(target);
                $('#export-form').submit();
                $('#hidden-type').val('');
                break;
        }
    });
});

</script>