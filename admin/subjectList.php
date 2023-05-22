<?php include_once('main_head.php');?>
<?php ob_start();?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
  <title>Subjects</title>
	
    <section class="content-header">
    	<h1>
        	Subjects
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Subjects</a></li>
    	</ol>
	</section>
	<hr>

  <section class="content">

    <div class="table-master">
      <div class="table-title">
                <h3><i class="fa fa-list-alt" aria-hidden="true">&nbspSubject List</i></h3>

                <div class="search">
 
                        <div class="row form-inline">
                            <form action="../reports/subjects_report.php" method="POST">
                              <input type="hidden" name="aid" value="<?php echo $myID  ?>">
                              <button class="btn btn-success" name="excel" class="btn btn-success form-control">
                              <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></button>
                              <button class="btn btn-danger" name="print" class="btn btn-success form-control">
                              <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
                            </form>
                        </div>
                </div>               
            </div>



            <table class="table table-bordered" id="search" style="color: #666666; font-size: 13px; font-weight: 500;">
            <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Code</th>
            <th scope="col">Description</th>
            <th scope="col">Grade</th>
            <th scope="col">Department</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <?php
          $request = "SELECT * FROM subjects";
          $result = mysqli_query($con, $request);
        ?>
        <tbody class="table-hover" id="detailTable">
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
          ?>

          <tr class="table-active">
            <td style = "vertical-align: middle;"><?php echo $row['ID'];?></td>
            <td style = "vertical-align: middle;"><?php echo $row['Subject_Code'];?></td>
            <td style = "vertical-align: middle;"><?php echo $row['Description'];?></td>
            <td style = "vertical-align: middle;"><?php 
              if ($row['Level'] == "") {
                echo "TBA";
              }else{
                echo $row['Level'];
              }
            ?></td>

            <td style = "vertical-align: middle;"><?=$row['Department']?></td>


            
            <td style = "vertical-align: middle; text-align: center;">

              <button name="view" id="<?php echo $row['ID'];?>" class="btn btn-primary editSubjects">
              <i class="fa fa-pencil" aria-hidden="true"></i></button>

              <button id="<?php echo $row['ID'];?>" class="btn btn-success viewSubjects">
              <i class="fa fa-eye" aria-hidden="true"></i></button>

              <button class="btn-danger form-control" id="delete"><i class="fa fa-trash"></i></button>
            </td>
          </tr>



        <?php }?>
        </tbody>




      </table>

        </div>
		
		</section>

</div>
<?php include_once 'footer.php'; ?>
<!-- Search JS-->

<script>
  $(document).ready(function () {

    $('#search').DataTable();

});
</script>
<!-- End of Search -->

<!-- view Subject Modal -->
<div class="modal fade" id="viewSubject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true"></i> View Subject</h3>
      </div>

      <form action="#" method="POST">
        <div class="modal-body">
          <div class="row">

            <div class="form-group col-md-6">
              <label for="">Code:</label>
              <input type="text" id="code" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
              <label for="">Title:</label>
              <input type="text" id="title" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
              <label for="">Level:</label>
              <input type="text" id="level" class="form-control" readonly>
            </div>

            <div class="form-group col-md-6">
              <label for="">Department:</label>
              <input type="text" id="dept" class="form-control" readonly>
            </div>

          </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"> Close</i>
                </button>
            </div>
        </div>
            
      </form>

      
    </div>  
  </div>
</div>
<!--End of Modal -->

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h3 class="modal-title"><i class="fa fa-book" aria-hidden="true"></i> Edit Subject</h3>
      </div>

      <form action="" id="edit-form" method="POST">
        <div class="modal-body">
          <div class="row">

            <input type="hidden" name="id1" id="id1">

            <div class="form-group col-md-6">
              <label for="">Code:</label>
              <input type="text" name="code1" id="code1" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label for="">Title:</label>
              <input type="text" name="title1" id="title1" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label for="">Level:</label>
              <input type="text" name="level1" id="level1" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label for="">Department:</label>
              <input type="text" name="dept1" id="dept1" class="form-control">
            </div>

          </div>

            <div class="modal-footer">

                <button type="button" id="edit" type="button" class="btn btn-warning">
                <i class="fa fa-pencil" aria-hidden="true">&nbspEdit</i>
                </button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"> Close</i>
                </button>
            </div>
        </div>
            
      </form>

      
    </div>  
  </div>
</div>
<!--End of Modal -->

<script>

 $(document).ready(function(){  
     $('#edit').click(function(){
         $.ajax({
             url: "../model/editSubject.php",
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
      $('.viewSubjects').click(function(){  
           var subject_id = $(this).attr("id")
           $.ajax({  
                url:"view_subjects.php",  
                method:"POST",  
                data:{
          subject_id:subject_id 
        },
                error: function(data) {
          alert("some Error");
              },
              success: function(data) {
                    data = $.parseJSON(data);
                    
                    $('#code').val(data.code);
                    $('#title').val(data.title);
                    $('#level').val(data.level);
                    $('#dept').val(data.dept);
                    $("#viewSubject").modal("show");
              }
           });  
      });  
 })

  $(document).ready(function(){  
      $('.editSubjects').click(function(){  
           var subject_id = $(this).attr("id")
           $.ajax({  
                url:"view_subjects.php",  
                method:"POST",  
                data:{
          subject_id:subject_id 
        },
                error: function(data) {
          alert("some Error");
              },
              success: function(data) {
                    data = $.parseJSON(data);
                    $('#id1').val(subject_id);
                    $('#code1').val(data.code);
                    $('#title1').val(data.title);
                    $('#level1').val(data.level);
                    $('#dept1').val(data.dept);
                    $("#editSubject").modal("show");
              }
           });  
      });  
 })
</script>