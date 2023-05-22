<?php  
include_once 'main_head.php';
include_once 'std_header.php';
include_once 'std_sidebar.php';
include_once '../database/connection.php';
$myID = $_SESSION['student_id'];
$count = 1;
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Attendance
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Attendance</a></li>
		</ol>
	</section>
	<hr>
	<section class="content">
		<div class="table">
			<form action="#" method="post" id="filter">
				<div class="row">
					<div class="col-md-6 form-group">
						<input type="hidden" name="myID" id="myID" value="<?php echo $myID?>">
						<p style="color: #3487FF; font-size: 14px; font-weight: 300">Filter Attendance</p>
						<select name="subject" id="subject" class="form-control">
							<option hidden value="" selected>Select Subject Here...</option>
							<?php  
								$_subject = mysqli_query($con, "SELECT *, schedule.ID as id from student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE handle_student.Student_ID = '$myID'");
								while($_row = mysqli_fetch_assoc($_subject)){
								?>	
									<option value="<?=$_row['id']?>"><?=$_row['Description']. " - " .$_row['Room']?></option>
								<?php 
								}
							?>
						</select>
					</div>

					<div class="col-md-3 form-group">
						<p style="color: #5c5c5c; font-size: 14px; font-weight: 300">From:</p>
						<input type="date" name="from" id="from" class="form-control">
					</div>

					<div class="col-md-3 form-group">
						<p style="color: #5c5c5c; font-size: 14px; font-weight: 300">TO:</p>
						<input type="date" name="to" id="to" class="form-control">
					</div>
				</div>
			</form>
			<hr>

			<table class="table table-striped" style="color: #333; font-size:12px; font-weight: 600" id="search">
				<thead>
					<tr>
						<td>#</td>
						<td>Code</td>
						<td>Description</td>
						<td>Time In</td>
						<td>Time Out</td>
						<td>Remarks</td>
						<td>Teacher</td>
						<td>Date</td>
					</tr>
				</thead>

				<tbody id="filter_attendance">
					<?php  
						$get = mysqli_query($con, "SELECT *, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID WHERE std_attendance.Student_ID = '$myID' Order by std_attendance.Date ASC");
						while ($row = mysqli_fetch_assoc($get)) {
						$in = date('h:i A', strtotime($row['Time_In']));
						$out = date('h:i A', strtotime($row['Time_Out']));
						$date = date('F j, Y', strtotime($row['date']));
						$name = $row['Salutation']. ". ". $row['Firstname']. " " .$row['Lastname'];
					?>
					<tr>
						<td style="vertical-align: middle;" scope="col"><?=$count++?></td>
						<td style="vertical-align: middle;" scope="col"><?=$row['Code']?></td>
						<td style="vertical-align: middle;" scope="col"><?=$row['Description']?></td>
						<td style="vertical-align: middle;" scope="col"><?=$in?></td>
						<td style="vertical-align: middle;" scope="col"><?=$out?></td>
						<td scope="col" class="text-center" style="vertical-align: middle;">
                            <?php
                            if ($row['status'] == "On Time") {
                                echo '<p style="background-color: #74fa5f">On Time</p>';
                            }else if($row['status'] == 'Late'){
                                echo '<p style="background-color: #b2c40e; color: #fff;">Late</p>';
                            }else{
                                echo '<p style="background-color: #fa5f5f; color: #fff;">Absent</p>';
                            }
                            ?>
                        </td>
                        <td style="vertical-align: middle;" scope="col"><?=$name?></td>
                        <td style="vertical-align: middle;" scope="col"><?=$date?></td>

					</tr>

					<?php }?>

					
				</tbody>
			</table>
		</div>
	</section>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
$(function () {
    $('#search').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
	  "pageLength": 20,
      "autoWidth": false
    });
  });

$(document).ready(function(){
	$('#to').change(function(){
		$.ajax({
			url: "filter-attendance.php",
			method: "POST",
			data: $('#filter').serialize(),
			success:function(data){
				$('#filter_attendance').html(data);
			}
		})
	})
})
</script>