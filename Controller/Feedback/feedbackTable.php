<?php
include '../../Models/config.php';

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <thead>
              <tr>
                <th width="60px">Id</th>
                <th>Name</th>
                <th>Feedback</th>
              </tr>
              </thead>';

              while($row = mysqli_fetch_assoc($result)){
                $output .= "<tbody><tr><td align='center'>{$row["id"]}</td><td align='center'>{$row["name"]}</td><td align='center'>{$row["feedback"]}</td></tr></tbody>";
              }
    $output .= "</table>";

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>
