<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 

$myID = $_SESSION['admin_id'];
$my_type = $_SESSION['access'];
error_reporting(0);?>

<div class="content-wrapper">
  <title> Add Friends</title>
	
    <section class="content-header">
    	<h1>
        	Send Message
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Message</a></li>
            <li><a href="#">Send Message</a></li>
    	</ol>
        <hr>
        <hr>
	</section>

    <section class="content">
        
        <div class="row">
            <div class="col-md-7">
                <div class="table">
                    <div class="table-title">
                        <h3><i class="fa fa-users aria-hidden="true">&nbspUsers</i></h3>
                        <div class="row form-inline" style="margin-right: 5px;">
                            <button class="btn btn-success form-control" id="student"><i class="fa fa-user"></i>&nbspStudent</button>
                            <button class="btn btn-info form-control" id="teacher"><i class="fa fa-user"></i>&nbspTeacher</button>
                            <button class="btn btn-danger form-control" id="admin"><i class="fa fa-user"></i>&nbspAdministrator</button>
                        </div>
                    </div>     
                    
                    <div id="studentUser" style="display:block;">

                        <table class="table" id="search">
                            <thead>
                                <th class="col-md-1"></th>
                                <th class="col-md-5"></th>
                                <th class="col-md-6"></th>
                            </thead>
                            <tbody>
    
                    <?php
                        $query_student = mysqli_query($con, "SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID");
                        
                        if (mysqli_num_rows($query_student) > 0) {
                            while ($row_student = mysqli_fetch_assoc($query_student)) {     
                                $userID = $row_student['Student_ID'];
                                $query = mysqli_query($con, "SELECT * FROM my_friends WHERE My_ID = '$myID' And Friend_ID = '$userID'");
                                $row = mysqli_fetch_assoc($query);
                                $status = $row['Status'];
                                $conversation_id = $row['Conversation_ID'];                        
                            ?>

                            <tr>
                                <td><img src="../assets/upload/<?=$row_student['Picture']?>" width="50px"></img></td>
                                <td>
                                    <div style="display: block; line-height: 10px; margin-top: 10px; text-align: center;">
                                        <p><?=$row_student['Firstname']. " " .$row_student['Lastname']?></p>
                                        <small><?=$row_student['Name']. " ".$row_student['Strand']. " - " .$row_student['Section']?></small>    
                                    </div> 
                                </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <?php
                                    if ($status == "") {
                                        echo '<button onClick="addFriends(this)" class="btn btn-success form-control" data-id="'.$my_type.','.$myID.',Student,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning" onClick="confirmFriends(this)" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
                                    }
                                    else{                                                                      
                                        ?>
                                        <button class="btn btn-primary" onClick="showModal('<?php echo $myID; ?>','<?php echo $conversation_id; ?>','<?php echo $userID; ?>','<?php echo $my_type; ?>')">Send Message</button>
                                    </td>
                                </tr>
                             
                            <?php } } }?>
                        </tbody>
                        </table>
                    </div>

                    <div id="teacherUser" style="display:none;">

                    <table class="table" id="search1">
                            <thead>
                                <th class="col-md-1"></th>
                                <th class="col-md-5"></th>
                                <th class="col-md-6"></th>
                            </thead>
                            <tbody>
    
                    <?php
                       $query_teacher = mysqli_query($con, "SELECT * FROM teacher_tb inner join schedule on teacher_tb.Emp_ID = schedule.Teacher_ID inner join grade on schedule.Class_ID = grade.ID Group by Teacher_ID");
                        
                       if (mysqli_num_rows($query_teacher) > 0) {
                           while ($row_teacher = mysqli_fetch_assoc($query_teacher)) {     
                               $userID = $row_teacher['Emp_ID'];
                               $query = mysqli_query($con, "SELECT * FROM my_friends WHERE My_ID = '$myID' And Friend_ID = '$userID'");
                               $row = mysqli_fetch_assoc($query);
                               $status = $row['Status'];
                               $conversation_id = $row['Conversation_ID'];                  
                           ?>

                            <tr>
                                <td><img src="../assets/upload/<?=$row_teacher['Picture']?>" width="50px"></img></td>
                                <td>
                                    <div style="display: block; line-height: 10px; margin-top: 10px; text-align: center;">
                                        <p><?=$row_teacher['Salutation']. ". ". $row_teacher['Firstname']. " " .$row_teacher['Lastname']?></p>
                                        <small>Instructor: <?=$row_teacher['Name']. " ". $row_teacher['Strand']. " - " .$row_teacher['Section']?></small>    
                                    </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <?php
                                    if ($status == "") {
                                        echo '<button onClick="addFriends(this)" class="btn btn-success form-control" data-id="'.$my_type.','.$myID.',Teacher,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning" onClick="confirmFriends(this)" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
                                    }
                                    else{
                                                                       
                                        ?>
                                        <button class="btn btn-primary" onClick="showModal('<?php echo $myID; ?>','<?php echo $conversation_id; ?>','<?php echo $userID; ?>','<?php echo $my_type; ?>')">Send Message</button>
                                    </td>
                                </tr>
                             
                            <?php } } }?>
                        </tbody>
                        </table>
                    </div>

                    <div id="adminUser" style="display:none;">
                    <table class="table" id="search2">
                            <thead>
                                <th class="col-md-1"></th>
                                <th class="col-md-5"></th>
                                <th class="col-md-6"></th>
                            </thead>
                            <tbody>
    
                    <?php
                        $query_admin = mysqli_query($con, "SELECT * FROM admin inner join user on admin.Admin_ID = user.Username WHERE Admin_ID != '$myID'");
                        
                        if (mysqli_num_rows($query_admin) > 0) {
                            while ($row_admin = mysqli_fetch_assoc($query_admin)) {     
                                $userID = $row_admin['Admin_ID'];
                                $query = mysqli_query($con, "SELECT * FROM my_friends WHERE My_ID = '$myID' And Friend_ID = '$userID'");
                                $row = mysqli_fetch_assoc($query);
                                $status = $row['Status'];      
                                $conversation_id = $row['Conversation_ID'];                   
                            ?>

                            <tr>
                                <td> <img src="../assets/upload/<?=$row_admin['Picture']?>" width="50px"></img></td>
                                <td>
                                    <div style="display: block; line-height: 10px; margin-top: 10px; text-align: center;">
                                        <p><?=$row_admin['Firstname']. " " .$row_admin['Lastname']?></p>
                                        <small><?=$row_admin['Access']?></small>    
                                    </div> 
                                </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <?php
                                    if ($status == "") {
                                        echo '<button onClick="addFriends(this)" class="btn btn-success form-control" data-id="'.$my_type.','.$myID.',Admin,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning" onClick="confirmFriends(this)" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
                                    }
                                    else{
                                                                       
                                    ?>
                                    <button class="btn btn-primary" onClick="showModal('<?php echo $myID; ?>','<?php echo $conversation_id; ?>','<?php echo $userID; ?>','<?php echo $my_type; ?>')">Send Message</button>
                                </td>
                            </tr>
                         
                        <?php } } }?>
                        </tbody>
                        </table>
                    </div>

                </div>

                    
            </div>

            <div class="col-md-5" id="showMsg"> 

            </div>
                

        </div>
        
    


    </section>

    
