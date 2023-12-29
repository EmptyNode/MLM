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

                    <li>
                        <a href="#">Other</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-6">
    <label for="report-type">Select Report Type:</label>
    <select class="form-control" id="report-type" name="reportType">
        <option value="user_report">User Report</option>
        <option value="other_report">Other Report</option>
        <!-- Add more options for different reports as needed -->
    </select>
</div>

<div class="col-sm-6">
    <label for="start-date">Select Start Date:</label>
    <input type="date" class="form-control" id="start-date" name="startDate">
</div>

<div class="col-sm-6">
    <label for="end-date">Select End Date:</label>
    <input type="date" class="form-control" id="end-date" name="endDate">
</div>

        <form action="generate_excel.php" method="post" id="export-form">
            <input type="hidden" value="" id="hidden-type" name="ExportType" />
            <input type="hidden" value="" id="hidden-report-type" name="reportType" />
        </form>

        <table id="" class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Contact</th>
                    <th>Referral</th>
                </tr>
            </tbody>
            <tbody>
                <?php foreach($tasks as $row): ?>
                    <tr>
                        <td><?php echo $row['firstName']?></td>
                        <td><?php echo $row['parent_id']?></td>
                        <td><?php echo $row['mobile']?></td>
                        <td><?php echo $row['auto_referralCode']?></td>
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
            var reportType = $('#report-type').val();
            
            switch(target) {
                case 'export-to-excel':
                    $('#hidden-type').val(target);
                    $('#hidden-report-type').val(reportType);
                    $('#export-form').submit();
                    $('#hidden-type').val('');
                    break;
            }
        });
    });
</script>
