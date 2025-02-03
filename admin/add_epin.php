<?php
include '../include/db.php';
$no_epin = $_REQUEST['epin'];
date_default_timezone_set('Asia/Kolkata');
$time = date('H:i:s');
$date = date("Y-m-d");

for($i=1; $i<=$no_epin; $i++){
//    usleep(1*100);
    $epin = substr(md5(microtime()), 0, 10); 

$result = mysqli_query($link, "INSERT INTO `e_pin` (`epin_id`, `epin`, `epin_generate_date`, `epin_expiry_date`, `epin_status`, `epin_customstatus`, `epin_time`) VALUES (NULL, '$epin', '$date', '', 'Unused', 'Pending', '$time')");
  
}


?>