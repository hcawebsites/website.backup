<?php  
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$data = explode(',', $_POST['data']);
$std_id = $data[0];
$sched_id = $data[1];

$_get = mysqli_query($con, "SELECT * FROM class_attendance inner join schedule on class_attendance.Sched_ID = schedule.ID WHERE Sched_ID = '$sched_id'");
$_row = mysqli_fetch_assoc($_get);
$status = $_row['Status'];
$dept = $_row['Department'];
$time = $_row['Start_Time'];
$new_time = date('H:i:s', strtotime("+15 minutes", strtotime($time)));
$default = date('H:i:s');
$date = date('Y-m-d');


if ($default <= $new_time) {
	if ($status == 1) {
		$_chk_enrolled = mysqli_query($con, "SELECT * FROM joinclass inner join classroom on joinclass.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID WHERE schedule.ID = '$sched_id' AND joinclass.Student_ID = '$std_id'");
		if (mysqli_num_rows($_chk_enrolled) > 0) {
			$_chk_attendance = mysqli_query($con, "SELECT * FROM std_attendance WHERE Sched_ID = '$sched_id' AND Student_ID = '$std_id'");
			if (mysqli_num_rows($_chk_attendance) > 0) {
				echo 'Attendance Already Saved!';
			}else{
				$_insert = mysqli_query($con, "INSERT INTO std_attendance (Student_ID, Sched_ID, Time_In, Status) Values ('$std_id', '$sched_id', '$default', 'On Time')");
				if ($_insert) {
					echo "success";
				}

			}
		}else{
			echo "You Are Not Enrolled to this Subject!";
		}
	}else{
		echo "Attendance Scanning Close!";
	}
}else{
	$_chk_enrolled = mysqli_query($con, "SELECT * FROM joinclass inner join classroom on joinclass.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID WHERE schedule.ID = '$sched_id' AND joinclass.Student_ID = '$std_id'");
	if (mysqli_num_rows($_chk_enrolled) > 0) {
		$_chk_attendance = mysqli_query($con, "SELECT * FROM std_attendance WHERE Sched_ID = '$sched_id' AND Student_ID = '$std_id'");
			if (mysqli_num_rows($_chk_attendance) > 0) {
				echo 'Attendance Already Saved!';
			}else{
				$_insert = mysqli_query($con, "INSERT INTO std_attendance (Student_ID, Sched_ID, Time_In, Status) Values ('$std_id', '$sched_id', '$default', 'Late')");
				if ($_insert) {
					echo "success";
				}

			}
		
	}else{
		echo "You Are Not Enrolled to this Subject!";
	}
}
?>