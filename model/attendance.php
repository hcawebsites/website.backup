<?php  
include_once '../database/connection.php';
date_default_timezone_set('Singapore');
$get = mysqli_query($con, "SELECT * FROM str_staff_attendance WHERE ID = '1'");
$row = mysqli_fetch_assoc($get);
$time = $row['Start_Time'];
$default = date('H:i:s');
$new_time = date('H:i:s', strtotime("+30 minutes", strtotime($time)));
$date = date('Y-m-d');
$staff_id = mysqli_real_escape_string($con, $_POST['id']);

if ($row['Status'] == 1) {
    $check = mysqli_query($con, "SELECT * FROM user WHERE Username = '$staff_id'");
    if (mysqli_num_rows($check) > 0) {
        if ($default <= $new_time) {
            $row_emp = mysqli_fetch_assoc($check);
            $name = $row_emp['Firstname']. " " .$row_emp['Middlename']. " " .$row_emp['Lastname'];
            $access = $row_emp['Access'];
            $check_attendance = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Emp_ID = '$staff_id' AND Date = '$date'");
            if (mysqli_num_rows($check_attendance) > 0) {
                $update = mysqli_query($con, "UPDATE emp_attendance SET Time_Out = '$default' WHERE Emp_ID = '$staff_id' AND Date ='$date'");
                    if ($update) {
                        echo '<div class="alert alert-danger" role="alert">
                        <p style="font-weight: bolder; font-size: 22px"><i class="fa fa-clock-o"></i>&nbspTime Out</p>
                        <p style="font-weight: bolder; font-size: 16px">Your Time Out: '.date('h:i A').'</p>
                        </div>';
                    }
            }else{
                $insert_attendance = mysqli_query($con, "INSERT INTO emp_attendance(Emp_ID, Name, Time_In, Status, Access) VALUES ('$staff_id', '$name', '$default', '1', '$access')");
                if ($insert_attendance) {
                    echo '
                        <div class="alert alert-success" role="alert">
                        <p style="font-weight: bolder; font-size: 22px"><i class="fa fa-clock-o"></i>&nbspTime In</p>
                        <p style="font-weight: bolder; font-size: 16px">Your Time In: '.date('h:i A').'</p>
                        </div>';
                }
            }
        }else{
            $row_emp = mysqli_fetch_assoc($check);
            $name = $row_emp['Firstname']. " " .$row_emp['Middlename']. " " .$row_emp['Lastname'];
            $access = $row_emp['Access'];
            $check_attendance = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Emp_ID = '$staff_id' AND Date = '$date'");
            if (mysqli_num_rows($check_attendance) > 0) {
                $update = mysqli_query($con, "UPDATE emp_attendance SET Time_Out = '$default' WHERE Emp_ID = '$staff_id' AND Date ='$date'");
                    if ($update) {
                        echo '<div class="alert alert-danger" role="alert">
                        <p style="font-weight: bolder; font-size: 22px"><i class="fa fa-clock-o"></i>&nbspTime Out</p>
                        <p style="font-weight: bolder; font-size: 16px">Your Time Out: '.date('h:i A').'</p>
                        </div>';
                    }
            }else{
                $insert_attendance = mysqli_query($con, "INSERT INTO emp_attendance(Emp_ID, Name, Time_In, Status, Access) VALUES ('$staff_id', '$name', '$default', '2', '$access')");
                if ($insert_attendance) {
                    echo '
                        <div class="alert alert-success" role="alert">
                        <p style="font-weight: bolder; font-size: 22px"><i class="fa fa-clock-o"></i>&nbspTime In</p>
                        <p style="font-weight: bolder; font-size: 16px">Your Time In: '.date('h:i A').'</p>
                        </div>';
                }
            }
        }
    }else{
         echo '<div class="alert alert-danger" role="alert">
        <p style="font-weight: bolder; font-size: 20px">QR Code Not Registered!</p>
        </div>';
    }
}else{
    echo '<div class="alert alert-danger" role="alert">
        <p style="font-weight: bolder; font-size: 18px">Scanning Attendance Already Stoped!</p>
        </div>';
}
?>