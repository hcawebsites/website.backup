 <aside class="main-sidebar">

    <section class="sidebar">
<?php

$myID = $_SESSION['username'];

include_once('../database/connection.php');

$sql="SELECT * FROM std_account WHERE Student_ID = '$myID'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$firstname=$row['Firstname'];
$lastname=$row['Lastname'];

?>      

      
      <div class="user-panel">
        <div class="pull-left info">
          <p><?php echo $firstname , " ", $lastname; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
          
        </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="dashboard.php">
            <img src="../assets/image/admission.png"style="margin-right: 3%;" class="circle"><span>Enrollment Form</span>
          </a>
        </li>
        <li class="treeview">
          <a href="subjects.php">
            <img src="../assets/image/subject.png"style="margin-right: 3%;" class="circle"><span>Subject</span>
          </a>
        </li>
        <li class="treeview">
          <a href="payment.php">
            <img src="../assets/image/payment.png"style="margin-right: 3%;" class="circle"><span>Payments</span>
          </a>
        </li>

        <li>
          <a href="settings.php">
             <img src="../assets/image/settings.png" class="circle" style="margin-right: 3%;"><span>Account Settings</span>
          </a>
        </li>

    </ul>
    </section>
  </aside>