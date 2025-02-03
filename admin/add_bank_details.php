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
                                    <h4 class="page-title mb-0 font-size-18">Add/Update Bank Details</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Bank Details</li>-->
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

                                        <h4 class="card-title"></h4>
                                        <p class="card-title-desc"></p>
<?php $ramObj->updateBankDetails(); ?>
                                            <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                                                        <div class="col-sm-9">
                                                            <select id="bank_name" class="form-control" required="" name="bank_name">
                                                                <?php
                                                                $i = "bank_name";
                                                                $bank_id = $ramObj->memberBankRecords($i);
                                                                if ($bank_id == "") {
                                                                    ?>
                                                                    <option value="" disabled="" selected="">Select your Bank</option>
                                                                    <?php
                                                                    $ramObj->showBankList();
                                                                } else {

                                                                    $banknameResult = mysqli_query($link, "SELECT * FROM `banklist` WHERE id=$bank_id");
                                                                    $banknameRow = mysqli_fetch_array($banknameResult);
                                                                    $bank_name = $banknameRow['bank'];
                                                                    ?>
                                                                    <option value="<?php echo $bank_id; ?>" selected=""><?php echo $bank_name; ?></option>
    <?php $ramObj->showBankList();
}
?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="bank_branch" class="col-sm-3 col-form-label">Branch</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="bank_branch" value="<?php $i = "branch";
$ramObj->memberBankRecords($i); ?>" id="bank_branch" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ifsc_code" class="col-sm-3 col-form-label">IFSC Code</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="ifsc_code" value="<?php $i = "ifsc_code";
$ramObj->memberBankRecords($i); ?>" id="ifsc_code" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="account_holder" class="col-sm-3 col-form-label">A/c Holder</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="account_holder" value="<?php $i = "holder_name";
$ramObj->memberBankRecords($i); ?>" id="account_holder" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="account_no" class="col-sm-3 col-form-label">A/c No.</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="account_no" value="<?php $i = "account_no";
$ramObj->memberBankRecords($i); ?>" id="account_no" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="account_type" class="col-sm-3 col-form-label">A/c Type</label>
                                                        <div class="col-sm-9">
                                                            <select id="account_type" class="form-control" required="" name="account_type">
                                                                <?php $i = "account_type";
                                                                $acc_type = $ramObj->memberBankRecords($i);
                                                                if ($acc_type == "Current") {
                                                                    ?>
                                                                    <option value="Saving">Saving</option>
                                                                    <option value="Current" selected="">Current</option>
<?php } else {
    ?>
                                                                    <option value="Saving" selected="">Saving</option>
                                                                    <option value="Current">Current</option>
                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
<?php if ($bank_id == "") { ?>
                                                    <input type="hidden" value="<?php $i = "name"; $acc_type = $ramObj->memberRecords($i); ?>" name="member_name" />
                                                    <button type="submit" name="add_bank" class="btn btn-success btn-rounded waves-effect waves-light">
                                                        Add
                                                    </button>
<?php } else { ?>
                                                    <button type="submit" name="update_bank" class="btn btn-success btn-rounded waves-effect waves-light">
                                                        Update
                                                    </button>
<?php } ?>
                                            </div>



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

</html>