<?php 
include ('main_head.php');
ob_start();
include ('header.php');
include ('sidebar.php');
include_once ('../database/connection.php');
include_once('update_details.php');

$std_id = $_SESSION['student_id'];
?>

<div class="content-wrapper">
  <title>Home</title>
  
    <section class="content-header col-md-12">
      <h1><i class="fa fa-book" aria-hidden="true">
          My Registration
          <small>Preview</small></i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
      <hr>
      <div class="title">
        <h4 class="text-center">Registration Form</h4>
      </div>
      <hr>
  </section>
 
  <!-- ENROLLMENT FORM -->
  <section class = "content">
    <form action="" method="POST" enctype="multipart/form-data" id="data_form">
      <div class="row">
        <?php  
          $get = mysqli_query($con, "SELECT * from student Where Student_ID = '$std_id'");
          while ($row = mysqli_fetch_assoc($get)) {
            $date = date("F j, Y", strtotime($row['Application_Date']));
            $dob = date("F j, Y", strtotime($row['DOB']));
        ?>
        
        <div class = "col-md-3">
            <label for="">Date of Registration:</label>
            <input type="text" value="<?=$date ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">School Year:</label>
            <input type="text" id="sy" value="<?=$row['SY'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Semester:</label>
            <input type="text" id="semester" value="<?=$row['Semester'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Student ID:</label>
            <input type="text" name="std_id" id="std_id" value="<?php echo $std_id  ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Last Name:</label>
            <input type="text" id="lastname" value="<?=$row['Lastname'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">First Name</label>
            <input type="text" id="firstname" value="<?=$row['Firstname'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Middle Name:</label>
            <input type="text" id="middlename" value="<?=$row['Middlename'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Extension Name:</label>
            <input type="text" id="suffix" value="<?=$row['Suffix'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Date of Birth</label>
            <input type="text" id="dob" value="<?=$dob ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Age:</label>
            <input type="text" id="age" value="<?=$row['Age'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Place of Birth:</label>
            <input type="text" id="pob" value="<?=$row['POB'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Gender</label>
            <input type="text" id="gender" value="<?=$row['Gender'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Nationality:</label>
            <input type="text" id="nationality" value="<?=$row['Nationality'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Status:</label>
            <input type="text" id="status" value="<?=$row['Status'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-12">
            <label for="">Address:</label>
            <input type="text" id="address" value="<?=$row['Address'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Contact:</label>
            <input type="text" id="contact" value="<?=$row['Phone'] ?>"  class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Email:</label>
            <input type="text" id="email" value="<?=$row['Email'] ?>" class="form-control form-group" readonly>
        </div>

        <div class="form-group col-md-4"><br>
          <img id="output" class="rounded-corncers" src="../assets/upload/<?=$row['Picture'] ?>" style="width:150px; height:150px;" />
        </div>

        <div class = "col-md-3">
            <label for="">Learner's Referende Number:</label>
            <input type="text" id="lrn" value="<?=$row['LRN'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Enrollment Type:</label>
            <input type="text" id="type" value="<?=$row['Student_Type'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Grade to Enroll</label>
            <input type="text" id="grade" value="<?=$row['Grade'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-3">
            <label for="">Strand:</label>
            <input type="text" id="strand" value="<?=$row['Strand'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Last School Attended:</label>
            <input type="text" id="lsa" value="<?=$row['SLA'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Last School Year Attended:</label>
            <input type="text" id="lsya" value="<?=$row['LSYA'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">General Average:</label>
            <input type="text" id="lsa" value="<?=$row['Gen_Ave'] ?>" class="form-control form-group" readonly>
        </div>
        <div class="col-md-12" style="color:red">
          <hr>
          <p> Guardians Information</p>
          <hr>
        </div>

         <div class = "col-md-4">
            <label for="">Last Name:</label>
            <input type="text" id="glastname" value="<?=$row['GLastname'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">First Name</label>
            <input type="text" id="gfirstname" value="<?=$row['GFirstname'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-4">
            <label for="">Middle Name:</label>
            <input type="text" id="gmiddlename" value="<?=$row['GMiddlename'] ?>" class="form-control form-group" readonly>
        </div>

        <div class = "col-md-12">
            <label for="">Contact:</label>
            <input type="text" id="gcontact" value="<?=$row['GContact'] ?>" class="form-control form-group" readonly>
        </div>

        <div class="form-group col-md-12"><hr><hr></div>

        <div class="col-md-6">
          <h4>Requirements:</h4>
            <hr>
          <ul style="list-style-type:square">
          <li>Photocopy OF:</li>
          </ul>

            <ul class="list">
              <b><li>PSA Birth Certificate</li></b>
              <b><li>Baptismal/ Confirmation Certificate</li></b>
              <b><li>Good Moral</li></b>
              <b><li>SF 9(Form 138)</li></b>
              <b><li>SF 10(Form 137)</li></b>
              <b><li>2pc 2x2 picture</li></b>
              <b><li>Certificate of Completion</li></b>
            </ul> 
        </div>

        <div class="col-md-6">
          <h4>Assessment of Fees:</h4>
          <hr>
          <table class="table table-striped" style="color: #666666; font-size:14px;">
            <thead>
              <tr>
                 <th>Type</th>
                 <th>Amount</th>
             </tr>
            </thead>
            <tbody>
              <?php

                $get = mysqli_query($con, "SELECT grade.ID as grade_id from student inner join grade on student.Grade = grade.Name Where Student_ID = '$std_id'");
                $row1 = mysqli_fetch_assoc($get);
                $gid = $row1['grade_id'];

                $get = mysqli_query($con, "SELECT * from fees Where Grade_ID = '$gid' order by Amount DESC");
                $amount = mysqli_query($con, "SELECT sum(Amount) as total from fees Where Grade_ID = '$gid'");
                $row_amount = mysqli_fetch_assoc($amount);
                $amount = $row_amount['total'];
                while($row1 = mysqli_fetch_assoc($get)){
                  ?>
                  <tr>
                   <td><?php echo $row1['Description']  ?></td>
                   <td><?php echo $row1['Amount']  ?></td>
                  </tr>
               <?php }?>

                  <td class="text-right">Total:</td>
                  <td><?php echo $amount?></td>
                  
            </tbody>
          </table>
        </div>
        <?php 
        if ($row['Enrollment_Status'] == "To Pay") {
        ?>
          <div class="col-md-12">
            <table>
              <tr>
                    <td style='width:50%'><hr/></td>
                    <td style='vertical-align:middle; text-align: center;'>
                    <p  class='btn'>Proceed To Payment</P>
                    </td>
                    <td style='width:50%'><hr/></td>
              </tr>
            </table>
          </div>

          <div class="col-md-12">
            <input type='button' data-toggle='modal' data-target='#printModal' value = 'Print' class='form-control btn-danger'>
          </div>
        <?php 
        }
        }
        ?>

        


      </div>
    </form>

  </section>
  <!-- END ON ENROLLMENT FORM-->

  


</div>
<?php include_once 'footer.php' ?>
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

<!--END-->

  <script src="javascript.js"></script>

  <script type="text/javascript">


  function submitData(reg_num){

  var xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function() {   
        
        document.getElementById('submitData').innerHTML = this.responseText;
            $("#panel_footer").hide();
              $("#note1").hide();
            
              
      }
      xhttp.open("GET", "updateData.php" , true);                       
      xhttp.send();
                
    };
  </script>

 
