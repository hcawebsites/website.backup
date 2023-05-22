<?php
include_once('../database/connection.php');

if (isset($_POST['joinclass'])) {
    $myID = mysqli_real_escape_string($con, $_POST['myID']);
    $code =mysqli_real_escape_string($con, $_POST['classCode']);

    $check_joinclass = mysqli_query($con, "SELECT * FROM joinclass Where Code = '$code' And Student_ID = '$myID'");
    if (mysqli_num_rows($check_joinclass) > 0) {
        echo '<script>
            alert("You belong in this classroom!");
            window.location.href="../student/add_classroom.php";
        </script>';
    }else{

        $check_classroom = mysqli_query($con, "SELECT * From classroom Where Code = '$code'");
        if (mysqli_num_rows($check_classroom) > 0) {
            $insert_class = mysqli_query($con, "INSERT INTO joinclass(Code, Student_ID) VALUES ('$code', '$myID')");
            if ($insert_class) {
                header('location: ../student/classroom.php');
                mysqli_query($con, "INSERT INTO chatroom_member(Chatroom_ID, Member_ID, Access) VALUES ('$code', '$myID', 'Student')");
            }
            
        }else{
            echo '<script>
            alert("Class Code Incorrect!");
            window.location.href="../student/classroom.php";
        </script>';
        }
        
    }
}
?>