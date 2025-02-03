<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
    <?php
    include_once './header.php';
    include_once '../include/ram.php';
    require_once '../include/db.php';
    $ramObj = new ram;

    $id = $_REQUEST['id'];
    $query = "SELECT * FROM `wallet_request` WHERE id=$id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $number_of_epin = $row['numberof_epin'];
    $member_id = $row['member_id'];
    $member_name = $row['member_name'];
    $total_amount = $row['total_amount'];
    ?>

    <body data-layout="detached" data-topbar="colored">

        <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">

                <?php include_once './top_menu.php'; ?>
                <!-- ========== Left Sidebar Start ========== -->
                <?php include_once './left_menu.php'; ?>
                <!-- Left Sidebar End -->

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="page-title mb-0 font-size-18">Transfer E-Pin</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-Pins</a></li>
                                            <li class="breadcrumb-item active">Transfer E-Pin</li>-->
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <?php
                                        $freeEpin = 0;
                                        $noOfEpin = $number_of_epin;
                                        $h = floor($noOfEpin / 100);
                                        $freeEpin = $freeEpin + ($h * 12);
                                        $noOfEpin = $noOfEpin % 100;

                                        $f = floor($noOfEpin / 50);
                                        $freeEpin = $freeEpin + ($f * 5);
                                        $noOfEpin = $noOfEpin % 50;

                                        $tf = floor($noOfEpin / 25);
                                        $freeEpin = $freeEpin + ($tf * 2);
                                        $noOfEpin = $noOfEpin % 25;

                                        $t = floor($noOfEpin / 13);
                                        $freeEpin = $freeEpin + ($t * 1);

                                        $total_transfer_epin = $number_of_epin + $freeEpin;
                                        ?>
                                        <p>No. of Requested E-Pin :- <b><?php echo $number_of_epin; ?></b> <br>
                                            <?php if ($freeEpin > 0) { ?>
                                                No. of free E-Pin :- <b><?php echo $freeEpin; ?></b> <br>
                                                Total E-Pin :- <b><?php echo $total_transfer_epin; ?></b> <?php } ?></p>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="member_id">Member ID</label>
                                                        <input id="member_id" type="text" value="<?php echo $member_id; ?>" class="form-control" name="member_id" required readonly="">
                                                        <input type="hidden" name="request_id" id="request_id" value="<?php echo $id; ?>" />
                                                        <input type="hidden" id="freeEpin" value="<?php echo $freeEpin; ?>" />
                                                        <input type="hidden" id="total_transfer_epin" value="<?php echo $total_transfer_epin; ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="member_name">Member Name</label>
                                                        <input id="member_name" type="text" value="<?php echo $member_name; ?>" name="member_name" class="form-control" required readonly="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input id="amount" type="text" value="<?php echo number_format($total_amount, 2); ?>" class="form-control" name="amount" required readonly="">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="selectBox" onclick="showCheckboxes()">
                                                            <select class="form-control" >
                                                                <option>Select E-Pin</option>
                                                            </select>
                                                            <div class="overSelect"></div>
                                                        </div>
                                                        <div id="checkboxes">
                                                            <?php $ramObj->ShowValidEpinForTransfer(); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div id="errorSelectEpin" class="text-danger font-weight-600"></div>
                                                        <button type="button" onclick="checkedEpins()" name="chenge_password" class="btn btn-success btn-rounded waves-effect waves-light">
                                                            Transfer
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <div class="text-center"></div>



                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- End Page-content -->

                    <?php include_once './footer1.php'; ?>
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

        </div>
        <!-- end container-fluid -->



        <?php include_once './footer.php'; ?>

    </body>

    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }

        function checkedEpins() {
            var requestId = document.getElementById('request_id').value;
            var memberId = document.getElementById('member_id').value;
            var memberName = document.getElementById('member_name').value;
            //  var productName = document.getElementById('product_name').value;
            var freeEpin = document.getElementById('freeEpin').value;
            var checkboxes = document.getElementsByName('epins[]');
            //var vals = "";
            var getTimeClock = startTime();

            var ePin = "";
            var countChecked = 0;
            for (var i = 0, n = checkboxes.length; i < n; i++)
            {
                if (checkboxes[i].checked)
                {
                    countChecked++;
                }
            }
            var totalTransferEpin = document.getElementById('total_transfer_epin').value;
            var productQun;
//            $.ajax({
//                type: "POST",
//                url: "get_availableproduct.php",
//                data: {product_id: productName},
//                success: function (data) {
//                    var productQun = parseInt(data);
//                    //alert(productQun);
//                    if (productQun < totalTransferEpin) {
//                        alert("Only " + productQun + " products available, Please purchase more products first.");
//                    }
//                    else {
            if (countChecked < totalTransferEpin) {
                var rem = totalTransferEpin - countChecked;
                document.getElementById('errorSelectEpin').innerHTML = "You only checked " + countChecked + " E-pin, please check " + rem + " more E-pin";
            } else if (countChecked > totalTransferEpin) {
                var extra = countChecked - totalTransferEpin;
                document.getElementById('errorSelectEpin').innerHTML = "You checked " + extra + " extra PIN, please uncheck";
            } else {
                Slected_Epin = [];
                $epin_i = 0;
                for (var j = 0, n = checkboxes.length; j < n; j++)
                {
                    if (checkboxes[j].checked)
                    {
                        Slected_Epin[$epin_i] = checkboxes[j].value;
                        $epin_i++;
//                                    var ePin = checkboxes[j].value;
//                                    $.ajax({
//                                        type: "POST",
//                                        url: "add_transfer_epin.php",
//                                        data: {member_id: memberId, member_name: memberName, product_name: productName, epin: ePin, request_id: requestId, get_time_clock: getTimeClock},
//                                        success: function (data) {
//                                            //alert("success");
//                                        }
//                                    });
                    }
                }
                $.ajax({
                    type: "POST",
                    url: "add_transfer_epin.php",
                    data: {member_id: memberId, freeEpin: freeEpin, member_name: memberName, epin: Slected_Epin, request_id: requestId, get_time_clock: getTimeClock},
                    success: function (data) {
                        alert('E-Pin Transfer Successfully');
                        window.location.href = "epin_request.php";
                    }
                });

                //if (vals)
                //vals = vals.substring(1);
                //alert(vals);
            }
//                    }

//                }
//            });


        }
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            var getTimeClock =
                    h + ":" + m + ":" + s;
            return getTimeClock;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            ;  // add zero in front of numbers < 10
            return i;
        }
    </script>
    <style>
        .selectBox {
            position: relative;
        }

        .selectBox select {
            width: 100%;
            font-weight: bold;
        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        #checkboxes {
            display: none;
            border: 1px #dadada solid;
        }

        #checkboxes label {
            display: block;
            padding-left: 5px;
            color: #000;
        }

        #checkboxes label:hover {
            background-color: #007bff;
            color: #FFF;
        }
    </style>
</html>