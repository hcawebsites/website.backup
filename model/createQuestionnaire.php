<?php  
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST['createQuiz'])) {
	$instruction = mysqli_real_escape_string($con, $_POST['instruction']);
	$totalQuiz = mysqli_real_escape_string($con, $_POST['number']);
	$qid = uniqid();

	$insert_questionnaire = mysqli_query($con, "INSERT INTO ev_questionnaire (QID, Instruction, Total_Questions)VALUES('$qid', '$instruction', '$totalQuiz'");

	if ($insert_questionnaire) {
		header('location: ../admin/questions.php?qid='.$qid.'&totalQuiz='.$totalQuiz.'');
	}
}
?>