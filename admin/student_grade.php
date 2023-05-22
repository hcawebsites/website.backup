<?php  
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php');
include_once('../database/connection.php');
$count = 1;
$sy = mysqli_query($con, "SELECT * from academic_list Where is_default = 1");
$row_sy = mysqli_fetch_assoc($sy);
$semester = $row_sy['Semester'];
$ay = $row_sy['School_Year'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Grade
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Master List</a></li>
			<li><a href="#">Student Grade</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<input type="text" name="search" id="search" class="form-control" placeholder="Search by subject code">
			<hr>
			<?php  
				$std_id = $_GET['std_id'];
				$get = mysqli_query($con, "SELECT Department, concat(Firstname, ' ' , Lastname) as name from grade inner join student_grade on grade.ID = student_grade.Class_ID inner join student on student_grade.Student_ID = student.Student_ID Where student_grade.Student_ID = '$std_id'");
				$row = mysqli_fetch_assoc($get);
				$dept = $row['Department'];
				$name = $row['name'];

				if ($dept == "SHSDEPT") {
					?>
					<div class="table-title">
						<h3 style="color: #666666; font-size: 20px; font-weight: 600;">Grade of <?=$name?></h3>
						<form action="../reports/std_grade_reports.php" method="POST">
							<input type="hidden" name="std_id" value="<?php echo $std_id?>">
							<button type="button" class="btn btn-primary preview" id="<?php echo $std_id ?>"><i class="fa fa-eye"></i>&nbspPreview Grade</button>

							<button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>
						</form>
					</div>
					<table class="table table-bordered table-striped" style="color: #666666; font-size: 12px; font-weight: 500; margin-top: 10px;" id="data">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Subject Code</th>
								<th scope="col">Description</th>
								<th scope="col">Prelim</th>
								<th scope="col">Midterm</th>
								<th scope="col">Finals</th>
								<th scope="col">Overall</th>
								<th scope="col">Semester</th>
								<th scope="col">Academic Year</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="content">
							<?php  
								$get_grade = mysqli_query($con, "SELECT * FROM shs_grade inner join subjects on shs_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' And Semester = '$semester' and AY = '$ay'");
								while ($row_grade = mysqli_fetch_assoc($get_grade)) {
									?>
									<tr>
										<td style="vertical-align: middle;"><?=$count++?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Subject']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Description']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Prelim']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Midterm']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Final']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Overall']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Semester']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['AY']?></td>
										<td style="vertical-align: middle;" class="text-center">
											<button type="button" class="btn btn-warning edit" id="<?=$row_grade['Student_ID']?>" data-id="<?=$row_grade['Subject']?>"><i class="fa fa-pencil-square-o"></i></button>
											<button type="button" class="btn btn-danger deleteBtn" id="<?=$row_grade['Student_ID']?>"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
							<?php }?>

							
						</tbody>
					</table>
			<?php }
				else{
					?>
					<div class="table-title">
						<h3 style="color: #666666; font-size: 20px; font-weight: 600;">Grade of <?=$name?></h3>
						<form action="../reports/std_grade_reports.php" method="POST">
							<input type="hidden" name="std_id" value="<?php echo $std_id?>">
							<button type="button" class="btn btn-primary preview" id="<?php echo $std_id ?>"><i class="fa fa-eye"></i>&nbspPreview Grade</button>

							<button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>
						</form>
					</div>

					<table class="table table-bordered table-striped" style="color: #666666; font-size: 12px; font-weight: 500; margin-top: 10px;" id="data">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Subject Code</th>
								<th scope="col">Description</th>
								<th scope="col">1st Grading</th>
								<th scope="col">2nd Grading</th>
								<th scope="col">3rd Grading</th>
								<th scope="col">4th Grading</th>
								<th scope="col">Finals</th>
								<th scope="col">School Year</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="content">
							<?php  
								$get_grade = mysqli_query($con, "SELECT * FROM std_grade inner join subjects on std_grade.Subject = subjects.Subject_Code Where Student_ID = '$std_id' and SY = '$ay'");
								while ($row_grade = mysqli_fetch_assoc($get_grade)) {
									?>
									<tr>
										<td style="vertical-align: middle;"><?=$count++?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Subject']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Description']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['First']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Second']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Third']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Fourth']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['Final']?></td>
										<td style="vertical-align: middle;"><?=$row_grade['SY']?></td>
										<td style="vertical-align: middle;" class="text-center">
											<button type="button" class="btn btn-warning edit" id="<?=$row_grade['Student_ID']?>" data-id="<?=$row_grade['Subject']?>"><i class="fa fa-pencil-square-o"></i></button>
											<button type="button" class="btn btn-danger deleteBtn" id="<?=$row_grade['Student_ID']?>"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
							<?php }?>

							
						</tbody>
					</table>

			<?php } 

			?>
		</div>
	</section>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h3 class="modal-title">Add Student Grade</h3>
        
      </div>
      <div class="modal-body">
        <?php  
        	if ($dept == "SHSDEPT") {
        ?>

        <form action="" id="grade-form">
        	<input type="hidden" name="ay" value="<?php echo $ay  ?>" class="form-control" readonly>
        	<input type="hidden" name="semester" value="<?php echo $semester  ?>" class="form-control" readonly>
        		<div class="row">
        			<div class="col-md-12 form-group">
        				<input type="hidden" name="std_id" id="std_id1" class="form-control" readonly>
        				<label>Student Name:</label>
        				<input type="text" name="name" id="name1" class="form-control" readonly>
        			</div>

        			<div class="col-md-6 form-group">
        				<label>Subject Code:</label>
        				<input type="text" name="subject" id="code" class="form-control" readonly>
        			</div>

        			<div class="col-md-6 form-group">
        				<label>Subject Description:</label>
        				<input type="text" name="title" id="title" value="<?php echo $des ?>" class="form-control" readonly>
        			</div>

        			<div class="col-md-3 form-group">
        				<label>Prelim:</label>
        				<input type="number" name="prelim" id="prelim" class="form-control shs">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>Midterm:</label>
        				<input type="number" name="midterm" id="midterm" class="form-control shs">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>Final:</label>
        				<input type="number" name="final" id="final" class="form-control shs">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>Overall Grade:</label>
        				<input type="number" name="overall" id="overall" class="form-control" readonly>
        			</div>
        		</div>

        		<div class="modal-footer">
				<button type="button" id="save_shs_grade" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
        	</form>
        	
        <?php } 
        else{
		?>

		<form action="" id="grades_form">
        		<div class="row">
        			<div class="col-md-12 form-group">
        				<input type="hidden" name="ay" value="<?php echo $ay  ?>" class="form-control" readonly>
        				<input type="hidden" name="std_id" id="std_id1" class="form-control" readonly>
        				<label>Student Name:</label>
        				<input type="text" name="name" id="name" class="form-control" readonly>
        			</div>

        			<div class="col-md-6 form-group">
        				<label>Subject Code:</label>
        				<input type="text" name="subject" id="code" class="form-control" readonly>
        			</div>

        			<div class="col-md-6 form-group">
        				<label>Subject Description:</label>
        				<input type="text" name="title" id="title" value="<?php echo $des ?>" class="form-control" readonly>
        			</div>

        			<div class="col-md-3 form-group">
        				<label>1st Grading:</label>
        				<input type="number" name="first" id="first" class="form-control grade">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>2nd Grading:</label>
        				<input type="number" name="second" id="second" class="form-control grade">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>3rd Grading:</label>
        				<input type="number" name="third" id="third" class="form-control grade">
        			</div>

        			<div class="col-md-3 form-group">
        				<label>4th Grading:</label>
        				<input type="number" name="fourth" id="fourth" class="form-control grade">
        			</div>

        			<div class="col-md-3 form-group" style="float:right;">
        				<label>Final Grading:</label>
        				<input type="number" name="final" id="final" class="form-control" readonly>
        			</div>
        		</div>

        		<div class="modal-footer">
				    <button type="button" id="save_grade" class="btn btn-primary">Save Grade</button>
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
        	</form>
		
        <?php }?>

        
      </div>
    </div>
  </div>
