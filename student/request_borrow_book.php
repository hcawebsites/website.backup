<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>


<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	List of Books
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Request to Borrow Book</a></li>
    	</ol>
	</section>

    <section class="content">
    <div class="row">
        <?php
        $sql = "SELECT * FROM books WHERE Status = '1'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)){
        
            if ($row['Available'] <= 0) {
                
            }else{

                echo '<div class="col-md-4 h4">
                    <div class="cards">
                    <p>ISBN:&nbsp'.$row['ISBN'].'</p>
                    <p>Title:&nbsp'.$row['Title'].'</p>
                    <p>Author:&nbsp'.$row['Author'].'</p>
                    <p>Category:&nbsp'.$row['Category'].'</p>
                    <p style="color: green; font-weight: 800;">Status:&nbsp'.$row['Available'].'&nbspAvailable</h3>
                    <hr>
                    
                        <button id="'.$row['ISBN'].'" class="fa fa-shopping-cart form-control btn btn-success borrow">&nbspBorrow</button>
                 
                    
                </div>
            </div>';
            }
        }?>


    </div>
    </section>
</div>

<div class="modal fade" id="borrowModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-book aria-hidden="true">&nbspBorrow Book</i></h3>
        
        
      </div>
      <div class="modal-body">
      <form action="#" method="post">
              <div class="row">

                <div class ="form-group text-center col-md-12">
                    <img id="output" class="img-rounded" src="" style="width:250px; height:250px;" />
                </div>

                <div class="col-md-12 text-center">
                    <label>Please take a picture of this QR Code.</label>
                </div>

                <div class="col-md-12 text-center">
                    <p><b>Note: </b>Please present your Student ID and This Qr Code to the Librarian.</p>
                </div>

              </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php include_once 'footer.php';?>

<script>
    

$(document).ready(function(){  
      $('.borrow').click(function(){  
           var bookID = $(this).attr("id");
           $.ajax({  
                url:"../std-model/request_to_borrow.php",  
                method:"POST",  
                data:{
                    bookID:bookID
                },
                success:function(data){
                    data = $.parseJSON(data);
                     $('.form-group img').attr("src", "../qrcodeBooks/" + (data.code));

                    $('#borrowModal').modal("show");  
                }
           });  
      });  
 });  

</script>