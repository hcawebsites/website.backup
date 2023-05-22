<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../../database/connection.php';
$myID = $_SESSION['staff_id'];
$count = 1;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Guidance Records
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Guidance Records</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-bars" aria-hidden="true"></i>
					Student Lists
				</h3>

				<div class="row form-inline">
            <div class="search">
                <form action="../../reports/guidance_report.php" method="POST">
                  <input type="hidden" name="staff_id" value="<?php echo $myID  ?>">
                	<button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>

                	<button type="submit" name="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
                </form>
                
            </div>
        </div>
			</div>

			<table class="table table-bordered table-striped" style="color: #666666; font-size: 12px; font-weight: 500;" id="search">
				<thead>
	                <tr>
	                    <th scope="col">#</th>
	                    <th scope="col">Name</th>
	                    <th scope="col">Violation</th>
	                    <th scope="col">Offense</th>
	                    <th scope="col">Punishment</th>
	                    <th scope="col">Status</th>
	                    <th scope="col">Date</th>
	                    <th scope="col">Action</th>
	                </tr>
                </thead>
                <tbody>
                	<?php  
                		$get = mysqli_query($con, "SELECT * from guidance Order by ID ASC");
                		while ($row = mysqli_fetch_assoc($get)) {
                		$date = date('F j, Y', strtotime($row['Date']));
                	?>
                		<tr>
                			<td style = "vertical-align: middle;"><?=$count++?></td>
                			<td style = "vertical-align: middle;"><?=$row['Name']?></td>
                			<td style = "vertical-align: middle;"><?=$row['Violation']?></td>
                			<td style = "vertical-align: middle;"><?=$row['Offense']?></td>
                			<td style = "vertical-align: middle;"><?=$row['Punishment']?></td>
                			<td style = "vertical-align: middle;" class="text-center">
                				<?php
									if ($row['Status'] == 1) {
										echo '<p class="pending">Not Resolve</p>';
									}else{
										echo '<p class="settled">Resolved</p>';
									}
								?>	
                			</td>
                			<td style = "vertical-align: middle;"><?=$date?></td>
                			<td style = "vertical-align: middle;" class="text-center">
                				<button class="btn btn-primary form-control edit" id="<?php echo $row['ID'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                				<div class="col-md-12"></div>
                				<button class="btn btn-danger form-control btnDelete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                				<div class="col-md-12"></div>
                				<button class="btn btn-success form-control resolve" id="<?php echo $row['ID'];?>"><i class="fa fa-check" aria-hidden="true"></i></button>
                			</td>
                		</tr>
                	<?php }?>
                </tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true">&nbspAdd Student Record</i></h3>
        
        
      </div>
      <div class="modal-body">
      <form action="../../staff-model/edit_student_guidance_record.php" method="post">
              <div class="row">
                <input type="hidden" name="id1" id="editID" class="form-control">
                <div class="col-md-6">
                    <label for="">Student ID:</label>
                    <input type="text" name="id" id="studentID" class="form-control">
                </div>

                <div class="col-md-6 ">
                    <label for="">Name:</label>
                    <input type="text" name="name" id="fname" class="form-control">
                </div>
                
                <div class="col-md-12">
                    <label for="">Violation:</label>
                    <input type="text" name="violation" id="vviolation" class="form-control">
                </div>

                <div class="col-md-12">
                    <label for=""># Offense:</label>
                    <input type="text" name="offense" id="ooffense" placeholder="e.g 1st-3rd Offense" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="">Punishment:</label>
                    <input type="text" name="punishment" id="ppunishment" class="form-control">
                </div>
              </div>
      </div>
        <div class="modal-footer">
            <input type="submit" name="saveEdit" class="btn btn-primary" value="Save"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-trash" aria-hidden="true">&nbspDelete Confirmation</i></h3>

      </div>
      <div class="modal-body">
      <form action="../../staff-model/delete_student_guidance_record.php" method="post">
                <input type="hidden" name="deleteID" id="deleteID" class="form-control">
                <p>Are you sure you want to <b>DELETE</b> this Record?</p>  
      </div>
        <div class="modal-footer">
            <input type="submit" name="btnDelete" class="btn btn-danger" value="Delete"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php include_once '../footer.php';  ?>
<script>
	$(document).ready(function(){
		$('#search').DataTable();

		$('.edit').click(function(){  
           var id = $(this).attr("id")
           $.ajax({  
                url:"view_guidance_record.php",  
                method:"POST",  
                data:{
					id:id 
				},
                success:function(data){
					data = $.parseJSON(data);
                    $('#editID').val(data.id);
           			$('#studentID').val(data.student_id);
                    $('#fname').val(data.name);
                    $('#vviolation').val(data.violation);
                    $('#ooffense').val(data.offense);
                    $('#ppunishment').val(data.punishment);
                     $('#editModal').modal("show");  
                }  
           });  
      });  

	$('.btnDelete').on('click', function() {
        
        $('#deleteModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#deleteID').val(data[0]);
      });

  $('.resolve').click(function(){
    start_load();
      var id = $(this).attr('id');
      $.ajax({
        url: "../../staff-model/resolved.php",
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
	})
</script>

<style>
	.settled{
	background-color: #3bf511;
	width: 100px;
	color: #fff;
	font-weight: 500;
	}

	.pending{
		background-color: #ed6673;
		width: 100px;
		color: #fff;
		font-weight: 500;
	}
</style>