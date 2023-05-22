<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
$count = 1;
$myID = $_SESSION['admin_id']?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Books
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Books</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-book" aria-hidden="true"><b>&nbspList of Books</b></i></h3>

                <div class="search">
                        <div class="row form-inline">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBook" class="btn btn-success form-control">
                                <i class="fa fa-plus" aria-hidden="true">&nbspAdd Book</i></button>
                                <button typ="button" class="btn btn-success" id="excel" class="btn btn-success form-control">
                                <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></button>

                                <button type="button" class="btn btn-danger" id="print" class="btn btn-success form-control">
                                <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>

                        </div>
                </div>
            </div>

            <table class="table table-bordered" id="search" style="color: #666666; font-size: 12px; font-weight: 500;">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Call Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="data">
                    <?php 
                    $sql = "SELECT * FROM books";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        
                    ?>
                    <tr>
                    <td style = "vertical-align: middle;"><?=$count++?></td>
                    <td style = "vertical-align: middle;"><?=$row['Title']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Author']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Category']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Call_Number']?></td>
                    <td style = "vertical-align: middle; text-align:center;"><?php
                    if ($row['Status'] == "0") {
                       echo '<button id="'.$row['ISBN'].'" class ="btn btn-success form-control publish">Publish</button>';
                    }else{
                        echo '<button id="'.$row['ISBN'].'" class ="btn btn-danger form-control unpublish">Unpublish</button>';
                    }
                    
                    ?></td>
                    <td style="vertical-align: middle;" class="text-center">
                        <button type="button" id="<?php echo $row['ID']  ?>" class="btn btn-info edit"><i class="fa fa-pencil-square-o"></i></button>

                        <button type="button" id="<?php echo $row['ID']  ?>" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                    </td>
                    </tr>
                    <?php endwhile?>

                </tbody>
            </table>
        </div>
    </section>
    
</div>

<div class="modal fade" id="addBook" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true">&nbspAdd Book</i></h3>
        
        
      </div>
      <div class="modal-body">
        <form action="" id="book-form" method="post">
              <div class="row">
                <div class="col-md-12">
                    <label for="">ISBN:</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="">Book Title:</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Subtitle:</label>
                    <input type="text" name="subtitle" class="form-control" placeholder="Optional">
                </div>

                <div class="col-md-6">
                    <label for="">Book Author:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Book Sub-Author:</label>
                    <input type="text" name="subAuthor" class="form-control" placeholder="Optional">
                </div>
                
                <div class="col-md-6">
                    <label for="">Category:</label>
                    <input type="text" name="category" id="category" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Call Number:</label>
                    <input type="text" name="callNumber" id="callNumber" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Date Publish:</label>
                    <input type="date" name="publish" id="publish" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">Total:</label>
                    <input type="number" name="total" id="total" class="form-control">
                </div>
              </div>
        </form>
      </div>
          
        <div class="modal-footer">
            <input type="button" id="btn_save" class="btn btn-primary" value="Save"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

    </div>
  </div>
</div>

<div class="modal fade" id="edit-book" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true">&nbspAdd Book</i></h3>
        
        
      </div>
      <div class="modal-body">
        <form action="" id="edit-form">
          <div class="row">
            <div class="col-md-12">
                <label for="">ISBN:</label>
                <input type="text" name="code" id="code2" class="form-control">
                <input type="hidden" name="id" id="id1" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Book Title:</label>
                <input type="text" name="title" id="title3" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Book Subtitle:</label>
                <input type="text" name="subtitle" id="subtitle4" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Book Author:</label>
                <input type="text" name="author" id="author5" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Book Sub-Author:</label>
                <input type="text" name="subAuthor" id="subAuthor6" class="form-control">
            </div>
            
            <div class="col-md-6">
                <label for="">Category:</label>
                <input type="text" name="category" id="category7" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Call Number:</label>
                <input type="text" name="callNumber" id="callNumber8" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="">Date Publish:</label>
                <input type="text" name="publish" id="publish9" class="form-control" readonly>
            </div>

            <div class="col-md-6">
                <label for="">Total:</label>
                <input type="text" name="total" id="total10" class="form-control">
            </div>
          </div>
        </form>
      </div>
        <div class="modal-footer">
            <input type="button" id="save" class="btn btn-primary" value="Save"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<?php include_once 'footer.php';?>

