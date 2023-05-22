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
			Add Student Medicine
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Medicine</a></li>
			<li><a href="#">Add Student Medicine</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<p style="color: #666666; font-size: 16px; font-weight: 300;">*Student Info</p>
			<hr>

			<form action="" id="med-form">
				<div class="row">
					<div class="col-md-12 form-group">
						<label>Student ID:</label>
						<input type="text" name="std_id" id="std_id" class="form-control">
						<label>Illness:</label>
						<input type="text" name="illness" id="illness" class="form-control">

						<label>Medicine:</label>
						<select name="medicine" id="medicine" class="form-control">
							<option hidden selected>Please select here</option>
							<?php  
								$get = mysqli_query($con, "SELECT * FROM medicine Order by ID ASC");
								while ($row = mysqli_fetch_assoc($get)) {
								?>	

								<option value="<?=$row['ID']?>"><?=$row['Name']. ' - ' . $row['Type'] . ' - ' .$row['Mg']?></option>
							<?php }?>
							?>
						</select>

						<label>Total</label>
						<input type="number" name="total" id="total" class="form-control">
					</div>

					<div class="col-md-12">
						<button type="button" class="btn btn-success form-control" id="save">Save</button>
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

		$('#save').click(function(){
			start_load();

			var std_id = $('#std_id').val();
			var illness = $('#illness').val();
			var medicine = $('#medicine').val();
			var total = $('#total').val();

			if (std_id == "" || illness == "" || medicine == "" || total == "") {
				Swal.fire(
	              'All Fields Required!',
	              '',
	              'info'
	            )
				end_load();
			}else{
				$.ajax({
					url: "../../staff-model/add_clinic_record.php",
					method: "POST",
					data: $('#med-form').serialize(),
					success: function(data){
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
	                        window.location.href = 'student_record.php';
	                        }
	                    })
	                    end_load();
					}
				})
			}

		})
	})
</script>