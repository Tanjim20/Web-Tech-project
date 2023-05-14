<?php
include '../../Models/config.php';

$cat_id = $_POST["id"];

$sql = "SELECT * FROM catagories WHERE id = {$cat_id}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if (mysqli_num_rows($result) > 0 ) {

  while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>
      <td width='90px'>Food Name</td>
      <td><input type='text' id='edit-name' value='{$row["name"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}' style='width: 300px; font-size: 18px; padding: 3px 10px; border-radius: 4px; border: 1px solid #000;'>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save' style='margin-top:5px; padding:5px; border:none; border-radius: 5px; background:lightsalmon; cursor:pointer; font-size:18px; font-weight:700;'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else {
    echo "<h2>No Record Found.</h2>";
}

?>
