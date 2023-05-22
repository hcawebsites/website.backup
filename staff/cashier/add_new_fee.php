<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Add New Fees
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Add New Fees</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="table-master" style="color: #666666; font-size: 14px; font-weight: 500">
			<h4>*Fees Details</h4>
			<hr>
			<form action="" id="fee-form">
				<div class="row">
					<div class="col-md-12">
						<label>Description:</label>
						<input type="text" name="description" id="description" class="form-control">
					</div>

					<div class="col-md-12">
						<label>Amount:</label>
						<input type="number" name="amount" id="amount" class="form-control">
					</div>

					<div class="col-md-12 form-group">
						<label>Select Grade:</label>
						<select name="grade" id="grade" class="form-control">
							<option selected hidden>Please select here</option>
							<option value="All">All</option>
							<?php  
								$get = mysqli_query($con, "SELECT * FROM grade Order by ID asc");
								while ($row = mysqli_fetch_assoc($get)) {
							?>
								<option value="<?php echo $row['ID'] ?>"><?php echo $row['Name']  ?></option>
							<?php }?>

							
						</select>
					</div>

					<div class="col-md-12">
						<button type="button" id="save_fee" class="btn btn-success form-control">Save</button>
					</div>


				</div>
			</form>
		</div>
	</section>
</div>
<?php include_once '../footer.php' ?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#save_fee').click(function(){
			start_load();
			$.ajax({
				url: "../../staff-model/add-fee.php",
				method: "POST",
				data: $('#fee-form').serialize(),
				success:function(data){
					alert("Data successfully saved!");
					end_load();
				}
			})
		})
	})
</script>