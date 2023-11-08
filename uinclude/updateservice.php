include('php/db_conn.php');

if (isset($_POST['updateService'])) {
    // Retrieve the form data
    $serviceId = $_POST['updateServiceId'];
    $service = $_POST['service'];
    $location = $_POST['location'];
    $addr = $_POST['addr'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];

    // Update the row in the service_master table
    $query = "UPDATE service_master SET service = ?, location = ?, addr = ?, pin = ?, mobile = ?, whatsapp = ?, email = ? WHERE sm_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, 'sssssssi', $service, $location, $addr, $pincode, $mobile, $whatsapp, $email, $serviceId);

    // Execute the update
    if (mysqli_stmt_execute($stmt)) {
        // Update was successful
        mysqli_stmt_close($stmt);
        header("Location: your_page_with_updated_data.php");
        exit();
    } else {
        // Update failed
        echo "Update failed: " . mysqli_error($conn);
    }
} else {
    // Handle the case where the form wasn't submitted
    echo "Form not submitted.";
}
?>