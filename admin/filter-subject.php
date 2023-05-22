<?php include_once '../database/connection.php';

if ($_POST) {
    $gid = mysqli_real_escape_string($con,  $_POST['grade']);
    $output = "";
    $output = "<option hidden selected>Please select here</option>";

    $getGrade = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$gid'");
    $rowGrade = mysqli_fetch_assoc($getGrade);
    $grade = $rowGrade['Name'];

    $getSubject = mysqli_query($con, "SELECT * FROM subjects WHERE Level = '$grade'");

    while ($rowSubject = mysqli_fetch_assoc($getSubject)) {
        $output .= "
        <option value='".$rowSubject['Subject_Code']."'>".$rowSubject['Description']."</option>

        ";
    }
    echo $output;
}

?>
