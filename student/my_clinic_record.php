<?php include_once('main_head.php');?>
<?php include_once('std_header.php'); ?>
<?php include_once('std_sidebar.php'); ?>
<?php include_once('../database/connection.php');
$myID = $_SESSION['username'];?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	My Clinic Record
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Clinic</a></li>
            <li><a href="#">My Clinic Record</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table">
			<div class="table-title">
                <h3><i class="fa fa-file" aria-hidden="true"><b>&nbspMy Clinic Record</b></i></h3>
            </div>

            <table class="table table-bordered" id="search" style="color: #666666; font-size: 13px; font-weight: 300;">
                  <thead>
                    <tr>
                        <th scope="col">Medicine</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Illness</th>
                        <th scope="col">Date Created</th>
                    </tr>
                </thead>

                <tbody id="data">
                    <?php 
                    $sql = "SELECT *, clinic_record.Total as total FROM clinic_record inner join medicine on clinic_record.Medicine = medicine.ID WHERE Student_ID = '$myID'";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        $med = $row['Name']. " - " .$row['Mg'] . " - " .$row['Type'];
                        $date_created = date('F j, Y', strtotime($row['Date_Created']));
                        
                    ?>
                    <tr>
                    <td style = "vertical-align: middle;"><?=$med?></td>
                    <td style = "vertical-align: middle;"><?=$row['total']?></td>
                    <td style = "vertical-align: middle;"><?=$row['Illness']?></td>
                    <td style = "vertical-align: middle;"><?=$date_created?></td>
                    </tr>
                    <?php endwhile?>

                </tbody>
            </table>
        </div>
    </section>
    
</div>
<?php include_once 'footer.php';?>

<script>
    $(document).ready(function () {
        $('#search').DataTable();
})


$(document).ready(function(){  
    $("#weight").keyup(function(){  
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var height1 = height * height;
        var bmi = weight / height1;
        var decimal = bmi.toFixed(2);
            $("#bmi").val(decimal);
            
    }); 
});  




</script>