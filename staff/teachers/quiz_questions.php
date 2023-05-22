<?php include_once('main_head.php');?>
<?php include_once('header.php');?>
<?php include_once('sidebar.php');
$code = $_GET['code'];
$quiz_id = $_GET['quiz_id'];
$totalQuiz = $_GET['totalQuiz'];
$myID = $_SESSION['emp_id'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Questions
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#">Room</a></li>
            <li><a href="#">Quiz</a></li>
            <li><a href="#">Questions</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="row">
			<form action="../../staff-model/createQuestions.php?totalQuiz=<?=$totalQuiz?>&qid=<?=$quiz_id?>&ch=4&teacher_id=<?=$myID?>&code=<?=$code?>" method="POST">

				<div class="col-md-12"><h3>Enter Question Details</h3></div>
			<?php  
				for ($i=1; $i <= $totalQuiz; $i++) { 
				?>	
			<div class="col-md-12 form-group" id="form">
				<div class="col-md-6">
					<label>Question Number:&nbsp<?=$i ?></label>	
					<textarea name="question<?=$i?>" id="question"rows="2" cols="5"  class="form-control" placeholder="Write question number <?=$i?> here..."></textarea> 
				</div>

				<div class="col-md-2">
					<label>&nbsp</label>
					<select name="points<?=$i?>" id="points<?=$i?>" class="form-control">
						<option value="" disabled selected>Points</option>
						<option value="1">1 point</option>
						<option value="2">2 points</option>
					</select>
				</div>

				<div class="col-md-4">
					<label>&nbsp</label>
					<select name="types<?=$i?>" id="types<?=$i?>" class="form-control">
						<option value="" disabled selected>Question Type</option>
						<option value="Multiple Choice">Multiple Choice</option>
						<option value="Identification">Identification</option>
					</select>
				</div>

				<div class="col-md-12" id="Mchoices<?=$i?>" style="display: none;">
					<div class="form-group">
					  <label class="col-md-12 control-label" for="<?=$i ?>1"></label>  
					  <div class="col-md-4">
					  <input id="<?=$i?>1" name="<?=$i?>1" placeholder="Enter option a | Optional" class="form-control input-md" type="text">
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-12 control-label" for="<?=$i ?>1"></label>  
					  <div class="col-md-4">
					  <input id="<?=$i?>2" name="<?=$i ?>2" placeholder="Enter option b | Optional" class="form-control input-md" type="text">
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-12 control-label" for="<?=$i ?>1"></label>  
					  <div class="col-md-4">
					  <input id="<?=$i?>3" name="<?=$i ?>3" placeholder="Enter option c | Optional" class="form-control input-md" type="text">
					  </div>
					</div>

					<div class="form-group">
					  <label class="col-md-12 control-label" for="<?=$i?>1"></label>  
					  <div class="col-md-4">
					  <input id="<?=$i?>4" name="<?=$i ?>4" placeholder="Enter option d | Optional" class="form-control input-md" type="text"><br>
					  <b>Correct answer</b>:<br />
						<select id="ansMulti<?=$i?>" name="ansMulti<?=$i?>" placeholder="Choose correct answer " class="form-control input-md" >
						  <option value="">Select answer for question <?=$i?></option>
						  <option value="a">option a</option>
						  <option value="b">option b</option>
						  <option value="c">option c</option>
						  <option value="d">option d</option> </select>
					  </div>
					</div>
				</div>

				<div class="col-md-12" id="identification<?=$i?>" style="display: none;">

					<div class="col-md-4">
						<label>Correct Answer:<small> CAPITAL LETTER ONLY</small></label>
						<textarea name="ident<?=$i?>" id="ident"rows="2" cols="5"  class="form-control" placeholder="Write Correct Answer <?=$i?> here..."></textarea> 
					</div>

				</div>

			</div>

			<script type="text/javascript">
				$(document).ready(function(){
					$('#types'+<?=$i?>).change(function(){
						var type = $(this).val();

						if (type == "Multiple Choice") {
							document.getElementById('Mchoices'+<?=$i?>).style.display = "block";
							document.getElementById('identification'+<?=$i?>).style.display = "none";
						}else{
							document.getElementById('identification'+<?=$i?>).style.display = "block";
							document.getElementById('Mchoices'+<?=$i?>).style.display = "none";
						}

					})

				});
			</script>


			<?php } ?>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<button type="submit" name="createQuiz" class="btn btn-success form-control" id="createQuiz">Create Questions</button>
			</div>

			</form>
			
		</div>
	</section>
</div>

<?php include_once '../footer.php';  ?>


