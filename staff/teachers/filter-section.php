<?php include_once '../../database/connection.php'?>
<?php 
$output = "";
$sql = "SELECT * from grade WHERE ID = '".$_POST['grade']."'";
$result = mysqli_query($con, $sql);
$output .= '<option value="" hidden selected>Please select here</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="'.$row['Section'].'">'.$row['Section'].'</option>';

}
echo $output;

?>