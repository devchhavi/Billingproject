<?php

require_once('../include/db.php');
$epin_status = "";
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM `members` WHERE m_email='$email'";
$result = mysqli_query($link, $query);
//$rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if ($password == $row['m_password']) {
    echo "";
} else {
    echo "Wrong Password!";
}
?>