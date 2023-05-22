<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
$count = 1;?>

<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Student Users
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-file"></i>Home</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Student Users</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
        <div class="table-master">
			<div class="table-title">
                <h3><i class="fa fa-users" aria-hidden="true"><b>&nbspStudent User</b></i></h3>

                <div class="search">
                
                    <form class="form-inline" action="../reports/std_account_reports.php" method="POST">
                        <div class="row">

                            <button class="btn btn-success" name="excel" class="btn btn-success form-control">
                            <i class="fa fa-file-excel-o" aria-hidden="true">&nbspExcel</i></button>

                            <button class="btn btn-danger form-control" name="print">
                            <i class="fa fa-print" aria-hidden="true">&nbspPrint</i></button>
                        </div>
                    </form>
                </div>
            </div>

            <table class="table table-bordered" id="search">
                  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Access</th>
                        <th scope="col">Status</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody id="data" class="text-center">
                    <?php 
                    $sql = "SELECT * FROM std_account WHERE Status = 2 OR Status = ''";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)):
                        $date = $row['Date'];
                        $newdate = date("M d, Y", strtotime($date));
                        
                    ?>
                    <tr>
                    <td style = "vertical-align: middle;"><?php echo $count++;?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Student_ID'];?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Lastname'],", ", $row['Firstname'], " ", $row['Middlename'] ;?></td>
                    <td style = "vertical-align: middle;"><?php echo $row['Access'];?></td>
                    <td style = "vertical-align: middle;">
                        <?php
                            if ($row['Status'] == '2') {
                                echo '<a href="../model/std_deactivate.php?id='.$row['Student_ID'].'" class="btn btn-success">Activate</a>';
                            }else{
                                echo '<a href="../model/std_activate.php?id='.$row['Student_ID'].'"class="btn btn-warning">Deactivate</a>';
                            }
                        ?>
                    </td>
                    <td style = "vertical-align: middle;"><?php echo $newdate;?></td>
                    <td style = "vertical-align: middle;">

               		<button class ="fa fa-trash btn btn-danger deletebtn"></button>
                            
                  <button class ="fa fa-eye btn btn-success"></button>
                  </td>
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


</script>