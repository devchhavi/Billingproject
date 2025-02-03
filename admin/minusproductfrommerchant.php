<?php
include '../include/db.php';
 $purchasetempid = $_REQUEST['purchasetempid'];
   $merchantvalue = $_REQUEST['merchantvalue'];
$p_name = $_REQUEST['p_name'];
$p_quantity = $_REQUEST['p_quantity'];
$p_price = $_REQUEST['p_price'];
$p_discount = $_REQUEST['p_discount'];
 $p_total = $_REQUEST['p_total'];
 date_default_timezone_set('Asia/Kolkata');
  $rectimestamp = Date("Y-m-d H:i:s");


 $result = mysqli_query($link, "INSERT INTO `sale_product_list` (`purchase_list_id`,`purchase_id`,`product_id`,`product_amount`,`Total_amount`,`Quantity`,`Discount`,`RectimeStamp`) VALUES (NULL,'$purchasetempid','$p_name','$p_price','$p_total','$p_quantity','$p_discount','$rectimestamp')");

 //mysqli_query($link, "UPDATE `product` SET `Available`=Available-$p_quantity,`Sold`=Sold+$p_quantity WHERE Product_Code='$p_name'");


 $ResultAll = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE purchase_id='$purchasetempid'");
  $rowcountall = mysqli_num_rows($ResultAll);
  if ($rowcountall>0) {
  	$i=1;
  	$totalamount=0;
  
   while ($RowAll = mysqli_fetch_array($ResultAll)) {  ?>


   	<tr>

   		<?php  $ResultAlls = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$p_name'");
  $RowAlls = mysqli_fetch_array($ResultAlls); ?>
    
   		
        <td><?php echo $i; ?></td>
   		<td><?php echo $RowAlls['Name']; ?>(<?php echo $RowAll['product_id']; ?>)</td>

   		<td><?php echo $RowAll['product_amount']; ?></td>

   		<td><?php echo $RowAll['Quantity']; ?></td>

   		<td><?php echo $RowAll['Discount']; ?></td>

   		<td><?php echo $RowAll['Total_amount'];$totalamount=$totalamount+$RowAll['Total_amount']; ?></td>
   		<td>
          <a id="<?php echo $RowAll['purchase_list_id']; ?>"  class="btn btn-danger btn-block waves-effect waves-light" type="submit" onclick="deleteproduct(this.id);"><i class="fas fa-window-close"></i></a></td>

   		
   	</tr>

  

   	<?php $i=$i+1; }  ?>
   		<tr>
   		<td colspan="4"></td>
   		<td>Total</td>
   		<td><input type="text" name="p_totalamount"  id="p_totalamount" class="form-control"  value="<?php echo  $totalamount; ?>" placeholder="" readonly></td>
   		


   	</tr>
   		<tr>
   		<td colspan="4"></td>
   		<td>Total Deposit</td>
   		<td>  <input type="text" name="p_deposit"  id="p_deposit" class="form-control" value="<?php echo $merchantvalue;  ?>"  onkeyup="getbalance();" placeholder="Deposit Amount" readonly></td>
   		


   	</tr>
   	 	</tr>
   		<tr>
   		<td colspan="4"></td>
   		<td>Balance</td>
   		<td>  <input type="text" name="p_balance"  id="p_balance" class="form-control"value="<?php echo $totalamount-$merchantvalue;  ?>"   placeholder=""readonly></td>
   		


   	</tr><?php } ?>
   <?php



  



?>