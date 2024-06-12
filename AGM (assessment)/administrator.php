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


    //validation for name
    $loginErr="";
    $nameErr = $passwordErr = "";
    $name = $password  = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

     //validation for name
        if (empty($_POST["name"])) {
            $nameErr = "* Name is required*";
        } else{
            $name = $_POST["name"];
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "* Only letters and white space allowed*";
            }
        }   

        // Validation for password
        if (empty($_POST["password"])) {
                $passwordErr = "* Password is required";
        } else {
            $password = $_POST["password"];
            // Check if the password meets the criteria
            if (strlen($password) < 8 || !preg_match("/[0-9]/", $password)) {
                   $passwordErr = "* Password must be at least 8 characters and contain at least one number*";
            }
        }


        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($phoneErr)) {
            // All fields are filled, redirect to second page
            $_SESSION['name'] = $name;
            header("Location: selection_admin.php");
            exit();
        }
}

?>

<html>
<head>
</head>
<style>
    .form{
        text-align: center;
    }

</style>
<body>


<div class="form">

<h1>Administrator Login</h1>

<form action="" method="POST">
    <p style="color:red"><?php echo($loginErr)?> </p>

    <input name="name" type="text" placeholder="Username"/><br>
    <span style="color:red"><?php echo($nameErr)?> </span>
    <br><br>

    <input name="password" type="password" placeholder="Password"/><br>
    <span style="color:red"><?php echo($passwordErr)?> </span>
    <br><br>

    <button type="submit" class="button">Login</button><br><br>
</form>


</div>









</body>
</html>