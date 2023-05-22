<?php  
include_once '../database/connection.php';
$dept = mysqli_real_escape_string($con, $_POST['department']);

if ($dept == "SHSDEPT") {
	foreach ($_POST['array'] as $id) {
	$_prelim = mysqli_real_escape_string($con, $_POST['_prelim'.$id]);
	$_midterm = mysqli_real_escape_string($con, $_POST['_midterm'.$id]);
	$_final = mysqli_real_escape_string($con, $_POST['_final'.$id]);
	$sched_id = mysqli_real_escape_string($con, $_POST['sched_id']);
	$class = mysqli_real_escape_string($con, $_POST['class_id']);
	$subject = mysqli_real_escape_string($con, $_POST['subject']);
	$total = (float)$_prelim+(float)$_midterm+(float)$_final;
	$overall = (float)$total/3;
	$round = number_format($overall, 0, '.', '');
	$get = mysqli_query($con, "SELECT * from academic_list Where is_default = '1'");
	$row = mysqli_fetch_assoc($get);
	$sy = $row['School_Year'];
	$semester = $row['Semester'];
	$_chk = mysqli_query($con, "SELECT * FROM shs_grade WHERE Student_ID = '$id' AND Sched_ID = '$sched_id'");
	if (mysqli_num_rows($_chk) > 0) {
		mysqli_query($con, "UPDATE shs_grade Set Prelim = '$_prelim', Midterm = '$_midterm', Final = '$_final', Overall = '$round' WHERE Student_ID = '$id' AND Sched_ID = '$sched_id'");
	}else{
		mysqli_query($con, "INSERT INTO shs_grade (Student_ID, Subject, Sched_ID, Class_ID, Prelim, Overall, AY, Semester) VALUES ('$id', '$subject', '$sched_id', '$class', '$_prelim', '$round', '$sy', '$semester')");
	}
	}
	echo "success";
}else{
	foreach ($_POST['array'] as $id) {
		$_first = mysqli_real_escape_string($con, $_POST['_first'.$id]);
		$_second = mysqli_real_escape_string($con, $_POST['_second'.$id]);
		$_third = mysqli_real_escape_string($con, $_POST['_third'.$id]);
		$_fourth = mysqli_real_escape_string($con, $_POST['_fourth'.$id]);
		$sched_id = mysqli_real_escape_string($con, $_POST['sched_id']);
		$class = mysqli_real_escape_string($con, $_POST['class_id']);
		$subject = mysqli_real_escape_string($con, $_POST['subject']);
		$_sum_grade = (int)$_first+(int)$_second+(int)$_third+(int)$_fourth;
		$final = $_sum_grade/4;
		$round = number_format($final, 0, '.', '');
		$get = mysqli_query($con, "SELECT * from academic_list Where is_default = '1'");
		$row = mysqli_fetch_assoc($get);
		$sy = $row['School_Year'];
		$_chk = mysqli_query($con, "SELECT * FROM std_grade WHERE Student_ID = '$id' AND Sched_ID = '$sched_id'");
		if (mysqli_num_rows($_chk) > 0) {
			mysqli_query($con, "UPDATE std_grade Set First = '$_first', Second = '$_second', Third = '$_third', Fourth = '$_fourth', Final = '$round' WHERE Student_ID = '$id' AND Sched_ID = '$sched_id'");
		}else{
			mysqli_query($con, "INSERT INTO std_grade (Student_ID, Class_ID, Sched_ID, Subject, First, Final, SY) VALUES ('$id', '$class', '$sched_id', '$subject', '$_first', '$round', '$sy')");
		}
	}
	echo 'success';
}

?> 