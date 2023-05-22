<?php include_once '../database/connection.php'?>
<?php 
$output = "";
$sql = "SELECT * from grade WHERE Department = '".$_POST['dept']."'";
$result = mysqli_query($con, $sql);
$output .= '<option value="">Select Grade</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';

}
echo $output;

?>