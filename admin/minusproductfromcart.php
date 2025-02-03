<?php
include '../include/db.php';
 $purchasetempid = $_REQUEST['purchasetempid'];
$p_name = $_REQUEST['p_name'];
$p_quantity = $_REQUEST['p_quantity'];
$p_price = $_REQUEST['p_price'];
 $p_total = $_REQUEST['p_total'];
 date_default_timezone_set('Asia/Kolkata');
  $rectimestamp = Date("Y-m-d H:i:s");


 $result = mysqli_query($link, "INSERT INTO `sale_product_list` (`purchase_list_id`,`purchase_id`,`product_id`,`product_amount`,`Total_amount`,`Quantity`,`RectimeStamp`) VALUES (NULL,'$purchasetempid','$p_name','$p_price','$p_total','$p_quantity','$rectimestamp')");

 //mysqli_query($link, "UPDATE `product` SET `Available`=Available-$p_quantity,`Sold`=Sold+$p_quantity WHERE Product_Code='$p_name'");


 $ResultAll = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE purchase_id='$purchasetempid'");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
  	$i=1;
  	$totalamount=0;
  
   while ($RowAll = mysqli_fetch_array($ResultAll)) {  
    $product_id = $RowAll['product_id'];
	$ResultAlls = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$product_id'");
    $Rowproduct = mysqli_fetch_array($ResultAlls);
    $unit = $Rowproduct['unit'];

    $Resultunit = mysqli_query($link, "SELECT * FROM `unit` WHERE id='$unit'");
    $Rowunit = mysqli_fetch_array($Resultunit);
    
    
    ?>


   	<tr>

   		
        <td><?php echo $i; ?></td>
   		<td><?php echo $Rowproduct['Name']; ?>(<?php echo $RowAll['product_id']; ?>)</td>

   		<td><?php echo $RowAll['product_amount']; ?></td>

   		<td><?php echo $RowAll['Quantity']; ?>/(<?php echo $Rowunit['unit_name']; ?>)</td>

   		<td><?php echo $RowAll['Total_amount'];$totalamount=$totalamount+$RowAll['Total_amount']; ?></td>
   		<td>
          <a id="<?php echo $RowAll['purchase_list_id']; ?>"  class="btn btn-danger btn-block waves-effect waves-light" type="submit" onclick="deleteproduct(this.id);"><i class="fas fa-window-close"></i></a></td>

   	</tr>

  

   	<?php $i=$i+1; }  ?>
	   <tr>
    <td colspan="4"></td>
    <td>Gross Amount</td>
    <td>
        <input type="text" name="p_totalamount" id="p_totalamount" class="form-control" value="<?php echo  $totalamount; ?>" placeholder="" readonly>
    </td>
</tr>

<tr>
    <td colspan="4"></td>
    <td>Select GST</td>
    <td>
        <select class="form-control" name="gst_type" id="gst_type" required onchange="calculateGST();">
            <option value="" disabled selected>Select GST Type</option>
            <option value="0">GST Exempted (0%)</option>
            <option value="5">GST 5%</option>
            <option value="12">GST 12%</option>
            <option value="18">GST 18%</option>
            <option value="28">GST 28%</option>
        </select>
    </td>
</tr>

<tr id="gst_fields" style="display: none;">
    <td colspan="4"></td>
    <td>SGST</td>
    <td>
        <input type="text" class="form-control" id="cgst" name="cgst" placeholder="Enter CGST" readonly />
    </td>
</tr>

<tr id="igst_row" style="display: none;">
    <td colspan="4"></td>
    <td>CGST</td>
    <td>
        <input type="text" class="form-control" id="igst" name="igst" placeholder="Enter IGST" readonly />
    </td>
</tr>


<tr>
    <td colspan="4"></td>
    <td>Labour Charges</td>
    <td>
        <input type="text" name="labourcharge" id="labourcharge" class="form-control" placeholder="Labour Charges">
    </td>
</tr>
<tr>
    <td colspan="4"></td>
    <td>Fare Charges</td>
    <td>
        <input type="text" name="farecharge" id="farecharge" class="form-control" placeholder="Fare Charges">
    </td>
</tr>

<tr>
    <td colspan="4"></td>
    <td>Discount</td>
    <td>
        <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount">
    </td>
</tr>

<tr>
    <td colspan="4"></td>
    <td>Total</td>
    <td>
        <input type="text" name="total" id="total" class="form-control" readonly>
    </td>
</tr>

<tr>
    <td colspan="4"></td>
    <td>Total Deposit</td>
    <td>
        <input type="text" name="p_deposit" id="p_deposit" class="form-control" onkeyup="getbalance();" placeholder="Deposit Amount">
    </td>
</tr>

<tr>
    <td colspan="4"></td>
    <td>Balance</td>
    <td>
        <input type="text" name="p_balance" id="p_balance" class="form-control" placeholder="" readonly>
    </td>
</tr>


<tr id="payment_section">
    <td colspan="3"></td>
    <td>Payment Mode</td>
    <td>
        <select class="form-control payment_mode" name="payment_mode[]" id="payment_mode_1" onchange="showPaymentFields(1);">
            <option value="" disabled selected>Select Payment Mode</option>
            <option value="cash">Cash</option>
            <option value="upi">UPI</option>
            <option value="wallet">Cheque</option>
        </select>
    </td>
    <td>
        <input type="text" name="payment_amount[]" id="payment_amount_1" class="form-control payment_amount" placeholder="Enter Amount">
    </td>
    <td>
        <input type="text" name="payment_remark[]" id="payment_remark_1" class="form-control payment_remark" placeholder="Enter Remark (for UPI)" style="display:none;">
    </td>
    <td>
        <button type="button" class="btn btn-success" onclick="addPaymentMode();">Add Another Payment</button>
    </td>
</tr>

  

 

	<?php } ?>
   <?php



  



?>

