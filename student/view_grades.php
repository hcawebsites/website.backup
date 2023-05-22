<?php 
include_once('main_head.php');
include_once('std_header.php');
include_once('std_sidebar.php');
$myID = $_SESSION['student_id'];
$get = mysqli_query($con, "SELECT * from student_grade inner join grade on student_grade.Class_ID = grade.ID where Student_ID = '$myID'");
$row = mysqli_fetch_assoc($get);
$dept = $row['Department'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Grades
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i></a>&nbspGrades</li>
			<li><a href="#">View Grades</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<?php
			if ($dept == "SHSDEPT") {
				?>
				<div class="table">
					<p style="color: red; font-weight: 500; text-transform: uppercase;">Filter Grade</p>
					<div class="row">
						<form action="" id="grade-filter">
							<div class="col-md-6">
								<label>Academic Year:</label>
								<input type="hidden" name="std_id" id="std_id" value="<?=$myID?>" class="form-control">
								<select name="ay" id="ay" class="form-control">
									<option hidden selected>Please select here</option>
									<?php  
										$get = mysqli_query($con, "SELECT * from academic_list order by ID asc");
										while($row = mysqli_fetch_assoc($get)){
									?>
									<option value="<?=$row['School_Year']?>"><?=$row['School_Year']?></option>
									<?php }?>
									
								</select>
							</div>
							<div class="col-md-6">
								<label>Semester:</label>
								<select name="semester" id="semester" class="form-control">
									<option hidden selected>Please select here</option>
									<option value="1st Semester">1st Semester</option>
									<option value="2nd Semester">2nd Semester</option>
								</select>
							</div>
						</form>
					</div>
					<hr>

					<table class="table table-condensed">
						<thead style="font-size: 14px; font-weight: 600; color:#666666">
							<th>Subject Code</th>
							<th>Description</th>
							<th>Final</th>
							<th>School Year</th>
							<th>Semester</th>
						</thead>
						<tbody id="shs_data">
							<?php  
								$get = mysqli_query($con, "SELECT *, shs_grade.Semester from shs_grade inner join schedule on shs_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE Student_ID ='$myID'");
								while ($row = mysqli_fetch_assoc($get)) {
							?>
							<tr style="font-size: 13px; font-weight: 600; color:#666666">
								<td scope="col"><?=$row['Subject']?></td>
								<td scope="col"><?=$row['Description']?></td>
								<td scope="col"><?=$row['Overall']?></td>
								<td scope="col"><?=$row['AY']?></td>
								<td scope="col"><?=$row['Semester']?></td>
							</tr>
							<?php }?>
							
						</tbody>
					</table>
				</div>
			<?php }// end of SHSDEPT... 
			else{
				?>
				<div class="table">
					<p style="color: red; font-weight: 500; text-transform: uppercase;">Filter Grade</p>
					<div class="row">
						<form action="" id="filter">
							<div class="col-md-6">
								<label>From:</label>
								<input type="hidden" name="std_id" id="std_id" value="<?=$myID?>" class="form-control">
								<input type="date" name="from" id="from" class="form-control">
							</div>
							<div class="col-md-6">
								<label>To:</label>
								<input type="date" name="to" id="to" class="form-control">
							</div>
						</form>
					</div>
					<hr>

					<table class="table table-condensed">
						<thead style="font-size: 14px; font-weight: 600; color:#666666">
							<th>Subject Code</th>
							<th>Description</th>
							<th>Final</th>
							<th>School Year</th>
						</thead>
						<tbody id="data">
							<?php  
								$get = mysqli_query($con, "SELECT * from std_grade inner join schedule on std_grade.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE Student_ID ='$myID'");
								while ($row = mysqli_fetch_assoc($get)) {
							?>
							<tr style="font-size: 13px; font-weight: 600; color:#666666">
								<td scope="col"><?=$row['Subject']?></td>
								<td scope="col"><?=$row['Description']?></td>
								<td scope="col"><?=$row['Final']?></td>
								<td scope="col"><?=$row['SY']?></td>
							</tr>
							<?php }?>
							
						</tbody>
					</table>
				</div>
		<?php }?>
		
		
	</section>
</div>
<?php include_once 'footer.php';  ?>
<script type="text/javascript">
	var timer1 = 0;
	$(document).ready(function(){
		$('#to').change(function(){
			start_load();
			$.ajax({
				url: "filter-std-grade.php",
				method: "POST",
				data: $('#filter').serialize(),
				success:function(data){
					$('#data').html(data);
				},
				complete:function(){
					end_load();
				}
			})
		})

		$('#semester').change(function(){
			start_load();
			$.ajax({
				url: "filter-shs-grade.php",
				method: "POST",
				data: $('#grade-filter').serialize(),
				success:function(data){
					$('#shs_data').html(data);
				},
				complete:function(){
					end_load();
				}
			})
		})
	})
</script>