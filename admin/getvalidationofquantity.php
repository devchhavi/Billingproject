<?php

require_once('../include/db.php');
 $p_name = $_POST['p_name'];
  $p_quantity = $_POST['p_quantity'];
   $purchasetempid = $_POST['purchasetempid'];
   $results = mysqli_query($link, "SELECT * FROM `sale_product_list` WHERE product_id='$p_name'");
   $rowcounts = mysqli_num_rows($results);
   if ($rowcounts>0) {
   $rows = mysqli_fetch_array($results);
   $compquantitys=$rows['Quantity'];
   
   }
   else{

   	 $compquantitys=0;
   }
$result = mysqli_query($link, "SELECT * FROM `product` WHERE Product_Code='$p_name'");
 $rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$compquantity=$row['Available']-$compquantitys;
if ($compquantity >=$p_quantity) {
	
    echo"";
}
else{

	echo"Entered Quantity is greater than available Quantity";
} 
?>