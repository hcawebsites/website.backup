<aside class="main-sidebar">

<section class="sidebar">
<?php

$teacher_id=$_SESSION["staff_id"];

include_once('../../database/connection.php');

$sql="SELECT * FROM staff_tb WHERE Emp_ID = '$teacher_id'";
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
          <a href="request.php">
            <img src="../../assets/image/calendar.png" style="margin-right: 3%;" class="circle"><span>Appointment Requests</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../../assets/image/guidance.png" class="circle" style="margin-right: 2%;">
            <span>Guidance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="guidance.php"><i class="fa fa-circle-o"></i>&nbspGuidance Records</a></li>
            <li><a href="add_record.php"><i class="fa fa-circle-o"></i>&nbspAdd Records</a></li>
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