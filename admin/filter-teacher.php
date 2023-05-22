<?php include_once '../database/connection.php'?>
<?php 
$output = "";
$sql = "SELECT *, teacher_tb.ID as id from grade inner join teacher_tb on grade.Department = teacher_tb.Department
 WHERE grade.Name = '".$_POST['grade']."'";

$result = mysqli_query($con, $sql);
$output .= '<option value="" disabled selected>Select Teacher</option>';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="'.$row['Emp_ID'].'">'.$row['Salutation'].'. '.$row['Lastname'].', '.$row['Firstname'].'</option>';

}
echo $output;

?>