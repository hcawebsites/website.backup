<?php  
include_once '../database/connection.php';

extract($_POST); 	
	$from = date("Y-m-d", strtotime($_POST['from']));
    $to = date("Y-m-d", strtotime($_POST['to']));
	$std_id = mysqli_real_escape_string($con, $_POST['std_id']);
	$output = "";

	$get = mysqli_query($con, "SELECT * from std_grade inner join schedule on std_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE Date BETWEEN '$from' AND '$to' AND Student_ID = '$std_id'");
	if (mysqli_num_rows($get) > 0) {
		while ($row = mysqli_fetch_assoc($get)) {
		$output .="
			<tr style='font-size: 13px; font-weight: 600; color:#666666'>
				<td>".$row['Subject']."</td>
				<td>".$row['Description']."</td>
				<td>".$row['Final']."</td>
				<td>".$row['SY']."</td>
			</tr>
		";
	}
	}else{
		$output .="
			<tr style='font-size: 13px; font-weight: 600; color:#666666'>
				<td colspan='8' class='text-center'>No Record Found</td>
			</tr>
		";
	}

	echo $output;
?>