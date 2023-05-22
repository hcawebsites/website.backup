<?php include_once '../../database/connection.php';
$output = "";
$output .="
        <option hidden selected>Please select here</option>
        ";
if ($_POST) {
    $grade = mysqli_real_escape_string($con, $_POST['gid']);
    $selectGrade = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$grade'");
    $rowGrade = mysqli_fetch_assoc($selectGrade);
    $gradeName = $rowGrade['Name'];

    $selectStrand = mysqli_query($con, "SELECT * FROM strands Where Grade = '$gradeName'");
    while ($rowStrand = mysqli_fetch_assoc($selectStrand)) {
        $output .="
        <option value='".$rowStrand['Strands']."'>".$rowStrand['Strands']."</option>
        ";
    }
    echo $output;
}


?>