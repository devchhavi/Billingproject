<?php
$DLRreport = array();
$DLRreportCF = array();
$link = mysqli_connect('localhost', "root", "", "billing");

class ram {

    function addEpin() {
        if (isset($_REQUEST['addEpin'])) {
            $epin = $_POST['epin'];
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            $date = date('Y-m-d');
            $date2 = strtotime($date);
            $expiry_date = date("Y-m-d", strtotime("+1 month", $date2));
            if ($epin != "") {
                global $link;
                $query = "INSERT INTO `e_pin` (`epin_id`, `epin`, `epin_generate_date`, `epin_expiry_date`, `epin_status`, `epin_customstatus`, `epin_time`) VALUES (NULL, '$epin', '$date', '$expiry_date', 'Unused', 'Pending', '$time')";
                $result = mysqli_query($link, $query);
                if ($result) {
                    echo '<script>window.location.href = "generate_epin.php";</script>';
                }
            } else {
                echo '<div class="text-danger">First click on the e-pin field.</div>';
            }
        }
    }

 function addCategory() {
        if (isset($_REQUEST['addcategory'])) {
          $Category = $_POST['Category'];
            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");
            if ($Category != "") {
                global $link;
                $query = "INSERT INTO `product_category` (`Name`, `RectimeStamp`) VALUES ('$Category', '$rectimestamp')";
                $result = mysqli_query($link, $query);
                if ($result) {
                    echo '<script>window.location.href = "category.php";</script>';
                }
            } else {
                echo '<div class="text-danger">Category not successfully inserted.</div>';
            }
        }
    }
      function showCategoryList() {
        global $link;
        $query = "SELECT * FROM `product_category` order by id desc";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['Name']; ?></td>
                   
                    <td>
                      
                         <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#myModal<?php echo $i; ?>" title="Edit Category"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModald<?php echo $i; ?>" title="Delete Category"><i class="fas fa-trash"></i></button>

                     
                    </td>
                </tr>
                <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-warning">
                 <h4 class="modal-title ">Edit category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
        </div>
        <div class="modal-body">
           <form action="" method="post">
            <input type="hidden" id="Categoryid<?php echo $i;?>" name="Categoryid" value="<?php echo $row['id']; ?>">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                      
                                                        <div class="input-group">
                                                          
                                                            <input id="category<?php echo $i;?>" type="text" class="form-control" name="Category" value="<?php echo $row['Name']; ?>" placeholder="Category Name" onblur="checkcategoryss<?php echo $i ; ?>();" required="">
                                                             <div> <span id="errorOfEmail<?php echo $i;?>"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit"  name="editcategory" class="btn btn-primary btn-rounded waves-effect waves-light pl-4 pr-4">
                                                            Edit
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <div class="text-center"></div>



                                        </form>
                                        <script>
        
     

        function checkcategoryss<?php echo $i ; ?>() {
          
            var val = document.getElementById("category<?php echo $i ; ?>").value;
              var valid = document.getElementById("Categoryid<?php echo $i;?>").value;
            
   
            $.ajax({
                type: "POST",
                url: "checkcategorysss.php",
                data: {category:val,categoryid:valid},
                success: function (data) {
                 

                                                            if (data.trim()=="") {
                                                                document.getElementById('errorOfEmail<?php echo $i;?>').innerHTML = data;

                                                            } else {
                                                                document.getElementById('category<?php echo $i;?>').value = "";
                                                                document.getElementById('errorOfEmail<?php echo $i;?>').innerHTML = data;
                }
            }
            });

        }
        

    </script>

     
      </div>
       </div>
  </div></div>
     <div class="modal fade" id="myModald<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-danger">
                 <h4 class="modal-title ">Delete category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
        </div>
        <div class="modal-body">
          <p style="font-size: 25px;">Are you Sure want to delete this record.</p>
        </div>
        <div class="modal-footer">
              <form action="" method="POST"> 
                                    <input type="hidden" name="Categoryid" value="<?php echo $row['id']; ?>" />
                                    <button type="submit" name="deletecategory" class="btn btn-danger btn-rounded waves-effect waves-light pl-4 pr-4" 
                                          >Delete</button>
                                </form>
         
        </div>
      </div>
       </div>
  </div>
  
<?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function editCategory() {
        if (isset($_REQUEST['editcategory'])) {
             $Categoryid = $_POST['Categoryid'];
          $Category = $_POST['Category'];
            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");
            if ($Category != "") {
                global $link;

                  $query = "UPDATE `product_category` SET `Name`='$Category' WHERE id ='$Categoryid'";
            $result = mysqli_query($link, $query);
              
                if ($result) {
                    echo '<script>window.location.href = "category.php";</script>';
                }
            } else {
                echo '<div class="text-danger">Category not successfully updated.</div>';
            }
        }
    }
      function deleteCategory() {
        if (isset($_REQUEST['deletecategory'])) {
            $Categoryid = $_POST['Categoryid'];
            global $link;
            $query = "DELETE FROM `product_category` WHERE id=$Categoryid";
            $result = mysqli_query($link, $query);
        }
    }

    function showEpinList() {
        global $link;
        $query = "SELECT * FROM `e_pin` WHERE epin_status='Unused' ORDER BY epin_id DESC";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['epin_generate_date']; ?></td>

                    <td><?php echo $row['epin_status']; ?></td>
                    <td><?php echo $row['epin_customstatus']; ?></td>
                    <td>
                        <div class="btn-group dropleft ">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">

                                <a class="dropdown-item" href="activate_member.php?epinid=<?php echo $row['epin']; ?>">Use As Activate</a>

                            </div>
                        </div>

                        <!-- <form action="" method="POST"> 
                        <?php //if($row['epin_status'] == "Unused"){ ?>
                            <a href="activate_member.php?epinid=<?php //echo $row['epin'];            ?>" class="btn btn-action bg-purple" data-toggle="tooltip" title="Use for member activation">
                                Use-->
                                <!-- <i class="fas fa-hand-pointer"></i> -->
                        <!-- </a> -->
                        <?php //} else{ ?>
                        <!-- <b onclick="alert('Already Used');" class="btn btn-action bg-purple" data-toggle="tooltip" title="Use for member activation">
                            Use -->
                        <!-- <i class="fas fa-hand-pointer"></i> -->
                        <!-- </b> -->
                        <?php //} ?>
                    <!-- <input type="hidden" name="epinId" value="<?php //echo $row['epin_id'];            ?>" />
                    <button  type="submit" name="deleteEpin" class="btn btn-danger btn-action"
                             data-toggle="tooltip" title="Delete" 
                             onClick="return confirm('Are you sure you want to delete E-Pin ?')">
                        <i class="fas fa-trash"></i></button> </form> -->
                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteEpin() {
        if (isset($_REQUEST['deleteEpin'])) {
            $epinId = $_POST['epinId'];
            global $link;
            $query = "DELETE FROM `e_pin` WHERE epin_id=$epinId";
            $result = mysqli_query($link, $query);
        }
    }

    function showMemberList() {
        global $link;
        $query = "SELECT * FROM `members`";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['m_mobile']; ?></td>
                    <td><?php echo $row['m_email']; ?></td>
                    <td><?php echo $row['m_address']; ?></td>
                  
                 
                    <td>

                        <div class="btn-group dropleft ">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">

                                <a class="dropdown-item button-dropdown" href="member_registration.php?update_mem=<?php echo $row['m_id']; ?>">Edit</a>

                                <form action="" method="POST"> 
                                    <input type="hidden" name="memberId" value="<?php echo $row['m_id']; ?>" />
                                    <button type="submit" name="deleteMember" class="dropdown-item button-dropdown" 
                                            onClick="return confirm('Are you sure you want to delete Member ?')">Delete</button>
                                </form>
                               
                            </div>
                        </div>
                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    

    function showSupplierPurchaseList($supplier = '') {
        
        global $link;
    
        // Modify the query to filter by the selected supplier, if a supplier is selected
        $query = "SELECT * FROM `purchase_product`";
        
        // If a supplier ID is provided, add a WHERE clause to filter
        if (!empty($supplier)) {
            $query .= " WHERE Supplier = ?";
        }
    
        $stmt = mysqli_prepare($link, $query);
        
        // Bind the supplier ID parameter if filtering
        if (!empty($supplier)) {
            mysqli_stmt_bind_param($stmt, "s", $supplier);
        }
    
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['Balance'] <= 0) {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?>
                <tr style="color: <?php echo $txtColor; ?>;">
                    <td><?php echo $i; ?></td>
                    <td>P<?php echo $row['purchase_id']; ?></td>
                    <td><?php echo $row['RectimeStamp']; ?></td>
                    <td><?php echo $row['Supplier']; ?></td>
                    <td><?php echo $row['Total_Amounts']; ?></td>
                    <td><?php echo $row['Total_Amounts'] - ($row['Balance'] ?? 0); ?></td>
                    <td><?php echo $row['Balance']; ?></td>
                    <td>
                        <a href="purchaseReciept.php?accountid=<?php echo $row['purchase_id']; ?>" class="btn btn-info btn-sm">View</a>
                        <?php if ($row['Balance'] > 0) { ?>
                            <a href="addpurchasepayment.php?accountid=<?php echo $row['purchase_id']; ?>" class="btn btn-primary btn-sm">Add Payment</a>
                        <?php } else { ?>
                            <a class="btn btn-primary btn-sm">Paid</a>
                        <?php } ?>
                        <a href="viewpurchasepaymentlist.php?accountid=<?php echo $row['purchase_id']; ?>" class="btn btn-info btn-sm">View Payment</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="8" class="text-center">No Records</td></tr>';
        }
    }



      function showPurchaseList() {
        global $link;
        $query = "SELECT p.*, s.FRM 
          FROM `purchase_product` p
          LEFT JOIN `supplier` s ON p.Supplier = s.Supplier_Code";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['Balance'] <=0) {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td>
                        <?php echo $i; ?>
                    </td>
                    <td>P<?php echo $accountid=$row['purchase_id']; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($row['RectimeStamp'])); ?></td>
                    <td><?php echo $row['FRM']; ?></td>
                    <td><?php echo $row['Total_Amounts']; ?></td>
                    <?php $ResultAll = mysqli_query($link, "SELECT * FROM `purchase_payment` WHERE purchase_id='$accountid' order by id desc limit 1");
                                $rowcountall = mysqli_num_rows($ResultAll);
                                if ($rowcountall>0) {
                                    $RowAll = mysqli_fetch_array($ResultAll);
                                    $totalamount=$RowAll['Now_Dew'];
                                }
                                else{

                                $totalamount=0;

                                } ?>
                    <td><?php echo $row['Total_Amounts']-$totalamount; ?></td>
                    <td><?php echo $totalamount; ?></td>
                   
                    <td>


                        <a href="purchaseReciept.php?accountid=<?php echo $row['purchase_id']; ?>" title="View Reciept" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>
              <?php if ($row['Balance']>0) {
              ?>
               <a href="addpurchasepayment.php?accountid=<?php echo $row['purchase_id']; ?>" title="Add Payment" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus" aria-hidden="true"></i>
              </a><?php  } else{   ?>
                 <a  title="Paid" class="btn btn-primary btn-sm">
                                <i class="fas fa-circle" aria-hidden="true"></i>
              </a>
          <?php } ?>

            <a href="viewpurchasepaymentlist.php?accountid=<?php echo $row['purchase_id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>



                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

     
    function showSaleList() {
        global $link;
        $query = "SELECT * FROM `sale_product`";

        $query = "SELECT s.*, m.m_name 
          FROM `sale_product` s
          LEFT JOIN 
           members m ON s.member_id = m.m_id;";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                 $accountid=$row['sale_id'];

                   $ResultAll = mysqli_query($link, "SELECT * FROM `sale_payments` WHERE purchase_id='$accountid' order by id desc limit 1");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
     $RowAll = mysqli_fetch_array($ResultAll);
       $totalamount=$RowAll['Now_Dew'];
  }
  else{

$totalamount=0;

  } 
                if ($totalamount <=0) {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td >
                        <?php echo $i; ?>
                    </td>
                     
                    <td>S<?php echo $accountid=$row['sale_id']; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($row['RectimeStamp'])); ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                 
                    <td><?php echo $row['deposit']; ?></td>
                    <td><?php echo $row['Balance']; ?></td>
                   
                   <td>


                        <a href="saleReciept.php?accountid=<?php echo $row['sale_id']; ?>" title="View Reciept" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>
              <?php  if ($row['Franchise_Id']==0) {    ?>
               <?php if ($totalamount>0) {
              ?>
               <a href="addsalepayments.php?accountid=<?php echo $row['sale_id']; ?>" title="Add Payment" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus" aria-hidden="true"></i>
              </a><?php  } else{   ?>
                 <a  title="Paid" class="btn btn-primary btn-sm">
                                <i class="fas fa-circle" aria-hidden="true"></i>
              </a>
          <?php }
           
        } ?>

            <a href="viewsalepaymentlist.php?accountid=<?php echo $row['sale_id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>



                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }



     function showStockTransferList() {
        global $link;
        $query = "SELECT * FROM `stock_transfer_product`";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['Balance'] <=0) {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td >
                        <?php echo $i; ?>
                    </td>
                    <td>ST<?php echo $accountid=$row['sale_id']; ?></td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['Total_Amounts']; ?></td>
                   <?php $ResultAll = mysqli_query($link, "SELECT * FROM `stock_transfer_payments` WHERE purchase_id='$accountid' order by id desc limit 1");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
     $RowAll = mysqli_fetch_array($ResultAll);
       $totalamount=$RowAll['Now_Dew'];
  }
  else{

$totalamount=0;

  } ?>
                    <td><?php echo $row['Total_Amounts']-$totalamount; ?></td>
                    <td><?php echo $totalamount; ?></td>
                   
                   <td>


                        <a href="stocktransferReciept.php?accountid=<?php echo $row['sale_id']; ?>" title="View Reciept" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>
               <?php if ($row['Balance']>0) {
              ?>
               <a href="addstocktransferpayments.php?accountid=<?php echo $row['sale_id']; ?>" title="Add Payment" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus" aria-hidden="true"></i>
              </a><?php  } else{   ?>
                 <a  title="Paid" class="btn btn-primary btn-sm">
                                <i class="fas fa-circle" aria-hidden="true"></i>
              </a>
          <?php } ?>

            <a href="viewstocktransferpaymentlist.php?accountid=<?php echo $row['sale_id']; ?>" title="View Payment" class="btn btn-info btn-sm">
                                <i class="fas fa-eye" aria-hidden="true"></i>
              </a>



                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }


    function showProductStock() {
        global $link;
        // Query to calculate the total amount and total quantity for each product
        $query = "SELECT p.*, 
                         SUM(pp.product_amount * pp.Quantity) AS total_amount, 
                         SUM(pp.Quantity) AS total_quantity 
                  FROM `product` p 
                  LEFT JOIN `purchase_product_list` pp ON p.Product_Code = pp.product_id 
                  GROUP BY p.Product_Code 
                  ORDER BY p.id DESC";
        
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                // Calculate the weighted average price
                $Product_Code = $row['Product_Code'] ?? '';
                $average_price = $row['total_quantity'] > 0 
                                 ? $row['total_amount'] / $row['total_quantity'] 
                                 : 0;
                $average_price_f = number_format($average_price, 2, '.', '');

                 mysqli_query($link, "UPDATE `product` SET `average_price`=$average_price_f WHERE Product_Code='$Product_Code'");                 
    
                ?><tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $this->categorynames($row['Category']); ?></td>
                    <td><?php echo number_format($average_price, 2); ?></td>
                   
                    <td><?php echo $row['Purchase']; ?></td>
                    <td><?php echo $row['Sold']; ?></td>
                    <td><?php echo $row['Available']; ?></td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }


