<?php
include_once '../database/connection.php';

if(isset($_POST["subject_id"]))  {

    $sql = "SELECT * FROM subjects WHERE ID = '".$_POST["subject_id"]."'";
    $result = mysqli_query($con, $sql);

    while ($row =mysqli_fetch_assoc($result)) {


        $data['code'] = $row['Subject_Code'];
        $data['title'] = $row['Description'];
        $data['level'] = $row['Level'];
        $data['dept'] = $row['Department'];
        
        echo json_encode($data);
    }
}   
?>