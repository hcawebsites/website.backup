<aside class="main-sidebar">

<section class="sidebar">
<?php

$staff_id=$_SESSION["staff_id"];

include_once('../../database/connection.php');

$sql="SELECT * FROM staff_tb WHERE Emp_ID = '$staff_id'";
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
            <img src="../../assets/image/library.png" class="circle" style="margin-right: 2%;">
            <span>Library Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="books.php"><i class="fa fa-circle-o"></i>&nbspManage books</a></li>
            <li><a href="start.php"><i class="fa fa-circle-o"></i>&nbspStart Transaction</a></li>
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