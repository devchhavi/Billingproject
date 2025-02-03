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
                                    <h4 class="page-title mb-0 font-size-18">Change Password</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Password</li>-->
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
                                        <?php $ramObj->chengePassword(); ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="old_pass">Old Password</label>
                                                        <input id="old_pass" type="text" readonly="" value="<?php $i = "pass";
                                                        $ramObj->memberRecords($i); ?>" class="form-control" name="old_pass" tabindex="1" required >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                                               name="password" tabindex="2" required>
                                                        <div id="pwindicator" class="pwindicator">
                                                            <div class="bar"></div>
                                                            <div class="label"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirm_password">Confirm Password</label>
                                                        <div id="confpass_error" class="text-danger"></div>
                                                        <input id="confirm_password" onblur="checkPassword()" type="password" class="form-control" name="confirm_password"
                                                               tabindex="2" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="chenge_password" class="btn btn-success btn-rounded waves-effect waves-light">
                                                            Change
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
        function checkPassword() {
            var password = document.getElementById('password').value;
            var confirm_password = document.getElementById('confirm_password').value;
            if(password!=confirm_password){
                document.getElementById('confirm_password').value="";
                document.getElementById('confpass_error').innerHTML="Password does not match the Confirm Password!";
            }
            else{
                document.getElementById('confpass_error').innerHTML="";
            }
        }
    </script>

</html>