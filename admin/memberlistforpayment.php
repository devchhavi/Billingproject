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
                                    <h4 class="page-title mb-0 font-size-18">Member List For Payment</h4>

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

                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                   
                                                      <th>Payable</th>
                                                        <th>Paid</th>
                                                          <th>Dew</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                <?php
                                                  $query = "SELECT * FROM `members` where total_income>0";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
             
                ?><tr style="">
                    <td >
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $accountid=$row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    

                      <td><?php echo   $payble=$row['total_income']+$row['Paid_Income']; ?></td>
                        <td><?php echo   $paid=$row['Paid_Income']; ?></td>
                        <td><?php echo   $payble-$paid; ?></td>
                       <td>

                       
               <?php if ($row['total_income']>0) {
              ?>
               <a href="addwalletpayments.php?accountid=<?php echo $row['m_id']; ?>" title="Add Payment" class="btn btn-primary btn-sm">
                                <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
              </a><?php  } else{   ?>
                 <a  title="Paid Wallet Amount" class="btn btn-primary btn-sm">
                                <i class="fas fa-circle" aria-hidden="true"></i>
              </a>
          <?php } ?>

            <a href="walletpaymentlist.php?accountid=<?php echo $row['m_id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>



                    </td>
                      
                </tr>

                <?php 
                $i++;
            }
        }


                 ?>
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
</html>