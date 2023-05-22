<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
include_once '../../database/connection.php';
$myID = $_SESSION['staff_id'];
$count = 1;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Health Records
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Health Records</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
		<div class="table-master">
			<div class="table-title">
				<h3>
					<i class="fa fa-bars" aria-hidden="true"></i>
					Student Health Records
				</h3>

				<div class="row form-inline">
            <div class="search">
                <form action="../../reports/student_health_reports.php" method="POST">
                  <input type="hidden" name="staff_id" value="<?php echo $myID  ?>">
                	<button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print"></i>&nbspPrint</button>

                	<button type="submit" name="excel" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbspExcel</button>
                </form>
                
            </div>
        </div>
			</div>

			<table class="table table-bordered table-striped" style="color: #666666; font-size: 14px; font-weight: 500;" id="search">
				<thead>
	                <tr>
	                    <th scope="col">#</th>
                      <th scope="col">Student ID</th>
	                    <th scope="col">Name</th>
	                    <th scope="col">Class</th>
	                    <th scope="col">Present Illness</th>
	                    <th scope="col">Action</th>
	                </tr>
                </thead>
                <tbody>
                	<?php  
                		$get = mysqli_query($con, "SELECT * from health_record inner join student on health_record.Student_ID = student.Student_ID inner join student_grade on student.Student_ID = student_grade.Student_ID inner join grade on student_grade.Class_ID = grade.ID Order by health_record.ID ASC");
                		while ($row = mysqli_fetch_assoc($get)) {
                		$date = date('F j, Y', strtotime($row['Date']));
                    $name = $row['Firstname']. " ". $row['Middlename']. " " .$row['Lastname'];
                    $class = $row['Name']. " " .$row['Strand']. " - " .$row['Section'];
                	?>
                		<tr>
                			<td style = "vertical-align: middle;"><?=$count++?></td>
                      <td style = "vertical-align: middle;"><?=$row['Student_ID']?></td>
                			<td style = "vertical-align: middle;"><?=$name?></td>
                			<td style = "vertical-align: middle;"><?=$class?></td>
                			<td style = "vertical-align: middle;"><?=$row['Illness']?></td>
                			<td style = "vertical-align: middle;" class="text-center">
                        <button type="button" class="btn btn-primary form-control view" id="<?=$row['Student_ID']?>"><i class="fa fa-eye"></i>&nbspView</button>
                          
                      </td>
                		</tr>
                	<?php }?>
                </tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="view-health" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times"></i></span>
        </button>
        <h4 class="modal-title"><i class="fa fa-eye"></i>&nbspView Health Record</h4>
        
      </div>
      <div class="modal-body">
    <div style="color: #666666; font-size: 14px;">
      <form action="" id="view-form">
        <div class="row">
          <div class="col-md-4 form-group">
            <label>Student ID</label>
            <input type="text" name="std_id" id="std_id" class="form-control form-group" readonly>
            <input type="hidden" name="firstname" id="firstname" class="form-control form-group" readonly>
            <input type="hidden" name="email" id="email" class="form-control" readonly>
          </div>

          <div class="col-md-4">
            <label>Student Name</label>
            <input type="text" name="name" id="name" class="form-control" readonly>
          </div>

          <div class="col-md-4">
            <label>Student Class</label>
            <input type="text" name="class" id="class" class="form-control" readonly>
          </div>

          <div class="col-md-12">
            <label>Present Illness:</label>
              <textarea name="illness" id="illness" class="form-control form-group" rows="4" readonly></textarea>

              <label>Medication Taken:</label>
              <textarea name="medication" id="medication" class="form-control form-group" rows="4" readonly></textarea>

              <label>Past Medical History:</label>
                <ul>
                  <li id="pastRecord"></li>
                </ul>
                <label>Operation/s:</label>
                <textarea name="operation" id="operation" class="form-control form-group" rows="4" readonly></textarea>

                <label>Family History:</label>
                <ul>
                  <li id="family-history">
                </ul>
          </div>
          <div class="col-md-6">
              <label>Height</label>
              <input type="number" id="height" class="form-control form-group" readonly>

              <label>Weight</label>
              <input type="number" id="weight"  class="form-control form-group" readonly>
            </div>

            <div class="col-md-6">
              <label for="">Body Mass Index:</label>
              <input type="number" id="bmi" class="form-control form-group" readonly>

              <label for="">Classification:</label>
              <input type="text" id="classification" class="form-control" readonly>
            </div>

          <div class="col-md-12">
          <label>Smoking:</label>
              <textarea name="smoking" id="smoking" class="form-control form-group" rows="4" readonly></textarea>

              <label>Drinking:</label>
              <textarea name="drinking" id="drinking" class="form-control form-group" rows="4" readonly></textarea> 
          </div>

          <div class="col-md-12">
            <label>Reason:</label>
                <textarea name="reason" id="reason" placeholder="For Appointment" class="form-control form-group" rows="4"></textarea>
          </div>

          <div class="col-md-6">
            <label>Date and Time:</label>
            <input type="date" name="date" id="date" class="form-control form-group">
            <input type="time" name="time" id="time" class="form-control form-group">
          </div>
        </div>
      </form>
        
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="send" class="btn btn-primary">Send Appointment</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include_once '../footer.php';  ?>
<script>
	$(document).ready(function(){
		$('#search').DataTable();

    $('.view').click(function(){
      var id = $(this).attr('id');
      $.ajax({
        url: "view_health_record.php",
        method: "POST",
        data:{
          id:id
        },
        success:function(data){
          data = JSON.parse(data);
          var pmh = data.m_history;
          var fh = data.f_history;
          for (var i = 0; i < data.count; i++) {
           if (pmh[i] == "") {

           }else{
             $('#pastRecord').append('<input type="checkbox" checked disabled id="">&nbsp'+ pmh[i] + '<br>');
           }
          }

          for (var x = 0; x < data.count1; x++) {
           if (fh[x] == "") {

           }else{
             $('#family-history').append('<input type="checkbox" checked disabled id="">&nbsp'+ fh[x] + '<br>');
           }
          }
          $('#std_id').val(data.std_id);
          $('#name').val(data.name);
          $('#class').val(data.class);
          $('#illness').val(data.illness);
          $('#medication').val(data.medicine);
          $('#operation').val(data.operation);
          $('#height').val(data.height);
          $('#weight').val(data.weight);
          $('#bmi').val(data.bmi);
          $('#classification').val(data.classification);
          $('#smoking').val(data.smoking);
          $('#drinking').val(data.drinking);
          $('#firstname').val(data.firstname);
          $('#email').val(data.email);

          $('#view-health').modal('show');
        }
      })
    })

    $('#send').click(function(){
      start_load();
      var reason = $('#reason').val();
      var date = $('#date').val();
      var time = $('#time').val();
      if (reason == "" || date == "" || time == "") {
        alert("All fields required!");
        end_load();
      }else{
        $.ajax({
        url: "../../staff-model/send_appointment.php",
        method: "POST",
        data: $('#view-form').serialize(),
        success:function(data){
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
            title: 'Appointment Saved Successfully',
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
      })
      }
    })


  });
</script>

<style>
	.settled{
	background-color: #3bf511;
	width: 100px;
	color: #fff;
	font-weight: 500;
	}

	.pending{
		background-color: #ed6673;
		width: 100px;
		color: #fff;
		font-weight: 500;
	}
</style>