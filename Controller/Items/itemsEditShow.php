<?php
include '../../Models/config.php';

$food_id = $_POST["id"];

$sql = "SELECT * FROM foods WHERE id = {$food_id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $catSql = "SELECT id, name FROM catagories";
    $catResult = mysqli_query($conn, $catSql) or die("SQL Query Failed.");
    $catOptions = "";
    while ($catRow = mysqli_fetch_assoc($catResult)) {
      $selected = ($catRow["id"] == $row["catagory_id"]) ? "selected" : "";
      $catOptions .= "<option value='{$catRow["id"]}' {$selected}>{$catRow["name"]}</option>";
    }
    $output .= "<tr>
      <td width='90px'>Food Name</td>
      <td><input type='text' id='edit-food_name' value='{$row["food_name"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}'>
      </td>
    </tr>
    <tr>
      <td>Food Description</td>
      <td><input type='text' id='edit-description' value='{$row["description"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'></td>
    </tr>
    <tr>
      <td>Food Price</td>
      <td><input type='text' id='edit-price' value='{$row["price"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'></td>
    </tr>
    <tr>
      <td>Code</td>
      <td><input type='text' id='edit-code' value='{$row["code"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'></td>
    </tr>
    <tr>
      <td>Catagory</td>
      <td>
        <select id='edit-catagory_id'>
          {$catOptions}
        </select>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='Save' style='margin-top:5px; padding:5px; border:none; border-radius: 5px; background:lightsalmon; cursor:pointer; font-size:18px; font-weight:700;'></td>
    </tr>";

  }

  mysqli_close($conn);

  echo $output;
}else{
  echo "<h2>No Record Found.</h2>";
}

?>
