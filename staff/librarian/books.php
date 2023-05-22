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
			Books
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Library Management</a></li>
			<li><a href="#">Books</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-list-alt"></i>&nbsp
					List of Books
				</h3>

				<div class="search">
					<div class="row form-inline">
						<button type="button" class="btn btn-primary" id="btn_modal"><i class="fa fa-plus-square"></i>&nbspAdd Book</button>
						<button type="button" class="btn btn-danger" id="print"><i class="fa fa-print"></i>&nbspPrint</button>
						<button type="button" class="btn btn-success" id="excel"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
					</div>
				</div>
			</div>

			<table class="table table-striped" id="search">
				<thead>
					<tr style="color: #666666; font-size: 14px;">
						<th>#</th>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Call Number</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$getBook = mysqli_query($con, "SELECT * from books order by ID asc");
						while ($row = mysqli_fetch_assoc($getBook)) {
					?>
					<tr  style="color: #333; font-size: 14px;">
						<td style="vertical-align: middle;"><?=$count++?></td>
						<td style="vertical-align: middle;"><?=$row['Title']?></td>
						<td style="vertical-align: middle;"><?=$row['Author']?></td>
						<td style="vertical-align: middle;"><?=$row['Category']?></td>
						<td style="vertical-align: middle;"><?=$row['Call_Number']?></td>
						<td style="vertical-align: middle;" class="text-center">
							<?php
								if ($row['Status'] == 1) {
									echo "<button id='".$row['ID']."' class='btn btn-danger unpublish'>Unpublish</button";
								}else{
									echo "<button id='".$row['ID']."' class='btn btn-success publish'>Publish</button";
								}
							?>
						</td>
						<td style="vertical-align: middle;" class="text-center">
	                        <button type="button" id="<?php echo $row['ID']  ?>" class="btn btn-info edit"><i class="fa fa-pencil-square-o"></i></button>

	                        <button type="button" id="<?php echo $row['ID']  ?>" class="btn btn-primary qrcode"><i class="fa fa-qrcode"></i></button>

	                        <button type="button" id="<?php echo $row['ID']  ?>" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
	                    </td>
					</tr>
					<?php }?>
					
				</tbody>
			</table>
		</div>
	</section>
</div>
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-plus-square"></i>&nbspManage Books</h4>
      </div>
      <div class="modal-body">
        <form action="" id="book_form">
        	<div class="row">
                <div class="col-md-12">
                    <label for="">ISBN:</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Book Title:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Book Subtitle:</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Optional">
                </div>

                <div class="col-md-6">
                    <label for="">Book Author:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Book Sub-Author:</label>
                    <input type="text" name="subAuthor" id="subAuthor" class="form-control" placeholder="Optional">
                </div>
                
                <div class="col-md-6">
                    <label for="">Category:</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Call Number:</label>
                    <input type="text" name="callNumber" id="callNumber" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Date Publish:</label>
                    <input type="date" name="publish" id="publish" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Total:</label>
                    <input type="number" name="total" id="total" class="form-control" required>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="add_book" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i>&nbspManage Books</h4>
      </div>
      <div class="modal-body">
        <form action="" id="edit_form">
        	<div class="row">
                <div class="col-md-12">
                    <label for="">ISBN:</label>
                    <input type="hidden" name="id" id="id" class="form-control">
                    <input type="text" name="code" id="ecode" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Title:</label>
                    <input type="text" name="title" id="etitle" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Subtitle:</label>
                    <input type="text" name="subtitle" id="esubtitle" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Author:</label>
                    <input type="text" name="name" id="ename" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Sub-Author:</label>
                    <input type="text" name="subAuthor" id="esubAuthor" class="form-control">
                </div>
                
                <div class="col-md-6">
                    <label for="">Category:</label>
                    <input type="text" name="category" id="ecategory" class="form-control" >
                </div>

                <div class="col-md-6">
                    <label for="">Call Number:</label>
                    <input type="text" name="callNumber" id="ecallNumber" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Date Publish:</label>
                    <input type="text" id="edate" readonly class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Total:</label>
                    <input type="number" name="total" id="etotal" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="edit_book" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="qr_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-qrcode"></i>&nbspBook Qr Code</h4>
      </div>
      <div class="modal-body text-center">
			<img id="output" class="img-rounded" src="" style="width:300px; height:300px;" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-trash"></i>&nbspBook Qr Code</h4>
      </div>
      <div class="modal-body">
      		<form action="" id="delete_books">
      			<input type="hidden" name="ids" id="ids">
      		</form>
			<h4>Are you sure you want to delete this book?</h4>
      </div>
      <div class="modal-footer">
      	<button type="button" id="delete" class="btn btn-danger" data-dismiss="modal">Yes, Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include_once '../footer.php'?>
