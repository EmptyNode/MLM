<?php
include_once("generate_excel.php");
?>

<?php
include('../ainclude/sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-14">
                <div class="well well-sm col-sm-12">
                    <!-- Date Selectors -->
                    <div class="form-group">
                        <label for="start-date">Start Date:</label>
                        <input type="text" class="form-control datepicker" id="start-date" name="start_date" placeholder="Select start date" readonly>
                    </div>

                    <div class="form-group">
                        <label for="end-date">End Date:</label>
                        <input type="text" class="form-control datepicker" id="end-date" name="end_date" placeholder="Select end date" readonly>
                    </div>

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"></button>
                        <ul class="dropdown-menu" role="menu" id="export-menu">
                            <li id="export-joining-excel" class="export-option"><a href="#">Export joining report</a></li>
                            <li id="export-network-excel" class="export-option"><a href="#">Export network report</a></li>
                            <li id="export-pincode-excel" class="export-option"><a href="#">Export pincode wise report</a></li>
                            <li id="export-payment-excel" class="export-option"><a href="#">Export payment report</a></li>
                            <li id="export-pnl-excel" class="export-option"><a href="#">Export Profit & Loss report</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </div>
                </div>

                <form action="generate_excel.php" method="post" id="export-form">
                    <input type="hidden" value="" id="hidden-type" name="ExportType" />
                    <input type="hidden" value="" id="hidden-report-type" name="reportType" />
                </form>
            </div>
        </div>
    </div>

    <?php
    include('../ainclude/jscript.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize datepickers
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                // endDate: currentDate
            });

            $('.export-option').on("click", function(e) {
                e.preventDefault(); // Prevent the default action
                // Get selected dates
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();

                console.log("Start Date:", startDate);
                console.log("End Date:", endDate);

                var target = $(this).attr('id');
                var reportType = $('#hidden-report-type').val();
                $('#hidden-type').val(target);
                $('#hidden-report-type').val(reportType);
                $('#export-form').append('<input type="hidden" name="startDate" value="' + startDate + '">');
                $('#export-form').append('<input type="hidden" name="endDate" value="' + endDate + '">');
                $('#export-form').submit();
                $('#hidden-type').val('');
            });

        });
    </script>

    <?php include('../ainclude/footer.php'); ?>

</body>

</html>