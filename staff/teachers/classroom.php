<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); 
$myID = $_SESSION['emp_id'];
?>

<div class="content-wrapper">
    <section class="content-header" style="display: flex; justify-content: space-between;">
    	<h1>
        	Classroom
        	<small>Preview</small>
            
        </h1>
        
        <div style="margin-left: 55px;"><a href="" data-toggle="modal" data-target="#createClass" title="Create Classroom"><img src="../../assets/image/plus.png" alt="" width="30px"></a></div>
        <div></div>
        <div></div>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Classroom</a></li>
    	</ol>  
	</section>
    <hr>

    <section class="content">
        <div class="row">
            <?php 
                

                $sql1 = mysqli_query($con, "SELECT *, classroom.Code as code FROM classroom inner join schedule on classroom.Sched_ID = schedule.ID inner join subjects on schedule.Code = subjects.Subject_Code inner join time on schedule.Time_ID = time.time_id inner join grade on schedule.Class_ID = grade.ID inner join teacher_tb on schedule.Teacher_ID = teacher_tb.Emp_ID Where schedule.Teacher_ID = '$myID'");

                if (mysqli_num_rows($sql1)) {
                    while ($row = mysqli_fetch_assoc($sql1)) {
                    $class = $row['Name']. " " .$row['Strand']. " - " . $row['Section'];
                    $time = date("h:i a", strtotime($row['time_start'])). " - " .date("h:i a", strtotime($row['time_end']));
                    echo '<a href="room.php?code='.$row['code'].'" ><div class="col-md-4 h5">
                    <div class="cards"  style="background-color: #fff; color: #333;">
                    <h4 style="float: right;">'.$row['Code'].'</h4>
                    <h4>'.$row['Subject_Code'].'</h4>
                    <br>
                    <h4>'.$row['Description'].'</h4>
                    <p>'.$class.'</p>
                    
                    <p>'.$row['Salutation'].'. '.$row['Lastname'].' '.$row['Firstname'].'</p>
                    <p>'.$row['Day'].'</p>
                    <p>'.$time.'</p>
                    
                    </div>
                    </div></a>';
                    }
                }else{
                }
            
            ?>
        </div>
        
    </section>

</div>


<div class="modal fade" id="createClass" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-chrome"></i>&nbspCreate Classroom</h4>
      </div>
      <div class="modal-body">
        <form action="" id="form"> 
            <div class="row">
                <div class="col-md-12">
                    <label for="">Select Subject</label>
                    <select name="subject" id="subject" class="form-control">
                        <option value="" disabled selected>Select Subject</option>
                        <?php
                        function random_strings($length_of_string)
                        {
                            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                            return substr(str_shuffle($str_result),0, $length_of_string);
                        }
                        
                        $get_subject = mysqli_query($con, "SELECT *, schedule.ID as id FROM schedule inner join subjects on schedule.Code = subjects.Subject_Code Where Teacher_ID = '$myID' And Room = 'Online' Group By schedule.Code, schedule.Strand");
                        while ($row = mysqli_fetch_assoc($get_subject)) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['Description']?></option>

                        <?php } ?>
                        
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="">Class:</label>
                    <input type="text" class="form-control" id="class" readonly>
                </div>

                <div class="col-md-12">
                    <label for="">Classroom Name:</label>
                    <input type="text" name="className" id="className" class="form-control">
                </div>

                <div class="col-md-12">
                    <label for="">Classroom Code:</label>
                    <input type="text" name="classCode" id="classCode" value="<?php echo random_strings(6)?>" class="form-control" readonly>
                    <input type="hidden" name="myID" id="myID" value="<?php echo $myID?>" class="form-control">
                </div>
                
            </div>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="create" class="btn btn-primary">Create</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>
<script>
    var timer1 = 0;
    $(document).ready(function(){
        $('#subject').change(function(){
            var sched_id = $(this).val();
            $.ajax({
                url: "filter-class.php",
                method: "POST",
                data:{
                    sched_id:sched_id
                },
                success:function(data){
                    data = JSON.parse(data);
                    $('#class').val(data.class);
                }
            })
        })

        $("#create").click(function() {
            start_load();
            $.ajax({
                url: "../../staff-model/createClassroom.php",
                method: "POST",
                data: $('#form').serialize(),
                success:function(data){
                   if (data == "success") {
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                      title: 'Classroom SuccessFully Created!',
                      text: "",
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                                location.reload();
                        }
                    })
                    end_load();
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
                      icon: 'info',
                      showCancelButton: false,
                      confirmButtonText: 'Close',
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                        }
                    })
                    end_load();
                }
                }
            })
        })
    })

 

</script>
<?php include_once('../footer.php'); ?>