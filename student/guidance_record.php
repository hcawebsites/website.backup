<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');?>

<div class="content-wrapper">
<?php $myID = $_SESSION['username'];?>
    <section class="content-header">
    	<h1>
        	Guidance record
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Guidance</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
    <div class="table">
            <div class="table-title">
                <h3><i class="fa fa-file-text-o" aria-hidden="true">&nbspGuidance Record</i></h3>
            </div>
            
        <table class="table table-striped" id="search" style="color: #666666; font-size: 13px; font-weight: 400;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Violation</th>
                            <th scope="col">Offense</th>
                            <th scope="col">Punishment</th>
                            <th scope="col">Date Violated</th>
                            <th scope="col">Date Settled</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <?php
                        $count = 1;
                        $sql = "SELECT * FROM guidance Where Student_ID = '$myID'";
                        $result = mysqli_query($con, $sql);
                    ?>
                    <tbody class="table-hover" id="detailTable">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['Date'];
                        $newdate = date('F j, Y', strtotime($date));

                        $date1 = $row['Date_Resolved'];
                        $newdate1 = date('F j, Y', strtotime($date1));
                    ?>
                    <tr class="table-active">
                    <td style = "vertical-align: middle;"><?=$count++?></td>
                    <td style = "vertical-align: middle;"><?=$row['Violation']?></td>
                    <td style = "vertical-align:middle;"><?=$row['Offense']?></td>
                    <td style = "vertical-align:middle;"><?=$row['Punishment']?></td>
                    
                    <td style = "vertical-align: middle;"><?=$newdate?></td>
                    <td style = "vertical-align: middle;">                  	
                    	<?php
                        if ($row['Date_Resolved'] == "") {
                        	echo '<p class="btn btn-warning">Not Settled</p>';
                        }
                        else{
                            echo $newdate1;
                        }
                    
                    	?>
                    </td>

                    <td style = "vertical-align: middle;"  class="text-center">
                    <?php
                        if ($row['Status'] == "1") {
                        	echo '<p class="btn btn-warning">Not Settled</p>';
                        }
                        else{
                            echo '<p class="btn btn-success">Settled</p>';
                        }
                    
                    ?>
                    </td>
                    
                
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
