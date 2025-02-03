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
    include_once '../include/ram2.php';
    require_once '../include/db.php';
    $ramObj = new ram;
    $ramObj2 = new ram2;
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
                                    <h4 class="page-title mb-0 font-size-18">Activate Member</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>
                                            <li class="breadcrumb-item active">Activate Member</li>-->
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

                                        <?php $ramObj2->activateYourSelf(); ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                            <label>ID</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fas fa-id-badge"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="page_name" value="activate_member" />
                                                                <input type="hidden" name="submitbuttonforthispage" value="add_epin" />
                                                                <input type="text" name="member_id" id="member_id" onblur="checkMemberId()" required="" class="form-control" >
                                                            </div>
                                                            <div id="errorOfMemberId" class="text-danger"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>E-Pin</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fas fa-key"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" name="m_epin" id="m_epin" value="<?php if(isset($_REQUEST['epinid'])){
                                                                    echo $_REQUEST['epinid'];
                                                                } ?>" onblur="checkEpin()" placeholder="" required="" class="form-control">
                                                            </div>
                                                            <div><p id="errorOfEpin" style="color: red;"></p></div>
                                                        </div>

                                                    <div class="form-group">
                                                        <button type="button" onclick="validateF1()" class="btn btn-light btn-rounded waves-effect waves-light pl-4 pr-4">Validate</button>
                                                            <input type="submit" id="submit" class="btn btn-success btn-rounded waves-effect waves-light pl-4 pr-4" name="add_epin" value="SUBMIT" />
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

        document.getElementById("m_epin").focus();

        var valid = 0,validId = 0;

        $('form').submit(function (e) {
            var epin = document.getElementById('m_epin').value;
            var memberId = document.getElementById('member_id').value;
            if (epin != "" && memberId != "") {
                if (parseInt(valid) == 1 && parseInt(validId) == 1)
                {

                } else {
                    alert("Validate first");
                    e.preventDefault();
                }
            }
        });

        function validateF1() {
            valid = 1;
        }

        function checkEpin() {
            var val = document.getElementById('m_epin').value;
            $.ajax({
                type: "POST",
                url: "check_epin.php",
                data: 'epin=' + val,
                success: function (data) {
                var n=data.length;
                                                          
                                                            if (n ==1) {
                        valid = 1;
                        document.getElementById('errorOfEpin').innerHTML = data;
                    } else {
                        valid = 0;
                        document.getElementById('m_epin').value = "";
                        document.getElementById('errorOfEpin').innerHTML = data;
                    }
                }
            });
        }

        function checkMemberId() {
            var val = document.getElementById('member_id').value;
            $.ajax({
                type: "POST",
                url: "check_memberid.php",
                data: 'id=' + val,
                success: function (data) {
                   var n=data.length;
                                                          
                                                            if (n ==1) {
                        validId = 1;
                        document.getElementById('errorOfMemberId').innerHTML = data;
                        document.getElementById('m_epin').blur();
                    } else {
                        validId = 0;
                        document.getElementById('member_id').value = "";
                        document.getElementById('errorOfMemberId').innerHTML = data;
                    }
                }
            });
        }

    </script>
</html>