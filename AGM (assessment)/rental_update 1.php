<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB = "all_good_machinery";

// Create connection
try {
	$conn = new mysqli($servername, $username, $password, $DB);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


$sql = "ALTER TABLE `tbl_rental` ADD COLUMN `tbl_rental_start` DATE NULL AFTER `TBL_Rental_ID`, ADD COLUMN `tbl_rental_end` DATE NULL AFTER`tbl_rental_start`;";

try {
	$conn->query($sql);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo "Database updated ";

$conn->close();

?>