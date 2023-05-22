<?php include_once '../database/connection.php';

if ($_POST) {
    $gid = mysqli_real_escape_string($con,  $_POST['grade']);
    $output = "";
    $output = "<option hidden selected>Please select here</option>";

    $getGrade = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$gid'");
    $rowGrade = mysqli_fetch_assoc($getGrade);
    $grade = $rowGrade['Name'];

    $getStrand = mysqli_query($con, "SELECT * FROM strands WHERE Grade = '$grade'");

    while ($rowStrand = mysqli_fetch_assoc($getStrand)) {
        $output .= "
        <option value='".$rowStrand['Strands']."'>".$rowStrand['Strands']."</option>

        ";
    }
    echo $output;
}

?>
