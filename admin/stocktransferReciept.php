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
    <script> 
        function printDiv() { 
            var divContents = document.getElementById("GFG").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            a.document.write('<body > <h1>Div contents are <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
    </script> 

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
                                    <h4 class="page-title mb-0 font-size-18">Stock Transfer Receipt</h4>

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



                        <div class="row" id="GFG">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <?php  
                                        if (isset($_GET['accountid'])) {
         $accountid=$_GET['accountid'];
    }


                                       $ResultAll = mysqli_query($link, "SELECT * FROM `stock_transfer_product` WHERE sale_id ='$accountid'");
 
    $RowAll = mysqli_fetch_array($ResultAll);
    $memcode=$RowAll['member_id'];

     $ResultAlls = mysqli_query($link, "SELECT * FROM `members` WHERE m_id  ='$memcode'");
 
    $RowAlls = mysqli_fetch_array($ResultAlls);
    ?>
                                        <div class="row">
                                        <div class="col-md-8">

                                        <img src="assets/images/Vasta.png" height="50px;">
                                        </div>
                                         <div class="col-md-4">
                                            <?php echo $RowAll['RectimeStamp'];    ?>
                                            <div ><b> #ST<?php echo $RowAll['sale_id'];    ?></b></div>
                                       
                                        </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="font-size: 15px;">From,</div>
                                                <div style="font-size: 20px;"><b>Vasta</b></div>
                                                <div style="font-size: 15px;">Varanasi</div>
                                                <div style="font-size: 15px;">99567489</div>

                                            </div>
                                            <div class="col-md-6">
                                               <div style="font-size: 15px;">To,</div>
                                               <div style="font-size: 20px;"><b><?php echo $RowAlls['m_name']; ?>(<?php echo $RowAll['member_id']; ?>)</b></div>
                                                <div style="font-size: 15px;"><?php echo $RowAlls['m_address']; ?></div>
                                                <div style="font-size: 15px;"><?php echo $RowAlls['m_mobile']; ?></div>

                                            </div>
                                            


                                        </div>
                                          <hr>

                                        <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; height: 50px;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Discount(%) </th>
                                                    <th>Subtotal(Rs.)</th>
                                                   
                                                   
                                                </tr>
                                            </thead>
                                           
                                            <tbody><?php

                                            $purchasetempid=$RowAll['saletemp_id'];
                                              $ResultAllss = mysqli_query($link, "SELECT * FROM `stock_transfer_product_list` WHERE purchase_id='$purchasetempid'");
  $rowcountallss = mysqli_num_rows($ResultAllss);
  if ($rowcountallss>0) {
    $totalamount=0;
    $i=1;
     while ($RowAllss = mysqli_fetch_array($ResultAllss)) {  ?>


    <tr>

        <?php  
        $p_name=$RowAllss['product_id'];
        $ResultAllsss = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$p_name'");
  $RowAllsss = mysqli_fetch_array($ResultAllsss); ?>
    
        
        <td><?php echo $i; ?></td>
        <td><?php echo $RowAllsss['Name']; ?>(<?php echo $RowAllsss['Product_Code']; ?>)</td>

        <td><?php echo $RowAllss['product_amount']; ?></td>

        <td><?php echo $RowAllss['Quantity']; ?></td>

        <td><?php echo $RowAllss['Discount']; ?></td>

        <td><?php echo $RowAllss['Total_amount'];$totalamount=$totalamount+$RowAllss['Total_amount']; ?></td>
        

        
    </tr>  <?php



     } }
    ?>
    <tr>
        <td></td>
         <td></td>
          <td></td>
           <td></td>
    <td><b>Total</b></td>
      <td><b><?php  echo  $totalamount;   ?></b></td>
</tr>
  <tr>
        <td></td>
         <td></td>
          <td></td>
           <td></td>
    <td><b>Deposit</b></td>
      <td><b><?php  echo  $RowAll['Discount'];   ?></b></td>
</tr>
 <tr>
        <td></td>
         <td></td>
          <td></td>
           <td></td>
    <td><b>Due</b></td>
      <td><b><?php  echo  $RowAll['Balance'];   ?></b></td>
</tr>
                                            </tbody>
                                        </table>
                                       <button class="btn btn-outline-primary btn-sm" onclick="window.print();return false;"title="Print"><i class="fas fa-print" aria-hidden="true"></i></button>

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