<?php  
include_once 'main_head.php';
include_once '../../database/connection.php';
$myID = $_GET['myID'];
$get  = mysqli_query($con, "SELECT * FROM staff_tb Where Emp_ID = '$myID'");
$row = mysqli_fetch_assoc($get);
$date = date('F j, Y');
$count = 1;
header("refresh: 3");
?>

<div id="monitor">
	<div class="datetime">
		<div class="col-md-4">
			<p class="info"><?php echo $row['Cashier']?></p>
		</div>

		<div class="col-md-4 text-center">
			<img src="../../assets/image/logo.jpg" width="70px">
		</div>

		<div class="col-md-4 text-right">
			<p id="clock"></p>
			<p id="date"><?php echo $date ?></p>
		</div>
	</div>

	<hr>
	<div class="col-md-12">
		<div class="col-md-8">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>#</th>
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
							<td scope="col"><?=$count++?></td>
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

<style>
#monitor{
	width: 100%;
	height: 100%;
	background: #d9d9d9;
}

#monitor .table{
		font-size: 14px;
		color: #333;
	}

#monitor .table td{
	vertical-align: middle;
}

.datetime{
	display: flex;
	justify-content: space-between;
	align-items: center;
	background: #666666;
	padding: 10px;
	color: #fff;

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


.datetime img{
	border-radius: 100%;
}

.datetime #clock{
	font-size: 24px;
	font-weight: 300;
}

.datetime #date{
	font-size: 16px;
	font-weight: 100;
}

.datetime .info{
	font-size: 30px;
	font-weight: 300;
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
<script>
function Time() {

 var date = new Date();

 var hour = date.getHours();

 var minute = date.getMinutes();

 var second = date.getSeconds();

 var period = "";

 if (hour >= 12) {
 period = "PM";
 } else {
 period = "AM";
 }

 if (hour == 0) {
 hour = 12;
 } else {
 if (hour > 12) {
 hour = hour - 12;
 }
 }

 hour = update(hour);
 minute = update(minute);
 second = update(second);

 document.getElementById("clock").innerText = hour + " : " + minute + " : " + second + " " + period;

 setTimeout(Time, 1000);
}

function update(t) {
 if (t < 10) {
 return "0" + t;
 }
 else {
 return t;
 }
}
Time();


</script>
