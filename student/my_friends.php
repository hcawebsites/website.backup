<?php include_once('main_head.php');?>
<?php include_once('../student/std_header.php'); ?>
<?php include_once('../student/std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
  <title> My Friends</title>
	
    <section class="content-header">
    	<h1>
        	My Friends
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Friend</a></li>
    	</ol>
        <hr class="line">
	</section>


    <div class="table-responsive col-md-12">
        
        <div class="table" id="data">
            

            <table class="table table-bordered table-striped" id="search">
                
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="table-hover text-center">
                    
                
                <?php
                $my_id = $_SESSION['student_id'];
                $my_type = $_SESSION['access'];
                $sql = "SELECT * FROM my_friends WHERE My_ID = '$my_id' and Status = 'Friends' ORDER BY Friend_Type DESC";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                $friend_type=$row['Friend_Type'];
                $friend_index=$row['Friend_ID'];
                $convo_id=$row['Conversation_ID'];

                if ($friend_type == "Student") {
                    $sql1 = "SELECT * FROM student_tb WHERE Student_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Student_ID'];
                    # code...
                }

                if ($friend_type == "Admin") {
                    $sql1 = "SELECT * FROM admin Where Admin_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Admin_ID'];
                    # code...
                }

                if ($friend_type == "Teacher") {
                    $sql1 = "SELECT * FROM teacher_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Librarian") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Registrar") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Emp_ID'];
                    # code...
                }

                if ($friend_type == "Clinic") {
                    $sql1 = "SELECT * FROM emp_tb Where Emp_ID = '$friend_index'";
                    $res = mysqli_query($con, $sql1);
                    $row = mysqli_fetch_assoc($res);
                    $image = $row['Picture'];
                    $id = $row['Emp_ID'];
                    # code...
                }

                ?>

                <tr>
                    <td style="vertical-align: middle;"><?php echo $id?></td>
                    <td style="vertical-align: middle;"><a href="#"onClick="friendProfile('<?php echo $friend_type; ?>','<?php echo $friend_index; ?>')"><?php echo $row['Firstname']," ", $row['Lastname']?></a></td>
                    <td style="vertical-align: middle;"><?php echo $friend_type ?></td>   

                    <td style="vertical-align: middle;"><a href="#" onClick="showModal('<?php echo $my_id; ?>','<?php echo $convo_id; ?>','<?php echo $friend_index; ?>','<?php echo $my_type; ?>')" class="btn btn-primary btn-xs"  >Send Messege</a></td>

                    
                </tr>

            <?php } }?>


                


                </tbody>


            </table>


            

        </div>


    </div>
    <div id="fProfile">
    
    </div>
    
</div>

<script>

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

</script>


<script>
    $(document).ready(function() {
        $('#search').DataTable();
    });

</script>