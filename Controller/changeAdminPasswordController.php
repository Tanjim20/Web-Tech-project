<?php
session_start();

if (isset($_SESSION['admin_name'])) {

    include "../Models/config.php";

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: ../Views/Admin/changePassword.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: ../Views/Admin/changePassword.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: ../Views/Admin/changePassword.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	$op = md5($op);
    	$np = md5($np);
        $name = $_SESSION['admin_name'];

        $sql = "SELECT password
                FROM user WHERE 
                name='$name' AND password='$op'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE user
        	          SET password='$np'
        	          WHERE name='$name'";
        	mysqli_query($conn, $sql_2);
        	header("Location: ../Views/Admin/changePassword.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: ../Views/Admin/changePassword.php?error=Incorrect Old password");
	        exit();
        }

    }

    
}else{
	header("Location: ../Views/Admin/changePassword.php");
	exit();
}

}else{
     header("Location: ../Views/Admin/changePassword.php");
     exit();
}