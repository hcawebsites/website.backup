<?php  
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;


if (isset($_POST['createQuiz'])) {
	$title = mysqli_real_escape_string($con, $_POST['title']);
	$totalQuiz = mysqli_real_escape_string($con, $_POST['totalQuiz']);
	$time = mysqli_real_escape_string($con, $_POST['time']);
	$dueDate = mysqli_real_escape_string($con, $_POST['dueDate']);
	$dueTime = mysqli_real_escape_string($con, $_POST['dueTime']);
	$description = mysqli_real_escape_string($con, $_POST['description']);
	$code = $_GET['class_code'];
	$quiz_id = uniqid();
	$insert_quiz = mysqli_query($con, "INSERT INTO quiz (Quiz_ID, Title, Questions, Time_Limit, Due_Date, Due_Time, Description, Code)VALUES('$quiz_id', '$title', '$totalQuiz', '$time', '$dueDate', '$dueTime', '$description', '$code')");

	if ($insert_quiz) {
		header('location: ../staff/teachers/quiz_questions.php?code='.$code.'&quiz_id='.$quiz_id.'&totalQuiz='.$totalQuiz.'');
	}
}
?>