<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php');
error_reporting(0);
$myID = $_SESSION['emp_id'];
$sched_id = $_GET['sched_id'];
$get_sub = mysqli_query($con, "SELECT *, schedule.Class_ID FROM subjects inner join schedule on subjects.Subject_Code = schedule.Code inner join grade on schedule.Class_ID = grade.ID WHERE schedule.Teacher_ID = '$myID' AND schedule.ID = '$sched_id'");
$row = mysqli_fetch_assoc($get_sub);
$des = $row['Description'];
$dept = $row['Department'];
$class = $row['Class_ID'];
$subject = $row['Code'];
$grade = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
$sub = $subject. " - " . $des;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Per Subjects
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Entry</a></li>
            <li><a href="#">Subjects</a></li>
            <li><a href="#">Students</a></li>
		</ol>
		<hr>
		<hr>
	</section>

	<section class="content">
	
	<?php  
			echo "<p class='btn btn-success'>".$row['Name']. " ". $row['Strand'] . " - " .$row['Section']."</p>";
			echo " | ";
			echo "<p class='btn btn-primary'>".$row['Code']." - ".$des."</p><br><br>";
	?>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#_enter_bulk_grade">Enter Bulk Grade</button>
		<div class="table-master">
			<div class="table-title">
            <h3><i class="fa fa-graduation-cap">&nbspHandled Students</i></h3>
            
                <div class="btn-master">	    
	                <form action="../../reports/std_grade_reports.php" method="POST">
	                	<div class="row form-inline">
	                		<input type="hidden" name="myID" value="<?php echo $myID ?>">
	                		<input type="hidden" name="sched_id" value="<?php echo $sched_id ?>">
	                		<input type="hidden" name="department" value="<?php echo $dept ?>">
	                		<input type="hidden" name="grade" value="<?php echo $grade ?>">
	                		<input type="hidden" name="subject" value="<?php echo $sub ?>">
			                <button type="submit" name="print" class="btn btn-danger form-control" id="print"><i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
			                <button type="submit" name="export" class="btn btn-success form-control" id="excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbspExcel</button>
			            	</div>
	                </form>
                </div>
        </div>


        <?php  
        	if ($dept == "SHSDEPT") {
        	?>
        	<table class="table table-bordered table-striped" id="search" style="color: #5c5c5c; font-size: 14px; font-weight: 400">
        		<thead>
        			<tr>
        				<td scope="col">#</td>
        				<td scope="col">Student ID</td>
        				<td scope="col">Name</td>
        				<td scope="col">Prelim</td>
        				<td scope="col">Midterm</td>
        				<td scope="col">Final</td>
        				<td scope="col">Overall</td>
        				<td scope="col">Remarks</td>
        			</tr>
        		</thead>
        		<tbody class="table-hover">
        			<?php
        				$count=1;
        				$get_student = mysqli_query($con, "SELECT * FROM student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID inner join student on student_grade.Student_ID = student.Student_ID Where schedule.ID = '$sched_id' AND schedule.Teacher_ID = '$myID' ORDER BY student.Lastname ASC");
        				while ($row = mysqli_fetch_assoc($get_student)) {
        					$std_id = $row['Student_ID'];
        					$name = $row['Firstname']. " " .$row['Lastname'];
        					
									$get_grade = mysqli_query($con, "SELECT * FROM shs_grade Where Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
        					$row1 = mysqli_fetch_assoc($get_grade); 
        					?>
        					<tr>
        						<td style="vertical-align:middle;"><?=$count++?></td>
	        					<td style="vertical-align:middle;"><?=$std_id?></td>
	        					<td style="vertical-align:middle;"><?=$name?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Prelim']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Midterm']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Final']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Overall']?></td>
	        					<td style="vertical-align:middle;" class="text-center">
	        						<?php
	        							if ($row1['Overall'] < 75) {
	        								echo "<p class='btn btn-danger'>Failed</p>";
	        							}else{
	        								echo "<p class='btn btn-success'>Passed</p>";
	        							}
	        						?>
	        							
	        					</td>
        					</tr>
        				<?php } ?>

        			
        		</tbody>
        		
        	</table>
    	<?php }
    	else{
			?>

			<table class="table table-bordered table-striped" id="search" style="color:#666666; font-size: 13px; font-weight: 400;">
        		<thead>
        			<tr>
        				<td scope="col">#</td>
        				<td scope="col">Student ID</td>
        				<td scope="col">Name</td>
        				<td scope="col">1st</td>
        				<td scope="col">2nd</td>
        				<td scope="col">3rd</td>
        				<td scope="col">4th</td>
        				<td scope="col">Final</td>
        				<td scope="col">Remarks</td>
        			</tr>
        		</thead>
        		<tbody class="table-hover">
        			<?php  
        				$get_student = mysqli_query($con, "SELECT * FROM handle_student inner join student on handle_student.Student_ID = student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID WHERE schedule.ID = '$sched_id' AND schedule.Teacher_ID = '$myID' ORDER BY student.Lastname ASC");
        				while ($row = mysqli_fetch_assoc($get_student)) {
        					$std_id = $row['Student_ID'];
        					$name = $row['Firstname']. " " .$row['Lastname'];
        					$count+=1;
        					$get_grade = mysqli_query($con, "SELECT * FROM std_grade Where Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
        					$row1 = mysqli_fetch_assoc($get_grade); 
        					?>
        					<tr>
        						<td style="vertical-align:middle;"><?=$count?></td>
	        					<td style="vertical-align:middle;"><?=$std_id?></td>
	        					<td style="vertical-align:middle;"><?=$name?></td>
	        					<td style="vertical-align:middle;"><?=$row1['First']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Second']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Third']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Fourth']?></td>
	        					<td style="vertical-align:middle;"><?=$row1['Final']?></td>
	        					<td style="vertical-align" class="text-center">
	        						<?php
	        							if ($row1['Final'] < 75) {
	        								echo "<p class='btn btn-danger'>Failed</p>";
	        							}else{
	        								echo "<p class='btn btn-success'>Passed</p>";
	        							}
	        						?>
	        							
	        					</td>
        					</tr>
        				<?php } ?>

        			
        		</tbody>
        		
        	</table>
				
    	<?php } ?>
        	


        
		</div>
	</section>
