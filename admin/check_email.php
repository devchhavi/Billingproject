<?php

require_once('../include/db.php');
$id = $_POST['id'];
$result = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$id'");
$rowcount = mysqli_num_rows($result);
//$row = mysqli_fetch_array($result);
if ($rowcount > 0) {
    echo "";
} else {
    echo "This <b class='text-success'>(" . $id . ")</b> ID is not valid.";
}
?>