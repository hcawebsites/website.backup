<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['emp_id'];
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
            $sql = mysqli_query($con, "SELECT * FROM classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where classroom.Code = '$code'");
            $row = mysqli_fetch_assoc($sql);
            $image = $row['Picture'];
            $class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
            $sched_id = $row['Sched_ID'];
            ?>

                <div class="col-md-12">
                    <div class="cards" style="background-image: url(../../assets/image/classroom.jpg);  background-size: cover;
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
                            <img src="../../assets/upload/<?=$image?>" class="" width="60px">
                            <p><?php echo $row['Salutation']. ". " .$row['Firstname']. " " .$row['Lastname']?></p>
                        </div>
                        <hr>
                        <div class="btnn text-center">                         
                            <button id="str" class="btn form-control active">Stream</button>
                            <button id="peo" class="btn form-control">People</button>                          
                            <button id="class" class="btn form-control">Classwork</button>
                            <button id="attendance" class="btn form-control">Attendance</button>
                        </div>
                    </div>
                </div>
                
                <div id="stream">
                    <div class="col-md-8">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                            <form action="../../staff-model/post.php" id="form-post" method="POST" enctype="multipart/form-data">
                                <div class="row">

                                <input type="hidden" name="code" value="<?=$code?>">
                                <input type="hidden" name="id" value="<?=$row['Teacher_ID'];?>">
                                    <div class="col-md-10">
                                        <textarea required style="resize: none;" name='post_text' id='post_text_area' class="form-control" placeholder='Share something...'></textarea>
                                    </div>

                                    <div class="col-md-2">
                                        <input type="submit" name="post" id="post" class="btn btn-success form-control" value="Post" style="height: 55px; width: 100px; margin-left: -15px">
                                    </div>

                                    
                                    <div class="col-md-6" style="margin-left: 150px; margin-top: 5px;">
                                        <input type="file" name="file" class="form-control"  id="file">
                                    </div>
                                    
                                </div>
                            
                            </form>
                        </div>
                        <?php
                                $post = new post($con, $myID, $code);
                                $post->loadpost();
                                $post->viewAssignment();
                                $post->viewQuiz();
                                
                        ?>
                    </div>
                </div>

                <div id="people">
                    <div class="col-md-8">
                        <div class="cards" style="background: #fff; margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                            <form action="../../staff-model/post.php" id="form-post" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                    <p style="margin-top: 5px; color:#333; fon-size: 16px;"><b>Teacher:</b></p>
                                    
                                        <img src="../../assets/upload/<?=$image?>" class="img-circle" width="50px">
                                        <span style="margin-left: 5px;"><?php echo $row['Salutation']. ". " .$row['Firstname']. " " .$row['Lastname']?></span>

                                    <hr>
                                    <p style="margin-top: 5px; color:#333; font-size: 16px;"><b>Students:</b></p>

                                    <?php 
                                    $sql1 = mysqli_query($con, "SELECT * FROM joinclass inner join student_grade on joinclass.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID inner join classroom on joinclass.Code = classroom.Code WHERE classroom.Code = '$code'");
                                    if (mysqli_num_rows($sql1) > 0) {
                                    
                                    while ($row1 = mysqli_fetch_assoc($sql1)) {
                                    ?> 
                                    <p><?php echo $row1['Lastname']. " " . " " .$row1['Middlename']. " " .$row1['Firstname']?></p>

                                    <?php } }else{
                                       ?> 
                                       <p>No Student Yet!</p>
                                   <?php } ?>
                                    
                                    </div>
                                
                                </div>
                            
                            </form>
                            
                        </div>
                    </div>
                </div>

                <div id="classwork">
                    <div class="col-md-8">
                        <div class="cards" style="margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">

                            <div class="row">
                                <div class="col-md-6">
                                    <button id="ass" style="background: #4d5bf9; color:#fff;"><i class="fa fa-plus"></i>&nbspAssignment</button>
                                </div>

                                <div class="col-md-6">
                                   <button id="quiz" style="background: #4d5bf9; color:#fff;"><i class="fa fa-plus"></i>&nbspQuiz</button>
                                </div>
                            
