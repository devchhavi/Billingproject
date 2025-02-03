<?php

require_once('../include/db.php');
 $category = $_POST['category'] ?? '';
 $categoryid = $_POST['categoryid'] ?? '';
$result = mysqli_query($link, "SELECT * FROM `product_category` WHERE Name='$category'");
$rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$categoryidss=$row['id'] ?? '';

if ($rowcount ==0||$categoryidss==$categoryid) {
    echo "";
} else {
    echo "This <b class='text-success'>(" . $category . ")</b> Category already added.";
}
?>