<?php include_once 'main_head.php'; ?>
<?php include_once 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once '../model/save_strand.php'; ?>

<div class="content-wrapper">
  <title>Strand</title>
	
    <section class="content-header">
    	<h1>
        	Strands
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">System Maintenance</a></li>
            <li><a href="#">Strands</a></li>
    	</ol>
	</section>
    <hr><hr>

    <section class="content">
    <div class="table">
            <div class="table-title">
            <h3><i class="fa fa-file-o" aria-hidden="true">&nbspList of Strands</i></h3>
                <div class="search">
                    <div class="row form-inline">
                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#addStrand"><i class="fa fa-plus" aria-hidden="true"> Add Strand</i></button>
                    </div>
                </div>
            </div>  

            <table class="table table-striped" id="search" style="margin-top: 120px;">
                  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Title</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Section</th>
                        <th scope="col">Students</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <?php 
                    $sql = "SELECT *, strands.ID as id FROM strands inner join grade on strands.Grade = grade.Name";
                    $result = mysqli_query($con, $sql);
                ?>
                <tbody class="table-hover">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr class="table-active">
                        <td style = "vertical-align: middle;"><?php echo $row['id'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Strands'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Description'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Grade'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Section'];?></td>
                        <td style = "vertical-align: middle;"><?php echo $row['Total_Students_Enrolled'];?></td>
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
<div class="modal fade" id="addStrand" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"><i class="fa fa-level-up" aria-hidden="true"></i> Add Strand</h4>
      </div>
        <div class="modal-body">
        <form action="" method="POST" id="next1">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Code:</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>

                <div class="form-group col-md-12">
                    <label for="">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>

                <?php 
                $sql = "SELECT Name From grade WHERE Department = 'SHSDEPT'";
                $result = mysqli_query($con, $sql);
                ?>
                
                <div class="form-group col-md-12">
                    <label for="">Select Grade:</label>
                    <select name="grade" id="grade" class="form-control" required>
                        <option value="" disabled selected>Select Grade</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></option>
                        <?php
                    }?>
                    </select>
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