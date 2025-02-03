<?php
require_once('../include/db.php');
$member_status="";
$id = $_POST['id'];
$query = "SELECT * FROM `members`";
$result = mysqli_query($link, $query);
$rowcount = mysqli_num_rows($result);
if ($rowcount > 0) {
    while ($row = mysqli_fetch_array($result)) {
        if ($id == $row['m_id']) {
            $member_status = $row['m_status'];
        }
    }
    if ($member_status!="") {
        if ($member_status != "Inactive") {
            echo 'Member ID <b style="color: black;">('.$id.')</b> is already <b class="text-success">Active</b>.';
        }
        else{
            echo "";
        }
    } else {
        echo 'Invalid Member ID <b style="color: black;">('.$id.').</b>';
    }
} else {
    echo 'Invalid Member ID <b style="color: black;">('.$id.').</b>';
}
?>