<?php include_once '../../database/connection.php'?>
<?php 
$output = "";
$sql = "SELECT * from schedule WHERE Grade = '".$_POST['grade']."' Group By Section";
$result = mysqli_query($con, $sql);
$output .= '<option value="" disabled selected>Select Section</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="'.$row['Section'].'">'.$row['Section'].'</option>';

}
echo $output;

?>