<?php include_once('main_head.php');?>
<?php ob_start();?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$count = 1;
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
  <title>Student Payment</title>
	
    <section class="content-header">
    	<h1>
        	Student Payment
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Payments</a></li>
    	</ol>
	</section>
    
<hr>

<section class="content">

	<div class="table-enrollment">
		<div class="table-title">
			<h3><i class="fa fa-money" aria-hidden="true"><b> Payments</b></i></h3>
				<div class="btn-enrollment">
					<form class="form-inline" action="../reports/payments_report.php" method="POST">
						<div class="row">
							<input type="hidden" name="myID" value="<?php echo $myID ?>">
							<button type="submit" name="print" class="btn btn-danger form-control"><i class="fa fa-print" aria-hidden="true"> Print</i></button>
							<button type="submit" name="excel" class="btn btn-success form-control"><i class="fa fa-file-excel-o" aria-hidden="true"> Excel</i></button>

						</div>
					</form>
				</div>					
		</div>

		    

<?php
	$payment = "SELECT * FROM payment_history INNER JOIN student on payment_history.Student_ID = student.Student_ID Order by payment_history.Student_ID ASC";
	$result = mysqli_query($con, $payment);

?>

		<table class="table table-bordered table-striped" id="payment_table" style="color: #666666; font-size: 13px; font-weight: 500;">
      			<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Student ID</th>
						<th scope="col">Name</th>
						<th scope="col">OR Number</th>
						<th scope="col">Paid Amount</th>
						<th scope="col">Balance</th>
						<th scope="col">Type</th>
						<th scope="col">Date</th>
					</tr>
				</thead>

				<tbody class="table-hover" id="detailTable">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
							$date = $row['Date'];
							$newdate = strtotime($date);
							$name = $row['Firstname']. " " . " " .	$row['Lastname'];
							
				  	?>

						<tr class="table-active">
						<td style = "vertical-align: middle;"><?php echo $count++;?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Student_ID'];?></td>
						<td style = "vertical-align: middle;"><?php echo $name;?></td>
						<td style = "vertical-align: middle;"><?php echo $row['OR_Number'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Paid_Amount'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Balance'];?></td>
						<td style = "vertical-align: middle;"><?php echo $row['Payment_Type'];?></td>
						<td style = "vertical-align: middle;"><?php echo date('M d Y', $newdate);?></td>
						</tr>

					<?php }?>
				</tbody>
            </table>
	</div>


</section>

</div>
<?php include_once ('footer.php')?>

<script>
  $(document).ready(function () {
    $('#payment_table').DataTable();
});
</script>

