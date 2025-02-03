<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
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
    if (isset($_POST['startdate'])) {
         $startdate = $_POST['startdate'];
       
    }
    else{

        $startdate="";

    }

     if (isset($_POST['enddatedate'])) {
         $enddatedate = $_POST['enddatedate'];
       
    }
    else{

        $enddatedate="";

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
                                    <h4 class="page-title mb-0 font-size-18">Sale Report</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Income Paid</a></li>
                                            <li class="breadcrumb-item active">Report</li>-->
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
                                                    <th>S. No.</th>
                                                    <th>Bill No.</th>
                                                    <th>Date</th>
                                                    <th>Member</th>
                                                    <th>Amount</th>
                                                    <!--<th>Transaction Id</th>-->
                                                   
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
        $query = "SELECT * FROM `sale_product` WHERE DATE(RectimeStamp) = CURDATE() ORDER BY RectimeStamp DESC";
                              
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $total=0;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $customerid = $row['member_id'];
                $Resultcustomer = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$customerid'");
                $Rowcustomer = mysqli_fetch_array($Resultcustomer);
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td>#<?php  echo $row['sale_id']; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row['RectimeStamp'])); ?></td>
                    <td><?php  echo $Rowcustomer['m_name']; ?></td>
                    <td><?php
                        echo $row['total'];$total=$total+$row['total'];
                        ?></td>
                    <!--<td><?php //echo $row['transaction_id']; ?></td>-->
                   


                </tr><?php
                $i++;
            }
        }     ?>
                                            </tbody>
                                        </table>
                                    </div>
                                     <span style="font-size: 20px;" > Total:&#8377;<?php echo number_format($total, 2); ?>
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