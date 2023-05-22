<?php
error_reporting(0);
include_once '../database/connection.php';


if (isset($_POST['submit'])) {
	$score = 0;
	$wrong = 0;
	$qid = $_GET['qid'];
	$std_id = $_GET['std_id'];
	$code = $_GET['code'];
	$q = mysqli_query($con, "SELECT * FROM questions Where Quiz_ID = '$qid'");
	while ($row = mysqli_fetch_assoc($q)) {
		$quid = $row['Question_ID'];
		$choice = $row['Choices'];
		$points = $row['Points'];
	


		if ($choice == 0) {
			$identi = mysqli_real_escape_string($con, $_POST['answer'.$quid]);
			$ans = mysqli_query($con, "SELECT * FROM answer WHERE Question_ID = '$quid'");
			while ($rowAns = mysqli_fetch_assoc($ans)) {
				$answer = $rowAns['Identification'];
				if ($identi == $answer) {	
					$score += $points * 1;
				}else{
					$wrong += $points * 1;
				}
			}
			
			
		}else{
			$multiple = mysqli_real_escape_string($con, $_POST['ans'.$quid]);
			$ans = mysqli_query($con, "SELECT * FROM answer WHERE Question_ID = '$quid'");
			while ($rowAns = mysqli_fetch_assoc($ans)) {
				$answer = $rowAns['Multiple'];
				if ($multiple == $answer) {	
					$score += $points * 1;
				}else{
					$wrong += $points * 1;
				}
			}
		}

	}
	
	$insertQuiz = mysqli_query($con, "INSERT INTO std_quiz(Code, Quiz_ID, Student_ID, Score, Wrong)VALUES('$code', '$qid', '$std_id', '$score', '$wrong')");

	if ($insertQuiz) {
		$getScore = mysqli_query($con, "SELECT Score, Wrong FROM std_quiz WHERE Quiz_ID = '$qid' AND Student_ID = '$std_id'");
		$row = mysqli_fetch_assoc($getScore);
		$score = $row['Score'];
		$total = $row['Score'] + $row['Wrong'];
		echo '<script>
                    alert("Quiz Response Submitted!\nScore: '.$score.'\nTotal Quiz: '.$total.'");
                    window.location.href="../student/quiz.php?quizID='.$qid.'"
               </script>';
	}
}
?>