</div>


<script>

var timer1=0;
var myVar;
var intervalID;
var intervalID1;

function showModal(my_index,conversation_id,friend_index,my_type){
	
	timer1-=timer1;
	clearInterval(intervalID);
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('showMsg').innerHTML = this.responseText;
                document.getElementById('showMsg').style.display = "block";
				$('#conversation-panel-body').scrollTop($('#conversation-panel-body')[0].scrollHeight);
				 
    		}
			
  		};	
		
    	xhttp.open("GET", "conversation_history_admin.php?my_id=" + my_index + "&my_type="+my_type + "&conversation_id="+conversation_id + "&friend_id="+friend_index, true);												
  		xhttp.send();//MSK-00149--End Ajax
							
};

document.onkeydown=function(evt){//start press Enter Key
		
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
                                        
            if(keyCode == 13){
     
                var msg = document.getElementById('msg').value;
                var my_index = document.getElementById('myID').value;
                var friend_index = document.getElementById('user_id').value;
                var my_type = document.getElementById('myType').value;
                var conversation_id = document.getElementById('conversation_id').value;
                
                var do1 = "add_message";
                
                if(msg!== ' '){
                    
                    var xhttp1 = new XMLHttpRequest();//MSK-00149-Start Ajax  
                        xhttp1.onreadystatechange = function() {
                                                                                    
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById('msg').value = '';
                                        
                                var myArray = eval( xhttp1.responseText );
                                $('#conversation-panel-body').scrollTop($('#conversation-panel-body')[0].scrollHeight);
                                timer1++;
                                
                            }
                                            
                        };
                                                                                    
                        xhttp1.open("GET", "../model/add_message.php?conversation_id=" + conversation_id + "&my_index="+my_index  + "&msg="+msg + "&user_type="+my_type + "&do="+do1, true);												
                        xhttp1.send();
                            
                            if(timer1 == 0){
                                intervalID = setInterval(function(){
                                     
                                    $('#chatRoom').load("conversation_history_admin1.php?my_index="+my_index+"&conversation_id="+conversation_id+"&friend_index="+friend_index+"");
                                    
                                                           
                                }, 1000); // 1000 milliseconds = 1 second.
                            }
                                                
                }
                
            }
            
    };

    function msgRead(my_index,conversation_id,friend_index,my_type){
	
	var do1 = "confirm_msg_read";
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_msg_read.php?conversation_id=" + conversation_id + "&friend_index="+friend_index + "&do="+do1 , true);												
  		xhttp.send();//MSK-000127-Ajax End
	
	
}


