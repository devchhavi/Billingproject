<?php

require_once('../include/db.php');

$epin_status = "";
$epin = $_POST['epin'];
$query = "SELECT * FROM `e_pin` WHERE epin='$epin'";
$result = mysqli_query($link, $query);
$rowcount = mysqli_num_rows($result);
if ($rowcount > 0) {
    $row = mysqli_fetch_array($result);
    $epin_status = $row['epin_status'];
    if ($epin_status != "Unused") {
        echo '<b style="color: black;">(' . $epin . ')</b> E-Pin is already used.';
    } else {
        echo "";
    }
} else {
    echo 'Invalid E-Pin <b style="color: black;">(' . $epin . ')</b>';
}
?>