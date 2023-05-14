<?php

include '../../Models/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Profile</title>

   <link rel="stylesheet" href="../../Assets/Css/user1.css">

</head>
<body>
   
<?php include 'userHeader.php'; ?>
       <div class="content">
            <h3 class="user-title">Profile</h3>
        
                <form>
                    <?php
                        $currentUser = $_SESSION['user_name'];
                        $sql = "SELECT * FROM user WHERE name ='$currentUser'";

                        $result = mysqli_query($conn, $sql);

                        if($result){
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" readonly value="<?php echo $row['name']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" readonly value="<?php echo $row['email']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" readonly value="<?php echo $row['mobile']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" readonly value="<?php echo $row['address']; ?>"><br>

                                            <div class="user-btns" style="margin-top:20px;">
                                                <a href="editProfile.php">Edit Profile</a>
                                                <a href="changePassword.php">Change Password</a>
                                            </div>

                                       
                                    <?php
                                }
                            }
                        }


                    ?>
                
                </form>
            </div>
            
        </div>


</div>

</body>
</html>