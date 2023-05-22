<?php
include_once '../../database/connection.php';

$quiz_id = $_GET['quiz_id'];
$code = $_GET['code'];
$getInfo = mysqli_query($con, "SELECT * FROM quiz inner join classroom on quiz.Code = classroom.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where quiz.Quiz_ID = '$quiz_id'");
$rowInfo = mysqli_fetch_assoc($getInfo);
$subCode = $rowInfo['Subject_Code'];
$subject = $rowInfo['Description'];
$sec = ($rowInfo['Section']=="")? $rowInfo['Strand'] : $rowInfo['Section'];
$grade = $rowInfo['Name']. " ".$rowInfo['Strand']. " - ". $rowInfo['Section'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../../assets/image/logo.png">
<title><?php echo "Quiz - ".$subCode;?></title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<form action="#" method="POST">
		<div class="row">
			<div class="col-md-12 header">
				<h4><?=$subCode. " - " . $subject;?></h4>
				<br>
				<p><?=$grade;?></p>
				<p style="float: right;" id="timer">&nbsp</p>
			</div>
			<?php  
				$getQuestions = mysqli_query($con, "SELECT * FROM questions Where Quiz_ID = '$quiz_id'");
				while ($rowQuiz = mysqli_fetch_assoc($getQuestions)) {
					$questions = $rowQuiz['Question'];
					$question_id = $rowQuiz['Question_ID'];
					$count = $rowQuiz['Counts'];
					$choice = $rowQuiz['Choices'];
			?>
				<div class="col-md-12 body">
					<h5><textarea name="quid<?=$question_id?>" id="quid<?=$question_id?>" rows="2" cols="5"  class="form-control" placeholder="Capital Letter Only" style="resize: none;"><?=$questions?></textarea></h5>
						<?php  
							$getChoices = mysqli_query($con, "SELECT * FROM choices Where Qid = '$question_id'");
							while ($rowChoice = mysqli_fetch_assoc($getChoices)) {
								$optionid = $rowChoice['Cid'];
								$option = $rowChoice['Choices'];
								echo '

								<input type="text" class="form-control" name="option'.$option.'"value="'.$option.'"><br>
								';
							}
						
						?>
				</div>
			<?php  }?>

				<div class="footer">
					<button type="submit" name="submit" id="submit" class="btn btn-success">Update</button>
					<a href="#" class="btn btn-primary">Go Back</a>
				</div>

		</div>
	</form>
		
		
	


</body>

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
		background-image: url(../../assets/image/classroom.jpg);  background-size: cover;
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