<?php

require_once('../include/db.php');
  $p_name = $_POST['p_name'];
 $ResultAllsss = mysqli_query($link, "SELECT * FROM `stock_transfer_product_list` WHERE purchase_list_id='$p_name'");
  $rowcountallsss = mysqli_num_rows($ResultAllsss);
  $RowAllsss = mysqli_fetch_array($ResultAllsss);
  $quantityy=$RowAllsss['Quantity'];
   $productcode=$RowAllsss['product_id'];
   $purchasetempid=$RowAllsss['purchase_id'];

 $query = "DELETE FROM `stock_transfer_product_list` WHERE purchase_list_id=$p_name";
 $result = mysqli_query($link, $query);


 

// mysqli_query($link, "UPDATE `product` SET `Available`=Available+$quantityy,`Sold`=Sold-$quantityy WHERE Product_Code='$productcode'");

 
 $ResultAll = mysqli_query($link, "SELECT * FROM `stock_transfer_product_list` WHERE purchase_id='$purchasetempid'");
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

  

   	<?php $i=$i+1; } ?>
   		<tr>
   		<td colspan="4"></td>
   		<td>Total</td>
   		<td><input type="text" name="p_totalamount"  id="p_totalamount" class="form-control"  value="<?php echo  $totalamount; ?>" placeholder="" readonly></td>
   		


   	</tr>
   		<tr>
   		<td colspan="4"></td>
   		<td>Total Deposit</td>
   		<td>  <input type="text" name="p_deposit"  id="p_deposit" class="form-control"  onkeyup="getbalance();" placeholder="Deposit Amount"></td>
   		


   	</tr>
   	 	</tr>
   		<tr>
   		<td colspan="4"></td>
   		<td>Balance</td>
   		<td>  <input type="text" name="p_balance"  id="p_balance" class="form-control"   placeholder=""readonly></td>
   		


   	</tr><?php } ?>
   <?php
?>