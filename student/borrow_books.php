<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>


<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	Borrowed Books
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Borrowed Book</a></li>
    	</ol>
	</section>
	<hr>
    <section class="content">

    	<div class="table">
            <div class="table-title">
                <h3><i class="fa fa-book" aria-hidden="true">&nbspBorrowed Book</i></h3>
            </div>

            
        <table class="table table-striped" id="search">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                    	$myID = $_SESSION['username'];
                        $sql = "SELECT * FROM borrow_books Where Borrowers_ID = '$myID' AND Status = '1'";
                        $result = mysqli_query($con, $sql);
                    ?>
                    <tbody class="table-hover" id="detailTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['Date_Borrow'];
                        $newdate = date('M d Y', strtotime($date));
                    ?>
                    <tr class="table-active" style="text-align: center;">
                    <td style = "vertical-align: middle;"><?=$row['ID']?></td>
                    <td style = "vertical-align: middle;"><?=$row['ISBN']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Title']?></td>

                    <td style = "vertical-align:middle;"><?=$row['Author']?></td>

                    <td style = "vertical-align: middle;"><?=$newdate?></td>
                    <td style = "vertical-align: middle;">
                    	<button class="btn btn-primary form-control borrow" id="<?php echo $row['Borrowers_ID'];?>"><i class="fa fa-qrcode" aria-hidden="true"></i>
                    </td>
                
                    </tr>



                    </tbody>



                    <?php endwhile?>
                </table>
                 <p><b>Note:</b> Please take a picture of your returned book QR Code and Present it with your Student ID to the Librarian.</p>


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
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true">&nbspQr Code</i></h3>
        
        
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

<script type="text/javascript">
	  $(document).ready(function () {

    $('#search').DataTable();

});

$(document).ready(function(){  
      $('.borrow').click(function(){  
           var std_id = $(this).attr("id");
           $.ajax({  
                url:"../std-model/borrow.php",  
                method:"POST",  
                data:{
                    std_id:std_id
                },
                success:function(data){
                    data = $.parseJSON(data);
                     $('.form-group img').attr("src", "../student_qrcode/" + (data.code));

                    $('#borrowModal').modal("show");  
                }
           });  
      });  
 });  
</script>