<?php 
include_once '../database/connection.php';

if ($_POST) {
    $gid = mysqli_real_escape_string($con, $_POST['grade']);

    $selectSection = mysqli_query($con, "SELECT * FROM grade WHERE ID = '$gid'");
    while ($rowSection = mysqli_fetch_assoc($selectSection)) {
        $data['section'] = $rowSection['Section'];
    }

    echo json_encode($data);
}


?>