<script type="text/javascript">
	var timer1 = 0;
	$(document).ready(function(){
		$('#search').DataTable();

		$('#btn_modal').click(function(){
			$('#add_modal').modal('show');
		})

		$('.publish').click(function(){
			start_load();
			var id = $(this).attr('id');
			$.ajax({
				url: "../../staff-model/publish.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					let type = 'success';
				    let title = 'Data successfully saved.';
				    createToast(type, title);
				},
				complete:function(){
					end_load();
					location.reload();
					finish();
				}
			})
		})

		$('.unpublish').click(function(){
			start_load();
			var id = $(this).attr('id');
			$.ajax({
				url: "../../staff-model/unpublish.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					let type = 'info';
				    let title = 'Data successfully saved.';
				    createToast(type, title);
				},
				complete:function(){
					end_load();
					location.reload();
					finish();
				}
			})
		})

		$('#add_book').click(function(){
			start_load();
			var code = $('#code').val();
			var title = $('#title').val();
			var name = $('#name').val();
			var category = $('#category').val();
			var callNumber = $('#callNumber').val();
			var total = $('#total').val();
			if (code == "" || title == "" || name == "" || category == "" || callNumber == "" || total == "") {
				alert("All fields Required!");
			}else{
				$.ajax({
				url: "../../staff-model/add_book.php",
				method: "POST",
				data: $('#book_form').serialize(),
				success:function(data){
				let type = 'success';
			    let title = 'Data successfully saved.';
			    createToast(type, title);
				},
				complete:function(){
					end_load();
					location.reload();
					finish();
				}
			})
			}
		});

		$('#edit_book').click(function(){
			start_load();
				$.ajax({
				url: "../../staff-model/edit_books.php",
				method: "POST",
				data: $('#edit_form').serialize(),
				success:function(data){
				let type = 'success';
			    let title = 'Data successfully saved.';
			    createToast(type, title);
				},
				complete:function(){
					end_load();
					location.reload();
					finish();
				}
			})
		});

		$('.edit').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "book_data.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					data = JSON.parse(data);
					$('#id').val(id);
					$('#ecode').val(data.isbn);
					$('#etitle').val(data.title);
					$('#esubtitle').val(data.subtitle);
					$('#ename').val(data.author);
					$('#esubAuthor').val(data.sub_author)
					$('#ecategory').val(data.category);
					$('#ecallNumber').val(data.call);
					$('#edate').val(data.date);
					$('#etotal').val(data.total);
					$('#edit_modal').modal('show');

				}
			})
		})

		$('.delete').click(function(){
			var id = $(this).attr('id');
			$('#ids').val(id);
			$("#delete_modal").modal('show');
		})

		$('#delete').click(function(){
			$.ajax({
				url: "../../staff-model/delete_books.php",
				method: "POST",
				data: $('#delete_books').serialize(),
				success:function(data){
					let type = 'error';
				    let title = 'Data successfully deleted.';
				    createToast(type, title);
				},
				complete:function(){
					end_load();
					location.reload();
					finish();
				}
			})
		})

		$('.qrcode').click(function(){
			var id = $(this).attr('id');
			$.ajax({
				url: "book_data.php",
				method: "POST",
				data:{
					id:id
				},
				success:function(data){
					data = JSON.parse(data);
					 $('#output').attr("src", "../../qrcodeBooks/" + (data.qrcode));
					$('#qr_modal').modal('show');

				}
			})
		})

		$('#print').click(function(){
			window.location.href = '../../reports/print_books.php';
		})

		$('#excel').click(function(){
			window.location.href = '../../reports/export_books.php';
		})
	})
</script>