<?php
include '../../Models/config.php';

$cat_id = $_POST["id"];
$name = $_POST["name"];


$sql = "UPDATE catagories SET name = '{$name}' WHERE id = {$cat_id}";

if (mysqli_query($conn, $sql)) {
  echo 1;
}else {
  echo 0;
}

?>
