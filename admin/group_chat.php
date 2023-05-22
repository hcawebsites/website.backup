<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 

$myID = $_SESSION['admin_id'];
$my_type = $_SESSION['access'];?>

<div class="content-wrapper">
  <title> Add Friends</title>
	
    <section class="content-header">
    	<h1>
        	Group Chat
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Message</a></li>
            <li><a href="#">Group Chat</a></li>
    	</ol>
        <hr>
        <hr>
	</section>

    <section class="content">
        
        <div class="row">
            <div class="col-md-7">
                <div class="table">
                    <div class="table-title">
                        <h3><i class="fa fa-list aria-hidden="true">&nbspList of Group Chats</i></h3>
                        <div class="row form-inline" style="margin-right: 5px;">
                            <button class="btn btn-danger form-control" data-toggle="modal" data-target="#addChatRoom"><i class="fa fa-plus"></i>&nbspAdd Group Chat</button>
                        </div>
                    </div>     
                    
                    <div id="">

                        <table class="table" id="search">
                            <thead>
                                <th class="col-md-4">Group ID</th>
                                <th class="col-md-4">Name</th>
                                <th class="col-md-4">Members</th>
                                <th class="col-md-4">Action</th>
                            </thead>
                            <tbody>
                            <?php
                            $chatroom = mysqli_query($con, "SELECT * From chatroom ORDER BY ID DESC");
                            while ($row = mysqli_fetch_assoc($chatroom)) {
                            ?>

                            <tr>
                                <td class="col-md-4"><?=$row['Chatroom_ID']?></td>
                                <td class="col-md-4"><?=$row['Name']?></td>
                                <td class="col-md-4"><?=$row['Member']?></td>
                                <td class="col-md-4">
                                <button class="btn btn-primary" onClick="showModal('<?php echo $myID; ?>','<?php echo $row['Chatroom_ID'];?>','<?php echo $my_type; ?>')">Send Message</button>
                                </td>
                            </tr>
                    
                            <?php } ?>
                                       
                            
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

<div class="modal fade" id="addChatRoom" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-plus aria-hidden="true">&nbspAdd New Group Chat</i></h3>
        
      </div>
      <div class="modal-body">
        <form action="../model/addgroup.php" method="POST">
            <div class="row">
                <div class="col-md-12">
                <input type="hidden" name="admin" id="admin" value="<?=$myID?>" class="form-control">
                    <label for="">Group Chat Name:</label>
                    <input type="text" name="chatName" id="chatName" class="form-control">

                    <label for="">Member Access</label>
                    <select name="access" id="access" class="form-control">
                        <option value="" disabled selected>Member Access</option>
                        <?php
                        $query_access = mysqli_query($con, "SELECT Access from user Group by Access");
                        while ($row =mysqli_fetch_assoc($query_access)) {            
                        ?>

                        <option value="<?=$row['Access']?>"><?=$row['Access']?></option>

                        <?php } ?>
                        <option value="All">All</option>

                    </select>
                </div>
                
            </div>
      </div>
        <div class="modal-footer">
            <button type="submit" name="create" id="create" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>
<script>

var timer1=0;
var myVar;
var intervalID;
var intervalID1;

function showModal(myID,conversation_id,my_type){
	
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
		
    	xhttp.open("GET", "group_chat_history_admin.php?my_id=" + myID + "&my_type="+my_type + "&conversation_id="+conversation_id, true);												
  		xhttp.send();//MSK-00149--End Ajax
							
};

document.onkeydown=function(evt){//start press Enter Key
		
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
                                        
            if(keyCode == 13){
     
                var msg = document.getElementById('msg').value;
                var my_index = document.getElementById('myID').value;
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
                                                                                    
                        xhttp1.open("GET", "../model/add_group_message.php?conversation_id=" + conversation_id + "&my_index="+my_index  + "&msg="+msg + "&user_type="+my_type + "&do="+do1, true);												
                        xhttp1.send();

                        if(timer1 == 0){
                                intervalID = setInterval(function(){
                                     
                                    $('#chatRoom').load("group_message_history_admin1.php?my_index="+my_index+"&conversation_id="+conversation_id+"");
                                    
                                                           
                                }, 1000); // 1000 milliseconds = 1 second.
                            }
                                                
                }
                
            }
            
    };

    
    function msgRead(my_index,conversation_id,my_type,friend_index){
	
	var do1 = "confirm_msg_read";
	
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
				
    		}
			
  		};	
		
    	xhttp.open("GET", "../model/confirm_group_msg_read.php?conversation_id=" + conversation_id + "&friend_index="+friend_index + "&do="+do1 , true);												
  		xhttp.send();//MSK-000127-Ajax End
	
	
}



$(document).ready(function () {
    $('#search').DataTable();
});
</script>

<?php
if(isset($_GET["do"])&&($_GET["do"]=="showChatBox")){
	
	$my_index=$_GET['my_index'];
	$my_type=$_GET['my_type'];
	$conversation_id=$_GET['conversation_id'];
    $friend_id=$_GET['friend_index'];
    ?>
    <script>
        showModal('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $my_type; ?>')
        msgRead('<?php echo $my_index; ?>','<?php echo $conversation_id; ?>','<?php echo $my_type; ?>','<?php echo $friend_id; ?>')
    </script>
	
    <?php } 
    include_once ('footer.php')
    ?>