    function showInactiveMemberList() {
        global $link;
        $query = "SELECT * FROM `members` WHERE m_status='Inactive'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if ($row['m_status'] == "Block") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['sponsor_id']; ?></td>
                    <td><?php echo $row['sponsor_name']; ?></td>
                    <td><?php echo $row['m_mobile']; ?></td>
                    <td><?php echo $row['m_email']; ?></td>
                    <td><?php echo $row['m_epin']; ?></td>
                    <td><?php echo $row['m_status']; ?></td>
                    <td><?php echo $row['m_password']; ?></td>
                    <td>
                        <form action="" method="POST"> 
                            <input type="hidden" name="memberId" value="<?php echo $row['m_id']; ?>" />
                <!--                            <a class="btn btn-action bg-purple mr-1" data-toggle="tooltip" title="Edit"><i
                                    class="fas fa-pencil-alt"></i></a>-->
                            <button  type="submit" name="deleteMember" class="btn btn-danger btn-action"
                                     data-toggle="tooltip" title="Delete" 
                                     onClick="return confirm('Are you sure you want to delete Member ?')">
                                <i class="fas fa-trash"></i></button> </form>
                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteMember() {
        if (isset($_REQUEST['deleteMember'])) {
            $memberId = $_POST['memberId'];
            global $link;
            $query = "DELETE FROM `members` WHERE m_id=$memberId";
            $result = mysqli_query($link, $query);
            $result2 = mysqli_query($link, "DELETE FROM `active_members` WHERE member_id=$memberId");
            echo '<script>window.location.href = "member_list.php";</script>';
        }
    }

    function showWalletRequestList() {
        global $link;
        $query = "SELECT * FROM `wallet_request` WHERE status='Pending' ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['numberof_epin']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['transaction_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td> 
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="transfer_epin.php?id=<?php echo $row['id']; ?>">Transfer E-Pin</a>
                                <!--                                <a class="dropdown-item" href="#">Reject</a>-->
                                <?php $id = $row['id']; ?>
                                <button type="button" onclick="Reject_epin('<?php echo $id; ?>')" name="delete_epin_request" class="dropdown-item button-dropdown">Reject</button>
                            </div>
                        </div>
                    </td>
                </tr><?php
                $i++;
            }
        }
        usleep(1 * 1000);
        $query2 = "SELECT * FROM `wallet_request` WHERE status!='Pending' ORDER BY id DESC";
        $result2 = mysqli_query($link, $query2);
        $rowcount2 = mysqli_num_rows($result2);
        if ($rowcount2 > 0) {
            while ($row = mysqli_fetch_array($result2)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                <!--                    <td><?php
//                        $p_id = $row['product_name'];
//                        $result3 = mysqli_query($link, "SELECT * FROM `product_list` WHERE id=$p_id");
//                        $row3 = mysqli_fetch_array($result3);
//                        echo $row3['product_name'];
                    ?></td>-->
                    <td><?php echo $row['numberof_epin']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['transaction_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td> 
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                                None
                            </button>
                            <!--                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                                            <a class="dropdown-item" href="#">Reject</a>
                                                            <form method="post" action=""><input type="hidden" name="epinrequestid" value="<?php echo $row['id']; ?>" /><button type="submit" name="delete_epin_request" class="dropdown-item button-dropdown">Delete</button></form>
                                                        </div>-->
                        </div>
                    </td>
                </tr><?php
                $i++;
            }
        }
        usleep(1 * 1000);
        if ($rowcount == 0 && $rowcount2 == 0) {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteWalletRequest() {
        if (isset($_REQUEST['delete_epin_request'])) {
            $id = $_POST['epinrequestid'];
            global $link;
            $query = "DELETE FROM `wallet_request` WHERE id=$id";
            $result = mysqli_query($link, $query);
        }
    }

    function ShowValidEpinForTransfer() {
        global $link;
        $query = "SELECT * FROM `e_pin` WHERE epin_status='Unused' AND epin_customstatus='Pending'";
        $result = mysqli_query($link, $query);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            $id = "id" . $i;
            ?>
            <label for="<?php echo $id; ?>"><input type="checkbox" name="epins[]" id="<?php echo $id; ?>" value="<?php echo $row['epin']; ?>" />  <?php echo $row['epin']; ?></label>
            <?php
            $i++;
        }
    }

    function Login() {
        if (isset($_REQUEST['login'])) {
            $member_id = $_POST['member_id'];
            $password = $_POST['password'];
            global $link;
            $query = "SELECT * FROM `members` WHERE m_id='$member_id' AND m_password='$password'";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            session_start();
            if ($row['m_usertype'] == "A") {
                $_SESSION['admin_id'] = $row['m_id'];
                $_SESSION['admin_name'] = $row['m_name'];
                header("Location: admin/index.php");
                exit();
            } else {
                $_SESSION['m_id'] = $row['m_id'];
                $_SESSION['m_name'] = $row['m_name'];
                header("Location: member/index.php");
                exit();
            }
        }
    }

    function memberRecords($i) {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $query = "SELECT * FROM `members` WHERE m_id='$m_id'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $member_name = $row['m_name'];
        $member_email = $row['m_email'];
        $member_pan = $row['m_pan'];
        $member_mobile = $row['m_mobile'];
        $member_password = $row['m_password'];
        $m_state_id = $row['m_state_id'];
        usleep(1 * 1000);
        $query2 = "SELECT * FROM `states` WHERE id='$m_state_id'";
        $result2 = mysqli_query($link, $query2);
        $row2 = mysqli_fetch_array($result2);
        $m_state = $row2['name'];

        $m_city_id = $row['m_city_id'];
        usleep(1 * 1000);
        $query3 = "SELECT * FROM `cities` WHERE id='$m_city_id'";
        $result3 = mysqli_query($link, $query3);
        $row3 = mysqli_fetch_array($result3);
        $m_city = $row3['name'];

        $m_pincode = $row['m_pincode'];
        $m_address = $row['m_address'];
        $m_date = $row['m_date'];
        $m_dob = $row['m_dob'];
        $status = $row['m_status'];
        $m_photo = $row['m_photo'];
        if ($i == "name") {
            echo $member_name;
        } elseif ($i == "email") {
            echo $member_email;
        } elseif ($i == "pan") {
            echo $member_pan;
        } elseif ($i == "mobile") {
            echo $member_mobile;
        } elseif ($i == "pass") {
            echo $member_password;
        } elseif ($i == "dob") {
            echo $m_dob;
        } elseif ($i == "state") {
            echo $m_state;
        } elseif ($i == "state_id") {
            echo $m_state_id;
        } elseif ($i == "city") {
            echo $m_city;
        } elseif ($i == "city_id") {
            echo $m_city_id;
        } elseif ($i == "pincode") {
            echo $m_pincode;
        } elseif ($i == "address") {
            echo $m_address;
        } elseif ($i == "jdate") {
            echo $m_date;
        } elseif ($i == "photo") {
            echo $m_photo;
        } elseif ($i == "onlyStatus") {
            return $status;
        } elseif ($i == "status") {
            if ($status == "Active") {
                echo '<b class="text-success pr-5 pl-5 p-1" style="background-color: #e9ecef;">' . $status . '</b>';
            } elseif ($status == "Inactive") {
                echo '<b class="text-danger pr-5 pl-5" style="background-color: #e9ecef;">( ' . $status . ' )</b> &nbsp;&nbsp;';
            }
        }
        
         elseif ($i == "statuss") {
                     
                    return $status ;
                   
                }
    }

    function updateMemberRecord() {
        $m_id = $_SESSION['admin_id'];
        if (isset($_REQUEST['update_member'])) {
            $name = $_POST['m_name'];
            $email = $_POST['m_email'];
            $mobile = $_POST['m_mobile'];
            $pan = $_POST['m_pan'];
            $dob = $_POST['m_dob'];
            $state = $_POST['member_state'];
            $city = $_POST['member_city'];
            $pincode = $_POST['member_pincode'];
            $address = $_POST['member_address'];

            global $link;
            if ($_FILES['m_photo']['name'] != "") {
                $image = $_FILES['m_photo']['name'];
                $pre = date('Y-m-d-H-i-s');
                $image = $pre . "_" . $image;
                $target_path = "assets/images/users/" . $image;
                $tmp_name = $_FILES['m_photo']['tmp_name'];
                move_uploaded_file($tmp_name, $target_path);
                //rename($target_path2, "New/".basename( $_FILES["m_photo"]["name"]));
                $query = "UPDATE `members` SET `m_name`='$name',`m_mobile`='$mobile',`m_email`='$email',`m_pan`='$pan',`m_dob`='$dob',`m_state_id`='$state',`m_city_id`='$city',`m_pincode`='$pincode',`m_address`='$address',`m_photo`='$image' WHERE m_id='$m_id'";
                $result = mysqli_query($link, $query);
                usleep(1 * 1000);
                if ($result) {
                    //                echo '<script> alert("Your record has been updated!"); </script>';
                    echo '<div class="text-success"><b>Your record is updated with photo!</b></div>';
                }
            } else {
                $query = "UPDATE `members` SET `m_name`='$name',`m_mobile`='$mobile',`m_email`='$email',`m_pan`='$pan',`m_dob`='$dob',`m_state_id`='$state',`m_city_id`='$city',`m_pincode`='$pincode',`m_address`='$address' WHERE m_id='$m_id'";
                $result = mysqli_query($link, $query);
                usleep(1 * 1000);
                if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                    echo '<div class="text-success"><b>Your record has been updated!</b></div>';
                }
            }
        }
    }

