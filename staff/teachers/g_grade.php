<?php include_once '../../database/connection.php'?>
<?php 
$output = "";
$sql = "SELECT * from schedule WHERE Code = '".$_POST['subject']."' Group By Grade";
$result = mysqli_query($con, $sql);
$output .= '<option value="" disabled selected>Select Section</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="'.$row['Grade'].'">'.$row['Grade'].'</option>';

}
echo $output;

?>