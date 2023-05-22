
  <aside class="main-sidebar">
    
   
    <section class="sidebar">
<?php

$admin_id=$_SESSION["admin_id"];

include_once('../database/connection.php');

$sql="SELECT * FROM admin WHERE Admin_ID = '$admin_id'";
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="admin_dashboard.php">
            <img src="../assets/image/dashboard.png" style="margin-right: 3%;" class="circle"><span>Home</span>
          </a>
        </li>
        <li>
        <?php
          $en = mysqli_query($con, "SELECT count(*) as count FROM student Where Enrollment_Status = ''");
          $row = mysqli_fetch_assoc($en); 
        ?>
          <a href="Enrollment_list.php">
             <img src="../assets/image/admission.png" style="margin-right: 3%;" class="circle"><span>Enrollment <span style="color: #00A2E8; font-weight: 600; margin-left: 10px;"><?=$row['count']?></span></span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
             <img src="../assets/image/student_payment.png" style="margin-right: 3%;" class="circle">
             <span>Student Payment</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li><a href="to_pay.php"><i class="fa fa-circle-o"></i> To Pay</a></li>
              <li><a href="student_payment.php"><i class="fa fa-circle-o"></i> Payments</a></li>
            </ul>          
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/student.png" class="circle" style="margin-right: 2%;">
            <span>Master List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="elementary.php"><i class="fa fa-circle-o"></i> Elementary Department</a></li>
            <li><a href="junior_high.php"><i class="fa fa-circle-o"></i> Junior High Department</a></li>
            <li><a href="senior_high.php"><i class="fa fa-circle-o"></i> Senior High Department</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="teachers_list.php">
             <img src="../assets/image/teacher.png" style="margin-right: 3%;" class="circle"><span>Teacher List</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/attendance.png" class="circle" style="margin-right: 2%;">
            <span>Student Attendance</span>
          </a>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/file.png" class="circle" style="margin-right: 2%;">
            <span>Subjects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="subjectList.php"><i class="fa fa-circle-o"></i>&nbspSubject List</a></li>
            <li><a href="class_schedule.php"><i class="fa fa-circle-o"></i>&nbspAssign Schedule</a></li>
            <li><a href="faculty_schedule.php"><i class="fa fa-circle-o"></i>&nbspFaculty Schedule</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/library.png" class="circle" style="margin-right: 2%;">
            <span>Library</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_books.php"><i class="fa fa-circle-o"></i>&nbspList of Books</a></li>
            <li><a href="list_of_borrow_books.php"><i class="fa fa-circle-o"></i>&nbspBorrowed Books</a></li>
            <li><a href="list_of_returned_book.php"><i class="fa fa-circle-o"></i>&nbspReturned Books</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/classroom.png" class="circle" style="margin-right: 2%;">
            <span>Classroom</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/friends.png" class="circle" style="margin-right: 2%;">
            <span>Friends</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_friend_student.php"><i class="fa fa-circle-o"></i> Add Friends</a></li>
            <li><a href="all_teacher.php"><i class="fa fa-circle-o"></i> Friends</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/message.png" class="circle" style="margin-right: 2%;">
            <span>Message</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Send Message</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Group Chat</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Retrieve Message</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <img src="../assets/image/level.png" class="circle" style="margin-right: 2%;">
            <span>Levels</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="grade.php"><i class="fa fa-circle-o"></i> Grade</a></li>
            <li><a href="section.php"><i class="fa fa-circle-o"></i> Section</a></li>
            <li><a href="strand.php"><i class="fa fa-circle-o"></i> Strand</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/counseling.png" class="circle" style="margin-right: 2%;">
            <span>Guidance Counseling</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="counseling.php"><i class="fa fa-circle-o"></i>&nbspStudent Counseling</a></li>
            <li><a href="guidance.php"><i class="fa fa-circle-o"></i>&nbspGuidance Student Record</a></li>
            <li><a href="guidanceHistory.php"><i class="fa fa-circle-o"></i>&nbspGuidance Student History</a></li>
            
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/user.png" class="circle" style="margin-right: 2%;">
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li><a href="std_users.php"><i class="fa fa-circle-o"></i>&nbspStudent Users</a></li>
            <li><a href="users.php"><i class="fa fa-circle-o"></i>&nbspStaff Users</a></li>
            </ul>

          </a>
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
            <li><a href="patience_record.php"><i class="fa fa-circle-o"></i>&nbspPatience Record</a></li>
            <li><a href="student_bmi_record.php"><i class="fa fa-circle-o"></i>&nbspStudent Record</a></li>
            </ul>
        </li>

        <li>
          <a href="events.php">
            <img src="../assets/image/events.png" class="circle" style="margin-right: 2%;"><span>Events</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/settings.png" class="circle" style="margin-right: 2%;">
            <span>Acount Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_settings.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>

        <li>
          <a href="admin_profile.php">
            <img src="../assets/image/profile.png" class="circle" style="margin-right: 2%;"></i> <span>Profile</span>
          </a>
        </li>




    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>