<?php
    require_once('../include/db.php');
    

$state_id = $_POST['state_id'];

$query = "SELECT * FROM `cities` WHERE state_id='$state_id'";
$result = mysqli_query($link, $query);
$rowcount = mysqli_num_rows($result);
if ($rowcount > 0) {
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php
}
}
else{
    echo '<option value="">Select your city</option>';
}
?>