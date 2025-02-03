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
    $ramObj->singleleg_income();
    $ramObj->send_singleleg_income();
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
                                    <h4 class="page-title mb-0 font-size-18">Supplier</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Home</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <!--main content start-->
                        <section class="main-content-wrapper">
                            <section id="main-content" class="animated fadeInUp">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-title-desc"></p>
                                                <?php $ramObj->Supplier(); ?>
                                                <?php $ramObj->updatesupplierMember(); ?>
                                                <?php
                                                if (isset($_POST['edit'])) {
                                                    $id = $_POST['edit'];
                                                    $sql3 = "SELECT * FROM `supplier` WHERE `id` = '$id'";
                                                    $result3 = mysqli_query($link, $sql3);
                                                    $row = mysqli_fetch_array($result3);
                                                    $FRM = $row['FRM'];
                                                    $Owner = $row['owner'];
                                                    $gstin_no = $row['gstin_no'];
                                                    $Address = $row['address'];
                                                    $contact = $row['contact'];
                                                    $email = $row['email'];
                                                    $bank_name = $row['bank_name'];
                                                    $branch_name = $row['branch_name'];
                                                     $state = $row['state'];
                                                    $city = $row['city'];
                                                    $pincode = $row['pincode'];
                                                    $edit_id = $row['id'];
                                                }
                                                ?>
                                                <form action="" method="post" enctype='multipart/form-data'>
                                                    <div class="row">
                                                    <div class="col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="FRM" class="col-sm-3 col-form-label">Firm Name</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="FRM" value="<?php
                                                                    if (isset($FRM)) {
                                                                        echo $FRM;
                                                                    }
                                                                    ?>" id="FRM" required="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="owner" class="col-sm-3 col-form-label">Owner</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="owner" value="<?php
                                                                    if (isset($Owner)) {
                                                                        echo $Owner;
                                                                    }
                                                                    ?>" id="owner" required="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="gstin_no" class="col-sm-3 col-form-label">GSTIN No.</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="gstin_no" value="<?php
                                                                    if (isset($gstin_no)) {
                                                                        echo $gstin_no;
                                                                    }
                                                                    ?>" id="gstin_no" required="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="address" class="col-sm-3 col-form-label">Address</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="address" value="<?php
                                                                    if (isset($Address)) {
                                                                        echo $Address;
                                                                    }
                                                                    ?>" id="address" required="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="contact" class="col-sm-3 col-form-label">Contact No.</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="contact" value="<?php
                                                                    if (isset($contact)) {
                                                                        echo $contact;
                                                                    }
                                                                    ?>" id="contact" required="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="email" value="<?php
                                                                    if (isset($email)) {
                                                                        echo $email;
                                                                    }
                                                                    ?>" id="email" required="" class="form-control">
                                                                    <div class="text-danger" id="panerror"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <?php if (isset($_POST['edit'])) { ?>
                                                            <button type="submit" name="update" value="<?php echo $edit_id; ?>" class="btn btn-primary">Update</button>
                                                        <?php } else { ?>
                                                            <button type="submit" name="submit_supplier"class="btn btn-primary">Submit</button>
                                                        <?php } ?>
                                                        <div class="col-md-3"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <br><br>
                                <div class="wrappersc">
                                    <div class="containerscroll">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sr. no.</th>
                                                                     <th>Code</th>
                                                                    <th>Firm Name</th>
                                                                    <th>Owner</th>
                                                                    <th>GSTIN No.</th>
                                                                    <th>Address</th>
                                                                    <th>Contact No.</th>
                                                                    <th>Email Address</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                            </thead>

                                                            <?php $ramObj->deletesupplierMember(); ?>
                                                            <tbody>
                                                                <?php $ramObj->SupplierList(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                    </div>
                                </div> 


                                <!--******************************END MAIN CONTENTS********************************-->
                                <!--******************************END MAIN CONTENTS********************************-->
                            </section>
                        </section>

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

        var atRandomMemberId = Math.floor(100000 + Math.random() * 909999);
        document.getElementById('atrandam_member_id').value = atRandomMemberId;

        function getSponsor() {
            var sponsor_id = document.getElementById('sponsor_id').value;
            $.ajax({
                type: "POST",
                url: "get_sponsor.php",
                data: 'sponsor_id=' + sponsor_id,
                success: function (data) {
                    if (data == "Invalid Sponsor Id.") {
                        document.getElementById('sponsor_name').value = "";
                        document.getElementById('sponsor_nameInvalid').innerHTML = data;
                    } else {
                        document.getElementById('sponsor_name').value = data;
                        document.getElementById('sponsor_nameInvalid').innerHTML = "";
                    }

                }
            });
        }

        function showCities() {
            var state_id = document.getElementById('state').value;
            $.ajax({
                type: "POST",
                url: "get_city.php",
                data: 'state_id=' + state_id,
                success: function (data) {
                    document.getElementById('city').innerHTML = data;
                }
            });
        }

        function showCities2() {
            var state_id = document.getElementById('um_member_state').value;
            $.ajax({
                type: "POST",
                url: "get_city.php",
                data: 'state_id=' + state_id,
                success: function (data) {
                    document.getElementById('um_member_city').innerHTML = data;
                }
            });
        }

        function checkEmail() {
            var val = document.getElementById('m_email').value;
            $.ajax({
                type: "POST",
                url: "email_validornot.php",
                data: 'email=' + val,
                success: function (data) {
                    if (data == "") {
                        document.getElementById('errorCheckEmail').innerHTML = data;
                    } else {
                        document.getElementById('m_email').value = "";
                        document.getElementById('errorCheckEmail').innerHTML = data;
                    }
                }
            });
        }

        function checkMobile() {
            var val = document.getElementById('m_mobile').value;
            $.ajax({
                type: "POST",
                url: "mobile_existornot.php",
                data: 'mobile=' + val,
                success: function (data) {
                    if (data == "") {
                        document.getElementById('errorCheckMobile').innerHTML = data;
                    } else {
                        document.getElementById('m_mobile').value = "";
                        document.getElementById('errorCheckMobile').innerHTML = data;
                    }
                }
            });
        }

        function checkMemId() {
            var pId = document.getElementById('placement_id').value;
            $.ajax({
                type: "POST",
                url: "check_id.php",
                data: 'id=' + pId,
                success: function (data) {
                    if (data == "") {
                        document.getElementById('errorOfPlacementId').innerHTML = data;
                        var placeMent = document.getElementById('placement').value;
                        var sponsorID = document.getElementById('sponsor_id').value;
                        if (placeMent != "") {
                            $.ajax({
                                type: "POST",
                                url: "check_Placement.php",
                                data: {placement_id: pId, placement: placeMent, sponsor_id: sponsorID},
                                success: function (data) {
                                    if (data == "") {
                                        document.getElementById('errorOfPlacement').innerHTML = data;
                                    } else {
                                        document.getElementById('placement').value = "";
                                        document.getElementById('errorOfPlacement').innerHTML = data;
                                    }
                                }
                            });
                        }

                    } else {
                        document.getElementById('placement_id').value = "";
                        document.getElementById('errorOfPlacementId').innerHTML = data;
                    }
                }
            });
        }

        function checkPlacement() {
            var val = document.getElementById('placement').value;
            var pId = document.getElementById('placement_id').value;
            var sponsorID = document.getElementById('sponsor_id').value;
            if (pId == "") {
                document.getElementById('errorOfPlacementId').innerHTML = "Enter Placement ID";
            } else {
                $.ajax({
                    type: "POST",
                    url: "check_Placement.php",
                    data: {placement_id: pId, placement: val, sponsor_id: sponsorID},
                    success: function (data) {
                        if (data == "") {
                            document.getElementById('errorOfPlacement').innerHTML = data;
                        } else {
                            document.getElementById('placement').value = "";
                            document.getElementById('errorOfPlacement').innerHTML = data;
                        }
                    }
                });
            }
        }


    </script>
</html>