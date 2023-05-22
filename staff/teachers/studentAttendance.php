<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Student Attendance
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">Student Attendance</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
		  
                <div class="row">
                    <div class="form-group col-md-5 text-center">
                        <div class="camera" style="position: relative; display: flex; justify-content: center; align-items: center; background-color: #C0C4BF;
                        padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">
                            
                                    <video id="scan"  width="100%"></video>

                        </div>
                         <h4 style="color:blue;">Scan Qr Code Here!</h4>
                        <hr>
                        <div class="alert alert-success" id="alert" style="display: none;" role="alert">
                               Record Found!
                        </div>

                        

                       
                    </div>

                    <div class="form-group col-md-7">
                        <div class="book-info">
                            <form method="POST" action="../model/borrowBooks.php">
                            <h2 style="color:red;">Student Information</h2>
                                <input type="hidden" name="id" id="id">
                                <label>Student ID:</label>
                                <input type="text" name="isbn" id="isbn" class="form-control">

                                <label>Name:</label>
                                <input type="text" name="title" id="title" class="form-control">

                                <label>Grade:</label>
                                <input type="text" name="auth" id="auth" class="form-control">

                                <label>Section:</label>
                                <input type="text" name="publish" id="publish" class="form-control">

                                <label>Strand:<small>[For SHS Only]</small></label>
                                <input type="text" name="publish" id="publish" class="form-control">

                                <label>Time In:</label>
                                <input type="text" name="publish" id="publish" class="form-control">
                                <hr>

                                <button style="display:none;" id="save" name="save" class="btn btn-success form-control">Save</button>
                            </form>
                            <a href="list_of_returned_book.php"  class="btn btn-danger form-control">Cancel Transaction</a>
                        </div>
                    </div>
                    
                </div>      
          
        </div>
    </section>
    
</div>
<?php include_once '../footer.php';?>
