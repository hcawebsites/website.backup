<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); 

$myID = $_SESSION['student_id'];
?>

<div class="content-wrapper">
<section class="content-header" style="display: flex; justify-content: space-between;">
    	<h1>
        	Classroom
        	<small>Preview</small>
            
        </h1>
        
        <div style="margin-left: 55px;"><a href="" data-toggle="modal" data-target="#joinModal" title="Create Classroom"><img src="../assets/image/plus.png" alt="" width="30px"></a></div>
        <div></div>
        <div></div>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classroom</a></li>
    	</ol>  
	</section>
    <hr>

    <section class="content">
        <div class="row">
            <?php 
                $sql1 = mysqli_query($con, "SELECT *, classroom.Code as code  FROM classroom inner join joinclass on classroom.Code = joinclass.Code inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id WHERE joinclass.Student_ID = '$myID'");
                if (mysqli_num_rows($sql1) > 0) {
                    while ($row = mysqli_fetch_assoc($sql1)) {
                        $time = date("h:i a", strtotime($row['time_start'])). " - " .date("h:i a", strtotime($row['time_end']));
                    if ($row['Department'] == "SHSDEPT") {
                      echo '<a href="room.php?code='.$row['code'].'" ><div class="col-md-4 h5">
                    <div class="cards"  style="background-color: #fff; color: #333;">
                    <h4>'.$row['Subject_Code'].'</h4>
                    <br>
                    <h4>'.$row['Description'].'</h4>
                    <p>'.$row['Name']. " ". $row['Strand']. ' - '.$row['Section'].'</p>
                    
                    <p>'.$row['Salutation'].'. '.$row['Firstname'].' '.$row['Lastname'].'</p>
                    <p>'.$row['Day'].'</p>
                    <p>'.$time.'</p>
                
                    
                    </div>
                    </div></a>';
                    }else{
                      echo '<a href="room.php?code='.$row['code'].'" ><div class="col-md-4 h5">
                      <div class="cards"  style="background-color: #fff; color: #333;">
                      <h4>'.$row['Subject_Code'].'</h4>
                      <br>
                      <h4>'.$row['Description'].'</h4>
                      <p>'.$row['Name'].' - '.$row['Section'].'</p>
                      
                      <p>'.$row['Salutation'].'. '.$row['Firstname'].' '.$row['Lastname'].'</p>
                      <p>'.$row['Day'].'</p>
                      <p>'.$time.'</p>
                  
                      
                      </div>
                      </div></a>';
                    }
                    }
                  }
            
            ?>
        </div>
    </section>

</div>

<div class="modal fade" id="joinModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-chrome" aria-hidden="true"></i>&nbspJoin Class?</h4>
      </div>
      <div class="modal-body">
        <form action="../std-model/joinclass.php" method="POST">
            <div class="col md-12">
                <label for="">Enter Classroom Code:</label>
                <input type="hidden" name="myID" id="myID" value="<?=$myID?>" class="form-control" required>
                <input type="text" name="classCode" id="classCode" class="form-control" maxlength="8" required>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="joinclass" class="btn btn-primary">Join Class</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include_once('footer.php'); ?>