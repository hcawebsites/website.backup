<?php
include_once '../database/connection.php';

if ($_POST) {
    $cid = mysqli_real_escape_string($con, $_POST['cid']);
    $date = date('Y-m-d');
    $data = array();
    $get = mysqli_query($con, "SELECT ID from queuing Where Cashier = '$cid' AND  queuing.Status = '1' And queuing.Date = '$date' order by queuing.ID asc  limit 1");
    while ($row = mysqli_fetch_assoc($get)){
        mysqli_query($con, "UPDATE `queuing` set Status = 0 where ID = '{$row['ID']}'");
        $data[]=$row;
    }
    echo json_encode($data);
}


?>