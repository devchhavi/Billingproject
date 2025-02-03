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
                                    <h4 class="page-title mb-0 font-size-18">Purchase Payment List</h4>

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
                                                    <th>Bill No.</th>
                                                    <th>Date</th>
                                                    <th>Previous Due</th>
                                                    <th>Paid </th>
                                                    <th>Due</th>
                                                   
                                                  
                                                </tr>
                                            </thead>
                                            <?php $ramObj->deleteMember(); ?>
                                            <tbody>
                                                <?php
                                               
     $ResultAll = mysqli_query($link, "SELECT * FROM `purchase_payment` WHERE purchase_id='$accountid' order by id desc ");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
    $i=1;
    
     while($RowAll = mysqli_fetch_array($ResultAll)){  ?>
        <tr>

         <td>
                        <?php echo $i; ?>
                    </td>
                    <td>P<?php echo $accountid; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($RowAll['RectimeStamp'])); ?></td>
                    <td><?php echo $RowAll['Previous_Dew']; ?></td>
                    <td><?php echo $RowAll['Amount']; ?></td>
                     <td><?php echo $RowAll['Now_Dew']; ?></td>
                     </tr><?php



$i++;


     } 
     } ?>
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