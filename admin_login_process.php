<?php
session_start();

include "db_conn.php";


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     // Replace with your authentication logic
//     if (empty($username)){

//         $_SESSION["login_error"] = "Invalid credentials. Please try again.";
//         header("Location: adminlogin.php");
//         exit();

//     //(!empty(($username === "admin" && $password === "password")) {
//     }else if (empty($password)){
//         // $_SESSION["login_error"] = "Password is required. Please try again.";
//         header("Location: adminlogin.php?login_error=1");
//        // exit();

//     } else {
//         session_start();

//         $_SESSION["username"] = $username;
//         header("Location: adminlogin.php");
//         exit();

//        // exit();
//     }
// }



session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {

  // form validation
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);

  if (empty($username)) {
    header("Location: adminlogin.php?error=Username is required");
  } else if (empty($password)) {
    header("Location: adminlogin.php?error=Password is required");
  } else {

    // Hasing password

    $password = md5($password);

    $sql = "SELECT * FROM admin WHERE username   = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);

      // if ($row['$password'] === $password) {           
      $_SESSION['id'] = $row['id'];
      $_SESSION['first_name'] = $row['first_name'];
      $_SESSION['last_name'] = $row['last_name'];
      $_SESSION['username'] = $row['username'];

      header("Location: ainclude/dashboard.php");


      // }else {
      //     header("Location: adminlogin.php?error=Invalid credentials. Please try again.");
      // }

    } else {
      header("Location: adminlogin.php?error=Invali UserName or Password");

    }

    // $row["username"] = $username;
    // header("Location: adminlogin.php");
    // } else {
    //     header("Location: adminlogin.php?error=Invalid credentials. Please try again.");
    // }
  }

} else {
  header("Location: adminlogin.php");
}






















// require_once("config.php");
// if(isset($_POST['subLogin']))
// {
//     $login=$_POST['login_var'];
//     $password=$_POST['password'];
//     $query="SELECT * FROM admin WHERE (username='$login')";
//     $res=mysqli_query($dbc,$query);
//     $numRows=mysqli_num_rows($res);
//     if($numRows==1){
//         $row=mysqli_fetch_assoc($res);
//         if($password_verify($password,$row['password'])){
//             $_SESSION['login_sess']="1";
//             $_SESSION['login_user']=$row=['username'];
//             header("location:dashboard.php");
//         }
//         else{
//             header("location:adminlogin.php?loginerror=" .$login);
//         }
//     }else{
//         header("location:adminlogin.php?loginerror=" .$login);
//     }
// }

?>