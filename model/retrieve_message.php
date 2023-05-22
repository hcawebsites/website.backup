<?php
error_reporting(0);
include_once '../database/connection.php';
$conversation_id = mysqli_real_escape_string($con, $_POST['conversation_id']);
$output = "";

$query_message = mysqli_query($con, "SELECT * from online_chat Where Conversation_ID = '$conversation_id'");
while ($row = mysqli_fetch_assoc($query_message)) {

    $userID = $row['User_ID'];
    $msg = $row['Message'];
    $user_type = $row['Type'];

    if($user_type == "Admin"){
                                            
        $sql1=mysqli_query($con, "SELECT * from admin where Admin_ID = '$userID'");
        $row1=mysqli_fetch_assoc($sql1);
        $image= $row1 ['Picture'];
        $name = $row1['Firstname']. " " .$row1['Lastname']. " - " .$user_type;
        
    }
    
    elseif($user_type == "Teacher"){
        
        $sql1=mysqli_query($con, "SELECT * from teacher_tb where Emp_ID = '$userID'");
        $row1=mysqli_fetch_assoc($sql1);
        $image= $row1 ['Picture'];
        $name = $row1['Salutation']. ". " .$row1['Firstname']. " " .$row1['Lastname']. " - " .$user_type;
        
        
    }
    
    elseif($user_type == "Student"){
        
        $sql1=mysqli_query($con, "SELECT * from student where Student_ID = '$userID'");
        $row1=mysqli_fetch_assoc($sql1);
        $image= $row1 ['Picture'];
        $name = $row1['Firstname']. " " .$row1['Lastname']. " - " .$user_type;
        
    }
    $output .= '<tr class="msg-tr">
    <td style="border:none;">
        <img class="logo1" src="../assets/upload/'.$image.'" >
        <div>
        <p>'.$name.'</p>
        <p class="msg-p2"> '.$msg.' </p>
        </div>
        
    </td>
    </tr>';
}

echo $output;



?>