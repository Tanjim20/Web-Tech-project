<?php
include '../../Models/config.php';

$food_name = $_POST["food_name"];
$description = $_POST["description"];
$price = $_POST["price"];
$code = $_POST["code"];
$catagory_id = $_POST["catagory_id"];
$IMAGE = $_FILES['image'];
$img_loc = $_FILES['image']['tmp_name'];
$img_name = $_FILES['image']['name'];
$img_des = "uploadImage/".$img_name;
move_uploaded_file($img_loc, 'uploadImage/'.$img_name);

$sql = "INSERT INTO foods (food_name, description, price, code, catagory_id, image) VALUES ('{$food_name}','{$description}', '{$price}','{$code}', '{$catagory_id}', '{$img_des}')";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}
?>
