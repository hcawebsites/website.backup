<?php  
include_once '../database/connection.php';
extract($_POST);

$sched_id = mysqli_real_escape_string($con, $_POST['subject']);
$name = mysqli_real_escape_string($con, $_POST['_gc_name']);
$code = mysqli_real_escape_string($con, $_POST['_gc_code']);

$check = mysqli_query($con, "SELECT * FROM group_chat WHERE Sched_ID = '$sched_id'");
if (mysqli_num_rows($check) > 0) {
    echo "Group Chat Already Created!";
}else{
    $insert = mysqli_query($con, "INSERT INTO group_chat (Sched_ID, GC_Name, G_Code) Values ('$sched_id', '$name', '$code')");
    if ($insert) {
    	$gc_id = mysqli_insert_id($con);
    	$_get = mysqli_query($con, "SELECT * FROM handle_student WHERE Sched_ID = '$sched_id'");
    	while ($row = mysqli_fetch_assoc($_get)) {
    		$std_id = $row['Student_ID'];
    		mysqli_query($con, "INSERT INTO group_member (GC_ID, Member_ID) Values ('$gc_id', '$std_id')");
    	}
    }
    echo "success";
}

?>