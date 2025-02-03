<?php

  require_once '../include/db.php';

$id = $_POST['id'];
$doc = $_POST['doc'];

$date = date('d-m-Y');


    
    $result4 = mysqli_query($link, "UPDATE `wallet_request` SET reason='$doc', status='Reject' WHERE id='$id'");


?>