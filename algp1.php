<?php
session_start();

include "db_conn.php";


if (isset($_POST["username"]) && isset($_POST["password"])) 
{
     
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

      if (empty($username)) 
      {
         header("Location: adminlogin_modalTest.php?error=Username is required");
      }else if (empty($password)) 
      {
        header("Location: adminlogin_modalTest.php?error=Password is required");
      } else 
      {

        // Hasing password

        $password = md5($password);

       $sql = "SELECT * FROM admin WHERE username   = '$username' AND password = '$password'";
       $result = mysqli_query($conn, $sql);
       if(mysqli_num_rows($result) === 1) 
       {
        $row = mysqli_fetch_assoc($result);        

        // if ($row['$password'] === $password) {           
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['username'] = $row['username'];

            header("Location: dashboard.php");

            
        // }else {
        //     header("Location: adminlogin.php?error=Invalid credentials. Please try again.");
        // }

       }else 
       {
        header("Location: adminlogin_modalTest.php?error=Invali UserName or Password");

       }        
      }
      
} else 
{
    header("Location: adminlogin_modalTest.php");
}









?>