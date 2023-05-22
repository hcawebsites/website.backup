<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['emp_id'];
$count = 1;
?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Subjects
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Entry</a></li>
            <li><a href="#">Subjects</a></li>
    	</ol>
	</section>

    <section class="content">
    <div class="table-master">
        <div class="table-title">
            <h3><i class="fa fa-book">&nbspHandled Subjects</i></h3>
        </div>
        <hr>

        <table class="table table-bordered table-striped" id="search" style="color: #666666; font-size:12; font-weight: 500;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Descriptive Title</th>
                    <th scope="col">Grade & Section</th>
                    <th scope="col">Time</th>
                    <th scope="col">Days</th>
                    <th scope="col">Room</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
           
                <tbody class="table-hover">
                <?php
                $sql = mysqli_query($con, "SELECT *, schedule.ID as id FROM schedule inner join subjects on schedule.Code = subjects.Subject_Code inner join time on schedule.Time_ID = time.time_id inner join grade on schedule.Class_ID = grade.ID Where schedule.Teacher_ID = '$myID' GROUP BY schedule.ID, schedule.Strand, schedule.Code order by schedule.ID ASC");
                while ($row = mysqli_fetch_assoc($sql)) {
                    $class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
                    $classID = $row['Class_ID'];
                    $dept = $row['Department'];
                    $strand = $row['Strand'];
                    $code = $row['Code'];
                    $time = date("h:i", strtotime($row['time_start'])). " - " .date("h:i", strtotime($row['time_end']));
                    ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td><?=$row['Code']?></td>
                        <td><?=$row['Description']?></td>
                        <td><small><?=$class?></small></td>
                        <td><?=$time?></td>
                        <td><?=$row['Day']?></td>
                        <td><?php
                          if ($row['Room'] == "Online") {
                              $_code = mysqli_query($con, "SELECT classroom.Code, schedule.Room from classroom inner join schedule on classroom.Sched_ID = schedule.ID WHERE schedule.Teacher_ID = '$myID' AND schedule.Code = '$code'");
                                while ($_row_code = mysqli_fetch_assoc($_code)) {
                                echo $_row_code['Code']; 
                            }
                          }else{
                            echo $row['Room'];
                          }
                        ?></td>
                        <td class="text-center form-group">
                           <?php
                              if ($row['Room'] == "Online") {
                                  echo '<button class="btn btn-success form-control form-group"><i class="fa fa-qrcode"></i></button>';
                              }else{
                                echo '<button type="button" class="btn btn-success form-control form-group start" id="'.$row['id'].'"><i class="fa fa-qrcode"></i></button>';
                              }
                            ?>
                            <button onclick="document.location.href='std_per_subject.php?sched_id=<?=$row['id']?>'" class="btn btn-primary form-control form-group"><i class="fa fa-graduation-cap"></i></button>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
        </table>
    </div>
    </section>
</div>

<?php include_once('../footer.php'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#search').DataTable();

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
                        window.location.href = 'scan_attendance.php?data='+sched_id;
                        }
                    })
                }else{
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: data,
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'scan_attendance.php?data='+sched_id;
                        }
                    })
                }
            }
        })

    })

});
</script>