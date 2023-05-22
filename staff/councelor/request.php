<?php  
include_once 'main_head.php';
include_once 'header.php';
include_once 'sidebar.php';
$myID = $_SESSION['staff_id'];
$count = 1;
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Appointment Request
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Appointment Request</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
	    <div class="table">
	            <div class="table-title">
	                <h3><i class="fa fa-calendar" aria-hidden="true">&nbspAppointments List</i></h3>

	                <div class="search">
	                
	                    <form class="form-inline" action="../../reports/counseling_reports.php" method="POST">
	                        <div class="row">
	                        	<input type="hidden" name="staff_id" value="<?php echo $myID ?>">
								<button class="btn btn-success form-control" name="excel">
	                            <i class="fa fa-print" aria-hidden="true">&nbspExcel</i></button>
	                            <button class="btn btn-danger form-control" name="print">
	                            <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	            
	        <table class="table table-striped" id="search" style="color: #666666; font-size:12px; font-weight: 300;">
	                    <thead>
	                        <tr>
	                            <th scope="col">#</th>
	                            <th scope="col">Name</th>
	                            <th scope="col">Reason</th>
	                            <th scope="col">Bully Name</th>
	                            <th scope="col">Concern</th>
	                            <th scope="col">Status</th>
	                            <th scope="col">Schedule</th>
	                        </tr>
	                    </thead>
	                    <tbody class="table-hover" id="detailTable">
	                        <?php
	                         $get = mysqli_query($con, "SELECT *, concat(Firstname, ' ', Middlename, ' ', Lastname) as name, appointments.Status as status, appointments.Student_ID as id FROM appointments inner join student on appointments.Student_ID = student.Student_ID Order by appointments.ID ASC");
	                        while ($row = mysqli_fetch_assoc($get)):
	                        ?>
                        	<tr class="table-active">
	                            <td style = "vertical-align: middle;"><?=$count++?></td>
	                            <td style = "vertical-align: middle;"><?=$row['name']?></td>
	                            <td style = "vertical-align: middle;"><?=$row['Reasons']?></td>
	                            <td style = "vertical-align: middle;"><?=$row['Bully_Name']?>
	                            <td style = "vertical-align: middle;"><?=$row['Concerns']?></td>
	                            <td class="text-center" style = "vertical-align: middle;">
	                                <?php 
	                                    if ($row['status'] == 2) {
	                                        echo "<button id=".$row['id']." class='btn btn-danger approve'>Pending</button>";
	                                    }elseif($row['status'] == "1"){
	                                        echo "<button id=".$row['id']." class='btn btn-warning settle'>Approved</button>";
	                                    }else{
	                                        echo "<p class='btn btn-success'>Settled</p>";
	                                    }
	                                ?>  
	                            </td>
                            <td style = "vertical-align: middle;"><?=$row['Date_Time']?></td>
                            </td>
                        </tr>
                        <?php endwhile?>
                    </tbody>
                   
                </table>
        </div>

    </section>
</div>

<div class="modal fade" id="approve-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fa fa-times"></span>
        </button>
        <h3 class="modal-title"><i class="fa fa-file-text-o" aria-hidden="true">&nbspApprove Request</i></h3>
        
        
      </div>
      <div class="modal-body">
        <form action="" id="approve-request">
            <div class="row">
                <div class="col-md-12">
                    <p>Student ID:</p>
                    <input type="text" name="std-id" id="std-id" class="form-control form-group" readonly>

                    <input type="hidden" name="firstname" id="firstname" class="form-control form-group" readonly>

                    <input type="hidden" name="email" id="email" class="form-control form-group" readonly>

                    <p>Student Name:</p>
                    <input type="text" name="std-name" id="std-name" class="form-control form-group" readonly>

                    <p>Reasons:</p>
                    <textarea name="reason" id="reason" cols="30" rows="3" class="form-control form-group" readonly></textarea>

                    <p>Name of the Bully:</p>
                    <input type="text" name="bully_name" id="bully_name" placeholder="If the reasons is bullying" class="form-control form-group" readonly>

                    <p>State Reasons/Concern:</p>
                    <textarea name="concern" id="concern" cols="30" rows="3" class="form-control form-group" readonly></textarea>
                </div>

                <div class="col-md-6">
                    <p>Schedule:</p>
                    <input type="text" name="date" id="date" class="form-control form-group" readonly>
                </div>

                <div class="col-md-6">
                    <p>Date Created:</p>
                    <input type="text" name="date_created" id="date_created" class="form-control form-group" readonly>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn-approve" class="btn btn-success">Approve</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php include_once '../footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search').DataTable();

		$('.approve').click(function(){
            var id = $(this).attr('id');
            $.ajax({
                url: "review-appoinment.php",
                method: "POST",
                data:{
                    id:id
                },
                success:function(data){
                    data = JSON.parse(data);
                    $('#std-id').val(id);
                    $('#firstname').val(data.firstname);
                    $('#email').val(data.email);
                    $('#std-name').val(data.name);
                    $('#reason').val(data.reason);
                    $('#bully_name').val(data.b_name);
                    $('#concern').val(data.concern);
                    $('#date').val(data.schedule);
                    $('#date_created').val(data.date_created);
                    $('#approve-modal').modal('show');
                }
            })
        })

        $('#btn-approve').click(function(){
            start_load();
           $.ajax({
            url: "../../staff-model/approve_request.php",
            method: "POST",
            data: $('#approve-request').serialize(),
            success:function(data){                
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                  buttonsStyling: false
                })
        
                swalWithBootstrapButtons.fire({
                  title: 'Data successfully saved!',
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
            }
           })
        })

        $('.settle').click(function(){
            start_load();
            var id = $(this).attr('id');
            $.ajax({
                url: "../../staff-model/appointment-settled.php",
                method: "POST",
                data: {
                    id:id
                },
                success:function(data){
                    const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                      },
                      buttonsStyling: false
                    })
            
                    swalWithBootstrapButtons.fire({
                      title: 'Data successfully saved!',
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
                }
            })
        })
	})
</script>