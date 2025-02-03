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
                                    <h4 class="page-title mb-0 font-size-18">Generate E-Pin</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-Pins</a></li>
                                            <li class="breadcrumb-item active">Generate E-Pin</li>-->
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

                                        <?php //$ramObj->chengePassword(); ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="epin">E-Pins</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    <i class="fas fa-id-card"></i>
                                                                </div>
                                                            </div>
                                                            <input id="epin" type="number" class="form-control" name="epin" placeholder="No of Epin" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" onclick="generateEpin()" name="addEpin" class="btn btn-success btn-rounded waves-effect waves-light pl-4 pr-4">
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <div class="text-center"></div>



                                        </form>





                                        <h4 class="card-title">E-Pins Details</h4>
                                        <p class="card-title-desc">Description</p>
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. no.</th>
                                                    <th>E-Pin</th>
                                                    <th>Date of Generation</th>
                                                    <th>Status</th>
                                                    <th>Custom Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $ramObj->deleteEpin(); 
                                                $ramObj->showEpinList(); ?>
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
        
        

        function generateEpin() {
            var val = document.getElementById('epin').value;
            $.ajax({
                type: "POST",
                url: "add_epin.php",
                data: 'epin=' + val,
                success: function (data) {
                    window.location.reload(true);
                }
            });

        }
        

    </script>
</html>