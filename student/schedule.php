<?php
include_once ('main_head.php');
include_once ('std_header.php');
include_once ('std_sidebar.php');
include_once ('../database/connection.php');
$myID = $_SESSION['student_id'];
?>

<div class="content-wrapper">

    <section class="content-header">
      <h1>
          Schedule
          <small>Preview</small>
      </h1>

        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Schedule</a></li>
      </ol>
  </section>
    <hr>
    <hr>
    <section class="content">
        <div class="row">
            <?php
                $_sched = mysqli_query($con, "SELECT GROUP_CONCAT(Code SEPARATOR '<br><br>') as code, GROUP_CONCAT(Description SEPARATOR '<br><br>') as description, GROUP_CONCAT(Day SEPARATOR '<br><br>') as day, GROUP_CONCAT(Room SEPARATOR '<br><br>') as room, GROUP_CONCAT(time.time_start SEPARATOR '<br><br>') as time_start, GROUP_CONCAT(time.time_end SEPARATOR '<br><br>') as time_end, GROUP_CONCAT(Salutation, '. ' , Firstname, ' ', Lastname SEPARATOR '<br><br>') as name, GROUP_CONCAT(Strand SEPARATOR '<br><br>') as strand, schedule.Teacher_ID as teacher_id, schedule.Department as dept FROM schedule inner join time on schedule.Time_ID = time.time_id inner join subjects on schedule.Code = subjects.Subject_Code inner join handle_student on schedule.ID = handle_student.Sched_ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID WHERE handle_student.Student_ID = '$myID' GROUP BY Teacher_ID ORDER BY schedule.ID ASC");
                if (mysqli_num_rows($_sched) > 0) {
                  while ($_row = mysqli_fetch_assoc($_sched)) {
                    if ($_row['dept'] == "SHSDEPT") {
                      ?>
                        <div class="col-md-12">
                            <div class="sched">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <td>Code</td>
                                            <td>Description</td>
                                            <td>Days</td>
                                            <td>Start</td>
                                            <td>End</td>
                                            <td>Room</td>
                                            <td>Instructor</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="col"><?php echo $_row['code'] ?></td>
                                            <td scope="col"><?php echo $_row['description'] ?></td>
                                            <td scope="col"><?php echo $_row['day'] ?></td>
                                            <td scope="col"><?php echo $_row['time_start'] ?></td>
                                            <td scope="col"><?php echo $_row['time_end'] ?></td>
                                            <td scope="col"><?php echo $_row['room'] ?></td>
                                            <td scope="col"><?php echo $_row['name'] ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      <?php
                    }else{
                      ?>
                      <div class="col-md-12">
                            <div class="sched">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <td>Code</td>
                                            <td>Description</td>
                                            <td>Days</td>
                                            <td>Start</td>
                                            <td>End</td>
                                            <td>Room</td>
                                            <td>Instructor</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="col"><?php echo $_row['code'] ?></td>
                                            <td scope="col"><?php echo $_row['description'] ?></td>
                                            <td scope="col"><?php echo $_row['day'] ?></td>
                                            <td scope="col"><?php echo $_row['time_start'] ?></td>
                                            <td scope="col"><?php echo $_row['time_end'] ?></td>
                                            <td scope="col"><?php echo $_row['room'] ?></td>
                                            <td scope="col"><?php echo $_row['name'] ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      <?php
                    }
                  }
                }
            ?>
            
        </div>
       
    </section>
</div>
<?php include_once 'footer.php'?>
<style type="text/css">
    .content .sched{
        background-color: #666666;
        padding: 1rem 1rem 1rem 1rem;
        text-align: center;
        margin-bottom: 10px;
    }

    .sched .excel{
        width: 49%;
    }

    .sched .print{
        width: 49%;
    }

    .sched #border{
        border: 1px solid #6d6d6d;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .sched table{
        color: #333;
        font-size: 13px;
        font-weight: 300;
        background-color: #fff;
        text-align: left;
    }
</style>