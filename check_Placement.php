<?php
  include_once 'include/ram.php';
    require_once 'include/db.php';

$placement = $_POST['placement'];
$sponsor_id = $_POST['sponsor_id'];

if($placement=="Left"){
    $placement2="Right";
}
else{
    $placement2="Left";
}

$query = "SELECT * FROM `members` WHERE placement_id='$sponsor_id' AND placement='$placement'";
$result = mysqli_query($link, $query);
$rowcount = mysqli_num_rows($result);
//$row = mysqli_fetch_array($result);
if ($rowcount > 0) {
    $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE placement_id='$sponsor_id' AND placement='$placement2'");
    $rowcount2 = mysqli_num_rows($result2);
    if($rowcount2>0){
        echo "The left and right placements of this ID<b class='text-success'>(".$sponsor_id.")</b> are already filled.Please try another id";
    }
    else{
        echo "The ".$placement." of this ID<b class='text-success'>(".$sponsor_id.")</b> is pre-filled. Please try the ".$placement2." placement.";
    }
} else {
    echo "";
}



?>