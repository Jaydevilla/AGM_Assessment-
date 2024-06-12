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


    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM tbl_machinery WHERE tbl_machinery_id = $id");
        header('location:items2.php');
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item page</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<h1 class="header_view">Administrator Page</h1>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">' . $message . '</span>';
    }
}
?>

<div class="container">

    <?php

    $select= mysqli_query($conn, "SELECT * FROM tbl_machinery");

    ?>
        <a href="add.php" class="back_button">Add Product</a>
        <a href="selection_admin.php" class="back_button">Go back</a>

    <div class="product-display">

        

        <table class="product-display-table">
        
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            
            <?php

                while($row = mysqli_fetch_assoc($select)){      

            ?>

            <tr>
                <td><img src="image/<?php echo $row['tbl_machinery_image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['tbl_machinery_name']; ?></td>
                <td><?php echo $row['tbl_machinery_price']; ?></td>
                <td><?php echo $row['tbl_machinery_desc']; ?></td>
                <td>
                    <a href="update.php?update_product=<?php echo $row['tbl_machinery_id']; ?>" class="back_button">Edit</a><br><br>

                    <a href="items2.php?delete=<?php echo $row['tbl_machinery_id']; ?>" class="back_button">Delete</a><br><br>

                </td>
            </tr>

            <?php }?>


        </table>

    </div>

</div>

</body>
</html>
