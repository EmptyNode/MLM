<!-- <?php
// to hashing password
// echo md5("admin");
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">

        <form class="border shadow p-3 rounded" action="admin_login_process.php" method="POST" style="width: 450px">

            <div class="modal-header">
                <h1 class="text-left">ADMIN LOGIN</h1>
                <button type="button" id="closeIcon" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <?php
            if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_GET['error'] ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for=" username" class="form-label">User Name</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password" id="password" aria-describedby="emailHelp">
            </div>

            <!-- <div class="btn-group float-end p-3"> -->
            <div class="btn-group float-end">

                <button type="submit" class="btn btn-primary mx-2">Login</button>
                <button type="button" id="closeForm" class="btn btn-secondary">Close</button>
            </div>


    </div>

    </form>

    </div>

    <script>
        //  Add event listener to the Cancel button
        document.getElementById("closeIcon").addEventListener("click", function () {
            // Close the form (optional)
            document.querySelector("form").reset();
            // Navigate to the home page
            window.location.href = "index.php";
        });
        document.getElementById("closeForm").addEventListener("click", function () {
            // Close the form (optional)
            document.querySelector("form").reset();
            // Navigate to the home page
            window.location.href = "index.php"; // 
        });
    </script>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js">
</script>

</html>