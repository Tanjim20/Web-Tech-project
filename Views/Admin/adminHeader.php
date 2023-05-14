<?php

include '../../Models/config.php';
require '../../Controller/loginController.php';


if(!isset($_SESSION['admin_name'])){
   header('location:../login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/Css/adminHeader.css">
</head>
<body>
    <div class="header">
        <div class="header-img">
            <img src="../../Assets/Images/Logo.jpg" alt="">
        </div>
        <div class="header-tabs">
            <a class="profile" href="adminProfile.php"><img src="../../Assets/Images/user.png" alt="">
            <h3 class="login-as"><?php echo $_SESSION['admin_name'] ?></h3></a>
            <a class="logout" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>