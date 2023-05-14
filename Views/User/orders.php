<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
    <?php include "userHeader.php" ?>
  <link rel="stylesheet" href="../../Assets/Css/user1.css">
  <table class="table" style="margin:30px;">
<thead>
<tr>
<th>Id</th>
<th>Food Name</th>
<th>Quantity</th>
<th>Total Price</th>
<th>Status</th>
</tr>
</thead>
<tbody>
    <?php
  $currentUser = $_SESSION['user_name'];

$result = mysqli_query($conn,"SELECT * FROM `orders` where user_name = '$currentUser'  ORDER BY id DESC");
while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['food_name'] ?></td>
    <td><?php echo $row['quantity'] ?></td>
    <td><?php echo $row['total_price'] ?></td>
    <td><?php echo $row['status'] ?></td>
    </tr>

    <?php
} ?>
</tbody>
</table>
</body>
</html>