</div>

<div class="modal fade" id="_enter_bulk_grade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 1rem 1rem 1rem 1rem;">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <p style="font-size: 16px; font-weight: 400; color: #5c5c5c;">
        	<i class="fa fa-plus"></i>
        	Enter Bulk Grade
        </p>
        <hr>
        <form action="" method="POST" id="form_grade">
        	<input type="hidden" name="department" value="<?php echo $dept  ?>">
        	<input type="hidden" name="sched_id" value="<?php echo $sched_id  ?>">
        	<input type="hidden" name="class_id" value="<?php echo $class  ?>">
        	<input type="hidden" name="subject" value="<?php echo $subject  ?>">
        <?php
        	if ($dept == "SHSDEPT") {
        		?>
        		<table class="table table-condensed" style="font-size: 13px; font-weight: 400; color: #666666;">
        			<thead>
	        			<tr>
	        				<td scope="col">#</td>
	        				<td scope="col">Student ID</td>
	        				<td scope="col">Name</td>
	        				<td scope="col">Prelim</td>
	        				<td scope="col">Midterm</td>
	        				<td scope="col">Final</td>
	        				<td scope="col">Overall</td>
	        				<td scope="col">Remarks</td>
	        			</tr>
        		</thead>
        		<tbody>
        			
        			
        			<?php
        			$count = 1;  
        			$_get = mysqli_query($con, "SELECT *, handle_student.Student_ID, concat(Firstname, ' ' , Lastname) as name FROM handle_student inner join student on handle_student.Student_ID = student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID WHERE schedule.ID = '$sched_id' AND schedule.Teacher_ID = '$myID' ORDER BY student.Lastname ASC");
        			while ($_row = mysqli_fetch_assoc($_get)) {
        				$std_id = $_row['Student_ID'];
        				$get_grade = mysqli_query($con, "SELECT * FROM shs_grade Where Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
        				$_row_grade = mysqli_fetch_assoc($get_grade); 
        				?>
        					<input type="hidden" name="array[]" value="<?php echo $_row['Student_ID']  ?>">
        					<tr>
        						<td scope="col" style="vertical-align: middle;"><?php echo $count++  ?></td>
        						<td style="vertical-align:middle;"><?=$_row['Student_ID']?></td>
	        					<td style="vertical-align:middle;"><?=$_row['name']?></td>
	        					<td style="vertical-align:middle;" class="text-center">
	        						<?php  
	        							if ($_row_grade['Prelim'] == 0) {
	        								echo '<input name="_prelim'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
	        							}else{
													echo '<input name="_prelim'.$std_id.'" value="'.$_row_grade['Prelim'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
	        							}

	        						?>
	        					</td>
	        					<td style="vertical-align:middle;" class="text-center">
	        						<?php  
	        							if ($_row_grade['Midterm'] == 0) {
	        								echo '<input name="_midterm'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
	        							}else{
													echo '<input name="_midterm'.$std_id.'" value="'.$_row_grade['Midterm'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
	        							}

	        						?>
	        					</td>
	        					<td style="vertical-align:middle;" class="text-center">
	        						<?php  
	        							if ($_row_grade['Final'] == 0) {
	        								echo '<input name="_final'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
	        							}else{
													echo '<input name="_final'.$std_id.'" value="'.$_row_grade['Final'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
	        							}

	        						?>
	        					</td>
	        					<td style="vertical-align" class="text-center"><input value="<?php echo $_row_grade['Overall']  ?>" readonly class="form-control" style="width: 50px; text-align: center;"></input></td>
	        					<td style="vertical-align:middle;" class="text-center">
	        						<?php
	        							if ($_row_grade['Overall'] < 75) {
	        								echo "<p class='btn btn-danger'>Failed</p>";
	        							}else{
	        								echo "<p class='btn btn-success'>Passed</p>";
	        							}
	        						?>
	        							
	        					</td>
        					</tr>
        				
        				<?php
							}
        			?>
        		</tbody>
        			
        		</table>
        		<?php
        	}else{
        		?>
        		<table class="table table-condensed" style="font-size: 13px; font-weight: 400; color: #666666;">
        			<thead>
        				<tr>
        					<td scope="col">#</td>
	        				<td scope="col">Student ID</td>
	        				<td scope="col">Name</td>
	        				<td scope="col">1st</td>
	        				<td scope="col">2nd</td>
	        				<td scope="col">3rd</td>
	        				<td scope="col">4th</td>
	        				<td scope="col">Final</td>
	        				<td scope="col">Remarks</td>
        				</tr>
        			</thead>
        			<tbody>
        				<?php
		        			$count = 1;  
		        			$_get = mysqli_query($con, "SELECT *, handle_student.Student_ID, concat(Firstname, ' ' , Lastname) as name FROM handle_student inner join student on handle_student.Student_ID = student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID WHERE schedule.ID = '$sched_id' AND schedule.Teacher_ID = '$myID' ORDER BY student.Lastname ASC");
		        			while ($_row = mysqli_fetch_assoc($_get)) {
		        				$std_id = $_row['Student_ID'];
		        				$get_grade = mysqli_query($con, "SELECT * FROM std_grade Where Student_ID = '$std_id' AND Sched_ID = '$sched_id'");
		        				$_row_grade = mysqli_fetch_assoc($get_grade); 
		        				?>
		        					<input type="hidden" name="array[]" value="<?php echo $_row['Student_ID']  ?>">
		        					<tr>
		        						<td scope="col" style="vertical-align: middle;"><?php echo $count++  ?></td>
		        						<td style="vertical-align:middle;"><?=$_row['Student_ID']?></td>
			        					<td style="vertical-align:middle;"><?=$_row['name']?></td>
			        					<td style="vertical-align:middle;" class="text-center">
			        						<?php  
			        							if ($_row_grade['First'] == 0) {
			        								echo '<input name="_first'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
			        							}else{
															echo '<input name="_first'.$std_id.'" value="'.$_row_grade['First'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
			        							}

			        						?>
			        					</td>
			        					<td style="vertical-align:middle;" class="text-center">
			        						<?php  
			        							if ($_row_grade['Second'] == 0) {
			        								echo '<input name="_second'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
			        							}else{
															echo '<input name="_second'.$std_id.'" value="'.$_row_grade['Second'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
			        							}

			        						?>
			        					</td>
			        					<td style="vertical-align:middle;" class="text-center">
			        						<?php  
			        							if ($_row_grade['Third'] == 0) {
			        								echo '<input name="_third'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
			        							}else{
															echo '<input name="_third'.$std_id.'" value="'.$_row_grade['Third'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
			        							}

			        						?>
			        					</td>
			        					<td style="vertical-align:middle;" class="text-center">
			        						<?php  
			        							if ($_row_grade['Fourth'] == 0) {
			        								echo '<input name="_fourth'.$std_id.'" class="form-control" style="width: 50px; text-align: center;"></input>';
			        							}else{
															echo '<input name="_fourth'.$std_id.'" value="'.$_row_grade['Fourth'].'" class="form-control" readonly style="width: 50px; text-align: center;"></input>';
			        							}

			        						?>
			        					</td>
			        					<td style="vertical-align:middle;" class="text-center"><input value="<?php echo $_row_grade['Final']  ?>" readonly class="form-control" style="width: 50px; text-align: center;"></input></td>
			        					<td style="vertical-align:middle;" class="text-center">
			        						<?php
			        							if ($_row_grade['Final'] < 75) {
			        								echo "<p class='btn btn-danger'>Failed</p>";
			        							}else{
			        								echo "<p class='btn btn-success'>Passed</p>";
			        							}
			        						?>
			        							
			        					</td>
		        					</tr>
		        				
		        				<?php
									}
		        			?>
        				
        			</tbody>
        			
        		</table>
        		<?php
        		//ELDEPT JHSDEPT
        	}


        ?>
        <div class="text-right">
        	<button type="button" id="save" class="btn btn-success text-center">Save Grade</button>
        </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search').DataTable();

		$('#save').click(function(){
			$.ajax({
				url: "../../staff-model/add_grade.php",
				method: "POST",
				data: $('#form_grade').serialize(),
				success:function(data){                 
					const swalWithBootstrapButtons = Swal.mixin({
			          customClass: {
			            confirmButton: 'btn btn-success',
			          },
			          buttonsStyling: false
			        })

			        swalWithBootstrapButtons.fire({
			          title: 'Grade Successfully Added!',
			          text: "",
			          icon: 'success',
			          showCancelButton: false,
			          confirmButtonText: 'Close',
			        }).then((result) => {
			          if (result.isConfirmed) {
			            location.reload();
			            }
			        })
				}
			})
		})
	})
</script>