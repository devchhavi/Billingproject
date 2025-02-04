<?php
$DLRreport2 = array();
$DLRreport = array();
$DLRreportCF = array();
$link = mysqli_connect('Localhost', "root", "", "vastamarketing");

class ramMember {

    function add_wallet() {
        if (isset($_REQUEST['add_wallet'])) {
            //$amount = $_POST['amount'];
            $m_id = $_SESSION['m_id'];
            $m_name = $_SESSION['m_name'];
            $numberof_epin = $_POST['numberof_epin'];
//            $product_name = $_POST['product'];
            $product_amount = $_POST['amount'];
            $total_amount = $_POST['total_amount'];
            $payment_mode = $_POST['payment_mode'];
            $transaction_id = $_POST['transaction_id'];
            $transaction_date = $_POST['transaction_date'];
            $transaction_time = $_POST['transaction_time'];

            global $link;
            $query = "INSERT INTO `wallet_request` (`id`, `member_id`, `member_name`, `product_amount`, `numberof_epin`, `total_amount`, `payment_mode`, `transaction_id`, `transaction_date`, `transaction_time`, `status`) VALUES (NULL, '$m_id', '$m_name', '$product_amount', '$numberof_epin', '$total_amount', '$payment_mode', '$transaction_id', '$transaction_date', '$transaction_time', 'Pending')";
            $result = mysqli_query($link, $query);
            echo '<script>window.location.href = "epin_request.php";</script>';
        }
    }

