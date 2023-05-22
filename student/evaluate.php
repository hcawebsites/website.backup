<?php 
include_once('main_head.php');
include_once('std_header.php');
include_once('std_sidebar.php'); 
$myID = $_SESSION['student_id'];
$count = 1;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Evaluate
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashoard</a></li>
			<li><a href="#">Evaluate</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="table">
			<div class="table-title">
				<h3>
					<i class="fa fa-list"></i>&nbsp
					Teacher Lists
				</h3>
			</div>
			<table class="table table-striped table-bordered" id="search" style="color: #5c5c5c; font-size: 13px; font-weight: 400">
				<thead>
					<tr>
						<th>Picture</th>
						<th>Teacher Name</th>
						<th>Title</th>
						<th>Days</th>
						<th>Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$getSubTeacher = mysqli_query($con, "SELECT * FROM handle_student inner join schedule on handle_student.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join time on schedule.Time_ID = time.time_id WHERE handle_student.Student_ID = '$myID'");

						while ($subTeacher = mysqli_fetch_assoc($getSubTeacher)) {
							$time = $subTeacher['time_start']. " - " .$subTeacher['time_end'];
							$image = $subTeacher['Picture'];
							$teacher_id = $subTeacher['Teacher_ID'];
							$name = $subTeacher['Salutation']. ". ".$subTeacher['Lastname']. ", " .$subTeacher['Firstname'];
							$code = $subTeacher['Code'];
							$title = $subTeacher['Description'];
							$getAcad = mysqli_query($con, "SELECT * FROM academic_list WHERE is_default = '1'");
							$rowAcad = mysqli_fetch_assoc($getAcad);
							$ev_status = $rowAcad['Evaluation'];

						?>
							<tr>
								<td class="text-center">
									<img src="../assets/upload/<?=$image ?>" width="50px" class="img-circle"></img>
								</td>
								<td style="vertical-align:middle;"><?=$name?></td>
								<td style="vertical-align:middle;"><?=$title?></td>
								<td style="vertical-align:middle;"><?=$subTeacher['Day']?></td>
								<td style="vertical-align:middle;"><?=$time?></td>
								<td style="vertical-align: middle; text-align: center;">
									<?php
										if ($ev_status == 1) {
											echo "<button class='btn btn-info evaluate' id='".$subTeacher['Code']."'>Evaluate</button>";
										}elseif ($ev_status == 2) {
											echo "<button class='btn btn-warning'>Close</button>";				
										}else{
											echo "<button class='btn btn-secondary'>Not yet started</button>";
										}
									 ?>
								</td>
							</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="evaluationModal"tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title" id="title">Modal title</h4>
      </div>
      <div class="modal-body">
      	<fieldset style="border: 1px solid black; padding:10px;" class="border border-info p-2 w-100">
					   <legend class="w-auto">Rating Legend</legend>
					   <p style="font-size: 14px; font-weight: 600; color: red;">5 = Strongly Agree, 4 = Agree, 3 = Neutral, 2 = Disagree, 1 = Strongly Disagree</p>
					</fieldset>
					<hr>
        <form action="" id="manage_evaluation">
        	<input type="hidden" name="scode" id="scode">
        	<input type="hidden" name="class" id="class">
        	<input type="hidden" name="tid" id="tid">
        	<input type="hidden" name="sid" id="sid">

        	<?php
        		$q_arr = array();
        		$selectCriteria = mysqli_query($con, "SELECT * FROM criteria Order by (Order_BY)");

        		while ($rowCriteria = mysqli_fetch_assoc($selectCriteria)) {
        		$crid = $rowCriteria['ID'];
        		?>
        		<table class="table table-bordered table-striped">
        			<thead>
        				<tr>
        					<th><b><?php echo $rowCriteria['Criteria'] ?></b></th>
        					<th class="text-center">1</th>
        					<th class="text-center">2</th>
        					<th class="text-center">3</th>
        					<th class="text-center">4</th>
        					<th class="text-center">5</th>
        				</tr>
        			</thead>

        			<tbody>
        				<?php  
        				$selectQuestion = mysqli_query($con, "SELECT * FROM ev_questionnaire Where Criteria_ID = '$crid' ORDER BY abs(Order_By) asc");
        				while ($rowQuestion = mysqli_fetch_assoc($selectQuestion)) {
        					$q_arr[$rowQuestion['ID']] = $rowQuestion;
        					?>

        					<tr>
        						<td>
        							<?php echo$rowQuestion['Question'];?>
        							<input type="hidden" name="qid[]" value="<?php echo $rowQuestion['ID'] ?>">
        						</td>

        						<?php  
        							for ($i=1; $i <= 5 ; $i++) { 
        								?>
        								<td class="text-center">
									<div class="icheck-success d-inline">
				                        <input type="radio" name="rate[<?php echo $rowQuestion['ID'] ?>]"id="qradio<?php echo $rowQuestion['ID'].'_'.$i ?>" value="<?php echo $i ?>">
				                        <label for="qradio<?php echo $rowQuestion['ID'].'_'.$i ?>">
				                        </label>
			                      </div>
								</td>
        						<?php } ?>
        					</tr>
        				<?php }?>
        			</tbody>
        		</table>
    		<?php }?>

    		<label>Additonal Comments:</label>
    		<textarea name="comment" placeholder="Optional" id="comment" cols="30" rows="4" class="form-control" required></textarea>
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="save_evaluation" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include_once 'footer.php'; ?>
<script>
	var timer1 = 0;
	$(document).ready(function(){
		$('#search').DataTable();

		$('.evaluate').click(function(){
			start_load();
			var scode = $(this).attr('id');
			$.ajax({
				url: "sbjTeacher.php",
				method: "POST",
				data:{
					scode:scode
				}, 
				success:function(data){
					if (timer1 == 0) {
						intervalID = setInterval(function(){
							data = $.parseJSON(data);
							$('#title').html("Evaluation for " + data.info);
							$('#scode').val(scode);
							$('#tid').val(data.tid);
							$('#sid').val(data.std_id);
							$('#class').val(data.class);
							$('#evaluationModal').modal('show');
							end_load();

						},3000)
					}				
				}
			})
			
		})
	});

	$('#save_evaluation').click(function(){
		let type = 'success';
	    let title = 'Evaluation successfully saved.';
	    start_load();
	    createToast(type, title);
		$.ajax({
			url: "../std-model/save_evaluation.php",
			method: "POST",
			data: $('#manage_evaluation').serialize(),
			success:function(data){
				$('#evaluationModal').modal('hide');
				if (timer1 == 0) {
					intervalID = setInterval(function(){
						location.reload();
						finish();
						end_load()
					},3000);
				}
			}
		})
	})

</script>