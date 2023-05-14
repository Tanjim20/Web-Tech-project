<?php

@include '../Models/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Profile</title>

   <link rel="stylesheet" href="../../Assets/Css/admin1.css">


</head>
<body>
   
<div class="container">
<?php include 'adminHeader.php'; ?>
    <div class="admin-container">
       <?php include 'adminLeftbar.php'; ?>
       <div class="content">
            <h3 class="admin-title">Edit Information</h3>
               
                <form action="../../Controller/editAdminProfileController.php"
                      method="POST">
                    <?php
                        $currentUser = $_SESSION['admin_name'];
                        $sql = "SELECT * FROM user WHERE name ='$currentUser'";

                        $result = mysqli_query($conn, $sql);

                        if($result){
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" readonly name="name" value="<?php echo $row['name']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" type="email" name="email" value="<?php echo $row['email']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" type="text" name="mobile" value="<?php echo $row['mobile']; ?>"><br>
                                            <input style="boder: none; padding: 3px; margin-top:20px; font-weight:700;" type="text" name="address" value="<?php echo $row['address']; ?>"><br>


                                            <input style='margin-top:20px; padding:5px; background:lightsalmon; border:none; border-radius:10px; font-size: 20px; font-weight:900; cursor:pointer;' type="submit" name="update" value="Update">
                                            <a href="adminProfile.php" style='margin-top:20px; padding:5px; background:lightsalmon; border:none; border-radius:10px; font-size: 20px; font-weight:900; cursor:pointer; text-decoration:none; color:#fff;'>Cancel</a>

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