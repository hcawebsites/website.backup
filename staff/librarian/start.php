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
			Transactions
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Library Management</a></li>
			<li><a href="#">Start Transaction</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<p style="margin-top: -25px; margin-left: -10px; font-weight: 600; color: #666666; font-size: 14px;"><i class="fa fa-book"></i>&nbspTransactions</p>


			<div class="row">
				<div class="col-md-6">
					<button type="button" id="borrow" class="btn btn-success form-control" style="height: 80px; font-weight: 300; font-size: 16px;">Borrow Books</button>
				</div>
				<div class="col-md-6">
					<button type="button" id="return" class="btn btn-info form-control" style="height: 80px; font-weight: 300; font-size: 16px;">Return Books</button>
				</div>
				<div class="col-md-12"><hr></div>
				<div class="col-md-6">
					<div class="table-title">
						<h4>
							<i class="fa fa-book"></i>&nbsp
							Borrow Transactions
						</h4>
					</div>
					<div style="margin-top: 10px; margin-bottom: 10px">
	        			<input type="text" id="search" class="form-control" placeholder="Searh by Borrowers Name">
	        		</div>
					<table class="table table-striped table-bordered" id="search1">
	        			<thead>
		        			<tr style="color: #666666; font-size: 12px;">
		        				<th>Title</th>
		        				<th>Borrowers Name</th>
		        				<th>Transaction Date</th>
		        			</tr>
		        		</thead>
		        		<tbody id="data">
		        			<?php  
		        				$get = mysqli_query($con, "SELECT * from borrow_books WHERE Status = '1'");
		        				while ($rowBorrow = mysqli_fetch_assoc($get)) {
		        				$name = $rowBorrow['Fullname'];
		        				$date = date("M. d, Y", strtotime($rowBorrow['Date_Borrow']));
		        			?>	
		        			<tr style="color: #666666; font-size: 13px;">
		        				<td><?=$rowBorrow['Title']?></td>
		        				<td><?=$name?></td>
		        				<td><?=$date?></td>
		        			</tr>
		        			<?php } ?>
		        			
		        		</tbody>
	        		</table>
				</div>
				<div class="col-md-6">
					<div class="table-title">
						<h4>
							<i class="fa fa-book"></i>&nbsp
							Return Transactions
						</h4>
					</div>
					<div style="margin-top: 10px; margin-bottom: 10px">
	        			<input type="text" id="search_return" class="form-control" placeholder="Searh by Borrowers Name">
	        		</div>
					<table class="table table-striped table-bordered" id="search2">
	        			<thead>
		        			<tr style="color: #666666; font-size: 12px;">
		        				<th>Title</th>
		        				<th>Borrowers Name</th>
		        				<th>Transaction Date</th>
		        			</tr>
		        		</thead>
		        		<tbody id="data_return">
		        			<?php  
		        				$get = mysqli_query($con, "SELECT * from borrow_books WHERE Status = '0'");
		        				while ($rowBorrow = mysqli_fetch_assoc($get)) {
		        				$name = $rowBorrow['Fullname'];
		        				$date = date("M. d, Y", strtotime($rowBorrow['Date_Returned']));
		        			?>	
		        			<tr style="color: #666666; font-size: 12px;">
		        				<td><?=$rowBorrow['Title']?></td>
		        				<td><?=$name?></td>
		        				<td><?=$date?></td>
		        			</tr>
		        			<?php } ?>
		        			
		        		</tbody>
	        		</table>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include_once '../footer.php';  ?>

<script>
$(document).ready(function(){
	$('#borrow').click(function(){
		window.location.href = 'borrow_books.php';
})
	$('#return').click(function(){
		window.location.href = 'return_book.php';
})

	$('#search').keyup(function(){
		var value = $(this).val();
		$.ajax({
			url: "borrow_search.php",
			method: "POST", 
			data:{
				value:value
			},
			success:function(data){
				$('#data').html(data);
			}
		})
	})

	$('#search_return').keyup(function(){
		var value = $(this).val();
		$.ajax({
			url: "return_search.php",
			method: "POST", 
			data:{
				value:value
			},
			success:function(data){
				$('#data_return').html(data);
			}
		})
	})
})
$(function () {
    $('#search1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
	  "pageLength": 5,
      "autoWidth": false
    });
});

$(function () {
    $('#search2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
	  "pageLength": 5,
      "autoWidth": false
    });
});
</script>