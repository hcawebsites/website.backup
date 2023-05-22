<?php include_once '../database/connection.php';

if ($_POST) {
    $gid = mysqli_real_escape_string($con,  $_POST['grade']);
    $output = "";
    $output = "<option hidden selected>Please select here</option>";

    $getStrand = mysqli_query($con, "SELECT * FROM strands WHERE Grade = '$gid'");

    while ($rowStrand = mysqli_fetch_assoc($getStrand)) {
        $output .= "
        <option value='".$rowStrand['Strands']."'>".$rowStrand['Description']."</option>

        ";
    }
    echo $output;
}

?>
