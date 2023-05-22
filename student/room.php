<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); 
$myID = $_SESSION['student_id'];
$code = $_GET['code'];
date_default_timezone_set('Singapore');
$date = date('Y-m-d');
?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Room
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classroom</a></li>
            <li><a href="#">Room</a></li>
    	</ol>  
	</section>
    <hr>
    <section class="content">
        <div class="row">
            <?php
            $sql = mysqli_query($con, "SELECT *, schedule.ID as sched_id from classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE classroom.Code = '$code'");
            $row = mysqli_fetch_assoc($sql);
            $image = $row['Picture'];
            $class = $row['Name']. " " .$row['Strand']. " - ". $row['Section'];
            $sched_id = $row['sched_id'];
            ?>

                <div class="col-md-12">
                    <div class="cards" style="background-image: url(../assets/image/classroom.jpg);  background-size: cover;
	                background-position: center; background-repeat: no-repeat;color: #333; margin-top: 20px; margin-left: 50px; 
                    margin-right: 50px; padding: .5rem 1rem 1rem 2rem">
                    
                    <h1 style="margin-top: 120px; color:#fff;"><?php echo $row['Subject_Code']. " - " . $row['Description']?></h1>
                    <h4 style="color: #fff;"><?php echo $class?></h4>                    
                    
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="cards" style="background: #fff; margin-top: 10px; margin-left: 50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                    <p style="margin-top: 5px; color:#333; font-size: 16px;"><b>Teacher:</b></p>
                   <div class="text-center">
                    <img src="../assets/upload/<?=$image?>" class="" width="60px">
                    <p><?php echo $row['Salutation']. ". " .$row['Firstname']. " " .$row['Lastname']?></p>
                   </div>
                   <hr>
                        <div class="btnn text-center">                         
                            <button id="stream" class="btn form-control active">Stream</button>
                            <button id="people" class="btn form-control">People</button>                          
                            <button type="button" data-target="#_attendance" data-toggle="modal" class="btn form-control">Scan Attendance</button>
                        </div>
                    </div>
                </div>

                <div id="first">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <?php   
                                $sql = mysqli_query($con, "SELECT *, schedule.Teacher_ID as id FROM classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID inner join joinclass on classroom.Code = joinclass.Code WHERE joinclass.Student_ID = '$myID'");
                                $row1 = mysqli_fetch_assoc($sql);
                                $id = $row1['id'];
                                $post = new post($con, $id, $code);
                                $post->classStudent();
                                $post->classAssign();
                                $post->classQuiz();
                        ?>
                    </div>
                </div>

                <div id="_second">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                            
                                <div class="row">
                                    <div class="col-md-12">
                                    <p style="margin-top: 5px; color:#333; fon-size: 16px;"><b>Teacher:</b></p>
                                    
                                        <img src="../assets/upload/<?=$image?>" class="img-circle" width="50px">
                                        <span style="margin-left: 5px;"><?php echo $row['Salutation']. ". " .$row['Firstname']. " " .$row['Lastname']?></span>

                                    <hr>
                                    <p style="margin-top: 5px; color:#333; font-size: 16px;"><b>Students:</b></p>

                                    <?php 
                                    $sql1 = mysqli_query($con, "SELECT * from joinclass inner join student_grade on joinclass.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID Where joinclass.Code = '$code'");
                                    while ($row1 = mysqli_fetch_assoc($sql1)) {
                                    ?> 
                                    <p><?php echo $row1['Lastname']. " " . " " .$row1['Middlename']. " " .$row1['Firstname']?></p>

                                    <?php } ?>
                                    
                                    </div>
                                
                                </div>
                            
                        </div>
                    </div>
                </div>
       
    </section>

</div>

<div class="modal fade" id="_attendance" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <?php  
        $_get = mysqli_query($con, "SELECT * FROM class_attendance WHERE Sched_ID = '$sched_id'");
        while ($_row = mysqli_fetch_assoc($_get)) {
            if ($_row['Status'] == 1) {
                $get = mysqli_query($con, "SELECT * FROM std_attendance WHERE Student_ID = '$myID' AND Sched_ID = '$sched_id' AND Date = '$date'");
                if (mysqli_num_rows($get) > 0) {
                    ?>
                    <div class="saved text-center">
                        <i class="fa fa-warning"></i>
                        <p>Attendance Already Saved!</p>
                        <small>Thank You and Have A Nice Day!</small>
                    </div>
                    <?php  
                }else{
                    ?>
                    
                    <p>
                        <i class="fa fa-qrcode"></i>
                        Scan QR Code Here
                    </p>
                    <div class="border"></div>
                    <form action="" method="" enctype="multipart/form-data">
                        <div class="camera" id="camera">
                            <video id="scan"></video>
                        </div>
                    </form>
                    <hr>
                    <p id="clock" class="clock"></p>
                    <span><?php echo date('F j, Y')  ?></span>
                    <script type="text/javascript">
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
                            scanner.addListener('scan', function (student_id) {
                            var data = student_id + "," + "<?php echo $sched_id ?>"
                            $.ajax({
                                url: "../std-model/scan-attendance.php",
                                method: "POST",
                                data:{
                                    data:data
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
                                          title: 'Attendance Saved Successfully!',
                                          text: "",
                                          icon: 'success',
                                          showCancelButton: false,
                                          confirmButtonText: 'Close',
                                        }).then((result) => {
                                          if (result.isConfirmed) {
                                            location.reload();
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
                    <?php
                }
            }else{
                    ?>
                    <div class="saved text-center">
                        <i class="fa fa-warning"></i>
                        <p>Scanning Attendance Closed!</p>
                        <small>Thank You and Have A Nice Day!</small>
                    </div>
                    <?php
            }
        }
      ?>
    </div>
  </div>
</div>

<style type="text/css">
    .modal-content{
        padding: 1rem 1rem 1rem 1rem;
    }

    .modal-content p{
        font-size: 18px;
        font-weight: 400;
        color: #333;
    }

    .modal-content i{
        font-size: 30px;
        font-weight: 400;
        color: #333;
        margin-bottom: 20px;
    }
    .modal-content .border{
        border: 1px solid #5c5c5c;
        margin-bottom: 10px;
    }

    .modal-content #scan{
        width: 100%;
        border-radius: 1rem;
    }

    .modal-content .clock{
        font-weight: 600;
        font-size: 22px;
    } 

    .modal-content span{
        font-weight: 300;
        font-size: 14px;
    }
</style>



<script>

$(document).ready(function() {

    $("#people").click(function() { //show assignment form and hide post form 
        document.getElementById('first').style.display = "none";
        document.getElementById('_second').style.display = "block";
    });

    $("#stream").click(function() {
        document.getElementById('first').style.display = "block";
        document.getElementById('_second').style.display = "none";;
    });
});

let list = document.querySelectorAll('button');
        for (let i = 0; i<list.length; i++ ){
            list[i].onclick = function () {
                let j = 0;
                while (j < list.length) {
                    list[j++].className = 'btn form-control';
                }
                list[i].className = 'btn form-control active';
            }
        }
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

 document.getElementById("clock").innerText = hour + " : " + minute + " " + period;

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
<?php include_once('footer.php'); ?>
