<?php
session_start();
$id = $_REQUEST['loginMemberId'];
$name = $_REQUEST['loginMemberName'];
$_SESSION['m_id'] = $id;
$_SESSION['m_name'] = $name;
header("Location: member/index.php");

?>