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
                                    <h4 class="page-title mb-0 font-size-18">Edit Profile</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Edit Profile</li>-->
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

                                        <h4 class="card-title"><?php $i = "status";
                $ramObj->memberRecords($i); ?></h4>
                                        <p class="card-title-desc"></p>
<?php $ramObj->updateMemberRecord(); ?>
                                        <form action="" method="post" enctype='multipart/form-data'>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="m_id" class="col-sm-3 col-form-label">Member Id</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="m_id" value="<?php echo $_SESSION['admin_id']; ?>" readonly="" id="m_id" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_name" class="col-sm-3 col-form-label">Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="m_name" value="<?php $i = "name";
$ramObj->memberRecords($i); ?>" id="m_name" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_mobile" class="col-sm-3 col-form-label">Mobile</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="m_mobile" value="<?php $i = "mobile";
$ramObj->memberRecords($i); ?>" id="m_name" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_email" class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" name="m_email" value="<?php $i = "email";
$ramObj->memberRecords($i); ?>" id="m_email" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_dob" class="col-sm-3 col-form-label">DOB</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" name="m_dob" value="<?php $i = "dob";
$ramObj->memberRecords($i); ?>" id="m_dob" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_pan" class="col-sm-3 col-form-label">Pan Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="m_pan" onblur="ValidatePAN()" value="<?php $i = "pan";
$ramObj->memberRecords($i); ?>" id="m_pan" class="form-control">
                                                            <div class="text-danger" id="panerror"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="m_photo" class="col-sm-3 col-form-label">Photo</label>
                                                        <div class="col-sm-9">
                                                            <input type="file" name="m_photo" value="" id="m_photo" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="member_state" class="col-sm-3 col-form-label">State</label>
                                                        <div class="col-sm-9">
                                                            <select id="member_state" class="form-control" onchange="showCities()" required="" name="member_state">
                                                                <option value="<?php $i = "state_id";
$ramObj->memberRecords($i); ?>"><?php $i = "state";
$ramObj->memberRecords($i); ?></option>
                                                                <option value="" disabled="">Select your state</option>
<?php $ramObj->showStatesList(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="member_city" class="col-sm-3 col-form-label">City</label>
                                                        <div class="col-sm-9">
                                                            <select id="member_city" class="form-control" required="" name="member_city">
                                                                <option value="<?php $i = "city_id";
$ramObj->memberRecords($i); ?>"><?php $i = "city";
$ramObj->memberRecords($i); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="member_pincode" class="col-sm-3 col-form-label">Pincode</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="member_pincode" value="<?php $i = "pincode";
$ramObj->memberRecords($i); ?>" id="member_pincode" required="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="member_address" class="col-sm-3 col-form-label">Address</label>
                                                        <div class="col-sm-9">
                                                            <textarea id="member_address" placeholder="Address*" required="" class="form-control" name="member_address" style="min-height: 110px;"><?php $i = "address";
$ramObj->memberRecords($i); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 text-center">
                                                            <img src="assets/images/users/<?php $i = "photo";
$ramObj->memberRecords($i); ?>" height="100" alt="Member Photo"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="update_member" class="btn btn-success btn-rounded waves-effect waves-light">Update</button>
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
    <script>
        function showCities() {
            var state_id = document.getElementById('member_state').value;
            $.ajax({
                type: "POST",
                url: "get_city.php",
                data: 'state_id=' + state_id,
                success: function (data) {
                    document.getElementById('member_city').innerHTML = data;
                }
            });
        }

        function ValidatePAN() {
            var panVal = document.getElementById('m_pan').value;
            var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

            if (regpan.test(panVal)) {
                // valid pan card number
                document.getElementById('panerror').innerHTML = "";
            } else {
                // invalid pan card number
                document.getElementById('m_pan').value = "";
                document.getElementById('panerror').innerHTML = "Invalid Pan Number ( <b class='text-dark'>" + panVal + "</b> )";
            }
        }
    </script>
</html>