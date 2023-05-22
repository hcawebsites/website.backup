<?php include_once ('../database/connection.php');
session_start();
if (isset($_POST['start'])) {
	
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $sy = mysqli_real_escape_string($con, $_POST['sy']);
   

    $sql = "INSERT INTO academic_list (School_Year, Semester, is_default, Status) VALUES ('$sy', '$semester', 1, 1)";
    $result = mysqli_query($con, $sql);

    $data = [
        'School_Year' => $sy,
        'Semester' => $semester,
        'is_default' => '1',
        'Status' => '1'
    ];
    $ref = "std_account";
    $newPostKey = $database->getReference('academic_list/')->set($data);

    if ($result) {
        $sql = "UPDATE academic_list Set is_default = '0' WHERE Status = '0'";
        $result1 = mysqli_query($con, $sql);
        if ($result1) {
        echo "<script>alert('Enrollment officialy Started!')</script>";
        echo "<script>window.location.href='../admin/enrollment_list.php'</script>";
        }
        echo "<script>alert('Enrollment officialy Started!')</script>";
        echo "<script>window.location.href='../admin/enrollment_list.php'</script>";
    }else{
        echo "<script>alert('Something went wrong!')</script>";
        echo "<script>window.location.href='../admin/enrollment_list.php'</script>";
    }
}

if (isset($_POST['stop'])) {
    
    $sql = "UPDATE academic_list Set Status = '0' WHERE is_default = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Enrollment officialy Stoped!')</script>";
        echo "<script>window.location.href='../admin/enrollment_list.php'</script>";
    }else{
        echo "<script>alert('Something went wrong!')</script>";
        echo "<script>window.location.href='../admin/enrollment_list.php'</script>";
    }


}

?>