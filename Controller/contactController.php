<?php
if(isset($_POST['submit'])){


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
       
          $insert = "INSERT INTO contact (name, email, subject, message) VALUES('$name','$email','$subject', '$message')";
 
          if(mysqli_query($conn, $insert)){
            $success_message = "Thank you for contacting us! We will get back to you soon.";
            header('location:../Views/contactus.php?success=' . urlencode($success_message));
        }else{
            $error_message = "An error occurred while submitting the contact form. Please try again later.";
            header('location:../Views/contactus.php?error=' . urlencode($error_message));
        }
 
 };
?>