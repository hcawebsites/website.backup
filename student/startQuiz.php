<?php  
include_once '../database/connection.php';
$qid = $_GET['qid'];
$startNum = $_GET['n'];
$endNum = $_GET['total'];
$code = $_GET['code'];
$std_id = $_GET['std_id'];
$status = $_GET['status'];
$getInfo = mysqli_query($con, "SELECT * FROM quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where quiz.Quiz_ID = '$qid'");
$rowInfo = mysqli_fetch_assoc($getInfo);
$subCode = $rowInfo['Subject_Code'];
$subject = $rowInfo['Description'];
$class= $rowInfo['Name']. " " .$rowInfo['Strand']. " - " .$rowInfo['Section'];
$time = $rowInfo['Time_Limit'];


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../assets/image/logo.png">
<title><?php echo "Quiz - ".$subCode;?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<?php 

		if ($status == 0) {
			echo '
			<script>
			alert("Quiz for '.$subject.' is no longer accepting responses.\nTry contacting the owner of the quiz if you think that is a mistake.");
			window.location.href="quiz.php?quizID='.$qid.'"
			</script>
			';
		}else{
			$checkDone = mysqli_query($con, "SELECT * FROM std_quiz WHERE Quiz_ID = '$qid' AND Student_ID = '$std_id'");

					if (mysqli_num_rows($checkDone) > 0) {
						echo "<script>
							alert('Sorry you have already take this quiz!');
							window.location.href= 'quiz.php?quizID=".$qid."';
						</script>";
					}else{
						?>
						<form action="../std-model/submitQuiz.php?qid=<?=$qid?>&code=<?=$code?>&std_id=<?=$std_id?>" method="POST" id="form">
							<div class="row">
								<div class="col-md-12 header">
									<h4><?=$subCode. " - " . $subject;?></h4>
									<br>
									<p><?=$class;?></p>
									<p style="float: right;" id="timer">&nbsp</p>
								</div>
							
								<?php  
									$getQuestions = mysqli_query($con, "SELECT * FROM questions Where Quiz_ID = '$qid'");
									while ($rowQuiz = mysqli_fetch_assoc($getQuestions)) {
										$questions = $rowQuiz['Question'];
										$question_id = $rowQuiz['Question_ID'];
										$count = $rowQuiz['Counts'];
										$choice = $rowQuiz['Choices'];
								?>
									<div class="col-md-12 body">
										<h5><?=$count;?>.&nbsp<?=$questions;?></h5>
										
											<?php  
											if ($choice == 0) {

												echo '<textarea name="answer'.$question_id.'" id="question'.$question_id.'"rows="2" cols="5"  class="form-control" placeholder="Capital Letter Only" style="resize: none;"></textarea>';
											
											}else{
												$getChoices = mysqli_query($con, "SELECT * FROM choices Where Qid = '$question_id'");
												while ($rowChoice = mysqli_fetch_assoc($getChoices)) {
													$optionid = $rowChoice['Cid'];
													$option = $rowChoice['Choices'];
													echo '<input type="radio" name="ans'.$question_id.'" value="'.$optionid.'">&nbsp'.$option.'<br/>';
												}
											}
											?>
									</div>
								<?php  }?>

									<div class="footer">
										<button type="submit" name="submit" id="submit" class="btn btn-success">Submit</button>
									</div>
							</div>
						</form>

		<?php } }?>
		
		
	


</body>

<script type="text/javascript">
	var minute = <?=$time;?> * 60;
	    function secondPassed() {
	    var minutes = Math.floor(minute/60);
	    var remainingSeconds = minute % 60;
	    if (remainingSeconds < 10) {
	        remainingSeconds = "0" + remainingSeconds; 
	    }
	    document.getElementById('timer').innerHTML = minutes + " minutes " + remainingSeconds + " seconds";
	    if (minute == 0) {
	        clearInterval(countdownTimer);
	        alert("Sorry you are run out of time!\nBetter luck next time.")
	        $('#submit').click();
	    } else {    
	        minute--;
	    }
	    }
	var countdownTimer = setInterval('secondPassed()', 1000);
</script>

<style type="text/css">
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

	body{
		margin-right: 25%;
		margin-left: 25%;
		margin-top: 20px;
		margin-bottom: 20px;
		height: 100%;
	}

	.header{
		padding: .5rem .5rem .5rem .5rem;
		border-radius: 4px;
		box-shadow: 1px 1px #888888;
		background-image: url(../assets/image/classroom.jpg);  background-size: cover;
	                background-position: center; background-repeat: no-repeat;
		margin-bottom: 10px;
		color: #0FF6FC;
	}

	.body{
		padding: .5rem .5rem .5rem .5rem;
		border-radius: 4px;
		box-shadow: 1px 1px #888888;
		background-color: #F0F0F0;
		margin-bottom: 10px;
	}
	#timer{
		font-size: 20px;
		font-weight: 500;
		font-family: arial;
		color: #73FBFD ;
		margin-right: 10px;
		margin-bottom: -5px;
	}
</style>
</html>