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
<?php
include_once ('../database/connection.php');
$my_id = $_SESSION['student_id'];
$my_type = $_SESSION['access'];

if ($my_type == "Student") {
  $query = mysqli_query($con, "SELECT count(id) FROM notification_history WHERE Access = 'Student' And User_ID = '$my_id' AND isread = '0'");
  $row = mysqli_fetch_assoc($query);
  $notif_count = $row['count(id)'];
}
?>
                  
                <span class="label label-warning"><?=$notif_count?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?=$notif_count?> notifications</li>
                  <li>

                  <ul class="menu">
                  <?php 
                  $query_notif = mysqli_query($con, "SELECT * FROM notification_history WHERE Access = 'Student' And User_ID = '$my_id' AND isread = '0' ORDER BY ID DESC");
                  while ($row1 = mysqli_fetch_assoc($query_notif)) {
                    $notif_id = $row1['Notification_ID'];

                    if ($row1['_Status'] == "Payment") {
                      $query_payment = mysqli_query($con, "SELECT * From payments Where ID = '$notif_id'");
                      $row2 = mysqli_fetch_assoc($query_payment);
                      $balance = $row2['Balance'];
                      $due = date("M d, Y", strtotime($row2['Due_Date']));

                        echo '<li>
                                <a href = "#" onclick="showNotifyEvent('.$notif_id.')">
                                  <i class="fa fa-money text-aqua"></i> Your School Bill of PHP '.$balance.', <br> and
                                  is due on '.$due.'. Kindly<br>
                                  disregard if a payment has been
                                  <br> made.
                                </a>
                            </li>
                            ';                  
                    }
                  }

                  
                  
                  ?>

                    </ul>
                  </li>
                  <li class="footer"><a href="#" onClick="viewAllNotifi()">View all</a></li>
                </ul>
              </li>  

<script>
  var count = 0;

function viewAllNotifi(){
  
  var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById('viewAllNotification').innerHTML = this.responseText;
        $('#modalviewAllNotifications').modal('show');
        count++;
        
        }
      
      };  
    
      xhttp.open("GET", "all_notifications.php", true);                       
      xhttp.send();
}
  
</script>                 
                  
<!--Friend Request Notification-->
<?php include_once ('../database/connection.php');

$my_id=$_SESSION["student_id"];
$my_type=$_SESSION["access"];

$sql="SELECT count(id)
      FROM my_friends
      WHERE My_ID='$my_id' AND Status='Pending' AND isread='0'";
    
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$unread_count=$row['count(id)'];

?>              
              
             

             
              <li class="dropdown messages-menu"  id="friend_request">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onClick="showFriendRequest('<?php echo $my_id; ?>','<?php echo $my_type; ?>')">
                  <i class="fa fa-user-plus"></i>
                  <span class="label label-danger"><?php echo $unread_count; ?></span>
                </a>
              </li> 

<script>
  var count = 0;

function viewAllFriendRequest(){
  
  var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById('viewAllFriendRequest').innerHTML = this.responseText;
        $('#modalviewAllFriendRequest').modal('show');
        count++;
        
        }
      
      };  
    
      xhttp.open("GET", "all_friend_request.php", true);                       
      xhttp.send();
}


function deleteFriend(){
  
  var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById('deleteFriend').innerHTML = this.responseText;
        $('#deleteFriendRequest').modal('show');
        count++;
        
        }
      
      };  
    
      xhttp.open("GET", "all_friend_request.php", true);                       
      xhttp.send();
}
  
</script>

              <script>
//MSK-00147
var intervalID1;
var count3 = 0;
function showFriendRequest(my_id,my_type){
  
  var xhttp = new XMLHttpRequest();  
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        document.getElementById('friend_request').innerHTML = this.responseText;
        $('#dropdown_menu_frequest').toggle(1);
        }
      
      };  
    
      xhttp.open("GET", "show_friend_request.php?my_id=" + my_id +"&my_type="+my_type , true);                        
      xhttp.send();
  
};

function friendProfile(friend_type,friend_index){
    
    var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
        xhttp.onreadystatechange = function() {
                                                                    
            if (this.readyState == 4 && this.status == 200) {
                                                                        
                document.getElementById('fProfile').innerHTML = this.responseText;
                $('#modalviewFriend').modal('show');                                                        
            }
        };
                                                                
        xhttp.open("GET", "friend_profile.php?friend_type=" + friend_type + "&friend_index="+friend_index, true);                                               
        xhttp.send();   
    
};


