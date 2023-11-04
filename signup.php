<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

   <div class="container-fluid">
      <h1>Hello</h1>

      <!-- login error message -->
      <?php                               
              //   Show Alert  
               if (!empty($_GET['error'])) 
            {               
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid Username or Password....!</strong> Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';     
            
            }
    ?>
   </div>

   <div class="container-fluid">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Sign Up
      </button>
      <!-- Login link to open modal -->
      <a href="#" id="openLoginModal">Sign Up</a>
   </div>





   <!-- Modal -->

   <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
   <div class="container-fluid">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5 text-lg" id="exampleModalLabel">Sign Up</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <form action="signupp.php" method="POST">
                  <div class="modal-body">
                     <div class="form-group row">
                        <div class="col-md-6">
                           <input type="text" id="firstName" class="form-control mb-3" placeholder="First Name"
                              name="firstName" required>
                        </div>
                        <div class="col-md-6">
                           <input type="text" id="lastName" class="form-control mb-3" placeholder="Last Name"
                              name="lastName" required>
                        </div>
                        <div class="col-md-6">
                           <input type="text" id="addr" class="form-control mb-3" placeholder="Address" name="addr"
                              required>
                        </div>
                        <div class="col-md-6">
                           <input type="text" id="phone" class="form-control mb-3" placeholder="Phone" name="phone"
                              required>
                        </div>
                        <div class="col-md-6">

                           <input type="text" id="aadhaar" class="form-control mb-3" placeholder="Aadhaar"
                              name="aadhaar" required>
                        </div>

                        <div class="col-md-6">

                           <input type="text" id="mobile" class="form-control mb-3" placeholder="Mobile" name="mobile"
                              required>
                        </div>
                        <div class="col-md-6">

                           <input type="text" id="whatsApp" class="form-control mb-3" placeholder="Whats App Number"
                              name="whatsApp" required>
                        </div>


                        <div class="mb-3">
                           <div class="d-flex">
                              <input type="text" id="refferalCode" class="form-control" placeholder="Refferal Code"
                                 name="refferalCode" required>
                              <button type="button" class="btn btn-primary btn-sm mr-2"
                                 id="applyReferralCode">Apply</button>
                              <!-- <div id="referralCodeStatus"></div> -->
                           </div>
                           <small id="referralCodeStatus" class="form-text"></small>
                        </div>

                        <div class="mb-3">
                           <input type="password" id="password" class="form-control" placeholder="Password"
                              name="password" required>
                        </div>
                        <div class="mb-3">

                           <input type="password" id="conf-password" class="form-control" placeholder="Confirm-Password"
                              name="conf-password" required>
                           <!-- For password and confirm-password message -->
                           <small id="password-match-message" class="form-text"></small>
                        </div>

                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary" id="registerButton" name="register">Register</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                  </div>
               </form>

            </div>
         </div>
      </div>
   </div>

   <!-- Include JavaScript libraries -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



   <!-- Open login modal when link is clicked -->
   <script>
   $(document).ready(function() {
      $('#openLoginModal').click(function() {
         $('#exampleModal').modal('show');
      });
   });


   // to auto dissapear alert
   $(document).ready(function() {

      window.setTimeout(function() {
         $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
         });
      }, 5000);

   });

   //  check password and confirm-password is matched  
   $(document).ready(function() {
      $('#conf-password').keyup(function() {
         var password = $('#password').val();
         var confirmPassword = $('#conf-password').val();

         if (password === confirmPassword) {
            $('#password-match-message').text('Passwords Matched.');
            $('#password-match-message').removeClass('text-danger').addClass('text-success');
         } else {
            $('#password-match-message').text('Passwords do not Matched.');
            $('#password-match-message').removeClass('text-success').addClass('text-danger');
         }
      });


      // to check referral code is present in database or not
      $('#applyReferralCode').click(function() {
         var referralCode = $('#refferalCode').val();

         $.ajax({
            url: 'check_referral.php',
            type: 'POST',
            data: {
               referralCode: referralCode
            },
            success: function(response) {
               if (response === 'valid') {
                  $('#referralCodeStatus').removeClass('text-danger').addClass(
                     'text-success');
                  $('#referralCodeStatus').text('Valid Referral Code.');
               } else {
                  $('#referralCodeStatus').removeClass('text-success').addClass(
                     'text-danger');
                  $('#referralCodeStatus').text('Invalid Referral Code.');
               }
            }
         });
      });

   });
   </script>

</body>

</script>

</html>