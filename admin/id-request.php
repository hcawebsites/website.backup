<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php')?>
<div class="content-wrapper">
  <title>ID Request</title>
	
    <section class="content-header">
    	<h1>
        	ID Request
        	<small>Preview</small>
      </h1>

        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">ID Request</a></li>
    	</ol>
      <hr>
	</section>

    <section class="content">
        <hr>
    
        <div id="table-header">
            <i class="fa fa-book"> <b>LIST OF ID REQUEST</b></i>
        </div>
        <div id="table-content">
            
            <table class="table table-bordered" id="search">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">ID Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Guardian</th>
                        <th scope="col">Contact</th>
                        <th class="col">Status</th>
                        <th scope="col">Date Request</tth>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * From id_request";
                    $result = mysqli_query($con, $sql);
                    while ($row=mysqli_fetch_assoc($result)):
                        $date = $row['Date_Request'];
                        $newdate = strtotime($date);
                    ?>
                        <tr class="table-active">
                            <td><?=$row['ID']?></td>
                            <td><?=$row['ID_Number']?></td>
                            <td><?=$row['Firstname'], " ", $row['Lastname']?></td>
                            <td><?=$row['Guardian']?></td>
                            <td><?=$row['Contact']?></td>
                            <td>
                                <?php
                                    if ($row['Status'] == 1) {
                                        echo "<p class='badge badge bg1'>To Process</p>";
                                    }else{
                                        echo "<p class='badge badge bg2'>Finish</p>";
                                    }
                                ?>
                            </td>
                            <td><?= date('M d Y', $newdate)?></td>
                            <td>
                                <?php
                                    if ($row['Status'] == 1) {
                                        echo "<button class='btn btn-success'>View</button>";
                                        echo "<button class='btn btn-info' data-toggle='modal' data-target='#generate'>Generate ID</button>";
                                        
                                    }else{
                                        echo "<button class='btn btn-success'>View</button>";
                                    }
                                ?>
                            </td>
                        </tr>

                    <?php endwhile ?>
                </tbody>
            </table>

        </div>
    </section>
</div>
<?php include_once 'footer.php'; ?>

<!-- Modal Generate ID -->
<div class="modal fade" id="generate" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-times"></i></button>
        <h3 class="modal-title">Generate ID</h3>
      </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM id_format";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($res)):
                            $template_code = $row['Code'];
                        ?>
                        <div class="col-md-12">
                            <div id="back">
                               <div class="col-md-8">

                                    <div class="form-group col-md-12">
                                        <label for="">Date Request:</label>
                                        <input type="text" id="date" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">ID Number:</label>
                                        <input type="text" id="idnumber" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">LRN:</label>
                                        <input type="text" id="lrn" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Firstname:</label>
                                        <input type="text" id="fname" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Middlename:</label>
                                        <input type="text" id="mname" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Lastname:</label>
                                        <input type="text" id="lname" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Suffix:</label>
                                        <input type="text" id="suffix" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Guardian:</label>
                                        <input type="text" id="gname" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Contact:</label>
                                        <input type="text" id="phone" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Qr Code Name:</label>
                                        <input type="text" id="qrcode" readonly class="form-control">
                                    </div>

                                    <div class="form-group col-md-12">
                                    <p><b>Note: </b>Please Find The QR Code in Folder HCAMIS - Assets - Qr Code!</p>
                                </div>
                               </div>

                               <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                         <?php echo $template_code ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        
                                    </div>
                               </div>
                            </div>

                            
                        </div>
                        <?php endwhile?>
                    </div>
                    <input type="file" id="upload" data-id="" onchange="displayImg(this,$(this))" class="hide">
                </form>
            </div>           
        <div class="modal-footer">
        <button type="button" class="btn btn-primary">Generate</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
				var id = _this.attr('data-id')
				console.log(id)
	        	$('img[data-id="'+id+'"]').attr('src',e.target.result);
				_this.attr('data-id','')
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    $(document).ready(function(){
        $('.field-item[data-type="textfield"]').each(function(){
				$(this).attr('contenteditable',true)
			})
			$('.field-item[data-type="imagefield"]').each(function(){
				$(this).click(function(){
					$('#upload').attr('data-id',$(this).attr('id'))
					$('#upload').trigger('click')
				})
			})

    })
</script>

<style>
    #back{
		background: #82f5a8;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 0;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 20px;

	}
    

    .content #table-header{
        border: 1px solid #fad4f5;
        padding: 5px 12px;
        background: #fce6f9;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        font-size: 16px;
    }

    .content #table-content{
        border: 1px solid #fad4f5;
        padding: 5px 12px;
        background: #fff;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #table-content tbody{
        vertical-align: middle;
        text-align: center;
        cursor: context-menu;
    }

    #table-content .bg1{
        background: #a4dff5;
        color: black;
        
    }

    #table-content .bg2{
        background: green;
        
    }

    #table-content button{
        margin-left: 12px;
        
    }

    #id-card-field{
		width:2.5in;
		height:3.5in;
		position:relative;
		background:#fff;
	}
	#id-card-field .field-item{
		position:absolute;
		margin: 3px 5px;
	}
	#id-card-field .field-item.focus::before{
		content:"0";
		position:relative;
		width:100%;
		height:100%;
		border: 1px pink;
	}
	#id-card-field .field-item[data-type="textfield"]{
		padding:3px 5px;
	}
	#id-card-field .field-item.img{
		width:50px;
		height:50px;
	}
	#id-card-field .field-item[data-type="image"]{
		cursor:pointer;
	}
	#id-card-field .field-item>img{
		width:100%;
		height:100%;
		object-fit:fill;
		object-position:center center;
	}
	.remove_field{
		cursor:pointer;
	}
</style>

<script>
    $(document).ready(function () {
    $('#search').DataTable();
    });//End
</script>