<?php

include '../../Models/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Change Password</title>

   <link rel="stylesheet" href="../../Assets/Css/user1.css">


</head>
<body>
   
<?php include 'userHeader.php'; ?>
       <div class="content">
   <form action="../../Controller/userChangePasswordController.php" method="post" id="myForm">
   <h3 class="user-title">Change Password</h3>

     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="color:red; font-weight:700;"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success" style="color:green; font-weight:700;"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label style="margin-top:5px; font-weight:700;">Old Password</label><br>
     	<input type="password" name="op" id="op" placeholder="Old Password" style="boder: none; padding: 3px; margin-bottom:20px; font-weight:700;"><br>

     	<label style="margin-top:5px; font-weight:700;">New Password</label><br>
     	<input type="password" name="np" id="np" placeholder="New Password" style="boder: none; padding: 3px; margin-bottom:20px; font-weight:700;"><br>

     	<label style="margin-top:5px; font-weight:700;">Confirm New Password</label><br>
     	<input type="password" name="c_np" id="c_np" placeholder="Confirm New Password" style="boder: none; padding: 3px; margin-bottom:20px; font-weight:700;"><br>

     	<button type="submit" style='margin-top:20px; padding:5px; background:lightsalmon; border:none; border-radius:10px; font-size: 20px; font-weight:900; cursor:pointer;'>Change</button>
         <a href="userProfile.php" style='margin-top:20px; padding:5px; background:lightsalmon; border:none; border-radius:10px; font-size: 20px; font-weight:900; cursor:pointer; text-decoration:none; color:#fff;'>Cancel</a>

     </form>

    </div>

</div>
<script>
    const myForm = document.getElementById('myForm');

myForm.addEventListener('submit', function (event) {
  const opInput = document.getElementById('op');
  const npInput = document.getElementById('np');
  const c_npInput = document.getElementById('c_np');

  // Check for empty fields
  if (opInput.value.trim() === '' ||
      npInput.value.trim() === '' ||
      c_npInput.value.trim() === '' ) {
      alert('Please fill in all fields.');
      event.preventDefault();
      return;
    }
    // Check password field
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
    if (!passwordRegex.test(npInput.value)) {
      alert('Please enter a valid password (8+ characters, at least one uppercase letter, one lowercase letter, one number, and one special character).');
      event.preventDefault();
      return;
    }
});
</script>

</body>
</html>