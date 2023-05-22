<?php  
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php');
include_once('../../database/connection.php');
$sched_id = $_GET['data'];
$check = mysqli_query($con, "SELECT * FROM class_attendance inner join schedule on class_attendance.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID Where class_attendance.Sched_ID = '$sched_id'");
$row = mysqli_fetch_assoc($check);
$dept = $row['Department'];
$myID = $_SESSION['emp_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Attendance
            <small>Preview</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashbard"></i>&nbspHome</a></li>
            <li><a href="#"><i class="fa fa-book"></i>&nbspSubject</a></li>
            <li><a href="#"><i class="fa fa-calendar"></i>&nbspAttendance</a></li>
        </ol>
        <hr>
    </section>

    <section class="content">
        <hr>
        <div class="table-master">
            <div class="row">
            <div class="subject-info">
                <div class="col-md-3"></div>

                    <div class="col-md-5">
                        <?php
                            if ($dept == "SHSDEPT") {

                               $class = $row['Name']." ".$row['Strand']. " - " .$row['Section'];
                                echo '<small>'.$row['Description'].' | <span>'.$class.'</span></small>';
                            }else{
                                $class = $row['Name']. " - " .$row['Section'];
                                echo '<small>'.$row['Description'].' | <span>'.$class.'</span></small>';
                            }
                        ?>
                    </div>

                    <div class="col-md-4">
                        <button type="button" id="<?php echo $sched_id?>" class="btn btn-danger form-control stop"><i class="fa fa-hand-paper-o"></i>&nbspStop Scanning</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="qrcode text-center">
                        <p><i class="fa fa-qrcode">&nbspTap Here</i></p>
                    </div>

                    <div class="camera" id="camera">
                        <video id="scan" width="100%"></video>
                    </div>
                    
                    <div id="alert" role="alert">
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="info-clock text-center">
                        <span id="clock"></span> &nbsp<span class="fa fa-clock-o"></span>
                        <p><i class="fa fa-calendar"></i>&nbsp<?=date("F j, Y")?></p>
                    </div>

                    <table class="table table-striped table-bordered" id="search" style="color: #5c5c5c; font-size:12px; font-weight: 500;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Remark</th>
                                <th>Log Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 1;
                                $date = date('Y-m-d');
                                $get = mysqli_query($con, "SELECT *, concat(Firstname, ' ' , Lastname) as name, std_attendance.Status as status FROM std_attendance inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join schedule on std_attendance.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code WHERE std_attendance.Sched_ID = '$sched_id' AND schedule.Teacher_ID = '$myID' AND std_attendance.Date = '$date'");
                                while ($row = mysqli_fetch_assoc($get)) {
                                    $picture = $row['Picture'];
                                    $in = date('h:i A', strtotime($row['Time_In'] ?? ''));
                                    $out = date('h:i A', strtotime($row['Time_Out'] ?? ''));
                                    $date = date('F j, Y', strtotime($row['Date']));
                                ?>
                                <tr>
                                    <td scope="col" style="vertical-align: middle;"><?=$count++?></td>
                                    <td scope="col" style="vertical-align: middle;" class="text-center"><img src="../../assets/upload/<?=$picture?>" class="img-rounded" width="50px"></td>
                                    <td scope="col" style="vertical-align: middle;"><?=$row['name']?></td>
                                    <td scope="col" style="vertical-align: middle;"><?=$in?></td>
                                    <td scope="col" style="vertical-align: middle;"><?=$out?></td>
                                    <td scope="col" class="text-center" style="vertical-align: middle;">
                                        <?php
                                        if ($row['status'] == "On Time") {
                                            echo '<p style="background-color: #74fa5f">On Time</p>';
                                        }else if($row['status'] == 'Late'){
                                            echo '<p style="background-color: #b2c40e; color: #fff;">Late</p>';
                                        }else{
                                            echo '<p style="background-color: #fa5f5f; color: #fff;">Absent</p>';
                                        }
                                        ?>
                                    </td>
                                    <td scope="col" style="vertical-align: middle;"><?=$date?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once '../footer.php' ?>
<script type="text/javascript">
var timer1=0;
var myVar;
var intervalID;
var intervalID1;

let scanner = new Instascan.Scanner({video: document.getElementById('scan')});
Instascan.Camera.getCameras().then(function(cameras){
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    }else{
        alert("No Camera Found!");
    }
}).catch(function(e){
    console.error(e);
});

$(document).ready(function(){
    $('#search').DataTable();

    scanner.addListener('scan', function (student_id) {
        var student_id = student_id;
        $.ajax({
            url: "../../staff-model/std_attendance.php?sched_id=<?=$sched_id?>",
            method: "POST",
            data:{
                student_id:student_id
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
    })

    $('.stop').click(function(){
        var sched_id = $(this).attr("id");
        $.ajax({
            url: "../../staff-model/stop_attendance.php",
            method: "POST",
            data:{
                sched_id:sched_id
            },
            success:function(data){
                if (data == "success") {
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Attendance Successfully Stoped!',
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'scan_attendance.php?data='+sched_id;
                        }
                    })
                }else{
                    Swal.fire(
                      data,
                      '',
                      'warning'
                    )
                }
            }
        })
    })
})
</script>