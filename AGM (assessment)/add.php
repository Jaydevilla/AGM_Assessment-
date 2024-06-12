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




    if(isset($_POST['submit'])){

        $product_name = $_POST['tbl_machinery_name'];
        $product_price = $_POST['tbl_machinery_price'];
        $product_desc = $_POST['tbl_machinery_desc'];
        $product_image = $_FILES['tbl_machinery_image']['name'];
        $product_image_tmp_name = $_FILES['tbl_machinery_image']['tmp_name'];
        $product_image_folder = 'image/'.$product_image;
     
        if(empty($product_name) || empty($product_price) || empty($product_desc)){
           $message[] = 'please fill out all';
        }else{
            $insert = "INSERT INTO tbl_machinery (tbl_machinery_name, tbl_machinery_desc, tbl_machinery_price, tbl_machinery_image) VALUES ('$product_name', '$product_desc', '$product_price', '$product_image')";

           $upload = mysqli_query($conn,$insert);
           if($upload){
              move_uploaded_file($product_image_tmp_name, $product_image_folder);
              $message[] = 'new product added successfully';
           }else{
              $message[] = 'could not add the product';
           }
        }
    }


?>







<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add page</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>


<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<span class="message">' . $msg . '</span>';
    }
}
?>


<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  enctype="multipart/form-data">
            <h3>Add New Product</h3>
            <input type="text" placeholder="Enter product name" name="tbl_machinery_name" class="box">
            <input type="text" placeholder="Enter description" name="tbl_machinery_desc" class="box">
            <input type="number" placeholder="Enter product price" name="tbl_machinery_price" class="box">
            <input type="file" name="tbl_machinery_image" class="box">
            <input type="submit" class="btn" name="submit" value="Add a product">
            <br><br><a href="items2.php" class="back_button">Go back</a>
        </form>
    </div>

    
</body>
</html>