//Confirm Request

function confirmFriend(my_id,my_type,friend_index){
	
	var do1 = "confirm_friends";
	$('#dropdown_menu_frequest').toggle('hide');	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				var myArray = eval(xhttp.responseText);
				var msg = myArray[0];
				
				if(msg==1){
					
					showFriendRequest(my_id,my_type);
					
				}
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../std-model/confrim_friends.php?myID=" + my_id +"&user_id="+friend_index +"&do="+do1, true);						
  		xhttp.send();
	
};

//end

// delete request

function deletefriend(my_id,my_type,friend_index){
  
  $('#dropdown_menu_frequest').toggle('hide');  
  var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
       if(myArray[0]==1){//MSK-000130
        
          $("#deleteFriendRequest").modal('hide'); 
           Delete_alert(myArray[0])
        
         }
    
         if(myArray[0]==2){//MSK-000137
      
          $("#deleteFriendRequest").modal('hide');
           Delete_alert(myArray[0])
          
         }
        
        
        }
      
      };  
    
      xhttp.open("GET", "../std-model/delete_friend_request.php?id="+friend_index, true);                        
      xhttp.send();
  
};
//end

function Delete_alert(msg){
//MSK-000136  
  if(msg==1){
    
      var myModal = $('#modalviewAllFriendRequest');
    myModal.modal('show');
    
    clearTimeout(myModal.data('hideInterval'));
      myModal.data('hideInterval', setTimeout(function(){
        myModal.modal('hide');
      
      }, 10000));
      
  }
  
  if(msg==2){
    
      var myModal = $('#modalviewAllFriendRequest');
    myModal.modal('show');
    
      clearTimeout(myModal.data('hideInterval'));
      myModal.data('hideInterval', setTimeout(function(){
        myModal.modal('hide');
      }, 10000));
        
  }

};  

</script>




<!--end of Friend Request--> 
                <!-- Message Notification -->
<?php 
$my_id=$_SESSION["student_id"];
$my_type=$_SESSION["access"];
$unread_msg_count=0;

$result=mysqli_query($con, "SELECT * FROM my_friends WHERE My_ID = '$my_id'");

while($row=mysqli_fetch_assoc($result)){
	
	$conversation_id=$row['Conversation_ID'];
	
	$result1=mysqli_query($con, "SELECT count(id) FROM online_chat WHERE Conversation_ID = '$conversation_id' AND User_ID != '$my_id' AND isread='0'");
	$row1=mysqli_fetch_assoc($result1);
	$unread_msg_count+=$row1['count(id)'];
	
}

?>                

            

             
              <li class="dropdown messages-menu" id="unread_msg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php echo $unread_msg_count; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $unread_msg_count; ?> messages</li>
                  
                  <li>
                    
                    <ul class="menu">  
<?php

