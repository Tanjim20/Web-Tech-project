<?php
include '../../Models/config.php';

$name = $_POST["name"];


$sql = "INSERT INTO catagories (name) VALUES ('{$name}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}


?>
