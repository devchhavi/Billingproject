<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
                                    <h4 class="page-title mb-0 font-size-18">Sale Records</h4>

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
                        <!-- Select Option for filtering or selecting -->
                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-md-6 text-center">
                                <label for="filterOption" class="form-label">Select Customer</label>
                                <select id="customerSelect" name="customer" class="form-control mx-auto">
                                    <option value="">Select customer</option>
                                <?php $ramObj->selectcustomerlist();?>
                                </select>
                            </div>
                        </div>

                <!-- Table for displaying purchase list -->
                <table id="purchase-list" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Perticular (Bill No)</th>
                            <th>Bill Date</th>
                            <th>Customer Name</th>
                            <th>Bill Amount(Debit)</th>
                            <th>Paid (Credit)</th>
                            <th>Balance</th>
                            <!-- <th>Profit</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                       
                    </tbody>
                </table>
            </div>
            <!-- <span style="font-size: 20px;">Total Profit: ₹<span id="total-profit">0</span></span> -->
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

<script type="text/javascript">
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#purchase-list').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf']
    });

    // Listen for change event on the customer dropdown
    $('#customerSelect').on('change', function() {
        var selectedCustomer = $(this).val();

        // Send an AJAX request to fetch the filtered purchase list
        $.ajax({
            url: 'customerpurchaselistfunction.php', // The PHP file handling the request
            type: 'POST',
            data: { customer: selectedCustomer },
            dataType: 'html', // Expecting HTML response
            success: function(response) {
                console.log(response);

                // Clear the existing DataTable content and update with new data
                table.clear().draw(); // Clear the DataTable
                $('#purchase-list tbody').html(response);

                // Redraw the DataTable to apply the changes and update export buttons
                table.rows.add($('#purchase-list tbody tr')).draw();
            },
            error: function() {
                alert('Failed to fetch data.');
            }
        });
    });
});
</script>