<?php
   require_once '../include/db.php';
	if(!$link) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $link->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				  $result_um = mysqli_query($link, "SELECT * FROM product WHERE Name LIKE '$queryString%' OR Product_Code LIKE '$queryString%' LIMIT 10");
				  	  $rowcountDDL = mysqli_num_rows($result_um);
				
				if($rowcountDDL>0) {
				echo '<ul>';
					while ($row_um =mysqli_fetch_array($result_um)) {
	         			echo '<li onClick="fill(\''.addslashes($row_um['Product_Code']).'\');getprice();">'.$row_um['Product_Code'].' - '.$row_um['Name'].'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>