<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			System Settings
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">System Maintenance</a></li>
			<li><a href="#">System Settings</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="col-md-6">
			<div class="table-master" style="color: #666666;">
				<div class="table-title">
					<h3 style="font-size:18px; font-weight: 300">
						<i class="fa fa-picture-o"></i>
						Picture
					</h3>

					<div class="row form-inline search">
						<button type="button" data-toggle="modal" data-target="#addpicture" class="btn btn-primary form-control"><i class="fa fa-plus"></i>&nbspAdd Picture</button>
					</div>
				</div>

				<table id="search" class="table table-striped" style="font-size: 12px; color: #666666; font-weight: 500;">
					<thead>
						<tr>
							<td>#</td>
							<td>Picture</td>
							<td>Status</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php  
							$count = 1;
							$get = mysqli_query($con, "SELECT * FROM sys_image Order by ID ASC");
							while($row = mysqli_fetch_assoc($get)){
						?>
						<tr>
							<td style="vertical-align: middle;"><?=$count++?></td>
							<td style="vertical-align: middle;">
								<img src="../image/<?=$row['Image'] ?>" width="50">
							</td>

							<td style="vertical-align: middle;" class="text-center">
								<?php
									if ($row['Status'] == 1) {
										echo '<button id='.$row['ID'].' class="btn btn-success displayed form-control">Displayed</button>';
									}else{
										echo '<button id='.$row['ID'].' class="btn btn-info form-control display">Display</button>';
									}
								?>
							</td>
							<td style="vertical-align: middle;" class="text-center"><button type="button" id="<?=$row['ID']?>" class="btn btn-danger form-control delete_img">Delete</button></td>
						</tr>
						<?php }?>
						
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-md-6">
			<div class="table-master" style="color: #666666;">
				<div class="table-title">
					<h3 style="font-size:18px; font-weight: 300">
						<i class="fa fa-play"></i>
						Video
					</h3>

					<div class="row form-inline search">
						<button type="button" data-toggle="modal" data-target="#addvideo" class="btn btn-warning form-control"><i class="fa fa-plus"></i>&nbspAdd Video</button>
					</div>
				</div>

				<table id="search1" class="table table-striped" style="font-size: 12px; color: #666666; font-weight: 500;">
					<thead>
						<tr>
							<td>#</td>
							<td>Video</td>
							<td>Status</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php  
							$count = 1;
							$get = mysqli_query($con, "SELECT * FROM sys_video Order by ID ASC");
							while($row = mysqli_fetch_assoc($get)){
						?>
						<tr>
							<td style="vertical-align: middle;"><?=$count++?></td>
							<td style="vertical-align: middle;">
								<video height="50"
									 source src="../video/<?=$row['Video']?>" controls loop="true" autoplay="true" muted>
								</video>
							</td>

							<td style="vertical-align: middle;" class="text-center">
								<?php
									if ($row['Status'] == 1) {
										echo '<button class="btn btn-success form-control">Default</button>';
									}else{
										echo '<button id='.$row['ID'].' class="btn btn-info form-control play">Play</button>';
									}
								?>
							</td>
							<td style="vertical-align: middle;" class="text-center"><button type="button" id="<?=$row['ID']?>" class="btn btn-danger form-control delete">Delete</button></td>
						</tr>
						<?php }?>
						
					</tbody>
				</table>
			</div>
		</div>

	</section>
</div>

<!--Add Video Modal-->
<div class="modal fade" id="addvideo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>&nbspAdd Video</h4>
      </div>
      <div class="modal-body">
        <form action="../model/save_video.php" method="POST" enctype="multipart/form-data">
        	<label>Video:</label>
        	<input type="file" name="video" id="video" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Add picture Modal-->
<div class="modal fade" id="addpicture" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>&nbspAdd Image</h4>
      </div>
      <div class="modal-body">
        <form action="../model/save_picture.php" method="POST" enctype="multipart/form-data">
        	<img id="output" class="rounded-corncers" style="width:150px; height:150px;" />
        	<input type="file" accept="image/*" name="my_image" class="form-control" onchange="loadFile(event)" style="margin-top:7px;"  />
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Add Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-trash"></i>&nbspDelete Video</h4>
      </div>
      <div class="modal-body">
        <form action="" id="delete-form">
        	<input type="hidden" name="id" id="id" class="form-control">
        </form>

        <p>Are you sure you want to delete this video?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" id="delete" class="btn btn-danger">Yes, Delete</button>
      </div>
      
    </div>
  </div>
