<?php
include '../../Models/config.php';

$sql = "SELECT * FROM foods";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <thead>
              <tr>
                <th width="60px">Id</th>
                <th>Food Name</th>
                <th>Food Description</th>
                <th>Price</th>
                <th>Code</th>
                <th>Catagory</th>
                <th>Images</th>
                <th width="90px">Edit</th>
                <th width="90px">Delete</th>
              </tr>
              </thead>';

              while($row = mysqli_fetch_assoc($result)){
                $catSql = "SELECT name FROM catagories WHERE id={$row['catagory_id']}";
  $catResult = mysqli_query($conn, $catSql) or die("SQL Query Failed.");
  $catRow = mysqli_fetch_assoc($catResult);
                $output .= "<tbody><tr><td align='center'>{$row["id"]}</td><td align='center'>{$row["food_name"]}</td> <td align='center'>{$row["description"]}</td><td align='center'>{$row["price"]}</td><td align='center'>{$row["code"]}</td><td align='center'>{$catRow["name"]}</td> <td align='center'><img src='../../Controller/Items/{$row["image"]}' height='50px' width='50px'></td> <td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td><td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr></tbody>";
              }
    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>
