<?php
include '../../Models/config.php';

$food_id = $_POST["id"];
$food_name = $_POST["food_name"];
$description = $_POST["description"];
$price = $_POST["price"];
$code = $_POST["code"];
$catagory_id = $_POST["catagory_id"];


$sql = "UPDATE foods SET food_name = '{$food_name}', description = '{$description}', price = '{$price}', code = '{$code}', catagory_id = '{$catagory_id}' WHERE id = {$food_id}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
