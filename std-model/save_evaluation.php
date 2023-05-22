<?php
include_once '../database/connection.php';
extract($_POST);

if ($_POST) {
	$teacher_id = mysqli_real_escape_string($con, $_POST['tid']);
	$std_id = mysqli_real_escape_string($con, $_POST['sid']);
	$s_code = mysqli_real_escape_string($con, $_POST['scode']);
	$class = mysqli_real_escape_string($con, $_POST['class']);
	$comment = mysqli_real_escape_string($con, $_POST['comment']);

	$query_strand = mysqli_query($con, "SELECT * from student_grade inner join grade on student_grade.Class_ID = grade.ID WHERE Student_ID = '$std_id'");
	while ($row_strand = mysqli_fetch_assoc($query_strand)) {
		$strand = $row_strand['Strand'];

	$save = mysqli_query($con, "INSERT INTO evaluation_list (Class_ID, Strand, Student_ID, Teacher_ID, Subject, Comments) VALUES ('$class', '$strand', '$std_id', '$teacher_id', '$s_code', '$comment')");

	if ($save) {
		$eid = mysqli_insert_id($con);
		foreach ($qid as $key => $id) {
		$answer = $rate[$id];
		
		mysqli_query($con, "INSERT INTO ev_answer(Evaluation_ID, Questionnaire_ID, Rate) VALUES ('$eid', '$id', '$answer')");
	}
	}



	}

	}
?>