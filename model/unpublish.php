<?php include_once('../database/connection.php');

if (isset($_POST)) {
    $isbn = $_POST['isbn'];

    $get_info = mysqli_query($con, "SELECT * FROM books Where ISBN = '$isbn'");
    $row = mysqli_fetch_assoc($get_info);
    $title = $row['Title'];
    $author = $row['Author'];
    
    $publish = mysqli_query($con, "UPDATE books SET Status = '0' Where ISBN = '$isbn'");
    if ($publish) {
        echo 'success';
    }
}

?>