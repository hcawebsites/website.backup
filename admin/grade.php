<?php include_once 'main_head.php'; ?>
<?php include_once 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once '../model/section.php'; ?>
<div class="content-wrapper">
  <title>Grades</title>
	
    <section class="content-header">
    	<h1>
        	Grade
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">System Maintenance</a></li>
            <li><a href="#">Grade</a></li>
    	</ol>
	</section>
    <hr><hr>

    <section class="content">

    <div class="table">
            <div class="table-title">
            <h3><i class="fa fa-file-o" aria-hidden="true">&nbspList of Grades</i></h3>
                <div class="search">
                    <div class="row form-inline">
                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#addGrade"><i class="fa fa-plus" aria-hidden="true"> Add Grade</i></button>
                    </div>
                </div>
            </div>  

            <table class="table table-striped" id="search" style="margin-top: 120px;">
      			    <thead>
					    <tr>
						    <th scope="col">No</th>
						    <th scope="col">Grade</th>
						    <th scope="col">Department</th>
                            <th scope="col">Sections</th>
                            <th scope="col">Students</th>
                            <th scope="col">Actions</th>
					    </tr>
				    </thead>
                    <?php 
                        $sql = "SELECT * FROM grade";
                        $result = mysqli_query($con, $sql);
                    ?>
                    <tbody class="table-hover">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <tr class="table-active">
                            <td style = "vertical-align: middle;"><?php echo $row['ID'];?></td>
                            <td style = "vertical-align: middle;"><?php echo $row['Name'];?></td>
                            <td style = "vertical-align: middle;"><?php echo $row['Department'];?></td>
                            <td style = "vertical-align: middle;"><?php echo $row['Section'];?></td>
                            <td style = "vertical-align: middle;"><?php echo $row['Total_Student_Enrolled'];?></td>
                            <td style = "vertical-align: middle; text-align: center;">

                            <button class ="fa fa-trash btn btn-danger"></button>
                            
                            <button class ="fa fa-eye btn btn-success"></button>
                            </td>
                            
                        </tr>



                    <?php }?>
                    </tbody>
                </table>

            
    </div>  


    </section>
</div>
<?php include_once 'footer.php'?>

<!--- Add Grade -->
<div class="modal fade" id="addGrade" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-level-up" aria-hidden="true"></i> Add Grade</h4>
      </div>
        <div class="modal-body">
        <form action="../model/save_section.php" method="POST" id="next1">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Grade:</label>
                    <input type="text" name="grade" id="grade" class="form-control" required>
                </div>

                <div class="form-group col-md-12">
                    <label for="">Section:</label>
                    <input type="text" name="section" id="section" class="form-control">
                </div>

                <div class="form-group col-md-12">
                    <label for="">Select Department:</label>
                    <select name="dept" id="dept" class="form-control" required>
                        <option value="" disabled selected>Select Department:</option>
                        <?php
                            $get_dept = mysqli_query($con, "SELECT * FROM department");
                            while ($dept = mysqli_fetch_assoc($get_dept)) {
                        ?>
                            <option value="<?=$dept['Dept_Code']?>"><?=$dept['Department']?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <small><b>NOTE #1: </b>GRADE 1 TO 6 ELEM. DEPT</small><br>
                    <small><b>NOTE #2: </b>GRADE 7 TO 10 JHS DEPARTMENT</small><br>
                    <small><b>NOTE #3: </b>GRADE 11 TO 12 SHS DEPARTMENT</small>
                </div>
            

                <div class="form-group col-md-12">
                    <input type="submit" name="save" value="Save" class="form-control btn-success">
                </div>

            </div>
        </form>
        </div>

      </div>
  </div>
</div>

<!--- END -->

<script>

$(document).ready(function () {

$('#search').DataTable();

});//End

$(document).ready(function(){  
	$('#save').click(function(e){
        var grade = $('#grade').val();
        var grade = $('#section').val();
        var grade = $('#dept').val();

		$.ajax({
	   	url: '',
	   	data: $('#section').serialize(),
	   	method: 'POST',
	   	success: function(data) {
		
		 alert(data);
	   }

	 
	});



	});




 })
    
</script>