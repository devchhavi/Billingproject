<?php

require_once('../include/db.php');


$sponsor_id = $_POST['sponsor_id'];

//$result1 = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$sponsor_id'");
//$rowcount1 = mysqli_num_rows($result1);
//if ($rowcount1 < 2) {
    $query = "SELECT * FROM `members` WHERE m_id='$sponsor_id'";
    $result = mysqli_query($link, $query);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        $row = mysqli_fetch_array($result);
        $sponsorName = $row['m_name'];
        echo $sponsorName;
    } else {
        echo "Invalid Sponsor Id.";
    }
//} else {
//    echo "This ID has been used twice, please try another ID.";
//}
?>