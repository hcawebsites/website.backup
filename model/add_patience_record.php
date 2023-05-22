<?php
include_once '../database/connection.php';

if (isset($_POST['save'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $medicine = mysqli_real_escape_string($con, $_POST['medicine']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $illness = mysqli_real_escape_string($con, $_POST['illness']);

    $sql = "INSERT INTO patience_record (Student_ID, Name, Medicine, Quantity, Illness) VALUES ('$student_id', '$name', '$medicine', '$quantity', '$illness')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo '<script>
                alert("Patience Record Successfully Added!");
                window.location.href="../admin/patience_record.php";
        
        </script>';
    }
}



?>