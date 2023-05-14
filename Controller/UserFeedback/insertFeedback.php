<?php
include '../../Models/config.php';

$name = $_POST["name"];
$feedback = $_POST["feedback"];

$sql = "INSERT INTO feedback (name, feedback) VALUES ('{$name}','{$feedback}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}
?>
