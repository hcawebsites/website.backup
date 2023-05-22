<?php

class user{

    public function __construct($con, $id, $code){
        $this->con = $con;
        $this->id = $id;
        $user_details_query = mysqli_query($con, "SELECT * FROM teacher_tb WHERE Emp_ID='$id'");
        $this->user = mysqli_fetch_array($user_details_query);
        $user2_details_query = mysqli_query($con, "SELECT * FROM classroom WHERE Code='$code'");
        $this->code= mysqli_fetch_array($user2_details_query);
        $user2_details_query = mysqli_query($con, "SELECT * FROM classroom WHERE Teacher_ID = '$user'");
        $this->user2= mysqli_fetch_array($user2_details_query);
    }
    
}

?>