$(function () {
        
        $('#search').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
		  "pageLength": 4,
          "autoWidth": false
        });
      });

      $(function () {
        
        $('#search1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
		  "pageLength": 4,
          "autoWidth": false
        });
      });

      $(function () {
        
        $('#search2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
		  "pageLength": 4,
          "autoWidth": false
        });
      });

function addFriends(aFriend){
	
	var myArray = $(aFriend).data("id").split(',');
	
	var my_type = myArray[0];
	var my_id = myArray[1];
	var friend_access = myArray[2];
	var user_id = myArray[3];
	
	var do1 = "add_friends";
		
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {			
				location.reload();
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/add_friends.php?my_type=" + my_type +"&my_index="+my_id +"&friend_access="+friend_access +"&user_id="+user_id + "&do="+do1, true);												
  		xhttp.send();//MSK-00149--End Ajax
	 
};

function confirmFriends(cFriend){
	
	var myArray = $(cFriend).data("id").split(',');
	

	var my_id = myArray[0];
	var user_id = myArray[1];
		
	var do1 = "confirm_friends";
    

	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {			
				location.reload();
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confrim_friends.php?myID=" + my_id +"&user_id="+user_id +"&do="+do1, true);												
  		xhttp.send();//MSK-00149--End Ajax
	
};


$(document).ready(function() {

$("#student").click(function() { //show admin form and hide post form 
    document.getElementById('studentUser').style.display = "block";
    document.getElementById('teacherUser').style.display = "none";
    document.getElementById('adminUser').style.display = "none";
    document.getElementById('showMsg').style.display = "none";
});

$("#teacher").click(function() { //show admin form and hide post form 
    document.getElementById('studentUser').style.display = "none";
    document.getElementById('teacherUser').style.display = "block";
    document.getElementById('adminUser').style.display = "none";
    document.getElementById('showMsg').style.display = "none";
});

$("#admin").click(function() { //show admin form and hide post form 
    document.getElementById('studentUser').style.display = "none";
    document.getElementById('teacherUser').style.display = "none";
    document.getElementById('adminUser').style.display = "block";
    document.getElementById('showMsg').style.display = "none";
});
});

</script>

<?php
if(isset($_GET["do"])&&($_GET["do"]=="showChatBox")){
	
	$my_index=$_GET['my_index'];
	$my_type=$_GET['my_type'];
	$conversation_id=$_GET['conversation_id'];
	$friend_index=$_GET['friend_index'];
    ?>
    <script>
        showModal('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $friend_index; ?>','<?php echo $my_type; ?>')
        msgRead('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $friend_index; ?>','<?php echo $my_type; ?>')
    </script>
	
    <?php } 
    include_once ('footer.php')
    ?>
