<?php
include '../../Models/config.php';
if(isset($_POST['save'])) {
  $id = $_POST['id'];
  $new_status = $_POST['status'];

  $sql = "UPDATE orders SET status='$new_status' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  if($result){
    header('location:../../Views/Admin/orders.php');
  }else {
    header('location:../../Views/Admin/orders.php');
    echo "Something went wrong try again!";
  }
}
?>