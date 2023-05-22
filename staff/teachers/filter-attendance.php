<?php  
include_once '../../database/connection.php';
extract($_POST);
$count = 1;
$sched_id = mysqli_real_escape_string($con, $_POST['subject']);
$from = mysqli_real_escape_string($con, $_POST['from']);
$to = mysqli_real_escape_string($con, $_POST['to']);
$myID = mysqli_real_escape_string($con, $_POST['myID']);
$output = "";

$get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' AND std_attendance.Sched_ID = '$sched_id' AND std_attendance.Date BETWEEN '$from' AND '$to' ORDER BY std_attendance.ID ASC");
if (mysqli_num_rows($get) > 0) {
	while ($row = mysqli_fetch_assoc($get)) {
		$class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
		$in = date('h:i A', strtotime($row['Time_In']));
		$out = date('h:i A', strtotime($row['Time_Out']));
		$date = date('F j, Y', strtotime($row['date']));
		if ($row['status'] == "On Time") {
			$output .= 
			'
				<tr>
					<td style="vertical-align: middle;" scope="col">'.$count++.'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Student_ID'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['name'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Description'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$class.'</td>
					<td style="vertical-align: middle;" scope="col">'.$in.'</td>
					<td style="vertical-align: middle;" scope="col">'.$out.'</td>
					<td style="vertical-align: middle;" scope="col" class="text-center"><p style="background-color: #74fa5f">On Time</p></td>
					<td style="vertical-align: middle;" scope="col">'.$date.'</td>
				</tr>
			';
		}elseif ($row['status'] == "Late") {
			$output .= 
			'
				<tr>
					<td style="vertical-align: middle;" scope="col">'.$count++.'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Student_ID'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['name'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Description'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$class.'</td>
					<td style="vertical-align: middle;" scope="col">'.$in.'</td>
					<td style="vertical-align: middle;" scope="col">'.$out.'</td>
					<td style="vertical-align: middle;" scope="col" class="text-center"><p style="background-color: #b2c40e">Late</p></td>
					<td style="vertical-align: middle;" scope="col">'.$date.'</td>
				</tr>
			';
		}else{
			$output .= 
			'
				<tr>
					<td style="vertical-align: middle;" scope="col">'.$count++.'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Student_ID'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['name'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$row['Description'].'</td>
					<td style="vertical-align: middle;" scope="col">'.$class.'</td>
					<td style="vertical-align: middle;" scope="col">'.$in.'</td>
					<td style="vertical-align: middle;" scope="col">'.$out.'</td>
					<td style="vertical-align: middle;" scope="col" class="text-center"><p style="background-color: #fa5f5f">Absent</p></td>
					<td style="vertical-align: middle;" scope="col">'.$date.'</td>
				</tr>
			';
		}
	}
}else{
	$output .=
	"
		<tr>
			<td colspan='9' class='text-center'>No Record Found!</td>
		</tr>
	";
}
echo $output;
?>