<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');
$myID = $_SESSION['username'];?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	BMI Record
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Clinic</a></li>
            <li><a href="#">BMI Record</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table">
			<div class="table-title">
                <h3><i class="fa fa-file" aria-hidden="true"><b>&nbspBMI Record</b></i></h3>

                <div class="search">
                        <div class="row form-inline">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addBMI" class="btn btn-success form-control">
                            <i class="fa fa-plus" aria-hidden="true">&nbspAdd Body Mass Index </i></button>
                        </div>
                </div>
            </div>

            <table class="table table-bordered" id="search">
                  <thead>
                    <tr>
                        
                        <th scope="col">Student ID</th>
                        <th scope="col">Height</th>
                        <th scope="col">Weight</th>
                        <th scope="col">BMI</th>
                        <th scope="col">Illness</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody id="data" class="text-center">
                    <?php 
                    $sql = "SELECT * FROM student_BMI WHERE Student_ID = '$myID'";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        
                    ?>
                    <tr>
                    <td style = "vertical-align: middle;"><?=$row['Student_ID']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Height']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Weight']?></td>
                    <td style = "vertical-align: middle;"><?=$row['BMI']?></td>
                    <td style = "vertical-align: middle;"><?=$row['History_Illness']?></td>
                    <td style = "vertical-align: middle;">

               		<button class ="fa fa-trash btn btn-danger"></button>
                            
                    <button class ="fa fa-edit btn btn-success"></button>
                  </td>
                    </tr>
                    <?php endwhile?>

                </tbody>
            </table>
        </div>
    </section>
    
</div>

<div class="modal fade" id="addBMI" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-calculator" aria-hidden="true">&nbspAdd Body Mass Index</i></h3>
        
        
      </div>
      <div class="modal-body">
      <form action="../std-model/add_student_bmi.php" method="post">
              <div class="row">
                <div class="col-md-6">
                    <label for="">Student ID:</label>
                    <input type="hidden" name="id" id="id" value="<?=$myID?>" class="form-control" required>
                </div>
                
                <div class="col-md-12">
                    <label for="">Height:</label>
                    <input type="text" name="height" placeholder="eg. 1.56" id="height" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="">Weight:</label>
                    <input type="text" name="weight" id="weight" onkeyup="index(this.value)" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label for="">Body Mass Index:</label>
                    <input type="text" name="bmi" id="bmi" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="">History of Illness:</label>
                    <input type="text" name="illness" id="illness" class="form-control" required>
                </div>
              </div>
      </div>
        <div class="modal-footer">
            <input type="submit" name="save" class="btn btn-primary" value="Save"></input>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php include_once 'footer.php';?>

<script>
    $(document).ready(function () {
        $('#search').DataTable();
})


$(document).ready(function(){  
    $("#weight").keyup(function(){  
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var height1 = height * height;
        var bmi = weight / height1;
        var decimal = bmi.toFixed(2);
            $("#bmi").val(decimal);
            
    }); 
});  




</script>