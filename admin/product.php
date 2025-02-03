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
                                                        <div class="form-group">
                                                            <label>Member Id</label>
                                                            <input type="text" value="<?php echo $um_id; ?>" name="um_id" readonly required="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Member Name</label>
                                                            <input type="text" name="um_name" value="<?php echo $row_um['m_name']; ?>" required="" class="form-control" placeholder="Name*">
                                                            <input type="hidden" name="um_page_name" value="member_registration.php" />
                                                            <!--<input type="hidden" name="atrandam_member_id" id="atrandam_member_id" value="" />-->
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
                                                        <div class="form-group">
                                                            <label>Sponsor Id</label>
                                                            <input type="text" style="pointer-events: none;" onkeydown="return false" name="um_sponsor_id" value="<?php echo $row_um['sponsor_id']; ?>" id="um_sponsor_id" placeholder="Sponsor ID*" required="" class="form-control">
                                                            <div><p id="sponsor_nameInvalid" style="color: red;"></p></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sponsor Name</label>
                                                            <input value="<?php echo $row_um['sponsor_name']; ?>" style="pointer-events: none;" onkeydown="return false" type="text" name="um_sponsor_name" id="um_sponsor_name" required="" class="form-control" placeholder="Sponsor Name*" >
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
                                                        </div>
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
                                        <h4 class="page-title mb-0 font-size-18">Product</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                                <li class="breadcrumb-item active">Product</li>
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

    <?php $ramObj->add_product(); ?>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="m_name">Product Name </label>
                                                            <input type="text" name="p_name" required="" id="p_name" class="form-control" id="useremail" onblur="checkproduct();" placeholder="Product Name">
                                                           
                                                        </div>
                                                          <div> <span id="errorOfEmail"></span></div>

                                                        <div class="form-group">
                                                            <label for="m_email">Category</label>
                                                            <select id="member_state" class="form-control"  required="" name="category">
                                                                <option value="">Select Category</option>
                                                                <?php 
                                                                $sql="SELECT id,Name FROM product_category where status ='1'";
                                                                    $resultt = $link->query($sql);
                                                                while ($roww = mysqli_fetch_assoc($resultt)) {
                                                                        
                                                                        echo '<option type="checkbox" value='.$roww['id'].'>'.$roww['Name'].'</option>';
                                                                        }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="m_email">Unit/Size</label>
                                                            <select id="member_state" class="form-control"  required="" name="unit">
                                                             
                                                            <option value="">Select Unit</option>
                                                            <?php $ramObj->unitlist(); ?>
                                                            </select>
                                                        </div>


                                                        <div class="mt-4">
                                                            <button class="btn btn-primary btn-block waves-effect waves-light" name="add_product" type="submit">Add</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                </div>
                                                <div class="text-center"></div>

                                            </form>



                                      
                                        <h4 class="card-title">Product List</h4>

                                              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Code</th>
                                                      <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>Unit/Size</th>
                                                    <!-- <th>Pv</th>
                                                    <th>BP</th> -->
                                                  
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $ramObj->deleteProducts(); 
                                                   $ramObj->editProduct(); 
                                                $ramObj->ProductList(); ?>
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
     
        function checkproduct() {
              
            var val = document.getElementById('p_name').value;
    
            $.ajax({
                type: "POST",
                url: "checkproduct.php",
                data: 'p_name=' + val,
                success: function (data) {
                 

                                                            if (data.trim()=="") {
                                                                document.getElementById('errorOfEmail').innerHTML = data;

                                                            } else {
                                                                document.getElementById('p_name').value = "";
                                                                document.getElementById('errorOfEmail').innerHTML = data;
                }
            }
            });

        }


    </script>
</html>