</div>
<?php include_once 'footer.php'?>
<script>
	$(document).ready(function(){

		$('.preview').click(function(){
			var std_id = $(this).attr('id');
			$.ajax({
				url: "preview_grade.php",
				method: "POST",
				data:{
					std_id:std_id
				},
				success:function(data){
					$('#data').html(data);
				}
			})
		});
		$('.edit').click(function(){
			var std_id = $(this).attr('id');
			var subject = $(this).attr('data-id');
			$.ajax({
				url: "edit_grade.php?code="+subject,
				method: "POST",
				data:{
					std_id:std_id,
				},
				success:function(data){
					data = JSON.parse(data);
					$('#name1').val(data.name);
					$('#std_id1').val(std_id);
					$('#prelim').val(data.prelim);
					$('#midterm').val(data.midterm);
					$('#final').val(data.final);
					$('#code').val(data.subject);
					$('#title').val(data.description);
					$('#overall').val(data.overall);

					$('#name').val(data.name);
					$('#first').val(data.first);
					$('#second').val(data.second);
					$('#third').val(data.third);
					$('#fourth').val(data.fourth);
					$('#final').val(data.final);
					$('#edit_modal').modal('show');
				}
			})
		});

		$('#save_shs_grade').click(function(){
			start_load();
			$.ajax({
				url: "../model/save_grade.php",
				method: "POST",
				data: $('#grade-form').serialize(),
				success:function(data){
					alert("Data successfully saved.");
				},
				complete:function(){
					end_load();
					location.reload();
				}
			})
		})

		$('#save_grade').click(function(){
			start_load();
			$.ajax({
				url: "../model/save_grade.php",
				method: "POST",
				data: $('#grades_form').serialize(),
				success:function(data){
					alert("Data successfully saved.");
				},
				complete:function(){
					end_load();
					location.reload();
				}
			})
		})

		$('#search').keyup(function(){
			var val = $(this).val();

			$.ajax({
				url: "search_grade.php?std_id=<?=$std_id?>",
				method: "POST",
				data: {
					val:val
				},
				success:function(data){
					$('#content').html(data);
				}
			})
		})
	})

		$(function(){
		var total_grade = function(){
			var sum = 0;
			$('.shs').each(function(){
				var num = $(this).val().replace(',','');
				if (num != 0) {
					sum +=parseFloat(num);

				}

			});

			var final_grade = sum/3;

			$('#overall').val(final_grade);
		}

		$('.shs').keyup(function(){
			total_grade();
		})
	});

	$(function(){
		var total_grade = function(){
			var sum = 0;
			$('.grade').each(function(){
				var num = $(this).val().replace(',','');
				if (num != 0) {
					sum +=parseFloat(num);

				}

			});

			var final_grade = sum/4;

			$('#final').val(final_grade);
		}

		$('.grade').keyup(function(){
			total_grade();
		})
	});
</script>