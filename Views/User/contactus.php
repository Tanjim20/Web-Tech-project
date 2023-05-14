<?php

include '../../Models/config.php';

require '../../Controller/userContactController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CONTACT US</title>
        <link rel="stylesheet" href="../../Assets/Css/contact.css">

    </head>
    <body>
        <div class="contact">

        <div style="padding-top:10px; text-align:center;">
          <?php include 'userHeader.php' ?>
        </div>
        <div class = "contact-sec">
            
            <div class = "contact-info">
                <div>Dhaka, Dhaka</div>
                <div>hellofoods@gmail.com</div>
                <div>01711223366</div>
                <div>ANYDAY - 10AM TO 10PM</div>
            </div>
            <div class = "contact-form">
            <?php
    if(isset($_GET['success'])){
        $success_message = $_GET['success'];
    echo "<div style='color:green; background: #000000d3; font-size:18px; font-width:900; border-radius:5px; padding:5px;'>" . $success_message . "</div>";
    }
    if(isset($_GET['error'])){
        $error_message = $_GET['error'];
        echo "<div style='color:red; background: #000000d3; font-size:18px; font-width:900; border-radius:5px; padding:5px;'>" . $error_message . "</div>";
    }
?>

                <h2>CONTACT US</h2>
                <form class="contact"  action = "" method = "post" id="myForm">
                    <input type = "text" name = "name" id="name" class="text-box" placeholder = "Enter Your Name">
                    <input type="text" name="email" id="email" class="text-box" placeholder="Enter Your Email">
                    <input type="text" name="subject" id="subject" class="text-box" placeholder="Enter Your Subject">
                    <textarea name="message" id="message" rows="5" placeholder="Enter Your Message Here..."></textarea>
                    <input type="submit" name="submit" class="send-btn" value="Send">
                </form>
            </div>
        </div>
</div>
        <script>
             const myForm = document.getElementById('myForm');

myForm.addEventListener('submit', function (event) {
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const subjectInput = document.getElementById('subject');
  const messageInput = document.getElementById('message');
  

  // Check for empty fields
  if (nameInput.value.trim() === '' ||
    emailInput.value.trim() === '' ||
    subjectInput.value.trim() === '' ||
    messageInput.value.trim() === '') {
    alert('Please fill in all fields.');
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
});
        </script>

    </body>
</html>