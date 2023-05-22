<?php 
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../database/connection.php';
$myID = $_SESSION['student_id'];
$count = 1;
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Subjects
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
            <li><a href="#">Subjects</a></li>
        </ol>
        <hr>
    </section>
    <section class="content">
        <div class="table-master">
            <div class="table-title">
                <h3>
                    <i class="fa fa-list-alt"></i>
                    List of Subjects
                </h3>
            </div>

            <table class="table table-bordered table-striped" id="search" style="color: #666666; font-size: 13px;">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Descriptive Title</th>
                    <th scope="col">Grade & Section</th>
                    <th scope="col">Time</th>
                    <th scope="col">Days</th>
                    <th scope="col">Room</th>
                </thead>
                <tbody>
                    <?php
                        $get_sub = mysqli_query($con, "SELECT *, schedule.ID as id FROM schedule inner join handle_student on schedule.ID = handle_student.Sched_ID inner join subjects on schedule.Code = subjects.Subject_Code inner join time on schedule.Time_ID = time.time_id inner join grade on schedule.Class_ID = grade.ID Where handle_student.Student_ID = '$myID' GROUP BY schedule.ID, schedule.Strand, schedule.Code order by schedule.ID ASC");
                            while ($row = mysqli_fetch_assoc($get_sub)) {
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
                                      $_code = mysqli_query($con, "SELECT classroom.Code, schedule.Room from classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join handle_student on schedule.ID = handle_student.Sched_ID WHERE handle_student.Student_ID = '$myID' AND schedule.Code = '$code'");
                                        while ($_row_code = mysqli_fetch_assoc($_code)) {
                                        echo $_row_code['Code']; 
                                    }
                                  }else{
                                    echo $row['Room'];
                                  }
                                ?></td>
                            </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php include_once 'footer.php';  ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#search').DataTable();
    })
</script>

