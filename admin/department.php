<?php include_once 'main_head.php'; ?>
<?php include_once 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once '../model/add_dept.php'; ?>

<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        Department
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">System Maintenance</a></li>
            <li><a href="#">Department</a></li>
    	</ol>
	</section>
    <hr><hr>

    <section class="content">
    <div class="table">
            <div class="table-title">
            <h3><i class="fa fa-file-o" aria-hidden="true">&nbspList of Departments</i></h3>
                <div class="search">
                    <div class="row form-inline">
                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#addDept"><i class="fa fa-plus" aria-hidden="true"> Add Department</i></button>
                        <button class="btn btn-success" name="export" class="btn btn-success form-control">
                        <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></button>
                        <button class="btn btn-danger form-control" name="print">
                        <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
                    </div>
                </div>
            </div>  

            <table class="table table-striped table-bordered" id="search" style="margin-top: 120px;">
                  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Department</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <?php 
                    $sql = "SELECT * FROM department";
                    $result = mysqli_query($con, $sql);
                ?>
                <tbody class="table-hover">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr class="table-active" style="text-align: center;">
                        <td style = "vertical-align: middle;"><?php echo $row['ID'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Dept_Code'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Department'];?></td>
                        <td style = "vertical-align: middle;">

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
<div class="modal fade" id="addDept" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-level-up" aria-hidden="true"></i> Add Department</h4>
      </div>
        <div class="modal-body">
        <form action="" method="POST" id="next1">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Department Code:</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>

                <div class="form-group col-md-12">
                    <label for="">Department Name:</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="save" id="save" value="Save" class="form-control btn-success">
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
</script>