<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
    <link rel="stylesheet" href="assets/css/summernote/summernote-bs4.css">
    <?php
    include_once './header.php';
    include_once '../include/ram.php';
    require_once '../include/db.php';
    $ramObj = new ram;

     global $link;
        $query = "SELECT * FROM `charges_deduction` order by id desc";
        $result = mysqli_query($link, $query);
   
       
    ?>
    <?php 

   
      
      $row_um = mysqli_fetch_array($result); 
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
                    $i=1;
                    if ($i) {
                       
                        $result_um = mysqli_query($link, "SELECT * FROM pages WHERE id='1'");
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
                                        <?php $ramObj->update_terms(); ?>
                                            <form action="" method="post">
                                                <div class="row">
                                                    
                                                    <textarea id="summernote" name="content"><?php echo $row_um['content'];  ?></textarea>
                                                   

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
                                        <h4 class="page-title mb-0 font-size-18">Setting</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                                <li class="breadcrumb-item active">Setting</li>
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
                                             

    <?php $ramObj->editSetting(); ?>

   
                                            <form action="" method="post">
                                                  <input type="hidden" name="Categoryid" value="1" />
                                                <div class="row">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="m_name">TDS Charge(%) </label>
                                                            <input type="text" name="p_name" required="" id="p_name" class="form-control" id="useremail"  placeholder="TDS Charge"value="<?php echo $row_um['tds']; ?>">
                                                           
                                                        </div>
                                                          <div> <span id="errorOfEmail"></span></div>

                                                       

                                                        <div class="form-group">
                                                            <label for="m_mobile">Processing Fee(%)</label>
                                                            <input type="text" name="Price" required="" id="m_mobile" class="form-control" id="username" placeholder="Processing Fee"value="<?php echo $row_um['pro_fee']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Travelling Charge(%)</label>
                                                            <input type="text" name="PV" required="" id="password" class="form-control" id="username" placeholder="Travelling Charge"value="<?php echo $row_um['Travelling']; ?>">
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="password">Charity Charge(%)</label>
                                                            <input type="text" name="category" required="" id="password" class="form-control" id="username" placeholder="Charity Charge"value="<?php echo $row_um['Charity']; ?>">
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="password">Per PV Mathcing Payout(Rs.)</label>
                                                            <input type="text" name="BP" required="" id="password" class="form-control" id="username" placeholder="Per PV Mathcing Payout"value="<?php echo $row_um['Pv_Matching_charge']; ?>">
                                                        </div>

                                                      

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary btn-block waves-effect waves-light" name="updatesetting" type="submit">Update</button>
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
    <script src="assets/css/summernote/summernote-bs4.js"> </script>
    <script>
        
        $(document).ready(function(){
            $('#summernote').summernote();
            
        });
        
     
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