    function update_mem() {
        if (isset($_REQUEST['um_member'])) {
            $id = $_POST['um_id']; 
            $name = $_POST['um_name'];
            $email = $_POST['um_email'];
            $mobile = $_POST['um_mobile'];
          
          
            $address = $_POST['um_member_address'];
           

            global $link;

            $query = "UPDATE `members` SET `m_name`='$name',`m_mobile`='$mobile',`m_email`='$email',`m_address`='$address' WHERE m_id='$id'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
                echo '<script> alert("Your record has been updated!"); </script>';
                // echo '<div class="text-success"><b>Your record has been updated!</b></div>';
                echo '<script> location.replace("member_list.php"); </script>';
            }
        }
    }
     function update_terms() {
        if (isset($_REQUEST['um_member'])) {
        
            $name = $_POST['content'];
          

            global $link;

            $query = "UPDATE `pages` SET `content`='$name' WHERE id='1'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
                echo '<script> alert("Your record has been updated!"); </script>';
                // echo '<div class="text-success"><b>Your record has been updated!</b></div>';
                echo '<script> location.replace("termsandcondition.php"); </script>';
            }
        }
    }

    function chengePassword() {
        $m_id = $_SESSION['admin_id'];
        if (isset($_REQUEST['chenge_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            global $link;
            $query = "UPDATE `members` SET `m_password`='$password' WHERE m_id='$m_id'";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>alert("Your password has been updated! Your password is ' . $password . '");</script>';
                echo '<script>window.history.go(-1);</script>';
            }
        }
    }

    function showStatesList() {
        global $link;
        $query = "SELECT * FROM `states`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php
        }
    }
      function showCategoryDropdown() {
        global $link;
        $query = "SELECT * FROM `product_category`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['Name']; ?></option>
            <?php
        }
    }
     function showCategoryDropdownselected($catid) {
        global $link;
        $query = "SELECT * FROM `product_category`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id'];?>" <?php if($row['id']==$catid) echo "selected" ; ?>><?php echo $row['Name']; ?></option>
            <?php
        }
    }

    function showWalletList() {
        $date = date('Y-m-d');
        $today_day = date('w');
        //if ($today_day == 1) {
        global $link;



        $query = "SELECT * FROM `withdrawal_request` WHERE request_status='Pending'";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['wallet_request']; ?> &#8377;</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['request_status']; ?></td>
                    <td> 
                        <div class="btn-group dropleft ">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <?php
                                $rs = $row['request_status'];
                                if ($rs == "Pending") {
                                    ?>
                                    <a class="dropdown-item" href="transfer_wallet_request.php?id=<?php echo $row['request_id']; ?>">Transfer Wallet Request</a>
                                <?php } ?>
                                <!--                                <a class="dropdown-item" href="#">Reject</a>-->
                                <?php $id = $row['request_id']; ?>
                                <button type="button" onclick="Reject_income('<?php echo $id; ?>')" name="Reject_income" class="dropdown-item button-dropdown">Reject</button>
                            </div>
                        </div>
                    </td>
                </tr><?php
                $i++;
            }
        }
        usleep(1 * 1000);
        $query2 = "SELECT * FROM `withdrawal_request` WHERE request_status='Approve'";
        $result2 = mysqli_query($link, $query2);
        $rowcount2 = mysqli_num_rows($result2);
        if ($rowcount2 > 0) {
            while ($row = mysqli_fetch_array($result2)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['total_wallet']; ?> &#8377;</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['request_status']; ?></td>
                    <td> 
                        <div class="btn-group dropleft ">
                            <button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                                None
                            </button>
                            <!--                            <div class="dropdown-menu dropleft border border-dark" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                            
                                                                                            <a class="dropdown-item" href="#">Reject</a>
                                                            <form method="post" action=""><input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>" /><button type="submit" name="delete_withdrawal_request" class="dropdown-item button-dropdown">Delete</button></form>
                                                        </div>-->
                        </div>
                    </td>
                </tr><?php
                $i++;
            }
        }

        if ($rowcount == 0 && $rowcount2 == 0) {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
//        } else {
//            echo '<tr><td colspan="6" class="p-0 text-center text-success">This list will be shown only on Monday.</td></tr>';
//        }
    }

    function showClosingStatement() {
        $date = date('Y-m-d');
        global $link;
        $query = "SELECT * FROM `monthly_closing_statement`";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['total_income']; ?></td>
                     <td><?php echo $row['Total_tds']; ?></td>
                    <td><?php echo $row['Total_processing']; ?></td>
                    <td><?php echo $row['Total_Travelling']; ?></td>
                       <td><?php echo $row['Total_Charity']; ?></td>
                        <td><?php echo $row['pv_income']; ?></td>
                       <td><?php echo $row['referal_income']; ?></td>
                   
                             
                
                    <td><?php echo $row['RectimeStamp']; ?></td>
                  
                </tr><?php
                $i++;
            }
        }

        if ($rowcount == 0) {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showClosingStatementAnnual() {
        $date = date('Y-m-d');
        global $link;
        $query = "SELECT * FROM `yearly_closing_statement`";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                     <td><?php echo $row['Point_Year']; ?></td>
                    <td><?php echo $row['total_income']; ?></td>
                     <td><?php echo $row['Total_tds']; ?></td>
                    <td><?php echo $row['Total_processing']; ?></td>
                    <td><?php echo $row['Total_Travelling']; ?></td>
                       <td><?php echo $row['Total_Charity']; ?></td>
                        <td><?php echo $row['Trip']; ?></td>
                   
                             
                
                    <td><?php echo $row['RectimeStamp']; ?></td>
                  
                </tr><?php
                $i++;
            }
        }

        if ($rowcount == 0) {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function withdrawalRequest() {
        $today_day = date('w');
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `member_income`");
        while ($row = mysqli_fetch_array($result)) {
            $member_id = $row['member_id'];
            $member_amount = $row['member_amount'];
            $member_income = $row['member_income'];
            $total_amount = $row['total_amount'];
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            $date = date('Y-m-d');

            usleep(1 * 1000);

            if ($member_income > 0) {
                $member_amount2 = $member_amount + $member_income;
                $total_amount2 = $total_amount + $member_income;
                $resultP = mysqli_query($link, "UPDATE `member_income` SET `member_amount`='$member_amount2',`total_amount`='$total_amount2' WHERE member_id='$member_id'");
            }
        }
    }

    function deleteWithdrawalRequest() {
        if (isset($_REQUEST['delete_withdrawal_request'])) {
            $id = $_POST['request_id'];
            global $link;
            $query = "DELETE FROM `withdrawal_request` WHERE request_id=$id";
            $result = mysqli_query($link, $query);
        }
    }

    function AddwalletRequest($id) {
        if (isset($_REQUEST['transfer_withdrawal'])) {
            $today_day = date('w');
            $transaction_id = $_POST['transaction_id'];

            global $link;
            $query = "UPDATE `withdrawal_request` SET `request_status`='Approve' WHERE request_id=$id";
            $result = mysqli_query($link, $query);

            usleep(1 * 1000);

            $result2 = mysqli_query($link, "SELECT * FROM `withdrawal_request` WHERE request_id=$id");
            $row = mysqli_fetch_array($result2);
            $member_id = $row['member_id'];
            $wallet_request = $row['wallet_request'];
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            $date = date('Y-m-d');
            // $tds = ($wallet_request * 15) / 100;
            // $final_amount = $wallet_request - $tds;


            $result3 = mysqli_query($link, "INSERT INTO `withdrawal_tds` (`tds_id`, `request_id`, `member_id`, `wallet_request_amount`, `transaction_id`, `date`, `time`) VALUES (NULL, '$id', '$member_id', '$wallet_request', '$transaction_id', '$date', '$time')");

            // usleep(1 * 1000);
            // $result4 = mysqli_query($link, "SELECT * FROM `member_income` WHERE member_id=$member_id");
            // $row4 = mysqli_fetch_array($result4);
            // $member_amount = $row4['member_amount'];
            // $newMember_amount = $member_amount - $wallet_request;
            // $result5 = mysqli_query($link, "UPDATE `member_income` SET `member_amount` = '$newMember_amount' WHERE `member_id` = $member_id");

            if ($result3) {
                echo '<div class="text-success"><b>Your wallet has been transferred successfully!</b></div>';
                echo '<script>window.location.href = "matching_income.php";</script>';
            }
        }
    }

    function addProduct() {
        if (isset($_REQUEST['add_product'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_category = $_POST['product_category'];
            $product_price = $_POST['product_price'];
            $date = date('Y-m-d');

            global $link;
            $query = "INSERT INTO `product_list` (`id`, `product_id`, `product_name`, `product_category`, `product_price`, `date`) VALUES (NULL, '$product_id', '$product_name', '$product_category', '$product_price', '$date')";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<div class="text-success"><b>Your product has been successfully added!</b></div>';
            }
        } elseif (isset($_REQUEST['update_product'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_category = $_POST['product_category'];
            $product_price = $_POST['product_price'];
            $date = date('Y-m-d');

            global $link;
            $query = "UPDATE `product_list` SET `product_name`='$product_name',`product_category`='$product_category',`product_price`='$product_price',`date`='$date' WHERE id='$product_id'";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<div class="text-success"><b>Your product has been successfully updated!</b></div>';
            }
        }
    }

    function showProductList() {
        global $link;
        $query = "SELECT * FROM `product_list`";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);

        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_category']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <td class="text-center">
                        <form action="" method="POST" class="float-right"> 
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                            <button  type="submit" name="deleteProduct" class="btn btn-danger btn-action"
                                     data-toggle="tooltip" title="Delete" 
                                     onClick="return confirm('Are you sure you want to delete the product?')">
                                <i class="fas fa-trash"></i></button> </form>
                        <a href="add_new_product.php?id=<?php echo $row['id']; ?>" class="float-right"><button name="edit" data-toggle="tooltip" title="Edit" class="btn btn-success btn-action"><i class="fas fa-edit"></i></button></a>

                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteProduct() {
        if (isset($_REQUEST['deleteProduct'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `product_list` WHERE id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "product_record.php";</script>';
                echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function showMatchingPaidHistory() {
        global $link;
        $query = "SELECT * FROM `withdrawal_request` where request_status='Approve'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['wallet_request']; ?> &#8377;</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                <!--                    <td>

                        <form action="" method="POST"> 
                            <input type="hidden" name="id" value="<?php echo $row['request_id']; ?>" />
                            <button  type="submit" name="deleteWithdrawalRequest" class="btn btn-danger btn-action"
                                     data-toggle="tooltip" title="Delete" 
                                     onClick="return confirm('Are you sure you want to delete Request?')">
                                <i class="fas fa-trash"></i></button> </form>
                    </td>-->
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="7" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showWalletEpinHistory() {
        global $link;
        $query = "SELECT * FROM `members` WHERE m_status = 'Active' ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['m_epin']; ?></td>
                    <td><?php echo $row['sponsor_id'] . '(' . $row['sponsor_name']; ?>)</td>
                    <td><?php echo $row['activation_date']; ?></td>

                                                                                                                                                                                                                                <!--                    <td>

                                                                                                                                                                                                                                     <form action="" method="POST"> 
                                                                                                                                                                                                                                         <input type="hidden" name="id" value="<?php // echo $row['id'];               ?>" />
                                                                                                                                                                                                                                         <button  type="submit" name="deleteWalletEpin" class="btn btn-danger btn-action"
                                                                                                                                                                                                                                                  data-toggle="tooltip" title="Delete" 
                                                                                                                                                                                                                                                  onClick="return confirm('Are you sure you want to delete Request?')">
                                                                                                                                                                                                                                             <i class="fas fa-trash"></i></button> </form>
                                                                                                                                                                                                                                 </td>-->
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteWalletEpin() {
        if (isset($_REQUEST['deleteWalletEpin'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `epin_report` WHERE id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "wallet_transfer_history.php";</script>';
                //echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function showTdsList() {
        global $link;
        $query = "SELECT * FROM `closing_statement` ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['member_id']; ?></td>
                    <?php
                    $m_id = $row['member_id'];
                    $result2 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$m_id");
                    $row2 = mysqli_fetch_array($result2);
                    $member_name = $row2['m_name'];
                    ?>
                    <td><?php echo $member_name; ?></td>
                    <td><?php echo number_format($row['total_income'], 1); ?> &#8377;</td>
                    <td><?php echo number_format($row['tds_amount'], 1); ?> &#8377;</td>
                    <td><?php echo number_format($row['available_amount'], 1); ?> &#8377;</td>
                    <td><?php echo $row['date_time']; ?></td>
                <!--                    <td>

                        <form action="" method="POST"> 
                            <input type="hidden" name="id" value="<?php //echo $row['tds_id'];             ?>" />
                            <button  type="submit" name="deleteTds" class="btn btn-danger btn-action"
                                     data-toggle="tooltip" title="Delete" 
                                     onClick="return confirm('Are you sure you want to delete?')">
                                <i class="fas fa-trash"></i></button> </form>
                    </td>-->
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="10" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteTdsReport() {
        if (isset($_REQUEST['deleteTds'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `withdrawal_tds` WHERE tds_id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "tds_report.php";</script>';
                //echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function showProducts() {
        global $link;
        $query = "SELECT * FROM `product_list`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?></option>
            <?php
        }
    }

    function addPurchaseProduct() {
        if (isset($_REQUEST['purchase_product'])) {
            $product_id = $_POST['product'];
            $purchase_product_amount = $_POST['amount'];
            //$date = $_POST['date'];
            $product_quantity = $_POST['quantity'];
            $date = date('Y-m-d');

            global $link;

            $resultPA = mysqli_query($link, "SELECT * FROM `product_list` WHERE id=$product_id");
            $rowPA = mysqli_fetch_array($resultPA);
            $product_amount = $rowPA['product_price'];



            $total_amount = $product_quantity * $product_amount;
            $purchase_total_amount = $product_quantity * $purchase_product_amount;

            $resultPurchase = mysqli_query($link, "INSERT INTO `purchase_product` (`purchase_id`, `product_id`, `product_amount`, `product_quantity`, `total_amount`, `date`) VALUES (NULL, '$product_id', '$purchase_product_amount', '$product_quantity', '$purchase_total_amount', '$date')");


            usleep(5 * 1000);

            $result1 = mysqli_query($link, "SELECT * FROM `purchase_product` ORDER BY purchase_id DESC LIMIT 1");
            $row1 = mysqli_fetch_array($result1);
            $purchase_id = $row1['purchase_id'];
            $product_quantity = $row1['product_quantity'];
            for ($i = 0; $i < $product_quantity; $i++) {
                mysqli_query($link, "INSERT INTO `purchase_product_list` (`purchase_list_id`, `purchase_id`, `product_id`, `product_amount`, `sale_amount`, `status`, `date`) VALUES (NULL, '$purchase_id', '$product_id', '$purchase_product_amount', '$product_amount', 'Pending', '$date')");
            }


            usleep(1 * 1000);
            $result = mysqli_query($link, "SELECT * FROM `product_stock` WHERE product_id=$product_id");
            $rowNum = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
            if ($rowNum > 0) {
                $pre_quantity = $row['product_quantity'];

                $product_quantity = $pre_quantity + $product_quantity;
                $total_amount = $product_quantity * $product_amount;
                $query2 = "UPDATE `product_stock` SET `product_amount`='$product_amount',`product_quantity`='$product_quantity',`total_amount`='$total_amount',`date`='$date' WHERE product_id=$product_id";
                $result2 = mysqli_query($link, $query2);
                usleep(1 * 1000);
                if ($result2) {
                    echo '<div class="text-success"><b>Your product has been successfully added!</b></div>';
                }
            } else {
                $query3 = "INSERT INTO `product_stock` (`stock_id`, `product_id`, `product_amount`, `product_quantity`, `total_amount`, `date`) VALUES (NULL, '$product_id', '$product_amount', '$product_quantity', '$total_amount', '$date')";
                $result3 = mysqli_query($link, $query3);
                usleep(1 * 1000);
                if ($result3) {
                    echo '<div class="text-success"><b>Your product has been successfully added!</b></div>';
                }
            }
        }
    }

    function showPurchaseProduct() {
        global $link;
        $query = "SELECT * FROM `purchase_product` ORDER BY purchase_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <?php
                    $product_id = $row['product_id'];
                    $result2 = mysqli_query($link, "SELECT * FROM `product_list` WHERE id=$product_id");
                    $row2 = mysqli_fetch_array($result2);
                    $product_name = $row2['product_name'];
                    ?>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $row['product_amount']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td>

                        <form action="" method="POST"> 
                            <input type="hidden" name="id" value="<?php echo $row['purchase_id']; ?>" />
                            <button  type="submit" name="deletePurchaseProduct" class="btn btn-danger btn-action"
                                     data-toggle="tooltip" title="Delete" 
                                     onClick="return confirm('Are you sure you want to delete?')">
                                <i class="fas fa-trash"></i></button> </form>
                    </td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deletePurchaseReport() {
        if (isset($_REQUEST['deletePurchaseProduct'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `purchase_product` WHERE purchase_id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "purchase_report.php";</script>';
                //echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function showSaleReport() {
        global $link;
        $query = "SELECT * FROM `withdrawal_request` WHERE request_status='Approve' ORDER BY request_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php
                        echo $row['wallet_request'];
                        ?></td>
                    <!--<td><?php //echo $row['transaction_id']; ?></td>-->
                    <td><?php echo $row['date']; ?></td>


                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteSaleReport() {
        if (isset($_REQUEST['deleteSaleReport'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `sale_product` WHERE sale_id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "sale_report.php";</script>';
                //echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function showStockReport() {
        global $link;
        $query = "SELECT * FROM `withdrawal_request` WHERE request_status='Reject' ORDER BY request_id DESC";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_name'] . ' (' . $row['member_id']; ?>)</td>
                    <td><?php echo number_format($row['wallet_request'], 1); ?> &#8377;</td>

                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function deleteStockReport() {
        if (isset($_REQUEST['deleteStockProduct'])) {
            $id = $_POST['id'];
            global $link;
            $query = "DELETE FROM `product_stock` WHERE stock_id=$id";
            $result = mysqli_query($link, $query);
            if ($result) {
                echo '<script>window.location.href = "stock_report.php";</script>';
                //echo '<div class="text-success"><b>Your product has been successfully deleted.</b></div>';
            }
        }
    }

    function homepageDetails($i) {
        $m_id = $_SESSION['admin_id'];
        $date = date('Y-m-d');
        global $link;

        $resultMI = mysqli_query($link, "SELECT SUM(`referral_income`), SUM(`singleleg_income`), SUM(`royalty_income`), SUM(`franchise_income`), SUM(`total_income`) FROM `closing_statement` ");
        $rowMI = mysqli_fetch_row($resultMI);
        $resultMMI = mysqli_query($link, "SELECT SUM(`Total_wallet`), SUM(`Paid_Wallet`), SUM(`Paid_Income`), SUM(`Total_tds`), SUM(`total_income`), SUM(`Total_processing`), SUM(`Total_Travelling`), SUM(`Total_Charity`), SUM(`month_BP`) FROM `members` ");
        $rowMMI = mysqli_fetch_row($resultMMI);

         $resultMMp = mysqli_query($link, "SELECT SUM(`Total_Amounts`) FROM `purchase_product` ");
        $rowMMp = mysqli_fetch_row($resultMMp);
          $resultMMs = mysqli_query($link, "SELECT SUM(`Total_Amounts`) FROM `sale_product` ");
        $rowMMs = mysqli_fetch_row($resultMMs);

        $resultMMIm = mysqli_query($link, "SELECT * FROM `members` ");
        $rownum = mysqli_num_rows($resultMMIm);
        $lj=1;
        $totalmerchantvalues=0;
        if($rownum>0){
        while ($rowMMIm = mysqli_fetch_array($resultMMIm)) {

             $paidwalletm=$rowMMIm['Paid_Wallet'];

            if(($rowMMIm['Paid_Wallet'])>=6000){

                         $merchantvalue=((($rowMMIm['Total_wallet'])*10)/100);

                    }
                    else{
                        $diff=6000-$rowMMIm['Paid_Wallet'];
                         if( ((($rowMMIm['Total_wallet']-$diff)*10)/100)<0)  $merchantvalue=0;
                         else{

                             $merchantvalue=((($rowMMIm['Total_wallet']-$diff)*10)/100);
                         }


                    }

                    $totalmerchantvalues=$totalmerchantvalues+$merchantvalue;

                    $lj++;
           
        }
    }


     if ($i == "total_member") {
            echo $rownum;
        }


        if ($i == "totalpurchase") {
            $purchase = $rowMMp[0];
            echo number_format($purchase, 2);
        } elseif ($i == "totalsale") {
            $totalsale = $rowMMs[0];
            echo number_format($totalsale, 2);
        }  elseif ($i == "monthbp") {
            $totalsale = $rowMMI[8];
            echo $totalsale;
        }elseif ($i == "walletamounts") {
            $walletamounts = $rowMMI[0] ;
            echo number_format($walletamounts, 2);
        } elseif ($i == "tdsvalue") {
            $tdsvalue = $rowMMI[3];
            echo number_format($tdsvalue, 2);
        } elseif ($i == "processingfee") {
            $processingfee =$rowMMI[5];
            echo number_format($processingfee, 2);
        } elseif ($i == "travellingamount") {
            $processingfee =$rowMMI[6];
            echo number_format($processingfee, 2);
        }elseif ($i == "charityamount") {
            $processingfee =$rowMMI[7];
            echo number_format($processingfee, 2);
        }elseif ($i == "paidwalletamount") {
            $paidwalletamount = $rowMMI[1];
            echo number_format($paidwalletamount, 1);
        } elseif ($i == "paidpayable") {
            $paidpayable =$rowMMI[2];
            echo number_format($paidpayable, 2);
        } elseif ($i == "paidmerchant") {
            $paidmerchant = $rowMMI[3];
            echo number_format($paidmerchant, 2);
        } elseif ($i == "merchantvalues") {
            $merchantvalues = $totalmerchantvalues;
            echo number_format($merchantvalues, 2);
        } elseif ($i == "paybleamounts") {
           $paybleamounts = $rowMMI[4];
            echo number_format($paybleamounts, 2);
        } elseif ($i == "today_joining_member") {
            $query = "SELECT * FROM `members`where m_date='$date'";
            $result = mysqli_query($link, $query);
            $today_member = 0;
            while ($row = mysqli_fetch_array($result)) {
                $today_member++;
            }
            echo $today_member;
        }  //elseif ($i == "total_matching_income") {
            //$query = "SELECT * FROM `member_income`";
            //$result = mysqli_query($link, $query);
            //$total_matching_income = 0;
            //while ($row = mysqli_fetch_array($result)) {
                //$total_matching_income = $total_matching_income + $row['total_amount'];
            //}
            //echo number_format($total_matching_income, 1);
       // } //elseif ($i == "company_turnover") {
            // $query = "SELECT sum(total_income) FROM `closing_statement` where id!=1";
            // $result = mysqli_query($link, $query);
            // $wallet_request = 0;
            // $row = mysqli_fetch_row($result);
            // $closing_amount = $row[0];

           // $query2 = "SELECT * FROM `members` WHERE m_status='Active'";
           // $result2 = mysqli_query($link, $query2);
            //$income = mysqli_num_rows($result2);
           // $total_company_turnover = $income * 499;

            //echo number_format($total_company_turnover, 1);
        //} //elseif ($i == "company_profit") {
            //$query = "SELECT sum(total_income) FROM `closing_statement` where id!=1";
            //$result = mysqli_query($link, $query);
            //$wallet_request = 0;
            ///$row = mysqli_fetch_row($result);
           // $closing_amount = $row[0];

           // $query2 = "SELECT * FROM `members` WHERE m_status='Active'";
           // $result2 = mysqli_query($link, $query2);
           // $income = mysqli_num_rows($result2);
            //$income = $income * 499;

           // usleep(1 * 1000);
            //$total_company_profit = $income - $closing_amount;
            //echo number_format($total_company_profit, 1);
        //}
    }

     function sendlevelcountuptolevel($sponsor_id1,$levelcount1){

    global $link;


     $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id  ='$sponsor_id1'");


     $RowAllss = mysqli_fetch_array($ResultAllss);
      $sponsor_id=$RowAllss['sponsor_id'];
      $Level_1_C=$RowAllss['Level_1_C'];
       $Level_2_C=$RowAllss['Level_2_C'];
        $Level_3_C=$RowAllss['Level_3_C'];
         $Level_4_C=$RowAllss['Level_4_C'];
          $Level_5_C=$RowAllss['Level_5_C'];
           $Level_6_C=$RowAllss['Level_6_C'];
            $Level_7_C=$RowAllss['Level_7_C'];
             $Level_8_C=$RowAllss['Level_8_C'];
              $Level_9_C=$RowAllss['Level_9_C'];
               $Level_10_C=$RowAllss['Level_10_C'];
     if ($levelcount1==1) {
          $Level_1_C= $Level_1_C+1;
     }
     if ($levelcount1==2) {
          $Level_2_C= $Level_2_C+1;
     }
     if ($levelcount1==3) {
          $Level_3_C= $Level_3_C+1;
     }
     if ($levelcount1==4) {
          $Level_4_C= $Level_4_C+1;
     }
     if ($levelcount1==5) {
          $Level_5_C= $Level_5_C+1;
     }
     if ($levelcount1==6) {
          $Level_6_C= $Level_6_C+1;
     }
     if ($levelcount1==7) {
          $Level_7_C= $Level_7_C+1;
     }
     if ($levelcount1==8) {
          $Level_8_C= $Level_8_C+1;
     }
     if ($levelcount1==9) {
          $Level_9_C= $Level_9_C+1;
     }
       if ($levelcount1==10) {
          $Level_10_C= $Level_10_C+1;
     }


       mysqli_query($link, "UPDATE `members` SET `Level_1_C`='$Level_1_C', `Level_2_C`='$Level_2_C', `Level_3_C`='$Level_3_C', `Level_4_C`='$Level_4_C', `Level_5_C`='$Level_5_C', `Level_6_C`='$Level_6_C', `Level_7_C`='$Level_7_C', `Level_8_C`='$Level_8_C', `Level_9_C`='$Level_9_C', `Level_10_C`='$Level_10_C' WHERE m_id  ='$sponsor_id1'");


     if ($sponsor_id=="") {
        
     }
     else{
        $levelcount=$levelcount1+1;
          $this->sendlevelcountuptolevel($sponsor_id,$levelcount);
     }
   
 }
   
    function sponsorplacement($sponsor_id1,$placement_id1){

    global $link;


     $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id  ='$placement_id1'");


     $RowAllss = mysqli_fetch_array($ResultAllss);
      $sponsor_id=$RowAllss['placement_id'];
     $placement=$RowAllss['placement'];
      if ($sponsor_id==$sponsor_id1) {
         
         return $placement;
      }
      else{

       $sponsorplacement=$this->sponsorplacement($sponsor_id1,$sponsor_id);

      }
      return $sponsorplacement;
     
   
 }

 function add_customer() {
    global $link;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $m_name = $_POST['m_name'] ?? '';
        $m_mobile = $_POST['m_mobile'] ?? '';
        $m_email = $_POST['m_email'] ?? '';
        $m_address = $_POST['m_address'] ?? '';
        $m_photo = "user_male.jpg";

        // Insert the new member
        $query = "INSERT INTO `members` (`id`, `m_name`, `m_mobile`, `m_email`, `m_address`,`m_photo`) VALUES (NULL, '$m_name', '$m_mobile', '$m_email','$m_address', '$m_photo')";
        $result = mysqli_query($link, $query);

        if ($result) {
            // Get last inserted ID
            $lastinsertid = mysqli_insert_id($link);

            // Generate custom member ID
            if (($lastinsertid / 10) < 1) {
                $genid = '90000' . $lastinsertid;
            } elseif (($lastinsertid / 100) < 1) {
                $genid = '9000' . $lastinsertid;
            } elseif (($lastinsertid / 1000) < 1) {
                $genid = '900' . $lastinsertid;
            } elseif (($lastinsertid / 10000) < 1) {
                $genid = '90' . $lastinsertid;
            } elseif (($lastinsertid / 100000) < 1) {
                $genid = '9' . $lastinsertid;
            } else {
                $genid = $lastinsertid;
            }

            // Update member with generated ID
            mysqli_query($link, "UPDATE `members` SET `m_id`='$genid' WHERE id =$lastinsertid");

            // Redirect to avoid form resubmission
            echo "<script>alert('Customer added successfully with ID: $genid');</script>";
           
        } else {
            // Handle error if query failed
            echo "<script>alert('Error adding customer.');</script>";
        }
    }
}

    function add_member() {

        if (isset($_REQUEST['add_member'])) {
//            $m_id = $_POST['member_id'];
//            $epin = $_POST['m_epin'];
//            $page_name = $_POST['page_name'];
            global $link;

           
          
            $page_name = $_POST['page_name'];
            $m_name = $_POST['m_name'];
            $m_mobile = $_POST['m_mobile'];
            $m_email = $_POST['m_email'];
           
//            $member_gender = $_POST['member_gender'];
//            if ($member_gender == "Male") {
            $m_photo = "user_male.jpg";
//            } else {
//                $m_photo = "user_female.jpg";
//            }
//            $member_state = $_POST['member_state'];
//            $member_city = $_POST['member_city'];
//            $member_pincode = $_POST['member_pincode'];
//            $member_address = $_POST['member_address'];
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            $datetime = date('Y-m-d, H:i:s');
            $block_date = date("Y-m-d", strtotime('+72 hours'));

            if ($sponsor_id==$placement_id) {

               $sponsorplacement=$placement;

            }
            else{

                   $sponsorplacement=$this->sponsorplacement($sponsor_id,$placement_id);

            }

           

//           

            $query = "INSERT INTO `members` (`id`, `m_id`, `sponsor_id`,  `sponsor_name`, `m_name`, `m_mobile`, `m_email`, `m_password`, `m_usertype`, `m_status`, `m_photo`, `m_date`, `m_time`, `block_date`, `placement`, `date_pv_matching`, `placement_id`, `sponsor_placement`) VALUES (NULL, '$atrandam_member_id', '$sponsor_id', '$sponsor_name', '$m_name', '$m_mobile', '$m_email', '$password', 'M', 'Inactive', '$m_photo', '$date', '$time', '$block_date', '$placement', '$date', '$placement_id', '$sponsorplacement')";
            $result = mysqli_query($link, $query);
             $lastinsertid=mysqli_insert_id($link);
                    if (($lastinsertid/10)<1) {
                        $genid='90000'.$lastinsertid;
                    }
                     elseif (($lastinsertid/100)<1) {
                        $genid='9000'.$lastinsertid;
                    }
                     elseif (($lastinsertid/1000)<1) {
                        $genid='900'.$lastinsertid;
                    }
                     elseif (($lastinsertid/10000)<1) {
                        $genid='90'.$lastinsertid;
                    }
                     elseif (($lastinsertid/100000)<1) {
                        $genid='9'.$lastinsertid;
                    }
                     else{

                        $genid=$lastinsertid;
                    }
                    $resultDDL = mysqli_query($link, "SELECT * FROM `members` WHERE m_id  ='$genid'");
                 $rowcountDDL = mysqli_num_rows($resultDDL);
                 if ($rowcountDDL>0) {
                     $RowAlls = mysqli_fetch_array($resultDDL);
                     $uid=$RowAlls['id'];

                       if (($uid/10)<1) {
                        $genid='90000'.$uid;
                    }
                     elseif (($uid/100)<1) {
                        $genid='9000'.$uid;
                    }
                     elseif (($uid/1000)<1) {
                        $genid='900'.$uid;
                    }
                     elseif (($uid/10000)<1) {
                        $genid='90'.$uid;
                    }
                     elseif (($uid/100000)<1) {
                        $genid='9'.$uid;
                    }
                     else {
                        $genid=$uid;
                    }
                 }
             mysqli_query($link, "UPDATE `members` SET `m_id`='$genid' WHERE id =$lastinsertid");
              $levelcount=1;
             $this->sendlevelcountuptolevel($sponsor_id,$levelcount);
            usleep(1 * 1000);
            if ($result) {
                
               // $message = urlencode('Welcome to vasta marketing pvt ltd. Registered ID:' . $genid . ',Password:'.$password.'Sponsor ID:'.$sponsor_id.' Web : http://vastamarketing.in/');
               // $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . "";
               //$url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
// create a new cURL resource
                  $ch = curl_init();
// set URL and other appropriate options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
                curl_exec($ch);
//
//// close cURL resource, and free up system resources
                curl_close($ch);
                
                
                // echo '<script> alert("Your registration has been successfully completed. Your ID = ' . $genid . ' Password = ' . $password . '"); </script>';
                // echo '<script>window.location.href = "' . $page_name . '";</script>';
//                
            } else {
               // echo '<script> alert("Your registration has failed. Please try again."); </script>';
            }
//            echo '<script>window.location.href = "' . $page_name . '.php";</script>';
        }
    }

function add_product() {

        if (isset($_REQUEST['add_product'])) {       
            global $link;
            $p_name = $_POST['p_name'];
            $category = $_POST['category'];
            $unit = $_POST['unit'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");

            $query = "INSERT INTO `product` (`id`, `Name`, `Category`, `unit`, `RectimeStamp`) VALUES (NULL, '$p_name', '$category', ' $unit', '$rectimestamp')";
            $result = mysqli_query($link, $query);
              $lastinsertid=mysqli_insert_id($link);
                    if (($lastinsertid/10)<1) {
                        $genid='P'.'000'.$lastinsertid;
                    }
                     elseif (($lastinsertid/100)<1) {
                        $genid='P'.'00'.$lastinsertid;
                    }
                     elseif (($lastinsertid/1000)<1) {
                        $genid='P'.'0'.$lastinsertid;
                    }
                     else {
                       $genid='P'.$lastinsertid;
                    }
                     mysqli_query($link, "UPDATE `product` SET `Product_Code`='$genid' WHERE id ='$lastinsertid'");
                    
            usleep(1 * 1000);
            if ($result) {

             
                
                
                echo '<script> alert("Product Added Successfully"); </script>';
                echo '<script>window.location.href = "product.php";</script>';
//                
            } else {
                echo '<script> alert("Product not successfully inserted."); </script>';
            }

        }
    }

    function add_purchaseproduct() {

        if (isset($_REQUEST['add_purchaseproduct'])) {
         
            global $link;
            $purchasetempids = $_POST['purchasetempids'];
            $p_namesss = $_POST['p_namesss'];
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         
            $query = "INSERT INTO `purchase_product` (`purchase_id`, `Purchase_temp_id`, `Total_Amounts`, `Discount`, `Balance`,`Supplier`, `RectimeStamp`) VALUES (NULL, '$purchasetempids', '$p_totalamount', ' $p_deposit', '$p_balance','$p_namesss', '$rectimestamp')";
            $result = mysqli_query($link, $query);
              $lastinsertid=mysqli_insert_id($link);

            $query = "INSERT INTO `purchase_payment` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`) VALUES (NULL, '$lastinsertid', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp')";
            $result = mysqli_query($link, $query);


        $resultDL = mysqli_query($link, "SELECT * FROM `purchase_product_list` WHERE purchase_id='$purchasetempids'");
        $rowcountDL = mysqli_num_rows($resultDL);
        if ($rowcountDL>0) {
           $i=1;
           while ($row = mysqli_fetch_array($resultDL)) {
           

                $p_name=$row['product_id'];
                $p_quantity=$row['Quantity'];
                $purchase_product_amount=$row['product_amount'];
            
           

             mysqli_query($link, "UPDATE `product` SET `Available`=Available+$p_quantity,`Purchase`=Purchase+$p_quantity WHERE Product_Code='$p_name'");
             mysqli_query($link, "UPDATE `purchase_product_list` SET `status`='1' WHERE purchase_id='$purchasetempids'");
             $i++;
             
           }
        }

      
                    
            usleep(1 * 1000);
            if ($result) {

             
                echo '<script> alert("Purchase Added Successfully"); </script>';
                echo '<script>window.location.href = "purchase.php";</script>';
//                
            } else {
                echo '<script> alert("Purchase not successfully inserted."); </script>';
            }

        }
    }

      function add_purchaseproductpayment() {

        if (isset($_REQUEST['add_purchaseproductpayment'])) {
//         
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
          
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         

//           

           

              $query = "INSERT INTO `purchase_payment` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`) VALUES (NULL, '$purchasetempids', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp')";
            $result = mysqli_query($link, $query);
                  
                     
                    
                   
                    
            usleep(1 * 1000);
            if ($result) {

             
                
                
                echo '<script> alert("Payment Added Successfully"); </script>';
                echo '<script>window.location.href = "supplierpurchaselist.php";</script>';
//                
            } else {
                echo '<script> alert("Payment not successfully inserted."); </script>';
            }

        }
    }


   

    function sendreferralincome($sponsorid1,$levelcount1,$totalwallet1,$Closing_Date){

    global $link;


     $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$sponsorid1'");

    $RowAllss = mysqli_fetch_array($ResultAllss);


    $sponsorid=$RowAllss['sponsor_id'];

     $ResultAllsss = mysqli_query($link, "SELECT * FROM `monthly_closing_statement` WHERE member_id ='$sponsorid1' and Closing_Date='$Closing_Date' ");

    $RowAllsss = mysqli_fetch_array($ResultAllsss);
   $referral_income=$RowAllsss['referal_income'];
 

    if ($levelcount1==1) {
        
        $referral_income=$referral_income+($totalwallet1*4)/100;
        
    }
     if ($levelcount1==2) {
         $memberonlevel2=$RowAllss['Level_2_C'];
    
        if ($memberonlevel2>=4) {
            $referral_income=$referral_income+($totalwallet1*5)/100;
        }

        
        
    }
     if ($levelcount1==3) {
         $memberonlevel4=$RowAllss['Level_3_C'];
    
        if ($memberonlevel4>=16) {
            $referral_income=$referral_income+($totalwallet1*4)/100;
        }

        
        
    }
     if ($levelcount1==4) {
         $memberonlevel6=$RowAllss['Level_4_C'];
    
        if ($memberonlevel6>=64) {
            $referral_income=$referral_income+($totalwallet1*5)/100;
        }

        
        
    }
     if ($levelcount1==5) {
         $memberonlevel8=$RowAllss['Level_5_C'];
    
        if ($memberonlevel8>=256) {
            $referral_income=$referral_income+($totalwallet1*4)/100;
        }

        
        
    }
     if ($levelcount1==6) {
         $memberonlevel10=$RowAllss['Level_6_C'];
    
        if ($memberonlevel10>=1024) {
            $referral_income=$referral_income+($totalwallet1*5)/100;
        }

        
        
    }


      $results = mysqli_query($link, "UPDATE `monthly_closing_statement` SET `referal_income`='$referral_income' WHERE member_id='$sponsorid1' and Closing_Date='$Closing_Date'");


    if ($sponsorid==""||$levelcount1==6) {
       
    }
    else{
        $levelcount=$levelcount1+1;
        $totalwallet=$totalwallet1;

        $this->sendreferralincome($sponsorid,$levelcount,$totalwallet,$Closing_Date);
    }



    }

    function senduptolevel($p_namesss,$uplevelpv1,$uplevelbp1,$placement1,$memberrank1)
    {


   global $link;


         $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$p_namesss'");

            $RowAllss = mysqli_fetch_array($ResultAllss);
            
              $leftpv=$RowAllss['left_PV'];
              $rightpv=$RowAllss['right_PV'];
               $leftpvdaily=$RowAllss['Left_PV_Daily'];
              $rightpvdaily=$RowAllss['Right_PV_Daily'];
            $dailymaxpvmatching=$RowAllss['Daily_Max_Pv_Matching'];
             $totalpvmatching=$RowAllss['Total_Pv_Matching'];
              $dailypvmatching=$RowAllss['Daily_pv_matching'];
               $monthpvmatching=$RowAllss['month_pv_matching'];
              $accumulationbp=$RowAllss['Accumulation_BP'];
                $accumulationbpmonth=$RowAllss['Accumulation_BP_Month'];
               $leftbp=$RowAllss['Left_BP'];
              $rightbp=$RowAllss['Right_BP'];
               $leftbpforpoint=$RowAllss['Left_BP_For_Point'];
              $rightbpforpoint=$RowAllss['Right_BP_For_Point'];
               $totalpoint=$RowAllss['Total_Point'];
                $yearpoint=$RowAllss['Point_Year'];
               $sponserid=$RowAllss['sponsor_id'];
              $placement=$RowAllss['sponsor_placement'];
               $status=$RowAllss['m_status'];
                $datepvmatching=$RowAllss['date_pv_matching'];
                $memberrank=$RowAllss['member_rank'];
                 $memberranks=$RowAllss['member_rank'];
                $leftmonthbp=$RowAllss['left_month_bp'];
                $rightmonthbp=$RowAllss['right_month_bp'];
                 $incomemonth=$RowAllss['income_month'];
                  $sponserid=$RowAllss['sponsor_id'];
                  $totalbp=$uplevelbp1;
                $accumulationbp=$accumulationbp+$uplevelbp1;
                $accumulationbpmonth=$accumulationbpmonth+$uplevelbp1;


                if ($placement1=="Left") {   

                    
                      $leftbp= $leftbp+$uplevelbp1;
                     
                      $leftmonthbp=$leftmonthbp+$uplevelbp1;
                }
                else{
                   
                  
                   $rightbp= $rightbp+$uplevelbp1;
                  
                    $rightmonthbp= $rightmonthbp+$uplevelbp1;
                }



            $ResultAllsss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Left'");

             $rowcountsscdm = mysqli_num_rows($ResultAllsss);
             if ($rowcountsscdm>0) {
                while($RowAllsss = mysqli_fetch_array($ResultAllsss)){

                   $leftbps=$RowAllsss['Accumulation_BP'];
                   if ($leftbps>=3200000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=3200000) {
                            $memberrank="Crown-Director";
                        }

                      }
                       
                   }
                    elseif ($leftbps>=1600000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=1600000) {
                            $memberrank="Platinum-Director";
                        }

                      }
                       
                   }
                    elseif ($leftbps>=800000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=800000) {
                            $memberrank="Diamond-Director";
                        }

                      }
                       
                   }

                    elseif ($leftbps>=400000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=400000) {
                            $memberrank="Gold-Director";
                        }

                      }
                       
                   }

                     elseif ($leftbps>=200000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=200000) {
                            $memberrank="Silver-Director";
                        }

                      }
                       
                   }

                    elseif ($leftbps>=100000) {


                     $ResultAllssss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$p_namesss' and sponsor_placement='Right'");

                     $rowcountsscdms = mysqli_num_rows($ResultAllssss);
                      while($RowAllssss = mysqli_fetch_array($ResultAllssss)){

                        $rightbps=$RowAllssss['Accumulation_BP'];
                        if ($rightbps>=100000) {
                            $memberrank="Super-Director";
                        }

                      }
                       
                   }




                }


             }

            


              



                  if ($memberrank!="Super-Director"&&$memberrank!="Silver-Director"&&$memberrank!="Gold-Director"&&$memberrank!="Diamond-Director"&&$memberrank!="Platinum-Director"&&$memberrank!="Crown-Director") 
        {

                
             if ($accumulationbp>=100000) {
                $memberrank="Director";
            }
            elseif($accumulationbp>=25000) {
                $memberrank="Chief-Manager";
            }
             elseif($accumulationbp>=10000) {
                $memberrank="Manager";
            }
             elseif($accumulationbp>=5000) {
                $memberrank="Sales-Executive";
            }

        }
        
          if($memberrank!=$memberranks){
            
             $message = urlencode('Rank Promotion Congratulations,Name:' . $m_name . ',User ID:'.$p_namesss.' , Rank :'.$memberrank . ' Web : http://vastamarketing.in/');
              $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . "";  
             //$url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
// create a new cURL resource
                  $ch = curl_init();
// set URL and other appropriate options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
                curl_exec($ch);
//
//// close cURL resource, and free up system resources
                curl_close($ch);
            
        }

      

        if ($memberrank==$memberrank1) {
           $commission=0;
        }
        else{


            if ($memberrank1=="") {
                  if ($memberrank=="Sales-Executive") {
           $commission=($totalbp*10)/100;
        }
         if ($memberrank=="Manager") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*45)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*50)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*55)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*60)/100;
        }
            }



             if ($memberrank1=="Sales-Executive") {


                 
         if ($memberrank=="Manager") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*45)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*50)/100;
        }
            }


               if ($memberrank1=="Manager") {
                 
        
        if ($memberrank=="Chief-Manager") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*40)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*45)/100;
        }
            }


              if ($memberrank1=="Chief-Manager") {
                 
        
      
        if ($memberrank=="Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*35)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*40)/100;
        }

            }


            if ($memberrank1=="Director") {
       
        if ($memberrank=="Super-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*25)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*30)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*35)/100;
        }

            }

             if ($memberrank1=="Super-Director") {
       
      
        if ($memberrank=="Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*20)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*25)/100;
        }

            }

        if ($memberrank1=="Silver-Director") {


             if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
       
     
        if ($memberrank=="Gold-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*15)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*20)/100;
        }

            }

             if ($memberrank1=="Gold-Director") {
       
         
             if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
        
        if ($memberrank=="Diamond-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*10)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*15)/100;
        }

            }


             if ($memberrank1=="Diamond-Director") {

                 if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
            if ($memberrank=="Gold-Director") {
           $commission=0;
        }
       
        if ($memberrank=="Platinum-Director") {
           $commission=($totalbp*5)/100;
        }
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*10)/100;
        }

            }

               if ($memberrank1=="Platinum-Director") {
         if ($memberrank=="Director") {
           $commission=0;
        }
         if ($memberrank=="Super-Director") {
           $commission=0;
        }
        if ($memberrank=="Silver-Director") {
           $commission=0;
        }
            if ($memberrank=="Gold-Director") {
           $commission=0;
        }
        if ($memberrank=="Diamond-Director") {
           $commission=0;
        }
     
        if ($memberrank=="Crown-Director") {
           $commission=($totalbp*5)/100;
        }

            }


              if ($memberrank1=="Crown-Director") {


       
           $commission=0;
        

            }


        }

             $incomemonth=$incomemonth+$commission;
             
              $results = mysqli_query($link, "UPDATE `members` SET `right_month_bp`='$rightmonthbp', `Accumulation_BP`='$accumulationbp', `income_month`='$incomemonth',`left_PV`='leftpv', `right_PV`='rightpv', `Left_BP`='$leftbp',`Right_BP`='$rightbp',`Left_BP_For_Point`=$leftbpforpoint,`Right_BP_For_Point`=$rightbpforpoint, `Total_Point`='$totalpoint', `Point_Year`='$yearpoint',`month_pv_matching`='$monthpvmatching', `Daily_pv_matching`='$dailypvmatching',`Left_PV_Daily`=$leftpvdaily,`Right_PV_Daily`=$rightpvdaily, `date_pv_matching`='$datepvmatching',`left_month_bp`='$leftmonthbp',`member_rank`='$memberrank',`Accumulation_BP_Month`='$accumulationbpmonth' WHERE m_id='$p_namesss'");

            if ($sponserid=="") {
               
            }
            else{
                if ($uplevelpv1>0) {
                     $this->senduptolevel($sponserid,$uplevelpv1,$uplevelbp1,$placement,$memberrank);
                }

              
          }









    }
     function senduptolevelpvbp($p_namesss,$uplevelpv1,$uplevelbp1,$placement1,$memberrank1)
    {


   global $link;


         $ResultAllss = mysqli_query($link, "SELECT * FROM `members` WHERE m_id ='$p_namesss'");

            $RowAllss = mysqli_fetch_array($ResultAllss);
            
              $leftpv=$RowAllss['left_PV'];
              $rightpv=$RowAllss['right_PV'];
               $leftpvdaily=$RowAllss['Left_PV_Daily'];
              $rightpvdaily=$RowAllss['Right_PV_Daily'];
            $dailymaxpvmatching=$RowAllss['Daily_Max_Pv_Matching'];
             $totalpvmatching=$RowAllss['Total_Pv_Matching'];
              $dailypvmatching=$RowAllss['Daily_pv_matching'];
               $monthpvmatching=$RowAllss['month_pv_matching'];
              $accumulationbp=$RowAllss['Accumulation_BP'];
               $leftbp=$RowAllss['Left_BP'];
              $rightbp=$RowAllss['Right_BP'];
               $leftbpforpoint=$RowAllss['Left_BP_For_Point'];
              $rightbpforpoint=$RowAllss['Right_BP_For_Point'];
               $totalpoint=$RowAllss['Total_Point'];
                $yearpoint=$RowAllss['Point_Year'];
               $sponserid=$RowAllss['sponsor_id'];
              $placement=$RowAllss['placement'];
               $status=$RowAllss['m_status'];
                $datepvmatching=$RowAllss['date_pv_matching'];
                $memberrank=$RowAllss['member_rank'];
                $leftmonthbp=$RowAllss['left_month_bp'];
                $rightmonthbp=$RowAllss['right_month_bp'];
                 $incomemonth=$RowAllss['income_month'];
                  $placement_id=$RowAllss['placement_id'];
                  $totalbp=$uplevelbp1;
            

                if ($placement1=="Left") {   

                      $leftpvdaily=$leftpvdaily+$uplevelpv1;
                     $leftpv=$leftpv+$uplevelpv1;
                     
                      $leftbpforpoint=$leftbpforpoint+$uplevelbp1;
                      
                }
                else{
                   
                   $rightpvdaily=$rightpvdaily+$uplevelpv1;
                   $rightpv=$rightpv+$uplevelpv1;
                
                   $rightbpforpoint=$rightbpforpoint+$uplevelbp1;
                    
                }

              

        if ($leftbpforpoint>=5000 && $rightbpforpoint>=5000) {


            
                 while ($leftbpforpoint>=5000 && $rightbpforpoint>=5000) {

                                                        $totalpoint= $totalpoint+1;
                                                         $yearpoint=$yearpoint+1;
                                                           $leftbpforpoint=$leftbpforpoint-5000;
                                                           $rightbpforpoint=$rightbpforpoint-5000;
                                                        
                }
        }

       
                if ($status=="Active") {
                    $today=date("Y-m-d");

                    if ($datepvmatching==$today) {
                        if ($dailypvmatching<$dailymaxpvmatching) {

                            if ($dailypvmatching==0) {

                                if ($leftpvdaily>=2) {

                                    if ($rightpvdaily>=2) {

                                        $dailypvmatching=1;
                                        $monthpvmatching=$monthpvmatching+1;
                                        $totalpvmatching=$totalpvmatching+1;
                                        $leftpvdaily=$leftpvdaily-2;
                                        $rightpvdaily=$rightpvdaily-2;

                                        if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                        }
                                                        else{
                                                            
                                                              $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                            
                                                        }

                                                        
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                             
                                                              $dailypvmatching= $dailypvmatching+1;
                                                             $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }
                                                         else{
                                                               $dailypvmatching= $dailypvmatching+1;
                                                            
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }

                                                       
                                                        
                                                    }



                                                }
                                            }
                                        }
                                    }
                                    
                                }
                               
                            }
                            else{

                                 if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                             $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                        }
                                                        else{
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                            
                                                            
                                                        }

                                                       
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                              $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }else{
                                                             
                                                              $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                         }

                                                       
                                                        
                                                    }



                                                }
                                            }
                                        }

                            }
                            
                        }

                       
                    }
                    
                        else{
                             $datepvmatchings=$datepvmatching;
                             $datepvmatching=$today;
                              $leftpvdailys=$leftpvdaily;
                              $rightpvdailys=$rightpvdaily;
                              if($placement1=="Left"){
                                  $leftpvdailys=$leftpvdailys-$uplevelpv1;
                                  
                              }else{
                                  $rightpvdailys=$rightpvdailys-$uplevelpv1;
                                  
                              }
                              $dailypvmatchings=$dailypvmatching;
                              $query = "INSERT INTO `memberdailymatching` (`id`, `member_id`, `matching`, `date_match`, `Left_PV`,`Right_PV`) VALUES (NULL, '$p_namesss', '$dailypvmatchings', '$datepvmatchings', '$leftpvdailys','$rightpvdailys')";
                              $result = mysqli_query($link, $query);
                              $dailypvmatching=0;
                                  if ($placement1=="Left") {

                                     $leftpvdaily=$leftpvdaily+$uplevelpv1;
                                     $leftpv=$leftpv+$uplevelpv1;
                                    
                                }
                                else{
                                   
                                   $rightpvdaily=$rightpvdaily+$uplevelpv1;
                                   $rightpv=$rightpv+$uplevelpv1;
                                 
                                }

                                if ($leftpvdaily>=2) {

                                    if ($rightpvdaily>=2) {

                                        $dailypvmatching=1;
                                        $monthpvmatching=$monthpvmatching+1;
                                        $totalpvmatching=$totalpvmatching+1;
                                        $leftpvdaily=$leftpvdaily-2;
                                        $rightpvdaily=$rightpvdaily-2;

                                        if ($leftpvdaily>=1) {
                                            if ($rightpvdaily>=1) {
                                                if ($leftpvdaily<=$rightpvdaily) {
                                                    while ($leftpvdaily>=1) {
                                                        if($dailypvmatching<$dailymaxpvmatching){
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                        }
                                                        else{
                                                            
                                                            $dailypvmatching= $dailypvmatching+1;
                                                         
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                        }

                                                        
                                                        
                                                    }
                                                }
                                                else{

                                                     while ($rightpvdaily>=1) {
                                                         
                                                         if($dailypvmatching<$dailymaxpvmatching){
                                                             $dailypvmatching= $dailypvmatching+1;
                                                         $monthpvmatching=$monthpvmatching+1;
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                         }else{
                                                             
                                                             $dailypvmatching= $dailypvmatching+1;
                                                        
                                                           $leftpvdaily=$leftpvdaily-1;
                                                           $rightpvdaily=$rightpvdaily-1;
                                                             
                                                             
                                                         }

                                                        
                                                        
                                                    }



                                                }
                                            }
                                        }
                                    }
                                    
                                }


                            
                        }
                }


               
 
           
             
              $results = mysqli_query($link, "UPDATE `members` SET `right_month_bp`='$rightmonthbp', `Accumulation_BP`='$accumulationbp', `income_month`='$incomemonth',`left_PV`='leftpv', `right_PV`='rightpv', `Left_BP`='$leftbp',`Right_BP`='$rightbp',`Left_BP_For_Point`=$leftbpforpoint,`Right_BP_For_Point`=$rightbpforpoint, `Total_Point`='$totalpoint', `Point_Year`='$yearpoint',`month_pv_matching`='$monthpvmatching', `Daily_pv_matching`='$dailypvmatching',`Left_PV_Daily`=$leftpvdaily,`Right_PV_Daily`=$rightpvdaily, `date_pv_matching`='$datepvmatching',`left_month_bp`='$leftmonthbp',`member_rank`='$memberrank' WHERE m_id='$p_namesss'");

            if ($placement_id=="") {
               
            }
            else{
                if ($uplevelpv1>0) {
                $this->senduptolevelpvbp($placement_id,$uplevelpv1,$uplevelbp1,$placement,$memberrank);
                }

              
          }









    }



     function add_saleproduct() {

        if (isset($_REQUEST['add_saleproduct'])) {        
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
             $merchantvaluekey = $_POST['merchantvaluekey'];
             $p_namesss = $_POST['p_namesss'];
             $p_totalamount = $_POST['p_totalamount'];
             $gst_type = $_POST['gst_type'];    
             $cgst = $_POST['cgst'];
             $igst = $_POST['igst'];
             $labourcharge = $_POST['labourcharge'] ?? 0;
             $farecharge = $_POST['farecharge'] ?? 0;
             $discount = $_POST['discount'] ?? 0;
             $total = $_POST['total'] ?? 0;
             $payment_mode = isset($_POST['payment_mode']) && is_array($_POST['payment_mode']) ? $_POST['payment_mode'] : [];
             $payment_amount = $_POST['payment_amount'];
             $total_payment_amount = array_sum($payment_amount); 
             $payment_remark = $_POST['payment_remark'];
             $p_deposit = $_POST['p_deposit'] ?? 0;
             $p_balance = $_POST['p_balance'] ?? 0;
            //print_r($_POST); exit;

            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");
         
            $stmt = $link->prepare("SELECT total_due_amount FROM members WHERE m_id = ?");
            $stmt->bind_param("i", $p_namesss);
            $stmt->execute();
            $stmt->bind_result($total_due_amount);
            $stmt->fetch();
            $stmt->close();

            $new_total_due = $total_due_amount + $p_balance;

            $querysale = "INSERT INTO `sale_product` (`sale_id`, `saletemp_id`, `gst_type`, `cgst`, `igst`, `labourcharge`,`farecharge`, `discount`,`Total_Amounts`, `total`,`deposit`, `Balance`,`member_id`, `RectimeStamp`,`status`) VALUES (NULL, '$purchasetempids','$gst_type','$cgst','$igst','$labourcharge',' $farecharge','$discount', '$p_totalamount','$total', '$p_deposit', '$p_balance','$p_namesss', '$rectimestamp','1')";
            $result = mysqli_query($link, $querysale);
            $lastinsertid=mysqli_insert_id($link);

            $transaction_query = "INSERT INTO transactions (transaction_date, total_amount, customer_id) VALUES (NOW(), ?, ?)";
            $stmt = $link->prepare($transaction_query);
            $stmt->bind_param("di", $total_payment_amount, $p_namesss);
            $stmt->execute();
            $transaction_id = $stmt->insert_id;  // Get the inserted transaction ID

            $query = "INSERT INTO `sale_payments` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`,`balance_amount`, `RectimeStamp`) VALUES (NULL, '$lastinsertid', '$total', '$p_deposit', '$p_balance','$new_total_due', '$rectimestamp')";
            $result = mysqli_query($link, $query);
                  
            $genid='S'.$lastinsertid;
             $resultDL = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE purchase_id='$purchasetempids'");
           $rowcountDL = mysqli_num_rows($resultDL);
           if ($rowcountDL>0) {
           $i=1;
           while ($row = mysqli_fetch_array($resultDL)) {
           

                  $p_name=$row['product_id'];
                  $p_quantity=$row['Quantity'];
                  $sale_product_amount =$row['product_amount'];
            
             mysqli_query($link, "UPDATE `product` SET `Available`=Available-$p_quantity,`Sold`=Sold+$p_quantity WHERE Product_Code='$p_name'");
             mysqli_query($link, "UPDATE `sale_product_list` SET `status`='1' WHERE purchase_id='$purchasetempids'");
             mysqli_query($link, "UPDATE `members` SET `total_due_amount`=`total_due_amount` + $p_balance WHERE m_id ='$p_namesss'");
             $i++;
             
           }
        }


        // Step 2: Insert each payment mode into `payment_modes` table with remarks
        $payment_query = "INSERT INTO payment_modes (transaction_id, payment_mode, amount, remark) VALUES (?, ?, ?, ?)";
        $stmt = $link->prepare($payment_query);
        if (!empty($payment_mode)) {
        foreach ($payment_mode as $index => $mode) {
            $amount = $payment_amount[$index];
            $remark = $payment_remark[$index];  // Get the corresponding remark
            $stmt->bind_param("isds", $transaction_id, $mode, $amount, $remark);
            $stmt->execute();
        }
            usleep(1 * 1000);
        }
        }else{
            echo '<script>console.log("No payment modes provided.");</script>';
        }
    }
      function add_stock_transfer_product() {

        if (isset($_REQUEST['add_stock_transfer_product'])) {        
            global $link;

           
            $purchasetempids = $_POST['purchasetempids'];
               $merchantvaluekey = $_POST['merchantvaluekey'];
            $p_namesss = $_POST['p_namesss'];
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         

          

            $query = "INSERT INTO `stock_transfer_product` (`sale_id`, `saletemp_id`, `Total_Amounts`, `Discount`, `Balance`,`member_id`, `RectimeStamp`) VALUES (NULL, '$purchasetempids', '$p_totalamount', '$p_deposit', '$p_balance','$p_namesss', '$rectimestamp')";
            $result = mysqli_query($link, $query);
              $lastinsertid=mysqli_insert_id($link);

                 $query = "INSERT INTO `stock_transfer_payments` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`,`Merchant_Key`) VALUES (NULL, '$lastinsertid', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp', '$merchantvaluekey')";
            $result = mysqli_query($link, $query);
                  
            $genid='S'.$lastinsertid;
             $resultDL = mysqli_query($link, "SELECT * FROM `stock_transfer_product_list` WHERE purchase_id='$purchasetempids'");
        $rowcountDL = mysqli_num_rows($resultDL);
        if ($rowcountDL>0) {
           $i=1;
           while ($row = mysqli_fetch_array($resultDL)) {
           

                  $p_name=$row['product_id'];
                $p_quantity=$row['Quantity'];
            
           

             mysqli_query($link, "UPDATE `product` SET `Available`=Available-$p_quantity,`Sold`=Sold+$p_quantity WHERE Product_Code='$p_name'");
             $i++;
             
           }
        }
            $ResultAll = mysqli_query($link, "SELECT * FROM `stock_transfer_product_list` WHERE purchase_id='$purchasetempids'");
            $rowcountall = mysqli_num_rows($ResultAll);
            if ($rowcountall>0) {
                $totalpv=0;
                $totalbp=0;
                while ($RowAll = mysqli_fetch_array($ResultAll)) {

                    $productid=$RowAll['product_id'];
                     $Quantity=$RowAll['Quantity'];



                      $ResultAlls = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$productid'");

                      $RowAlls = mysqli_fetch_array($ResultAlls);
                      $productname=$RowAlls['Name'];
                       $Category=$RowAlls['Category'];
                        $Price=$RowAlls['Price'];
                         $PV=$RowAlls['PV'];
                          $BP=$RowAlls['BP'];
                            $RectimeStamp=$RowAlls['RectimeStamp'];
                     

                       $ResultAllss = mysqli_query($link, "SELECT * FROM `franchise_product` WHERE Product_Code='$productid' and member_id='$p_namesss'");
                     $rowcountallss = mysqli_num_rows($ResultAllss);

                     if ($rowcountallss>0) {
                            
                         mysqli_query($link, "UPDATE `franchise_product` SET `Available`=Available+$Quantity,`Purchase`=Purchase+$Quantity WHERE Product_Code='$productid'");
                        
                     }
                     else{

                         $query = "INSERT INTO `franchise_product` (`id`, `member_id`, `Product_Code`, `Name`, `Category`, `Price`, `PV`, `RectimeStamp`, `Available`, `Purchase`, `BP`) VALUES (NULL, '$p_namesss', '$productid', '$productname', '$Category', '$Price', '$PV', '$RectimeStamp', '$Quantity', '$Quantity', '$BP')";
                        $result = mysqli_query($link, $query);

                     }
                   
                }
            }


              mysqli_query($link, "UPDATE `members` SET `Franchise`=1 WHERE m_id ='$p_namesss'");

     
                    
            usleep(1 * 1000);
            if ($result) {

             $message = urlencode('Franchise Stock Point, Name:' . $m_name . 'User ID:'.$p_namesss.'Purchase Amount:,'.$p_totalamount.'' . ' Web : http://vastamarketing.in/');
              $url = "http://www.mysmsshop.in/http-api.php?username=pradeepvns&password=Pankaj@1988&senderid=VASTAM&route=1&number=" . $m_mobile. "&message=" . $message . "";
            // $url = " http://login.spvaigsms.in/sendSMS?username=vasta&message=" . $message . "&sendername=VASTAM&smstype=TRANS&numbers" . $m_mobile . "&apikey=c4f67095-da90-4943-aa07-d396efc4393b";
                
                
                echo '<script> alert("Stock Transferred Successfully"); </script>';
                echo '<script>window.location.href = "saleproduct.php";</script>';
                
            } else {
                echo '<script> alert("Stock Transfer not successfully inserted."); </script>';
            }

        }
    }
     function add_saleproductpayment() {

        if (isset($_REQUEST['add_saleproductpayment'])) {
        
            global $link;
           
            $purchasetempids = $_POST['purchasetempids'];
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'] ?? 0;
            $p_balance = $_POST['p_balance'] ?? 0; 
            $p_debit_amount = $_POST['p_debit'] ?? 0; 
            $advance_balance = $_POST['advance_balance'] ?? 0;
            $payment_mode = isset($_POST['payment_mode']) && is_array($_POST['payment_mode']) ? $_POST['payment_mode'] : [];
            $payment_amount = $_POST['payment_amount'] ?? 0;
            $transaction_type = 'paybalanceamount';
            $remark = $_POST['remark'] ?? '';
            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");

            //print_r($_POST); exit;
         
            $transaction_query = "INSERT INTO transactions (transaction_date, total_amount, total_amount, balance_amount, customer_id,transaction_type,remark) VALUES (NOW(), ?, ?, ?,?,?)";
            $stmt = $link->prepare($transaction_query);
            $stmt->bind_param("disss", $p_deposit, $p_balance, $purchasetempids, $transaction_type , $remark);
            $stmt->execute();
            $transaction_id = $stmt->insert_id;  // Get the inserted transaction ID

            $payment_query = "INSERT INTO payment_modes (transaction_id, payment_mode, amount) VALUES (?, ?, ?)";
            $stmt = $link->prepare($payment_query);
            if (!empty($payment_mode)) {
            foreach ($payment_mode as $index => $mode) {
                $amount = $payment_amount[$index];
                $stmt->bind_param("isd", $transaction_id, $mode, $amount);
                $stmt->execute();
            }
                usleep(1 * 1000);
            }               
            $query = "UPDATE `members` SET `total_due_amount` = ?, `advance_balance` = ? WHERE `m_id` = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("dds", $p_balance, $advance_balance, $purchasetempids);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo '<script> alert("Payment Added Successfully"); </script>';
            } else {
                echo '<script> alert("No changes were made."); </script>';
            }

        }
    }
     function add_stock_transfer_productpayment() {

        if (isset($_REQUEST['add_stock_transfer_productpayment'])) {
//         
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
          
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
              $p_balance = $_POST['p_balance'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         

//           

           

            $query = "INSERT INTO `stock_transfer_payments` (`id`, `purchase_id`, `Previous_Dew`, `Amount`, `Now_Dew`, `RectimeStamp`) VALUES (NULL, '$purchasetempids', '$p_totalamount', '$p_deposit', '$p_balance', '$rectimestamp')";
            $result = mysqli_query($link, $query);
                  
                     
                    
                   
                    
            usleep(1 * 1000);
            if ($result) {

             
                
                
                echo '<script> alert("Payment Added Successfully"); </script>';
                echo '<script>window.location.href = "stock_transfer_list_product.php";</script>';
//                
            } else {
                echo '<script> alert("Payment not successfully inserted."); </script>';
            }

        }
    }
    function add_walletpayment() {

        if (isset($_REQUEST['add_walletpayment'])) {
//         
            global $link;

           
             $purchasetempids = $_POST['purchasetempids'];
          
            $p_totalamount = $_POST['p_totalamount'];
            $p_deposit = $_POST['p_deposit'];
            $p_balance = $_POST['p_balance'];

            $membername = $_POST['membername'];

            date_default_timezone_set('Asia/Kolkata');
              $rectimestamp = Date("Y-m-d H:i:s");
         
              $query = "INSERT INTO `withdrawal_wallet` (`tds_id`, `member_name`, `member_id`, `wallet_request_amount`,`Total_Wallet`, `RectimeStamp`) VALUES (NULL, '$membername', '$purchasetempids', '$p_deposit','$p_totalamount','$rectimestamp')";
            $result = mysqli_query($link, $query);

              mysqli_query($link, "UPDATE `members` SET `total_income`=$p_balance,`Paid_Income`=Paid_Income+$p_deposit WHERE m_id='$purchasetempids'");
                  
                     
                    
                   
                    
            usleep(1 * 1000);
            if ($result) {

             
                
                
                echo '<script> alert("Payment Added Successfully"); </script>';
                echo '<script>window.location.href = "memberlistforpayment.php";</script>';
//                
            } else {
                echo '<script> alert("Payment not successfully inserted."); </script>';
            }

        }
    }
      function categorynames($catid) {
        global $link;
        $query = "SELECT * FROM `product_category` where id ='$catid'";
        $result = mysqli_query($link, $query);
       $row = mysqli_fetch_array($result);
           return $row['Name'] ?? '';
          
        
    }

    function unitlist() {
        global $link;
        $query = "SELECT * FROM `unit` where status = 1";
        $resultt = $link->query($query);
        while ($roww = mysqli_fetch_assoc($resultt)) 
        {
         echo '<option type="checkbox" value='.$roww['id'].'>'.$roww['unit_name'].'</option>';
         }
         
    }

    function selectsupplierlist() {
        global $link;
        $query = "SELECT * FROM `supplier`";
        $result = mysqli_query($link, $query);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<option type="checkbox" value='.$row['Supplier_Code'].'>'.$row['FRM'].'</option>';
        }
       
    }

    function selectcustomerlist() {
        global $link;
        $query = "SELECT * FROM `members`";
        $result = mysqli_query($link, $query);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<option type="checkbox" value='.$row['m_id'].'>'.$row['m_name'].'</option>';
        }
       
    }

    function ProductList() {
        global $link;
        $query = "SELECT p.*, u.unit_name from `product` p LEFT JOIN `unit` u ON  p.unit = u.id 
        ORDER BY p.id DESC";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td class="font-weight-600"><?php echo $row['Product_Code']; ?></td>
                     <td class="font-weight-600"><?php echo $row['Name']; ?></td>
                      <td class="font-weight-600"><?php echo $this->categorynames($row['Category']); ?></td>
                       <td class="font-weight-600"><?php echo $row['unit_name']; ?></td>
                       
                   
                    <td>
                      
                         <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#myModal<?php echo $i; ?>" title="Edit Product"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModald<?php echo $i; ?>" title="Delete Product"><i class="fas fa-trash"></i></button>

                     
                    </td>
                </tr>
                <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-warning">
                 <h4 class="modal-title ">Edit Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
        </div>
        <div class="modal-body">
           <form action="" method="post">
            <input type="hidden" id="Categoryid<?php echo $i;?>" name="Categoryid" value="<?php echo $row['id']; ?>">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                      
                                                        <div class="input-group">
                                                          
                                                            <input id="category<?php echo $i;?>" type="text" class="form-control" name="p_name" value="<?php echo $row['Name']; ?>" placeholder="Category Name" onblur="checkcategoryss<?php echo $i ; ?>();" required="">
                                                             <div> <span id="errorOfEmail<?php echo $i;?>"></span></div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                            <label for="m_email">Category</label>
                                                            <select id="member_state" class="form-control"  required="" name="category">
                                                              
                                                                <option value="" disabled="">Select Category</option>
                                                     <?php $this->showCategoryDropdownselected($row['Category']); ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="m_email">Unit/Size</label>
                                                            <select id="member_state" class="form-control"  required="" name="unit">
                                                            <option value="">Select Unit</option>
                                                            <?php $this->unitlist(); ?>
                                                            </select>
                                                        </div>

                                                    
                                                    <div class="form-group">
                                                        <button type="submit"  name="editProduct" class="btn btn-primary btn-rounded waves-effect waves-light pl-4 pr-4">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <div class="text-center"></div>



                                        </form>
                                        <script>
        
     

        function checkcategoryss<?php echo $i ; ?>() {
          
            var val = document.getElementById("category<?php echo $i ; ?>").value;
              var valid = document.getElementById("Categoryid<?php echo $i;?>").value;
            
   
            $.ajax({
                type: "POST",
                url: "checkproducts.php",
                data: {category:val,categoryid:valid},
                success: function (data) {
                 

                                                            if (data.trim()=="") {
                                                                document.getElementById('errorOfEmail<?php echo $i;?>').innerHTML = data;

                                                            } else {
                                                                document.getElementById('category<?php echo $i;?>').value = "";
                                                                document.getElementById('errorOfEmail<?php echo $i;?>').innerHTML = data;
                }
            }
            });

        }
        

    </script>

     
      </div>
       </div>
  </div></div>
     <div class="modal fade" id="myModald<?php echo $i; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header bg-danger">
                 <h4 class="modal-title ">Delete Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
     
        </div>
        <div class="modal-body">
          <p style="font-size: 25px;">Are you Sure want to delete this record.</p>
        </div>
        <div class="modal-footer">
              <form action="" method="POST"> 
                                    <input type="hidden" name="Categoryid" value="<?php echo $row['id']; ?>" />
                                    <button type="submit" name="deleteProducts" class="btn btn-danger btn-rounded waves-effect waves-light pl-4 pr-4" 
                                          >Delete</button>
                                </form>
         
        </div>
      </div>
       </div>
  </div>
  
<?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="6" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function editProduct() {
        if (isset($_REQUEST['editProduct'])) {
             $Categoryid = $_POST['Categoryid'];
            
            $p_name = $_POST['p_name'];
            $category = $_POST['category'];
            $unit = $_POST['unit'];
          

            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");
            if ($p_name != "") {
                global $link;

                  $query = "UPDATE `product` SET `Name`='$p_name',`Category`='$category',`unit`='$unit'  WHERE id ='$Categoryid'";
            $result = mysqli_query($link, $query);
              
                if ($result) {
                     echo '<script> alert("Product Updated Successfully"); </script>';
                    echo '<script>window.location.href = "product.php";</script>';
                }
            } else {
                echo '<div class="text-danger">Product not successfully updated.</div>';
            }
        }
    }

     function editSetting() {
        if (isset($_REQUEST['updatesetting'])) {
             $Categoryid = $_POST['Categoryid'];
            
            $p_name = $_POST['p_name'];
            $category = $_POST['category'];
            $Price = $_POST['Price'];
            $PV = $_POST['PV'];
               $BP = $_POST['BP'];

            date_default_timezone_set('Asia/Kolkata');
            $rectimestamp = Date("Y-m-d H:i:s");
            if ($p_name != "") {
                global $link;

                  $query = "UPDATE `charges_deduction` SET `tds`='$p_name',`pro_fee`='$Price' ,`Travelling`='$PV',`Charity`='$category',`Pv_Matching_charge`='$BP' WHERE id ='$Categoryid'";
            $result = mysqli_query($link, $query);
              
                if ($result) {
                     echo '<script> alert("Setting Updated Successfully"); </script>';
                    echo '<script>window.location.href = "setting.php";</script>';
                }
            } else {
                echo '<div class="text-danger">Setting not successfully updated.</div>';
            }
        }
    }
      function deleteProducts() {
        if (isset($_REQUEST['deleteProducts'])) {
            $Categoryid = $_POST['Categoryid'];
            global $link;
            $query = "DELETE FROM `product` WHERE id=$Categoryid";
            $result = mysqli_query($link, $query);
             if ($result) {
                     echo '<script> alert("Product Deleted Successfully"); </script>';
                    echo '<script>window.location.href = "product.php";</script>';
                }
        }
    }
    function showSaleEpinList() {

        global $link;
        $query = "SELECT * FROM `epin_transfer`";
        $result = mysqli_query($link, $query);
        $rowNum = mysqli_num_rows($result);
        if ($rowNum > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td class="p-0 text-center"><?php echo $i; ?></td>
                    <td><?php echo $row['from_id']; ?></td>
                    <td><?php
                        $to_id = $row['from_id'];
                        $resultTomember = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$to_id");
                        $rowTomember = mysqli_fetch_array($resultTomember);
                        $m_name = $rowTomember['m_name'];
                        echo $m_name;
                        ?></td>
                    <td><?php echo $row['to_id']; ?></td>
                    <td><?php
                        $to_id = $row['to_id'];
                        $resultTomember = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$to_id");
                        $rowTomember = mysqli_fetch_array($resultTomember);
                        $m_name = $rowTomember['m_name'];
                        echo $m_name;
                        ?></td>

                    <td><?php echo $row['epin']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="8" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function showMyDirectDownline() {
        $m_id = $_SESSION['admin_id']; 
        global $link;

        $query = "SELECT * FROM `members` WHERE sponsor_id='$m_id'";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $current_m_id = $row['m_id'];
                if ($row['m_status'] == "Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['m_status']; ?></td>
                <!--                    <td><a href="#" class="link">Go Direct Downline</a></td>-->
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }

    public function showDownlineReport() {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE m_id=$m_id");
        $row1 = mysqli_fetch_array($result1);
        $active_member_id = $row1['id'];

        usleep(1 * 1000);
        $query = "SELECT * FROM `members` WHERE id>$active_member_id";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);

        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $current_m_id = $row['m_id'];
                if ($row['m_status'] == "Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                ?><tr style="color: <?php echo $txtColor; ?>;">
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['m_id']; ?></td>
                    <td><?php echo $row['m_name']; ?></td>
                    <td><?php echo $row['m_status']; ?></td>
                </tr><?php
                $i++;
            }
//            }
        } else {
            echo '<tr><td colspan="4" class="p-0 text-center">No Record</td></tr>';
        }
    }

    public function getLeftDownlineMem($id) {
        //$DLRreport = array();
        global $DLRreport;
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$id'");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {
            $dllocalarray = array();
            foreach ($dllocalarray as $i => $value) {
                unset($dllocalarray[$i]);
            }
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['m_id'];
                array_push($DLRreport, $id);
                array_push($dllocalarray, $id);
                //$this->getLeftDownlineMem2($id);
            }
            $dlarc = count($dllocalarray);
            for ($i = 0; $i < $dlarc; $i++) {
                $idd = $dllocalarray[$i];
                $this->getLeftDownlineMem2($idd);
            }
        }
        return $DLRreport;
    }

    public function getLeftDownlineMem2($id) {
        //$DLRreport = array();
        global $DLRreport;
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id='$id'");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {
            $dllocalarray = array();
            foreach ($dllocalarray as $i => $value) {
                unset($dllocalarray[$i]);
            }
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['m_id'];
                array_push($DLRreport, $id);
                array_push($dllocalarray, $id);
                //$this->getLeftDownlineMem($id);
            }
            $dlarc = count($dllocalarray);
            for ($i = 0; $i < $dlarc; $i++) {
                $idd = $dllocalarray[$i];
                $this->getLeftDownlineMem($idd);
            }
        }
        return $DLRreport;
    }

    public function getLDLMem($id) {
        //$DLRreport = array();
        global $DLRreport;
        foreach ($DLRreport as $i => $value) {
            unset($DLRreport[$i]);
        }
        $z = $this->getLeftDownlineMem($id);
        return $z;
    }

   public function showLeftDownlineReport() {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_placement='Left' AND sponsor_id='$m_id'");
        $row_Count = mysqli_num_rows($result1);
        if ($row_Count > 0) {
             $j = 1;
        while ($row1 = mysqli_fetch_array($result1)) {
            
             if ($row1['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
           
            $left_member_id = $row1['m_id'];

            usleep(1 * 1000);
            $queryleft = "SELECT * FROM `members` WHERE m_id='$left_member_id'";
            $resultleft = mysqli_query($link, $queryleft);
            $rowleft = mysqli_fetch_array($resultleft);
           
            ?><tr style="color: <?php echo $txtColor; ?>;">
                <td class="p-0 text-center">
                    <?php echo $j++; ?>
                </td>
                <td><?php echo $rowleft['m_id']; ?></td>
                <td><?php echo $rowleft['m_name']; ?></td>
                <td><?php echo $rowleft['m_status']; ?></td>
            </tr><?php
            $downlineMember = $this->getLDLMem($left_member_id);
            usleep(1 * 1000);
            $rowcount = count($downlineMember);
            if ($rowcount > 0) {
              
                foreach ($downlineMember as $i => $value) {
                    $member_id = $value;
                    $query = "SELECT * FROM `members` WHERE m_id=$member_id";
                    $result = mysqli_query($link, $query);

                    while ($row = mysqli_fetch_array($result)) {
                         if ($row['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                        ?><tr style="color: <?php echo $txtColor; ?>;">
                            <td class="p-0 text-center">
                                <?php echo $j++; ?>
                            </td>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><?php echo $row['m_name']; ?></td>
                            <td><?php echo $row['m_status']; ?></td>
                        </tr><?php
                       
                    }
                }
            }
        } } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }

     public function showRightDownlineReport() {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $result1 = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_placement='Right' AND sponsor_id='$m_id'");
        $row_Count = mysqli_num_rows($result1);
        if ($row_Count > 0) {

                $j = 1;
        while ($row1 = mysqli_fetch_array($result1)) {
             if ($row1['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
          
            $right_member_id = $row1['m_id'];

            usleep(1 * 1000);
            $queryleft = "SELECT * FROM `members` WHERE m_id='$right_member_id'";
            $resultleft = mysqli_query($link, $queryleft);
            $rowleft = mysqli_fetch_array($resultleft);
           
            ?><tr style="color: <?php echo $txtColor; ?>;">
                <td class="p-0 text-center">
                    <?php echo $j++; ?>
                </td>
                <td><?php echo $rowleft['m_id']; ?></td>
                <td><?php echo $rowleft['m_name']; ?></td>
                <td><?php echo $rowleft['m_status']; ?></td>
            </tr><?php
            $downlineMember = $this->getLDLMem($right_member_id);
            usleep(1 * 1000);
            $rowcount = count($downlineMember);
            if ($rowcount > 0) {
             
                foreach ($downlineMember as $i => $value) {
                    $member_id = $value;
                    $query = "SELECT * FROM `members` WHERE m_id=$member_id";
                    $result = mysqli_query($link, $query);

                    while ($row = mysqli_fetch_array($result)) {
                         if ($row['m_status']=="Active") {
                    $txtColor = "green";
                } else {
                    $txtColor = "red";
                }
                        ?><tr style="color: <?php echo $txtColor; ?>;">
                            <td class="p-0 text-center">
                                <?php echo $j++; ?>
                            </td>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><?php echo $row['m_name']; ?></td>
                            <td><?php echo $row['m_status']; ?></td>
                        </tr><?php
                       
                    }
                }
            }
        } } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }
    public function getLeftDownlineMemCF($id) {
        //$DLRreportCF = array();
        global $DLRreportCF;
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['member_id'];
                $mstatus = $row['member_status'];
                if ($mstatus == "Active") {
                    array_push($DLRreportCF, $id);
                }
                $this->getLeftDownlineMemCF2($id);
            }
        }
        return $DLRreportCF;
    }

    public function getLeftDownlineMemCF2($id) {
        //$DLRreportCF = array();
        global $DLRreportCF;
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `active_members` WHERE sponsor_id='$id'");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['member_id'];
                $mstatus = $row['member_status'];
                if ($mstatus == "Active") {
                    array_push($DLRreportCF, $id);
                }
                $this->getLeftDownlineMemCF($id);
            }
        }
        return $DLRreportCF;
    }

    public function getLDLMemCF($id) {
        //$DLRreportCF = array();
        global $DLRreportCF;
        foreach ($DLRreportCF as $i => $value) {
            unset($DLRreportCF[$i]);
        }
        $z = $this->getLeftDownlineMemCF($id);
        return $z;
    }

    function getCarryForward() {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `wallet_request` WHERE status='Reject' ");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {

            $j = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $j; ?>
                    </td>
                    <td><?php echo $row['numberof_epin']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['payment_mode']; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['transaction_time']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['reason']; ?></td>

                </tr><?php
                $j++;
            }
        } else {
            echo '<tr><td colspan="9" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function getCarryLeftRight() {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $resultLeftDL = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Left' AND placement_id='$m_id'");
        $rownumLeftDL = mysqli_num_rows($resultLeftDL);
        if ($rownumLeftDL > 0) {
            $rowLeftDL = mysqli_fetch_array($resultLeftDL);
            $leftDownlineMemberID = $rowLeftDL['m_id'];
        } else {
            $leftDownlineMemberID = "";
        }

        usleep(1 * 1000);
        $resultRightDL = mysqli_query($link, "SELECT * FROM `members` WHERE placement='Right' AND placement_id='$m_id'");
        $rownumRightDL = mysqli_num_rows($resultRightDL);
        if ($rownumRightDL > 0) {
            $rowRightDL = mysqli_fetch_array($resultRightDL);
            $rightDownlineMemberID = $rowRightDL['m_id'];
        } else {
            $rightDownlineMemberID = "";
        }

        if ($leftDownlineMemberID != "") {
            $leftDownlineMember = $this->getLDLMemCF($leftDownlineMemberID);
            array_unshift($leftDownlineMember, $leftDownlineMemberID);
        } else {
            $leftDownlineMember = array();
        }

        if ($rightDownlineMemberID != "") {
            $rightDownlineMember = $this->getLDLMemCF($rightDownlineMemberID);
            array_unshift($rightDownlineMember, $rightDownlineMemberID);
        } else {
            $rightDownlineMember = array();
        }

        $leftDownlineMemberCount = count($leftDownlineMember);
        $rightDownlineMemberCount = count($rightDownlineMember);
        if ($leftDownlineMemberCount > $rightDownlineMemberCount) {
            $downlineMember = $leftDownlineMemberCount - $rightDownlineMemberCount;
            $end = $leftDownlineMemberCount;
            $key = $rightDownlineMemberCount;
            $DlM = $leftDownlineMember;
            $lorr = "In Left";
        } elseif ($leftDownlineMemberCount == $rightDownlineMemberCount) {
            $downlineMember = 0;
            $lorr = "";
        } elseif ($leftDownlineMemberCount < $rightDownlineMemberCount) {
            $downlineMember = $rightDownlineMemberCount - $leftDownlineMemberCount;
            $end = $rightDownlineMemberCount;
            $key = $leftDownlineMemberCount;
            $DlM = $rightDownlineMember;
            $lorr = "In Right";
        }
        return $lorr;
    }

    function showMemberBankDetails() {
        global $link;
        $query = "SELECT * FROM `member_bank_details`";
        $result = mysqli_query($link, $query);
        //$row = mysqli_fetch_array($result);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $bnk_id = $row['bank_name'];
                $result2 = mysqli_query($link, "SELECT * FROM `banklist` WHERE id='$bnk_id'");
                $row2 = mysqli_fetch_array($result2);
                $bank_name = $row2['bank'];

                usleep(1 * 1000);
                $m_id = $row['member_id'];
                $result3 = mysqli_query($link, "SELECT * FROM `upi_details` WHERE member_id='$m_id'");
                $rowcount3 = mysqli_num_rows($result3);
                if ($rowcount3 > 0) {
                    $row3 = mysqli_fetch_array($result3);
                    $upi = $row3['upi_no'];
                } else {
                    $upi = "Not Available";
                }
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $i; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $bank_name; ?></td>
                    <td><?php echo $row['bank_branch']; ?></td>
                    <td><?php echo $row['bank_ifsc_code']; ?></td>
                    <td><?php echo $row['bank_holder_name']; ?></td>
                    <td><?php echo $row['bank_account_no']; ?></td>
                    <td><?php echo $row['bank_account_type']; ?></td>
                    <td><?php echo $upi; ?></td>
                    <td><?php echo $row['date']; ?></td>
                </tr><?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="11" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function memberBankRecords($i) {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $query = "SELECT * FROM `member_bank_details` WHERE member_id='$m_id'";
        $result = mysqli_query($link, $query);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            $row = mysqli_fetch_array($result);
            $bank_name = $row['bank_name'];
            $bank_branch = $row['bank_branch'];
            $bank_ifsc_code = $row['bank_ifsc_code'];
            $bank_holder_name = $row['bank_holder_name'];
            $bank_account_no = $row['bank_account_no'];
            $bank_account_type = $row['bank_account_type'];

            if ($i == "bank_name") {
                return $bank_name;
            } elseif ($i == "branch") {
                echo $bank_branch;
            } elseif ($i == "ifsc_code") {
                echo $bank_ifsc_code;
            } elseif ($i == "holder_name") {
                echo $bank_holder_name;
            } elseif ($i == "account_no") {
                echo $bank_account_no;
            } elseif ($i == "account_type") {
                return $bank_account_type;
            }
        } else {
            return "";
        }
    }

    function showBankList() {
        global $link;
        $query = "SELECT * FROM `banklist`";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['bank']; ?></option>
            <?php
        }
    }

    function updateBankDetails() {
        $m_id = $_SESSION['admin_id'];
        if (isset($_REQUEST['update_bank'])) {
            $bank_name = $_POST['bank_name'];
            $bank_branch = $_POST['bank_branch'];
            $ifsc_code = $_POST['ifsc_code'];
            $account_holder = $_POST['account_holder'];
            $account_no = $_POST['account_no'];
            $account_type = $_POST['account_type'];
            $date = date('Y-m-d');
            global $link;
            $query = "UPDATE `member_bank_details` SET `bank_name`='$bank_name',`bank_branch`='$bank_branch',`bank_ifsc_code`='$ifsc_code',`bank_holder_name`='$account_holder',`bank_account_no`='$account_no',`bank_account_type`='$account_type' WHERE `member_id`='$m_id'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your record has been updated!</b></div>';
            }
        } elseif (isset($_REQUEST['add_bank'])) {
            $member_name = $_POST['member_name'];
            $bank_name = $_POST['bank_name'];
            $bank_branch = $_POST['bank_branch'];
            $ifsc_code = $_POST['ifsc_code'];
            $account_holder = $_POST['account_holder'];
            $account_no = $_POST['account_no'];
            $account_type = $_POST['account_type'];
            $date = date('Y-m-d');
            global $link;
            $query = "INSERT INTO `member_bank_details` (`member_bank_id`, `member_id`, `member_name`, `bank_name`, `bank_branch`, `bank_ifsc_code`, `bank_holder_name`, `bank_account_no`, `bank_account_type`, `date`) VALUES (NULL, '$m_id', '$member_name', '$bank_name', '$bank_branch', '$ifsc_code', '$account_holder', '$account_no', '$account_type', '$date')";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your record has been added!</b></div>';
            }
        }
    }

    function getUpi($i) {
        $m_id = $_SESSION['admin_id'];
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `upi_details` WHERE member_id='$m_id'");
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $row = mysqli_fetch_array($result);
            $upi = $row['upi_no'];
            if ($i == "upi") {
                echo $upi;
            } elseif ($i == "get_upi") {
                return $upi;
            }
        } else {
            echo '';
        }
    }

    function addUpi() {
        $m_id = $_SESSION['admin_id'];
        if (isset($_REQUEST['add_upi'])) {
            $upi = $_POST['upi'];
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            global $link;
            $query = "INSERT INTO `upi_details` (`upi_id`, `member_id`, `upi_no`, `date`, `time`) VALUES (NULL, '$m_id', '$upi', '$date', '$time')";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your UPI has been added successfully!</b></div>';
            }
        } elseif (isset($_REQUEST['update_upi'])) {
            $upi = $_POST['upi'];
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Kolkata');
            $time = date('H:i:s');
            global $link;
            $query = "UPDATE `upi_details` SET `upi_no`='$upi',`date`='$date',`time`='$time' WHERE member_id='$m_id'";
            $result = mysqli_query($link, $query);
            usleep(1 * 1000);
            if ($result) {
//                echo '<script> alert("Your record has been updated!"); </script>';
                echo '<div class="text-success"><b>Your UPI has been updated successfully!</b></div>';
            }
        }
    }

    function add_wallet() {
        if (isset($_REQUEST['add_wallet'])) {
            //$amount = $_POST['amount'];
            $m_id = $_SESSION['admin_id'];
            $m_name = $_SESSION['admin_name'];
            $numberof_epin = $_POST['numberof_epin'];
//            $product_name = $_POST['product'];
            $product_amount = $_POST['amount'];
            $total_amount = $_POST['total_amount'];
            $payment_mode = $_POST['payment_mode'];
            $transaction_id = $_POST['transaction_id'];
            $transaction_date = $_POST['transaction_date'];
            $transaction_time = $_POST['transaction_time'];

            global $link;
            $query = "INSERT INTO `wallet_request` (`id`, `member_id`, `member_name`, `product_amount`, `numberof_epin`, `total_amount`, `payment_mode`, `transaction_id`, `transaction_date`, `transaction_time`, `status`) VALUES (NULL, '$m_id', '$m_name', '$product_amount', '$numberof_epin', '$total_amount', '$payment_mode', '$transaction_id', '$transaction_date', '$transaction_time', 'Pending')";
            $result = mysqli_query($link, $query);
            echo '<script>window.location.href = "epin_request.php";</script>';
        }
    }

    function blockedMember() {
        global $link;
        date_default_timezone_set('Asia/Kolkata');
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $result = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Inactive'");
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['m_id'];
                $block_date = $row['block_date'];
                $m_time = $row['m_time'];
                if ("{$date}" > "{$block_date}") {
//                    echo "<script>alert('if');</script>";
                    mysqli_query($link, "UPDATE `members` SET `m_status`='Block' WHERE m_id='$id'");
                } elseif ("{$date}" == "{$block_date}" && "{$time}" > "{$m_time}") {
//                    echo "<script>alert('elseif');</script>";
                    mysqli_query($link, "UPDATE `members` SET `m_status`='Block' WHERE m_id='$id'");
                }
            }
        }
    }

    function singleleg_income() {
        global $link;
        $resultML = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active'");
        while ($rowML = mysqli_fetch_array($resultML)) {

            $m_id = $rowML['m_id'];
            $query = "SELECT * FROM `singleleg_income` WHERE status='Pending' AND member_id='$m_id'";
            $resultDDL = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active' AND sponsor_id='$m_id'");
            $rowcountDDL = mysqli_num_rows($resultDDL);
            $result = mysqli_query($link, $query);
            $rowNum = mysqli_num_rows($result);
            if ($rowNum > 0) {
                $start_date = date('Y-m-d');
                while ($row = mysqli_fetch_array($result)) {
                    $label = $row['label'];
                    $id = $row['id'];
                    if ($label == 'STAR') {
                        if ($rowcountDDL >= '1') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        }
                    } elseif ($label == 'SILVER') {
                        if ($rowcountDDL >= '2') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        }
                    } elseif ($label == 'BRONZE') {
                        if ($rowcountDDL >= '3') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        }
                    } elseif ($label == 'GOLD') {
                        if ($rowcountDDL >= '5') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        }
                    } elseif ($label == 'PLATINUM') {
                        if ($rowcountDDL >= '7') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +30 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");
                        }
                    } elseif ($label == 'RUBY') {
                        if ($rowcountDDL >= '10') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +40 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'PEARL') {
                        if ($rowcountDDL >= '13') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +40 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'DIAMOND') {
                        if ($rowcountDDL >= '17') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +40 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'BLUE DIAMOND') {
                        if ($rowcountDDL >= '21') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +40 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL' OR label = 'DIAMOND') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'RED DIAMOND') {
                        if ($rowcountDDL >= '26') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +50 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL' OR label = 'DIAMOND' OR label = 'BLUE DIAMOND') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'WHITE DIAMOND') {
                        if ($rowcountDDL >= '31') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +50 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL' OR label = 'DIAMOND' OR label = 'BLUE DIAMOND' OR label = 'RED DIAMOND') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'KING') {
                        if ($rowcountDDL >= '38') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +50 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL' OR label = 'DIAMOND' OR label = 'BLUE DIAMOND' OR label = 'RED DIAMOND' OR label = 'WHITE DIAMOND') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    } elseif ($label == 'SUPER KING') {
                        if ($rowcountDDL >= '48') {
                            $end_date = date('Y-m-d', strtotime($start_date . ' +60 day'));
                            mysqli_query($link, "UPDATE `singleleg_income` SET `status`='Approve', `start_date`='$start_date', `end_date`='$end_date' WHERE id='$id'");

                            $result_stopincome = mysqli_query($link, "SELECT * FROM `singleleg_income` WHERE (member_id = $m_id) AND (label = 'STAR' OR  label = 'SILVER' OR  label = 'BRONZE' OR  label = 'GOLD' OR  label = 'PLATINUM' OR label = 'RUBY' OR label = 'PEARL' OR label = 'DIAMOND' OR label = 'BLUE DIAMOND' OR label = 'RED DIAMOND' OR label = 'WHITE DIAMOND' OR label = 'KING') AND (end_date>'$start_date')");
                            while ($row = mysqli_fetch_array($result_stopincome)) {
                                $singleleg_id = $row['id'];
                                mysqli_query($link, "UPDATE `singleleg_income` SET `end_date`='$start_date' WHERE id = $singleleg_id");
                            }
                        }
                    }
                }
            }
        }
    }

    function send_singleleg_income() {
        global $link;
        $resultML = mysqli_query($link, "SELECT * FROM `members` WHERE m_status='Active'");
        while ($rowML = mysqli_fetch_array($resultML)) {

            $m_id = $rowML['m_id'];
            $date = date('Y-m-d');
//            $date = '2020-08-07';
            $query = "SELECT * FROM `singleleg_income` WHERE start_date<='$date' AND end_date>'$date' AND member_id='$m_id'";
            $result = mysqli_query($link, $query);
            $rowNum = mysqli_num_rows($result);
            if ($rowNum > 0) {
//                echo "<script>alert('send_singleleg_income');</script>";
                while ($row = mysqli_fetch_array($result)) {
                    $SLid = $row['id'];
                    $amount = $row['amount'];
                    $today_date = $row['today_date'];
//                ("{$date}" > "{$block_date}");
                    if ("{$today_date}" != "{$date}") {
                        mysqli_query($link, "UPDATE `members` SET `singleleg_income`=singleleg_income+$amount,`total_income`=total_income+$amount WHERE m_id=$m_id");
                        mysqli_query($link, "UPDATE `singleleg_income` SET `today_date`='$date' WHERE id='$SLid'");
                    }
                }
            }
        }
    }

    function getFrenchizeIncome() {
        global $link;
        $result = mysqli_query($link, "SELECT * FROM `franchise_income` ORDER BY id DESC");
        $rownum = mysqli_num_rows($result);
        if ($rownum > 0) {

            $j = 1;
            while ($row = mysqli_fetch_array($result)) {
                ?><tr>
                    <td class="p-0 text-center">
                        <?php echo $j; ?>
                    </td>
                    <td><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                    <td><?php echo $row['total_epins']; ?></td>
                    <td>&#8377; <?php echo number_format($row['total_amount'], 2); ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>


                </tr><?php
                $j++;
            }
        } else {
            echo '<tr><td colspan="9" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function royalty5List() {
        global $link;
        $query = "SELECT * FROM `royalty` WHERE royalty='5' ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class="font-weight-600"><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function royalty10List() {
        global $link;
        $query = "SELECT * FROM `royalty` WHERE royalty='10' ORDER BY id DESC";
        $result = mysqli_query($link, $query);
        $i = 1;
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class="font-weight-600"><?php echo $row['member_id']; ?></td>
                    <td><?php echo $row['member_name']; ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<tr><td colspan="3" class="p-0 text-center">No Record</td></tr>';
        }
    }

    function send_royalty5() {
        global $link;
        if (isset($_REQUEST['send_royalty5'])) {
            $amount = $_POST['amount'];
            $query = "SELECT * FROM `royalty` WHERE royalty='5'";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($result)) {
                $m_id = $row['member_id'];
                mysqli_query($link, "UPDATE `members` SET `royalty_income`=royalty_income+$amount,`total_income`=total_income+$amount WHERE m_id='$m_id'");
                
            }
            echo '<script> alert("5% Royalty Income has been sent successfully!"); location.replace("royalty5.php"); </script>';
        }
    }

    function send_royalty10() {
        global $link;
        if (isset($_REQUEST['send_royalty10'])) {
            $amount = $_POST['amount'];
            $query = "SELECT * FROM `royalty` WHERE royalty='10'";
            $result = mysqli_query($link, $query);
            while ($row = mysqli_fetch_array($result)) {
                $m_id = $row['member_id'];
                mysqli_query($link, "UPDATE `members` SET `royalty_income`=royalty_income+$amount,`total_income`=total_income+$amount WHERE m_id='$m_id'");
                
            }
            echo '<script> alert("10% Royalty Income has been sent successfully!"); location.replace("royalty10.php"); </script>';
        }
    }


    function Supplier() {
        global $link;
        if (isset($_REQUEST['submit_supplier'])) {
            $FRM = $_POST['FRM'];
            $Owner = $_POST['owner'];
            $gstin_no = $_POST['gstin_no'];
            $Address = $_POST['address'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];

            $query = "INSERT INTO `supplier` (`id`, `FRM`, `owner`, `gstin_no`, `address`, `contact`, `email`) VALUES (NULL, '$FRM', '$Owner', '$gstin_no', '$Address', '$contact', '$email');";
            $result = mysqli_query($link, $query);
             $lastinsertid=mysqli_insert_id($link);
                    if (($lastinsertid/10)<1) {
                        $genid='90000'.$lastinsertid;
                    }
                     elseif (($lastinsertid/100)<1) {
                        $genid='9000'.$lastinsertid;
                    }
                     elseif (($lastinsertid/1000)<1) {
                        $genid='900'.$lastinsertid;
                    }
                     elseif (($lastinsertid/10000)<1) {
                        $genid='90'.$lastinsertid;
                    }
                     elseif (($lastinsertid/100000)<1) {
                        $genid='9'.$lastinsertid;
                    }
                     else{

                        $genid=$lastinsertid;
                    }
                    $resultDDL = mysqli_query($link, "SELECT * FROM `supplier` WHERE Supplier_Code  ='$genid'");
                 $rowcountDDL = mysqli_num_rows($resultDDL);
                 if ($rowcountDDL>0) {
                     $RowAlls = mysqli_fetch_array($resultDDL);
                     $uid=$RowAlls['id'];

                       if (($uid/10)<1) {
                        $genid='90000'.$uid;
                    }
                     elseif (($uid/100)<1) {
                        $genid='9000'.$uid;
                    }
                     elseif (($uid/1000)<1) {
                        $genid='900'.$uid;
                    }
                     elseif (($uid/10000)<1) {
                        $genid='90'.$uid;
                    }
                     elseif (($uid/100000)<1) {
                        $genid='9'.$uid;
                    }
                     else {
                        $genid=$uid;
                    }
                 }
             mysqli_query($link, "UPDATE `supplier` SET `Supplier_Code`='$genid' WHERE id =$lastinsertid");
            usleep(1 * 1000);
        }
    }

    function SupplierList() {
        global $link;
        $query = "SELECT * FROM `supplier`";
        $result = mysqli_query($link, $query);
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?><tr style="color: <?php echo $txtColor; ?>;">
                <td class="">
                    <?php echo $i; ?>
                </td>
                 <td><?php echo $row['Supplier_Code']; ?></td>
                <td><?php echo $row['FRM']; ?></td>
                <td><?php echo $row['owner']; ?></td>
                <td><?php echo $row['gstin_no']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['email']; ?></td>


                <td>
                    <form action="" method="post">
                        <!--<div class="btn-group dropleft ">-->
                        <button type="submit" style="margin-right:10px;" class="btn btn-success" name="edit" value="<?php echo $row['id']; ?>">
                            Edit
                        </button>
                        <button type="submit" class="btn btn-danger" name="deleterow" value="<?php echo $row['id']; ?>">
                            Delete
                        </button>
                    </form>

                    <!--</div>-->
                </td>
            </tr><?php
            $i++;
        }
    }

    function deletesupplierMember() {
        global $link;
        if (isset($_POST['deleterow'])) {
            $id = $_POST['deleterow'];
            $sql = "DELETE FROM `supplier` WHERE `id` = '$id'";
            $result2 = mysqli_query($link, $sql);
        }
    }

    function updatesupplierMember() {
        global $link;
        if (isset($_POST['update'])) {
            $FRM = $_POST['FRM'];
            $Owner = $_POST['owner'];
            $gstin_no = $_POST['gstin_no'];
            $Address = $_POST['address'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $editID = $_POST['update'];
            $result = mysqli_query($link, "UPDATE `supplier` SET `FRM`='$FRM',`address`='$Address',`contact`='$contact',`email`='$email' WHERE id='$editID'");
            
        }
    }



}
