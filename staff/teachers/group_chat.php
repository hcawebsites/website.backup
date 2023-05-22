<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['emp_id'];
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),0, $length_of_string);
}
?>
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
                        <h4><i class="fa fa-list" aria-hidden="true">&nbspList of Group Chats</i></h4>
                        <div class="search">
                            <div class="row form-inline">
                                <button type="button" data-toggle="modal" data-target="#_create_group" class="btn btn-primary form-control">Create Group Chat</button>
                            </div>
                        </div>
                    </div>     
                    
                    <div id="">

                        <table class="table table-condensed" id="search" style="color: #666666; font-size:12px; font-weight: 500;">
                            <thead>
                                <th class="col-md-4">#</th>
                                <th class="col-md-4">Group ID</th>
                                <th class="col-md-4">Name</th>
                                <th class="col-md-4">Code</th>
                                <th class="col-md-4">Action</th>
                            </thead>
                            <tbody>
                            <?php
                                $count = 1;
                                $get = mysqli_query($con, "SELECT *, group_chat.ID as id from group_chat inner join schedule on group_chat.Sched_ID = schedule.ID Where schedule.Teacher_ID= '$myID'");
                                while ($row = mysqli_fetch_assoc($get)) {
                                  ?>
                                    <tr>
                                        <td style="vertical-align: middle;" scope="col"><?=$count++?></td>
                                        <td style="vertical-align: middle;" scope="col"><?=$row['id']?></td>
                                        <td style="vertical-align: middle;" scope="col"><?=$row['GC_Name']?></td>
                                        <td style="vertical-align: middle;" scope="col"><?=$row['G_Code']?></td>
                                        <td style="vertical-align: middle;" scope="col" class="text-center">
                                            <button type="button" class="btn btn-danger" id="<?php echo $row['id']  ?>">Send Message</button>
                                        </td>
                                    </tr>
                                  <?php                                
                              }
                            ?>
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

<div class="modal fade" id="_create_group" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="content"> 
    <div class="modal-content">
        <div class="modal-title">
            <p>
                <i class="fa fa-plus"></i>&nbsp
                Create Group Chat
            </p>
        </div>
        <div class="border"></div>
        <div class="body">
            <form action="" method="POST" id="_form-group">
                <select name="subject" id="subject" class="form-control form-group">
                    <option hidden value="" selected>Select Subject Here...</option>
                    <?php
                        
                        $get_subject = mysqli_query($con, "SELECT *, schedule.ID as id FROM schedule inner join subjects on schedule.Code = subjects.Subject_Code Where Teacher_ID = '$myID' Group By schedule.Code, schedule.Strand");
                        while ($row = mysqli_fetch_assoc($get_subject)) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['Description']?></option>

                    <?php } ?>
                </select>

                <input type="text" id="class" class="form-control form-group" readonly>

                <input type="text" id="_gc_name" name="_gc_name" placeholder="Enter Group Chat Name" class="form-control form-group">

                <input type="text" name="_gc_code" id="_gc_code" value="<?php echo random_strings(6)?>" class="form-control form-group" readonly>

                <div class="text-right">
                    <button type="button" id="save" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
  </div>
</div>
<style type="text/css">
    .modal-content {
        padding: 1rem 1rem 1rem 1rem;
    }

    .modal-content .modal-title{
        font-weight: 600;
        font-size: 16px;
    }

    .modal-content .border{
        margin-bottom: 10px;
        border: 1px solid #5c5c5c;
    }
</style>
<script>

$(document).ready(function(){
    $('#subject').change(function(){
            var sched_id = $(this).val();
            $.ajax({
                url: "filter-class.php",
                method: "POST",
                data:{
                    sched_id:sched_id
                },
                success:function(data){
                    data = JSON.parse(data);
                    $('#class').val(data.class);
                }
            })
        })
    $('#save').click(function(){
        var _gc_name = $('#_gc_name').val()
        if (_gc_name == "") {
            Swal.fire(
              'All Fields Required!',
              '',
              'info'
            )
        }else{
            $.ajax({
                url: "../../staff-model/create_group.php",
                method: "POST",
                data:$('#_form-group').serialize(),
                success:function(data){
                   if (data == "success") {
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Group Chat Created Successfully!',
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
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: data,
                      text: "",
                      icon: 'info',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                        }
                    })
                }
                }
            })
        }
    })

})

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
		
    	xhttp.open("GET", "group_chat_history_teacher.php?my_id=" + myID + "&my_type="+my_type + "&conversation_id="+conversation_id, true);												
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
                                                                                    
                        xhttp1.open("GET", "../../staff-model/add_group_message.php?conversation_id=" + conversation_id + "&my_index="+my_index  + "&msg="+msg + "&user_type="+my_type + "&do="+do1, true);												
                        xhttp1.send();

                        if(timer1 == 0){
                                intervalID = setInterval(function(){
                                     
                                    $('#chatRoom').load("group_message_history_teacher1.php?my_index="+my_index+"&conversation_id="+conversation_id+"");
                                    
                                                           
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
		
    	xhttp.open("GET", "../../staff-model/confirm_group_msg_read.php?conversation_id=" + conversation_id + "&friend_index="+friend_index + "&do="+do1 , true);												
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
    include_once ('../footer.php')
    ?>