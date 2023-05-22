<?php include_once('../database/connection.php');

if (isset($_POST['create'])) {
    $chatName = mysqli_real_escape_string($con, $_POST['chatName']);
    $members = mysqli_real_escape_string($con, $_POST['access']);
    $prefix = substr(str_shuffle(implode(range("a","z"))),0,4);
    $code = $prefix.(sprintf(rand(1,9999)));
    $admin_id = mysqli_real_escape_string($con, $_POST['admin']);
    $room_id = (sprintf(rand(1,999999999999)));

    if ($members == "All") {
        $insert_chatroom = mysqli_query($con, "INSERT INTO chatroom (Chatroom_ID, Name, Member, Room_Admin, Code) VALUES ('$room_id', '$chatName', '$members', '$admin_id', '$code')");
        $last_id = mysqli_insert_id($con);
    
        if ($insert_chatroom) {

                $get_members = mysqli_query($con, "SELECT * FROM user WHERE Username != '$admin_id'");
        
                while ($row_members = mysqli_fetch_assoc($get_members)) {
                $user_id = $row_members['Username'];
                
        
        
                $insert_members = mysqli_query($con, "INSERT INTO chatroom_member (Chatroom_ID, Member_ID) Values ('$room_id', '$user_id')");
                if ($insert_members) {
                
                    header("location: ../admin/group_chat.php");
                }
           }
        
        
        }
    }else{
        $insert_chatroom = mysqli_query($con, "INSERT INTO chatroom (Chatroom_ID, Name, Member, Room_Admin, Code) VALUES ('$room_id', '$chatName', '$members', '$admin_id', '$code')");
        $last_id = mysqli_insert_id($con);
    
        if ($insert_chatroom) {

                $get_members = mysqli_query($con, "SELECT * FROM user Where Username != '$admin_id'");
        
                while ($row_members = mysqli_fetch_assoc($get_members)) {
                $user_id = $row_members['Username'];
                
        
        
                $insert_members = mysqli_query($con, "INSERT INTO chatroom_member (Chatroom_ID, Member_ID, Access) Values ('$room_id', '$user_id', '$members')");
                if ($insert_members) {
                
                        header("location: ../admin/group_chat.php");
                }
           }
               
        
        }
    }
}


?>