<tbody>

<?php
include_once("../database/connection.php");
$my_index=$_GET['my_index'];
$conversation_id=$_GET['conversation_id'];

$result=mysqli_query($con, "SELECT * from online_chat where conversation_id='$conversation_id'");
while($row=mysqli_fetch_assoc($result)){
	
	$user_index=$row['User_ID'];
	$msg=$row['Message'];
	$user_type=$row['Type'];
	
	if($user_index==$my_index){
        $sql1=mysqli_query($con, "SELECT * from student where Student_ID = '$user_index'");
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
        
            $sql1=mysqli_query($con, "SELECT * from admin where Admin_ID = '$user_index'");
            $row1=mysqli_fetch_assoc($sql1);
            $image= $row1 ['Picture'];
            
        }
        
        elseif($user_type == "Teacher"){
            
            $sql1=mysqli_query($con, "SELECT * from teacher_tb where Emp_ID = '$user_index'");
            $row1=mysqli_fetch_assoc($sql1);
            $image= $row1 ['Picture'];
            
        }
        
        elseif($user_type == "Student"){
            
            $sql1=mysqli_query($con, "SELECT * from student where Student_ID = '$user_index'");
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
                                 