<?php 
include_once('../database/connection.php');
$my_id=$_GET["my_id"];
$my_type=$_GET["my_type"];

$sql="SELECT count(id)
      FROM my_friends
      WHERE My_ID='$my_id' AND Status='Pending' AND isread='0'";
	  
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$unread_count=$row['count(id)'];

?>    
          
<a href="#" class="dropdown-toggle" data-toggle="dropdown" onClick="showFriendRequest('<?php echo $my_id; ?>','<?php echo $my_type; ?>')">
	<i class="fa fa-user-plus"></i>
    <span class="label label-danger"><?php echo $unread_count; ?></span>
</a>

<ul class="dropdown-menu" id="dropdown_menu_frequest">
	<li class="header">You have <?php echo $unread_count; ?> friend request</li>
                  
    <li>
		<!-- inner menu: contains the actual data -->
        <ul class="menu">
        	<li><!-- start friend request -->
                     
<?php

include_once('../database/connection.php');

$my_id=$_GET["my_id"];
$my_type=$_GET["my_type"];

$time='';

			
$sql="SELECT * FROM my_friends WHERE My_ID='$my_id' AND Status='Pending' ORDER BY id";	
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
	
	$friend_type=$row['Friend_Type'];	
	$friend_index=$row['Friend_ID'];	
		
	if($friend_type=="Student"){
		
		$sql1="SELECT * FROM student WHERE Student_ID ='$friend_index'";
		$result1=mysqli_query($con,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_image=$row1['Picture'];	
		
	}
		
	if($friend_type=="Teacher"){
		
		$sql1="SELECT * FROM teacher_tb WHERE Emp_ID ='$friend_index'";
		$result1=mysqli_query($con,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_image=$row1['Picture'];	
			
	}
		
	if($friend_type=="Admin"){
	
		$sql1="SELECT * FROM admin WHERE Admin_ID ='$friend_index'";
		$result1=mysqli_query($con,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		
		$friend_image=$row1['Picture'];	
			
	}
			
?>  

<a href="#"  > 

<div class="pull-left">
	<img src="../assets/upload/<?= $friend_image; ?>" class="img-circle" alt="User Image">
</div>

<span onClick="friendProfile('<?php echo $friend_type; ?>','<?php echo $friend_index; ?>')"><h5 style="padding:0; margin:0;"><?php echo $row1['Firstname']," ", $row1['Lastname']; ?></h5></span> 

<button onclick="confirmFriend('<?php echo $my_id; ?>','<?php echo $my_type; ?>','<?php echo $friend_index; ?>')" class="btn btn-success btn-xs"><i class="fa fa-user-plus" aria-hidden="true"> Confirm</i></button>

<button href="#" class="confirm-delete-friend-req btn btn-xs btn-danger"data-dismiss="modal" data-toggle="modal" onclick="deleteFriend()" ><i class="fa fa-user-plus" aria-hidden="true"> Delete Request</i></button>  

</a>

<?php }  ?> 
                        
            	</li><!-- end friend request -->
        	</ul>
    	</li>
	<li class="footer"><a href="#"  onclick="viewAllFriendRequest()">See All Friend Request</a></li>
</ul>

