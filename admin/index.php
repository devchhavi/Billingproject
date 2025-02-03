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
    $ramObj->singleleg_income();
    $ramObj->send_singleleg_income();
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
                                    <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Home</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="row">
                           

                            <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#81d002;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-account-multiple-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Total Customer</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4"><?php
                                            $a = "total_member";
                                            $ramObj->homepageDetails($a);
                                            ?></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          

                            <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#0dc1f7;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Total Purchase</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4"> &#8377;
                                             <?php
                                            // $a = "totalpurchase";
                                            // $ramObj->homepageDetails($a);
                                            ?> 
                                            </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#fb60b6;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Total Sale</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            // $a = "totalsale";
                                            // $ramObj->homepageDetails($a);
                                            ?> </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         
                                 <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#81d002;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-account-multiple-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2"> Payble Amount</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            // $a = "paybleamounts";
                                            // $ramObj->homepageDetails($a);
                                            ?></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                          


                            <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#fb60b6;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">TDS</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            $a = "tdsvalue";
                                            $ramObj->homepageDetails($a);
                                            ?> </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                              <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#81d002;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-account-multiple-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Processing Fee</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            $a = "processingfee";
                                            $ramObj->homepageDetails($a);
                                            ?></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                             <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#fb60b6;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Travelling Amount</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            $a = "travellingamount";
                                            $ramObj->homepageDetails($a);
                                            ?> </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                              <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#81d002;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-account-multiple-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Charity Amount</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            $a = "charityamount";
                                            $ramObj->homepageDetails($a);
                                            ?></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                          

                        

                            <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#fb60b6;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Paid Payable Amount</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">&#8377;<?php
                                            $a = "paidpayable";
                                            $ramObj->homepageDetails($a);
                                            ?> </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                             <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#fb60b6;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-credit-card-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Month BP</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4"><?php
                                            $a = "monthbp";
                                            $ramObj->homepageDetails($a);
                                            ?> </h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                          


                            <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#ff8944;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-account-multiple-outline"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">Today Joining Member</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4"><?php
                                            $a = "today_joining_member";
                                            $ramObj->homepageDetails($a);
                                            ?></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                              <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#958eff;">
                                    <div class="card-body">
                                        <div class="media">
                                           
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2"> <button type="button" onclick="closing();" class="btn btn-danger">Monthly Close</button></div>
                                            </div>
                                         
                                        </div>
                                       <br><br><p></p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#e8d548;">
                                    <div class="card-body">
                                        <div class="media">
                                           
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2"> <button type="button" onclick="annualclosing();" class="btn btn-danger">Annual Close</button></div>
                                            </div>
                                            <div id="ghftyrf"></div>
                                        </div>
                                       <br><br><p></p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                          
 <!--
                            <div class="col-md-4 col-sl-6">
                                <div class="card" style="background-color:#04deac;">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="avatar-sm font-size-20 mr-1">
                                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                                    <i class="mdi mdi-link"></i>
                                                </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="font-size-14 mt-2">
                                                    <span onclick="myFunctiona()" class="text-nowrap" style="cursor: pointer;">
                                                        Click me to copy</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4 font-size-14"><a style="color: black;text-decoration: none;" href="http://futurerise.in/register.php?spid=<?php //echo $_SESSION['admin_id']; ?>" target="_blank" >http://futurerise.in/register.php?spid=<?php//echo $_SESSION['admin_id']; ?></a></h4>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->


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
    <script>

        function closing() {
            var memberId = "";
            $.ajax({
                type: "POST",
                url: "closing.php",
                data: {member_id: memberId},
                success: function (data) {
                    
                    alert(data);
                }
            });
        }

         function annualclosing() {
            var memberId = "";
            $.ajax({
                type: "POST",
                url: "annualclosing.php",
                data: {member_id: memberId},
                success: function (data) {
                    
                    alert(data);
                }
            });
        }


        function myFunctiona() {
            // variable content to be copied
            var copyText = ""
            // create an input element
            let input = document.createElement('input');
            // setting it's type to be text
            input.setAttribute('type', 'text');
            // setting the input value to equal to the text we are copying
            input.value = copyText;
            // appending it to the document
            document.body.appendChild(input);
            // calling the select, to select the text displayed
            // if it's not in the document we won't be able to
            input.select();
            // calling the copy command
            document.execCommand("copy");
            // removing the input from the document
            document.body.removeChild(input)
            alert("Referral link copied.");
        }
    </script>
</html>