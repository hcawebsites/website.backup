
  <aside class="main-sidebar">
    
   
    <section class="sidebar">
<?php

$teacher_id=$_SESSION["teacher_id"];

include_once('../../database/connection.php');

$sql="SELECT * FROM teacher_tb WHERE Emp_ID = '$teacher_id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$firstname=$row['Firstname'];
$lastname=$row['Lastname'];
$image=$row['Picture'];

?>      

      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../assets/upload/<?=$image?>" class="img-circle" >
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname , " ", $lastname; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="dashboard.php">
            <img src="../../assets/image/dashboard.png" style="margin-right: 3%;" class="circle"><span>Home</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/classroom.png" class="circle" style="margin-right: 2%;">
            <span>Classroom</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="classroom.php"><i class="fa fa-circle-o"></i> Room</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/subject.png" class="circle" style="margin-right: 2%;">
            <span>Subject</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="subjects.php"><i class="fa fa-circle-o"></i> Subjects</a></li>
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedule</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/student.png" class="circle" style="margin-right: 2%;">
            <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="students.php"><i class="fa fa-circle-o"></i> Students Record</a></li>
            <li><a href="std_attendance.php"><i class="fa fa-circle-o"></i> Student Attendance</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/message.png" class="circle" style="margin-right: 2%;">
            <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="message.php"><i class="fa fa-circle-o"></i> Send Message</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/settings.png" class="circle" style="margin-right: 2%;">
            <span>Account Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="settings.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>

        <li>
          <a href="profile.php">
            <img src="../../assets/image/profile.png" class="circle" style="margin-right: 2%;"></i> <span>Profile</span>
          </a>
        </li>




    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>