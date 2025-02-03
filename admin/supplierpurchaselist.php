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
                                    <h4 class="page-title mb-0 font-size-18">Purchase List</h4>

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
                                <label for="filterOption" class="form-label">Select Supplier</label>
                                <select id="supplierSelect" name="supplier" class="form-control mx-auto">
                                    <option value="">Select supplier</option>
                                <?php $ramObj->selectsupplierlist();?>
                                </select>
                            </div>
                        </div>

                <!-- Table for displaying purchase list -->
                <table id="purchase-list" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Bill No.</th>
                            <th>Bill Date</th>
                            <th>Supplier Name</th>
                            <th>Bill Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >
                     
                       
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
<script type="text/javascript">
$(document).ready(function() {
    // Initialize DataTable with export buttons
    var table = $('#purchase-list').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        destroy: true // Allow reinitialization
    });

    // Listen for change event on the supplier dropdown
    $('#supplierSelect').on('change', function() {
        var selectedSupplier = $(this).val();

        // Send an AJAX request to fetch the filtered purchase list
        $.ajax({
            url: 'supplierpurchaselistfunction.php',
            type: 'POST',
            data: { supplier: selectedSupplier },
            dataType: 'html',
            success: function(response) {
                console.log(response);

                // Destroy the existing DataTable instance
                table.destroy();

                // Update the table body with the new data
                $('#purchase-list tbody').html(response);

                // Reinitialize DataTable with export buttons
                table = $('#purchase-list').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'pdf']
                });
            },
            error: function() {
                alert('Failed to fetch data.');
            }
        });
    });
});
</script>