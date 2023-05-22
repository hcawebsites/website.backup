<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../database/connection.php';
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Add Student Records
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Guidance</a></li>
			<li><a href="#">Add Student Record</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<i class="fa fa-asterisk"></i>
			<span style="color: #666666; font-size: 14px; font-weight: 400;">Student Information</span>
			<hr>

			<form action="" id="guidance-form">
				<div class="row" style="color: #666666; font-size: 12px;">
					<div class="col-md-12 form-group">
						<label>Student ID:</label>
						<input type="text" name="std_id" id="std_id" class="form-control">

						<label>Student Name:</label>
						<input type="text" name="name" id="name" class="form-control">

						<label>Violation:</label>
						<textarea name="violation" id="violation" cols="30" rows="3" class="form-control"></textarea>

						<label>Offense:</label>
						<textarea name="offense" id="offense" cols="30" rows="3" class="form-control" placeholder="e.g 1st-3rd offense"></textarea>

						<label>Punishment:</label>
						<textarea name="punishment" id="punishment" cols="30" rows="3" class="form-control"></textarea>
					</div>
					<div class="col-md-12">
						<button type="button" id="save" class="form-control btn btn-info">Save</button>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#save').click(function(){
			start_load();
			var std_id = $('#std_id').val();
			var name = $('#name').val();
			var violation = $('#violation').val();
			var offense = $('#offense').val();
			var punishment = $('#punishment').val();

			if (std_id == "" || name == "" || violation == "" || offense == "" || punishment == "") {
			    Swal.fire(
			      'All Fields Required!',
			      '',
			      'info'
		    	)
		    	end_load();
			}else{
				$.ajax({
					url: "../model/add_student_record.php",
					method: "POST",
					data: $('#guidance-form').serialize(),
					success:function(data){
					    if(data == "success"){
                           const swalWithBootstrapButtons = Swal.mixin({
            				  customClass: {
            				    confirmButton: 'btn btn-success',
            				  },
            				  buttonsStyling: false
            				})
            
            				swalWithBootstrapButtons.fire({
            				  title: 'Data Successfully Saved!',
            				  text: "",
            				  icon: 'success',
            				  showCancelButton: false,
            				  confirmButtonText: 'Close',
            				}).then((result) => {
            				  if (result.isConfirmed) {
            				  	window.location.href="guidance.php"
            				    }
            				})
            				end_load();
                   }
					}
				})
			}
		})
	})
</script>