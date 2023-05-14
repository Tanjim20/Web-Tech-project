<?php
include '../../Models/config.php';

$search_value = $_POST["search"];

$sql = "SELECT * FROM orders WHERE user_name LIKE '%{$search_value}%' ORDER BY id DESC ";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <tr>
              <th width="60px">Id</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Address</th>
              <th>Food Names</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Status</th>
              </tr>';

              while($row = mysqli_fetch_assoc($result)){
                $output .= "<tbody><tr><td align='center'>{$row["id"]}</td><td align='center'>{$row["user_name"]}</td><td align='center'>{$row["email"]}</td><td align='center'>{$row["mobile"]}</td><td align='center'>{$row["address"]}</td><td align='center'>{$row["food_name"]}</td><td align='center'>{$row["quantity"]}</td><td align='center'>{$row["total_price"]}</td><td align='center'><form method='post' action='../../Controller/AdminOrders/statusChanged.php'>
                            <input type='hidden' name='id' value='{$row["id"]}'>
                            <select name='status'>
                            <option value='{$row["status"]}'>{$row["status"]}</option>
                            <option value='Pending'>Pending</option>
                            <option value='Confirmed'>Confirmed</option>
                            <option value='Cooking'>Cooking</option>
                            <option value='On The Way'>On The Way</option>
                            <option value='Delivered'>Delivered</option></select>
                            <input type='submit' name='save' value='Save'></form></td></tr></tbody>";
              }
              $output .= "</table>";

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
