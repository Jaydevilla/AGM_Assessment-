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
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style2.css">
</head>
<body>

<div class="login_container">
    <img src="image/AGM.png" alt="AGM" class="main_image">
    <h1 class="Main_heading">All Good Machinery</h1>

    <div >
        
        <form method="POST" action="items_only.php" > <input type="submit" value="View Items" class="login_button"/></form><br><br>

        <form method="POST" action="standard_user.php"> <input type="submit" value="Customer login" class="login_button"/></form><br><br>

        <form method="POST" action="administrator.php"> <input type="submit" value="Administrator Login" class="login_button"/></form><br><br>
    </div>



</div>

</body>
</html>