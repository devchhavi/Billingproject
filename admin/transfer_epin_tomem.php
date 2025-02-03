<?php

require_once('../include/db.php');

$from_id = $_POST['from_id'];
$to_id = $_POST['to_id'];
$selected_epin = $_POST['epin'];
$date = date('d-m-Y');
$time = $_POST['get_time_clock'];

foreach ($selected_epin as $key => $epin) {

    mysqli_query($link, "UPDATE `e_pin` SET `epin_customstatus`='Transfer' WHERE epin='$epin'");

    $result = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$to_id");
    $row = mysqli_fetch_array($result);
    $m_name = $row['m_name'];

//    usleep( 1 * 1000 );
//
//    $result3 = mysqli_query($link, "SELECT * FROM `epin_report` WHERE epin='$epin'");
//    $row3 = mysqli_fetch_array($result3);
//    $product_id = $row3['product_name'];

    $result2 = mysqli_query($link, "INSERT INTO `epin_transfer` (`epin_transfer_id`, `from_id`, `to_id`, `epin`, `date`) VALUES (NULL, '$from_id', '$to_id', '$epin', '$date')");

    usleep(1 * 1000);

    $result4 = mysqli_query($link, "INSERT INTO `epin_report` (`id`, `m_id`, `m_name`, `product_name`, `epin`, `status`, `custom_status`, `date`, `time`, `used_date`) VALUES (NULL, '$to_id', '$m_name', '', '$epin', 'Unused', '', '$date', '$time', '')");
}
?>