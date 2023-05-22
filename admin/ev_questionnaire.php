<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
$getAcadYear = mysqli_query($con, "SELECT * FROM academic_list WHERE is_default = 1");
$rowAcad = mysqli_fetch_assoc($getAcadYear);
$sy = $rowAcad['School_Year']; ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Evaluation Questionnaire
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#"></i>Evaluation</a></li>
			<li><a href="#"></i>Questionnaire</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="table-master">
					<div class="table-title">
						<h4><i class="fa fa-question-circle" aria-hidden="true"></i>&nbspQuestion Form</h4>
					</div>

					<form action="" id="manage-question">
						<label>Criteria:</label>
						<input type="hidden" name="id" id="id">
						<select name="criteria" id="criteria" class="form-control" required>
							 <option value="" disabled selected hidden>Please select here</option>
							 	<?php  
							 		$getCriteria = mysqli_query($con, "SELECT * FROM criteria ORDER BY Order_BY ASC");
							 		while ($rowCriteria = mysqli_fetch_assoc($getCriteria)) {
							 		?>
							 		<option value="<?=$rowCriteria['ID']?>"><?=$rowCriteria['Criteria']?></option>
							 	<?php }?>
							 	
						</select>

						<label>Question:</label>
						<textarea name="question" id="question" cols="30" rows="4" class="form-control" required></textarea><br>

						<div class="text-right">
							<button type="button" id="save"; class="btn btn-md btn-primary">Save</button>	
						</div>
					</form>
				</div>
			</div><!--End of Questions-->

			<div class="col-md-8">
				<div class="table-master">
					<div class="table-title">
						<h4>
							Evaluation Questionnaire for Academic Year:  <?=$sy?>
						</h4>
					</div>

					<fieldset style="border: 1px solid black; padding:10px;" class="border border-info p-2 w-100">
					   <legend class="w-auto">Rating Legend</legend>
					   <p style="font-size: 14px; font-weight: 600; color: red;">5 = Strongly Agree, 4 = Agree, 3 = Neutral, 2 = Disagree, 1 = Strongly Disagree</p>
					</fieldset>
					<hr>
					<form action="" method="POST" id="order_question">
						<?php
							$o_array = array();
							$getCriteria = mysqli_query($con, "SELECT * FROM criteria Order by abs(Order_BY) asc");
							while ($rowCriteria = mysqli_fetch_assoc($getCriteria)) {
								$cid = $rowCriteria['ID'];
							?>

							<table class="table table-bordered" style="word-break: break-all; table-layout: fixed;">
								<thead>
									<tr style="background-color: #d9d9d9;">
										<th colspan="9" style="text-align: left;"><b><?php echo $rowCriteria['Criteria'] ?></b></th>
										<th class="text-center">5</th>
										<th class="text-center">4</th>
										<th class="text-center">3</th>
										<th class="text-center">2</th>
										<th class="text-center">1</th>
									</tr>
								</thead>
								<tbody class="tr-sortable">
									<?php
										$getQuestions = mysqli_query($con, "SELECT * FROM ev_questionnaire WHERE Criteria_ID = '$cid' ORDER BY abs(Order_By) asc");
										while ($rowQuestion = mysqli_fetch_assoc($getQuestions)) {
											$o_array[$rowQuestion['ID']] = $rowQuestion;
										?>
										<tr>
											<td class="p-1" style="text-align: left;">
												<span class="btn-group dropright">
												  <span type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												   <i class="fa fa-ellipsis-v"></i>
												  </span>
												  <div class="dropdown-menu">
												     <button type="button" class="dropdown-item btn btn-secondary form-control edit" id="<?php echo $rowQuestion['ID'] ?>">Edit</button>
								                      <div class="dropdown-divider"></div>
								                     <button type="button" class="dropdown-item btn btn-danger form-control delete" id="<?php echo $rowQuestion['ID'] ?>">Delete  </button>
												  </div>
												</span>
											</td>

											<td colspan="8">
												
												<?php echo $rowQuestion['Question'] ?>
												<input type="hidden" name="qid[]" value="<?php echo $rowQuestion['ID'] ?>">
											</td>

											<?php for($c=0;$c<5;$c++): ?>
											<td class="text-center">
												<div style="">
		                        <input type="radio" name="qid[<?php echo $rowQuestion['ID'] ?>][]" id="qradio<?php echo $rowQuestion['ID'].'_'.$c ?>">
		                        <label for="qradio<?php echo $rowQuestion['ID'].'_'.$c ?>">
		                        </label>
	                      </div>
											</td>
											<?php endfor; ?>
										</tr>
									<?php } ?>
									
								</tbody>
							</table>
						<?php }?>
						
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="confirmation" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-question-circle"></i>&nbspConfirmation</h4>
      </div>
      <div class="modal-body">
      	<form action="" id="dlquestion">
      		<input type="hidden" name="qid" id="qid">
      		<p>Are you sure you want to delete this question?</p>
      		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="dltquestion" class="btn btn-danger">Yes, Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>
 <script
  src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
  integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
  crossorigin="anonymous"></script>

<script type="text/javascript">
	var timer1=0;
	$(document).ready(function(){
		$('#search').DataTable();
	})

	$(document).ready(function(){
		$('.tr-sortable').sortable();
	})

	$(document).ready(function(){
		$('.edit').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "ev_question.php",
				method: "POST", 
				data:{
					id:id
				},
				success:function(data){
					data = $.parseJSON(data);
					$('#criteria').html(data.criteria)
					$('#question').val(data.question);
					$('#id').val(id);
				}
			})
		})
	})

		$(document).ready(function(){
		$('.delete').click(function(){
			start_load();
			var id = $(this).attr('id');
				if(timer1 == 0){
						intervalID = setInterval(function(){
							$('#qid').val(id);
							$('#confirmation').modal('show');
							end_load();
						}, 3000); // 1000 milliseconds = 1 second.
					}
		})

		$('#dltquestion').click(function(){
				let type = 'error';
		    let title = 'Data successfully deleted.';
		    start_load();
		    createToast(type, title);

		    $.ajax({
		    	url: "../model/ev_q_delete.php",
		    	method: "POST",
		    	data: $('#dlquestion').serialize(),
		    	success:function(data){
		    		if (timer1 == 0) {
		    			intervalID = setInterval(function() {
		    				location.reload();
		    				finish();
		    				end_load();
		    			}, 3000)
		    		}
		    	}
		    })
		})
	})



	$(document).ready(function(){
		$('#save').click(function(){
			let type = 'success';
	    let title = 'Data successfully saved.';
	    start_load();
	    createToast(type, title);
			var criteria = $('#criteria').val();
			var question = $('#question').val();
			if (criteria == "" || question == "") {
				alert("All fields Required!");
			}else{
				$.ajax({
					url: "../model/save_ev_question.php",
					method: "POST", 
					data: $('#manage-question').serialize(),
					success:function(data){
						if(timer1 == 0){
						intervalID = setInterval(function(){
							location.reload();
							finish();
							end_load();
						}, 3000); // 1000 milliseconds = 1 second.
					}
					}
				})
			}
		})
	})
</script>
<?php include_once 'footer.php'; ?>
