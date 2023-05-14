<?php

include '../../Models/config.php';


$cat_id = $_POST["id"];


$sql = "DELETE FROM catagories WHERE id = {$cat_id}";

if (mysqli_query($conn, $sql)){
  echo 1;
} else {
  echo 0;
}

?>
