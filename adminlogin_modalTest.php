<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">



</head>

<body>

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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Login
    </button>
    <!-- Login link to open modal -->
    <a href="#" id="openLoginModal">Login</a>






    <!-- Modal -->

    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Admin Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="algp1.php" method="POST">
                    <div class="modal-body">
                        <input type="text" id="username" class="form-control" placeholder="Username" name="username"
                            required>
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="loginButton" name="login">Login</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Include JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





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
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js">
</script>

</html>