<?php
include '../../Models/config.php';

$user_name = $_POST["user_name"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$address = $_POST["address"];
$food_name = $_POST["food_name"];
$quantity = $_POST["quantity"];
$total_price = $_POST["total_price"];

$sql = "INSERT INTO orders (user_name, email, mobile, address, food_name, quantity, total_price) VALUES ('{$user_name}', '{$email}', '{$mobile}', '{$address}', '{$food_name}', '{$quantity}', '{$total_price}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}
?>