<hr>

                                    <div style="display: none;" id="assignment" >
                                        <iframe src="assignment.php?class_code=<?=$code?>" style="padding: 1rem 1rem 1rem 1rem" class="col-md-12 " frameborder="0" height="580px" scrolling="no">
                                        </iframe>
                                    </div>

                                    <div style="display: none;" id="quizDetails" >
                                        <div class="assigment-wrapper">
                                            <form action="../../staff-model/createQuiz.php?class_code=<?=$code ?>" method="POST" enctype="multipart/form-data">
                                                <label>Title:</label>
                                                <input type="text" name="title" id="title" class="form-control" >
                                                <label>Number of Questions:</label>
                                                <input type="number" name="totalQuiz" id="totalQuiz" class="form-control" >
                                                <label>Time Limit:<small> In Minutes</small></label>
                                                <input type="number" name="time" id="time" class="form-control" >
                                                <label>Due Date:</label>
                                                <input type="date" name="dueDate" id="dueDate" class="form-control" >
                                                <label>Due Time:</label>
                                                <input type="time" name="dueTime" id="dueTime" class="form-control" >
                                                <label>Description:</label>
                                                <textarea name="description" id="description" cols="30" rows="2" class="form-control form-group"></textarea >
                                                <input type="submit" name="createQuiz" class="btn btn-danger form-control" value="Create Quiz">
                                            </form>
                                        </div>
                                    </div>                                
                            </div>
                        </div>
                            <?php
                            $post = new post($con, $myID, $code);
                            $post->viewAssignment();
                            $post->viewQuiz();
                            ?>
                    </div>
                </div>

                <div id="att" class="att_style" style="display: none;">
                    <div class="col-md-8">
                        <div class="cards" style="margin-top: 10px; margin-left: -50px; margin-right: 50px; padding: .5rem 1rem 1rem 1rem">
                            <div class="row">
                                <div class="col-md-8 clock">
                                    <p id="clock"></p>
                                    <span><?php echo date('F j, Y')  ?></span>
                                </div>
                                <?php  
                                    $get = mysqli_query($con, "SELECT * FROM class_attendance WHERE Sched_ID = '$sched_id'");
                                    while ($row = mysqli_fetch_assoc($get)) {
                                        if ($row['Status'] == 0) {
                                            echo '<div class="col-md-3">
                                                <input type="button" class="btn btn-primary start" id="'.$sched_id.'" value="Start Attendance">
                                            </div>';
                                        }else{
                                            echo '<div class="col-md-3">
                                                <input type="button" class="btn btn-warning stop" id="'.$sched_id.'" value="Stop Attendance">
                                            </div>';
                                        }
                                    }

                                ?>
                            </div>
                            <hr>
                            
                            <table class="table table-condensed" style="font-size: 13px; font-weight: 400;" id="search">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Student ID</td>
                                        <td>Name</td>
                                        <td>Time In</td>
                                        <td>Time Out</td>
                                        <td>Remarks</td>
                                        <td>Date</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count = 1;
                                        $_get = mysqli_query($con, "SELECT *, std_attendance.Date as date, std_attendance.Status as status FROM std_attendance inner join classroom on std_attendance.Sched_ID = classroom.Sched_ID inner join schedule on classroom.Sched_ID = schedule.ID inner join student_grade on std_attendance.Student_ID = student_grade.Student_ID inner join student on student_grade.Student_ID = student.Student_ID WHERE std_attendance.Sched_ID = '$sched_id' AND std_attendance.Date = '$date'");
                                        while ($row = mysqli_fetch_assoc($_get)) {
                                            $in = date('h:i A', strtotime($row['Time_In'] ?? ''));
                                            $out = date('h:i A', strtotime($row['Time_Out'] ?? ''));
                                            $date1 = date('F j, Y', strtotime($row['date']));
                                            $name = $row['Firstname']. " " .$row['Lastname'];
                                            ?>
                                            <tr>
                                                <td style="vertical-align: middle;" scope="col"><?php echo $count++?></td>
                                                <td style="vertical-align: middle;" scope="col"><?php echo $row['Student_ID']?></td>
                                                <td style="vertical-align: middle;" scope="col"><?php echo $name?></td>
                                                <td style="vertical-align: middle;" scope="col"><?php echo $in?></td>
                                                <td style="vertical-align: middle;" scope="col"><?php echo $out?></td>
                                                <td style="vertical-align: middle;" scope="col" class="text-center">
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
                                                <td style="vertical-align: middle;" scope="col"><?php echo $date1?></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
       
    </section>

</div>

<script>
$(document).ready(function() {
$(function () {
    $('#search').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "pageLength": 20,
      "autoWidth": false
    });
});

    $('.start').click(function(){
        var sched_id = $(this).attr("id");
        $.ajax({
            url: "../../staff-model/start_attendance.php",
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
                      title: 'Attendance Successfully Started!',
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                        }
                    })
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
                        location.reload();
                        }
                    })
                }
            }
        })
    })


    $("#peo").click(function() { //show assignment form and hide post form 
        document.getElementById('stream').style.display = "none";
        document.getElementById('people').style.display = "block";
        document.getElementById('classwork').style.display = "none";
        document.getElementById('att').style.display = "none";
    });

    $("#str").click(function() {
        document.getElementById('stream').style.display = "block";
        document.getElementById('people').style.display = "none";
        document.getElementById('classwork').style.display = "none";
        document.getElementById('att').style.display = "none";
    });

    $("#class").click(function() {
        document.getElementById('stream').style.display = "none";
        document.getElementById('people').style.display = "none";
        document.getElementById('classwork').style.display = "block";
        document.getElementById('assignment').style.display = "none";
        document.getElementById('att').style.display = "none";
    });

    $("#attendance").click(function() {
        document.getElementById('stream').style.display = "none";
        document.getElementById('people').style.display = "none";
        document.getElementById('att').style.display = "block";
        document.getElementById('assignment').style.display = "none";
        document.getElementById('classwork').style.display = "none";
    });
});

$(document).ready(function() {

    $("#ass").click(function() { //show assignment form and hide post form 
        document.getElementById('assignment').style.display = "block";
        document.getElementById('quizDetails').style.display = "none";
    });

    $("#quiz").click(function() { //show assignment form and hide post form 
        document.getElementById('quizDetails').style.display = "block";
        document.getElementById('assignment').style.display = "none";
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

<style type="text/css">
    .att_style .clock{
        padding: .5rem .5rem .5rem .5rem;
        margin-left: 20px;
        margin-top: 10px;
        line-height: 15px;
    } 

    .att_style .clock p{
        font-weight: 600;
        font-size: 22px;
    } 

    .att_style .clock span{
        font-weight: 300;
        font-size: 14px;
    }

    .att_style input[type='button']{
        width: 170px;
        height: 50px;
        margin-top: 10px;
        font-size: 14px;
        font-weight: 400;
        color: #fff;
    }
</style>

<?php include_once('../footer.php'); ?>