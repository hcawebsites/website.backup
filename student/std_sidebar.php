 <aside class="main-sidebar">

    <section class="sidebar">
<?php

$student_id=$_SESSION["student_id"];

include_once('../database/connection.php');

$sql="SELECT * FROM student WHERE Student_ID = '$student_id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$firstname=$row['Firstname'];
$lastname=$row['Lastname'];
$image=$row['Picture'];

?>      

      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assets/upload/<?=$image?>" class="img-circle" >
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname , " ", $lastname; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="std_dashboard.php">
            <img src="../assets/image/dashboard.png"style="margin-right: 3%;" class="circle"><span>Home</span>
          </a>
        </li>

        <li>
          <a href="classroom.php">
            <img src="../assets/image/classroom.png" class="circle" style="margin-right: 2%;"><span>Classroom</span>
          </a>
        </li>


        <li class="treeview">
          <a href="#">
            <img src="../assets/image/subject.png" class="circle" style="margin-right: 2%;">
            <span>Subjects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="subjects.php"><i class="fa fa-circle-o"></i>&nbspSubjects</a></li>
             <li><a href="schedule.php"><i class="fa fa-circle-o"></i>&nbspSchedule</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/library.png" class="circle" style="margin-right: 2%;">
            <span>Library</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="request_borrow_book.php"><i class="fa fa-circle-o"></i>&nbspRequest to Borrow Book</a></li>
             <li><a href="borrow_books.php"><i class="fa fa-circle-o"></i>&nbspBorrowed Books</a></li>
              <li><a href="return_books.php"><i class="fa fa-circle-o"></i>&nbspReturned Books</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/payment.png" class="circle" style="margin-right: 2%;">
            <span>Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="std_payment.php"><i class="fa fa-credit-card"></i>&nbspPayment</a></li>
          </ul>

          <ul class="treeview-menu">
            <li><a href="paymentHistory.php"><i class="fa fa-clock-o"></i>&nbspPayment History</a></li>
          </ul>
        </li>

        <li>
          <a href="attendance.php">
            <img src="../assets/image/attendance.png" class="circle" style="margin-right: 2%;"><span>Attendance</span>
          </a>
        </li>

        <li>
          <a href="view_grades.php">
            <img src="../assets/image/grade.png" class="circle" style="margin-right: 2%;"><span>Grades</span>
          </a>
        </li>

        <li>
          <a href="evaluate.php">
            <img src="../assets/image/evaluation.png" class="circle" style="margin-right: 2%;"><span>Teacher Evaluation</span>
          </a>
        </li>

        <li>
          <a href="enrollment.php">
            <img src="../assets/image/admission.png" class="circle" style="margin-right: 2%;"><span>Enrollment</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/message.png" class="circle" style="margin-right: 2%;">
            <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="message.php"><i class="fa fa-circle-o"></i> Send Message</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/clinic.png" class="circle" style="margin-right: 2%;">
            <span>Clinic</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="my_clinic_record.php"><i class="fa fa-circle-o"></i>&nbspMy History</a></li>
            <li><a href="health_record.php"><i class="fa fa-circle-o"></i>&nbspHealth Record</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/counseling.png" class="circle" style="margin-right: 2%;">
            <span>Guidance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="counseling.php"><i class="fa fa-circle-o"></i>&nbspAppointments</a></li>
            <li><a href="add_appointment.php"><i class="fa fa-circle-o"></i>&nbspNew Appointments</a></li>
            <li><a href="guidance_record.php"><i class="fa fa-circle-o"></i>&nbspGuidance Record</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/settings.png" class="circle" style="margin-right: 2%;">
            <span>Account Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="std_settings.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>

        <li>
          <a href="std_profile.php">
            <img src="../assets/image/profile.png" class="circle" style="margin-right: 2%;"></i> <span>Profile</span>
          </a>
        </li>

        <li>
          <a href="#" id="generate">
            <img src="../assets/image/generate.png" class="circle" style="margin-right: 2%;"></i> <span>Generate Number</span>
          </a>
        </li>





    </ul>
    </section>
  </aside>

  <div class="modal fade" id="generateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbspGenerate Number</h4>
      </div>
      <div class="modal-body">
        <form action="../std-model/generate_number.php" method="POST">
          <div class="row">
            <div class="col-md-12">
              <label>Student ID:</label>
              <input type="text" name="myID" id="myID" value="<?php echo $student_id ?>" class="form-control">
              <label>Contact:</label>
              <input type="number" name="number" id="number" class="form-control" required>
              <label>Purpose:</label>
              <input type="text" name="purpose" id="purpose" class="form-control" required>
              <label>Cashier:</label>
              <select name="cashier" id="cashier" class="form-control" required>
                <option hidden selected>Please select here</option>
                <option value="Cashier 1">Cashier 1</option>
                <option value="Cashier 2">Cashier 2</option>
              </select>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="btn_generate" id="btn_generate" class="btn btn-success">Generate</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
var timer1 = 0;
window.start_load = function(){
  $('body').prepend('<div id="preloader2"></div>')
}
window.end_load = function(){
  $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
  })
}

  $(document).ready(function(){
    $('#generate').click(function(){
       $('#generateModal').modal('show');
    })
  })
</script>
