<?php

include '../../Models/config.php';

include 'userHeader.php';

$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query(
$conn,
"SELECT * FROM `foods` WHERE `code`='$code'"
);
$row = mysqli_fetch_assoc($result);
$food_name = $row['food_name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'food_name'=>$food_name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div style='color:lightskyblue;'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
	$status = "<div style='color:red;'>
	Product is already added to your cart!</div>";
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div style='color:lightskyblue;'>Product is added to your cart!</div>";
	}

	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../../Assets/Css/user1.css">

</head>
<body>
    
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart">
<a href="cart.php"> Cart (<span>
<?php echo $cart_count; ?></span> )</a>
</div>
<?php
}
?>
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<div class="boxes">

<?php
$result = mysqli_query($conn,"SELECT * FROM `foods`");
while($row = mysqli_fetch_assoc($result)){
    echo "<div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
        }
mysqli_close($conn);
?>
</div>
    
   <?php include 'footer.php'?>
</body>
</html>