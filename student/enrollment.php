<?php 
include_once('main_head.php'); 
include_once('std_header.php');
include_once('std_sidebar.php');
$student_id = $_SESSION['student_id'];

?>

<div class="content-wrapper">
  <title>Enrollment</title>
  
    <section class="content-header col-md-12">
      <h1><i class="fa fa-edit" aria-hidden="true">
          Enrollment
          <small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Enrollment</a></li>
      </ol>
      <hr>
      <hr>
  </section>
  <section class="content">
  <div class="form-group col-md-8" style="margin-left:30px; margin-right:30px; border: 5px solid #D8D8D8; 
  border-top-left-radius: 20px; border-bottom-right-radius: 20px;">
<?php include_once '../database/connection.php'; 
$sql = "SELECT * FROM student inner join payment_history on student.Student_ID = payment_history.Student_ID Where student.Student_ID = '$student_id' Group By payment_history.Student_ID";
$result = mysqli_query($con, $sql);

?>
                        <h4>Enrollment Status:</h4>
                        <hr>
                        <table class="table table-striped">
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                              $date1 = $row['Application_Date'];
                              $newdate1 = strtotime($date1);
                              $date2 = $row['Enrolled_Date'];
                              $newdate2 = strtotime($date2);

                              
                            ?>
                            
                              <tr>
                                    <td>Student ID:</td>
                                    <td><?php echo $row['Student_ID']; ?></td>
                              </tr>

                              <tr>
                                    <td>Student Name:</td>
                                    <td><?php echo $row['Firstname'], " ", $row['Lastname']; ?></td>
                              </tr>

                              <tr>
                                    <td>Application Date:</td>
                                    <td><?php echo date('M d Y', $newdate1); ?></td>
                              </tr>

                              <tr>
                                    <td>Date Approve:</td>
                                    <td><?php echo $row['Date_Approve']; ?></td>
                              </tr>

                              <tr>
                                    <td>Enrolled Date:</td>
                                    <td><?php echo date('M d Y', $newdate2);?></td>
                              </tr>

                              <tr>
                                    <td>Enrollment Status:</td>
                                    <td class="bg-success"><?php echo $row['Enrollment_Status']; ?></td>
                              </tr>
                              

                              <tr>
                                    <td>Payment Type:</td>
                                    <td><?php echo $row['Payment_Type']; ?></td>
                              </tr>

                              <tr>
                                    <td>Overall Payment:</td>
                                    <td><?php echo $row['Paid_Amount'] + $row['Balance']; ?></td>
                              </tr>

                              <tr>
                                    <td>Payment Amount:</td>
                                    <td><?php echo $row['Paid_Amount']; ?></td>
                              </tr>

                              <tr>
                                    <td>Balance:</td>
                                    <td><?php echo $row['Balance']; ?></td>
                              </tr>

                              <tr>  
                                    <td><p><b>NOTE:</b> Print your document And <br>Submit it with your Requirements.<p></td>
                                    <td><button class="form-control btn btn-danger" data-toggle="modal" data-target="#printModal"><i class="fa fa-print" aria-hidden="true"> Print</i></button></td>
                              </tr>


                        </tbody>
                            <?php } ?>
                			
                        </table>
                  </div>
  </section>
</div>
<?php include_once 'footer.php';?>
<!-- Print Modal -->

<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="content">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><i class="fa fa-times"></i></button>
        <div class="modal-title">
            <p>By click "Print" you are requesting for your enrollment form.</p>
        </div>
      </div>
      <div class="modal-body text-center">
      <?php $result = mysqli_query($con, $sql); 
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
        <form action="../reports/print_enrollment.php?id=<?php echo $row['Student_ID']; ?>" method="POST">
            <h4>This information are confidential and owned by:</h4>
           
                <h3><?php echo $row['Firstname'], " ", $row['Middlename'], " ", $row['Lastname']?></h3>
          
           <hr>
           <p><b>Note:</b><small> THIS FORM IS CONFIDENTIAL AND EXCUTE ONLY FOR RECORDS PURPOSES!</small></p>

           <div class="modal-footer">
            <button type="submit" name="print" id="submit" class="btn btn-danger"><i class="fa fa-print"> Print</i></button>
           </div>
           <?php }?>
        </form>
      </div>
</div>
</div>
</div>