<?php session_start();

if(session_destroy()){
	header("location:../student/std_login.php");

}?>