    function showWalletList() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `wallet_request` WHERE member_id='$m_id' ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                <!--                    <td><?php //echo $row['product_name'];     ?></td>-->
                    <td><?php echo $row['numberof_epin']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['transaction_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                </tr><?php
                        $i++;
                    }
                } else {
                    echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function showReportDetailsList() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $query = "SELECT * FROM `epin_report` WHERE m_id='$m_id' ORDER BY id DESC";
                $result = mysqli_query($link, $query);
                //$row = mysqli_fetch_array($result);
                $i = 1;
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>                   
                    <td><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr><?php
                        $i++;
                    }
                }
                usleep(1 * 1000);
                $query2 = "SELECT * FROM `epin_report` WHERE m_id='$m_id' AND status='Used' ORDER BY id DESC";
                $result2 = mysqli_query($link, $query2);
                $rowcount2 = mysqli_num_rows($result2);
                if ($rowcount2 > 0) {
                    while ($row = mysqli_fetch_array($result2)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>

                    <td><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr><?php
                        $i++;
                    }
                }
                if ($rowcount == 0 && $rowcount2 == 0) {
                    echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function memberRecords($i) {
                $m_id = $_SESSION['m_id'];
                global $link;
                $query = "SELECT * FROM `members` WHERE m_id='$m_id'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                $member_name = $row['m_name'];
                $member_email = $row['m_email'];
                $member_pan = $row['m_pan'];
                $member_mobile = $row['m_mobile'];
                $Total_wallet = $row['Total_wallet'];
                $member_password = $row['m_password'];
                $m_state_id = $row['m_state_id'];
                $query2 = "SELECT * FROM `states` WHERE id='$m_state_id'";
                $result2 = mysqli_query($link, $query2);
                $row2 = mysqli_fetch_array($result2);
                $m_state = $row2['name'];

                $m_city_id = $row['m_city_id'];
                usleep(1 * 1000);
                $query3 = "SELECT * FROM `cities` WHERE id='$m_city_id'";
                $result3 = mysqli_query($link, $query3);
                $row3 = mysqli_fetch_array($result3);
                $m_city = $row3['name'];



                $m_pincode = $row['m_pincode'];
                $m_address = $row['m_address'];
                $m_date = $row['m_date'];
                $m_dob = $row['m_dob'];
                $status = $row['m_status'];
                $m_photo = $row['m_photo'];

                if ($i == "name") {
                    echo $member_name;
                } elseif ($i == "total_wallet") {
                    echo $Total_wallet;
                } elseif ($i == "franchisebutton") {
                    return $row['Franchise'];
                } elseif ($i == "email") {
                    echo $member_email;
                } elseif ($i == "pan") {
                    echo $member_pan;
                } elseif ($i == "mobile") {
                    echo $member_mobile;
                } elseif ($i == "password") {
                    echo $member_password;
                } elseif ($i == "dob") {
                    echo $m_dob;
                } elseif ($i == "state") {
                    echo $m_state;
                } elseif ($i == "state_id") {
                    echo $m_state_id;
                } elseif ($i == "city") {
                    echo $m_city;
                } elseif ($i == "city_id") {
                    echo $m_city_id;
                } elseif ($i == "pincode") {
                    echo $m_pincode;
                } elseif ($i == "address") {
                    echo $m_address;
                } elseif ($i == "jdate") {
                    echo $m_date;
                } elseif ($i == "photo") {
                    echo $m_photo;
                } elseif ($i == "onlyStatus") {
                    return $status;
                } elseif ($i == "status") {
                    if ($status == "Active") {
                        echo '<b class="float-right text-success pr-5 pl-5" style="background-color: #e9ecef;">' . $status . '</b>';
                    } elseif ($status == "Inactive") {
                        echo '<b class="float-right text-danger pr-5 pl-5" style="background-color: #e9ecef;">( ' . $status . ' )</b> &nbsp;&nbsp;';
                    }
                }
                 elseif ($i == "statuss") {
                     
                    return $status ;
                   
                }
            }

            function updateMemberRecord() {
                $m_id = $_SESSION['m_id'];
                if (isset($_REQUEST['update_member'])) {
                    $name = $_POST['m_name'];
                    $email = $_POST['m_email'];
                    $mobile = $_POST['m_mobile'];
                    $pan = $_POST['m_pan'];
                    $dob = $_POST['m_dob'];
                    $state = $_POST['member_state'];
                    $city = $_POST['member_city'];
                    $pincode = $_POST['member_pincode'];
                    $address = $_POST['member_address'];
                    global $link;
            if ($_FILES['m_photo']['name'] != "") {

                $image = $_FILES['m_photo']['name'];
                $pre = date('d-m-Y-H-i-s');
                $image = $pre . "_" . $image;
                $target_path = "../admin/assets/images/users/" . $image;
                $tmp_name = $_FILES['m_photo']['tmp_name'];
                move_uploaded_file($tmp_name, $target_path);
                //rename($target_path2, "New/".basename( $_FILES["m_photo"]["name"]));

                $query = "UPDATE `members` SET `m_name`='$name',`m_mobile`='$mobile',`m_email`='$email',`m_pan`='$pan',`m_dob`='$dob',`m_state_id`='$state',`m_city_id`='$city',`m_pincode`='$pincode',`m_address`='$address',`m_photo`='$image' WHERE m_id='$m_id'";
                $result = mysqli_query($link, $query);

                usleep(1 * 1000);

                if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                    echo '<div class="text-success"><b>Your record is updated with photo!</b></div>';
                }
            } else {
                    $query = "UPDATE `members` SET `m_name`='$name',`m_mobile`='$mobile',`m_email`='$email',`m_pan`='$pan',`m_dob`='$dob',`m_state_id`='$state',`m_city_id`='$city',`m_pincode`='$pincode',`m_address`='$address' WHERE m_id='$m_id'";
                    $result = mysqli_query($link, $query);
                    usleep(1 * 1000);
                    if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                        echo '<div class="text-success"><b>Your record has been updated!</b></div>';
                    }
            }
                }
            }
            
                function showClosingStatement() {
        $date = date('Y-m-d');
        global $link;
          $m_id = $_SESSION['m_id'];
        $query = "SELECT * FROM `monthly_closing_statement` where member_id='$m_id'";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['total_income']; ?></td>
                     <td><?php echo $row['Total_tds']; ?></td>
                    <td><?php echo $row['Total_processing']; ?></td>
                    <td><?php echo $row['Total_Travelling']; ?></td>
                       <td><?php echo $row['Total_Charity']; ?></td>
                         <td><?php echo $row['month_BP']; ?></td>
                          <td><?php echo $row['left_month_bp']; ?></td>
                       <td><?php echo $row['right_month_bp']; ?></td>
                        
                          <td><?php echo $row['month_pv_matching']; ?></td>
                        <td><?php echo $row['pv_income']; ?></td>
                        <td><?php echo $row['income_month']; ?></td>
                       <td><?php echo $row['referal_income']; ?></td>
                   
                             
                
                    <td><?php echo $row['RectimeStamp']; ?></td>
                  
                </tr><?php
                $i++;
            }
        }

        if ($rowcount == 0) {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

            function showMyDirectDownline() {
         $m_id = $_SESSION['m_id']; 
        global $link;

        $query = "SELECT * FROM `members` WHERE sponsor_id='$m_id'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $current_m_id = $row['m_id'];
                if ($row['m_status'] == "Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['m_status']; ?></td>
                <!--                    <td><a href="#" class="link">Go Direct Downline</a></td>-->
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }

            function chengePassword() {
                $m_id = $_SESSION['m_id'];
                if (isset($_REQUEST['chenge_password'])) {
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    global $link;
                    $query = "UPDATE `members` SET `m_password`='$password' WHERE m_id='$m_id'";
                    $result = mysqli_query($link, $query);
                    if ($result) {
                        echo '<script>alert("Your password has been updated!");</script>';
                        //echo '<script>window.history.go(-2);</script>';
                        echo '<script>window.location.href = "change_password.php";</script>';
                    }
                }
            }

            function showStatesList() {
                global $link;
                $query = "SELECT * FROM `states`";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php
        }
    }

    function showBankList() {
        global $link;
        $query = "SELECT * FROM `banklist`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['bank']; ?></option>
            <?php
        }
    }

    function memberBankRecords($i) {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `member_bank_details` WHERE member_id='$m_id'";
        $result = mysqli_query($link, $query);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            $row = mysqli_fetch_array($result);
            $bank_name = $row['bank_name'];
            $bank_branch = $row['bank_branch'];
            $bank_ifsc_code = $row['bank_ifsc_code'];
            $bank_holder_name = $row['bank_holder_name'];
            $bank_account_no = $row['bank_account_no'];
            $bank_account_type = $row['bank_account_type'];

            if ($i == "bank_name") {
                return $bank_name;
            } elseif ($i == "branch") {
                echo $bank_branch;
            } elseif ($i == "ifsc_code") {
                echo $bank_ifsc_code;
            } elseif ($i == "holder_name") {
                echo $bank_holder_name;
            } elseif ($i == "account_no") {
                echo $bank_account_no;
            } elseif ($i == "account_type") {
                return $bank_account_type;
            }
        } else {
            return "";
        }
    }

    function updateBankDetails() {
        $m_id = $_SESSION['m_id'];
        if (isset($_REQUEST['update_bank'])) {
            $bank_name = $_POST['bank_name'];
            $bank_branch = $_POST['bank_branch'];
            $ifsc_code = $_POST['ifsc_code'];
            $account_holder = $_POST['account_holder'];
            $account_no = $_POST['account_no'];
            $account_type = $_POST['account_type'];
            $date = date('Y-m-d');
            global $link;
            $query = "UPDATE `member_bank_details` SET `bank_name`='$bank_name',`bank_branch`='$bank_branch',`bank_ifsc_code`='$ifsc_code',`bank_holder_name`='$account_holder',`bank_account_no`='$account_no',`bank_account_type`='$account_type' WHERE `member_id`='$m_id'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your record has been updated!</b></div>';
            }
        } elseif (isset($_REQUEST['add_bank'])) {
            $member_name = $_POST['member_name'];
            $bank_name = $_POST['bank_name'];
            $bank_branch = $_POST['bank_branch'];
            $ifsc_code = $_POST['ifsc_code'];
            $account_holder = $_POST['account_holder'];
            $account_no = $_POST['account_no'];
            $account_type = $_POST['account_type'];
            $date = date('Y-m-d');
            global $link;
            $query = "INSERT INTO `member_bank_details` (`member_bank_id`, `member_id`, `member_name`, `bank_name`, `bank_branch`, `bank_ifsc_code`, `bank_holder_name`, `bank_account_no`, `bank_account_type`, `date`) VALUES (NULL, '$m_id', '$member_name', '$bank_name', '$bank_branch', '$ifsc_code', '$account_holder', '$account_no', '$account_type', '$date')";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your record has been added!</b></div>';
            }
        }
    }

    function getAmount($i) {
        $m_id = $_SESSION['m_id'];
        $amount = 0;
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$m_id'");
        $row = mysqli_fetch_array($result);
        $amount = $row['Total_wallet'];
        if ($i == "amount") {
            echo $amount;
        }
    }

    function addWithdrawal() {
        $m_id = $_SESSION['m_id'];
        $day = date("w");
        if (isset($_REQUEST['add_withdrawal'])) {
            global $link;
            $result4 = mysqli_query($link, "SELECT * FROM `member_bank_details` WHERE member_id=$m_id");
            $rowNum = mysqli_num_rows($result4);
            if ($rowNum > 0) {
                $member_id = $_POST['member_id'];
                $member_name = $_POST['member_name'];
                $total_wallet = $_POST['total_wallet'];
                $wallet_request = $_POST['wallet_request'];
                $date = date('Y-m-d');
                date_default_timezone_set('Asia/Kolkata');
                $time = date('H:i:s');

                usleep(1 * 1000);
                // $res_member_income = mysqli_query($link, "SELECT * FROM `member_income` WHERE member_id='$member_id'");
                // $member_res = mysqli_fetch_array($res_member_income);
                // $member_amount = $member_res['member_amount'];
                // $member_amount = $member_amount - $wallet_request;

                mysqli_query($link, "UPDATE `members` SET `Total_wallet`=Total_wallet-$wallet_request WHERE m_id='$member_id'");

                usleep(1 * 1000);
                $query = "INSERT INTO `withdrawal_request` (`request_id`, `member_id`, `member_name`, `total_wallet`, `wallet_request`, `request_status`, `date`, `time`) VALUES (NULL, '$member_id', '$member_name', '$total_wallet', '$wallet_request', 'Pending', '$date', '$time')";
                $result = mysqli_query($link, $query);
                if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                    echo '<div class="text-success"><b>Your request has been sent successfully!</b></div>';
                    echo '<script>location.replace("index.php");</script>';
                }
            } else {
                echo '<div class="text-danger"><b>You first add your bank details and then request your wallet!</b></div>';
            }
        }
    }

    function addUpi() {
        $m_id = $_SESSION['m_id'];
        if (isset($_REQUEST['add_upi'])) {
            $upi = $_POST['upi'];
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            global $link;
            $query = "INSERT INTO `upi_details` (`upi_id`, `member_id`, `upi_no`, `date`, `time`) VALUES (NULL, '$m_id', '$upi', '$date', '$time')";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your UPI has been added successfully!</b></div>';
            }
        } elseif (isset($_REQUEST['update_upi'])) {
            $upi = $_POST['upi'];
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            global $link;
            $query = "UPDATE `upi_details` SET `upi_no`='$upi',`date`='$date',`time`='$time' WHERE member_id='$m_id'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your UPI has been updated successfully!</b></div>';
            }
        }
    }

    function getUpi($i) {
        $m_id = $_SESSION['m_id'];
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `upi_details` WHERE member_id='$m_id'");
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $row = mysqli_fetch_array($result);
            $upi = $row['upi_no'];
            if ($i == "upi") {
                echo $upi;
            } elseif ($i == "get_upi") {
                return $upi;
            }
        } else {
            echo '';
        }
    }

    function ShowValidEpinForTransfer() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `epin_report` WHERE status='Unused' AND m_id=$m_id";
        $result = mysqli_query($link, $query);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            $id = "id" . $i;
            ?>
            <label for="<?php echo $id; ?>">
                <input type="checkbox" name="epins[]" id="<?php echo $id; ?>" value="<?php echo $row['epin']; ?>" />
                <?php
