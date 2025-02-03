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
    if (isset($_GET['accountid'])) {
        $accountid=$_GET['accountid'];
    }


     $ResultAll = mysqli_query($link, "SELECT * FROM `stock_transfer_payments` WHERE purchase_id='$accountid' order by id desc limit 1");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
     $RowAll = mysqli_fetch_array($ResultAll);
       $totalamount=$RowAll['Now_Dew'];
  }

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
                                    <h4 class="page-title mb-0 font-size-18">Add Payment</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>
                                            <li class="breadcrumb-item active">All Members</li>-->
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
                                     <?php $ramObj->add_stock_transfer_productpayment(); ?>
                                <form action="" method="post">
                                 <input type="hidden" name="purchasetempids" id="purchasetempids" value="<?php echo $accountid;  ?>" /> 
                                 <div class="col-lg-6">
                                    <label>Due Amount</label>
                                                        <div class="form-group">
                                                           
                                 <input type="text" name="p_totalamount"  id="p_totalamount" class="form-control"  value="<?php echo  $totalamount; ?>" placeholder="" readonly>
                                                           
                                                        </div>
                                 </div>
                                  <div class="col-lg-6">
                                    <label>Deposit</label>
                                                        <div class="form-group">
                                                           
                                <input type="text" name="p_deposit"  id="p_deposit" class="form-control"  onkeyup="getbalance();" placeholder="Deposit Amount">
                                                           
                                                        </div>
                                                          <div> <span id="errorOfEmail"></span></div>
                                 </div>
                                  <div class="col-lg-6">
                                    <label>Balance</label>
                                                        <div class="form-group">
                                                           
                               <input type="text" name="p_balance"  id="p_balance" class="form-control"   placeholder=""readonly>
                                                           
                                                        </div>
                                 </div>
                                   <div class="col-lg-4">
                                         
                                                          
                                                             <button class="btn btn-primary btn-block waves-effect waves-light" name="add_stock_transfer_productpayment" type="submit">Submit</button>
                                                         
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
    <script type="text/javascript">
     function getbalance() {
              
            var val = document.getElementById('p_totalamount').value;
              var val1 = document.getElementById('p_deposit').value;
              
              

                var total1=val-val1;
              
                var total=total1;
                  document.getElementById('p_balance').value = total;
              
         
    
           

        }
        </script>
</html>