$time='';
$file_path='';

	$result=mysqli_query($con, "SELECT DISTINCT Conversation_ID ,Friend_ID FROM my_friends WHERE My_ID='$my_id'ORDER BY Conversation_ID");
	while($row=mysqli_fetch_assoc($result)){
		
		$conversation_id = $row['Conversation_ID'];
		$friend_index = $row['Friend_ID'];
		
		$result3=mysqli_query($con, "SELECT * FROM my_friends WHERE Conversation_ID = '$conversation_id' and Friend_ID = '$friend_index'");
		$row3=mysqli_fetch_assoc($result3);

		$friend_type=$row3['Friend_Type'];
		
		if($friend_type == "Admin"){
			
			$query_admin = mysqli_query($con, "SELECT * from admin Where Admin_ID = '$friend_index'");
      $row_admin = mysqli_fetch_assoc($query_admin);
      $name = $row_admin['Firstname']. " " .$row_admin['Lastname'];
      $image = $row_admin['Picture'];
			
		}

    elseif($friend_type == "Teacher"){
			
			$query_teacher = mysqli_query($con, "SELECT * from teacher_tb Where Emp_ID = '$friend_index'");
      $row_teacher = mysqli_fetch_assoc($query_teacher);
      $name = $row_teacher['Salutation']. ". " .$row_teacher['Firstname']. " " .$row_teacher['Lastname'];
      $image = $row_teacher['Picture'];
			
		}
		
		elseif($friend_type == "Student"){
			
			$query_student = mysqli_query($con, "SELECT * from student Where Student_ID = '$friend_index'");
      $row_student = mysqli_fetch_assoc($query_student);
      $name = $row_student['Firstname']. " " .$row_student['Lastname'];
      $image = $row_student['Picture'];
			
		}
		
	
		
		$result2=mysqli_query($con, "SELECT * FROM online_chat WHERE Conversation_ID = '$conversation_id' AND User_ID != '$my_id' And isread = '0' ORDER BY ID DESC ");
		while($row2=mysqli_fetch_assoc($result2)){
		
			$last_msg=$row2['Message'];
			date_default_timezone_set('Singapore');
      $date_time_now = date("Y-m-d h:i:s");
      $newdate = date("Y-m-d h:i:s", strtotime($row2['Date']));
      $start_date = new DateTime($newdate); //Time of post
      $end_date = new DateTime($date_time_now); //Current time
      $interval = $start_date->diff($end_date); //Difference between dates 
      if ($interval->y >= 1) {
          if ($interval == 1)
              $time_message = $interval->y . " year ago"; //1 year ago
          else
              $time_message = $interval->y . " years ago"; //1+ year ago
      } else if ($interval->m >= 1) {
          if ($interval->d == 0) {
              $days = " ago";
          } else if ($interval->d == 1) {
              $days = $interval->d . " day ago";
          } else {
              $days = $interval->d . " days ago";
          }


          if ($interval->m == 1) {
              $time_message = $interval->m . " month" . $days;
          } else {
              $time_message = $interval->m . " months" . $days;
          }
      } else if ($interval->d >= 1) {
          if ($interval->d == 1) {
              $time_message = "Yesterday";
          } else {
              $time_message = $interval->d . " days ago";
          }
      } else if ($interval->h >= 1) {
          if ($interval->h == 1) {
              $time_message = $interval->h . " hour ago";
          } else {
              $time_message = $interval->h . " hours ago";
          }
      } else if ($interval->i >= 1) {
          if ($interval->i == 1) {
              $time_message = $interval->i . " minute ago";
          } else {
              $time_message = $interval->i . " minutes ago";
          }
      } else {
          if ($interval->s < 30) {
              $time_message = "Just now";
          } else {
              $time_message = $interval->s . " seconds ago";
          }
      }

			
			if($my_type=="Admin"){
				$file_path="message.php?do=showChatBox&my_index=$my_id&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$my_type";
			}
			
			
			elseif($my_type=="Teacher"){
				$file_path="message.php?do=showChatBox&my_index=$my_id&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$my_type";
			}
			
			elseif($my_type=="Student"){
				$file_path="message.php?do=showChatBox&my_index=$my_id&conversation_id=$conversation_id&friend_index=$friend_index&my_type=$my_type";
			}
?>  
                      
                      <li>
                      <a href="<?php echo $file_path; ?>" onClick="msgRead('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $friend_index; ?>','<?php echo $my_type; ?>')">
                          <div class="pull-left">
                            <img src="../assets/upload/<?=$image?>" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            <?=$name?>
                            <small><i class="fa fa-clock-o">&nbsp<?=$time_message?></i></small>
                          </h4>
                          <p><?=$last_msg?></p>
                        </a>
                      </li>
<?php } } ?>                        
 
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> 

<!--End Message-->


<?php
$student_id=$_SESSION["student_id"];

include_once('../database/connection.php');

  $sql="SELECT * FROM student where Student_ID='$student_id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $image=$row['Picture'];
?>      
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../assets/upload/<?=$image?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"> <?php echo $row['Firstname'] , " ", $row['Lastname']?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../assets/upload/<?=$image?>" class="img-circle" alt="User Image">

                        <p>
                         <?php echo $row['Firstname'] , " ", $row['Lastname'] ?> - <?php echo $my_type; ?>
                  
                          <?php
                              $date = strtotime($row['Enrolled_Date']);
                                echo '<small>'."Member since ".date('M'.'.'.' Y', $date).'</small>';
                           ?>
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

<!--Delete Friend Request-->