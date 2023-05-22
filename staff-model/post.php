<?php include_once '../database/connection.php';

if(isset($_POST['post'])){
    $post = mysqli_real_escape_string($con, $_POST['post_text']);
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
   
   $allowed  = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'xlsx', 'pptx', 'ppt');

   if(!$fileName){
    $sql = mysqli_query($con, "INSERT into posts (Body, Post_By, Code, Files, Destination) VALUES ('$post', '$id', '$code', 'None', 'None')");
                if($sql){
                    header('location: ../staff/teachers/room.php?code='.$code.'');
                }
   }else{
    
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000000) {
                $fileNameNew = uniqid(" ", true) . "." . $fileActualExt;
                $fileDestination = '../upload_files/' . $fileName;
                move_uploaded_file($fileTmpName, $fileDestination); //file uploaded okay

                $sql = mysqli_query($con, "INSERT into posts (Body, Post_By, Code, Files, Destination) VALUES ('$post', '$id', '$code', '$fileName', '$fileDestination')");
                if($sql){
                    header('location: ../staff/teachers/room.php?code='.$code.'');
                }
            } else {
                echo "your file is too big";
            }
        } else {
            echo "Error uploading your file!  ";
        }
    } else {
        echo "You can't upload file of this";
    }

   }


}


?>