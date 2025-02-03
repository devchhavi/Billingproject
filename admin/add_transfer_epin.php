<?php

require_once('../include/db.php');

$freeEpin = $_POST['freeEpin'];

$member_id = $_POST['member_id'];
$member_name = $_POST['member_name'];
$selected_epin = $_POST['epin'];
$request_id = $_POST['request_id'];
$date = date('d-m-Y');
$time = $_POST['get_time_clock'];

foreach ($selected_epin as $key => $epin) {

    mysqli_query($link, "INSERT INTO `epin_report` (`id`, `m_id`, `m_name`, `epin`, `status`, `date`, `time`) VALUES (NULL, '$member_id', '$member_name', '$epin', 'Unused', '$date', '$time')");
    
    usleep(1 * 1000);

    mysqli_query($link, "UPDATE `e_pin` SET `epin_customstatus`='Transfer' WHERE epin='$epin'");

    mysqli_query($link, "UPDATE `wallet_request` SET `status`='Approve' WHERE id='$request_id'");
}
usleep(1 * 1000);

if($freeEpin>'0'){
    $total_amount = $freeEpin*499;
    mysqli_query($link, "INSERT INTO `franchise_income` (`id`, `member_id`, `member_name`, `total_epins`, `total_amount`, `date`, `time`) VALUES (NULL, '$member_id', '$member_name', '$freeEpin', '$total_amount', '$date', '$time')");
}

?>