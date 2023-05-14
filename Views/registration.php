<?php

include '../Models/config.php';

require '../Controller/registrationController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration</title>

   <link rel="stylesheet" href="../Assets/Css/registrationLogins.css">

</head>
<body>
   <div class="form-container">
    <div style="text-align: center;">
      <?php include 'headers.php'; ?>

    </div>   
<div class="form-container2">

   <form action="" method="post" id="myForm">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" id="name" placeholder="Enter your name"><br>
      <input type="text" name="email" id="email" placeholder="Enter your email"><br>
      <input type="text" name="mobile" id="mobile" placeholder="Enter your contact number"><br>
      <input type="text" name="address" id="address" placeholder="Enter your address"><br>
      <label for="gender" style="font-size:20px; float:left; color: #fff;">Gender</label><br>
      <input type="radio" name="gender" value="Male">
      <label for="male" style="color: #fff;">Male</label>
      <input type="radio" name="gender" value="Female">
      <label for="female" style="color: #fff;">Female</label>
      <input type="radio" name="gender" value="Other">
      <label for="other" style="color: #fff;">Other</label><br>
      <input type="password" id="password" name="password" placeholder="Enter your password"><br>
      <input type="password" name="cpassword" placeholder="Confirm your password"><br>
      <select name="user_type" id="user_type">
         <option value="">Select One...</option>
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select><br>
      <div class="show-hide-pass">
      <input type="checkbox" class="checkbox" onclick="showPassword()" /><span class="showpass">Show Password</span><br>
      </div>
      <input type="submit" name="submit" value="Register" class="form-btn">
      <p>I already have an account? <a href="login.php">Login</a></p>
   </form>

</div>
</div>
<script>
    function showPassword() {
      var Pass = document.getElementById("password");
      if (Pass.type === "password") {
        Pass.type = "text";
      }
      else {
        Pass.type = "password";
      }
    }

    const myForm = document.getElementById('myForm');

  myForm.addEventListener('submit', function (event) {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const mobileInput = document.getElementById('mobile');
    const addressInput = document.getElementById('address');
    const userTypeInput = document.getElementById('user_type');
    const passwordInput = document.getElementById('password');
    

    // Check for empty fields
    if (nameInput.value.trim() === '' ||
      emailInput.value.trim() === '' ||
      mobileInput.value.trim() === '' ||
      addressInput.value.trim() === '' ||
      userTypeInput.value.trim() === '' ||
      passwordInput.value.trim() === '') {
      alert('Please fill in all fields.');
      event.preventDefault();
      return;
    }

    // Check name field
    const nameRegex = /^[a-zA-Z ]{3,30}$/;
    if (!nameRegex.test(nameInput.value)) {
      alert('Please enter a valid name (3-30 letters, No numbers or special characters).');
      event.preventDefault();
      return;
    }

    // Check email field
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value)) {
      alert('Please enter a valid email address.');
      event.preventDefault();
      return;
    }

    // Check password field
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
    if (!passwordRegex.test(passwordInput.value)) {
      alert('Please enter a valid password (8+ characters, at least one uppercase letter, one lowercase letter, one number, and one special character).');
      event.preventDefault();
      return;
    }

    // Check phone number field
    const phoneRegex = /^\d{11}$/;
    if (!phoneRegex.test(mobileInput.value)) {
      alert('Please enter a valid 11-digit phone number (numbers only, no dashes or spaces).');
      event.preventDefault();
      return;
    }
  });

</script>

</body>
</html>