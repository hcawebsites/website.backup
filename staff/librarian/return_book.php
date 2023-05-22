<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../../database/connection.php');?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Return Books
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Return Books</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
		  
                <div class="row">
                    <div class="form-group col-md-5 text-center">
                        <div class="camera" style="position: relative; display: flex; justify-content: center; align-items: center; padding: 1rem 1rem 1rem 1rem; border-radius: 10px;">
                            
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
                            <form id="return-form" action="">
                                <label>International Standard Book Number:</label>
                                <input type="text" name="isbn" id="isbn" class="form-control">

                                <label>Title:</label>
                                <input type="text" name="title" id="title" class="form-control">

                                <label>Author:</label>
                                <input type="text" name="auth" id="auth" class="form-control">

                                <label>Borrowed Date:</label>
                                <input type="text" name="borrow" id="borrow" class="form-control">

                                <label>Return Date:</label>
                                <input type="date" name="return" id="return" class="form-control">
                                <hr>
                                <h3 style="color:red;">Borrowers Information</h3>

                                <label>Borrowers ID:</label>
                                <input type="text" name="borrowersID" id="borrowersID" class="form-control">

                                <label>Borrowers Name:</label>
                                <input type="text" name="name" id="name" class="form-control">

                                <label>Borrowers Contact:</label>
                                <input type="number" name="contact" id="contact" class="form-control">
                                <hr>
                                <button type="button" style="display:none;" id="save" class="btn btn-success form-control">Returned Book</button>
                                <div class="col-md-12"></div>
                                <div class="col-md-12"></div>
                                <button  class="btn btn-danger form-control">Cancel Transaction</button>
                            </form>
                        </div>
                    </div>
                    
                </div>      
          
        </div>
    </section>
    
</div>
<?php include_once '../footer.php';?>

<script>
   let scanner = new Instascan.Scanner({video: document.getElementById('scan')});
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        }
        else{
            alert("No Camera Found!");
        }
    }).catch(function(e){
        console.error(e);
    });


    $(document).ready(function(){  
        scanner.addListener('scan', function(c) {
            var std_id = c;
            $.ajax({
                url: "return_data.php",
                method: "POST",
                data:{
                    std_id:std_id
                },
                success:function(data) {
                   data = $.parseJSON(data);
                   $('#isbn').val(data.id);
                   $('#title').val(data.title);
                   $('#auth').val(data.author);
                   $('#borrow').val(data.borrow);

                   $('#borrowersID').val(data.borrowersID);
                   $('#name').val(data.fullname);
                   $('#contact').val(data.contact);
                   document.getElementById('alert').style.display = 'block';
                   document.getElementById('save').style.display = 'block';
                }
            })


    });

    $('#save').click(function(){
        start_load();
        $.ajax({
            url: "../../staff-model/save_return.php",
            method: "POST",
            data: $('#return-form').serialize(),
            success:function(data){
                let type = 'info';
                let title = 'Data successfully saved.';
                createToast(type, title);
            },
            complete:function(){
                end_load();
                
                window.location.href = 'start.php';
                finish();
            }
        })
    })

})

</script>