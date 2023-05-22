<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../../database/connection.php';
$myID = $_SESSION['emp_id'];
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Student Attendance
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Student</a></li>
			<li><a href="#">Student Attendance</a></li>
		</ol>
	</section>
	<hr>
	<section class="content">
		<div class="table-master">
			
			<form action="../../reports/std_attendance.php" method="POST" id="filter">
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-2">
						<button type="submit" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
					</div>
					<div class="col-md-2">
						<button type="submit" name="print" class="btn btn-danger form-control"><i class="fa fa-print"></i>&nbspPrint</button>
					</div>
					<div class="col-md-6 form-group">
						<input type="hidden" name="myID" id="myID" value="<?php echo $myID?>">
						<p style="color: #3487FF; font-size: 14px; font-weight: 300">Filter Attendance</p>
						<select name="subject" id="subject" class="form-control">
							<option hidden value="" selected>Select Subject Here...</option>
							<?php  
								$get = mysqli_query($con, "SELECT *, schedule.ID as id FROM schedule inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE schedule.Teacher_ID = '$myID' ORDER BY schedule.ID ASC");
								while ($row = mysqli_fetch_assoc($get)) {
								?>
								<option value="<?=$row['id']?>"><?=$row['Description'] . " - " .$row['Room']?></option>
							<?php  }?>
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
						<td>Student ID</td>
						<td>Name</td>
						<td>Subject</td>
						<td>Class</td>
						<td>Time In</td>
						<td>Time Out</td>
						<td>Remarks</td>
						<td>Date</td>
					</tr>
				</thead>
				<tbody id="filter_attendance">
					<?php
						$count = 1;
						$_get_attendance = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, std_attendance.Status as status, std_attendance.Date as date FROM std_attendance inner join schedule on std_attendance.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' ORDER BY std_attendance.ID ASC");
						while ($_row = mysqli_fetch_assoc($_get_attendance)) {
							$class = $_row['Name']. " " .$_row['Strand']. " - " .$_row['Section'];
							$in = date('h:i A', strtotime($_row['Time_In'] ?? ''));
							$out = date('h:i A', strtotime($_row['Time_Out'] ?? ''));
							$date = date('F j, Y', strtotime($_row['date']));
							?>
							<tr>
								<td style="vertical-align: middle;" scope="col"><?=$count++?></td>
								<td style="vertical-align: middle;" scope="col"><?=$_row['Student_ID']?></td>
								<td style="vertical-align: middle;" scope="col"><?=$_row['name']?></td>
								<td style="vertical-align: middle;" scope="col"><?=$_row['Description']?></td>
								<td style="vertical-align: middle;" scope="col"><?=$class?></td>
								<td style="vertical-align: middle;" scope="col"><?=$in?></td>
								<td style="vertical-align: middle;" scope="col"><?=$out?></td>
								<td scope="col" class="text-center" style="vertical-align: middle;">
                                    <?php
                                    if ($_row['status'] == "On Time") {
                                        echo '<p style="background-color: #74fa5f">On Time</p>';
                                    }else if($_row['status'] == 'Late'){
                                        echo '<p style="background-color: #b2c40e; color: #fff;">Late</p>';
                                    }else{
                                        echo '<p style="background-color: #fa5f5f; color: #fff;">Absent</p>';
                                    }
                                    ?>
                                </td>
                                <td style="vertical-align: middle;" scope="col"><?=$date?></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>
<?php include_once '../footer.php';?>

<script type="text/javascript">
$(function () {
    $('#search').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
	  "pageLength": 5,
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
				$('#filter_attendance').html(data)
			}
		})
	})
})
</script>