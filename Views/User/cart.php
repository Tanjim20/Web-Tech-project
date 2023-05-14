<?php

include 'userHeader.php';

$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
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
  <title>Cart</title>
  <link rel="stylesheet" href="../../Assets/Css/admin.css">
  <link rel="stylesheet" href="../../Assets/Css/user1.css">
</head>
<body>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<div class="cart-box">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<thead>
<tr>
<th>Image</th>
<th>Food Name</th>
<th>Quantity</th>
<th>Unit Price</th>
<th>Sub Total</th>
</tr>
</thead>
<tbody>
<?php
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td>
<img src='<?php echo "../../Controller/Items/{$product["image"]}"; ?>' width="80" height="80"/>
</td>
<td><span class="name"><?php echo $product["food_name"]; ?></span><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove-btn'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select class="select-field" name='quantity' onChange="this.form.submit()">
<option <?php if ($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if ($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if ($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if ($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if ($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="4" align="right">
<strong>TOTAL: </strong>
</td>
<td><strong><?php echo "$".$total_price; ?></strong></td>
</tr>
</tbody>
</table>
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>
<form id="addForm">
<?php
  $currentUser = $_SESSION['user_name'];
  $sql = "SELECT * FROM user WHERE name ='$currentUser'";

  $result = mysqli_query($conn, $sql);

  if($result){
      if(mysqli_num_rows($result)>0){
          while($row = mysqli_fetch_array($result)){
              ?>
                      <input hidden name="user_name" id="user_name" value="<?php echo $row['name']; ?>"><br>
                      <input hidden name="email" id="email" value="<?php echo $row['email']; ?>"><br>
                      <input hidden name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>"><br>
                      <input hidden name="address" id="address" value="<?php echo $row['address']; ?>"><br>                      
                      <?php
          }
        }
      }
  ?>
<input hidden name="food_name" id="food_name" value="<?php foreach ($_SESSION["shopping_cart"] as $product){ echo $product["food_name"] . ", "; } ?>"><br>
<input hidden name="quantity" id="quantity" value="<?php foreach ($_SESSION["shopping_cart"] as $product){ echo $product["quantity"] . ", "; } ?>"><br>
<input hidden name="total_price" id="total_price" value="<?php echo $total_price ?>"><br>
<input type="submit" id="save-button" value="Confirm Order" style="margin-top:10px; float:right; padding: 5px; border:none; background: salmon; border-radius: 5px; margin-right: 50px; font-size: 18px; font-weight: 700; cursor:pointer;">

</form>
<div id="error-message"></div>
<div id="success-message"></div>
<?php include "footer.php"; ?>

<script type="text/javascript" src="../../Assets/js/jquery.js"></script>

<script>
   $("#save-button").on("click",function(e){
      e.preventDefault();
      var user_name = $("#user_name").val();
      var email = $("#email").val();
      var mobile = $("#mobile").val();
      var address = $("#address").val();
      var food_name = $("#food_name").val();
      var quantity = $("#quantity").val();
      var total_price = $("#total_price").val();
      if(user_name == "" || email == "" || mobile == "" || address == "" || food_name == "" || quantity == "" || total_price == "" ){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "../../Controller/Order/insertOrder.php",
          type : "POST",
          data : {user_name: user_name, email: email, mobile: mobile, address: address, food_name: food_name, quantity: quantity, total_price: total_price},
          success : function(data){
            if(data == 1){
              loadTable();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }

          }
        });
      }

    });
    
</script>
</body>
</html>
