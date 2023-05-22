<?php  
include_once '../database/connection.php';
include_once 'main_head.php';
include_once 'std_header.php';
include_once 'std_sidebar.php';
$myID = $_SESSION['student_id'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Health Record
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Clinic</a></li>
			<li><a href="#">Health Record</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<?php  
			$get = mysqli_query($con, "SELECT * from health_record WHERE Student_ID = '$myID'");
			  if (mysqli_num_rows($get) > 0) {
			  	$row = mysqli_fetch_assoc($get);
			  	$array = $row['Medical_History'];
			  	$med_history = explode(',', $array);
			  	$count = count($med_history);

			  	$array1 = $row['Family_History'];
			  	$fam_history = explode(',', $array1);
			  	$count1 = count($fam_history);
				?>

				<div class="table">
				<p style="color: #666666; font-size: 18px; font-weight: 300;">Health Info</p>
				<hr>
				<div style="color: #666666; font-size: 14px;">
					<form action="" id="health_form">
						<div class="row">
							<div class="col-md-12">
								<label>Present Illness:</label>
									<textarea readonly class="form-control form-group" rows="4"><?php echo $row['Illness'] ?></textarea>

									<label>Medication Taken:</label>
									<textarea readonly class="form-control form-group" rows="4"><?php echo $row['Medication_Taken'] ?></textarea>

									<label>Past Medical History:</label>
									<?php
										for ($i=0; $i < $count; $i++) { 
										?>

										<ul>
											<li class="li"><input type="checkbox" <?php echo $med_history[$i] == ''? 'style="display: none"':'checked'  ?> disabled>&nbsp<?php echo $med_history[$i]?></li>
										</ul>
										<?php } ?>
										<label>Operation/s:</label>
										<textarea class="form-control form-group" rows="4" readonly><?php echo $row['Operations'] ?></textarea>
										<label>Family History:</label>
										<?php
										for ($i=0; $i < $count1; $i++) { 
										?>

										<ul>
											<li class="li"><input type="checkbox" <?php echo $fam_history[$i] == ''? 'style="display: none"':'checked'  ?> disabled>&nbsp<?php echo $fam_history[$i]?></li>
										</ul>
										<?php } ?>
							</div>

							<div class="col-md-6">
									<label>Height</label>
									<input type="number"  value="<?=$row['Height']?>" class="form-control form-group" readonly>

									<label>Weight</label>
									<input type="number" value="<?=$row['Weight']?>"  class="form-control form-group" readonly>
								</div>

								<div class="col-md-6">
                  <label for="">Body Mass Index:</label>
                  <input type="number" value="<?=$row['BMI']?>"  class="form-control form-group" readonly>

                  <label for="">Classification:</label>
                  <input type="text" value="<?=$row['Classification']?>" class="form-control" readonly>
              	</div>

							<div class="col-md-12">
								<label>Smoking:</label>
									<textarea class="form-control form-group" rows="4" readonly><?=$row['Smoking']?></textarea>

									<label>Drinking:</label>
									<textarea class="form-control form-group" rows="4" readonly><?=$row['Drinking']?></textarea>

									<button type="button" id="<?=$myID?>" class="form-control btn btn-primary update">Update</button>
							</div>
						</div>
					</form>
						
				</div>

			</div>


		<?php }else{
		?>
			<div class="table">
				<p style="color: #666666; font-size: 18px; font-weight: 300;">Health Info</p>
				<hr>
				<div style="color: #666666; font-size: 14px;">
					<form action="" id="health_form">
						<div class="row">
							<div class="col-md-12">
								<label>Present Illness:</label>
									<input type="hidden" name="std_id" id="std_id" value="<?php echo $myID ?>">
								<textarea name="illness" id="illness" class="form-control form-group" rows="4"></textarea>

								<label>Medication Taken:</label>
								<textarea name="medication" id="medication" class="form-control form-group" rows="4"></textarea>

								<label>Past Medical History:</label>
								<?php
									$illness = array("Allergy", "Asthma", "Eye Problem", "Ear, Nose, Throat Disorder", "Frequent Headache", "Head or Neck Injury", "Blood Disorder", "Hypertension", "Heart Disease", "Endocrine (Diabetes/Goiter)", "Lung Disorder (PTB, COPD)", "Cancer of Tumor", "Kidney/Bladder Problem", "Genitourinary (STD/UTI)", "Viral Illness (Chicken Pox/Measles)", "GI Disorder (Hepatitis/Ulcer)", "Neurologic (Seizure, Mental Disorder)");
									for ($i=0; $i < 17; $i++) { 
									?>

									<ul>
										<li class="li"><input type="checkbox" name="med_history[]" value="<?php echo $illness[$i]?>">&nbsp<?php echo $illness[$i]?></li>
									</ul>
									<?php } ?>
									<label>Operation/s:</label>
									<textarea name="operation" id="operation" class="form-control form-group" rows="4"></textarea>
									<label>Family History:</label>
									<?php
									$f_history = array("Allergy", "Asthma", "Cancer", "Hypertension", "Heart Disease", "Thyroid Disease", "Diabetes Mellitus", "Kidney Disease");
									for ($i=0; $i < 8; $i++) { 
									?>

									<ul>
										<li class="li"><input type="checkbox" name="f_history[]" value="<?php echo $f_history[$i]?>">&nbsp<?php echo $f_history[$i]?></li>
									</ul>
									<?php } ?>

									</div>

									<div class="col-md-6">
										<label>Height</label>
										<input type="number" name="height" id="height" class="form-control form-group" placeholder="e.g 1.75">

										<label>Weight</label>
										<input type="number" name="weight" id="weight" class="form-control form-group">
									</div>

									<div class="col-md-6">
                    <label for="">Body Mass Index:</label>
                    <input type="number" name="bmi" id="bmi" class="form-control form-group" readonly>

                    <label for="">Classification:</label>
                    <input type="text" name="classification" id="classification" class="form-control" readonly>
                </div>

									<div class="col-md-12">
										<label>Smoking:</label>
										<textarea name="smoking" id="smoking" placeholder="Number of Sticks/frequency (eg: 1/day or 3/week) " class="form-control form-group" rows="4"></textarea>

										<label>Drinking:</label>
										<textarea name="drinking" id="drinking" placeholder="Number of Bottles/frequency (eg: 1/day or 3/week) " class="form-control form-group" rows="4"></textarea>

										<button type="button" id="save_record" class="form-control btn btn-info">Save</button>
									</div>
						</div>
					</form>
						
				</div>

			</div>
		<?php }?>

		
		
	</section>
</div>
<div class="modal fade" id="manage-health" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i>;</span>
        </button>
        <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i>&nbspManage Health Record</h4>
        
      </div>
      <div class="modal-body">
		<div style="color: #666666; font-size: 14px;">
			<form action="" id="edit-health">
				<div class="row">
					<div class="col-md-12">
						<label>Present Illness:</label>
						<input type="hidden" name="std_id" id="e-std_id">
					<textarea name="illness" id="e_illness" class="form-control form-group" rows="4"></textarea>

					<label>Medication Taken:</label>
					<textarea name="medication" id="e_medication" class="form-control form-group" rows="4"></textarea>

					<label>Past Medical History:</label>
					<?php
						$illness = array("Allergy", "Asthma", "Eye Problem", "Ear, Nose, Throat Disorder", "Frequent Headache", "Head or Neck Injury", "Blood Disorder", "Hypertension", "Heart Disease", "Endocrine (Diabetes/Goiter)", "Lung Disorder (PTB, COPD)", "Cancer of Tumor", "Kidney/Bladder Problem", "Genitourinary (STD/UTI)", "Viral Illness (Chicken Pox/Measles)", "GI Disorder (Hepatitis/Ulcer)", "Neurologic (Seizure, Mental Disorder)");
						for ($i=0; $i < 17; $i++) { 
						?>

						<ul>
							<li class="li"><input type="checkbox" name="med_history[]" value="<?php echo $illness[$i]?>">&nbsp<?php echo $illness[$i]?></li>
						</ul>
						<?php } ?>
						<label>Operation/s:</label>
						<textarea name="operation" id="e_operation" class="form-control form-group" rows="4"></textarea>
						<label>Family History:</label>
						<?php
						$f_history = array("Allergy", "Asthma", "Cancer", "Hypertension", "Heart Disease", "Thyroid Disease", "Diabetes Mellitus", "Kidney Disease");
						for ($i=0; $i < 8; $i++) { 
						?>

						<ul>
							<li class="li"><input type="checkbox" name="f_history[]" value="<?php echo $f_history[$i]?>">&nbsp<?php echo $f_history[$i]?></li>
						</ul>
						<?php } ?>
					</div>
					<div class="col-md-6">
							<label>Height</label>
							<input type="number" name="height" id="height" class="form-control form-group" placeholder="e.g 1.75">

							<label>Weight</label>
							<input type="number" name="weight" id="weight" class="form-control form-group">
						</div>

						<div class="col-md-6">
              <label for="">Body Mass Index:</label>
              <input type="number" name="bmi" id="bmi" class="form-control form-group" readonly>

              <label for="">Classification:</label>
              <input type="text" name="classification" id="classification" class="form-control" readonly>
          </div>
					<div class="col-md-12">
						<label>Smoking:</label>
						<textarea name="smoking" id="e_smoking" placeholder="Number of Sticks/frequency (eg: 1/day or 3/week) " class="form-control form-group" rows="4"></textarea>

						<label>Drinking:</label>
						<textarea name="drinking" id="e_drinking" placeholder="Number of Bottles/frequency (eg: 1/day or 3/week) " class="form-control form-group" rows="4"></textarea>
					</div>
				</div>
			</form>
				
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="edit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){

		$("#weight").keyup(function(){  
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var height1 = height * height;
        var bmi = weight / height1;
        var decimal = bmi.toFixed(2);
        $("#bmi").val(decimal);

        if (decimal >= 24.90 && decimal <= 29.90) {
        	$("#classification").val("Over weight");
        }
        else if(decimal >= 18.50 && decimal < 24.90){
					$("#classification").val("Healthy weight");
        }
        else if(decimal >= 0 && decimal < 18.50){
					$("#classification").val("Under weight");
        }else{
        	$("#classification").val("Obesity");
        }
            
    }); 

		$('#save_record').click(function(){
			start_load();
			$.ajax({
				url: "../std-model/save_health_record.php",
				method: "POST",
				data: $('#health_form').serialize(),
				success:function(data){
					
				},
				complete:function(){
					location.reload();
					end_load();
				}
			})
		})

		$('.update').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "edit_health_record.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					data = JSON.parse(data);
					$('#e-std_id').val(id);
					$('#e_illness').val(data.illness);
					$('#e_medication').val(data.med_taken);
					$('#e_operation').val(data.operation);
					$('#height').val(data.height);
					$('#weight').val(data.weight);
					$('#bmi').val(data.bmi);
					$('#classification').val(data.classification);
					$('#e_smoking').val(data.smoking);
					$('#e_drinking').val(data.drinking);
					$('#manage-health').modal('show');
				}
			})
		})

		$('#edit').click(function(){
			start_load()
			$.ajax({
				url: "../std-model/edit_save_health_record.php",
				method: "POST",
				data: $('#edit-health').serialize(),
				success:function(data){
				},
				complete:function(){
					end_load();
					location.reload();
				}
			})
		})
	})
</script>
<style type="text/css">
	.li{
		text-decoration: none;
		font-size: 14px;
		font-weight: 500;
	}
</style>