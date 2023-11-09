<?php
// session_start();
include('php/db_conn.php');
include('../auth.php');
?>

<?php
include('../uinclude/sidebar.php');
?>


<!-- open add service modal -->
<div class="container-fluid">
   <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Add Service</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="php/addservice.php" method="POST" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="form-group row">
                     <div class="col-md-6">
                        <!-- <input type="text" id="service" class="form-control mb-3" placeholder="Service"
                                    name="service" required> -->
                        <select id="service" class="form-select mb-3" placeholder="Service" name="service"
                           required></select>

                     </div>
                     <div class="col-md-6">
                        <input type="text" id="location" class="form-control mb-3" placeholder="Location"
                           name="location" required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="addr" class="form-control mb-3" placeholder="Address" name="addr"
                           required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="pincode" class="form-control mb-3" placeholder="Pincode" name="pincode"
                           required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="mobile" class="form-control mb-3" placeholder="Mobile" name="mobile"
                           oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           maxlength="10" pattern="[0-9]{10}" title="Please enter 10 Digit Mobile Number only" required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="whatsapp" class="form-control mb-3" placeholder="Whats App"
                           name="whatsapp"
                           oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           maxlength="10" pattern="[0-9]{10}" title="Please enter 10 Digit Mobile Number only" required>
                     </div>
                     <div class="col-md-6">
                        <input type="email" id="email" class="form-control mb-3" placeholder="E-mail" name="email"
                           required>
                     </div>

                     <div class="col-md-6">
                        <input type="file" id="img" class="form-control mb-3" name="image" title="Image Size Max 5 MB"
                           accept="image/*">
                     </div>
                     <div class="invalid-feedback" id="imageFeedback">
                        Please select a valid image (JPG, JPEG, PNG) with a maximum size of 5MB.
                     </div>

                     <!-- <div class="col-md-6"> -->

                     <!-- <p class="mb-2">Mobile No.</p> -->
                     <!-- <div class="col-md-6">

                                <input type="text" id="mobile" class="form-control mb-3" placeholder="Mobile"
                                    name="mobile"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                                    maxlength="10" pattern="[0-9]{10}" title="Please enter 10 Digit Phone Number only"
                                    required>
                                <small id="mobileAvailability" class="form-text"></small>
                            </div> -->

                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="registerButton" name="saveService">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

               </div>
            </form>

         </div>
      </div>
   </div>
   <!-- Modal for updating a service -->
   <div class="modal fade" id="updateServiceModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Add Service</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="php/updateservice.php" method="POST" enctype="multipart/form-data">
               <input type="hidden" id="update_sm_id" name="update_sm_id" value="" />

               <div class="modal-body">
                  <div class="form-group row">
                     <div class="col-md-6">
                        <select id="updateservice" class="form-select mb-3" placeholder="Service" name="service"
                           required></select>

                     </div>
                     <div class="col-md-6">
                        <input type="text" id="location" class="form-control mb-3" placeholder="Location"
                           name="location" required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="addr" class="form-control mb-3" placeholder="Address" name="addr"
                           required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="pincode" class="form-control mb-3" placeholder="Pincode" name="pincode"
                           required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="mobile" class="form-control mb-3" placeholder="Mobile" name="mobile"
                           oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           maxlength="10" pattern="[0-9]{10}" title="Please enter 10 Digit Mobile Number only" required>
                     </div>
                     <div class="col-md-6">
                        <input type="text" id="whatsapp" class="form-control mb-3" placeholder="Whats App"
                           name="whatsapp"
                           oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > 10) this.value = this.value.slice(0, 10);"
                           maxlength="10" pattern="[0-9]{10}" title="Please enter 10 Digit Mobile Number only" required>
                     </div>
                     <div class="col-md-6">
                        <input type="email" id="email" class="form-control mb-3" placeholder="E-mail" name="email"
                           required>
                     </div>

                     <div class="col-md-6">
                        <input type="file" id="img" class="form-control mb-3" name="image" title="Image Size Max 5 MB"
                           accept="image/*">
                     </div>
                     <div class="invalid-feedback" id="imageFeedback">
                        Please select a valid image (JPG, JPEG, PNG) with a maximum size of 5MB.
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="registerButton" name="updateService">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>



