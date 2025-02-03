<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="assets/images/users/<?php $i = "photo"; $ramObj->memberRecords($i); ?>" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16"><?php $i = "name"; $ramObj->memberRecords($i); ?></a>
                <p class="text-body mt-1 mb-0 font-size-13">Raj Building Material</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="index.php" class=" waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Profile</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="edit_profile.php">Edit Profile</a></li>
                        <li><a href="add_bank_details.php">Bank Details</a></li>
                        <li><a href="add_upi.php">Add UPI</a></li>
                        <li><a href="change_password.php">Change Password</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li><a href="member_registration.php">Customer Registration</a></li>
                        <li><a href="member_list.php">Customer List</a></li>
                        <li><a href="customerpurchaselist.php">Customer Ledger</a></li>
                        <!-- <li><a href="inactive_member_list.php">Inactive Member List</a></li>
                        <li><a href="bank_details.php">Member Bank Details</a></li> -->
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Party Details</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li><a href="supplier.php">Add Party</a></li>
                        <li><a href="supplierpurchaselist.php">Party Ledger</a></li>
                        <!-- <li><a href="inactive_member_list.php">Inactive Member List</a></li>
                        <li><a href="bank_details.php">Member Bank Details</a></li> -->
                    </ul>
                </li>

                  <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Product Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="category.php">Category</a></li>
                        <li><a href="product.php">Product</a></li>
                         <li><a href="product_stock.php">Product Stock</a></li>
                        <li><a href="purchase.php">Purchase</a></li>
                          <li><a href="purchaselist.php">Purchase List</a></li>
                        <!-- <li><a href="saleproduct.php">Sale</a></li>
                          <li><a href="salelistproduct.php">Sale List</a></li> -->
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Sale Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li><a href="saleproduct.php">Sale</a></li>
                        <li><a href="salelistproduct.php">Sale List</a></li>
                           
                    </ul>
                </li>
              
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-file-table-box-multiple-outline"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li><a href="purchasereport.php">Purchase Report</a></li>
                        <li><a href="salereport.php">Sale Report</a></li>
                        <li><a href="dailyreport.php">Daily  Report</a></li>
                        <!-- <li><a href="processingfee.php">Processing Fee Report</a></li>
                        <li><a href="travellingFee.php">Travelling Fee Report</a></li>
                        <li><a href="charityFee.php">Charity Fee Report</a></li>
                   
                        <li><a href="payableamountpaidreport.php">Payble Amount Paid Report</a></li>
                        -->
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>