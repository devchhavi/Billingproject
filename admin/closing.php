<?php 



require_once('../include/db.php');
 include_once '../include/ram.php';
   $ramObj = new ram;

global $link;

$resultscdm = mysqli_query($link, "SELECT * FROM `monthly_closing_statement` order by id desc limit 1");

$rowcountsscdm = mysqli_num_rows($resultscdm);
if ($rowcountsscdm>0) {
  $row_umcdm = mysqli_fetch_array($resultscdm);
$datetocompare=$row_umcdm['Closing_Date'];
$todaydate=date("Y-m-d");
$date1=date_create($datetocompare);
$date2=date_create($todaydate);
$diff=date_diff($date1,$date2);
 $datedifference=$diff->format("%a");
}
else{

  $datedifference=30;
}

 if ($datedifference>=30) {
  
 
 $querys = "SELECT * FROM `charges_deduction` order by id desc";
  $results = mysqli_query($link, $querys);
    $row_um = mysqli_fetch_array($results);
    $tdsper= $row_um['tds']; 
     $pro_fee= $row_um['pro_fee'];
      $Travelling= $row_um['Travelling'];
       $Charity= $row_um['Charity'];
        $Pv_Matching_charge= $row_um['Pv_Matching_charge'];
        date_default_timezone_set('Asia/Kolkata');
         $Closing_Date=date("Y-m-d");
   
$result = mysqli_query($link, "SELECT * FROM `members`");
while ($row = mysqli_fetch_array($result)) {
      $member_id = $row['m_id'];
    $member_name = $row['m_name'];
     $pvpurchase = $row['PV_Purchase'];
    $month_pv_matching = $row['month_pv_matching'];
     $month_BP_Count = $row['month_BP_Count'];
      $month_BP = $row['month_BP'];
     $Daily_Max_Pv_Matching=$row['Daily_Max_Pv_Matching'];
      $left_month_bp=$row['left_month_bp'];
      $right_month_bp=$row['right_month_bp'];
       $sponsorid=$row['sponsor_id'];
     if ($pvpurchase>=3) {

      $pvincomemonth=$month_pv_matching*$Pv_Matching_charge;
       
     }
     else{

      $pvincomemonth=0;

     }

      if ($month_BP>=1000) {

     $month_BP_Count=$month_BP_Count+1;

     if ($month_BP_Count>=12) {
       $Daily_Max_Pv_Matching=20;
     }
       
     }
     else{

      $month_BP_Count=0;

     }
   
  
     $income_month=$row['income_month'];

                    $greenroyalclubss=0;
                    $blueroyalclubss=0;
                    $blackroyalclubss=0;
                    $silverroyalclubss=0;
                    $goldroyalclubss=0;
                    $diamondroyalclubss=0;   
       $ResultAllsss = mysqli_query($link, "SELECT * FROM `members` WHERE sponsor_id ='$member_id'");

             $rowcountsscdms = mysqli_num_rows($ResultAllsss);
             if ($rowcountsscdms>0) {
                while($RowAllsss = mysqli_fetch_array($ResultAllsss)){

                   $leftbps=$RowAllsss['Accumulation_BP_Month'];
                   if ($leftbps>=2500000) {


                    $greenroyalclubss=$greenroyalclubss+1;
                    $blueroyalclubss=$blueroyalclubss+1;
                    $blackroyalclubss=$blackroyalclubss+1;
                    $silverroyalclubss=$silverroyalclubss+1;
                    $goldroyalclubss=$goldroyalclubss+1;
                    $diamondroyalclubss=$diamondroyalclubss+1;   
                   }
                    elseif ($leftbps>=1000000) {

                     $greenroyalclubss=$greenroyalclubss+1;
                    $blueroyalclubss=$blueroyalclubss+1;
                    $blackroyalclubss=$blackroyalclubss+1;
                    $silverroyalclubss=$silverroyalclubss+1;
                    $goldroyalclubss=$goldroyalclubss+1;
                    
                       
                   }
                    elseif ($leftbps>=500000) {

                   
                    $greenroyalclubss=$greenroyalclubss+1;
                    $blueroyalclubss=$blueroyalclubss+1;
                    $blackroyalclubss=$blackroyalclubss+1;
                    $silverroyalclubss=$silverroyalclubss+1;
                       
                   }
                   elseif ($leftbps>=250000) {

                   
                   
                  $greenroyalclubss=$greenroyalclubss+1;
                    $blueroyalclubss=$blueroyalclubss+1;
                    $blackroyalclubss=$blackroyalclubss+1;
                    
                       
                   }
                    elseif ($leftbps>=100000) {

                   
                   
                 
                    $greenroyalclubss=$greenroyalclubss+1;
                    $blueroyalclubss=$blueroyalclubss+1;
                    
                       
                   }
                    elseif ($leftbps>=50000) {

                   
                   
                 
                     $greenroyalclubss=$greenroyalclubss+1;
                    
                       
                   }
                   


                }


             }
            
     if ($greenroyalclubss>=2) {

      $greenroyalclub=$greenroyalclubss;
       
     }
     else{
      $greenroyalclub=0;
     }
     if ($blueroyalclubss>=2) {

      $blueroyalclub=$blueroyalclubss;
       
     }
     else{

      $blueroyalclub=0;
     }
      if ($blackroyalclubss>=2) {

      $blackroyalclub=$blackroyalclubss;
       
     }
     else{

      $blackroyalclub=0;
     }
      if ($silverroyalclubss>=2) {

      $silverroyalclub=$silverroyalclubss;
       
     }
     else{

      $silverroyalclub=0;
     }

      if ($goldroyalclubss>=2) {

      $goldroyalclub=$goldroyalclubss;
       
     }
     else{

      $goldroyalclub=0;
     }
     if ($diamondroyalclubss>=2) {

      $diamondroyalclub=$diamondroyalclubss;
       
     }
     else{

      $diamondroyalclub=0;
     }

     $totalwallet=$pvincomemonth;
   

    if ($month_BP>=100) {
    $totalwallet=$pvincomemonth+$income_month;

    }
   else{

    $totalwallet=$pvincomemonth;

   }
  
  

    $rectimestamp = Date("Y-m-d H:i:s");

       
        usleep(1 * 1000);
           mysqli_query($link,"INSERT INTO `monthly_closing_statement` (`id`, `month_pv_matching`, `left_month_bp`, `right_month_bp`, `income_month`, `month_BP`, `pv_income`, `Total_wallet`, `RectimeStamp`, `Closing_Date`, `member_id`, `member_name`, `Green_Royal_Club`, `Blue_Royal_Club`, `Black_Royal_Club`, `Silver_Royal_Club`, `Gold_Royal_Club`, `diamond_Royal_Club`, `sponsor_id`) VALUES ('NULL', '$month_pv_matching', '$left_month_bp', '$right_month_bp', '$income_month', '$month_BP', '$pvincomemonth', '$totalwallet', '$rectimestamp', '$Closing_Date', '$member_id', '$member_name', '$greenroyalclub', '$blueroyalclub', '$blackroyalclub', '$silverroyalclub', '$goldroyalclub', '$diamondroyalclub','$sponsorid')");
 
    $resultP = mysqli_query($link, "UPDATE `members` SET `pv_income`=pv_income+$pvincomemonth,`left_month_bp`=0,`left_month_bp`=0,`income_month`=0,`month_pv_matching`=0,`month_BP`=0 WHERE m_id='$member_id'"); 
        
    
}
$totaloverallmonthbp=0;
$totalgreenroyalclub=0;
$totalblueroyalclub=0;
$totalblackroyalclub=0;
$totalsilverroyalclub=0;
$totalgoldroyalclub=0;
$totaldiamondroyalclub=0;
$results = mysqli_query($link, "SELECT * FROM `monthly_closing_statement` where Closing_Date='$Closing_Date'");
while ($rows = mysqli_fetch_array($results)) {


  $totaloverallmonthbp=$totaloverallmonthbp+$rows['month_BP'];
  $totalgreenroyalclub=$totalgreenroyalclub+$rows['Green_Royal_Club'];
  $totalblueroyalclub=$totalblueroyalclub+$rows['Blue_Royal_Club'];
  $totalblackroyalclub=$totalblackroyalclub+$rows['Black_Royal_Club'];
  $totalsilverroyalclub=$totalsilverroyalclub+$rows['Silver_Royal_Club'];
  $totalgoldroyalclub=$totalgoldroyalclub+$rows['Gold_Royal_Club'];
  $totaldiamondroyalclub=$totaldiamondroyalclub+$rows['diamond_Royal_Club'];
  



}
 $totalgreenroyalclubamount=($totaloverallmonthbp*4)/100;
  $totalblueroyalclubamount=($totaloverallmonthbp*3)/100;
   $totalblackroyalclubamount=($totaloverallmonthbp*2)/100;
    $totalsilverroyalclubamount=($totaloverallmonthbp*2)/100;
     $totalgoldroyalclubamount=($totaloverallmonthbp*2)/100;
      $totaldiamondroyalclubamount=($totaloverallmonthbp*2)/100;

     if ($totalgreenroyalclub>0) {
       $Persharegreenroyalclubamount=$totalgreenroyalclubamount/$totalgreenroyalclub;
     }else{
      $Persharegreenroyalclubamount=0;
     }
      if ($totalblueroyalclub>0) {
       $Pershareblueroyalclubamount=$totalblueroyalclubamount/$totalblueroyalclub;
     }
     else{
      $Pershareblueroyalclubamount=0;
     }
      if ($totalblackroyalclub>0) {
        $Pershareblackroyalclubamount=$totalblackroyalclubamount/$totalblackroyalclub;
     }
     else{
      $Pershareblackroyalclubamount=0;
     }
      if ($totalsilverroyalclub>0) {
        $Persharesilverroyalclubamount=$totalsilverroyalclubamount/$totalsilverroyalclub;
     }
     else{
      $Persharesilverroyalclubamount=0;
     }
      if ($totalgoldroyalclub>0) {
      $Persharegoldroyalclubamount=$totalgoldroyalclubamount/$totalgoldroyalclub;
     }
     else{
      $Persharegoldroyalclubamount=0;
     }
      if ($totaldiamondroyalclub>0) {
       $Persharediamondroyalclubamount=$totaldiamondroyalclubamount/$totaldiamondroyalclub;
     }
     else{
      $Persharediamondroyalclubamount=0;
     }

     


$resultss = mysqli_query($link, "SELECT * FROM `monthly_closing_statement` where Closing_Date='$Closing_Date' order by id desc");
  $rowcountss = mysqli_num_rows($resultss);
if ($rowcountss>0) {
 
while ($rowss = mysqli_fetch_array($resultss)) {
 $member_id = $rowss['member_id'];
   
 $month_BP = $rowss['month_BP'];
  $sponsorid = $rowss['sponsor_id'];
  
  $levelcount=1;

$totalwallet=$rowss['Total_wallet'];
$greenroyalclubamount=$rowss['Green_Royal_Club']* $Persharegreenroyalclubamount;
$blueroyalclubamount=$rowss['Blue_Royal_Club']* $Pershareblueroyalclubamount;
$blackroyalclubamount=$rowss['Green_Royal_Club']* $Pershareblackroyalclubamount;
$silverroyalclubamount=$rowss['Green_Royal_Club']* $Persharesilverroyalclubamount;
$goldroyalclubamount=$rowss['Green_Royal_Club']* $Persharegoldroyalclubamount;
$diamondroyalclubamount=$rowss['Green_Royal_Club']* $Persharediamondroyalclubamount;


 $resultP = mysqli_query($link, "UPDATE `monthly_closing_statement` SET `Green_Royal_Club_Amount`='$greenroyalclubamount',`Blue_Royal_Club_Amount`='$blueroyalclubamount',`Black_Royal_Club_Amount`='$blackroyalclubamount',`Silver_Royal_Club_Amount`='$silverroyalclubamount',`Gold_Royal_Club_Amount`='$goldroyalclubamount',`diamond_Royal_Club_Amount`='$diamondroyalclubamount' where Closing_Date='$Closing_Date' and member_id='$member_id'");

 $totalwallet=$totalwallet+$greenroyalclubamount+$blueroyalclubamount+$blackroyalclubamount+$silverroyalclubamount+$goldroyalclubamount+$diamondroyalclubamount;
 
if ($sponsorid=="") {



  
}
else{

$ramObj->sendreferralincome($sponsorid,$levelcount,$totalwallet,$Closing_Date);

}

}
}



$resultssss = mysqli_query($link, "SELECT * FROM `monthly_closing_statement` where Closing_Date='$Closing_Date'");
  $rowcountssss = mysqli_num_rows($resultssss);
if ($rowcountssss>0) {
 
while ($rowssss = mysqli_fetch_array($resultssss)) {
 $member_id = $rowssss['member_id'];
   
 $month_BP = $rowssss['month_BP'];
  $sponsorid = $rowssss['sponsor_id'];
 
  $referralincome = $rowssss['referal_income'];
 
$totalwallet=$rowssss['Total_wallet'];
$greenroyalclubamount=$rowssss['Green_Royal_Club_Amount'];
$blueroyalclubamount=$rowssss['Blue_Royal_Club_Amount'];
$blackroyalclubamount=$rowssss['Black_Royal_Club_Amount'];
$silverroyalclubamount=$rowssss['Silver_Royal_Club_Amount'];
$goldroyalclubamount=$rowssss['Gold_Royal_Club_Amount'];
$diamondroyalclubamount=$rowssss['diamond_Royal_Club_Amount'];

  $totalwallet=$totalwallet+$greenroyalclubamount+$blueroyalclubamount+$blackroyalclubamount+$silverroyalclubamount+$goldroyalclubamount+$diamondroyalclubamount+$referralincome;


 $tdsamount=($totalwallet*$tdsper)/100;
 $profeeamount=($totalwallet*$pro_fee)/100;
 $charityamount=($totalwallet*$Charity)/100;
 $travelamount=($totalwallet*$Travelling)/100;
 $totalincome=$totalwallet-($tdsamount+$profeeamount);
 $resultPS = mysqli_query($link, "UPDATE `monthly_closing_statement` SET `Total_wallet`='$totalwallet', `Total_tds`='$tdsamount', `Total_processing`='$profeeamount', `Total_Travelling`='$travelamount', `Total_Charity`='$charityamount', `total_income`='$totalincome' WHERE member_id='$member_id' and Closing_Date='$Closing_Date' ");

  $resultPSS = mysqli_query($link, "UPDATE `members` SET `Total_wallet`=Total_wallet+$totalwallet, `total_income`=total_income+$totalincome, `Total_tds`=Total_tds+$tdsamount, `Total_processing`=Total_processing+$profeeamount, `Total_Travelling`=Total_Travelling+$travelamount, `Total_Charity`=Total_Charity+$charityamount, `referal_income`=referal_income+$referralincome, `Green_Royal_Club_Amount`=Green_Royal_Club_Amount+$greenroyalclubamount, `Blue_Royal_Club_Amount`=Blue_Royal_Club_Amount+$blueroyalclubamount, `Black_Royal_Club_Amount`=Black_Royal_Club_Amount+$blackroyalclubamount, `Silver_Royal_Club_Amount`=Silver_Royal_Club_Amount+$silverroyalclubamount, `Gold_Royal_Club_Amount`=Gold_Royal_Club_Amount+$goldroyalclubamount, `diamond_Royal_Club_Amount`=diamond_Royal_Club_Amount+$diamondroyalclubamount, `Accumulation_BP_Month`=0 WHERE m_id='$member_id'");


}



}

echo "Closing Successful";

}
else{

  echo"Monthly Closing Already has been done";
}



?>