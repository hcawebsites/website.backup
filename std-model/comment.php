<?php
session_start();
include_once ('../database/connection.php');


if(isset($_POST['comment'])){
    $body = mysqli_real_escape_string($con, $_POST['post_text']);

    $id = $_SESSION['student_id'];
    $code = $_GET['code'];

    $sql = mysqli_query($con, "SELECT * from classroom inner join posts on classroom.Code = posts.Code WHERE classroom.Code = '$code'");
    $row = mysqli_fetch_assoc($sql);
    $postID = $row['ID'];

    $sql_insert = mysqli_query($con, "INSERT into comments (Body, Code, Posted_ID, Post_ID) Values ('$body', '$code', '$id', '$postID')");

    if($sql_insert){
        header('Location: ../student/room.php?code='.$code.'');
    }
    
}

?>