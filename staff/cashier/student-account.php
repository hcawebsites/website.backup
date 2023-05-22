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
			Student Account
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Student</a></li>
			<li><a href="#">Student Account</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-money"></i>&nbsp
					Student Accounts
				</h3>
				<div class="search">
					<form action="../../reports/std-payment-reports.php" method="POST">
						<div class="row form-inline">
							<input type="hidden" name="myID" value="<?php echo $myID?>">
							<button type="submit" name="print" class="btn btn-danger form-control"><i class="fa fa-print"></i>&nbspPrint</button>
							<button type="submit" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
						</div>
					</form>
				</div>
			</div>

			<table class="table table-bordered table-striped" id="search" style="font-size: 13px; color: #666666; ">
				<thead>
					<tr>
						<th>#</th>
						<th>Student ID</th>
						<th>Name</th>
						<th>Class</th>
						<th>Total</th>
						<th>Balance</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$get = mysqli_query($con, "SELECT * FROM student inner join payments on student.Student_ID = payments.Student_ID inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID ORDER BY student.Lastname ASC");
						while($row = mysqli_fetch_assoc($get)){
							$class = $row['Name']. " " .$row['Strand']. " " .$row['Section'];
							$name = $row['Lastname']. ", " .$row['Firstname']. " " .$row['Middlename'];
							$total = $row['Total'];
							$balance = $row['Balance'];
						?>
						<tr>
							<td scope="col"><?=$count++?></td>
							<td scope="col"><?=$row['Student_ID']?></td>
							<td scope="col"><?=$name?></td>
							<td scope="col"><?=$class?></td>
							<td scope="col"><?=$total?></td>
							<td scope="col">
								<?php
									if ($row['Balance'] == 0) {
										echo 'Fully Paid';
									}else{
										echo $row['Balance'];
									}
								?>	
							</td>
							<td scope="col" class="text-center">
								<?php
									if ($row['Balance'] == 0) {
										echo '<p class="btn btn-success form-control">Fully Paid</p>';
									}else{
										echo '<p class="btn btn-success form-control btn-payment" id='.$row['Student_ID'].'>Payment</p>
										<p class="btn btn-info form-control btn-history" id='.$row['Student_ID'].'>History</p>';
									}
								?>	
							</td>
						</tr>
					<?php }?>
					
				</tbody>
			</table>
		</div>
	</section>
</div>
<div class="modal fade" id="payment-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title">
        	<i class="fa fa-money"></i>&nbsp
        	Manage Payment
        </h4>
      </div>
      <div class="modal-body">
        <form action="../../staff-model/save_payment.php" method="POST">
        	<div class="row">
        		<div class="col-md-12">
        			<label>Student ID:</label>
        			<input type="text" name="std_id" id="std_id" class="form-control" readonly>
        			<input type="hidden" name="cid" id="cid" value="<?php echo $myID  ?>" class="form-control" readonly>
        		</div>	

        		<div class="col-md-12">
        			<label>Name:</label>
        			<input type="text" name="name" id="name" class="form-control" readonly>
        		</div>	

        		<div class="col-md-12">
        			<label>Class:</label>
        			<input type="text" name="class" id="class" class="form-control" readonly>
        		</div>	

        		<div class="col-md-6">
        			<label>Total:</label>
        			<input type="text" name="total" id="total" class="form-control" readonly>
        		</div>	

        		<div class="col-md-6">
        			<label>Balance:</label>
        			<input type="text" name="balance" id="balance" class="form-control"  readonly>
        		</div>

        		<div class="col-md-12"><hr></div>

        		<div class="col-md-12">
        			<label>Amount:</label>
        			<textarea name="amount" id="amount" cols="30" rows="2" class="form-control" style="resize: none;" required></textarea>
        		</div>

        		<div class="col-md-12">
        			<label>Payment Type:</label>
        			<select name="type" id="type" class="form-control" required>
        				<option hidden selected>Please select here</option>
        				<option value="Fully Paid">Fully Paid</option>
        				<option value="Partial Payment">Partial Payment</option>
        			</select>
        		</div>
        	</div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="save-payment" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="history-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title">
        	<i class="fa fa-history"></i>&nbsp
        	Payment History
        </h4>
      </div>
      <div class="modal-body">
      	<table class="table table-striped" style="font-size: 12px; color: #666666; ">
      		<thead>
      			<tr>
      				<th>#</th>
      				<th>OR Number</th>
      				<th>Amount</th>
      				<th>Balance</th>
      				<th>Date</th>
      			</tr>
      		</thead>
      		<tbody id="data"></tbody>
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once '../footer.php';?>
<script type="text/javascript">
	var timer1 = 0;
	$(document).ready(function(){
		$('#search').DataTable();

		$('.btn-payment').click(function(){
			var std_id = $(this).attr('id');
			$.ajax({
				url: "add_payment.php",
				method: "POST",
				data:{
					std_id:std_id
				},
				success:function(data){
					data = JSON.parse(data);
					$('#std_id').val(std_id);
					$('#name').val(data.name);
					$('#class').val(data.class);
					$('#total').val(data.total);
					$('#balance').val(data.balance);
					$('#payment-modal').modal('show');
				}
			})
		})

		$('.btn-history').click(function(){
				var std_id = $(this).attr('id');
				$.ajax({
					url: "payment-history.php",
					method: "POST",
					data:{
						std_id:std_id
					},
					success:function(data){
						$('#history-modal').modal('show')
						$('#data').html(data);
					}
				})
		})
	})
</script>