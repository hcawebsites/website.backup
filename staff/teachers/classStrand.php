<?php include_once('../../database/connection.php');

if (isset($_POST)) {
    $myID = $_GET['myID'];
    $subject = $_POST['subject'];
    $output = "";
   
    $get_schedule = mysqli_query($con, "SELECT * FROM schedule WHERE Code= '$subject' And Teacher_ID = '$myID' And Room = 'Online' Group by schedule.Strand");
    $output .= "<option disabled selected>Select Strand</option>";
    while ($row = mysqli_fetch_assoc($get_schedule)) {
        $output .= '<option value="'.$row['Strand'].'">'.$row['Strand'].'</option>';
    }

    echo $output;
    
}



?>