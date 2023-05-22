<?php
include_once ('../database/connection.php');
$my_index=$_GET['my_id'];
$my_type=$_GET['my_type'];
$user_id=$_GET['friend_id'];
$conversation_id=$_GET['conversation_id'];

$sql = mysqli_query($con, "SELECT * from my_friends WHERE Conversation_ID = '$conversation_id' AND Friend_ID = '$user_id'");
$row = mysqli_fetch_assoc($sql);
$friend_type=$row['Friend_Type'];	

if($friend_type == "Admin"){
			
	$query_admin = mysqli_query($con, "SELECT * from admin Where Admin_ID = '$user_id'");
    $row_admin = mysqli_fetch_assoc($query_admin);
    $name = $row_admin['Firstname']. " " .$row_admin['Lastname'];
    $image = $row_admin['Picture'];
			
	}
		
elseif($friend_type == "Teacher"){
			
    $query_teacher = mysqli_query($con, "SELECT * from teacher_tb Where Emp_ID = '$user_id'");
    $row_teacher = mysqli_fetch_assoc($query_teacher);
    $name = $row_teacher['Salutation']. ". " .$row_teacher['Firstname']. " " .$row_teacher['Lastname'];
    $image = $row_teacher['Picture'];
			
	}
		
elseif($friend_type == "Student"){
			
    $query_std = mysqli_query($con, "SELECT * from student Where Student_ID = '$user_id'");
    $row_std = mysqli_fetch_assoc($query_std);
    $name = $row_std['Firstname']. " " .$row_std['Lastname'];
    $image = $row_std['Picture'];
			
	}
	
?>
   
   
   <div class="row">
        <div class="col-md-12">
            <div class="panel" id="coversation-panel">
                <div style="display: flex; justify-content: space-between; align-item: center;">
                    <img src="../assets/upload/<?=$image?>" class="img-circle" width="50px">
                        <div style="margin-left: -90px; margin-top: 5px;">
                            <span style="margin-left: 10px; font-size: 14px; font-weight: 600;"><?=$name?></span><br>
                            <span style="margin-left: 10px;"><?=$friend_type?></span> 
                        </div>
                        <div></div><div></div>
                </div>
                <hr>

                <div class="panel-body" id="conversation-panel-body"><!--panel-body -->
                    <div class="row">
                        <div class=" col-md-12"> 
                            <table class="table" id="chatRoom">
                                <tbody >
                                <?php
                                        
                                    $sql= mysqli_query($con,"SELECT * from online_chat where Conversation_ID = '$conversation_id'");
                                    while($row=mysqli_fetch_assoc($sql)){
                                        
                                        $userID = $row['User_ID'];
                                        $msg = $row['Message'];
                                        $user_type = $row['Type'];
                                        
                                        if($userID==$my_index){
                                            $sql1=mysqli_query($con, "SELECT * from student where Student_ID = '$userID'");
                                            $row1=mysqli_fetch_assoc($sql1);
                                            $image= $row1 ['Picture'];

                                            echo '
                                            <tr class="msg-tr">
                                                <td style="border:none;">
                                                    <img class="logo2" style="float: right;" src="../assets/upload/'.$image.'" >
                                                    <p class="msg-p1"> '.$msg.' </p>                                                   
                                                </td>
                                                </tr>
                                            
                                            ';
                                        }else{
                                            
                                            if($user_type == "Admin"){
                                            
                                                $sql1=mysqli_query($con, "SELECT * from admin where Admin_ID = '$userID'");
                                                $row1=mysqli_fetch_assoc($sql1);
                                                $image= $row1 ['Picture'];
                                                
                                            }
                                            
                                            if($user_type == "Teacher"){
                                                
                                                $sql1=mysqli_query($con, "SELECT * from teacher_tb where Emp_ID = '$userID'");
                                                $row1=mysqli_fetch_assoc($sql1);
                                                $image= $row1 ['Picture'];
                                                
                                            }
                                            
                                            if($user_type == "Student"){
                                                
                                                $sql1=mysqli_query($con, "SELECT * from student where Student_ID = '$userID'");
                                                $row1=mysqli_fetch_assoc($sql1);
                                                $image= $row1 ['Picture'];
                                                
                                            }
                                            
                                            echo '<tr class="msg-tr">
                                                <td style="border:none;">
                                                    <img class="logo1" src="../assets/upload/'.$image.'" >
                                                    <p class="msg-p2"> '.$msg.' </p>
                                                    
                                                </td>
                                                </tr>';
                                            
                                        }
                                        
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!--/.panel-body -->
            <div class=""><!--panel-footer -->
           		<textarea class="form-control" style="resize: none;" id="msg" name="msg" rows="3"></textarea>
                <input type="hidden" name="my_index" id="myID" value="<?php echo $my_index; ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="my_type" id="myType" value="<?php echo $my_type; ?>">
                <input type="hidden" name="conversation_id" id="conversation_id" value="<?php echo $conversation_id; ?>">
        	</div><!--/.panel-footer-->

            
            </div>
        </div>
    </div><!--/.row --> 




<style>
    .panel{
        padding: 1rem 1rem 1rem 1rem;
    }

    
    
    #conversation-panel-body{
	height:430px!important;
	overflow:auto !important;
}


.msg-p1{
	
	max-width:352px !important;
	word-break: break-all;
	float:right;
	text-align:left;
	font-size:12px;  
	font-weight:700;
	background-color:#5bc0de;
	color:white;
	border-radius:15px;
	padding:7px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.msg-p2{
	
	max-width:352px !important;
	word-break: break-all;
	float:left;
	text-align:left;
	font-size:12px;  
	font-weight:600;
	
	background-color:#dbdada;
	color:black;
	border-radius:15px;
	padding:7px;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	
}

body{
	overflow-y:scroll;
	
}

.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}


#conversation-panel-body{
	height:350px!important;
	overflow:auto !important;
}

.logo2{
	float: left;
	width: 35px;
	height: 35px;
	margin-left: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#fff;
}

.logo1{
	float: left;
	width: 35px;
	height: 35px;
	margin-right: 10px;
	border-radius: 50%;
	text-align: center;
	background-color:#fff;
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}
</style>