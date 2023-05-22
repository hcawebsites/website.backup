<?php include_once '../database/connection.php'?>

<?php 
$reg_num =$_SESSION['code'];
$sql="SELECT * FROM student WHERE Reg_Number = '$reg_num'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$firstname=$row['Firstname'];
$lastname=$row['Lastname'];
$status = $row['Enrollment_Status'];
$appDate = $row['Application_Date'];
$image = $row['Picture'];
$date = strtotime($appDate);
?>


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
      <!--Notification-->             
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


                 <!-- User Account: style can be found in dropdown.less -->
                 <li class="dropdown user user-menu">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                   <img src="../assets/upload/<?=$image?>" class="user-image" alt="User Image">
                   <span class="hidden-xs"><?php echo $row['Firstname'] , " ", $row['Lastname']?></span>
                 </a>
                 <ul class="dropdown-menu">
                   <!-- User image -->
                   <li class="user-header">
                     <img src="../assets/upload/<?=$image?>" class="img-circle" alt="User Image">

                     <p>
                     <?php echo $row['Firstname'] , " ", $row['Lastname'] ?>
                           
                        <small>Applicantion Date - <?php echo date('M d Y', $date)?></small>
                        
                     </p>

     
              
                   </li>
                  
                   <li class="user-footer">
                     <div class="pull-left">
                       <a href="std_profile.php" class="btn btn-default btn-flat">Profile</a>
                     </div>
                    
                     <div class="pull-right">
                       <input type="button" class="btn btn-default btn-flat" data-target = "#modalLogout" data-toggle="modal" value="Sign Out"></a>
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
 
   <div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="content"> 
     <div class="modal-content">
       <div class="modal-header text-center">
         <button type="button" class="close" data-dismiss="modal" aria-label="close">
           <span aria-hidden="true">&times;</span></button>
       </div>
 
       <form action="logout.php" method="POST">
         <div class="modal-body text-center">
           <h5>Are you sure you want to Logout?</h5>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>
 
           <button type="submit" class="btn btn-success">Yes, Logout</button>
 
         </div>
       </form>
     </div>
   </div>
 </div>
 
 <!--Delete Friend Request-->
 
 


 