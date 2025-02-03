<?php
require_once '../include/db.php';


$member_id = $_POST['member_id'];

$result = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND placement_id = $member_id");
$rownum1 = mysqli_num_rows($result);
if ($rownum1 > 0) {
    $row = mysqli_fetch_array($result);
    $id1 = $row['m_id'];
}
$result2 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND placement_id = $member_id");
$rownum2 = mysqli_num_rows($result2);
if ($rownum2 > 0) {
    $row2 = mysqli_fetch_array($result2);
    $id2 = $row2['m_id'];
}
?>

<div class="row">
    <div class="col-12">
        <i onclick="generateTree(<?php echo $member_id; ?>)" class="tooltipme">

            <?php
            $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$member_id");
            $row2 = mysqli_fetch_array($result2);
            $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$member_id");
            $rowNUM = mysqli_num_rows($resultActiveId);
            $resultRank = mysqli_query($link, "SELECT * FROM `members`");
            $rowRank = mysqli_fetch_array($resultRank);
//            $rank = $rowRank['m_rank'];
//            $border = "";
//            if ($rank == "Distributor") {
//                $border = "green-bg";
//            } elseif ($rank == "Silver") {
//                $border = "silver-bg";
//            } elseif ($rank == "Gold") {
//                $border = "gold-bg";
//            } elseif ($rank == "Diamond") {
//                $border = "diamond-bg";
//            }
//            if ($rowNUM > 0) {
//                $rowActiveId = mysqli_fetch_array($resultActiveId);
//                $activeDate = $rowActiveId['date'];
//            } else {
//                $activeDate = "Not Active";
//            }
            ?>
            
            <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
<?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> ">  <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?></span>
            <span class="tooltipmetext" tabindex="1">
                ID : <?php echo $row2['m_id']; ?> <br/> 
                Name : <?php echo $row2['m_name']; ?> <br/>
                Mobile : <?php echo $row2['m_mobile']; ?><br/>
                Email : <?php echo $row2['m_email']; ?><br/>
                Joining date : <?php echo $row2['m_date']; ?><br/>
               
            </span>
        </i>
    </div>
</div>
<?php if (isset($id2) && isset($id1)) { ?>
    <div class="text-center">
        <img src="assets/images/treearrow2.jpg" style="width: 55%" alt=""/>
    </div>
<?php } elseif (isset($id1)) { ?>
    <div class="text-center">
        <img src="assets/images/treearrow3.jpg" style="width: 55%" alt=""/>
    </div>
<?php } elseif (isset($id2)) { ?>
    <div class="text-center">
        <img src="assets/images/treearrow4.jpg" style="width: 55%" alt=""/>
    </div>
<?php } ?>
<div class="row">
    <div class="col-6">
        <?php if (isset($id1)) { ?>
            <i onclick="generateTree(<?php echo $id1; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id1");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id1");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id1");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['member_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?> </span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                    Activation date : <?php echo $activeDate; ?>
                </span>
            </i>
        <?php } ?>
    </div>
    <div class="col-6">
        <?php if (isset($id2)) { ?>
            <i onclick="generateTree(<?php echo $id2; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id2");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id2");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id2");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['member_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?></span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                  
                </span>
            </i>
        <?php } ?>
    </div>
</div>
<?php
if (isset($id1)) {
    $member_id = $id1;

    $result3 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND placement_id = $member_id");
    $rownum3 = mysqli_num_rows($result3);
    if ($rownum3 > 0) {
        $row3 = mysqli_fetch_array($result3);
        $id3 = $row3['m_id'];
    }
    $result4 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND placement_id = $member_id");
    $rownum4 = mysqli_num_rows($result4);
    if ($rownum4 > 0) {
        $row4 = mysqli_fetch_array($result4);
        $id4 = $row4['m_id'];
    }
}

if (isset($id2)) {
    $member_id = $id2;

    $result5 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND placement_id = $member_id");
    $rownum5 = mysqli_num_rows($result5);
    if ($rownum5 > 0) {
        $row5 = mysqli_fetch_array($result5);
        $id5 = $row5['m_id'];
    }
    $result6 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND placement_id = $member_id");
    $rownum6 = mysqli_num_rows($result6);
    if ($rownum6 > 0) {
        $row6 = mysqli_fetch_array($result6);
        $id6 = $row6['m_id'];
    }
}
?>
<div class="row">
    <div class="col-6">
        <?php if (isset($id4) && isset($id3)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow2.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } elseif (isset($id3)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow3.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } elseif (isset($id4)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow4.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } ?>
    </div>
    <div class="col-6">
        <?php if (isset($id6) && isset($id5)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow2.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } elseif (isset($id5)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow3.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } elseif (isset($id6)) { ?>
            <div class="text-center">
                <img src="assets/images/treearrow4.jpg" style="width: 55%" alt=""/>
            </div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <?php if (isset($id3)) { ?>
            <i onclick="generateTree(<?php echo $id3; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id3");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id3");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id3");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['member_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style " height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?></span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                   
                </span>
            </i>
        <?php } ?>
    </div>
    <div class="col-3">
        <?php if (isset($id4)) { ?>
            <i onclick="generateTree(<?php echo $id4; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id4");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id4");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id4");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['member_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?> </span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                  
                </span>
            </i>
        <?php } ?>
    </div>
    <div class="col-3">
        <?php if (isset($id5)) { ?>
            <i onclick="generateTree(<?php echo $id5; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id5");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id5");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id5");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['member_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?></span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                   
                </span>
            </i>
        <?php } ?>
    </div>
    <div class="col-3">
        <?php if (isset($id6)) { ?>
            <i onclick="generateTree(<?php echo $id6; ?>)" class="tooltipme">

                <?php
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id6");
                $row2 = mysqli_fetch_array($result2);
                $resultActiveId = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND m_id=$id6");
                $rowNUM = mysqli_num_rows($resultActiveId);
                $resultRank = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$id6");
                $rowRank = mysqli_fetch_array($resultRank);
//                $rank = $rowRank['m_rank'];
//                $border = "";
//                if ($rank == "Distributor") {
//                    $border = "green-bg";
//                } elseif ($rank == "Silver") {
//                    $border = "silver-bg";
//                } elseif ($rank == "Gold") {
//                    $border = "gold-bg";
//                } elseif ($rank == "Diamond") {
//                    $border = "diamond-bg";
//                }
//                if ($rowNUM > 0) {
//                    $rowActiveId = mysqli_fetch_array($resultActiveId);
//                    $activeDate = $rowActiveId['date'];
//                } else {
//                    $activeDate = "Not Active";
//                }
                ?>
                <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php echo $row2['m_photo']; ?>" alt="Member Photo"/><br/>
                <?php  $statuss= $row2['m_status'];  if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
            <span style="color:<?php echo  $txtColor;  ?> "> 
                <?php echo $row2['m_name'] . " (" . $row2['m_id'] . ")"; ?></span>
                <span class="tooltipmetext" tabindex="1">
                    ID : <?php echo $row2['m_id']; ?> <br/> 
                    Name : <?php echo $row2['m_name']; ?> <br/>
                    Mobile : <?php echo $row2['m_mobile']; ?><br/>
                    Email : <?php echo $row2['m_email']; ?><br/>
                    Joining date : <?php echo $row2['m_date']; ?><br/>
                  
                </span>
            </i>
        <?php } ?>
    </div>
</div>