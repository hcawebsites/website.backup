<?php include_once('../../database/connection.php');

if (isset($_POST)) {
    $myID = $_GET['myID'];
    $code = $_GET['subCode'];
    $subject = $_POST['subject'];
    $output = "";
   
    $get_schedule = mysqli_query($con, "SELECT * FROM schedule WHERE Code = '$subject' And Teacher_ID = '$myID' And Room = 'Online' Group by schedule.Section");
    $output .= "<option disabled selected>Select Section</option>";
    while ($row = mysqli_fetch_assoc($get_schedule)) {
        $output .= '<option value="'.$row['Section'].'">'.$row['Section'].'</option>';
    }

    echo $output;
    
}



?>