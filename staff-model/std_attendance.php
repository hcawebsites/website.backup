<?php  
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$std_id = mysqli_real_escape_string($con, $_POST['student_id']);
$sched_id = $_GET['sched_id'];

$_get = mysqli_query($con, "SELECT * FROM class_attendance inner join schedule on class_attendance.Sched_ID = schedule.ID WHERE Sched_ID = '$sched_id'");
$_row = mysqli_fetch_assoc($_get);
$status = $_row['Status'];
$dept = $_row['Department'];
$time = $_row['Start_Time'];
$new_time = date('H:i:s', strtotime("+30 minutes", strtotime($time)));
$default = date('H:i:s');
$date = date('Y-m-d');

if ($default <= $new_time) {
	if ($status == 1) {
		$_chk_enrolled = mysqli_query($con, "SELECT * FROM schedule inner join handle_student on schedule.ID = handle_student.Sched_ID WHERE schedule.ID = '$sched_id' AND handle_student.Student_ID = '$std_id'");
		if (mysqli_num_rows($_chk_enrolled)) {
			$_chk_attendance = mysqli_query($con, "SELECT * FROM std_attendance WHERE Sched_ID = '$sched_id' AND Student_ID = '$std_id'");
			if (mysqli_num_rows($_chk_attendance) > 0) {
				echo '<div class="alert alert-danger" role="alert">
                <p style="font-weight: 500; font-size: 12px">Attendance Already Saved!</p>
                </div>';
			}else{
				$_insert = mysqli_query($con, "INSERT INTO std_attendance (Student_ID, Sched_ID, Time_In, Status) Values ('$std_id', '$sched_id', '$default', 'On Time')");
				if ($_insert) {
					echo '<div class="alert alert-success" role="alert">
                    <p style="font-weight: 500; font-size: 16px"><i class="fa fa-clock-o"></i>&nbspTime In</p>
                    <p style="font-weight: 400; font-size: 14px">Time In: '.date('h:i A').'</p>
                    <p style="font-weight: 400; font-size: 14px">Status: On Time</p>
                    </div>';
				}

			}
		}else{
			echo '<div class="alert alert-danger" role="alert">
            <p style="font-weight: 500; font-size: 12px">You Are Not Enrolled to this Subject!</p>
            <p style="font-weight: 300; font-size: 10px">Please Check Your Schedule!</p>
            <p style="font-weight: 300; font-size: 10px">Thank You And Have A Nice Day!</p>
            </div>';
		}
		
	}else{
		echo '<div class="alert alert-danger" role="alert">
            <p style="font-weight: 500; font-size: 12px">Attendance Scanning Close!</p>
            <p style="font-weight: 300; font-size: 10px">Thank You And Have A Nice Day!</p>
            </div>';
	}
}else{
	if ($status == 1) {
		$_chk_enrolled = mysqli_query($con, "SELECT * FROM schedule inner join handle_student on schedule.ID = handle_student.Sched_ID WHERE schedule.ID = '$sched_id' AND handle_student.Student_ID = '$std_id'");
		if (mysqli_num_rows($_chk_enrolled)) {
			$_chk_attendance = mysqli_query($con, "SELECT * FROM std_attendance WHERE Sched_ID = '$sched_id' AND Student_ID = '$std_id'");
			if (mysqli_num_rows($_chk_attendance) > 0) {
				echo '<div class="alert alert-danger" role="alert">
                <p style="font-weight: 500; font-size: 12px">Attendance Already Saved!</p>
                </div>';
			}else{
				$_insert = mysqli_query($con, "INSERT INTO std_attendance (Student_ID, Sched_ID, Time_In, Status) Values ('$std_id', '$sched_id', '$default', 'Late')");
				if ($_insert) {
					echo '<div class="alert alert-success" role="alert">
                    <p style="font-weight: 500; font-size: 16px"><i class="fa fa-clock-o"></i>&nbspTime In</p>
                    <p style="font-weight: 400; font-size: 14px">Time In: '.date('h:i A').'</p>
                    <p style="font-weight: 400; font-size: 14px">Status: Late</p>
                    </div>';
				}

			}
		}else{
			echo '<div class="alert alert-danger" role="alert">
            <p style="font-weight: 500; font-size: 12px">You Are Not Enrolled to this Subject!</p>
            <p style="font-weight: 300; font-size: 10px">Please Check Your Schedule!</p>
            <p style="font-weight: 300; font-size: 10px">Thank You And Have A Nice Day!</p>
            </div>';
		}
		
	}else{
		echo '<div class="alert alert-danger" role="alert">
            <p style="font-weight: 500; font-size: 12px">Attendance Scanning Close!</p>
            <p style="font-weight: 300; font-size: 10px">Thank You And Have A Nice Day!</p>
            </div>';
	}
}
?>