<?php include_once('main_head.php');?>
<?php ob_start();?>
<?php include_once('../model/deleteDenied.php')?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
  <title>Denied List</title>
	
    <section class="content-header">
    	<h1>
        	Denied Application
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i> Enrollment Request</a></li>
            <li><a href="#">Denied Application</a></li>
    	</ol>
	</section>
	<hr>
	<hr>

			<?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center" style="margin-right: 20px; 
                margin-left: 20px;"><button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4><?php echo $_GET['error']; ?></h4>
                </div>
            <?php endif ?>

            <?php if(isset($_GET['info'])): ?>
                <div class="alert alert-success text-center" style="margin-right: 20px; 
                margin-left: 20px;"><button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4><?php echo $_GET['info']; ?></h4>
                </div>
            <?php endif?>

	<section class="content">
		
		<div class="content-title" style="margin-top: 20px; border: 1px solid #C1C1C1; padding: 0 12px; background-color: #EBEBEB; border-top-left-radius: 10px; border-top-right-radius: 10px;">
			<h4><i class="fa fa-file-o"><b> Denied Applications List</b></i></h4>
		</div>

		<div class="content-body" style="padding: 12px 12px 0;border: 1px solid #C1C1C1; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">

			<table class="table table-striped" id="Denied" style="margin-top: 120px;">
      			<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Name</th>
						<th scope="col">Status</th>
						<th scope="col">Reason</th>
						<th scope="col">Approve Date</th>
						<th scope="col">Denied Date</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<?php 
				$sql = "SELECT * FROM denied_tb ";
				$result = mysqli_query($con, $sql);
				?>
				<tbody class="table-hover" id="detailTable">
					<?php
					while ($row = mysqli_fetch_assoc($result)) {
						$date1 = $row['Application_Date'];
						$newdate1 = strtotime($date1);

						$date2 = $row['Rejected_Date'];
						$newdate2 = strtotime($date2);
					?>

					<tr class="table-active" style="text-align: center;">
						<td style = "vertical-align: middle;"><?php echo $row['ID'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Firstname'], " ", $row['Lastname'];?></td>
						<td style = "vertical-align: middle;"><p class="btn-danger"><?php echo $row['Enrollment_Status'];?></p></td>
						<td style = "vertical-align: middle;"><?php echo $row['Reason'];?></td>
						<td style = "vertical-align: middle;"><?php echo date('M d Y', $newdate1)?></td>
						<td style = "vertical-align: middle;"><?php echo date('M d Y', $newdate2);?></td>
						<td style = "vertical-align: middle;">
							<button class="form-control btn-success view_paylist" name="view" id="<?php echo $row['Student_ID'];?>"><i class="fa fa-eye"></i></button>
							<button class="form-control btn-danger" id="deletebtn"><i class="fa fa-trash"></i></button>
						</td>
					</tr>



				<?php }?>
				</tbody>




			</table>
		</div>

		



	</section>


</div>
<?php 
include_once 'footer.php';

?>
<!--View Modal-->

<div class="modal fade" id="modalview" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true"><i class="glyphicon glyphicon-remove"></i></span></button>
		<h4>Pay List Information</h4>
        
      </div>

    <form action="" method="POST">
        <div class="modal-body">
          <div class = "row">
          	<div class="col-md-12">
          	<table class="table table-striped">
          		<tbody class="table-hover">
          			<tr class="table-active">
          				<td>Student ID:</td>
          				<td><input type="text" id="student_id" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>First Name:</td>
          				<td><input type="text" id="student_firstname" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>Last Name:</td>
          				<td><input type="text" id="student_lastname" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>Contact:</td>
          				<td><input type="text" id="student_phone" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>Enrollment Status:</td>
          				<td><input type="text" id="student_status" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>Payable Amount:</td>
          				<td><input type="text" id="amount" class="form-control" readonly></td>
          			</tr>
          			<tr class="table-active">
          				<td>Approved Date:</td>
          				<td><input type="text" id="date" class="form-control" readonly></td>
          			</tr>
          		</tbody>
          	</table>
          	</div>

          	<div class="modal-footer">
          		<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"> Close</i></button>

        	</div>
		</div>
		</div>
	</form>
</div>
</div>
</div>


<!--Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h3 class="modal-title">Delete Confirmation</h3>
      </div>

      <form action="" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <h4>Do you want to delete this Pay List?</h4>
        </div>

        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">NO, Cancel</button>

          <button type="submit" name="deletedata" class="btn btn-danger">Yes, Delete</button>
        </div>
        
      </form>
      
    </div>  
  </div>
</div>

<script>
/* JavaScript Search */
$(document).ready(function () {

    $('#Denied').DataTable();

});//End


/*Delete Pay List*/
$(document).ready(function () {
      $('#deletebtn').on('click', function() {
        
        $('#deleteModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#delete_id').val(data[0]);
      });
    });//end


/* JavaScript View */
 	$(document).ready(function(){  
      $('.view_paylist').click(function(){  
           var paylist_id = $(this).attr("id")
           $.ajax({  
                url:"view_paylist.php",  
                method:"POST",  
                data:{
					paylist_id:paylist_id 
				},
                success:function(data){
                	data = $.parseJSON(data);
					$('#student_id').val(data.student_ID);
					$('#student_firstname').val(data.firstname);
					$('#student_lastname').val(data.lastname);
					$('#student_phone').val(data.contact);
					$('#student_status').val(data.status);
					$('#amount').val(data.amount);
					$('#date').val(data.date);
                    $('#modalview').modal("show");  
                }  
           });  
      });  
 });  

</script>