</div>

<!--Add Delete Modal-->
<div class="modal fade" id="deleteImg" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-trash"></i>&nbspDelete Video</h4>
      </div>
      <div class="modal-body">
        <form action="" id="delete_form_img">
        	<input type="hidden" name="id" id="id1" class="form-control">
        </form>

        <p>Are you sure you want to delete this video?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" id="delete_save_img" class="btn btn-danger">Yes, Delete</button>
      </div>
      
    </div>
  </div>
</div>
<?php include_once 'footer.php'?>
<script type="text/javascript">
	var loadFile = function(img) {
		var image = document.getElementById('output');
		image.src = URL.createObjectURL(event.target.files[0]);
	};
	$(document).ready(function(){
		$('#search').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": false,
	      "info": false,
		  "pageLength": 5,
	      "autoWidth": false
	    });
		$('#search1').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": false,
	      "info": false,
		  "pageLength": 5,
	      "autoWidth": false
	    });

	    $('#save-video').click(function(){
	    	start_load();
	    	$.ajax({
	    		url: "../model/save_video.php",
	    		method: "POST",
	    		data: $('#video-form').serialize(),
	    		success:function(data){
	    			alert(data);
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })

	    $('.play').click(function(){
	    	var id = $(this).attr('id');
	    	start_load();
	    	$.ajax({
	    		url: "play_video.php",
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
				  title: 'Data Saved Succssfully',
				  text: "",
				  icon: 'success',
				  showCancelButton: false,
				  confirmButtonText: 'Close',
				}).then((result) => {
				  if (result.isConfirmed) {
				  	window.location.href = 'system-setting.php';
				    }
				})
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })

	    $('.displayed').click(function(){
	    	var id = $(this).attr('id');
	    	start_load();
	    	$.ajax({
	    		url: "cover_image.php",
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
					  title: 'Data Saved Succssfully',
					  text: "",
					  icon: 'success',
					  showCancelButton: false,
					  confirmButtonText: 'Close',
					}).then((result) => {
					  if (result.isConfirmed) {
					  	window.location.href = 'system-setting.php';
					    }
					})
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })

	    $('.display').click(function(){
	    	var id = $(this).attr('id');
	    	start_load();
	    	$.ajax({
	    		url: "display_image.php",
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
						  title: 'Data Saved Succssfully',
						  text: "",
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Close',
						}).then((result) => {
						  if (result.isConfirmed) {
						  	window.location.href = 'system-setting.php';
						    }
						})
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })


	    $('.delete').click(function(){
	    	var id = $(this).attr('id');
	    	$('#deleteModal').modal('show');
	    	$('#id').val(id);
	    })

	    $('.delete_img').click(function(){
	    	var id = $(this).attr('id');
	    	$('#deleteImg').modal('show');
	    	$('#id1').val(id);
	    })

	    $('#delete').click(function(){
	    	start_load();
	    	$.ajax({
	    		url: "delete_video.php",
	    		method: "POST",
	    		data:$('#delete-form').serialize(),
	    		success:function(data){
	    			const swalWithBootstrapButtons = Swal.mixin({
						  customClass: {
						    confirmButton: 'btn btn-danger',
						  },
						  buttonsStyling: false
						})

						swalWithBootstrapButtons.fire({
						  title: 'Data Saved Succssfully',
						  text: "",
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Close',
						}).then((result) => {
						  if (result.isConfirmed) {
						  	window.location.href = 'system-setting.php';
						    }
						})
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })

	    $('#delete_save_img').click(function(){
	    	start_load();
	    	$.ajax({
	    		url: "delete_image.php",
	    		method: "POST",
	    		data:$('#delete_form_img').serialize(),
	    		success:function(data){
	    			const swalWithBootstrapButtons = Swal.mixin({
						  customClass: {
						    confirmButton: 'btn btn-success',
						  },
						  buttonsStyling: false
						})

						swalWithBootstrapButtons.fire({
						  title: 'Data Saved Succssfully',
						  text: "",
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Close',
						}).then((result) => {
						  if (result.isConfirmed) {
						  	window.location.href = 'system-setting.php';
						    }
						})
	    		},
	    		complete:function(){
	    			end_load();
	    		}
	    	})
	    })
	})
</script>