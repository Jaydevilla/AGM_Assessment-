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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="style2.css">
</head>
<style>
    .form{
        text-align: center;
    }

</style>
<body>

<div class="container">
            <?php

            $select= mysqli_query($conn, "SELECT tbl_rental.TBL_Rental_ID, tbl_client.TBL_Client_Name, tbl_rental.tbl_category, tbl_rental.tbl_rental_start, tbl_rental.tbl_rental_end
            FROM tbl_rental
            INNER JOIN tbl_client ON tbl_rental.TBL_Rental_ID=tbl_client.TBL_Client_ID;");

            ?>
            <h1 class="header_view">Customer Information</h1>
            

            <div class="container">
            <a href="selection_admin.php" class="back_button">Go back</a>
            <div class="product-display">
            
                <table class="product-display-table">
                
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Products</th>
                            <th>Start Date </th>
                            <th>End date</th>
                        </tr>
                    </thead>
                    
                    <?php

                        while($row = mysqli_fetch_assoc($select)){      

                    ?>

                    <tr>
                        <td><?php echo $row['TBL_Rental_ID']; ?></td>
                        <td><?php echo $row['TBL_Client_Name']; ?></td>
                        <td><?php echo $row['tbl_category']; ?></td>
                        <td><?php echo $row['tbl_rental_start']; ?></td>
                        <td><?php echo $row['tbl_rental_end']; ?></td>
            
                    </tr>

                    <?php }?>

                </table>

                

            </div>

        </div>

        





</div>



</body>
</html>