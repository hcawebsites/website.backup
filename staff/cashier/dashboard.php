<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
$get  = mysqli_query($con, "SELECT * FROM staff_tb Where Emp_ID = '$myID'");
$row = mysqli_fetch_assoc($get);
$date = date('F j, Y');
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
		<div class="row">
			<div class="col-md-12">
				<div id="content">
					<div class="datetime">
						<div class="col-md-6">

							<div class="icon">
								<?php echo $row['Cashier']  ?>
								<a href="#" onclick="window.open('monitor.php?myID=<?php echo $myID ?>', 'blank_')">
									<i class="fa fa-television"></i>
								</a>
							</div>
								
							
						</div>
						<div class="col-md-6 text-right">
							<div id="clock"></div>
							<?php 
							 echo $date  ?>
						</div>

					</div>
					<hr>
					<div class="col-md-8">
						<table class="table table-striped" id="search">
							<thead>
								<tr>
									<th>Number</th>
									<th>Name</th>
									<th>Contact	</th>
									<th>Purpose</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php  
								$date = date('Y-m-d');
								$get = mysqli_query($con, "SELECT *, queuing.Status from queuing inner join student on queuing.Student_ID = student.Student_ID Where Cashier = '$myID' AND queuing.Date = '$date' Order by Number ASC");
								while ($row = mysqli_fetch_assoc($get)) {
									$name = $row['Firstname']. " " .$row['Lastname']
									?>
									<tr>
										<td scope="col"><?=$row['Number']?></td>
										<td scope="col"><?=$name?></td>
										<td scope="col"><?=$row['Contact']?></td>
										<td scope="col"><?=$row['Purpose']?></td>
										<td scope="col">
											<?php
												if ($row['Status'] == 1) {
													echo '<p class="text-center bg-warning">Pending</p>';
												}else{
													echo '<p class="text-center bg-success">Done</p>';
												}
											?>
										</td>
									</tr>
								<?php }?>
								
							</tbody>
						</table>
					</div>
					<div class="col-md-4">
						<div class="queue-content">
							<div class="row">
							<div class="col-md-12">
								<?php $get = mysqli_query($con, "SELECT *, concat(Firstname, ' ' , Lastname) as name FROM queuing inner join student on queuing.Student_ID = student.Student_ID WHERE Cashier = '$myID' AND queuing.Status = 1 AND queuing.Date = '$date' Order by Number ASC Limit 1");
								if (mysqli_num_rows($get) > 0) {
									$row = mysqli_fetch_assoc($get);
									echo 
									"
									<div class='row'>
										<div class='col-md-12 text-center'>
											<p class='number'>".$row['Number']."</p>
											<div id='ss'>
												<p class='name'>".$row['name']."</p>
												<p>".$row['Purpose']."</p>
											</div>
										</div>

										<div class='col-md-12'><hr></div>
										<div class='col-md-6'>
											<button type='button' id=".$myID." class='btn btn-info form-control next'>Next</button>
										</div>
										<div class='col-md-6'>
											<button type='button' id=".$row['Student_ID']." class='btn btn-warning form-control notify'>Notify</button>
										</div>

									</div>
									";
								}else{
									echo 
									"
									<div class='row'>
										<div class='col-md-12 text-center'>
											<p class='norow'>No Queue Available<p>
										</div>

									</div>
									";
								}
								?>
							</div>
							
						</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
	</section>
</div>
<?php include_once '../footer.php'?>

<script type="text/javascript">
	var timer1 = 0;
$(document).ready(function(){
	$('.next').click(function(){
		var cid = $(this).attr('id');
		$.ajax({
			url: "../../staff-model/next_queue.php",
			method: "POST",
			data:{
				cid:cid
			},
			success:function(data){
				data = JSON.parse(data);
				if(Object.keys(data).length <= 0 ){
					alert("No Queue Available");
				}else{
					location.reload();
					finish()
					window.reload('monitor.php')
				}
			}
		})
	})

	$('.notify').click(function(){
		start_load()
		var std_id = $(this).attr('id');
		$.ajax({
			url: "../../staff-model/send_notif.php",
			method : "POST",
			data:{
				std_id:std_id
			},
			success:function(data){
				let type = 'success';
			    let title = 'Notification Sent.';
			   	
			    createToast(type, title);
			},
			complete:function(){
				if (timer1 == 0) {
					intervalID = setInterval(function(){
						end_load();
						location.reload();
					}, 3000);
				}
			}
		})
		
	})
})
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

</script>

<style type="text/css">
	#content{
		margin-top: 10px;
		width: 100%;
		height: 100vh;
		background: #d9d9d9;
	}
	.datetime{
		display: flex;
		background: #666666;
		padding: 10px;
		color: #fff;
		font-weight: 100;

	}
	#clock{
		font-size: 26px;

	}

	.icon{
		display: flex;
		justify-content: space-between;
		align-items: center;
		font-size: 26px;
		cursor: pointer;
	}
	.icon a{
		color: #fff;
	}

	#content .table{
		margin-top: px;
		font-size: 13px;
		color: #333;
	}

	#content .table td{
		vertical-align: middle;
	}

	.queue-content{
		border-top-right-radius: 20px;
		border-bottom-left-radius: 20px;
		display: flex;
		justify-content: center;
		align-items: center;
		background: #fff;
		height: 40%;
		padding: 20px;
	}

	.number{
		font-size: 30px;
		font-weight: 600;
	}

	.name{
		font-size: 20px;
		font-weight: 300;
	}

	#ss{
		line-height: 10px;
	}

	.norow{
		font-size: 20px;
		font-weight: 600;
	}

</style>