<?php
include '../include/db.php';

    
    global $link;
    if (isset($_REQUEST['supplier'])) {
        $supplier = $_POST['supplier']; 
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
            $supplier = $row['Supplier'];
            $Resultsupplier = mysqli_query($link, "SELECT * FROM `supplier` WHERE Supplier_Code='$supplier'");
            $Rowsupplier = mysqli_fetch_array($Resultsupplier);
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
                <td><?php echo $row['RectimeStamp']; ?></td>
                <td><?php echo $Rowsupplier['FRM']; ?></td>
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

?>