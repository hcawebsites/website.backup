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
							<span>Number of Appointment</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT count(*) as total from clinic_appointments WHERE Status = 1");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['total'];
							?>
						</div>

						<div class="col-md-11">
							<i class="fa fa-hospital-o list"></i>
							<span>Number of Patients</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT count(*) as total from health_record");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['total'];
							?>
						</div>

						<div class="col-md-11">
							<i class="fa fa-medkit student"></i>
							<span>Total Number of Medicines</span>
						</div>

						<div class="col-md-1 text-right">
							<?php  
								$get_count = mysqli_query($con, "SELECT SUM(Total) as total from medicine;");
								$row = mysqli_fetch_assoc($get_count);
								echo $row['total'];
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
					<th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Reason</th>
          <th scope="col">Date</th>
          <th scope="col">Time</th>
          <th scope="col">Date Created</th>
          <th scope="col">Status</th>
				</thead>
				<tbody>
					<?php  
						$get = mysqli_query($con, "SELECT *, clinic_appointments.Status FROM clinic_appointments inner join student on clinic_appointments.Student_ID = student.Student_ID");
						while ($row = mysqli_fetch_assoc($get)) {
							$name = $row['Firstname']. " " .$row['Lastname'];
              $date = date('F j, Y', strtotime($row['Date']));
              $time = date('h:i A', strtotime($row['Time']));
              $date_created = date('F y, Y', strtotime($row['Date_Created']));
							?>
							<tr>
								 <td style = "vertical-align: middle;"><?=$count++?></td>
                  <td style = "vertical-align: middle;"><?=$name?></td>
                  <td style = "vertical-align: middle;"><?=$row['Reason']?></td>
                  <td style = "vertical-align: middle;"><?=$date?>
                  <td style = "vertical-align: middle;"><?=$time?></td>
                  <td class="text-center" style = "vertical-align: middle;"><?=$date_created?></td>
	                <td style = "vertical-align: middle;" class="text-center">
	                    <?php
	                        if ($row['Status'] == '1') {
	                            echo "<p class='pending'>Pending</p>";
	                        }else{
	                            echo "<p class='settled'>Complete</p>";
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
