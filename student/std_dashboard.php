<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');

$sql="SELECT count(id) FROM student";
$total_count1=0;
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$total_count=$row['count(id)'];

$myID = $_SESSION['username'];

;?>

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
  <section class="content">
    <div class="row">
      
      <div class="col-md-3 mb-4 h1">
        <div class="cards">
        <a href="#">
          <div class="card-body">
              <div>
                <?php

                  $sql = "SELECT count(Distinct Code) as count FROM student_grade inner join handle_student on student_grade.Student_ID = handle_student.Student_ID inner join schedule on handle_student.Sched_ID = schedule.ID WHERE student_grade.Student_ID = '$myID'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count'];
                  ?>
                  <p><?=$total_count?></p>
                  
                
                <span>My Subjects</span>
              </div>

              <div>
                  <span class="fa fa-book"></span>
              </div>
          </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 mb-4 h1">
        <div class="cards">
        <a href="#">
          <div class="card-body">
              <div>
                <?php 
                  $sql = "SELECT count(*) FROM student_grade inner join student on student_grade.Student_ID = student.Student_ID ";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(*)'];
                  ?>
                  <p><?=$total_count?></p>
                  
                
                <span>Students</span>
              </div>

              <div>
                  <span class="fa fa-graduation-cap"></span>
              </div>
          </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 mb-4 h1">
        <div class="cards">
        <a href="#">
          <div class="card-body">
              <div>
                <?php 
                  $sql = "SELECT count(*) FROM borrow_books Where Borrowers_ID = '$myID' AND Status = 1";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(*)'];
                  ?>
                  <p><?=$total_count?></p>
                  
                
                <span>Borrow Books</span>
              </div>

              <div>
                  <span class="fa fa-book"></span>
              </div>

          </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 mb-4 h1">
        <div class="cards">
        <a href="#">
          <div class="card-body">
              <div>
                <?php 
                  $sql = "SELECT count(*) FROM teacher_tb";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(*)'];
                  ?>
                  <p><?=$total_count?></p>
                  
                
                <span>Teachers</span>
              </div>

              <div>
                  <span class="fa fa-user"></span>
              </div>
          </div>
          </a>
        </div>
      </div>
      <?php  
        $_get = mysqli_query($con, "SELECT *, concat(Salutation, '. ', Firstname, ' ', Lastname) as adviser FROM handle_student inner join schedule on handle_student.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join time on schedule.Time_ID = time.time_id WHERE handle_student.Student_ID = '$myID'");
        while ($_row = mysqli_fetch_assoc($_get)) {
          $days = explode(',', $_row['Day']);
          $sched_id = $_row['Sched_ID'];
          $dept = $_row['Department'];
          if ($dept == "SHSDEPT") {
           ?>
             <div class="col-md-3 mb-4">
              <div class="cards">
              <a href="#">
                <div class="card-body">
                  <div>
                    <p style="color: #34eb52; font-weight:500;"><?php echo $_row['Description']  ?></p>
                    <p style="color:#5c5c5c; font-weight: 400; font-size: 18px;"><?php echo $_row['Code']  ?></p>
                    <hr>

                    <p>Days: <?php echo implode(' | ', $days);?></p>
                    <p>Time: <?php echo $_row['time_start']. " - " .$_row['time_end'];?></p>
                    <p> 
                      <?php  
                        if ($_row['Room'] == "Online") {
                          $_get_code = mysqli_query($con, "SELECT * FROM classroom inner join handle_student on classroom.Sched_ID = handle_student.Sched_ID WHERE  classroom.Sched_ID = '$sched_id' AND handle_student.Student_ID = '$myID'");
                          while ($_code = mysqli_fetch_assoc($_get_code)) {
                            echo "<i class='fa fa-google'></i> GC Code: ". $_code['Code'];
                          }
                        }else{
                          echo "Room: ". $_row['Room'];
                        }
                      ?>
                    </p>
                    <hr>
                    <p style="color: #666666; font-size: 16px; font-weight: 500;">Adviser: <?php echo $_row['adviser']  ?></p>

                    <button type="button" id="<?php echo $sched_id.','.$myID?>" class="btn btn-primary form-control view-grade">View Grade</button>
                  </div>
                </div>
              </a>
            </div>
            </div>
           <?php  
         }else{
           ?>
           <div class="col-md-3 mb-4">
              <div class="cards">
                <a href="#">
                  <div class="card-body">
                    <div>
                      <p style="color: #34eb52; font-weight:500;"><?php echo $_row['Description']  ?></p>
                      <p style="color:#5c5c5c; font-weight: 400; font-size: 18px;"><?php echo $_row['Code']  ?></p>
                      <hr>

                      <p>Days: <?php echo implode(' | ', $days);?></p>
                      <p>Time: <?php echo $_row['time_start']. " - " .$_row['time_end'];?></p>
                      <p> 
                        <?php  
                          if ($_row['Room'] == "Online") {
                            $_get_code = mysqli_query($con, "SELECT * FROM classroom inner join handle_student on classroom.Sched_ID = handle_student.Sched_ID WHERE  classroom.Sched_ID = '$sched_id' AND handle_student.Student_ID = '$myID'");
                            while ($_code = mysqli_fetch_assoc($_get_code)) {
                              echo "<i class='fa fa-google'></i> GC Code: ". $_code['Code'];
                            }
                          }else{
                            echo "Room: ". $_row['Room'];
                          }
                        ?>
                      </p>
                      <hr>
                      <p style="color: #666666; font-size: 16px; font-weight: 500;">Adviser: <?php echo $_row['adviser']  ?></p>

                      <button type="button" id="<?php echo $sched_id.','.$myID?>" class="btn btn-primary form-control std_view-grade">View Grade</button>
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

<div class="modal fade" id="shs-grade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <p class="modal-title" id="title" style="color: #34eb52; font-size:20px; font-weight: 500;"></p>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <p>Prelim Grade</p>
            <input id="prelim" class="form-control" readonly>
          </div>

          <div class="col-md-4">
            <p>Midterm Grade</p>
            <input id="midterm" class="form-control" readonly>
          </div>

          <div class="col-md-4">
            <p>Tentative Final Grade</p>
            <input id="final" class="form-control" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="std-grade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <p class="modal-title" id="_title" style="color: #34eb52; font-size:20px; font-weight: 500;"></p>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <p>1st Grading</p>
            <input id="first" class="form-control" readonly>
          </div>

          <div class="col-md-6">
            <p>2nd Grading</p>
            <input id="second_" class="form-control" readonly>
          </div>

          <div class="col-md-6">
            <p>3rd Grading</p>
            <input id="third" class="form-control" readonly>
          </div>

          <div class="col-md-6">
            <p>Tentative Final Grade</p>
            <input id="fourth" class="form-control" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once 'footer.php'; ?>
<div class="row" id="fProfile">
<script type="text/javascript">
  $(document).ready(function(){
    $('.view-grade').click(function(){
      start_load()
      var sched_id = $(this).attr("id");

      $.ajax({
        url: "shs_view-grade.php",
        method: "POST",
        data:{
          sched_id:sched_id
        },
        success:function(data) {
          data = $.parseJSON(data);
            $('#shs-grade').modal('show');
            $('#title').html(data.description);
            $('#prelim').val(data.prelim);
            $('#midterm').val(data.midterm);
            $('#final').val(data.final);
            end_load();
          
        }
      })

    })

    $('.std_view-grade').click(function(){
      start_load()
      var sched_id = $(this).attr("id");

      $.ajax({
        url: "std_view_grade.php",
        method: "POST",
        data:{
          sched_id:sched_id
        },
        success:function(data) {
         data = $.parseJSON(data);
            $('#std-grade').modal('show');
            $('#_title').html(data.description);
            $('#first').val(data.first);
            $('#second_').val(data.second);
            $('#third').val(data.third);
            $('#fourth').val(data.fourth);
            end_load();
          
        }
      })

    })
  })
</script>
    