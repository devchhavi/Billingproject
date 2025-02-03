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
                                    <h4 class="page-title mb-0 font-size-18">Add E-Pin Request</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-Pins</a></li>
                                            <li class="breadcrumb-item active">E-Pin Request</li>-->
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
                                        
                                        <?php $ramObj->add_wallet(); ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="amount" class="col-sm-3 col-form-label">Amount / Pin</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="amount" id="amount" placeholder="" readonly="" value="499" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="numberof_epin" class="col-sm-3 col-form-label">Number of E-Pin</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" name="numberof_epin" id="numberof_epin" onkeyup="calTotalAmount()" onblur="calTotalAmount()" placeholder="" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="total_amount" class="col-sm-3 col-form-label">Total Amount</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="total_amount" id="total_amount" readonly="" placeholder="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="payment_mode" class="col-sm-3 col-form-label">Payment Mode</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-control" name="payment_mode" id="payment_mode">
                                                                <option value="Online">Online</option>
                                                                <option value="Cash">Cash</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="transaction_id" class="col-sm-3 col-form-label">Transaction Id</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="transaction_id" id="transaction_id" required="" placeholder="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="transaction_date" class="col-sm-3 col-form-label">Transaction Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="transaction_date" id="transaction_date" readonly="" placeholder="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="transaction_time" class="col-sm-3 col-form-label">Transaction Time</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="transaction_time" id="transaction_time" readonly="" placeholder="" class="form-control phone-number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="add_wallet" class="btn btn-success btn-rounded waves-effect waves-light pl-4 pr-4">Submit</button>
                                            </div>



                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">E-Pin Request List</h4>
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. no.</th>
                                                    <th>Member ID</th>
                                                    <th>Member Name</th>
                                                    <th>No Of Epin</th>
                                                    <th>Amount</th>
                                                    <th>Pay Mode</th>
                                                    <th>Trans ID</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $ramObj->showWalletRequestList(); ?>
                                            </tbody>
                                        </table>
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

        startTime();

        function calTotalAmount() {
            var pins = document.getElementById('numberof_epin').value;
            var amount = document.getElementById('amount').value;
            var totalAmount = (pins * amount);
            document.getElementById('total_amount').value = totalAmount;
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('transaction_time').value =
                    h + ":" + m + ":" + s;

            var day = today.getDate();
            var month = today.getMonth();
            month = month + 1;
            var year = today.getFullYear();
            day = checkTime(day);
            month = checkTime(month);
            document.getElementById('transaction_date').value =
                    day + "/" + month + "/" + year;

            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }
            ;  // add zero in front of numbers < 10
            return i;
        }

        function Reject_epin(id) {
//            alert(id);
            var doc = prompt("Please enter Reasion",
                    "");
//            alert(doc);
            if (doc == "") {
                alert('Please enter reasion');
            } else {
                if (doc != null) {
//                    alert('Successe');
                    $.ajax({
                        type: "POST",
                        url: "reject_w_request.php",
                        data: {doc: doc, id: id},
                        success: function (data) {
                            alert('E-Pin Rejected Successfully');
                        }
                    });
                }
            }
        }

    </script>
</html>