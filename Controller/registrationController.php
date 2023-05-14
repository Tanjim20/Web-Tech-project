<?php
if(isset($_POST['submit'])){


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
 
    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error[] = 'user already exist!';
 
    }else{
 
       if($pass != $cpass){
          $error[] = 'password not matched!';
       }else{
       
          $insert = "INSERT INTO user (name, email, mobile, address, gender, password, user_type) VALUES('$name','$email','$mobile', '$address', '$gender', '$pass', '$user_type')";
 
          mysqli_query($conn, $insert);
          header('location:../Views/login.php');
       }
    }
 
 };
?>