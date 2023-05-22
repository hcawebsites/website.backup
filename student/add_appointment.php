<?php  
include_once 'main_head.php';
include_once 'std_header.php';
include_once 'std_sidebar.php';
$myID = $_SESSION['student_id'];
$get = mysqli_query($con, "SELECT concat(Firstname, ' ' , ' ', Middlename, ' ', Lastname) as name FROM student Where Student_ID = '$myID'");
$row = mysqli_fetch_assoc($get);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			New Appointment
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Counseling</a></li>
			<li><a href="#">New Appointment</a></li>
		</ol>

		<hr>
	</section>
	<section class="content">
		<div class="table">
			<div class="header-title">
				<i class="fa fa-graduation-cap"></i>
				<span>Student Information</span>
			</div>
			<hr>

			<div class="form-content">
				<form action="" id="appointment-form">
					<div class="row">
						<div class="col-md-12">
							<p>Student ID:</p>
							<input type="text" name="std-id" id="std-id" value="<?php echo $myID  ?>" class="form-control form-group" readonly>

							<p>Student Name:</p>
							<input type="text" name="std-name" id="std-name" value="<?php echo $row['name']  ?>" class="form-control form-group" readonly>

							<p>Reasons:</p>
							<textarea name="reason" id="reason" cols="30" rows="3" class="form-control form-group"></textarea>

							<p>Name of the Bully:</p>
							<input type="text" name="bully_name" id="bully_name" placeholder="If the reasons is bullying" class="form-control form-group">

							<p>State Reasons/Concern:</p>
							<textarea name="concern" id="concern" cols="30" rows="3" class="form-control form-group"></textarea>
						</div>

						<div class="col-md-6">
							<p>Date:</p>
							<input type="date" name="date" id="date" class="form-control form-group">
						</div>

						<div class="col-md-6">
							<p>Time:</p>
							<input type="time" name="time" id="time" class="form-control form-group">
						</div>

						<div class="col-md-12">
							<button type="button" id="save-appointment" class="btn btn-info form-control form-group">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<?php include_once 'footer.php'?>


<script type="text/javascript">
$(document).ready(function(){
	$('#save-appointment').click(function(){
		start_load();
		var reason = $('#reason').val(); 
		var concern = $('#concern').val();
		var date = $('#date').val();
		var time = $('#time').val();

		if (reason == "" || concern == "" || date == "" || time == ""){
			let type = 'error';
		    let title = 'All fileds required.';
		    createToast(type, title);
			end_load();
		}else{
			$.ajax({
				url: "../std-model/appointment_request.php",
				method: "POST", 
				data: $('#appointment-form').serialize(),
				success:function(data){
					let type = 'success';
				    let title = 'Data successfully saved.';
				    createToast(type, title);
				},
				complete:function(){
					end_load();
					window.location.href = 'counseling.php';
				}
			})

		}

	})
})

</script>

<style type="text/css">
	.header-title{
		color: #666666;
		font-size: 16px;
		font-weight: 300;
	}

	.form-content{
		color: #666666;
		font-size: 16px;
		font-weight: 300;
	}
</style>
