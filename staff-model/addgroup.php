<?php include_once '../database/connection.php';

$newID = mysqli_real_escape_string($con, $_POST['newID']);
$myID = mysqli_real_escape_string($con, $_POST['myID']);
$subjects = mysqli_real_escape_string($con, $_POST['subjects']);
$grade = mysqli_real_escape_string($con, $_POST['grade']);
$section = mysqli_real_escape_string($con, $_POST['section']);

$chatName = $grade. " " .$section. " " .$subjects;
$members = $grade. " " .$section;

$prefix = substr(str_shuffle(implode(range("a","z"))),0,8);
$room_id = $prefix.(sprintf(rand(1,99999999)));

$prefix1 = substr(str_shuffle(implode(range("a","z"))),0,4);
$code = $prefix1.(sprintf(rand(1,9999)));

$check_group = mysqli_query($con, "SELECT * FROM chatroom Where Member = '$members'");
if (mysqli_num_rows($check_group) > 0) {
    echo '<script>
        alert("Group Chat Already Exists!");
        window.location.href="../staff/teachers/group_chat.php";
    
    </script>';
}else{
    $insert_chatroom = mysqli_query($con, "INSERT INTO chatroom (Chatroom_ID, Name, Member, Code) VALUES ('$room_id', '$chatName', '$members', '$code')");
    $last_id = mysqli_insert_id($con);

    if ($insert_chatroom) {
        $insert_admin = mysqli_query($con, "INSERT INTO chatroom_member (Chatroom_ID, Member_ID) Values ('$room_id', '$myID')");

        if ($insert_admin) {
            $get_members = mysqli_query($con, "SELECT * FROM classroom inner join joinclass on classroom.Code = joinclass.Code WHERE Teacher_ID = '$newID' AND Grade = '$grade' AND Section = '$section'");
            
                while ($row_members = mysqli_fetch_assoc($get_members)) {
                $user_id = $row_members['Student_ID'];

                $insert_members = mysqli_query($con, "INSERT INTO chatroom_member (Chatroom_ID, Member_ID) Values ('$room_id', '$user_id')");
                if ($insert_members) {
                
                    header("location: ../staff/teachers/group_chat.php");
                }
            }
        }
    }
}




?>