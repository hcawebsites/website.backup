<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-4 mb-4 h1">
	          <div class="cards">
		          <a href="#">
		            <div class="card-body">
		                <div>
		                	<?php  
		                		$getBook = mysqli_query($con, "SELECT count(*) as count from books");
		                		$row = mysqli_fetch_assoc($getBook);
		                		$total_count = $row['count'];

		                	?>
		                    <p><?=$total_count?></p>
		                    
		                  
			                  <span>Books</span>
			            </div>

		                <div>
		                    <span class="fa fa-book"></span>
		                </div>
			            </div>
	            	</a>
	          </div>
	        </div>

	        <div class="col-md-4 mb-4 h1">
	          <div class="cards">
		          <a href="#">
		            <div class="card-body">
		                <div>
		                	<?php  
		                		$getborrow = mysqli_query($con, "SELECT count(*) as count from borrow_books where Status = '1'");
		                		$row = mysqli_fetch_assoc($getborrow);
		                		$total_count = $row['count'];

		                	?>
		                    <p><?=$total_count?></p>
		                    
		                  
			                  <span>Borrowed Books</span>
			            </div>

		                <div>
		                    <span class="fa fa-book"></span>
		                </div>
			            </div>
	            	</a>
	          </div>
	        </div>

	        <div class="col-md-4 mb-4 h1">
	          <div class="cards">
		          <a href="#">
		            <div class="card-body">
		                <div>
		                	<?php  
		                		$getBook = mysqli_query($con, "SELECT sum(Available) as total from books");
		                		$row = mysqli_fetch_assoc($getBook);
		                		$total_count = $row['total'];

		                	?>
		                    <p><?=$total_count?></p>
		                    
		                  
			                  <span>Available books</span>
			            </div>

		                <div>
		                    <span class="fa fa-book"></span>
		                </div>
			            </div>
	            	</a>
	          </div>
	        </div>
	        <div class="col-md-12"><hr></div>
	        <div class="col-md-6">
	        	<div class="table-master">
	        		<div class="table-title">
	        			<h3>
	        				<i class="fa fa-history"></i>&nbsp
	        				Borrowed Books
	        			</h3>
	        		</div>

	        		<div style="margin-top: 10px; margin-bottom: 10px">
	        			<input type="text" id="search" class="form-control" placeholder="Searh by Borrowers Name">
	        		</div>

	        		<table class="table table-striped table-bordered" id="borrow">
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

	        <div class="col-md-6">
	        	<div class="table-master">
	        		<div class="table-title">
	        			<h3>
	        				<i class="fa fa-history"></i>&nbsp
	        				Returned Books
	        			</h3>
	        		</div>

	        		<div style="margin-top: 10px; margin-bottom: 10px">
	        			<input type="text" id="search_return" class="form-control" placeholder="Searh by Borrowers Name">
	        		</div>

	        		<table class="table table-striped table-bordered" id="return">
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
		        				while ($row = mysqli_fetch_assoc($get)) {
		        				$name = $row['Fullname'];
		        				$date = date("M. d, Y", strtotime($row['Date_Returned']));
		        			?>	
		        			<tr style="color: #666666; font-size: 12px;">
		        				<td><?=$row['Title']?></td>
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
<?php include_once '../footer.php'?>
<script type="text/javascript">
	$(function () {
        $('#borrow').DataTable({
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
        $('#return').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
		  "pageLength": 5,
          "autoWidth": false
        });
      });

	$(document).ready(function(){
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
</script>
