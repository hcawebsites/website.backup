<?php include_once 'database/connection.php'  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Camera Links -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- END -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
    <link rel="icon" href="assets/image/logo.png">
    <link rel="stylesheet" href="css/attendance.css">
</head>
<body>
    <header class="header">
        <img src="assets/image/holy_logo.jpg" width="60px">
        <span>Attendance Monitoring System</span>
    </header>
    <div class="content-wrapper">
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="qrcode text-center">
                            <p><i class="fa fa-qrcode">&nbspTap Here</i></p>
                        </div>

                        <div class="camera" id="camera">
                            <video id="scan" width="100%"></video>
                        </div>
                    
                        <div id="alert" role="alert">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="info-clock text-center">
                        <span id="clock"></span> &nbsp<span class="fa fa-clock-o"></span>
                            <p><i class="fa fa-calendar"></i>&nbsp<?=date("F j, Y")?></p>
                        </div>
                        <table class="table table-striped table-bordered" id="search" style="font-size: 13px; font-weight: 400">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>EMPLOYEE ID</th>
                                    <th>Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                    <th>Access</th>
                                    <th>LOG DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    $date = date('Y-m-d');
                                    $get = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Date = '$date'");
                                    while ($row = mysqli_fetch_assoc($get)) {
                                    ?>
                                    <tr>
                                        <td scope="col"><?=$count++?></td>
                                        <td scope="col"><?=$row['Emp_ID']?></td>
                                        <td scope="col"><?=$row['Name']?></td>
                                        <td scope="col"><?=date('h:i A', strtotime($row['Time_In']))?></td>
                                        <td scope="col"><?=date('h:i A', strtotime($row['Time_Out']))?></td>
                                        <td scope="col" class="text-center" style="vertical-align: middle;">
                                            <?php
                                            if ($row['Status'] == 1) {
                                                echo '<p style="background-color: #74fa5f">On Time</p>';
                                            }else if($row['Status'] == 2){
                                                echo '<p style="background-color: #b2c40e; color: #fff;">Late</p>';
                                            }else{
                                                echo '<p style="background-color: #fa5f5f; color: #fff;">Absent</p>';
                                            }
                                            ?>
                                        </td>
                                        <td scope="col"><?=$row['Access']?></td>
                                        <td scope="col"><?=date('F j, Y', strtotime($row['Date']))?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>

                
                </div>
        </div>
    </div>
</body>
</html>

<script>
$(document).ready(function(){
    $('#search').DataTable();
})
var timer1=0;
var myVar;
var intervalID;
var intervalID1;
let scanner = new Instascan.Scanner({video: document.getElementById('scan')});
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        }
        else{
            alert("No Camera Found!");
        }
    }).catch(function(e){
        console.error(e);
});

$(document).ready(function(){  
    scanner.addListener('scan', function(employee_id) {
        var id = employee_id;

        $.ajax({
            url: "model/attendance.php",
            method: "POST",
            data: {
                id:id
            }, 
            success:function(data){
                document.getElementById('alert').innerHTML = data;
                if(timer1 == 0){
                intervalID = setInterval(function(){
                    location.reload();
                }, 3000); // 1000 milliseconds = 1 second.
            }
            }

        })


    });
});

function Time() {

 var date = new Date();

 var hour = date.getHours();

 var minute = date.getMinutes();

 var second = date.getSeconds();

 var period = "";

 if (hour >= 12) {
 period = "PM";
 } else {
 period = "AM";
 }

 if (hour == 0) {
 hour = 12;
 } else {
 if (hour > 12) {
 hour = hour - 12;
 }
 }

 hour = update(hour);
 minute = update(minute);
 second = update(second);

 document.getElementById("clock").innerText = hour + " : " + minute + " : " + second + " " + period;

 setTimeout(Time, 1000);
}

function update(t) {
 if (t < 10) {
 return "0" + t;
 }
 else {
 return t;
 }
}
Time();

</script>
<style>
.info h3{
    font-size: 32px;
    font-weight: 600;
    border-style: outset;
    padding: 2rem 2rem 2rem 2rem;
}
.info p{
    font-size: 20px;
    font-weight: 300;
    border-style: outset;
    padding: 2rem 2rem 2rem 2rem;
}
</style>