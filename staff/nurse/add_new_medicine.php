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
			Add New Medicine
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Medicine</a></li>
			<li><a href="#">Add New Medicine</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<p style="color: #666666; font-size: 16px; font-weight: 300;">*Medicine Info</p>
			<hr>

			<form action="" id="med-form">
				<div class="row">
					<div class="col-md-12">
						<label>Medicine Name:</label>
						<input type="text" name="med_name" id="med_name" class="form-control">

						<label>Milligrams:</label>
						<input type="text" name="med_mg" id="med_mg" class="form-control" placeholder="e.g 500mg">

						<label>Type of Medicine:</label>
						<select name="med_type" id="med_type" class="form-control">
							<option hidden selected>Please select here</option>
							<option value="Liquid">Liquid</option>
							<option value="Tablet">Table</option>
							<option value="Capsule">Capsule</option>
							<option value="Others">Others</option>
						</select>

						<label>Total:</label>
						<input type="number" name="total" id="total" class="form-control">

						<label>Expiration Date:</label>
						<input type="date" name="date" id="date" class="form-control form-group">
						<button type="button" id="med_save" class="btn btn-info form-control">Save</button>
					</div>
				</div>
			</form>
		</div>
		
	</section>
</div>
<?php include_once '../footer.php';  ?>
<script>
	$(document).ready(function(){
		$('#search').DataTable();

		$('#med_save').click(function(){
			start_load();
			var med_name = $('#med_name').val();
			var med_mg = $('#med_mg').val();
			var med_type = $('#med_type').val();
			var total = $('#total').val();
			var med_date = $('#date').val();

			if (med_name == "" || med_mg == "" || med_type == "" || total == "" || med_date == "") {
				alert("All fields required!");
				end_load();
			}else{
				$.ajax({
					url: "../../staff-model/add_medicine.php",
					method: "POST",
					data: $('#med-form').serialize(),
					success:function(data){
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
		                window.location.href='medicine.php';
		                }
		            })
		            end_load();
					}
				})
			}
		})
	})
</script>