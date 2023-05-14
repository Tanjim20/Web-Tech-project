<?php
session_start();
error_reporting(E_ALL);

if(isset($_POST['update'])){

        include('../Models/config.php');

         $name  =    $_POST['name'];
         $email =    $_POST['email'];
         $mobile =    $_POST['mobile'];
         $address =    $_POST['address'];


        if(!empty($name) && !empty($email) && !empty($mobile) && !empty($address)){

  
            $loggedInUser = $_SESSION['admin_name'];
            
            $sql = "UPDATE user SET name = '$name', email ='$email', mobile ='$mobile', address='$address' WHERE name = '$loggedInUser'";
            $results = mysqli_query($conn,$sql);
            header('Location:../Views/Admin/adminProfile.php');
        exit;
        }
    }
                
        

?>