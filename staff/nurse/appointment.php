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
			Appointments
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i>&nbspDashboard</a></li>
			<li><a href="#">Appointments</a></li>
		</ol>
		<hr>
	</section>
	<section class="content">
	    <div class="table">
	            <div class="table-title">
	                <h3><i class="fa fa-calendar" aria-hidden="true">&nbspAppointments List</i></h3>

	                <div class="search">
	                
	                    <form class="form-inline" action="../../reports/clinic_appointment_reports.php" method="POST">
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
	            
	        <table class="table table-striped" id="search" style="color: #666666; font-size:13px; font-weight: 300;">
	                    <thead>
	                        <tr>
	                            <th scope="col">#</th>
	                            <th scope="col">Name</th>
	                            <th scope="col">Reason</th>
	                            <th scope="col">Date</th>
	                            <th scope="col">Time</th>
	                            <th scope="col">Date Created</th>
	                            <th scope="col">Status</th>
                                <th scope="col">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody class="table-hover" id="detailTable">
	                        <?php
	                         $get = mysqli_query($con, "SELECT *, clinic_appointments.Status FROM clinic_appointments inner join student on clinic_appointments.Student_ID = student.Student_ID");
	                        while ($row = mysqli_fetch_assoc($get)):
                                $name = $row['Firstname']. " " .$row['Lastname'];
                                $date = date('F j, Y', strtotime($row['Date']));
                                $time = date('h:i A', strtotime($row['Time']));
                                $date_created = date('F y, Y', strtotime($row['Date_Created']));
	                        ?>
                        	<tr class="table-active">
	                            <td style = "vertical-align: middle;"><?=$count++?></td>
	                            <td style = "vertical-align: middle;"><?=$name?></td>
	                            <td style = "vertical-align: middle;"><?=$row['Reason']?></td>
	                            <td style = "vertical-align: middle;"><?=$date?>
	                            <td style = "vertical-align: middle;"><?=$time?></td>
	                            <td class="text-center" style = "vertical-align: middle;"><?=$date_created?></td>
                            <td style = "vertical-align: middle;" class="text-center">
                                <?php
                                    if ($row['Status'] == '1') {
                                        echo "<p class='pending'>Pending</p>";
                                    }else{
                                        echo "<p class='done'>Complete</p>";
                                    }
                                ?>
                                
                            </td>
                            </td>

                            <td style = "vertical-align: middle;" class="text-center">
                                <?php  
                                    if ($row['Status'] == '1') {
                                        echo '<button type="button" class="btn btn-success form-control chk" id='.$row['Student_ID'].'><i class="fa fa-check-square-o"></i></button>';
                                    }else{
                                        echo '<button type="button" class="btn btn-info form-control" >Completed</button>';
                                    }

                                ?>
                            </td>
                        </tr>
                        <?php endwhile?>
                    </tbody>
                   
                </table>
        </div>

    </section>
</div>

<?php include_once '../footer.php'?>
<style>
.pending{
    background-color: #ed6673;
    width: 100px;
    color: #fff;
    font-weight: 500;
}

.done{
    background-color: #3bf511;
    width: 100px;
    color: #fff;
    font-weight: 500;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#search').DataTable();

        $('.chk').click(function(){
            start_load();
            var id = $(this).attr('id');
            $.ajax({
                url: "../../staff-model/settled_clinic.php",
                method: "POST",
                data: {
                    id:id
                },
                success:function(data){
                },
                complete:function(){
                    end_load();
                    location.reload();
                }
            })
        })
	})
</script>