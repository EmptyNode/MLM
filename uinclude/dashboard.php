<?php
include('../auth.php');
?>

<?php
include('../uinclude/sidebar.php');
include('../uinclude/php/cal_profile_percentage.php');

?>




<div class="container">
    <h2>Dashboard </h2>

    <!-- Display the progress bar -->
    <h5>Profile Completed</h5>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $completionPercentage; ?>"
            aria-valuemin="0" aria-valuemax="100"
            style="width: <?php echo $completionPercentage; ?>%; background-color: <?php echo $barColor; ?>;">
            <strong><span style="color: <?php echo $textColor; ?>; 
                font-size: <?php echo $textSize; ?>; font-style: bold;"><?php echo $completionPercentage; ?>%</span>
            </strong>
        </div>
    </div>
</div>



<?php
include('../uinclude/footer.php');
?>