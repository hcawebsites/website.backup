<?php include_once '../database/connection.php';
include_once "../phpqrcode/qrlib.php"; 

$id = mysqli_real_escape_string($con, $_POST["id"]);
$lrn = mysqli_real_escape_string($con, $_POST["lrn"]);
$lastname = mysqli_real_escape_string($con, $_POST["lastname"]);
$firstname = mysqli_real_escape_string($con, $_POST["firstname"]);
$middlename = mysqli_real_escape_string($con, $_POST["middlename"]);
$suffix = mysqli_real_escape_string($con, $_POST["suffix"]);
$guard = mysqli_real_escape_string($con, $_POST["guard"]);
$phone = mysqli_real_escape_string($con, $_POST["phone"]);
$pic = mysqli_real_escape_string($con, $_POST["pic"]);

$location = "../assets/qrcode/".$id.".png";
$qrimage = $id.".png";
    
    $sql = "INSERT INTO id_request(ID_Number, LRN, Lastname, Firstname, Middlename, Suffix, Guardian, Contact, Picture, QR_Code, Status) 
    VALUES ('$id', '$lrn', '$lastname', '$middlename', '$firstname', '$suffix', '$guard', '$phone', '$pic', '$qrimage', 1)";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $updt= "UPDATE student Set ID_Card = '1' Where Student_ID = '$id'";
        $res = mysqli_query($con, $updt);

        if ($res) {
            echo "Success";
            QRcode::png($id, $location, '20', '20');
        }
    }

?>