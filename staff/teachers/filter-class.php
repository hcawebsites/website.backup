<?php  
include_once '../../database/connection.php';
$sched_id = mysqli_real_escape_string($con, $_POST['sched_id']);

$get = mysqli_query($con, "SELECT * FROM schedule inner join grade on schedule.Class_ID = grade.ID Where schedule.ID = '$sched_id'");
while ($row = mysqli_fetch_assoc($get)) {
	$data['class'] = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
}
echo json_encode($data);

?>