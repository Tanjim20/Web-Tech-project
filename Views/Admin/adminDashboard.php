<?php 
include '../../Models/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../Assets/Css/admin1.css">
</head>
<body>
<?php
$sqlUsers = "SELECT COUNT(*) AS count FROM user";
$resultUsers = mysqli_query($conn, $sqlUsers) or die("SQL Query Failed.");
$usersRow = mysqli_fetch_assoc($resultUsers);
$countUser = $usersRow['count'];

$sqlOrder = "SELECT COUNT(*) AS count FROM orders";
$resultOrder = mysqli_query($conn, $sqlOrder) or die("SQL Query Failed.");
$orderRow = mysqli_fetch_assoc($resultOrder);
$countOrder = $orderRow['count'];

$sql = "SELECT total_price FROM orders";
$result = mysqli_query($conn, $sql);

$total = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $total += $row['total_price'];
    }
} else {
    echo "No results found.";
}

$sqlCat = "SELECT COUNT(*) AS count FROM catagories";
$resultCat = mysqli_query($conn, $sqlCat) or die("SQL Query Failed.");
$catRow = mysqli_fetch_assoc($resultCat);
$countCat = $catRow['count'];

$sqlFood = "SELECT COUNT(*) AS count FROM foods";
$resultFood = mysqli_query($conn, $sqlFood) or die("SQL Query Failed.");
$foodRow = mysqli_fetch_assoc($resultFood);
$countFood = $foodRow['count'];

$sqlCon = "SELECT COUNT(*) AS count FROM contact";
$resultCon = mysqli_query($conn, $sqlCon) or die("SQL Query Failed.");
$conRow = mysqli_fetch_assoc($resultCon);
$countCon = $conRow['count'];

$sqlFk = "SELECT COUNT(*) AS count FROM feedback";
$resultFk = mysqli_query($conn, $sqlFk) or die("SQL Query Failed.");
$fkRow = mysqli_fetch_assoc($resultFk);
$countFk = $fkRow['count'];
?>

    <?php include 'adminHeader.php'; ?>
    <div class="admin-container">
       <?php include 'adminLeftbar.php'; ?>
       <div class="content">
        <div class="count-boxes">
            <div class="count-box">
                <h3 class="count-title">Total Users</h3>
                <h1 class="count-text"><?php echo $countUser ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Order</h3>
                <h1 class="count-text"><?php echo $countOrder ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Earn</h3>
                <h1 class="count-text"><?php echo $total ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Catagories</h3>
                <h1 class="count-text"><?php echo $countCat ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Items</h3>
                <h1 class="count-text"><?php echo $countFood ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Contact</h3>
                <h1 class="count-text"><?php echo $countCon ?></h1>
            </div>
            <div class="count-box">
                <h3 class="count-title">Total Feedback</h3>
                <h1 class="count-text"><?php echo $countFk ?></h1>
            </div>
        </div>
           
        </div>

    </div>
</body>
</html>