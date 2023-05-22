<?php include_once('main_head.php');?>
<?php ob_start();?>
<?php include_once('../model/delete_pay_list.php')?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
  <title>To Pay List</title>
	
    <section class="content-header">
    	<h1>
        	To Pay List
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i> Enrollment Request</a></li>
            <li><a href="#">To Pay</a></li>
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
		
		<div class="table-enrollment">
			<div class="table-title">
				<h3><i class="fa fa-money" aria-hidden="true"><b> To Pay</b></i></h3>				
			</div>

			<table class="table table-striped" id="to_pay" style="color: #666666; font-size: 14px; font-weight: 400;">
      			<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Student ID</th>
						<th scope="col">Name</th>
						<th scope="col">Status</th>
						<th scope="col">Date Created</th>
						<th scope="col">Due Date</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<?php 
				$sql = "SELECT * FROM student inner join student_fees on student.Student_ID = student_fees.Student_ID";
				$result = mysqli_query($con, $sql);
				?>
				<tbody class="table-hover" id="detailTable">
					<?php
					while ($row = mysqli_fetch_assoc($result)) {
						$date_created = date("M d, Y", strtotime($row['Date_Created']));
						$due_date = date("M d, Y", strtotime($row['Due_Date']));
					?>

					<tr class="table-active">
						<td style="vertical-align:middle;"><?php echo $row['ID'];?></td>
						<td style="vertical-align:middle;"><?php echo $row['Student_ID'];?></td>
						<td style="vertical-align:middle;"><?php echo $row['Firstname'], " ", $row['Lastname'];?></td>
						<td class="text-center" style="vertical-align:middle;"><?php 

						if ($row['Status'] == "1") {
							echo "<p class='btn-danger'>To Pay</p>";
						}

						?></td>
						<td style="vertical-align:middle;"><?php echo $date_created;?></td>
						<td style="vertical-align:middle;"><?php echo $due_date;?></td>
						<td style="vertical-align:middle;">
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

	<div class="modal-body">
			<form action="" method="POST" id="paylist-form">
				<div class = "row">
					<div class="col-md-12">
    					<table class="table table-striped">
    						<tbody class="table-hover">
    							<tr class="table-active">
    								<td>Student ID:</td>
    								<td><input type="text" name="std_id" id="student_id" class="form-control" readonly></td>
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
    								<td>Date Created:</td>
    								<td><input type="text" id="date" class="form-control" readonly></td>
    							</tr>
    							<tr class="table-active">
    								<td>Due Date:</td>
    								<td><input type="text" id="due" class="form-control" readonly></td>
    							</tr>
    						</tbody>
    					</table>
					</div>
				</div>
			</form>
					<div class="modal-footer">
						<button type="button" name="send" id="send" class="btn btn-info"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspSend Email</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"> Close</i></button>
					</div>
				</div>	
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

    $('#to_pay').DataTable();

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
        $('#delete_id').val(data[1]);
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
					$('#due').val(data.due);
                    $('#modalview').modal("show");  
                }  
           });  
      });  
 });  

 $(document).ready(function(){
	$('#send').click(function(){
		$.ajax({
			url: "../model/sendEmail.php",
			method: "POST",
			data: $('#paylist-form').serialize(),
			success:function(data){
				if(data == "success"){
				    Swal.fire(
    			      'Payment Notification Successfully Send!',
    			      '',
    			      'success'
    		    	)

				}
			}
		})
	})
 })

</script>