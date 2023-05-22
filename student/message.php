<?php include_once('main_head.php');?>
<?php include_once('../student/std_header.php'); ?>
<?php include_once('../student/std_sidebar.php'); 
error_reporting(0);
$myID = $_SESSION['student_id'];
$my_type = $_SESSION['access'];?>

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
	</section>
<hr>
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="table">
                    
                    <div class="table-title">
                        <h3><i class="fa fa-users" aria-hidden="true">&nbspUsers</i></h3>
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
                        $query_student = mysqli_query($con, "SELECT * FROM student inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE student.Student_ID != '$myID'");
                        
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
                                    <div style="display: block; line-height: 10px; margin-top: 10px; text-align: center; font-size: 13px;">
                                        <p><?=$row_student['Firstname']. " " .$row_student['Lastname']?></p>
                                        <small><?=$row_student['Name']. " - " .$row_student['Section']?></small>    
                                    </div> 
                                </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <?php
                                    if ($status == "") {
                                        echo '<button class="btn btn-success form-control add_friend" data-id="'.$my_type.','.$myID.',Student,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning confirm_friend" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
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
                                    <div style="display: block; line-height: 10px; margin-top: 10px; text-align: center; font-size: 13px">
                                        <p><?=$row_teacher['Salutation']. ". ". $row_teacher['Firstname']. " " .$row_teacher['Lastname']?></p>
                                        <small><?=$row_teacher['Name']. " - " .$row_teacher['Section']?></small>    
                                    </td>
                                <td style="vertical-align:middle; text-align: center;">
                                    <?php
                                    if ($status == "") {
                                        echo '<button class="btn btn-success form-control add_friend" data-id="'.$my_type.','.$myID.',Teacher,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning confirm_friend" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
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
                        $query_admin = mysqli_query($con, "SELECT * FROM admin inner join user on admin.Admin_ID = user.Username");
                        
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
                                        echo '<button class="btn btn-success form-control add_friend" data-id="'.$my_type.','.$myID.',Admin,'.$userID.'">Add Friend</button>';
                                    }

                                    elseif($status == "Friend_Request_Sent"){
                                        echo '<button class="btn btn-info">Friend Request Sent</button>'; 
                                    }

                                    elseif($status == "Pending"){
                                        echo '<button class="btn btn-warning confirm_friend" data-id="'.$myID.','.$userID.'">Confirm Friend Request</button>'; 
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
		
    	xhttp.open("GET", "conversation_history_student.php?my_id=" + my_index + "&my_type="+my_type + "&conversation_id="+conversation_id + "&friend_id="+friend_index, true);												
  		xhttp.send();//MSK-00149--End Ajax
							
};

document.onkeydown=function(evt){//start press Enter Key
		
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
                                        
            if(keyCode == 13){

                var data = $('#msg').val() + ',' + $('#myID').val()+ ',' + $('#user_id').val() + ',' + $('#myType').val() + ',' + $('#conversation_id').val();
                var dt = data.split(',');
                var myID = dt[1];
                var cid = dt[4];
                var fid = dt[2];
                
                
                if(msg !== ''){
                    
                   $.ajax({
                    url: "../std-model/add_message.php",
                    method: "POST",
                    data:{
                        data:data
                    },
                    success:function(data){
                        if(data == "sent"){
                            const swalWithBootstrapButtons = Swal.mixin({
                              customClass: {
                                confirmButton: 'btn btn-success',
                              },
                              buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                              title: 'Message Sent!',
                              text: "",
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonText: 'Close',
                            }).then((result) => {
                              if (result.isConfirmed) {
                                   if(timer1 == 0){
                                    $('#msg').val('');
                                    intervalID = setInterval(function(){
                                         
                                        $('#chatRoom').load("conversation_history_student1.php?my_index="+myID+"&conversation_id="+cid+"&friend_index="+fid+"");
                                        
                                                               
                                    }, 1000); // 1000 milliseconds = 1 second.
                                }
                            }
                            })
                        }else{
                            Swal.fire(
                              'Sending Failed!',
                              '',
                              'error'
                            )
                        }
                    }
                   })
                                                
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
		
    	xhttp.open("GET", "../std-model/confirm_msg_read.php?conversation_id=" + conversation_id + "&friend_index="+friend_index + "&do="+do1 , true);												
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

      

$(document).ready(function(){
    $('.add_friend').click(function(){
        var data = $(this).attr("data-id");
        $.ajax({
            url: "../std-model/add_friends.php",
            method: "POST",
            data:{
                data:data
            }, 
            success:function(data){
               if (data == "Friend_Request_Sent") {
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Friend Request Sent Successfully!',
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                       location.reload();
                        }
                    })
                }else{
                    Swal.fire(
                      'Error',
                      '',
                      'error'
                    )
                }
            }
        })
    })

    $('.confirm_friend').click(function(){
        var data = $(this).attr("data-id");
        $.ajax({
            url: "../std-model/confrim_friends.php",
            method: "POST", 
            data:{
                data:data
            },
            success:function(data){
                if (data == "Success") {
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Data saved successfully!',
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                       location.reload();
                        }
                    })
                }else{
                    Swal.fire(
                      'Error',
                      '',
                      'error'
                    )
                }
            }
        })
    })

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
    include_once ('footer.php');?>