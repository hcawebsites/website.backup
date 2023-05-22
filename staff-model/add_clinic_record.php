<?php  
include_once '../database/connection.php';
extract($_POST);

if ($_POST) {
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$illness = mysqli_real_escape_string($con, $_POST['illness']);
	$medicine = mysqli_real_escape_string($con, $_POST['medicine']);
	$total = mysqli_real_escape_string($con, $_POST['total']);
	$get = mysqli_query($con, "SELECT Total as total from medicine Where ID = '$medicine'");
	$row =mysqli_fetch_assoc($get);
	$total_med = $row['total'];
	$overall = $total_med - $total;

	mysqli_query($con, "INSERT into clinic_record (Student_ID, Illness, Medicine, Total) VALUES ('$std_id', '$illness', '$medicine', '$total')");
	mysqli_query($con, "UPDATE medicine set Total = '$overall' WHERE ID = '$medicine'");

}
?>