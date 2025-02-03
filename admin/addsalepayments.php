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
    if (isset($_GET['customer'])) {
        $customerid=$_GET['customer'];
    }


     $ResultAll = mysqli_query($link, "SELECT * FROM `members` WHERE m_id='$customerid'");
        $rowcountall = mysqli_num_rows($ResultAll);
        $total_due_sum = 0;
        if ($rowcountall>0) {
            $RowAll = mysqli_fetch_array($ResultAll);
            $totalamount=$RowAll['total_due_amount'];
      
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
                                     <?php $ramObj->add_saleproductpayment(); ?>
                                <form action="" method="post">
                                 <input type="hidden" name="purchasetempids" id="purchasetempids" value="<?php echo $customerid;  ?>" /> 
                                 <div class="col-lg-6">
                                    <label>Due/Balance Amount</label>
                                                        <div class="form-group">
                                                           
                                 <input type="text" name="p_totalamount"  id="p_totalamount" class="form-control"  value="<?php echo  $totalamount; ?>" placeholder="" readonly>
                                                           
                                                        </div>
                                 </div>
                                  <div class="col-lg-6">
                                    <label>Credit</label>
                                                        <div class="form-group">
                                                           
                                <input type="text" name="p_deposit"  id="p_deposit" class="form-control"  placeholder="Deposit Amount">
                                                           
                                                        </div>
                                                          <div> <span id="errorOfEmail"></span></div>
                                 </div>
                                 <div class="col-lg-6">
                                    <label>Debit</label>
                                                        <div class="form-group">
                                                           
                                <input type="text" name="debit"  id="debit" class="form-control"  onkeyup="getbalance();" placeholder="Enter Amount">
                                                           
                                                        </div>
                                                          <div> <span id="errorOfEmail"></span></div>
                                 </div>
                                  <div class="col-lg-6">
                                    <label>Balance</label>
                                                        <div class="form-group">
                                                           
                                    <input type="text" name="p_balance"  id="p_balance" class="form-control"   placeholder=""readonly>
                                                           
                                                        </div>
                                 </div>

                                 <div class="col-lg-6">
                                    <label>Advance Payment</label>
                                        <div class="form-group">
                                                           
                                    <input type="text" name="advance_balance"  id="advance_balance" class="form-control"   placeholder=""readonly>
                                                           
                                    </div>
                                 </div>

                                 <div id="payment_sections">
                                        <div class="col-lg-6 payment-section" id="payment_section_1">
                                            <label>Payment Mode</label>
                                            <div class="form-group d-flex align-items-center">
                                                <!-- Payment Mode Dropdown -->
                                                <select class="form-control payment_mode me-2" name="payment_mode[]" id="payment_mode_1" onchange="showPaymentFields(1);">
                                                    <option value="" disabled selected>Select Payment Mode</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="upi">UPI</option>
                                                    <option value="Cheque">Cheque</option>
                                                </select>
                                                <!-- Add Another Payment Button -->
                                                <button type="button" class="btn btn-success d-flex align-items-center justify-content-center" onclick="addPaymentMode();" style="width: 50px; height: 38px;">
                                                    <span>+</span>
                                                </button>
                                            </div>
                                            <!-- Payment Amount Input -->
                                            <div class="form-group mt-3">
                                                <input type="text" name="payment_amount[]" id="payment_amount_1" class="form-control payment_amount" placeholder="Enter Amount">
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-lg-6">
                                    <label>Remark</label>
                                <div class="form-group">
                                                           
                               <input type="text" name="remark"  id="remark" class="form-control"   placeholder="Please Enter Remark">
                                                           
                                                        </div>
                                 </div>
                                   <div class="col-lg-4">
                                                          
                                    <button class="btn btn-primary btn-block waves-effect waves-light" name="add_saleproductpayment" type="submit">Submit</button>
                                                         
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
              
        var totalDue = parseFloat(document.getElementById('p_totalamount').value) || 0; // Total due amount
    var deposit = parseFloat(document.getElementById('p_deposit').value) || 0;     // Deposit amount
    
    var balance = totalDue - deposit;
    var advance = 0;

    if (balance < 0) { 
        advance = Math.abs(balance);  
        balance = 0;                  
    }

    // Update the balance and advance payment fields
    document.getElementById('p_balance').value = balance.toFixed(2); // Balance amount
    document.getElementById('advance_balance').value = advance.toFixed(2); // Advance payment
          
        }
        let paymentCounter = 1;

function addPaymentMode() {
    paymentCounter++;

    // Create new payment section
    const newPaymentSection = `
    <div class="col-lg-6 payment-section" id="payment_section_${paymentCounter}">
        <label>Payment Mode</label>
        <div class="form-group d-flex align-items-center">
            <!-- Payment Mode Dropdown -->
            <select class="form-control payment_mode me-2" name="payment_mode[]" id="payment_mode_${paymentCounter}" onchange="showPaymentFields(${paymentCounter});">
                <option value="" disabled selected>Select Payment Mode</option>
                <option value="cash">Cash</option>
                <option value="upi">UPI</option>
                <option value="wallet">Cheque</option>
            </select>
            <!-- Remove Button -->
            <button type="button" class="btn btn-danger d-flex align-items-center justify-content-center" onclick="removePaymentMode(${paymentCounter});" style="width: 50px; height: 38px;">
                <span>-</span>
            </button>
        </div>
        <!-- Payment Amount Input -->
        <div class="form-group mt-3">
            <input type="text" name="payment_amount[]" id="payment_amount_${paymentCounter}" class="form-control payment_amount" placeholder="Enter Amount">
        </div>
    </div>
    `;

    // Append new payment section
    document.getElementById('payment_sections').insertAdjacentHTML('beforeend', newPaymentSection);
}

function showPaymentFields(counter) {
    const paymentMode = document.getElementById(`payment_mode_${counter}`).value;

    // You can customize additional logic for showing/hiding fields if required.
    console.log(`Selected payment mode for section ${counter}:`, paymentMode);
}

function removePaymentMode(counter) {
    const paymentSection = document.getElementById(`payment_section_${counter}`);
    if (paymentSection) {
        paymentSection.remove();
    }
}

        </script>
</html>