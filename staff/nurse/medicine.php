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
			Medicine
			<small>Preview</small>
		</h1>

		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Medicine</a></li>
			<li><a href="#">Medicine Lists</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-list-alt"></i>
					List of Medicines
				</h3>
				<div class="search">
					<form action="../../reports/medicine_reports.php" method="POST">
						<div class="row form-inline">
							<input type="hidden" name="staff_id" value="<?php echo $myID  ?>">
							<button type="submit" name="print" class="btn btn-danger form-control"><i class="fa fa-print"></i>&nbspPrint</button>
							<button type="submit" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
						</div>
					</form>
				</div>
			</div>

			<table class="table table-striped table-bordered" id="search" style="color: #666666; font-size: 12px; font-weight: 500;">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Milligrams</th>
						<th scope="col">Type</th>
						<th scope="col">Total</th>
						<th scope="col">Date Created</th>
						<th scope="col">Date Expired</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$get = mysqli_query($con, "SELECT * from medicine order by ID ASC");
						while ($row = mysqli_fetch_assoc($get)) {
							$date_created = date('F j, Y', strtotime($row['Date_Created']));
							$date_expired = date('F j, Y', strtotime($row['Date_Expiration']));
							?>
							<tr>
								<td style="vertical-align: middle;"><?=$count++?></td>
								<td style="vertical-align: middle;"><?=$row['Name']?></td>
								<td style="vertical-align: middle;"><?=$row['Mg']?></td>
								<td style="vertical-align: middle;"><?=$row['Type']?></td>
								<td style="vertical-align: middle;"><?=$row['Total']?></td>
								<td style="vertical-align: middle;"><?=$date_created?></td>
								<td style="vertical-align: middle;"><?=$date_expired?></td>
								<td style="vertical-align: middle;" class="text-center">
									<button type="button" class="btn btn-primary edit" id="<?=$row['ID']?>"><i class="fa fa-pencil-square-o"></i>&nbspEdit</button>
									<button type="button" class="btn btn-danger delete" id="<?=$row['ID']?>"><i class="fa fa-trash"></i>&nbspDelete</button>
								</td>

							</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="manage-med" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title">
        	<i class="fa fa-pencil-square-o"></i>
        	Manage Medicine
        </h4>
      </div>
      <div class="modal-body">
        <form action="" id="ed-medicine">
        		<label>Name:</label>
        		<input type="hidden" name="id" id="id" class="form-control">
        		<input type="text" name="name" id="name" class="form-control">

        		<label>Milligrams:</label>
        		<input type="text" name="mg" id="mg" class="form-control">

        		<label>Type:</label>
        		<input type="text" name="type" id="type" class="form-control" readonly>

        		<label>Available:</label>
        		<input type="text" name="total" id="total" class="form-control">

        		<label>Date Created:</label>
        		<input type="text" id="date" class="form-control" readonly>

        		<label>Expiration Date:</label>
        		<input type="text" id="expire" class="form-control" readonly>
        	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once '../footer.php';  ?>
<script>
	$(document).ready(function(){
		$('#search').DataTable();

		$('.delete').click(function(){
			start_load();
			var id = $(this).attr('id');
			$.ajax({
				url: "../../staff-model/delete-medicine.php",
				method: "POST",
				data:{
					id:id
				},
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
                location.reload();
                }
            })
            end_load();
				}
			})
		})

		$('.edit').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "edit_medicine.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					data = JSON.parse(data);
					$('#id').val(id);
					$('#name').val(data.name);
					$('#mg').val(data.mg);
					$("#type").val(data.type);
					$('#total').val(data.total);
					$('#date').val(data.date);
					$('#expire').val(data.expire)

					$('#manage-med').modal('show');
				}
			})
		})

		$('#save').click(function(){
			start_load()
			$.ajax({
				url: "../../staff-model/edit_medicine.php",
				method: "POST",
				data: $('#ed-medicine').serialize(),
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
                location.reload();
                }
            })
            end_load();
				}
			})
		})
	})
</script>