<?php 
include_once '../database/connection.php';
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$count = 1;
$myID = $_SESSION['admin_id'];
$get = mysqli_query($con, "SELECT * FROM str_staff_attendance");
$row = mysqli_fetch_assoc($get);
$id = $row['ID'];
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Staff Attendance
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">&nbspSystem Maintenance</a></li>
			<li><a href="#">&nbspAttendance</a></li>
		</ol>
	</section>
	<hr>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-certificate" aria-hidden="true"></i>
					Staff Attendance
				</h3>
				<div class="search">
					<form action="../reports/staff_attendance_report.php" method="POST">
						<div class="row form-inline">
								<input type="hidden" name="myID" id="myID" value="<?=$myID?>" class="form-control">
								<label style="color: red; font-size:14px; font-weight: 300;">Filter Attendance:</label>
								<input type="date" name="filter_date" id="filter_date" class="form-control">

								<button type="button" id="<?=$id?>" name="stop" class="btn btn-info form-control start"><i class="fa fa-star"></i>&nbspStart</button>

								<button type="button" id="<?=$id?>" name="stop" class="btn btn-warning form-control stop"><i class="fa fa-stop-circle"></i>&nbspStop</button>
							
								<button type="submit" id="print" name="print" class="btn btn-danger form-control"><i class="fa fa-print"></i>&nbspPrint</button>
							

								<button type="submit" id="excel" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
							
						</div>
					</form>
				</div>
			</div>
			<table class="table table-bordered table-striped" id="search" style="color: #5c5c5c; font-size: 13px; font-weight: 400">
				<thead>
					<tr>
						<th>#</th>
						<th>ID</th>
						<th>Name</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Status</th>
						<th>Date</th>
						<th>Access</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="data">
                    <?php  
                        $get = mysqli_query($con, "SELECT * FROM emp_attendance");
                        while ($row = mysqli_fetch_assoc($get)) {
                        ?>
                        <tr>
                            <td scope="col" style="vertical-align: middle;"><?=$count++?></td>
                            <td scope="col" style="vertical-align: middle;"><?=$row['Emp_ID']?></td>
                            <td scope="col" style="vertical-align: middle;"><?=$row['Name']?></td>
                            <td scope="col"><?=date('h:i A', strtotime($row['Time_In']))?></td>
                            <td scope="col"><?=date('h:i A', strtotime($row['Time_Out']))?></td>
                            <td scope="col" class="text-center" style="vertical-align: middle;">
                            	<?php
                            	if ($row['Status'] == 1) {
                            		echo '<p style="background-color: #74fa5f">On Time</p>';
                            	}else if($row['Status'] == 2){
                            		echo '<p style="background-color: #b2c40e; color: #fff;">Late</p>';
                            	}else{
                            		echo '<p style="background-color: #fa5f5f; color: #fff;">Absent</p>';
                            	}
                            	?>
                            </td>
                            <td scope="col" style="vertical-align: middle;"><?=date('F j, Y', strtotime($row['Date']))?></td>
                            <td scope="col" style="vertical-align: middle;"><?=$row['Access']?></td>
                            <td style="vertical-align: middle; text-align: center;">
                            	<button class="form-control btn btn-primary data" id="<?=$row['Emp_ID']?>"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
			</table>
		</div>
	</section>
</div>
<div class="modal fade" id="editAttendance" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-edit"></i>&nbspEdit Attendance</h3>
      </div>
      <div class="modal-body">
        <form action="../model/edit_attendance.php" method="POST" id="form">
            <div class="row">
                <input type="hidden" name="id" id="id" class="form-control">
                <input type="hidden" name="access" id="access" class="form-control">
                <div class ="form-group text-center col-md-12">
                    <img id="output" class="img-rounded" src="" style="width:150px; height:150px;" />
                </div>

                <div class="col-md-4 form-group">
                    <label for="">Salutation:</label>
                    <input type="text" name="salutation" id="salutation" class="form-control" readonly>
                </div>

                <div class="col-md-4 form-group">
                    <label for="">Lastname:</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" readonly>
                </div>

                <div class="col-md-4 form-group">
                    <label for="">Firstname:</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Time In:</label>
                    <input type="text" name="in" id="in" class="form-control">
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Time Out:</label>
                    <input type="text" name="out" id="out" class="form-control">
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Log Date:</label>
                    <input type="text" name="date" id="date" class="form-control" readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label for="">Status:</label>
                    <input type="text" name="status" id="status" class="form-control">
                    <small>0 - Absent | 1 - On Time | 2 - Late</small>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" name="save" class="btn btn-primary save">Save changes</button>
      </div>
      
    </div>
  </div>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#filter_date').change(function(){
			var date = $(this).val();
			$.ajax({
				url: "filter_attendance.php",
				method: "POST",
				data:{
					date:date
				},
				success:function(data){
					$('#data').html(data);
				}
			})
		})
		$('.save').click(function(){
			$.ajax({
				url: "../model/edit_attendance.php",
				method: "POST",
				data: $('#form').serialize(),
				success:function(data){
					if (data == "success") {
						const swalWithBootstrapButtons = Swal.mixin({
						  customClass: {
						    confirmButton: 'btn btn-success',
						  },
						  buttonsStyling: false
						})

						swalWithBootstrapButtons.fire({
						  title: 'Data successfully saved!',
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
				}
			})
		})
		$('.data').click(function(){  
           var id = $(this).attr("id")
           $.ajax({  
                url:"view_attendance.php",  
                method:"POST",  
                data:{
					id:id 
				},
	   	        success: function(data) {
                   data = JSON.parse(data);
                   $('#editAttendance').modal("show");
                   $('.form-group img').attr("src", "../assets/upload/" + (data.image));
                   $('#salutation').val(data.salutation);
                   $('#lastname').val(data.lastname);
                   $('#firstname').val(data.firstname);
                   $('#in').val(data.time_in);
                   $('#out').val(data.time_out);
                   $('#date').val(data.date);
                   $('#status').val(data.status);
                   $('#id').val(id);
                   $('#access').val(data.access);
	            }
           });  
      	}); 

		$('#search').DataTable();

		$('.start').click(function(){
			start_load()
			var id = $(this).attr("id");
			$.ajax({
				url: "../model/start-attendance.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					if (data == "success") {
						const swalWithBootstrapButtons = Swal.mixin({
						  customClass: {
						    confirmButton: 'btn btn-success',
						  },
						  buttonsStyling: false
						})

						swalWithBootstrapButtons.fire({
						  title: 'Attendance Successfully Started!',
						  text: "",
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Close',
						}).then((result) => {
						  if (result.isConfirmed) {
						  	location.reload();
						    }
						})
						end_load();
					}else{
						Swal.fire(
					      data,
					      '',
					      'error'
				    	)
				    	end_load();
					}
					
				}
			})
		})

		$('.stop').click(function(){
			start_load()
			var id = $(this).attr("id");
			$.ajax({
				url: "../model/stop-attendance.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					if (data == "success") {
						const swalWithBootstrapButtons = Swal.mixin({
						  customClass: {
						    confirmButton: 'btn btn-success',
						  },
						  buttonsStyling: false
						})

						swalWithBootstrapButtons.fire({
						  title: 'Attendance Successfully Stoped!',
						  text: "",
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Close',
						}).then((result) => {
						  if (result.isConfirmed) {
						  	location.reload();
						    }
						})
						end_load();
					}else{
						Swal.fire(
					      data,
					      '',
					      'error'
				    	)
				    	end_load();
					}
				}
			})
		})
	})
</script>

