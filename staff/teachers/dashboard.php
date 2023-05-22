<?php
include_once '../../database/connection.php';
include_once('main_head.php');
include_once('header.php'); 
include_once('sidebar.php'); 
?>

<div class="content-wrapper">
	
    <section class="content-header">
    	<h1>
        	Dashboard
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
    	</ol>
	</section>
    <hr>
	 <section class="content">
      <div class="row">
        <?php
        $myID = $_SESSION['emp_id'];
          $_get = mysqli_query($con, "SELECT *, schedule.ID FROM schedule inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join time on schedule.Time_ID = time.time_id Where schedule.Teacher_ID = '$myID'");
          while ($_row = mysqli_fetch_assoc($_get)) {
            $days = explode(',', $_row['Day']);
            $sched_id = $_row['ID'];
            $_dept = $_row['Department'];

            if ($_dept == "SHSDEPT") {
              ?>
              <div class="col-md-3 mb-4 form-group">
                <div class="cards">
                  <a href="std_per_subject.php?sched_id=<?php echo $sched_id  ?>">
                  <div class="card-body">
                    <div>
                      <p style="color: #34eb52; font-weight:500;"><?php echo $_row['Description']  ?></p>
                      <p style="color:#5c5c5c; font-weight: 400; font-size: 18px;"><?php echo $_row['Code']  ?></p>
                      <hr>

                      <p>Days: <?php echo implode(' | ', $days);?></p>
                      <p>Time: <?php echo $_row['time_start']. " - " .$_row['time_end'];?></p>
                      <p>Class: <?php echo $_row['Name']. " - " . $_row['Section']?></p>
                      <p>Strand: <?php echo $_row['Strand']?></p>
                      <p> 
                        <?php  
                          if ($_row['Room'] == "Online") {
                            $_get_code = mysqli_query($con, "SELECT *, classroom.Code FROM classroom inner join schedule on classroom.Sched_ID = schedule.ID WHERE schedule.Teacher_ID = '$myID' AND classroom.Sched_ID = '$sched_id'");
                            while ($_code = mysqli_fetch_assoc($_get_code)) {
                              echo "<i class='fa fa-google'></i> GC Code: ". $_code['Code'];
                            }
                          }else{
                            echo "Room: ". $_row['Room'];
                          }
                        ?>
                      </p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            
              <?php
            }else{
              ?>
                <div class="col-md-3 mb-4 form-group">
                  <div class="cards">
                    <a href="std_per_subject.php?sched_id=<?php echo $sched_id  ?>">
                    <div class="card-body">
                      <div>
                        <p style="color: #34eb52; font-weight:500;"><?php echo $_row['Description']  ?></p>
                        <p style="color:#5c5c5c; font-weight: 400; font-size: 18px;"><?php echo $_row['Code']  ?></p>
                        <hr>

                        <p>Days: <?php echo implode(' | ', $days);?></p>
                        <p>Time: <?php echo $_row['time_start']. " - " .$_row['time_end'];?></p>
                        <p>Class: <?php echo $_row['Name']. " - " . $_row['Section']?></p>
                        <p> 
                          <?php  
                            if ($_row['Room'] == "Online") {
                              $_get_code = mysqli_query($con, "SELECT *, classroom.Code FROM classroom inner join schedule on classroom.Sched_ID = schedule.ID WHERE schedule.Teacher_ID = '$myID' AND classroom.Sched_ID = '$sched_id'");
                              while ($_code = mysqli_fetch_assoc($_get_code)) {
                                echo "<i class='fa fa-google'></i> GC Code: ". $_code['Code'];
                              }
                            }else{
                              echo "Room: ". $_row['Room'];
                            }
                          ?>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            
              <?php
            }
          }
        ?>
        
      </div>
  </section>

</div>
<?php include_once('../footer.php');?>