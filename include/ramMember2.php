<?php

//$DownLineMemberArray = array();
//$link = mysqli_connect("182.50.133.91:3306", "globalm", "global123@$", "spvainfo_globalm");
$link = mysqli_connect('localhost', "root", "", "vastamarketing");

class ramMember2 {

    function activateYourSelf() {
        if (isset($_REQUEST['add_epin'])) {
            global $link;

            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
            $time = date('H:i:s');
            $datetime = date('Y-m-d, H:i:s');

            $m_id = $_POST['member_id'];
            $result_member_name = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$m_id'");
            $row_member_name = mysqli_fetch_array($result_member_name);
            $member_name = $row_member_name['m_name'];
            $sponsor_id = $row_member_name['sponsor_id'];

            $epin = $_POST['m_epin'];
            $page_name = $_POST['page_name'];

            usleep(1 * 1000);
            $m_id_forreferal = $m_id;
            for ($i = 1; $i <= 5; $i++) {
                $result_member_name = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$m_id_forreferal'");
                $rowCount_member_name = mysqli_num_rows($result_member_name);
                if ($rowCount_member_name > 0) {
                    $row_member_name = mysqli_fetch_array($result_member_name);
                    $sponsor_id = $row_member_name['sponsor_id'];
                    $m_id_forreferal = $this->referalIncome($sponsor_id, $i);
                }
            }

            $result = mysqli_query($link, "UPDATE `members` SET `activation_date`='$date', `m_epin`='$epin', `m_status`='Active' WHERE m_id='$m_id'");
            $result2 = mysqli_query($link, "UPDATE `epin_report` SET `status`='Used' WHERE epin='$epin'");
            $result3 = mysqli_query($link, "UPDATE `e_pin` SET `epin_status`='Used' WHERE epin='$epin'");

            usleep(2 * 1000);

            $ResultAll = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active'");
            $rowcountall = mysqli_num_rows($ResultAll);

            while ($RowAll = mysqli_fetch_array($ResultAll)) {
                $currentM_id = $RowAll['m_id'];
                $currentM_name = $RowAll['m_name'];
                $current_id = $RowAll['id'];
//                $resultDDL = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$currentM_id'");
//                $rowcountDDL = mysqli_num_rows($resultDDL);

                $resultDL = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND id >'$current_id'");
                $rowcountDL = mysqli_num_rows($resultDL);


                if ($rowcountDL == '100') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'STAR', '30', 'Pending');");
                } elseif ($rowcountDL == '350') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'SILVER', '40', 'Pending');");
                } elseif ($rowcountDL == '850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'BRONZE', '50', 'Pending');");
                } elseif ($rowcountDL == '1850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'GOLD', '70', 'Pending');");
                } elseif ($rowcountDL == '3850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'PLATINUM', '100', 'Pending');");
                } elseif ($rowcountDL == '8850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'RUBY', '350', 'Pending');");
                } elseif ($rowcountDL == '18850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'PEARL', '500', 'Pending');");
                } elseif ($rowcountDL == '33850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'DIAMOND', '1000', 'Pending');");
                } elseif ($rowcountDL == '63850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'BLUE DIAMOND', '2000', 'Pending');");
                } elseif ($rowcountDL == '113850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'RED DIAMOND', '5000', 'Pending');");
                } elseif ($rowcountDL == '213850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'WHITE DIAMOND', '10000', 'Pending');");
                } elseif ($rowcountDL == '363850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'KING', '15000', 'Pending');");
                } elseif ($rowcountDL == '563850') {
                    mysqli_query($link, "INSERT INTO `singleleg_income` (`id`, `member_id`, `label`, `amount`, `status`) VALUES (NULL, '$currentM_id', 'SUPER KING', '20000', 'Pending');");
                }

                $pre_date = date('Y-m-d', strtotime($date . ' -6 day'));
                $result_rtly = mysqli_query($link, "SELECT m_id FROM `members` WHERE sponsor_id='$currentM_id' AND activation_date>='$pre_date' AND activation_date<='$date'");
                $rowCount_rtly = mysqli_num_rows($result_rtly);
                if ($rowCount_rtly >= 10 && $rowCount_rtly < 20) {
                    $resroyalycheck = mysqli_query($link, "SELECT * FROM `royalty` WHERE member_id='$currentM_id'");
                    $rowRoyaly = mysqli_num_rows($resroyalycheck);
                    if ($rowRoyaly == 0) {
                        mysqli_query($link, "INSERT INTO `royalty` (`id`, `member_id`, `member_name`, `royalty`) VALUES (NULL, '$currentM_id', '$currentM_name', '5')");
                    }
                } elseif ($rowCount_rtly >= 20) {
                    $resroyalycheck = mysqli_query($link, "SELECT * FROM `royalty` WHERE member_id='$currentM_id'");
                    $rowRoyaly = mysqli_num_rows($resroyalycheck);
                    if ($rowRoyaly > 0) {
                        mysqli_query($link, "UPDATE `royalty` SET `royalty`='10' WHERE member_id='$currentM_id'");
                    } else {
                        mysqli_query($link, "INSERT INTO `royalty` (`id`, `member_id`, `member_name`, `royalty`) VALUES (NULL, '$currentM_id', '$currentM_name', '10')");
                    }
                    
                }

            }

            echo '<script> alert("Member activation successful"); window.location.href = "generate_epin.php";</script>';
        }
    }

    function referalIncome($sponsor_id, $i) {
        global $link;
        if ($i == "1") {
            mysqli_query($link, "UPDATE `members` SET `referal_income`=referal_income+50,`total_income`=total_income+50 WHERE m_id=$sponsor_id");
        } elseif ($i == "2") {
            mysqli_query($link, "UPDATE `members` SET `referal_income`=referal_income+10,`total_income`=total_income+10 WHERE m_id=$sponsor_id");
        } elseif ($i == "3") {
            mysqli_query($link, "UPDATE `members` SET `referal_income`=referal_income+5,`total_income`=total_income+5 WHERE m_id=$sponsor_id");
        } elseif ($i == "4") {
            mysqli_query($link, "UPDATE `members` SET `referal_income`=referal_income+5,`total_income`=total_income+5 WHERE m_id=$sponsor_id");
        } elseif ($i == "5") {
            mysqli_query($link, "UPDATE `members` SET `referal_income`=referal_income+5,`total_income`=total_income+5 WHERE m_id=$sponsor_id");
        }
        return $sponsor_id;
    }

}

?> 