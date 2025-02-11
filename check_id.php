<?php

require_once('include/db.php');
$id = $_POST['id'];
$query = "SELECT * FROM `members` WHERE m_id='$id'";
$result = mysqli_query($link, $query);
$rowcount = mysqli_num_rows($result);
//$row = mysqli_fetch_array($result);
if ($rowcount > 0) {
    echo "";
} else {
    echo "This <b class='text-success'>(" . $id . ")</b> ID is not valid.";
}
?>