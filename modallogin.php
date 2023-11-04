<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">Login</button>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/login" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#loginModal').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/login',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success) {
                        // The user has logged in successfully.
                        window.location.href = '/';
                    } else {
                        // The login attempt was unsuccessful.
                        $('#loginModal .modal-body').html(data.error);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>



</body>

</html>


<?php

// // Connect to the database
// $db = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');

// // Check the login credentials
// $email = $_POST['username'];
// $password = $_POST['password'];

// $sql = "'SELECT * FROM users WHERE username = '$email' AND password = '$password'";
// $stmt = $db->prepare($sql);
// $stmt->bindParam(':email', $email);
// $stmt->bindParam(':password', $password);
// $stmt->execute();

// $user = $stmt->fetch();

// if ($user) {
//   // The login attempt was successful
//   echo json_encode([
//     'success' => true,
//   ]);
// } else {
//   // The login attempt was unsuccessful
//   echo json_encode([
//     'success' => false,
//     'error' => 'Invalid email or password.',
//   ]);
// }

?>