<div class="container-fluid">
   <!-- <div class="container"> -->
   <!-- <div class="row"> -->
   <!-- <div class="col-md-12"> -->
   <?php
   if (isset($_SESSION['status'])) {
      echo "<h4>" . $_SESSION['status'] . "</h4>";
      unset($_SESSION['status']);
   }

   ?>

   <div class="card ">
      <div class="card-header">
         <h3 class="card-title">Services
            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal" href="#">Add</a>
         </h3>
      </div>
   </div>

   <!-- <div style="height: 100vh;"> -->
   <div class="table-responsive" style="height: 70vh; overflow-y: auto;">
      <table class="table">
         <thead class="table-light">
            <tr>
               <th scope="col">#</th>
               <th scope="col">Id</th>
               <th scope="col">Service</th>
               <th scope="col">Location</th>
               <th scope="col">Address</th>
               <th scope="col">PinCode</th>
               <th scope="col">Mobile</th>
               <th scope="col">Whats App</th>
               <th scope="col">E-mail</th>
               <th scope="col">Image</th>
               <th scope="col"></th>
            </tr>
         </thead>
         <tbody>
            <?PHP
            $user_id = $_SESSION['uId'];
            $query = "SELECT * FROM service_master WHERE user_id = '$user_id'";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
               foreach ($query_run as $row) {
                  $val = $row['sm_id']; ?>

                  <tr>
                     <th scope="row">1</th>
                     <td>
                        <?php echo $row['sm_id'] ?>
                     </td>
                     <td>
                        <?php echo $row['service'] ?>
                     </td>
                     <td>
                        <?php echo $row['location'] ?>
                     </td>
                     <td>
                        <?php echo $row['addr'] ?>
                     </td>
                     <td>
                        <?php echo $row['pin'] ?>
                     </td>
                     <td>
                        <?php echo $row['mobile'] ?>
                     </td>
                     <td>
                        <?php echo $row['whatsapp'] ?>
                     </td>
                     <td>
                        <?php echo $row['email'] ?>
                     </td>
                     <td>
                        <img src="<?php echo $row['img'] ?>" alt="Service Image" width="50">
                     </td>
                     <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteRow(<?php echo $val; ?>)">Delete</button>
                        <!-- Inside your loop where you have $val -->
                        <button class="btn btn-success btn-sm update-btn" data-bs-toggle="modal"
                           data-bs-target="#updateServiceModal" data-sm-id="<?php echo $val; ?>">Update</button>


                     </td>
                  </tr>
                  <?php
               }
            }
            ?>

         </tbody>
      </table>
   </div>
</div>

<script>
   //  To check image size and proper image format 
   const imageInput = document.getElementById('img');
   const imageFeedback = document.getElementById('imageFeedback');

   imageInput.addEventListener('change', function () {
      const file = this.files[0];
      const allowedFormats = ['image/jpeg', 'image/png'];

      if (file) {
         if (!allowedFormats.includes(file.type)) {
            imageInput.setCustomValidity(
               'Invalid image format. Please select a JPG, JPEG, or PNG image.');
            imageFeedback.style.display = 'block';
         } else if (file.size > 5 * 1024 * 1024) {
            imageInput.setCustomValidity('Image size exceeds the maximum limit of 5MB.');
            imageFeedback.style.display = 'block';
         } else {
            imageInput.setCustomValidity('');
            imageFeedback.style.display = 'none';
         }
      }
   });

   // Fetch data from database to select dropdown in add service modal
   document.addEventListener("DOMContentLoaded", function () {
      const dropdown = document.getElementById('service');

      fetch('php/fetch_service_category.php')
         .then(response => response.json())
         .then(data => {
            data.forEach(option => {
               const optionElement = document.createElement('option');
               optionElement.textContent = option.s_category;
               var element = dropdown.appendChild(optionElement);
            });
         });
   });

   document.addEventListener("DOMContentLoaded", function () {
      const dropdown = document.getElementById('updateservice');

      fetch('php/fetch_service_category.php')
         .then(response => response.json())
         .then(data => {
            data.forEach(option => {
               const optionElement = document.createElement('option');
               optionElement.textContent = option.s_category;
               var element = dropdown.appendChild(optionElement);
            });
         });
   });

   function deleteRow(smId) {
      if (confirm("Are you sure you want to delete this row?")) {
         let xhr = new XMLHttpRequest();
         xhr.open("POST", "delete_row.php", true);
         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               // Row deleted successfully, remove it from the table
               let row = document.querySelector("tr[data-sm-id='" + smId + "']");
               if (row) {
                  row.remove();
               }

               location.reload();
            }
         };
         xhr.send("sm_id=" + smId);
         console.log(smId);
      }
   }

   document.querySelectorAll('.update-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
         // Get the sm_id value from the data-sm-id attribute of the clicked button
         var smId = this.getAttribute('data-sm-id');

         // Set the value to the hidden input field in the form
         document.getElementById('update_sm_id').value = smId;
      });
   });
</script>





<?php
include('../uinclude/footer.php');
?>