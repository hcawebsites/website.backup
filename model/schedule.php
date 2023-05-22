<?php 
include_once '../database/connection.php';
error_reporting(0);
if ($_POST) {
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}

    $teacherID = mysqli_real_escape_string($con, $_POST['teacher']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $strand = mysqli_real_escape_string($con, $_POST['str']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
	$dept = mysqli_real_escape_string($con, $_POST['dept']);
    $f2f = mysqli_real_escape_string($con, $_POST['section']);
	$time = mysqli_real_escape_string($con, $_POST['time']);
	$code = random_strings(6);
	$options = mysqli_real_escape_string($con, $_POST['option']);
	
	$days = implode(',', $_POST['day']);

	if ($options == "Online") {
		if ($dept == "SHSDEPT") {
			/*---------Check Conflict teacher--------------*/
			$query_teacher = mysqli_query($con, "SELECT *, count(*) as count From schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id Where schedule.Teacher_ID = '$teacherID' And schedule.Time_ID = '$time' And schedule.Day = '$days'");
			$row = mysqli_fetch_assoc($query_teacher);
			$count_t = $row['count'];
			$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
			$name_t = $row['Salutation']. ". " .$row['Lastname'];
			
			$error_t ='
				<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
					<thead>
						<tr>
						<th>Day</th>
						<th>Time</th>
						<th>Teacher</th>
						<th>Status</th>
						</tr>
					</thead>
					<tr>
						<td>'.$days.'</td>
						<td>'.$time_t.'</td>
						<td>'.$name_t.'</td>
						<td class="text-danger"><b>Not Available</b></td>
					
					</tr>
				</table>
			';
			/*---------End Conflict teacher--------------*/

			/*---------Check Conflict Time--------------*/
				$queryt_time = mysqli_query($con, "SELECT *, COUNT(*) as count FROM schedule inner join time on schedule.Time_ID = time.time_id WHERE Day = '$days' AND schedule.Code = '$subject' AND Class_ID = '$grade' AND Strand = '$strand'");

				$row = mysqli_fetch_assoc($queryt_time);
				$count = $row['count'];
				$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
				$query_grade = mysqli_query($con, "SELECT * FROM grade WHERE ID ='$grade'");
				$row_grade = mysqli_fetch_assoc($query_grade);
				$class = $row_grade['Name']. " - " .$row_grade['Section'];
				
				$error_time ='
					<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
						<thead>
							<tr>
							<th>Class</th>
							<th>Day</th>
							<th>Time</th>
							<th>Status</th>
							</tr>
						</thead>
						<tr>
							<td>'.$class.'</td>
							<td>'.$days.'</td>
							<td>'.$time_t.'</td>
							<td class="text-danger"><b>Not Available</b></td>
						
						</tr>
					</table>
				
				';
				/*---------End Conflict Time--------------*/

				$querytime=mysqli_query($con,"select * from time where time_id='$time'");
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i A",strtotime($rowt['time_start']))."-".date("h:i A",strtotime($rowt['time_end']));

				if (($count_t == 0) and ($count == 0))
				{
					$insert = mysqli_query($con, "INSERT INTO schedule (Teacher_ID, Code, Class_ID, Strand, Room, Day, Department, Semester, Time_ID) VALUES ('$teacherID', '$subject', '$grade', '$strand', '$options', '$days', '$dept', '$semester', '$time')");

					if ($insert) {
						$sched_id = mysqli_insert_id($con);
						$get = mysqli_query($con, "SELECT * FROM student_grade Where Class_ID = '$grade' AND Strand = '$strand'");
						while ($row = mysqli_fetch_assoc($get)) {
							$std_id = $row['Student_ID'];
							mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values ('$std_id', '$sched_id')");
						}
						mysqli_query($con, "INSERT INTO class_attendance (Sched_ID, Status) Values ('$sched_id', 0)");
						mysqli_query($con, "INSERT INTO group_chat (Sched_ID, Status) Values ('$sched_id', 0)");

						echo '
							<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
								<thead>
									<tr>
									<th>Day</th>
									<th>Time</th>
									<th>Status</th>
									</tr>
								</thead>
								<tr>
									<td>'.$days.'	</td>
									<td>'.$timet.'</td>
									<td class="text-success"><b>Success</b></td>
								
								</tr>
							</table>
						';
					}
				}elseif ($count_t > 0) {
					echo $error_t;
				}else{
					echo $error_time;
				}
			
		}//SHSDEPT
		else{
			/*---------Check Conflict teacher--------------*/
			$query_teacher = mysqli_query($con, "SELECT *, count(*) as count From schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id Where schedule.Teacher_ID = '$teacherID' And schedule.Time_ID = '$time' And schedule.Day = '$days'");
			$row = mysqli_fetch_assoc($query_teacher);
			$count_t = $row['count'];
			$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
			$name_t = $row['Salutation']. ". " .$row['Lastname'];
			
			$error_t ='
				<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
					<thead>
						<tr>
						<th>Day</th>
						<th>Time</th>
						<th>Teacher</th>
						<th>Status</th>
						</tr>
					</thead>
					<tr>
						<td>'.$days.'</td>
						<td>'.$time_t.'</td>
						<td>'.$name_t.'</td>
						<td class="text-danger"><b>Not Available</b></td>
					
					</tr>
				</table>
			';
			/*---------End Conflict teacher--------------*/

			/*---------Check Conflict Time--------------*/
				$queryt_time = mysqli_query($con, "SELECT *, COUNT(*) as count FROM schedule inner join time on schedule.Time_ID = time.time_id WHERE Day = '$days' AND schedule.Code = '$subject' AND Class_ID = '$grade'");

				$row = mysqli_fetch_assoc($queryt_time);
				$count = $row['count'];
				$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
				$query_grade = mysqli_query($con, "SELECT * FROM grade WHERE ID ='$grade'");
				$row_grade = mysqli_fetch_assoc($query_grade);
				$class = $row_grade['Name']. " - " .$row_grade['Section'];
				
				$error_time ='
					<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
						<thead>
							<tr>
							<th>Class</th>
							<th>Day</th>
							<th>Time</th>
							<th>Status</th>
							</tr>
						</thead>
						<tr>
							<td>'.$class.'</td>
							<td>'.$days.'</td>
							<td>'.$time_t.'</td>
							<td class="text-danger"><b>Not Available</b></td>
						
						</tr>
					</table>
				
				';
				/*---------End Conflict Time--------------*/

				$querytime=mysqli_query($con,"select * from time where time_id='$time'");
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i A",strtotime($rowt['time_start']))."-".date("h:i A",strtotime($rowt['time_end']));

				if (($count_t == 0) and ($count == 0))
				{
					$insert = mysqli_query($con, "INSERT INTO schedule (Teacher_ID, Code, Class_ID, Room, Day, Department, Time_ID) VALUES ('$teacherID', '$subject', '$grade', '$options', '$days', '$dept', '$time')");

					if ($insert) {
						$sched_id = mysqli_insert_id($con);
						$get = mysqli_query($con, "SELECT * FROM student_grade Where Class_ID = '$grade'");
						while ($row = mysqli_fetch_assoc($get)) {
							$std_id = $row['Student_ID'];
							mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values ('$std_id', '$sched_id')");
						}
						mysqli_query($con, "INSERT INTO class_attendance (Sched_ID, Status) Values ('$sched_id', 0)");

						echo '
							<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
								<thead>
									<tr>
									<th>Day</th>
									<th>Time</th>
									<th>Status</th>
									</tr>
								</thead>
								<tr>
									<td>'.$days.'	</td>
									<td>'.$timet.'</td>
									<td class="text-success"><b>Success</b></td>
								
								</tr>
							</table>
						';
					}
				}elseif ($count_t > 0) {
					echo $error_t;
				}else{
					echo $error_time;
				}

		}
	}/**End of Online**/
	else{
		if ($dept == "SHSDEPT") {
			/*---------Check Conflict teacher--------------*/
			$query_teacher = mysqli_query($con, "SELECT *, count(*) as count From schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id Where schedule.Teacher_ID = '$teacherID' And schedule.Time_ID = '$time' And schedule.Day = '$days'");
			$row = mysqli_fetch_assoc($query_teacher);
			$count_t = $row['count'];
			$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
			$name_t = $row['Salutation']. ". " .$row['Lastname'];
			
			$error_t ='
				<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
					<thead>
						<tr>
						<th>Day</th>
						<th>Time</th>
						<th>Teacher</th>
						<th>Status</th>
						</tr>
					</thead>
					<tr>
						<td>'.$days.'</td>
						<td>'.$time_t.'</td>
						<td>'.$name_t.'</td>
						<td class="text-danger"><b>Not Available</b></td>
					
					</tr>
				</table>
			';
			/*---------End Conflict teacher--------------*/

			/*---------Check Conflict Time--------------*/
				$queryt_time = mysqli_query($con, "SELECT *, COUNT(*) as count FROM schedule inner join time on schedule.Time_ID = time.time_id WHERE Day = '$days' AND schedule.Code = '$subject' AND Class_ID = '$grade' AND Strand = '$strand'");

				$row = mysqli_fetch_assoc($queryt_time);
				$count = $row['count'];
				$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
				$query_grade = mysqli_query($con, "SELECT * FROM grade WHERE ID ='$grade'");
				$row_grade = mysqli_fetch_assoc($query_grade);
				$class = $row_grade['Name']. " - " .$row_grade['Section'];
				
				$error_time ='
					<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
						<thead>
							<tr>
							<th>Class</th>
							<th>Day</th>
							<th>Time</th>
							<th>Status</th>
							</tr>
						</thead>
						<tr>
							<td>'.$class.'</td>
							<td>'.$days.'</td>
							<td>'.$time_t.'</td>
							<td class="text-danger"><b>Not Available</b></td>
						
						</tr>
					</table>
				
				';
				/*---------End Conflict Time--------------*/

				$querytime=mysqli_query($con,"select * from time where time_id='$time'");
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i A",strtotime($rowt['time_start']))."-".date("h:i A",strtotime($rowt['time_end']));

				if (($count_t == 0) and ($count == 0))
				{
					$insert = mysqli_query($con, "INSERT INTO schedule (Teacher_ID, Code, Class_ID, Strand, Room, Day, Department, Semester, Time_ID) VALUES ('$teacherID', '$subject', '$grade', '$strand', '$f2f', '$days', '$dept', '$semester', '$time')");

					if ($insert) {
						$sched_id = mysqli_insert_id($con);
						$get = mysqli_query($con, "SELECT * FROM student_grade Where Class_ID = '$grade' AND Strand = '$strand'");
						while ($row = mysqli_fetch_assoc($get)) {
							$std_id = $row['Student_ID'];
							mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values ('$std_id', '$sched_id')");
						}
						mysqli_query($con, "INSERT INTO class_attendance (Sched_ID, Status) Values ('$sched_id', 0)");

						echo '
							<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
								<thead>
									<tr>
									<th>Day</th>
									<th>Time</th>
									<th>Status</th>
									</tr>
								</thead>
								<tr>
									<td>'.$days.'	</td>
									<td>'.$timet.'</td>
									<td class="text-success"><b>Success</b></td>
								
								</tr>
							</table>
						';
					}
				}elseif ($count_t > 0) {
					echo $error_t;
				}else{
					echo $error_time;
				}
			
		}//SHSDEPT
		else{
			/*---------Check Conflict teacher--------------*/
			$query_teacher = mysqli_query($con, "SELECT *, count(*) as count From schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id Where schedule.Teacher_ID = '$teacherID' And schedule.Time_ID = '$time' And schedule.Day = '$days'");
			$row = mysqli_fetch_assoc($query_teacher);
			$count_t = $row['count'];
			$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
			$name_t = $row['Salutation']. ". " .$row['Lastname'];
			
			$error_t ='
				<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
					<thead>
						<tr>
						<th>Day</th>
						<th>Time</th>
						<th>Teacher</th>
						<th>Status</th>
						</tr>
					</thead>
					<tr>
						<td>'.$days.'</td>
						<td>'.$time_t.'</td>
						<td>'.$name_t.'</td>
						<td class="text-danger"><b>Not Available</b></td>
					
					</tr>
				</table>
			';
			/*---------End Conflict teacher--------------*/

			/*---------Check Conflict Time--------------*/
				$queryt_time = mysqli_query($con, "SELECT *, COUNT(*) as count FROM schedule inner join time on schedule.Time_ID = time.time_id WHERE Day = '$days' AND schedule.Code = '$subject' AND Class_ID = '$grade'");

				$row = mysqli_fetch_assoc($queryt_time);
				$count = $row['count'];
				$time_t = date("h:i A", strtotime($row['time_start'])). " - " . date("h:i A", strtotime($row['time_end']));
				$query_grade = mysqli_query($con, "SELECT * FROM grade WHERE ID ='$grade'");
				$row_grade = mysqli_fetch_assoc($query_grade);
				$class = $row_grade['Name']. " - " .$row_grade['Section'];
				
				$error_time ='
					<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
						<thead>
							<tr>
							<th>Class</th>
							<th>Day</th>
							<th>Time</th>
							<th>Status</th>
							</tr>
						</thead>
						<tr>
							<td>'.$class.'</td>
							<td>'.$days.'</td>
							<td>'.$time_t.'</td>
							<td class="text-danger"><b>Not Available</b></td>
						
						</tr>
					</table>
				
				';
				/*---------End Conflict Time--------------*/

				$querytime=mysqli_query($con,"select * from time where time_id='$time'");
				$rowt=mysqli_fetch_array($querytime);
				$timet=date("h:i A",strtotime($rowt['time_start']))."-".date("h:i A",strtotime($rowt['time_end']));

				if (($count_t == 0) and ($count == 0))
				{
					$insert = mysqli_query($con, "INSERT INTO schedule (Teacher_ID, Code, Class_ID, Room, Day, Department, Time_ID) VALUES ('$teacherID', '$subject', '$grade', '$f2f', '$days', '$dept', '$time')");

					if ($insert) {
						$sched_id = mysqli_insert_id($con);
						$get = mysqli_query($con, "SELECT * FROM student_grade Where Class_ID = '$grade'");
						while ($row = mysqli_fetch_assoc($get)) {
							$std_id = $row['Student_ID'];
							mysqli_query($con, "INSERT INTO handle_student (Student_ID, Sched_ID) Values ('$std_id', '$sched_id')");
						}
						mysqli_query($con, "INSERT INTO class_attendance (Sched_ID, Status) Values ('$sched_id', 0)");

						echo '
							<table class="table table-bordered table-striped" style="color: #5c5c5c; font-size:13px; font-weight:300">
								<thead>
									<tr>
									<th>Day</th>
									<th>Time</th>
									<th>Status</th>
									</tr>
								</thead>
								<tr>
									<td>'.$days.'	</td>
									<td>'.$timet.'</td>
									<td class="text-success"><b>Success</b></td>
								
								</tr>
							</table>
						';
					}
				}elseif ($count_t > 0) {
					echo $error_t;
				}else{
					echo $error_time;
				}

		}
	}
}
?>