<?php

require_once('../include/db.php');
 $p_name = $_POST['p_name'];
$result = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$p_name'");
 $rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($rowcount >0) {
	
    echo $row['Price'];
} 
?>