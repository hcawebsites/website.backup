<?php 
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php'); 
include_once('../database/connection.php');
$count = 1;
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Academic Year
			<small>Prveview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">System Maintenance</a></li>
			<li><a href="#">Academic Year</a></li>
		</ol>
		<hr>
	</section>

	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-list"></i>&nbsp
					Academic List
				</h3>
			</div>

			<table class="table table-bordered table-striped" id="search">
				<thead>
					<tr>
						<th>#</th>
						<th>Year</th>
						<th>Semester</th>
						<th>System Default</th>
						<th>Evaluation Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getAcad = mysqli_query($con, "SELECT * FROM academic_list");
					while($rowAcad = mysqli_fetch_assoc($getAcad)){
					?>
					<tr style="vertical-align: middle;">
						<td><?=$count++?></td>
						<td><?=$rowAcad['School_Year']?></td>
						<td><?=$rowAcad['Semester']?></td>
						<td class="text-center">
							<?php
								if ($rowAcad['is_default'] == 1) {
									echo '<p class="btn btn-primary">Yes</p>';
								}else{
									echo '<p class="btn btn-danger">No</p>';
								}
							?>
						</td>
						<td class="text-center">
							<?php
								if ($rowAcad['Evaluation'] == 1) {
									echo '<p class="btn btn-success">Started</p>';
								}elseif ($rowAcad['Evaluation'] ==2) {
									echo '<p class="btn btn-info">Close</p>';
								}else{
									echo '<p class="btn btn-warning">Not yet started</p>';
								}
							?>
						</td>
						<td class="text-center">
							<button type="button" id="<?=$rowAcad['ID']?>" class="btn btn-primary edit"><i class="fa fa-pencil-square-o" style="font-size: 20px;"></i></button>

							<button type="button" id="<?=$rowAcad['ID']?>" class="btn btn-danger delete"><i class="fa fa-trash" style="font-size: 20px;"></i></button>
						</td>
					</tr>
					<?php }?>
					
				</tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="confirmation" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-question-circle"></i>&nbspConfirmation</h4>
      </div>
      <div class="modal-body">
      	<form action="" id="dltForm">
      		<input type="hidden" name="cid" id="cid">
      		<p>Are you sure you want to delete this academic?</p>
      	</form>
      </div>
      <div class="modal-footer">
        <button type="button" id="deleteAcad" class="btn btn-danger">Yes, Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title">Manage Academic</h4>
      </div>
      <div class="modal-body">
        <form action="#" id="form">
        	<div class="row">
        		<div class="col-md-12">
        			<label>Academic Year:</label>
        			<input type="text" name="year" id="year" class="form-control">
        			<input type="hidden" name="id" id="id">
        			<label>Semester:</label>
        			<input type="text" name="semester" id="semester" class="form-control"></input>
        			<label>Evaluation Status:</label>
        			<select name="status" id="status" class="form-control">
        				<option selected hidden>Please select here</option>
        				<option value="1">Start</option>
        				<option value="2">Stop</option>
        				<option value="0">Pending</option>
        			</select>
        		</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="save" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once 'footer.php'?>


<script>
	var timer1=0;
	$(document).ready(function(){
		$('#search').DataTable();

		$('.edit').click(function(){
			start_load();
			var aid = $(this).attr('id');
			$.ajax({
				url: "getAcad.php",
				method: "POST",
				data:{
					aid:aid
				},
				success:function(data){
					if(timer1 == 0){
						intervalID = setInterval(function(){
							data = $.parseJSON(data);
							$('#id').val(aid);
							$('#year').val(data.sy);
							$('#semester').val(data.sem);
							$('#edit').modal('show');
							end_load();
						}, 3000); // 1000 milliseconds = 1 second.
					}
				}
			})
		})

		$('#save').click(function(){
			let type = 'success';
		    let title = 'Data successfully saved.';
		    start_load();
		    createToast(type, title);	
			$.ajax({
				url: "../model/manage_academic.php",
				method: "POST",
				data: $('#form').serialize(),
				success:function(data){
					if(timer1 == 0){
						intervalID = setInterval(function(){
							location.reload();
							finish();
							end_load();
						}, 3000); // 1000 milliseconds = 1 second.
					}
				}
			})
		})

		$('.delete').click(function(){
			start_load();
			var id = $(this).attr('id');
			if (timer1 == 0) {
				intervalID = setInterval(function(){
					$('#cid').val(id);
					$('#confirmation').modal('show');
					end_load();
				}, 3000);
			}
		})

		$('#deleteAcad').click(function(){
			let type = 'error';
		    let title = 'Data successfully deleted.';
		    start_load();
		    createToast(type, title);	
			$.ajax({
				url: "../model/dltacademic.php",
				method: "POST",
				data: $('#dltForm').serialize(),
				success:function(data){
					if (timer1 == 0) {
						intervalID = setInterval(function(){
							location.reload();
							finish();
							end_load();
						}, 3000);
					}
				}
			})	
		});

			
})
</script>