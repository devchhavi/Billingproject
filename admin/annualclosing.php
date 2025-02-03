<?php 



require_once('../include/db.php');
 include_once '../include/ram.php';
   $ramObj = new ram;

global $link;

$resultscdm = mysqli_query($link, "SELECT * FROM `yearly_closing_statement` order by id desc limit 1");

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

  $datedifference=365;
}

 if ($datedifference>=365) {
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
      $Point_Year = $row['Point_Year'];
      $years_closed = $row['years_closed'];
       $rectimestamp = Date("Y-m-d H:i:s");
      $years_closed=$years_closed+1;
      if ($Point_Year>=100000) {
        $awardandrewardincome=19465000;
      }
       elseif ($Point_Year>=50000) {
        $awardandrewardincome=9465000;
      }
       elseif ($Point_Year>=25000) {
        $awardandrewardincome=4465000;
      }
       elseif ($Point_Year>=10000) {
        $awardandrewardincome=1965000;
      }
       elseif ($Point_Year>=5000) {
        $awardandrewardincome=965000;
      }
       elseif ($Point_Year>=2500) {
        $awardandrewardincome=465000;
      }
       elseif ($Point_Year>=1000) {
        $awardandrewardincome=265000;
      }
        elseif ($Point_Year>=500) {
        $awardandrewardincome=165000;
      }
        elseif ($Point_Year>=250) {
        $awardandrewardincome=90000;
      }
        elseif ($Point_Year>=100) {
        $awardandrewardincome=40000;
      }
        elseif ($Point_Year>=25) {
        $awardandrewardincome=15000;
      }
        elseif ($Point_Year>=10) {
        $awardandrewardincome=5000;
      }
      else {
        $awardandrewardincome=0;
      }


      if ($years_closed==1) {
        if ($Point_Year>=240) {
          $trip="International-Family";
        }
        elseif($Point_Year>=120){
          $trip="International-Single";

        }
        elseif($Point_Year>=60){
          $trip="National-Family";

        }
        elseif($Point_Year>=30){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }

       if ($years_closed==2) {
        if ($Point_Year>=480) {
          $trip="International-Family";
        }
        elseif($Point_Year>=240){
          $trip="International-Single";

        }
        elseif($Point_Year>=120){
          $trip="National-Family";

        }
        elseif($Point_Year>=60){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }
       if ($years_closed==3) {
        if ($Point_Year>=720) {
          $trip="International-Family";
        }
        elseif($Point_Year>=360){
          $trip="International-Single";

        }
        elseif($Point_Year>=180){
          $trip="National-Family";

        }
        elseif($Point_Year>=90){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }
       if ($years_closed==4) {
        if ($Point_Year>=960) {
          $trip="International-Family";
        }
        elseif($Point_Year>=480){
          $trip="International-Single";

        }
        elseif($Point_Year>=240){
          $trip="National-Family";

        }
        elseif($Point_Year>=120){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }
       if ($years_closed==5) {
        if ($Point_Year>=1200) {
          $trip="International-Family";
        }
        elseif($Point_Year>=600){
          $trip="International-Single";

        }
        elseif($Point_Year>=300){
          $trip="National-Family";

        }
        elseif($Point_Year>=150){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }
       if ($years_closed>=6) {
        if ($Point_Year>=1600) {
          $trip="International-Family";
        }
        elseif($Point_Year>=800){
          $trip="International-Single";

        }
        elseif($Point_Year>=400){
          $trip="National-Family";

        }
        elseif($Point_Year>=200){
          $trip="National-Single";

        }
        else{
          $trip="No-trip";
        }
      }

 $tdsamount=($awardandrewardincome*$tdsper)/100;
 $profeeamount=($awardandrewardincome*$pro_fee)/100;
 $charityamount=($awardandrewardincome*$Charity)/100;
 $travelamount=($awardandrewardincome*$Travelling)/100;
 $totalincome=$awardandrewardincome-($tdsamount+$profeeamount);





mysqli_query($link,"INSERT INTO `yearly_closing_statement` (`id`, `member_id`, `member_name`, `Closing_Date`, `RectimeStamp`, `Point_Year`, `Rewards_Value`, `Trip`, `Year_After_Joining`, `total_income`, `Total_tds`, `Total_processing`, `Total_Travelling`, `Total_Charity`) VALUES ('NULL', '$member_id', '$member_name', '$Closing_Date', '$rectimestamp', '$Point_Year', '$awardandrewardincome', '$trip', '$years_closed', '$totalincome', '$tdsamount', '$profeeamount', '$travelamount', '$charityamount')");
 
$resultP = mysqli_query($link, "UPDATE `members` SET `years_closed`=years_closed+1,`Total_wallet`=Total_wallet+'$awardandrewardincome',`total_income`=total_income+$totalincome,`Total_tds`=Total_tds+$tdsamount, `Total_processing`=Total_processing+$profeeamount, `Total_Travelling`=Total_Travelling+$travelamount, `Total_Charity`=Total_Charity+$charityamount, `Point_Year`=0 WHERE m_id='$member_id'"); 
       
}

echo "Closing Successful";


}
else{

  echo"Annual Closing Already has been done";
}



?>