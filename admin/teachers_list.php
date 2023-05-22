<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Teachers List
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Teachers List</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-list-alt" aria-hidden="true">&nbspTeachers List</i></h3>

                <div class="search">
                
                    <form class="form-inline" action="../reports/teachers_list_reports.php" method="POST">
                        <div class="row">
                            <input type="hidden" name="aid" value="<?php echo $myID?>">
                            <button class="btn btn-success" name="export" class="btn btn-success form-control">
                            <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></button>

                            <button class="btn btn-danger form-control" name="print">
                            <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
                        </div>
                    </form>
                </div>               
            </div>



            <table class="table table-striped" id="search" style="color: #666666; font-size: 12px; font-weight: 500;">
                  <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Teachers ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Dept.</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody id="data" style="font-weight: 400;">
                    <?php 
                    $sql = "SELECT * from teacher_tb";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        
                    ?>
                    <tr>
                        <td style = "vertical-align: middle;"><?php echo $row['ID']; ?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Emp_ID']?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Salutation']. ". " .$row['Firstname']. " " . $row['Lastname']; ?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Email']; ?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Contact']; ?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Department']; ?></td>
                        <td>

                        <button class="form-control form-group btn btn-success teacherData" id="<?php echo $row['Emp_ID'] ?>"><i class="fa fa-eye"></i></button>
                        <button class="form-control btn btn-primary qrcode" id="<?php echo $row['Emp_ID'] ?>"><i class="fa fa-qrcode"></i></button>
                        <button class="form-control btn btn-danger"><i class="fa fa-ban"></i></button>
                       
                    
                        </td>
                    </tr>
                    <?php endwhile?>

                </tbody>
            </table>
        </div>
    </section>
    
</div>
<?php include_once 'footer.php';?>
<script>
$(document).ready(function () {

$('#search').DataTable();

});


</script>
<!-- Modal View Student -->
<div class="modal fade" id="viewTeacher" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Teacher Information</h4>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class ="form-group text-center col-md-12">
                <img id="output" class="img-rounded" src="" style="width:150px; height:150px;" />
            </div>

            <div class="form-group col-md-6">
                <label for="">Registration Date:</label>
                <input type="text" name="date" id="date" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">Teachers ID:</label>
                <input type="text" name="id" id="id" class="form-control" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="">Salutation:</label>
                <input type="text" name="salutation" id="salutation" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Lastname:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Firstname:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="">Middlename:</label>
                <input type="text" name="middlename" id="middlename" class="form-control" readonly>
            </div>

            <div class="form-group col-md-1">
                <label for="">Suffix:</label>
                <input type="text" name="suffix" id="suffix" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">DOB:</label>
                <input type="text" name="dob" id="dob" class="form-control" readonly >
            </div>

            <div class="form-group col-md-4">
                <label for="">Age:</label>
                <input type="text" name="age" id="age" class="form-control" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Gender:</label>
                <input type="text" name="gender" id="gender" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Address:</label>
                <input type="text" name="address" id="address" class="form-control" readonly>
            </div>
            
            <div class="form-group col-md-6">
                <label for="">Nationality:</label>
                <input type="text" name="nationality" id="nationality" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="">Contact:</label>
                <input type="text" name="contact" id="contact" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Email:</label>
                <input type="text" name="email" id="email" class="form-control" readonly>
            </div>

            <div class="form-group col-md-12">
                <label for="">Department:</label>
                <input type="text" name="dept" id="dept" class="form-control" readonly>
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

<div class="modal fade" id="qrcode" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Teacher QR Code</h4>
        
      </div>
      <div class="modal-body">
        <div class="row">
            <div class ="form-group text-center col-md-12">
                <img id="output" class="img-rounded" src="" style="width:250px; height:250px;" />
            </div>
            <div class ="form-group col-md-12">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

$(document).ready(function(){  
      $('.qrcode').click(function(){  
           var teacher_id = $(this).attr("id")
           $.ajax({  
                url:"view-teacher.php",  
                method:"POST",  
                data:{
					teacher_id:teacher_id 
				},
                error: function(data) {
		 	    alert("some Error");
	   	        },
	   	        success: function(data) {
                    data = $.parseJSON(data);
                    $('.form-group img').attr("src", "../T-QRCODE/" + (data.qrcode));
                    $("#qrcode").modal("show");
	            }
           });  
      });  
 })

    $(document).ready(function(){  
      $('.teacherData').click(function(){  
           var teacher_id = $(this).attr("id")
           $.ajax({  
                url:"view-teacher.php",  
                method:"POST",  
                data:{
					teacher_id:teacher_id 
				},
                error: function(data) {
		 	    alert("some Error");
	   	        },
	   	        success: function(data) {
                    data = $.parseJSON(data);
                    $('.form-group img').attr("src", "../assets/upload/" + (data.image));
                    $('#date').val(data.rdate);
                    $('#id').val(data.id);
                    $('#salutation').val(data.salutation);
                    $('#lastname').val(data.lastname);
                    $('#firstname').val(data.firstname);
                    $('#middlename').val(data.middlename);
                    $('#suffix').val(data.suffix);
                    $('#dob').val(data.dob);
                    $('#age').val(data.age);
                    $('#gender').val(data.gender);
                    $('#address').val(data.address);
                    $('#nationality').val(data.nationality);
                    $('#contact').val(data.contact);
                    $('#email').val(data.email);
                    $('#dept').val(data.dept);
                    $("#viewTeacher").modal("show");
	            }
           });  
      });  
 })
</script>