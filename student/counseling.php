<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
<?php $myID = $_SESSION['username'];?>
    <section class="content-header">
    	<h1>
        	Apointments
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Counseling</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
    <div class="table">
            <div class="table-title">
                <h3><i class="fa fa-file-text-o" aria-hidden="true">&nbspAppointment Lists</i></h3>
            </div>
            
        <table class="table table-striped" id="search" style="color: #666666; font-size: 13px; font-weight: 500;">
                    <thead>
                        <tr>
                            <th scope="col">Reasons</th>
                            <th scope="col">Bully Name</th>
                            <th scope="col">Concern</th>
                            <th scope="col">Status</th>
                            <th scope="col">Schedule</th>
                        </tr>
                    </thead>
                    <?php 
                        $get = mysqli_query($con, "SELECT * FROM appointments Where Student_ID = '$myID'");
                    ?>
                    <tbody class="table-hover" id="detailTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($get)):
                        $date = date('F j, Y h:i', strtotime($row['Date_Time']));
                    ?>
                    <tr class="table-active" >
                        <td scope="col" style="vertical-align: middle;"><?=$row['Reasons']?></td>
                        <td scope="col" style="vertical-align: middle;"><?=$row['Bully_Name']?></td>
                        <td scope="col" style="vertical-align: middle;"><?=$row['Concerns']?></td>
                        <td scope="col" style="vertical-align: middle;">
                            <?php
                            if ($row['Status'] == 2) {
                                echo "<p class='btn btn-danger text-center'>Pending</p>";
                            }elseif($row['Status'] == 1){
                                echo "<p class='btn btn-info text-center'>Approved</p>";
                            }else{
                                echo "<p class='btn btn-success text-center'>Settled</p>";
                            }
                            ?>
                        </td>
                        <td scope="col" style="vertical-align: middle;"><?=$date?></td>
                    </tr>



                    </tbody>



                    <?php endwhile?>
                </table>
        </div>

    </section>
</div>

<?php include_once 'footer.php'; ?>
<script>

  $(document).ready(function () {

    $('#search').DataTable();

});


</script>
