<body class="hold-transition skin-green sidebar-mini" >
<div class="wrapper">
  <header class="main-header" >
    
    <a href="" class="logo">
      
      <span class="logo-mini"><strong>Menu</strong></span>
    
      <span class="logo-lg"><strong>Dashboard </strong></span>
    </a>
   
    <nav class="navbar navbar-static-top">
     
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
            
             
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  
                  <span class="label label-warning"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have notifications</li>
                  <li>
                  
                    <ul class="menu">

          </ul>
                  </li>
                  <li class="footer"><a href="#" onClick="viewAllNotifi()">View all</a></li>
                </ul>
              </li>         
                




<?php
$teacher_id=$_SESSION["emp_id"];
$my_type=$_SESSION["access"];

include_once('../../database/connection.php');

  $sql="SELECT * FROM staff_tb where Emp_ID='$teacher_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $image=$row['Picture'];

?>      
                <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../../assets/upload/<?=$image?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"> <?php echo $row['Firstname'] , " ", $row['Lastname']?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../../assets/upload/<?=$image?>" class="img-circle" alt="User Image">

                        <p>
                         <?php echo $row['Firstname'] , " ", $row['Lastname'] ?> - <?php echo $my_type; ?>
                  
                          <?php
                              $date = strtotime($row['Date']);
                                echo '<small>'."Member since ".date('M'.'.'.' Y', $date).'</small>';
                           ?>
                        </p>

        
                 
                      </li>
                     
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="admin_profile.php" class="btn btn-default btn-flat">Profile</a>
                        </div>
                       
                        <div class="pull-right">
                          <input type="button" class="btn btn-default" data-target = "#modalLogout" data-toggle="modal" value="Sign Out" >
                        </div>
                      </li>
                    </ul>
              </li>
            </ul> 
        </div>
  </nav>
  </header>
  <div id="viewAllNotification"></div>
  <div id="viewAllFriendRequest"></div>
  <div id="deleteFriend"></div>
  <!--Modal Logout-->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="content" style="width: 30%;"> 
    <div class="modal-content" style="padding: 1rem 1rem 1rem 1rem; text-align: center; line-height: 60px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span></button>
      <img src="../assets/upload/<?=$image?>" class="img-circle" style="margin-top: 15px; width: 35%;">
      <p style="font-size: 16px; font-weight: 400;">Are you sure you want to Logout?</p>

      <button class="btn btn-secondary cancel" data-dismiss="modal" style="width: 30%; padding: 1rem 1rem 1rem 1rem; background-color: #d6d6d6;">No</button>
      <a href="../logout.php" id="btn-logout" class="btn btn-success yes" style="width: 30%; padding: 1rem 1rem 1rem 1rem;">Yes</a>
    </div>
  </div>
</div>