<script>
$(document).ready(function(){
    
    $('#btn_save').click(function(){
        start_load();
        var code = $('#code').val();
        var title = $('#title').val();
        var name = $('#name').val();
        var category = $('#category').val();
        var callNumber = $('#callNumber').val();
        var publish = $('#publish').val();
        var total = $('total').val();
        if(code == "" || title == "" || name == "" || category == "" || callNumber == "" || publish == "" || total){
            Swal.fire(
		      'All Fields Required!',
		      '',
		      'info'
	    	)
        }else{
            $.ajax({
                url: "../model/add_book.php",
                method: "POST",
                data: $('#book-form').serialize(),
                success:function(data){
                   if(data == "success"){
                       const swalWithBootstrapButtons = Swal.mixin({
        				  customClass: {
        				    confirmButton: 'btn btn-success',
        				  },
        				  buttonsStyling: false
        				})
        
        				swalWithBootstrapButtons.fire({
        				  title: 'Book Successfully Saved!',
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
                }
            })
        }
        
    })
    
    $('.publish').click(function(){
        start_load();
        var isbn = $(this).attr('id');
        $.ajax({
            url: "../model/publish.php",
            method: "POST",
            data:{
                isbn:isbn
            },
            success:function(data){
                if(data == "success"){
                    const swalWithBootstrapButtons = Swal.mixin({
    				  customClass: {
    				    confirmButton: 'btn btn-success',
    				  },
    				  buttonsStyling: false
    				})
    
    				swalWithBootstrapButtons.fire({
    				  title: 'Book Successfully Published!',
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
            }
        })
    })

    $('.unpublish').click(function(){
        start_load()
        var isbn = $(this).attr('id');
        $.ajax({
            url: "../model/unpublish.php",
            method: "POST",
            data:{
                isbn:isbn
            },
            success:function(data){
                if(data == "success"){
                    const swalWithBootstrapButtons = Swal.mixin({
    				  customClass: {
    				    confirmButton: 'btn btn-success',
    				  },
    				  buttonsStyling: false
    				})
    
    				swalWithBootstrapButtons.fire({
    				  title: 'Book Successfully Unpublished!',
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
            }
        })
    })

    $('.edit').click(function(){
        var isbn = $(this).attr('id');
        $.ajax({
            url: "edit-book.php",
            method: "POST",
            data:{
                isbn:isbn
            },
            success:function(data){
                data = JSON.parse(data);
                $('#id1').val(isbn);
                $('#code2').val(data.isbn);
                $('#title3').val(data.title);
                $('#subtitle4').val(data.subtitle);
                $('#author5').val(data.author);
                $('#subAuthor6').val(data.sub_author);
                $('#category7').val(data.category);
                $('#callNumber8').val(data.call_number);
                $('#publish9').val(data.date_publish);
                $('#total10').val(data.total);

                $('#edit-book').modal('show');
            }
        })
    })

    $('#save').click(function(){
        start_load();
        $.ajax({
            url: "../model/edit-book.php",
            method: "POST",
            data: $('#edit-form').serialize(),
            success:function(data){
                if(data == "success"){
                   const swalWithBootstrapButtons = Swal.mixin({
    				  customClass: {
    				    confirmButton: 'btn btn-success',
    				  },
    				  buttonsStyling: false
    				})
    
    				swalWithBootstrapButtons.fire({
    				  title: 'Data Successfully Saved!',
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
            }
        })
    })

    $('#print').click(function(){
            window.location.href = '../reports/print_books.php';
    })

    $('#excel').click(function(){
            window.location.href = '../reports/export_books.php';
    })
    
    $('#search').DataTable();
})

</script>