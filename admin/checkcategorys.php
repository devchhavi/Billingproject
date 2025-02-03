<?php

require_once('../include/db.php');
 $category = $_POST['category'];
$result = mysqli_query($link, "SELECT * FROM `product_category` WHERE Name='$category'");
$rowcount = mysqli_num_rows($result);
//$row = mysqli_fetch_array($result);
if ($rowcount ==0) {
    echo "";
} else {
    echo "This <b class='text-success'>(" . $category . ")</b> Category already added.";
}
?>