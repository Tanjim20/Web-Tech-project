<?php

@include '../../Models/config.php';

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
echo "<h1 class='user-title'>Fastfood</h1>";
$result = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 12");
while($row = mysqli_fetch_assoc($result)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>
<div class="boxes">
<?php
echo "<h1 class='user-title'>Breakfast</h1>";
$result2 = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 8");
while($row = mysqli_fetch_assoc($result2)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>
<div class="boxes">
<?php
echo "<h1 class='user-title'>Lunch</h1>";
$result3 = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 9");
while($row = mysqli_fetch_assoc($result3)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>
<div class="boxes">
<?php
echo "<h1 class='user-title'>Snacks</h1>";
$result4 = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 10");
while($row = mysqli_fetch_assoc($result4)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>
<div class="boxes">
<?php
echo "<h1 class='user-title'>Diner</h1>";
$result5 = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 11");
while($row = mysqli_fetch_assoc($result5)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>
<div class="boxes">
<?php
echo "<h1 class='user-title'>Drinks</h1>";
$result6 = mysqli_query($conn,"SELECT * FROM `foods` where catagory_id = 13");
while($row = mysqli_fetch_assoc($result6)){
    echo "
    <div>
    <form method='post' action=''>
    <input type='hidden' name='code' value=".$row['code']." />
    <img src='../../Controller/Items/{$row["image"]}' />
    <p>".$row['food_name']."</p>
    <p>".$row['description']."</p>
    <p>$".$row['price']."</p>
    <button type='submit' class='buy'>Add To Cart</button>
    </form>
    </div>";
    }echo "<br>";
?>
</div>


    
   <?php include 'footer.php'?>
</body>
</html>