//                $product_id = $row['product_name'];
//                $result4 = mysqli_query($link, "SELECT * FROM `product_list` WHERE id=$product_id");
//                $row4 = mysqli_fetch_array($result4);
//                $product_name = $row4['product_name'];
                echo $row['epin'];
                ?></label>
                <?php
            $i++;
        }
    }

    function showAvailableEpinList() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `epin_report` WHERE status='Unused' AND m_id=$m_id";
        $result = mysqli_query($link, $query);
        $rowNum = mysqli_num_rows($result);
        if ($rowNum > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td class="p-0 text-center"><?php echo $i; ?></td>

                    <td><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td>
                        <div class="btn-group dropleft ">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">

                                <a class="dropdown-item" href="activate_member.php?epinid=<?php echo $row['epin']; ?>">Use As Activate</a>

                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showSaleEpinList() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `withdrawal_tds` WHERE member_id='$m_id' ORDER BY tds_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php
                        $m_id = $row['member_id'];
                        $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$m_id");
                        $row2 = mysqli_fetch_array($result2);
                        $member_name = $row2['m_name'];
                        echo $member_name;
                        ?></td>
                    <td><?php
                echo $row['wallet_request_amount'];
                        ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['date']; ?></td>


                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showWithdrawalRequest() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `withdrawal_request` WHERE member_id='$m_id' ORDER BY request_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo number_format($row['wallet_request'], 1); ?> &#8377;</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['request_status']; ?></td>
                </tr><?php
                        $i++;
                    }
                } else {
                    echo '<tr><td colspan="8" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function showPaidIncome() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $query = "SELECT * FROM `withdrawal_tds` WHERE member_id=$m_id";
                $result = mysqli_query($link, $query);
                $i = 1;
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['wallet_request_amount']; ?> &#8377;</td>
                    <td><?php echo $row['tds_amount']; ?> &#8377;</td>
                    <td><?php echo $row['final_amount']; ?> &#8377;</td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr><?php
                        $i++;
                    }
                } else {
                    echo '<tr><td colspan="8" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function showMyTdsList() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $query = "SELECT * FROM `closing_statement` WHERE member_id=$m_id  ORDER BY id DESC";
                $result = mysqli_query($link, $query);
                //$row = mysqli_fetch_array($result);
                $i = 1;
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['member_id']; ?></td>
                    <?php
                    $m_id = $row['member_id'];
                    $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$m_id");
                    $row2 = mysqli_fetch_array($result2);
                    $member_name = $row2['m_name'];
                    ?>
                    <td><?php echo $member_name; ?></td>
                    <td><?php echo number_format($row['total_income'], 1); ?> &#8377;</td>
                    <td><?php echo number_format($row['tds_amount'], 1); ?> &#8377;</td>
                    <td><?php echo number_format($row['available_amount'], 1); ?> &#8377;</td>
                    <td><?php echo $row['date_time']; ?></td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="9" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showProductList() {
        global $link;
        $query = "SELECT * FROM `product_list`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
                ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
            <?php
        }
    }

    function showStockOfMember() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `withdrawal_request` WHERE member_id='$m_id' AND request_status='Reject' ORDER BY request_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_name'] . ' (' . $row['member_id']; ?>)</td>
                    <td><?php echo number_format($row['wallet_request'], 1); ?> &#8377;</td>

                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                </tr><?php
                        $i++;
                    }
                } else {
                    echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function homepageDetails($i) {
                $m_id = $_SESSION['m_id'];
                global $link;

                $resultMI = mysqli_query($link, "SELECT SUM(`Total_wallet`), SUM(`singleleg_income`), SUM(`franchise_income`), SUM(`royalty_income`), SUM(`total_income`), SUM(`Total_processing`), SUM(`Total_Travelling`), SUM(`Total_Charity`), SUM(`Total_tds`), SUM(`Paid_Income`), SUM(`month_pv_matching`), SUM(`income_month`), SUM(`month_BP`), SUM(`Point_Year`), SUM(`Accumulation_BP`), SUM(`Left_BP`), SUM(`Right_BP`), SUM(`Left_PV_Daily`), SUM(`Right_PV_Daily`), SUM(`Daily_pv_matching`) FROM `members` WHERE m_id='$m_id'");
                $rowMI = mysqli_fetch_row($resultMI);

                   $resultMMIm = mysqli_query($link, "SELECT * FROM `members` where m_id='$m_id'");
                   $rowMMIm = mysqli_fetch_array($resultMMIm);
                    if(($rowMMIm['Paid_Wallet'])>=6000){

                         $merchantvalue=((($rowMMIm['Total_wallet'])*10)/100);

                    }
                    else{
                        $diff=6000-$rowMMIm['Paid_Wallet'];
                         if( ((($rowMMIm['Total_wallet']-$diff)*10)/100)<0)  $merchantvalue=0;
                         else{

                             $merchantvalue=((($rowMMIm['Total_wallet']-$diff)*10)/100);
                         }


                    }

                if ($i == "walletamount") {
                    echo number_format($rowMI[0], 2);
                } elseif ($i == "TDS") {
                    $TDS=$rowMI[8];
                    echo number_format($TDS, 2);
                } elseif ($i == "processingfee") {
                    $processingfee=$rowMI[5];
                    echo number_format($processingfee, 2);
                }elseif ($i == "travelling") {
                    $processingfee=$rowMI[6];
                    echo number_format($processingfee, 2);
                }elseif ($i == "charity") {
                    $processingfee=$rowMI[7];
                    echo number_format($processingfee, 2);
                } elseif ($i == "paidpayableamount") {
                    $processingfee=$rowMI[9];
                    echo number_format($processingfee, 2);
                } elseif ($i == "monthpvmatching") {
                    $processingfee=$rowMI[10];
                    echo $processingfee;
                }elseif ($i == "dailymatchingpv") {
                    $processingfee=$rowMI[19];
                    echo $processingfee;
                }elseif ($i == "leftpv") {
                    $processingfee=$rowMI[17];
                    echo $processingfee;
                }elseif ($i == "rightpv") {
                    $processingfee=$rowMI[18];
                    echo $processingfee;
                } elseif ($i == "incomemonth") {
                    $processingfee=$rowMI[11];
                    echo number_format($processingfee, 2);
                } elseif ($i == "monthbp") {
                    $processingfee=$rowMI[12];
                    echo $processingfee;
                }
                 elseif ($i == "accumulation_BP") {
                    
                    $processingfee=$rowMI[14];
                    echo $processingfee;
                } elseif ($i == "left_BP") {
                    $processingfee=$rowMI[15];
                    echo $processingfee;
                }elseif ($i == "right_BP") {
                    $processingfee=$rowMI[16];
                    echo $processingfee;
                }elseif ($i == "annualpoints") {
                    $processingfee=$rowMI[13];
                    echo $processingfee;
                }elseif ($i == "memberrank") {
                    $processingfee=$rowMMIm['member_rank'];
                    echo $processingfee;
                }elseif ($i == "merchantvalues") {
                   
                    echo number_format($merchantvalue, 2);
                } elseif ($i == "payableamount") {

                   echo  $payableamount=$rowMI[4];
                   
                }elseif ($i == "pairachievementlevel") {

                    $steps=$rowMMIm['Steps_Year'];
                    if($steps>=400) echo "DIAMOND";
                    elseif($steps>=260) echo "AMBESDER"; 
                     elseif($steps>=160) echo "CROWN";
                      elseif($steps>=100) echo "GENIOUS";
                       elseif($steps>=75) echo "REGENT";
                        elseif($steps>=40) echo "SUPREMO";
                         elseif($steps>=25) echo "SUPER STAR";
                          elseif($steps>=12) echo "STAR";
                           elseif($steps>=6) echo "MASTER";
                            elseif($steps>=2) echo "SMART";
                           
                             else{ echo "NA"; }

                   
                } elseif ($i == "repurchasepinlevel") {

                    $purpv=$rowMMIm['Purchase_Pv_year'];
                  if($purpv>=1500) echo "SUPER GALAXY";
                    elseif($purpv>=1200) echo "GALAXY"; 
                     elseif($purpv>=900) echo "5 STAR";
                      elseif($purpv>=600) echo "5 STAR";
                       elseif($purpv>=400) echo "STAR";
                        elseif($purpv>=250) echo "RISING STAR";
                        
                           
                             else{ echo "NA"; }

                   
                }elseif ($i == "total_amount") {
                    $query = "SELECT * FROM `members` WHERE m_id='$m_id'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                    echo number_format($row['Total_wallet'], 1);
                } elseif ($i == "active_downline") {
                    $query = "SELECT * FROM `members` WHERE m_id=$m_id";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                    $id = $row['id'];

                    $query2 = "SELECT * FROM `members` WHERE id>$id AND m_status='Active'";
                    $result2 = mysqli_query($link, $query2);
                    $rowNUM2 = mysqli_num_rows($result2);
                    echo $rowNUM2;
                } elseif ($i == "inactive_downline") {
                    $query = "SELECT * FROM `members` WHERE m_id=$m_id";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                    $id = $row['id'];

                    $query2 = "SELECT * FROM `members` WHERE id>$id AND m_status='Inactive'";
                    $result2 = mysqli_query($link, $query2);
                    $rowNUM2 = mysqli_num_rows($result2);
                    echo $rowNUM2;
                } elseif ($i == "all_downline") {
                    $query = "SELECT * FROM `members` WHERE m_id=$m_id";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_array($result);
                    $id = $row['id'];

                    $query2 = "SELECT * FROM `members` WHERE id>$id AND m_status!='Block'";
                    $result2 = mysqli_query($link, $query2);
                    $rowNUM2 = mysqli_num_rows($result2);
                    echo $rowNUM2;
                }
            }

            public function getDownlineMem($id) {
                //$DLRreport = array();
                global $DLRreport;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['member_id'];
                        $AMid = $row['active_member_id'];
                        array_push($DLRreport, $AMid);
                        $this->getDownlineMem2($id);
                    }
                }
                return $DLRreport;
            }

            public function getDownlineMem2($id) {
                //$DLRreport = array();
                global $DLRreport;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['member_id'];
                        $AMid = $row['active_member_id'];
                        array_push($DLRreport, $AMid);
                        $this->getDownlineMem($id);
                    }
                }
                return $DLRreport;
            }

            public function getDLMem($id) {
                //$DLRreport = array();
                global $DLRreport;
                foreach ($DLRreport as $i => $value) {
                    unset($DLRreport[$i]);
                }
                $z = $this->getDownlineMem($id);
                return $z;
            }

            function showDownlineReport() {
                $m_id = $_SESSION['m_id'];
                global $link;
//        $result1 = mysqli_query($link, "SELECT * FROM `active_members` WHERE member_id=$m_id");
//        $row1 = mysqli_fetch_array($result1);
//        $active_member_id = $row1['active_member_id'];
//
//
//        $query = "SELECT * FROM `active_members` WHERE active_member_id>$active_member_id";
//        $result = mysqli_query($link, $query);
//        //$row = mysqli_fetch_array($result);
//        $i = 1;
//        $rowcount = mysqli_num_rows($result);

                $result = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$m_id'");
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE id>'$id'");
                $rowcount = mysqli_num_rows($result2);
//        $downlineMember = $this->getDLMem($m_id);
//        $rowcount = count($downlineMember);
                if ($rowcount > 0) {
                    $j = 1;
                    while ($row2 = mysqli_fetch_array($result2)) {




                        if ($row2['m_status'] == "Active") {
                            $txtColor = "green";
                        } else {
                            $txtColor = "red";
                        }
                        ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $j; ?>
                    </td>
                    <td><?php echo $row2['m_id']; ?></td>
                    <td><?php echo $row2['m_name']; ?></td>
                    <td><?php echo $row2['m_status']; ?></td>
                </tr><?php
                        $j++;
                    }
                } else {
                    echo '<tr><td colspan="4" class="p-0 text-center">No Record</td></tr>';
                }
            }

            public function getLeftDownlineMem($id) {
                //$DLRreport2 = array();
                global $DLRreport2;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    $dllocalarray = array();
                    foreach ($dllocalarray as $i => $value) {
                        unset($dllocalarray[$i]);
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['m_id'];
                        array_push($DLRreport2, $id);
                        array_push($dllocalarray, $id);
                        //$this->getLeftDownlineMem2($id);
                    }
                    $dlarc = count($dllocalarray);
                    for ($i = 0; $i < $dlarc; $i++) {
                        $idd = $dllocalarray[$i];
                        $this->getLeftDownlineMem2($idd);
                    }
                }
                return $DLRreport2;
            }

            public function getLeftDownlineMem2($id) {
                //$DLRreport2 = array();
                global $DLRreport2;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    $dllocalarray2 = array();
                    foreach ($dllocalarray2 as $i => $value) {
                        unset($dllocalarray2[$i]);
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['m_id'];
                        array_push($DLRreport2, $id);
                        array_push($dllocalarray2, $id);
                        //$this->getLeftDownlineMem($id);
                    }
                    $dlarc2 = count($dllocalarray2);
                    for ($i = 0; $i < $dlarc2; $i++) {
                        $idd = $dllocalarray2[$i];
                        $this->getLeftDownlineMem($idd);
                    }
                }
                return $DLRreport2;
            }

            public function getLDLMem($id) {
                //$DLRreport2 = array();
                global $DLRreport2;
                foreach ($DLRreport2 as $i => $value) {
                    unset($DLRreport2[$i]);
                }
                $z = $this->getLeftDownlineMem($id);
                return $z;
            }


             public function countAlldownline() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                $k=0;
                $l=0;
                $rowcount1=0;
                $rowcount2=0;
                if ($row_Count > 0) {
                    $k=1;
                    $row1 = mysqli_fetch_array($result1);
                    $left_member_id = $row1['m_id'];


                    usleep(1 * 1000);
                    $queryleft = "SELECT * FROM `members` WHERE m_id='$left_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($left_member_id);
                      $rowcount1 = count($downlineMember);

            $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                if ($row_Count > 0) {
                    $l=1;
                    $row1 = mysqli_fetch_array($result1);
                    $right_member_id = $row1['m_id'];

                    usleep(1 * 1000);

                    $queryleft = "SELECT * FROM `members` WHERE m_id='$right_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($right_member_id);
                     $rowcount2 = count($downlineMember);
                   
                }
                   
                } 

               echo $totaldownline=$rowcount1+$rowcount2+$l+$k;
            }

            public function countAlldownlineActive() {
                $m_id = $_SESSION['m_id'];
                global $link; 
                $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND sponsor_id='$m_id' and m_status='Active'");
                $row_Count = mysqli_num_rows($result1);
                $k=0;
                $l=0;
                $rowcount1=0;
                $rowcount2=0;
                if ($row_Count > 0) {
                    $k=1;
                    $row1 = mysqli_fetch_array($result1);
                    $left_member_id = $row1['m_id'];


                    usleep(1 * 1000);
                    $queryleft = "SELECT * FROM `members` WHERE m_id='$left_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($left_member_id);
                      $rowcount1 = count($downlineMember);

            $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                if ($row_Count > 0) {
                    $l=1;
                    $row1 = mysqli_fetch_array($result1);
                    $right_member_id = $row1['m_id'];

                    usleep(1 * 1000);

                    $queryleft = "SELECT * FROM `members` WHERE m_id='$right_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($right_member_id);
                     $rowcount2 = count($downlineMember);
                   
                }
                   
                } 

               echo $totaldownline=$rowcount1+$rowcount2+$l+$k;
            }

    public function countAlldownlineInActive() {
                $m_id = $_SESSION['m_id'];
                global $link; 
                $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND sponsor_id='$m_id' and m_status='Inactive'");
                $row_Count = mysqli_num_rows($result1);
                $k=0;
                $l=0;
                $rowcount1=0;
                $rowcount2=0;
                if ($row_Count > 0) {
                    $k=1;
                    $row1 = mysqli_fetch_array($result1);
                    $left_member_id = $row1['m_id'];


                    usleep(1 * 1000);
                    $queryleft = "SELECT * FROM `members` WHERE m_id='$left_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($left_member_id);
                      $rowcount1 = count($downlineMember);

            $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                if ($row_Count > 0) {
                    $l=1;
                    $row1 = mysqli_fetch_array($result1);
                    $right_member_id = $row1['m_id'];

                    usleep(1 * 1000);

                    $queryleft = "SELECT * FROM `members` WHERE m_id='$right_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                    $j = 1;
                    ?><?php
                    $downlineMember = $this->getLDLMem($right_member_id);
                     $rowcount2 = count($downlineMember);
                   
                }
                   
                } 

               echo $totaldownline=$rowcount1+$rowcount2+$l+$k;
            }

           public function showLeftDownlineReport() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_placement='Left' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                if ($row_Count > 0) {
                      $j = 1;
        while ($row1 = mysqli_fetch_array($result1)) {
              if ($row1['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                  
                    $left_member_id = $row1['m_id'];


                    usleep(1 * 1000);
                    $queryleft = "SELECT * FROM `members` WHERE m_id='$left_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                  
                    ?><tr style="color: <?php echo $txtColor; ?>;">
                <td class="p-0 text-center">
                    <?php echo $j++; ?>
                </td>
                <td><?php echo $rowleft['m_id']; ?></td>
                <td><?php echo $rowleft['m_name']; ?></td>
                <td><?php echo $rowleft['m_status']; ?></td>
            </tr><?php
                    $downlineMember = $this->getLDLMem($left_member_id);
                      $rowcount = count($downlineMember);
                    if ($rowcount > 0) {
                       
                        usleep(1 * 1000);
                        foreach ($downlineMember as $i => $value) {
                            $member_id = $value;
                            $query = "SELECT * FROM `members` WHERE m_id=$member_id";
                            $result = mysqli_query($link, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                  if ($row['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                                ?><tr style="color: <?php echo $txtColor; ?>;">
                            <td class="p-0 text-center">
                                <?php echo $j++; ?>
                            </td>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><?php echo $row['m_name']; ?></td>
                            <td><?php echo $row['m_status']; ?></td>
                        </tr><?php
                                
                            }
                        }
                    }
                } } else {
                    echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
                }
            }

            public function showRightDownlineReport() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_placement='Right' AND sponsor_id='$m_id'");
                $row_Count = mysqli_num_rows($result1);
                if ($row_Count > 0) {
               $j = 1;
        while ($row1 = mysqli_fetch_array($result1)) {
             if ($row1['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                    $right_member_id = $row1['m_id'];

                    usleep(1 * 1000);

                    $queryleft = "SELECT * FROM `members` WHERE m_id='$right_member_id'";
                    $resultleft = mysqli_query($link, $queryleft);
                    $rowleft = mysqli_fetch_array($resultleft);
                   
                    ?><tr style="color: <?php echo $txtColor; ?>;">
                <td class="p-0 text-center">
                    <?php echo $j++; ?>
                </td>
                <td><?php echo $rowleft['m_id']; ?></td>
                <td><?php echo $rowleft['m_name']; ?></td>
                <td><?php echo $rowleft['m_status']; ?></td>
            </tr><?php
                    $downlineMember = $this->getLDLMem($right_member_id);
                     $rowcount = count($downlineMember);
                    if ($rowcount > 0) {
                       
                        usleep(1 * 1000);
                        foreach ($downlineMember as $i => $value) {
                            $member_id = $value;
                            $query = "SELECT * FROM `members` WHERE m_id=$member_id";
                            $result = mysqli_query($link, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                 if ($row['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                                ?><tr style="color: <?php echo $txtColor; ?>;">
                            <td class="p-0 text-center">
                                <?php echo $j++; ?>
                            </td>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><?php echo $row['m_name']; ?></td>
                            <td><?php echo $row['m_status']; ?></td>
                        </tr><?php
                               
                            }
                        }
                    }
                }  } else {
                    echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
                }
            }
            public function getLeftDownlineMemCF($id) {
                //$DLRreportCF = array();
                global $DLRreportCF;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['member_id'];
                        $mstatus = $row['member_status'];
                        if ($mstatus == "Active") {
                            array_push($DLRreportCF, $id);
                        }
                        $this->getLeftDownlineMemCF2($id);
                    }
                }
                return $DLRreportCF;
            }

            public function getLeftDownlineMemCF2($id) {
                //$DLRreportCF = array();
                global $DLRreportCF;
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['member_id'];
                        $mstatus = $row['member_status'];
                        if ($mstatus == "Active") {
                            array_push($DLRreportCF, $id);
                        }
                        $this->getLeftDownlineMemCF($id);
                    }
                }
                return $DLRreportCF;
            }

            public function getLDLMemCF($id) {
                global $DLRreportCF;
                foreach ($DLRreportCF as $i => $value) {
                    unset($DLRreportCF[$i]);
                }
                $z = $this->getLeftDownlineMemCF($id);
                return $z;
            }

            function getCarryForward() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $result = mysqli_query($link, "SELECT * FROM `wallet_request` WHERE member_id='$m_id' AND status='Reject' ");
                $rownum = mysqli_num_rows($result);
                if ($rownum > 0) {

                    $j = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $j; ?>
                    </td>
                    <td><?php echo $row['numberof_epin']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['transaction_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['reason']; ?></td>

                </tr><?php
                        $j++;
                    }
                } else {
                    echo '<tr><td colspan="9" class="p-0 text-center">No Record</td></tr>';
                }
            }

            function showTransferEpinList() {
                $m_id = $_SESSION['m_id'];
                global $link;
                $query = "SELECT * FROM `epin_transfer` WHERE from_id='$m_id'";
                $result = mysqli_query($link, $query);
                $rowNum = mysqli_num_rows($result);
                if ($rowNum > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                <tr>
                    <td class="p-0 text-center"><?php echo $i; ?></td>
                    <td><?php
                $to_id = $row['from_id'];
                $resultTomember = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$to_id");
                $rowTomember = mysqli_fetch_array($resultTomember);
                $m_name = $rowTomember['m_name'];
                echo $m_name . " (" . $row['from_id'];
                        ?>)</td>
                    <td><?php
                $to_id = $row['to_id'];
                $resultTomember = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$to_id");
                $rowTomember = mysqli_fetch_array($resultTomember);
                $m_name = $rowTomember['m_name'];
                echo $m_name . " (" . $row['to_id'];
                        ?>)</td>

                    <td><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="8" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function singleleg_income() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `singleleg_income` WHERE status='Pending' AND member_id='$m_id'";
        $resultDDL = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$m_id'");
        $rowcountDDL = mysqli_num_rows($resultDDL);
        $result = mysqli_query($link, $query);
        $rowNum = mysqli_num_rows($result);
        if ($rowNum > 0) {
            $start_date = date('Y-m-d');
            while ($row = mysqli_fetch_array($result)) {
                $label = $row['label'];
                $id = $row['id'];
                if ($label == 'STAR') {
                    if ($rowcountDDL >= 1) {
                        $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                        mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        
                    }
                } elseif ($label == 'SILVER') {
                    if ($rowcountDDL >= 1) {
                        $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                        mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve' WHERE id='$id'");
                        
                    }
                }
                
                
            }
        }
    }
    
    function send_singleleg_income() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $date = date('Y-m-d');
        $query = "SELECT * FROM `singleleg_income` WHERE start_date<=$date AND end_date>$date AND member_id='$m_id'";
        $result = mysqli_query($link, $query);
        $rowNum = mysqli_num_rows($result);
        if ($rowNum > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $amount = $row['amount'];
                mysqli_query($link, "UPDATE `members` SET `singleleg_income`=singleleg_income+$amount,`total_income`=total_income+$amount WHERE m_id=$m_id");
            }
        }
    }
    
    function getFrenchizeIncome() {
        $m_id = $_SESSION['m_id'];
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `franchise_income` WHERE `member_id` = '$m_id'  ORDER BY id DESC");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {

            $j = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $j; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['total_epins']; ?></td>
                    <td>&#8377; <?php echo number_format($row['total_amount'], 2); ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    

                </tr><?php
                $j++;
            }
        } else {
            echo '<tr><td colspan="9" class="p-0 text-center">No Record</td></tr>';
        }
    }
    
    function getQualified($rank) {

        $m_id = $_SESSION['m_id'];
        global $link;
        $query = "SELECT * FROM `singleleg_income` WHERE member_id='$m_id' AND status='Approve' AND label='$rank' ";
        $result = mysqli_query($link, $query);
        
         $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {
            echo "<b class='text-success'>Qualified</b>";
        }
        else{
             echo "<b class='text-danger'>Not Qualified</b>";
        }
    }

    function showProductStocksss($memberid) {
         include_once '../include/ram.php';
   
    $ramObj = new ram;
        global $link;
        $query = "SELECT * FROM `franchise_product` where member_id='$memberid'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
               
                ?><tr >
                    <td>
                        <?php echo $i; ?>
                    </td>
                    <td>P<?php echo $row['Product_Code']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $ramObj->categorynames($row['Category']); ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><?php echo $row['PV']; ?></td>
                     <td><?php echo $row['BP']; ?></td>
                        <td><?php echo $row['Available']; ?></td>
                    <td><?php echo $row['Purchase']; ?></td>
                        <td><?php echo $row['Sold']; ?></td>
                 
                   

                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showSaleList($francisememberid) {
        global $link;
        $query = "SELECT * FROM `sale_product` where Franchise_Id='$francisememberid'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $accountid=$row['sale_id'];

                   $ResultAll = mysqli_query($link, "SELECT * FROM `sale_payments` WHERE purchase_id='$accountid' order by id desc limit 1");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
     $RowAll = mysqli_fetch_array($ResultAll);
       $totalamount=$RowAll['Now_Dew'];
  }
  else{

$totalamount=0;

  } 
                if ($totalamount <=0) {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td >
                        <?php echo $i; ?>
                    </td>
                    <td>S<?php echo $accountid=$row['sale_id']; ?></td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['Total_Amounts']; ?></td>
                 
                    <td><?php echo $row['Total_Amounts']-$totalamount; ?></td>
                    <td><?php echo $totalamount; ?></td>
                   
                   <td>


                        <a href="saleReciept.php?accountid=<?php echo $row['sale_id']; ?>" title="View Reciept" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>
               <?php if ($totalamount>0) {
              ?>
               <a href="addsalepayments.php?accountid=<?php echo $row['sale_id']; ?>" title="Add Payment" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus" aria-hidden="true"></i>
              </a><?php  } else{   ?>
                 <a  title="Paid" class="btn btn-primary btn-sm">
                                <i class="fas fa-circle" aria-hidden="true"></i>
              </a>
          <?php } ?>

            <a href="viewsalepaymentlist.php?accountid=<?php echo $row['sale_id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>



                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function add_saleproductpayment() {

        if (isset($_REQUEST['add_saleproductpayment'])) {
//         
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
          
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         

//           

           

              $query = "INSERT INTO `sale_payments` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`) VALUES (NULL, '$purchasetempids', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp')";
            $result = mysqli_query($link, $query);
                  
                     
                    
                   
                    
            usleep(1 * 1000);
            if ($result) {

             
                
                
                echo '<script> alert("Payment Added Successfully"); </script>';
                echo '<script>window.location.href = "salelistproduct.php";</script>';
//                
            } else {
                echo '<script> alert("Payment not successfully inserted."); </script>';
            }

        }
    }

    function senduptolevel($p_namesss,$uplevelpv1,$uplevelbp1,$placement1,$memberrank1)
    {


   global $link;


         $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$p_namesss'");

            $RowAllss = mysqli_fetch_array($ResultAllss);
            
              $leftpv=$RowAllss['left_PV'];
              $rightpv=$RowAllss['right_PV'];
               $leftpvdaily=$RowAllss['Left_PV_Daily'];
              $rightpvdaily=$RowAllss['Right_PV_Daily'];
            $dailymaxpvmatching=$RowAllss['Daily_Max_Pv_Matching'];
             $totalpvmatching=$RowAllss['Total_Pv_Matching'];
              $dailypvmatching=$RowAllss['Daily_pv_matching'];
               $monthpvmatching=$RowAllss['month_pv_matching'];
              $accumulationbp=$RowAllss['Accumulation_BP'];
                $accumulationbpmonth=$RowAllss['Accumulation_BP_Month'];
               $leftbp=$RowAllss['Left_BP'];
              $rightbp=$RowAllss['Right_BP'];
               $leftbpforpoint=$RowAllss['Left_BP_For_Point'];
              $rightbpforpoint=$RowAllss['Right_BP_For_Point'];
               $totalpoint=$RowAllss['Total_Point'];
                $yearpoint=$RowAllss['Point_Year'];
               $sponserid=$RowAllss['sponsor_id'];
              $placement=$RowAllss['sponsor_placement'];
               $status=$RowAllss['m_status'];
                $datepvmatching=$RowAllss['date_pv_matching'];
                $memberrank=$RowAllss['member_rank'];
                 $memberranks=$RowAllss['member_rank'];
                $leftmonthbp=$RowAllss['left_month_bp'];
                $rightmonthbp=$RowAllss['right_month_bp'];
                 $incomemonth=$RowAllss['income_month'];
                  $sponserid=$RowAllss['sponsor_id'];
                  $totalbp=$uplevelbp1;
                $accumulationbp=$accumulationbp+$uplevelbp1;
                $accumulationbpmonth=$accumulationbpmonth+$uplevelbp1;


                if ($placement1=="Left") {   

                    
                      $leftbp= $leftbp+$uplevelbp1;
                     
                      $leftmonthbp=$leftmonthbp+$uplevelbp1;
                }
                else{
                   
                  
                   $rightbp= $rightbp+$uplevelbp1;
                  
                    $rightmonthbp= $rightmonthbp+$uplevelbp1;
                }



            $ResultAllsss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Left'");

             $rowcountsscdm = mysqli_num_rows($ResultAllsss);
             if ($rowcountsscdm>0) {
                while($RowAllsss = mysqli_fetch_array($ResultAllsss)){

                   $leftbps=$RowAllsss['Accumulation_BP'];
                   if ($leftbps>=3200000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=3200000) {
                            $memberrank="Crown-Director";
                        }

                      }
                       
                   }
                    elseif ($leftbps>=1600000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=1600000) {
                            $memberrank="Platinum-Director";
                        }

                      }
                       
                   }
                    elseif ($leftbps>=800000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=800000) {
                            $memberrank="Diamond-Director";
                        }

                      }
                       
                   }

                    elseif ($leftbps>=400000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=400000) {
                            $memberrank="Gold-Director";
                        }

                      }
                       
                   }

                     elseif ($leftbps>=200000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=200000) {
                            $memberrank="Silver-Director";
                        }

                      }
                       
                   }

                    elseif ($leftbps>=100000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=100000) {
                            $memberrank="Super-Director";
                        }

                      }
                       
                   }




                }


             }

            


              



                  if ($memberrank!="Super-Director"&&$memberrank!="Silver-Director"&&$memberrank!="Gold-Director"&&$memberrank!="Diamond-Director"&&$memberrank!="Platinum-Director"&&$memberrank!="Crown-Director") 
        {

                
             if ($accumulationbp>=100000) {
                $memberrank="Director";
            }
            elseif($accumulationbp>=25000) {
                $memberrank="Chief-Manager";
            }
             elseif($accumulationbp>=10000) {
                $memberrank="Manager";
            }
             elseif($accumulationbp>=5000) {
                $memberrank="Sales-Executive";
            }

        }
        
          if($memberrank!=$memberranks){
            
              $message = urlencode('Rank Promotion Congratulations,Name:' . $m_name . ',User ID:'.$p_namesss.' , Rank :'.$memberrank . ' Web : http://vastamarketing.in/');
                
              $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . "";
              //$url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
// create a new cURL resource
                  $ch = curl_init();
// set URL and other appropriate options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
                curl_exec($ch);
//
//// close cURL resource, and free up system resources
                curl_close($ch);
            
        }

      

        if ($memberrank==$memberrank1) {
           $commission=0;
        }
        else{


            if ($memberrank1=="") {
                  if ($memberrank=="Sales-Executive") {
           $commission=($totalbp*10)/100;
        }
         if ($memberrank=="Manager") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*45)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*50)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*55)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*60)/100;
        }
            }



             if ($memberrank1=="Sales-Executive") {


                 
         if ($memberrank=="Manager") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*45)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*50)/100;
        }
            }


               if ($memberrank1=="Manager") {
                 
        
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*45)/100;
        }
            }


              if ($memberrank1=="Chief-Manager") {
                 
        
      
        if ($memberrank=="Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*40)/100;
        }

            }


            if ($memberrank1=="Director") {
       
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*35)/100;
        }

            }

             if ($memberrank1=="Super-Director") {
       
      
        if ($memberrank=="Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*25)/100;
        }

            }

        if ($memberrank1=="Silver-Director") {


             if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
       
     
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*20)/100;
        }

            }

             if ($memberrank1=="Gold-Director") {
       
         
             if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
        
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*15)/100;
        }

            }


             if ($memberrank1=="Diamond-Director") {

                 if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
            if ($memberrank=="Gold-Director") {
           $commission=0;
        }
       
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*10)/100;
        }

            }

               if ($memberrank1=="Platinum-Director") {
         if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
            if ($memberrank=="Gold-Director") {
           $commission=0;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=0;
        }
     
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*5)/100;
        }

            }


              if ($memberrank1=="Crown-Director") {


       
           $commission=0;
        

            }


        }

             $incomemonth=$incomemonth+$commission;
             
              $results = mysqli_query($link, "UPDATE `members` SET `right_month_bp`='$rightmonthbp', `Accumulation_BP`='$accumulationbp', `income_month`='$incomemonth',`left_PV`='leftpv', `right_PV`='rightpv', `Left_BP`='$leftbp',`Right_BP`='$rightbp',`Left_BP_For_Point`=$leftbpforpoint,`Right_BP_For_Point`=$rightbpforpoint, `Total_Point`='$totalpoint', `Point_Year`='$yearpoint',`month_pv_matching`='$monthpvmatching', `Daily_pv_matching`='$dailypvmatching',`Left_PV_Daily`=$leftpvdaily,`Right_PV_Daily`=$rightpvdaily, `date_pv_matching`='$datepvmatching',`left_month_bp`='$leftmonthbp',`member_rank`='$memberrank',`Accumulation_BP_Month`='$accumulationbpmonth' WHERE m_id='$p_namesss'");

            if ($sponserid=="") {
               
            }
            else{
                if ($uplevelpv1>0) {
                     $this->senduptolevel($sponserid,$uplevelpv1,$uplevelbp1,$placement,$memberrank);
                }

              
          }









    }
     function senduptolevelpvbp($p_namesss,$uplevelpv1,$uplevelbp1,$placement1,$memberrank1)
    {


   global $link;


         $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$p_namesss'");

            $RowAllss = mysqli_fetch_array($ResultAllss);
            
              $leftpv=$RowAllss['left_PV'];
              $rightpv=$RowAllss['right_PV'];
               $leftpvdaily=$RowAllss['Left_PV_Daily'];
              $rightpvdaily=$RowAllss['Right_PV_Daily'];
            $dailymaxpvmatching=$RowAllss['Daily_Max_Pv_Matching'];
             $totalpvmatching=$RowAllss['Total_Pv_Matching'];
              $dailypvmatching=$RowAllss['Daily_pv_matching'];
               $monthpvmatching=$RowAllss['month_pv_matching'];
              $accumulationbp=$RowAllss['Accumulation_BP'];
               $leftbp=$RowAllss['Left_BP'];
              $rightbp=$RowAllss['Right_BP'];
               $leftbpforpoint=$RowAllss['Left_BP_For_Point'];
              $rightbpforpoint=$RowAllss['Right_BP_For_Point'];
               $totalpoint=$RowAllss['Total_Point'];
                $yearpoint=$RowAllss['Point_Year'];
               $sponserid=$RowAllss['sponsor_id'];
              $placement=$RowAllss['placement'];
               $status=$RowAllss['m_status'];
                $datepvmatching=$RowAllss['date_pv_matching'];
                $memberrank=$RowAllss['member_rank'];
                $leftmonthbp=$RowAllss['left_month_bp'];
                $rightmonthbp=$RowAllss['right_month_bp'];
                 $incomemonth=$RowAllss['income_month'];
                  $placement_id=$RowAllss['placement_id'];
                  $totalbp=$uplevelbp1;
            

                if ($placement1=="Left") {   

                      $leftpvdaily=$leftpvdaily+$uplevelpv1;
                     $leftpv=$leftpv+$uplevelpv1;
                     
                      $leftbpforpoint=$leftbpforpoint+$uplevelbp1;
                      
                }
                else{
                   
                   $rightpvdaily=$rightpvdaily+$uplevelpv1;
                   $rightpv=$rightpv+$uplevelpv1;
                
                   $rightbpforpoint=$rightbpforpoint+$uplevelbp1;
                    
                }

              

        if ($leftbpforpoint>=5000 && $rightbpforpoint>=5000) {


            
                 while ($leftbpforpoint>=5000 && $rightbpforpoint>=5000) {

                                                        $totalpoint= $totalpoint+1;
                                                         $yearpoint=$yearpoint+1;
                                                           $leftbpforpoint=$leftbpforpoint-5000;
                                                           $rightbpforpoint=$rightbpforpoint-5000;
                                                        
                }
        }

       
                if ($status=="Active") {
                    $today=date("Y-m-d");

                    if ($datepvmatching==$today) {
                        if ($dailypvmatching<$dailymaxpvmatching) {

                            if ($dailypvmatching==0) {

                                if ($leftpvdaily>=2) {

                                    if ($rightpvdaily>=2) {

                                        $dailypvmatching=1;
                                        $monthpvmatching=$monthpvmatching+1;
                                        $totalpvmatching=$totalpvmatching+1;
                                        $leftpvdaily=$leftpvdaily-2;
                                        $rightpvdaily=$rightpvdaily-2;

                                        if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                        }
                                                        else{
                                                            
                                                              $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                            
                                                        }

                                                        
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                             
                                                              $dailypvmatching= $dailypvmatching+1;
                                                             $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }
                                                         else{
                                                               $dailypvmatching= $dailypvmatching+1;
                                                            
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }

                                                       
                                                        
                                                    }



                                                }
                                            }
                                        }
                                    }
                                    
                                }
                               
                            }
                            else{

                                 if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                             $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                        }
                                                        else{
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                            
                                                        }

                                                       
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                              $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }else{
                                                             
                                                              $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                         }

                                                       
                                                        
                                                    }



                                                }
                                            }
                                        }

                            }
                            
                        }

                       
                    }
                    
                        else{
                             $datepvmatchings=$datepvmatching;
                             $datepvmatching=$today;
                              $leftpvdailys=$leftpvdaily;
                              $rightpvdailys=$rightpvdaily;
                              if($placement1=="Left"){
                                  $leftpvdailys=$leftpvdailys-$uplevelpv1;
                                  
                              }else{
                                  $rightpvdailys=$rightpvdailys-$uplevelpv1;
                                  
                              }
                              $dailypvmatchings=$dailypvmatching;
                              $query = "INSERT INTO `memberdailymatching` (`id`, `member_id`, `matching`, `date_match`, `Left_PV`,`Right_PV`) VALUES (NULL, '$p_namesss', '$dailypvmatchings', '$datepvmatchings', '$leftpvdailys','$rightpvdailys')";
                              $result = mysqli_query($link, $query);
                              $dailypvmatching=0;
                                  if ($placement1=="Left") {

                                     $leftpvdaily=$leftpvdaily+$uplevelpv1;
                                     $leftpv=$leftpv+$uplevelpv1;
                                    
                                }
                                else{
                                   
                                   $rightpvdaily=$rightpvdaily+$uplevelpv1;
                                   $rightpv=$rightpv+$uplevelpv1;
                                 
                                }

                                if ($leftpvdaily>=2) {

                                    if ($rightpvdaily>=2) {

                                        $dailypvmatching=1;
                                        $monthpvmatching=$monthpvmatching+1;
                                        $totalpvmatching=$totalpvmatching+1;
                                        $leftpvdaily=$leftpvdaily-2;
                                        $rightpvdaily=$rightpvdaily-2;

                                        if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                        }
                                                        else{
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                        }

                                                        
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                             $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }else{
                                                             
                                                             $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                             
                                                         }

                                                        
                                                        
                                                    }



                                                }
                                            }
                                        }
                                    }
                                    
                                }


                            
                        }
                }


               
 
           
             
              $results = mysqli_query($link, "UPDATE `members` SET `right_month_bp`='$rightmonthbp', `Accumulation_BP`='$accumulationbp', `income_month`='$incomemonth',`left_PV`='leftpv', `right_PV`='rightpv', `Left_BP`='$leftbp',`Right_BP`='$rightbp',`Left_BP_For_Point`=$leftbpforpoint,`Right_BP_For_Point`=$rightbpforpoint, `Total_Point`='$totalpoint', `Point_Year`='$yearpoint',`month_pv_matching`='$monthpvmatching', `Daily_pv_matching`='$dailypvmatching',`Left_PV_Daily`=$leftpvdaily,`Right_PV_Daily`=$rightpvdaily, `date_pv_matching`='$datepvmatching',`left_month_bp`='$leftmonthbp',`member_rank`='$memberrank' WHERE m_id='$p_namesss'");

            if ($placement_id=="") {
               
            }
            else{
                if ($uplevelpv1>0) {
                $this->senduptolevelpvbp($placement_id,$uplevelpv1,$uplevelbp1,$placement,$memberrank);
                }

              
          }









    }

    function add_saleproduct() {

        if (isset($_REQUEST['add_saleproduct'])) {        
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
              $membersessionidss = $_POST['membersessionidss'];
               $merchantvaluekey = $_POST['merchantvaluekey'];
            $p_namesss = $_POST['p_namesss'];
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         

          

            $query = "INSERT INTO `sale_product` (`sale_id`, `saletemp_id`, `Total_Amounts`, `Discount`, `Balance`,`member_id`, `RectimeStamp`, `Franchise_Id`) VALUES (NULL, '$purchasetempids', '$p_totalamount', '$p_deposit', '$p_balance','$p_namesss', '$rectimestamp', '$membersessionidss')";
            $result = mysqli_query($link, $query);
              $lastinsertid=mysqli_insert_id($link);

                 $query = "INSERT INTO `sale_payments` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`,`Merchant_Key`) VALUES (NULL, '$lastinsertid', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp', '$merchantvaluekey')";
            $result = mysqli_query($link, $query);
                  
            $genid='S'.$lastinsertid;
             $resultDL = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE purchase_id='$purchasetempids'");
        $rowcountDL = mysqli_num_rows($resultDL);
        if ($rowcountDL>0) {
           $i=1;
           while ($row = mysqli_fetch_array($resultDL)) {
           

                  $p_name=$row['product_id'];
                $p_quantity=$row['Quantity'];
            
           

             mysqli_query($link, "UPDATE `franchise_product` SET `Available`=Available-$p_quantity,`Sold`=Sold+$p_quantity WHERE Product_Code='$p_name' and member_id='$membersessionidss'");
             $i++;
             
           }
        }
            $ResultAll = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE purchase_id='$purchasetempids'");
            $rowcountall = mysqli_num_rows($ResultAll);
            if ($rowcountall>0) {
                $totalpv=0;
                $totalbp=0;
                while ($RowAll = mysqli_fetch_array($ResultAll)) {

                    $productid=$RowAll['product_id'];
                     $Quantity=$RowAll['Quantity'];

                      $ResultAlls = mysqli_query($link, "SELECT * FROM `franchise_product` WHERE Product_Code='$productid' and member_id='$membersessionidss'");

                      $RowAlls = mysqli_fetch_array($ResultAlls);
                      $pv=$RowAlls['PV'];
                      $bp=$RowAlls['BP'];
                      $Qbp=$Quantity*$bp;

                      $Qpv=$Quantity*$pv;
                      $totalpv=$totalpv+$Qpv;
                       $totalbp=$totalbp+$Qbp;




                }
            }


              mysqli_query($link, "UPDATE `sale_product` SET `pv`=pv+$totalpv,`bp`=bp+$totalbp WHERE saletemp_id='$purchasetempids'");
              $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$p_namesss'");

         $RowAllss = mysqli_fetch_array($ResultAllss);
         $m_name=$RowAllss['m_name'];
         $m_mobile=$RowAllss['m_mobile'];
            $status=$RowAllss['m_status'];
            $purchasepv=$RowAllss['PV_Purchase'];
            $purchasebp=$RowAllss['purchase_BP'];
            $purchasemonthbp=$RowAllss['month_BP'];
             $accumulationbp=$RowAllss['Accumulation_BP'];
              $accumulationbpmonth=$RowAllss['Accumulation_BP_Month'];
             $memberrank=$RowAllss['member_rank'];
              $memberranks=$RowAllss['member_rank'];
             $max_pv_matching=$RowAllss['Daily_Max_Pv_Matching'];
            $incomemonth=$RowAllss['income_month'];
             $sponserid=$RowAllss['sponsor_id'];
             $placementid=$RowAllss['placement_id'];
             $placement=$RowAllss['placement'];
             $sponsor_placement=$RowAllss['sponsor_placement'];
             
               $leftpvdaily=$RowAllss['Left_PV_Daily'];
              $rightpvdaily=$RowAllss['Right_PV_Daily'];
              $dailypvmatching=$RowAllss['Daily_pv_matching'];
             $datepvmatching=$RowAllss['date_pv_matching'];
             
            $accumulationbp=$accumulationbp+$totalbp;
            $accumulationbpmonth=$accumulationbpmonth+$totalbp;
              $purchasepv=$purchasepv+$totalpv;
              $purchasebp=$purchasebp+$totalbp;
            $purchasemonthbp= $purchasemonthbp+$totalbp;
            $messt=0;
            
            $today=date("Y-m-d");

                    if ($datepvmatching==$today) {
                        
                    }
                    else{
                        
                            $datepvmatchings=$datepvmatching;
                             $datepvmatching=$today;
                              $leftpvdailys=$leftpvdaily;
                              $rightpvdailys=$rightpvdaily;
                              $dailypvmatchings=$dailypvmatching;
                              $query = "INSERT INTO `memberdailymatching` (`id`, `member_id`, `matching`, `date_match`, `Left_PV`,`Right_PV`) VALUES (NULL, '$p_namesss', '$dailypvmatchings', '$datepvmatchings', '$leftpvdailys','$rightpvdailys')";
                              $result = mysqli_query($link, $query);
                              $dailypvmatching=0;
                        
                        
                    }
             if ($status=="Inactive") {
                if ($purchasepv>=1) {
                    $status="Active";
                    $messt=1;
                    $max_pv_matching=10;
                }
                
             }
             if ($memberrank!="Super-Director"&&$memberrank!="Silver-Director"&&$memberrank!="Gold-Director"&&$memberrank!="Diamond-Director"&&$memberrank!="Platinum-Director"&&$memberrank!="Crown-Director") 
        {
                
             if ($accumulationbp>=100000) {
                $memberrank="Director";
            }
            elseif($accumulationbp>=25000) {
                $memberrank="Chief-Manager";
            }
             elseif($accumulationbp>=10000) {
                $memberrank="Manager";
            }
             elseif($accumulationbp>=5000) {
                $memberrank="Sales-Executive";
            }

        }
        
        if($memberrank!=$memberranks){
            
             $message = urlencode('Rank Promotion Congratulations,Name:' . $m_name . ',User ID:'.$p_namesss.' , Rank :'.$memberrank . ' Web : http://vastamarketing.in/');
              $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . "";   
             //$url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
// create a new cURL resource
                  $ch = curl_init();
// set URL and other appropriate options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
                curl_exec($ch);
//
//// close cURL resource, and free up system resources
                curl_close($ch);
            
        }

         if ($memberrank=="") {
           $commission=0;
        }

        if ($memberrank=="Sales-Executive") {
           $commission=($totalbp*10)/100;
        }
         if ($memberrank=="Manager") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*45)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*50)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*55)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*60)/100;
        }

        $incomemonth=$incomemonth+$commission;



            $results = mysqli_query($link, "UPDATE `members` SET `m_status`='$status',`PV_Purchase`='$purchasepv',`purchase_BP`=$purchasebp,`month_BP`=$purchasemonthbp, `Accumulation_BP`='$accumulationbp', `Daily_Max_Pv_Matching`='$max_pv_matching',`income_month`='$incomemonth',`member_rank`='$memberrank', `Accumulation_BP_Month`='$accumulationbpmonth', `Daily_pv_matching`='$dailypvmatching', `date_pv_matching`='$datepvmatching' WHERE m_id='$p_namesss'");


             if ($sponserid=="") {
               
            }
            else{
                $uplevelpv=$totalpv;
                 $uplevelbp=$totalbp;
                
                   $this->senduptolevel($sponserid,$uplevelpv,$uplevelbp,$sponsor_placement,$memberrank);
           
          }
           if ($placementid=="") {
               
            }
            else{
                $uplevelpv=$totalpv;
                 $uplevelbp=$totalbp;
                
                   $this->senduptolevelpvbp($placementid,$uplevelpv,$uplevelbp,$placement,$memberrank);
           
          }
     
                    
            usleep(1 * 1000);
            if ($result) {
                
                if($messt==1)
                {

              $message = urlencode('Dear' . $m_name . ', Your Account successfully Activated.' . ' Web : http://vastamarketing.in/');
              $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . ""; 
             // $url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
// create a new cURL resource
                  $ch = curl_init();
// set URL and other appropriate options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
                curl_exec($ch);
//
//// close cURL resource, and free up system resources
                curl_close($ch);
                }

             
                
                
                echo '<script> alert("Sale Added Successfully"); </script>';
                echo '<script>window.location.href = "saleproduct.php";</script>';
                
            } else {
                echo '<script> alert("Sale not successfully inserted."); </script>';
            }

        }
    }

}
