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

                    <?php
                    if (isset($_REQUEST['update_mem'])) {
                        $um_id = $_REQUEST['update_mem'];
                        $result_um = mysqli_query($link, "SELECT * FROM members WHERE m_id='" . $um_id . "'");
                        $row_um = mysqli_fetch_array($result_um);
                        ?>
                        <div class="page-content">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="page-title mb-0 font-size-18">Member Update Details</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
<!--                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>
                                                <li class="breadcrumb-item active">Update Details</li>-->
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
                                        <?php $ramObj->update_mem(); ?>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- <div class="form-group">
                                                            <label>Member Id</label>
                                                            <input type="text" value="<?php echo $um_id; ?>" name="um_id" readonly required="" class="form-control">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Member Name</label>
                                                            <input type="text" name="um_name" value="<?php echo $row_um['m_name']; ?>" required="" class="form-control" placeholder="Name*">
                                                            <input type="hidden" name="um_id" value="<?php echo $row_um['m_id']; ?>" /> <!-- Hidden field to store member ID -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mobile</label>
                                                            <input type="text" name="um_mobile" value="<?php echo $row_um['m_mobile']; ?>" id="um_mobile" required="" class="form-control" placeholder="Mobile No.*">
                                                            <div id="errorCheckMobile" class="text-danger"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="um_email" value="<?php echo $row_um['m_email']; ?>" id="um_email" class="form-control" placeholder="Email Address*">
                                                            <div id="errorCheckEmail" class="text-danger"></div>
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label>Sponsor Id</label>
                                                            <input type="text" style="pointer-events: none;" onkeydown="return false" name="um_sponsor_id" value="<?php echo $row_um['sponsor_id']; ?>" id="um_sponsor_id" placeholder="Sponsor ID*" required="" class="form-control">
                                                            <div><p id="sponsor_nameInvalid" style="color: red;"></p></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sponsor Name</label>
                                                            <input value="<?php echo $row_um['sponsor_name']; ?>" style="pointer-events: none;" onkeydown="return false" type="text" name="um_sponsor_name" id="um_sponsor_name" required="" class="form-control" placeholder="Sponsor Name*" >
                                                        </div>
                                                          <div class="form-group">
                                                            <label>Placement</label>
                                                            <input value="<?php echo $row_um['placement']; ?>" style="pointer-events: none;" onkeydown="return false" type="text" name="placement" id="placementsss" required="" class="form-control" placeholder="Placement" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="text" name="um_password" value="<?php echo $row_um['m_password']; ?>" id="um_password" placeholder="Password" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <select id="um_member_state" class="form-control" onchange="showCities2()" name="um_member_state">
                                                                <?php
                                                                $um_stateid = $row_um['m_state_id'];
                                                                $result_umstate = mysqli_query($link, "SELECT name FROM `states` WHERE id='" . $um_stateid . "'");
                                                                $row_umstate = mysqli_fetch_array($result_umstate);
                                                                $um_statename = $row_umstate['name'];
                                                                ?>
                                                                <option selected="" value="<?php echo $um_stateid; ?>"><?php echo $um_statename; ?></option>
    <?php $ramObj->showStatesList(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <select id="um_member_city" class="form-control" name="um_member_city">
                                                                <?php
                                                                $um_cityid = $row_um['m_city_id'];
                                                                $result_umcity = mysqli_query($link, "SELECT name FROM `cities` WHERE id='" . $um_cityid . "'");
                                                                $row_umcity = mysqli_fetch_array($result_umcity);
                                                                $um_cityname = $row_umcity['name'];
                                                                ?>
                                                                <option selected="" value="<?php echo $um_cityid; ?>"><?php echo $um_cityname; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pincode</label>
                                                            <input id="um_member_pincode" value="<?php echo $row_um['m_pincode']; ?>" type="text" placeholder="Pincode" class="form-control" name="um_member_pincode" >
                                                        </div>-->
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea id="um_member_address" placeholder="Address" class="form-control" name="um_member_address" style="min-height: 110px;"><?php echo $row_um['m_address']; ?></textarea>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="form-group">
                                                                <button type="submit" name="um_member" class="btn btn-primary btn-block waves-effect waves-light">
                                                                    Update
                                                                </button>
                                                            </div>
                                                </div>



                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div>

<?php } else { ?>

                        <div class="page-content">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="page-title mb-0 font-size-18">Member Registration</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>
                                                <li class="breadcrumb-item active">Registration</li>
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

    <?php $ramObj->add_customer(); ?>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="m_name">Full Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="m_name" required="" id="m_name" class="form-control" id="useremail" placeholder="Enter Your Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="m_email">Email</label>
                                                            <input type="email" name="m_email" id="m_email" class="form-control" id="useremail" placeholder="Enter email">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="m_mobile">Mobile Number<span class="text-danger">*</span></label>
                                                            <input type="text" name="m_mobile" required="" id="m_mobile" class="form-control" id="username" placeholder="Enter Mobile Number">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea id="m_address" placeholder="Address" class="form-control" name="m_address" style="min-height: 110px;"></textarea>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary btn-block waves-effect waves-light" name="add_customer" type="submit">Register</button>
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
<?php } ?>

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
    </script>

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
                    if (data.trim() == "") {
                        document.getElementById('errorOfPlacementId').innerHTML = data;
                        var placeMent = document.getElementById('placement').value;
                        var sponsorID = document.getElementById('sponsor_id').value;
                        if (placeMent != "") {
                            $.ajax({
                                type: "POST",
                                url: "check_Placement.php",
                                data: {placement: placeMent, sponsor_id: pId},
                                success: function (data) {
                                    if (data.trim() == "") {
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
                                                           
                                                            var sponsorID = document.getElementById('placement_id').value;
                                                            if (sponsorID == "") {
                                                                document.getElementById('sponsor_nameInvalid').innerHTML = "Enter Placement Id ";
                                                            }
                                                            else {
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "check_Placement.php",
                                                                    data: { placement: val, sponsor_id: sponsorID},
                                                                    success: function (data) {
                                                                        if (data.trim() == "") {
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