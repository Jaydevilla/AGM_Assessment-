<?php
session_start();


$servername = "192.168.254.128";
$username = "User";
$password = "Pass1234";
$DB = "all_good_machinery";

// Create connection
$conn = new mysqli($servername, $username, $password, $DB);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>selection admin</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>


<div class="login_container">
    <img src="image/AGM.png" alt="red car" class="main_image">
    <h1 class="Main_heading">Activity</h1>

    <div>
        
        <form method="POST" action="customer.php"> <input type="submit" value="View Customer Order" class="login_button"/></form><br><br>

        <form method="POST" action="items2.php"> <input type="submit" value="Edit table Information" class="login_button"/></form><br><br>

    </div>



</div>
    
</body>
</html>