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
    ?>
<style>
        .tooltipme {
            position: relative;
            display: inline-block;
            /*//border-bottom: 1px dotted black;*/
            margin-top: 10px;
            margin-bottom: 0px;

        }

        .tooltipme .tooltipmetext {
            z-index: 888!important;
            visibility: hidden;
            font-size: 14px;
            font-weight: 100;
            line-height: 18px;
            width: 240px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            top: 125%;
            left: 50%;
            margin-left: -120px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltipme .tooltipmetext::after {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -10px;
            border-width: 10px;
            border-style: solid;
            border-color: transparent transparent #555  transparent;
        }

        .tooltipme:hover .tooltipmetext {
            visibility: visible;
            opacity: 1;
            border: #007bff solid 2px;
        }
        /*        .tooltipme::after{
                    content: "|";
                    font-size: 20px;
                    color: black;
                    position: absolute;
                    top: 100%;
                    left: 80%;
                    margin-left: -10px;
                }*/
        .green-bg{
            border: #00ff00 solid 2px;
        }
        .silver-bg{
            border: #ccc solid 2px;
        }
        .gold-bg{
            border: #ffff00 solid 2px;
        }
        .diamond-bg{
            border: #007bff solid 2px;
        }
    </style>
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
                                    <h4 class="page-title mb-0 font-size-18">Dynamic Tree View</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
<!--                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Downline</a></li>
                                            <li class="breadcrumb-item active">Direct Downline</li>-->
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                          <section class="section">

                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Dynamic Tree View</h4>
                                    </div>
                                    <div id="getTree" class="card-body text-center" style=" padding-top: 30px; padding-bottom: 100px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                $memberID = $_SESSION['admin_id'];
//                                                $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE member_id = $memberID");
//                                                $row = mysqli_fetch_array($result);
//                                                $active_member_id=$row['active_member_id'];
                                                ?>
                                                <i onmouseover="generateTree(<?php echo $memberID; ?>)" class="tooltipme">
                                                    <img class="user-img-radious-style" height="50" src="../admin/assets/images/users/<?php $i = "photo";
                                                $ramObj->memberRecords($i);
                                                ?>" alt="Member Photo"/><br/>
                                                         <?php
                                                         $i = "name";
                                                         $ramObj->memberRecords($i);
                                                          $i = "statuss";
                                                         $statuss= $ramObj->memberRecords($i);
                                                         
 if ($statuss=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                } ?>
                                                    <span style="color:<?php  echo $txtColor; ?>"> <?php
                                                         echo " (" . $_SESSION['admin_id'] . ")";
                                                         ?> </span>
                                                    <span class="tooltipmetext" tabindex="1">ID : <?php $limit = 1;
                                                        echo $_SESSION['admin_id'];
                                                         ?> <br/> Name : <?php $i = "name";
                                                        $ramObj->memberRecords($i);
                                                         ?> <br/>Mobile : <?php $i = "mobile";
                                                        $ramObj->memberRecords($i);
                                                         ?><br/>Email : <?php $i = "email";
                                                        $ramObj->memberRecords($i);
                                                         ?><br/>Joining date : <?php $i = "jdate";
                                                        $ramObj->memberRecords($i);
                                                         ?> </span>
                                                </i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
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
        function generateTree(id) {
            $.ajax({
                type: "POST",
                url: "generate_tree.php",
                data: {member_id: id},
                success: function (data) {
                    document.getElementById('getTree').innerHTML = data;
                }
            });
        }
    </script>
</html>