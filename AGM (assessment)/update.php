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


$id = $_GET['update_product'];

if (isset($_POST['update_product'])) {
    $product_name = $_POST['tbl_machinery_name'];
    $product_price = $_POST['tbl_machinery_price'];
    $product_desc = $_POST['tbl_machinery_desc'];
    $product_image = $_FILES['tbl_machinery_image']['name'];
    $product_image_tmp_name = $_FILES['tbl_machinery_image']['tmp_name'];
    $product_image_folder = 'image/' . $product_image;

    if (empty($product_name) || empty($product_price) || empty($product_desc)) {
        $message[] = 'Please fill out all fields';
    } else {
        // Check if a new image is uploaded
        if (!empty($product_image)) {
            // Update query with image
            $update = "UPDATE tbl_machinery SET tbl_machinery_name='$product_name', tbl_machinery_desc='$product_desc', tbl_machinery_price='$product_price', tbl_machinery_image='$product_image' WHERE tbl_machinery_id=$id";
        } else {
            // Update query without image
            $update = "UPDATE tbl_machinery SET tbl_machinery_name='$product_name', tbl_machinery_desc='$product_desc', tbl_machinery_price='$product_price' WHERE tbl_machinery_id=$id";
        }

        $upload = mysqli_query($conn, $update);
        if ($upload) {
            if (!empty($product_image)) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
            }
            header('Location: items2.php');
            exit();
        } else {
            $message[] = 'Could not update the product';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Update Product</title>
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
    <div class="admin-product-form-container centered">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM tbl_machinery WHERE tbl_machinery_id = $id");
        $row = mysqli_fetch_assoc($select);
        ?>
        <form action="update.php?update_product=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <h3>Update a Product</h3>
            <input type="text" placeholder="Enter product name" value="<?php echo $row['tbl_machinery_name']; ?>" name="tbl_machinery_name" class="box">
            <input type="text" placeholder="Enter description" value="<?php echo $row['tbl_machinery_desc']; ?>" name="tbl_machinery_desc" class="box">
            <input type="number" placeholder="Enter product price" value="<?php echo $row['tbl_machinery_price']; ?>" name="tbl_machinery_price" class="box">
            <input type="file" name="tbl_machinery_image" class="box">
            <input type="submit" class="btn" name="update_product" value="Update a product">
            <br><br><a href="items2.php" class="back_button">Go back</a>
        </form>
    </div>
</div>
</body>
</html>
