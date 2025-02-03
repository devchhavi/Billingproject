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
    
    <script>
            function suggest(inputString){
                if(inputString.length == 0) {
                    $('#suggestions').fadeOut();
                } else {
                $('#country').addClass('load');
                    $.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
                        if(data.length >0) {
                            $('#suggestions').fadeIn();
                            $('#suggestionsList').html(data);
                            $('#country').removeClass('load');
                        }
                    });
                }
            }

            function fill(thisValue) {
                $('#country').val(thisValue);
                setTimeout("$('#suggestions').fadeOut();", 600);
            }
            function suggests(inputString){
                if(inputString.length == 0) {
                    $('#suggestionss').fadeOut();
                } else {
                $('#countrys').addClass('load');
                    $.post("autosuggestss.php", {queryString: ""+inputString+""}, function(data){
                        if(data.length >0) {
                            $('#suggestionss').fadeIn();
                            $('#suggestionsLists').html(data);
                            $('#countrys').removeClass('load');
                        }
                    });
                }
            }

            function fills(thisValue) {
                $('#countrys').val(thisValue);
                setTimeout("$('#suggestionss').fadeOut();", 600);
            }

        </script>
        <style>
            #result {
                height:20px;
                font-size:16px;
                color:#333;
                padding:5px;
                margin-bottom:10px;
                background-color:#FFFF99;
            }

            .suggestionsBox {
                position: absolute;
                left: 10px;
                margin: 0;
                width: 268px;
                top: 40px;
                padding:0px;
                background-color: #F7601F;
                color: #fff;
                 z-index: 99;



            }
            .suggestionList {
                margin: 0px;
                padding: 0px;
            }
            .suggestionList ul li {
                list-style:none;
                margin: 0px;
                padding: 6px;
               
                cursor: pointer;

                
            }
            .suggestionList ul li:hover {
                background-color: #EEB59C;
                color:#000;
            }
                .suggestionsBoxs {
                position: absolute;
                left: 10px;
                margin: 0;
                width: 268px;
                top: 40px;
                padding:0px;
                background-color: #F7601F;
                color: #fff;
                 opacity: 1!important;
                    z-index: 99;



            }
            .suggestionLists {
                margin: 0px;
                padding: 0px;
            }
            .suggestionLists ul li {
                list-style:none;
                margin: 0px;
                padding: 6px;
              
                cursor: pointer;

                
            }
            .suggestionLists ul li:hover {
                background-color: #EEB59C;
                color:#000;
            }
            ul {
                font-size:11px;
                color:#FFF;
                padding:0;
                margin:0;
            }

            .load{
            background-image:url(loader.gif);
            background-position:right;
            background-repeat:no-repeat;
            }

            #suggest {
                position:relative;
            }
            .combopopup{
                padding:3px;
                width:268px;
                border:1px #CCC solid;
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

                    <?php
                    if (isset($_REQUEST['update_mem'])) {
                        $um_id = $_REQUEST['update_mem'];
                        $result_um = mysqli_query($link, "SELECT * FROM members WHERE m_id='" . $um_id . "'");
                        $row_um = mysqli_fetch_array($result_um);
                        ?>
                        <div class="page-content">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="page-title mb-0 font-size-18">Member Update Details</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
<!--                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>
                                                <li class="breadcrumb-item active">Update Details</li>-->
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
                                            
                                        <h4 class="card-title"></h4>
                                        <p class="card-title-desc"></p>
                                        <?php $ramObj->update_mem(); ?>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Member Id</label>
                                                            <input type="text" value="<?php echo $um_id; ?>" name="um_id" readonly required="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Member Name</label>
                                                            <input type="text" name="um_name" value="<?php echo $row_um['m_name']; ?>" required="" class="form-control" placeholder="Name*">
                                                            <input type="hidden" name="um_page_name" value="member_registration.php" />
                                                            <!--<input type="hidden" name="atrandam_member_id" id="atrandam_member_id" value="" />-->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mobile</label>
                                                            <input type="text" name="um_mobile" value="<?php echo $row_um['m_mobile']; ?>" id="um_mobile" required="" class="form-control" placeholder="Mobile No.*">
                                                            <div id="errorCheckMobile" class="text-danger"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" name="um_email" value="<?php echo $row_um['m_email']; ?>" id="um_email" class="form-control" placeholder="Email Address*">
                                                            <div id="errorCheckEmail" class="text-danger"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sponsor Id</label>
                                                            <input type="text" style="pointer-events: none;" onkeydown="return false" name="um_sponsor_id" value="<?php echo $row_um['sponsor_id']; ?>" id="um_sponsor_id" placeholder="Sponsor ID*" required="" class="form-control">
                                                            <div><p id="sponsor_nameInvalid" style="color: red;"></p></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sponsor Name</label>
                                                            <input value="<?php echo $row_um['sponsor_name']; ?>" style="pointer-events: none;" onkeydown="return false" type="text" name="um_sponsor_name" id="um_sponsor_name" required="" class="form-control" placeholder="Sponsor Name*" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="text" name="um_password" value="<?php echo $row_um['m_password']; ?>" id="um_password" placeholder="Password" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <select id="um_member_state" class="form-control" onchange="showCities2()" name="um_member_state">
                                                                <?php
                                                                $um_stateid = $row_um['m_state_id'];
                                                                $result_umstate = mysqli_query($link, "SELECT name FROM `states` WHERE id='" . $um_stateid . "'");
                                                                $row_umstate = mysqli_fetch_array($result_umstate);
                                                                $um_statename = $row_umstate['name'];
                                                                ?>
                                                                <option selected="" value="<?php echo $um_stateid; ?>"><?php echo $um_statename; ?></option>
    <?php $ramObj->showStatesList(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <select id="um_member_city" class="form-control" name="um_member_city">
                                                                <?php
                                                                $um_cityid = $row_um['m_city_id'];
                                                                $result_umcity = mysqli_query($link, "SELECT name FROM `cities` WHERE id='" . $um_cityid . "'");
                                                                $row_umcity = mysqli_fetch_array($result_umcity);
                                                                $um_cityname = $row_umcity['name'];
                                                                ?>
                                                                <option selected="" value="<?php echo $um_cityid; ?>"><?php echo $um_cityname; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pincode</label>
                                                            <input id="um_member_pincode" value="<?php echo $row_um['m_pincode']; ?>" type="text" placeholder="Pincode" class="form-control" name="um_member_pincode" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea id="um_member_address" placeholder="Address" class="form-control" name="um_member_address" style="min-height: 110px;"><?php echo $row_um['m_address']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="form-group">
                                                                <button type="submit" name="um_member" class="btn btn-primary btn-block waves-effect waves-light">
                                                                    Update
                                                                </button>
                                                            </div>
                                                </div>



                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div>

<?php } else { ?>
    <?php   

     date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");

    $query = "INSERT INTO `sale_temporary` (`RectimeStamp`) VALUES ('$rectimestamp')";
                $result = mysqli_query($link, $query);

                  $lastinsertid=mysqli_insert_id($link);  ?>

                        <div class="page-content">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="page-title mb-0 font-size-18">Product Sale</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                                <li class="breadcrumb-item active">Product Sale</li>
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

    
                                            <form action="" method="post">
                                                <div class="row">
                                                  <input type="hidden" name="purchasetempid" id="purchasetempid" value="<?php echo $lastinsertid;  ?>" />
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                          
                                                            <input type="text" name="p_name" required="" id="country" class="form-control"  onkeyup="suggest(this.value);"onblur="fill();" onblur="getProductPrice(this.value);"  
                                                             placeholder="Product Name">
                                                           
                                                        </div>
                                                        <div class="suggestionsBox" id="suggestions" style="display: none;opacity: 1!important;">
                                                            <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-2">
                                                        <div class="form-group">
                                                           
                                                            <input type="text" name="p_price" required="" id="p_price" class="form-control"   placeholder="Price" >
                                                           
                                                        </div>
                                                    </div>
                                                     <div class="col-lg-2">
                                                        <div class="form-group">
                                                         
                                                            <input type="text" name="p_quantity" required="" id="p_quantity" class="form-control"  onkeyup="gettotal();" onblur="getquantityvalid();" placeholder="Quantity" >
                                                            <div><span id="errorquantity" style="color:red;"></span></div>
                                                           
                                                        </div>
                                                    </div>
                                                     <!-- <div class="col-lg-2">
                                                        <div class="form-group">
                                                          
                                                            <input type="text" name="p_discount"  id="p_discount" class="form-control"  onkeyup="gettotal();" placeholder="discount(%)">
                                                           
                                                        </div>
                                                    </div> -->
                                                     <div class="col-lg-2">
                                                        <div class="form-group">
                                                            
                                                            <input type="text" name="p_total" required="" id="p_total" class="form-control"   placeholder="Total">
                                                           
                                                        </div>
                                                    </div>
                                                   
                                                     
                                                       <div class="col-lg-2">

                                                      
                                                       <a class="btn btn-primary btn-block waves-effect waves-light" type="submit" onclick="addproducttocart();">Add</a>
                                                       
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                </div>
                                               


                                            </form>


                                           
                                                
                                            
                                      
                                               <div class="row">
                                                 <?php $ramObj->add_saleproduct(); ?>
                                                 <form action="" method="post">
                                                         <input type="hidden" name="purchasetempids" id="purchasetempids" value="<?php echo $lastinsertid;  ?>" /> 
                                                           <input type="hidden" name="merchantvaluekey" id="merchantvaluekey" value="0" /> 
                                                 <div class="col-lg-12">
                                                    
                                                    
                                              <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Product(Code)</th>
                                                    <th>A.Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="purchaseitemlist">
                                               
                                            
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-6">
                                          <div class="form-group">
                                                          
                                                            <input type="text" name="p_namesss" required="" id="countrys" class="form-control"  onkeyup="suggests(this.value);"onblur="fills();"  placeholder="Enter Member Name or code">
                                                           
                                                        </div>
                                                        <div class="suggestionsBoxs" id="suggestionss" style="display: none;opacity: 1!important;">
                                                            <div class="suggestionLists" id="suggestionsLists"> &nbsp; </div>
                                                        </div>
                                                         
                                    </div>
                                    <div class="col-lg-4">
                                         
                                                          
                                                             <button class="btn btn-primary btn-block waves-effect waves-light" name="add_saleproduct" type="submit">Submit</button>
                                                         
                                    </div>
                                    </div>
                                </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div>
                        <!-- End Page-content -->
<?php } ?>

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
     
     function getProductPrice(productName) {
        alert();
    // If the productName is not empty, make an AJAX request to get the average price
    if (productName.trim() !== '') {
        // Example AJAX request (you can use jQuery or vanilla JS fetch)
        $.ajax({
            url: 'get_average_price.php', // URL to your server-side PHP script
            type: 'POST',
            data: { product: productName }, // Send the selected product name
            success: function(response) {
                // Assuming response is the average price
                let averagePrice = response.average_price;

                // Show SweetAlert with the average price
                Swal.fire({
                    title: 'Average Price',
                    text: `The average price of ${productName} is $${averagePrice}`,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if the request fails
                Swal.fire({
                    title: 'Error',
                    text: 'Unable to fetch price data!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
}

   

         function getquantityvalid() {

             var val = document.getElementById('country').value;
              
            var val5 = document.getElementById('p_quantity').value;
              var val7 = document.getElementById('purchasetempid').value;
        
    
            $.ajax({
                type: "POST",
                url: "getvalidationofquantity.php",
                data: { p_name:val,p_quantity:val5,purchasetempid:val7},
                success: function (data) {
                  
                    if (data.trim()=="") {
                         document.getElementById('errorquantity').innerHTML = data;

                    }
                    else{



                         document.getElementById('p_quantity').value = "";
                          document.getElementById('p_total').value = "";
                           document.getElementById('errorquantity').innerHTML = data;


                    }
                   
                 

                                                          

                                                             
            }
            });

        }

     
           function gettotal() {
              
            var val = document.getElementById('p_quantity').value;
              var val1 = document.getElementById('p_price').value;

                var total1=val*val1;
                var total=total1;
                  document.getElementById('p_total').value = total;
         

        }
        function getbalance() {
            var val = parseFloat(document.getElementById('total').value) || 0;
            var val1 = parseFloat(document.getElementById('p_deposit').value) || 0;

            var total = (val - val1).toFixed(2);
            document.getElementById('p_balance').value = total;
        }

        function calculateGST() {
        var totalAmount = parseFloat(document.getElementById("p_totalamount").value) || 0;
        var gstType = document.getElementById("gst_type").value;
        var labourCharge = parseFloat(document.getElementById("labourcharge").value) || 0;
        var farecharge = parseFloat(document.getElementById("farecharge").value) || 0;
        var discount = parseFloat(document.getElementById("discount").value) || 0;
        var gstAmount = 0;
        var sgst = 0;
        var igst = 0;

        if (gstType !== "0%") {
            var gstPercentage = parseFloat(gstType.replace('%', ''));
            gstAmount = (totalAmount * gstPercentage) / 100;
            var halfGST = gstAmount / 2;

            document.getElementById("gst_fields").style.display = "table-row";
            document.getElementById("igst_row").style.display = "table-row";

            sgst = halfGST;
            igst = halfGST;

            document.getElementById("cgst").value = sgst.toFixed(2);
            document.getElementById("igst").value = igst.toFixed(2);
        } else {
            document.getElementById("gst_fields").style.display = "none";
            document.getElementById("igst_row").style.display = "none";

            document.getElementById("cgst").value = "";
            document.getElementById("igst").value = "";
        }

        var total = totalAmount + sgst + igst + labourCharge + farecharge - discount;
        document.getElementById("total").value = total.toFixed(2);
        document.getElementById("labourcharge").addEventListener("keyup", calculateGST);
        document.getElementById("farecharge").addEventListener("keyup", calculateGST);
        document.getElementById("discount").addEventListener("keyup", calculateGST);

    }


    
    let paymentCounter = 1;

function addPaymentMode() {
    paymentCounter++;
    
    let newPaymentRow = `
    <tr id="payment_section_${paymentCounter}">
        <td colspan="3"></td>
        <td>Payment Mode</td>
        <td>
            <select class="form-control payment_mode" name="payment_mode[]" id="payment_mode_${paymentCounter}" onchange="showPaymentFields(${paymentCounter});">
                <option value="" disabled selected>Select Payment Mode</option>
                <option value="cash">Cash</option>
                <option value="upi">UPI</option>
                <option value="wallet">Cheque</option>
            </select>
        </td>
        <td>
            <input type="text" name="payment_amount[]" id="payment_amount_${paymentCounter}" class="form-control payment_amount" placeholder="Enter Amount">
        </td>
        <td>
            <input type="text" name="payment_remark[]" id="payment_remark_${paymentCounter}" class="form-control payment_remark" placeholder="Enter Remark (for UPI)" style="display:none;">
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="removePaymentMode(${paymentCounter});">Remove</button>
        </td>
    </tr>
    `;

    document.querySelector('#payment_section').insertAdjacentHTML('beforebegin', newPaymentRow);
}

function showPaymentFields(counter) {
    const paymentMode = document.getElementById(`payment_mode_${counter}`).value;
    const remarkField = document.getElementById(`payment_remark_${counter}`);

    if (paymentMode === 'upi' || paymentMode === 'cash' || paymentMode === 'wallet' ) {
        remarkField.style.display = 'block'; // Show remark field for UPI
    } 
}

function removePaymentMode(counter) {
    const paymentRow = document.getElementById(`payment_section_${counter}`);
    paymentRow.remove();
}
    


        function addproducttocart() {
             var val3 = document.getElementById('purchasetempid').value;  
            var val = document.getElementById('country').value;
             var val5 = document.getElementById('p_quantity').value;
              var val1 = document.getElementById('p_price').value;
                 var val4 = document.getElementById('p_total').value;

                 if (val5>0) {

    
            $.ajax({
                type: "POST",
                url: "minusproductfromcart.php",
                data: { purchasetempid:val3,p_name:val,p_quantity:val5,p_price:val1,p_total:val4},
                success: function (data) {
                 
       document.getElementById('country').value = "";
        document.getElementById('p_quantity').value = "";
         document.getElementById('p_price').value = "";
           document.getElementById('p_total').value = "";
                                                       
                                                              
        document.getElementById('purchaseitemlist').innerHTML = data;
                
            }
            });
        }

        }


    </script>
        <script type="text/javascript">
        

          function deleteproduct(val) {
             
            $.ajax({
                type: "POST",
                url: "deleteproductsss.php",
                data: 'p_name=' + val,
                success: function (data) {
                document.getElementById('purchaseitemlist').innerHTML = data;
                                            
            }
            });

        }
    </script>
</html>