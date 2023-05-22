<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php')?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Student Record
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Student Record</a></li>
    	</ol>
	</section>
    <hr><hr>
    <section class="content">
    <div class="table">
            <div class="table-title">
                <h3><i class="fa fa-file-text-o" aria-hidden="true">&nbspStudent Record</i></h3>

                <div class="search">
                    <form action="../reports/guidance_report.php" method="POST">
                      <input type="hidden" name="staff_id" value="<?php echo $myID  ?>">
                        <button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>

                        <button type="submit" name="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
                    </form>
                
                </div>
            </div>
            
        <table class="table table-striped" id="search">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Violation</th>
                            <th scope="col"># Offense</th>
                            <th scope="col">Punishment</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php 
                        $sql = "SELECT * FROM guidance";
                        $result = mysqli_query($con, $sql);
                    ?>
                    <tbody class="table-hover" id="detailTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['Date'];
                        $newdate = date("M d Y", strtotime($date));
                        
                    ?>
                    <tr class="table-active" style="text-align: center;">
                    <td style = "vertical-align: middle;"><?=$row['ID']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Name']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Violation']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Offense']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Punishment']?></td>
                    <td style = "vertical-align: middle;"><?=$newdate?></td>
                    <td style = "vertical-align: middle;">
                    <?php 
                        if ($row['Status'] == '1') {
                            echo '<p class="btn btn-info">Not Resolve</p>';
                        }else{
                            echo '<p class="btn btn-success">Resolve</p>';
                        }
                    
                    ?>
                    </td>
                    <td style = "vertical-align: middle;" class="form-inline">
                    
                    <button class="btn btn-primary form-control edit" id="<?php echo $row['ID'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button class="btn btn-danger form-control btnDelete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <button class="btn btn-warning form-control resolved" id="<?php echo $row['ID'];?>" ><i class="fa fa-check" aria-hidden="true"></i></button>
                
                    </td>
                
                    </tr>



                    </tbody>



                    <?php endwhile?>
                </table>
        </div>

    </section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true">&nbspAdd Student Record</i></h3>
        
        
      </div>
      <div class="modal-body">
      <form action="" id="guidance-form" method="post">
              <div class="row">
                <input type="hidden" name="id1" id="editID" class="form-control">
                <div class="col-md-6">
                    <label for="">Student ID:</label>
                    <input type="text" name="id" id="studentID" class="form-control">
                </div>

                <div class="col-md-6 ">
                    <label for="">Name:</label>
                    <input type="text" name="name" id="fname" class="form-control">
                </div>
                
                <div class="col-md-12">
                    <label for="">Violation:</label>
                    <input type="text" name="violation" id="vviolation" class="form-control">
                </div>

                <div class="col-md-12">
                    <label for=""># Offense:</label>
                    <input type="text" name="offense" id="ooffense" placeholder="e.g 1st-3rd Offense" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="">Punishment:</label>
                    <input type="text" name="punishment" id="ppunishment" class="form-control">
                </div>
              </div>
      </div>
        <div class="modal-footer">
            <input type="button" name="saveEdit" id="saveEdit" class="btn btn-primary" value="Save"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-trash" aria-hidden="true">&nbspDelete Confirmation</i></h3>

      </div>
      <div class="modal-body">
      <form action="../model/delete_student_guidance_record.php" method="post">
                <input type="hidden" name="deleteID" id="deleteID" class="form-control">
                <p>Are you sure you want to <b>DELETE</b> this Record?</p>  
      </div>
        <div class="modal-footer">
            <input type="submit" name="btnDelete" class="btn btn-danger" value="Delete"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<?php include_once 'footer.php'; ?>
<script>

  $(document).ready(function () {

    $('#search').DataTable();

});

$(document).ready(function(){  
    $('.resolved').click(function(){
        var id = $(this).attr("id");
        $.ajax({
            url: "../model/guidanceResolved.php",
            method: "POST",
            data:{
                id:id
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
    $('#saveEdit').click(function(){
        $.ajax({
            url: "../model/edit_student_guidance_record.php",
            method: "POST",
            data: $('#guidance-form').serialize(),
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
      $('.edit').click(function(){  
           var id = $(this).attr("id")
           $.ajax({  
                url:"view_guidance_record.php",  
                method:"POST",  
                data:{
					id:id 
				},
                success:function(data){
					data = $.parseJSON(data);
                    $('#editID').val(data.id);
           			$('#studentID').val(data.student_id);
                    $('#fname').val(data.name);
                    $('#vviolation').val(data.violation);
                    $('#ooffense').val(data.offense);
                    $('#ppunishment').val(data.punishment);
                     $('#editModal').modal("show");  
                }  
           });  
      });  
 });  

 $(document).ready(function () {
      $('.btnDelete').on('click', function() {
        
        $('#deleteModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();

        console.log(data);
        $('#deleteID').val(data[0]);
      });
    });


</script>