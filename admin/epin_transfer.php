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
                                    <h4 class="page-title mb-0 font-size-18">E-Pin Transfer</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-Pins</a></li>
                                            <li class="breadcrumb-item active">E-Pin Transfer</li>-->
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


                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="from_id">From ID</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-id-badge"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="from_id" id="from_id" placeholder="" readonly="" value="<?php echo $_SESSION['admin_id']; ?>" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="to_id">To ID</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-id-badge"></i>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="to_id" id="to_id" onblur="checkID()" placeholder="" class="form-control">
                                                        </div>
                                                        <div id="to_id_error" class="text-danger"></div>
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
                                                        <div id="submitLoader"></div>
                                                        <input type="button" onclick="checkedEpins()" class="btn btn-round btn-primary" name="transfer_epin" value="SUBMIT" />
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
            document.getElementById('submitLoader').innerHTML = '<i class="fa fa-spinner fa-pulse fa-2x fa-fw" aria-hidden="true"></i>';
            var fromId = document.getElementById('from_id').value;
            var toId = document.getElementById('to_id').value;
            var checkboxes = document.getElementsByName('epins[]');
            //var vals = "";
            var getTimeClock = startTime();

            var ePin = "";
            Slected_Epin = new Array();
            var epin_i = 0;
            for (var i = 0, n = checkboxes.length; i < n; i++)
            {
                if (checkboxes[i].checked)
                {
                    Slected_Epin[epin_i] = checkboxes[i].value;
                    epin_i++;
                }
            }
            if (Slected_Epin.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "transfer_epin_tomem.php",
                    data: {from_id: fromId, to_id: toId, epin: Slected_Epin, get_time_clock: getTimeClock},
                    success: function (data) {
                        alert('E-Pin Transfer Successfully');
                        location.replace('epin_transfer.php');
                    }
                });
            } else {
                alert('Please Select E-Pin');
                document.getElementById('submitLoader').innerHTML = "";
                //document.getElementById('submitLoader').innerHTML="";
            }
            // alert('E-Pin Transfer Successfully');
            //window.location.href = "epin_transfer.php";

        }
        function checkID() {
            var toId = document.getElementById('to_id').value;
            $.ajax({
                type: "POST",
                url: "check_id.php",
                data: {id: toId},
                success: function (data) {
                   var n=data.length;
                                                          
                                                            if (n ==1) {
                        document.getElementById('to_id_error').innerHTML = data;
                    } else {
                        document.getElementById('to_id').value = "";
                        document.getElementById('to_id_error').innerHTML = data;
                    }
                }
            });
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