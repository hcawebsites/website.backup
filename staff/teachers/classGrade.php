<?php include_once('../../database/connection.php');

if (isset($_POST)) {
    $myID = $_GET['myID'];
    $subCode = $_POST['subCode'];
    $output = "";
   
    $get_schedule = mysqli_query($con, "SELECT * FROM schedule inner join grade on schedule.Class_ID = grade.ID WHERE Code = '$subCode' And Teacher_ID = '$myID' And Room = 'Online' Group by schedule.Class_ID");
    $output .= "<option disabled selected>Select Grade</option>";
    while ($row = mysqli_fetch_assoc($get_schedule)) {
        $output .= '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
    }

    echo $output;
    
}



?>