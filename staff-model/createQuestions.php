<?php  
include_once '../database/connection.php';
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['createQuiz'])) {
	$quiz_id = $_GET['qid'];
	$totalQuiz = $_GET['totalQuiz'];
	$ch = $_GET['ch'];
	$myID = $_GET['teacher_id'];
	$code = $_GET['code'];
for ($i=1; $i <= $totalQuiz ; $i++) { 
		$type = mysqli_real_escape_string($con, $_POST['types'.$i]);
		if ($type == "Multiple Choice") {
			$qid=uniqid();
			$aid=uniqid();
			$bid=uniqid();
			$cid=uniqid();
			$did=uniqid();
			$qns = mysqli_real_escape_string($con, $_POST['question'.$i]);
			$points = mysqli_real_escape_string($con, $_POST['points'.$i]);
			//Choices
			$a= mysqli_real_escape_string($con, $_POST[$i.'1']);
			$b= mysqli_real_escape_string($con, $_POST[$i.'2']);
			$c= mysqli_real_escape_string($con, $_POST[$i.'3']);
			$d= mysqli_real_escape_string($con, $_POST[$i.'4']);

			$insertQuestions = mysqli_query($con, "INSERT INTO questions(Quiz_ID, Question_ID, Question, Choices, Points, Counts) VALUES ('$quiz_id', '$qid', '$qns', '$ch', '$points', '$i')");

			if ($insertQuestions) {
				mysqli_query($con,"INSERT INTO choices(Qid, Choices, Cid) VALUES  ('$qid','$a','$aid')");
				mysqli_query($con,"INSERT INTO choices(Qid, Choices, Cid) VALUES  ('$qid','$b','$bid')");
				mysqli_query($con,"INSERT INTO choices(Qid, Choices, Cid) VALUES  ('$qid','$c','$cid')");
				mysqli_query($con,"INSERT INTO choices(Qid, Choices, Cid) VALUES  ('$qid','$d','$did')");

				$qans=mysqli_real_escape_string($con, $_POST['ansMulti'.$i]);
				switch($qans)
				{
				case 'a':
				$ansid=$aid;
				break;
				case 'b':
				$ansid=$bid;
				break;
				case 'c':
				$ansid=$cid;
				break;
				case 'd':
				$ansid=$did;
				break;
				default:
				$ansid=$aid;
				}
				mysqli_query($con,"INSERT INTO answer (Question_ID, Multiple)VALUES  ('$qid', '$ansid')");

				header('location: ../staff/teachers/room.php?code='.$code.'');

			}
			
		}else{
			$qid=uniqid();
			$qns = mysqli_real_escape_string($con, $_POST['question'.$i]);
			$points = mysqli_real_escape_string($con, $_POST['points'.$i]);
			$iden= $qans=$_POST['ident'.$i];
			$insertQuestions = mysqli_query($con, "INSERT INTO questions(Quiz_ID, Question_ID, Question, Points, Counts) VALUES ('$quiz_id', '$qid', '$qns', '$points', '$i')");

			if ($insertQuestions) {
				mysqli_query($con,"INSERT INTO answer (Question_ID, Identification)VALUES  ('$qid', '$iden')");

				header('location: ../staff/teachers/room.php?code='.$code.'');
			}


		}

		
	}
	
}


?>