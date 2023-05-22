<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
$count = 1;
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			
				<div class="content-title">
					<i class="fa fa-asterisk"></i>
					<span>Details</span>
				</div>
				<hr>
				<div class="content-content">
					<div class="row">
						<div class="col-md-11">
							<i class="fa fa-calendar-check-o calendar"></i>
							<span>Number of Appointments</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT count(*) as count from appointments Where Status = '1' OR Status = '2'");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['count'];
							?>
						</div>

						<div class="col-md-11">
							<i class="fa fa-list-ol list"></i>
							<span>Number of Settled</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT count(*) as count from appointments Where Status = '0'");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['count'];
							?>
						</div>

						<div class="col-md-11">
							<i class="fa fa-graduation-cap student"></i>
							<span>Number of Student</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT count(*) as count from student Where Enrollment_Status = 'Enrolled'");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['count'];
							?>
						</div>
					</div>
				</div>
		</div>

		<div class="table-master">
			<div class="content-title">
				<i class="fa fa-calendar-check-o"></i>
				<span>Appointment List</span>
			</div>
			<hr>

			<table class="table table-striped" style="color: #666666; font-size: 12px; font-weight: 300;" id="search">
				<thead>
					<th>#</th>
					<th>Student Name</th>
					<th>Reason</th>
					<th>Bully Name</th>
					<th>Concern</th>
					<th>Created</th>
					<th>Schedule</th>
					<th>Status</th>
				</thead>
				<tbody>
					<?php  
						$get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Lastname) as name, appointments.Status as status from appointments inner join student on appointments.Student_ID = student.Student_ID Order by appointments.ID ASC");
						while ($row = mysqli_fetch_assoc($get)) {
							$created = date('F j, Y', strtotime($row['Date_Created']));
							$date = date('F j, Y h:i', strtotime($row['Date_Time']));
							?>
							<tr>
								<td style="vertical-align: middle;"><?=$count++?></td>
								<td style="vertical-align: middle;"><?=$row['name']?></td>
								<td style="vertical-align: middle;"><?=$row['Reasons']?></td>
								<td style="vertical-align: middle;"><?=$row['Bully_Name']?></td>
								<td style="vertical-align: middle;"><?=$row['Concerns']?></td>
								<td style="vertical-align: middle;"><?=$created?></td>
								<td style="vertical-align: middle;"><?=$date?></td>
								<td style="vertical-align: middle;" class="text-center">
									<?php
										if ($row['status'] == 1) {
											echo '<p class="approve">Approved</p>';
										}elseif ($row['status'] == 2) {
											echo '<p class="pending">Pending</p>';
										}else{
											echo '<p class="settled">Settled</p>';
										}
									?>	
								</td>
							</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</section>
</div>
<?php include_once '../footer.php'?>
<script>
	$(function () {
        $('#search').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": false,
		  "pageLength": 10,
          "autoWidth": false
        });
    });

</script>

<style type="text/css">
	.content-title{
		color: #666666;
		font-size: 14px;
		font-weight: 300;
	}
	.content-content{
		color: #666666;
		font-size: 13px;
		font-weight: 400;
		line-height: 50px;
	}

	.content-content .calendar{
		font-size: 12px;
		background-color: #4670f0;
		padding: 10px;
		color: #fff;
		border-radius: 100%;
	}

	.content-content .list{
		font-size: 12px;
		background-color: #11f58b;
		padding: 10px;
		color: #fff;
		border-radius: 100%;
	}

	.content-content .student{
		font-size: 12px;
		background-color: #f5b111;
		padding: 10px;
		color: #fff;
		border-radius: 100%;
	}

	.settled{
		background-color: #3bf511;
		width: 100px;
		color: #fff;
		font-weight: 500;
	}

	.pending{
		background-color: #ed6673;
		width: 100px;
		color: #fff;
		font-weight: 500;
	}

	.approve{
		background-color: #e6ed66;
		width: 100px;
		color: #333;
		font-weight: 500;
	}
</style>

<script type="text/javascript">


</script>
