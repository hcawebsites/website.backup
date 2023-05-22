<?php include_once '../database/connection.php'?>
<?php

if (isset($_POST['saveEdit'])) {
    $id = mysqli_real_escape_string($con, $_POST['id1']);
    $student_id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $violation = mysqli_real_escape_string($con, $_POST['violation']);
    $offense = mysqli_real_escape_string($con, $_POST['offense']);
    $punishment = mysqli_real_escape_string($con, $_POST['punishment']);

    $sql = "UPDATE guidance SET Student_ID = '$student_id', Name = '$name', Violation = '$violation', Offense = '$offense', Punishment = '$punishment' 
    Where ID = '$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script>
                alert("Student Updated Successfully!");
                window.location.href = "../staff/councelor/guidance.php";
                </script>';
    }
}


?>