<?php include_once 'main_head.php';?>
<?php include_once 'en_header.php';?>
<?php include_once 'sidebar.php';?>
<?php  ob_start(); ?>
<?php
     
      include_once ('../database/connection.php');
      $sql = "SELECT * FROM academic_list WHERE Status = 1";
      $result = mysqli_query($con, $sql);

      $reg_num = $_SESSION['code'];
      $username = $_SESSION['username'];

      $sql1 = "SELECT * FROM student INNER JOIN guardians ON student.Reg_Number = guardians.Reg_Num WHERE 
      student.Reg_Number = $reg_num";
      $result1 = mysqli_query($con, $sql1); 
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
            <form action="" method ="POST" enctype="multipart/form-data" id="submitData">
            <div class="row">
                  <?php
                  $sql = "SELECT * FROM std_account Where Username = '$username'";
                  $result = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['Status'] == "") {
                            echo "<div class='form text-center' style='margin: 25% 12px; border: 2px solid black; border-radius: 10px;'>
                              
                                    <h3> You haven't filled up your Enrollment Form Yet</h3>
                                    <p><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></p>
                                    <a href='form.php' class='btn btn-info' style='margin: 5px 0;'><h4>Proceed</h4></a>      
                            
                            </div>";
                        }else{
                          while ($row1 = mysqli_fetch_assoc($result1)) {
                              $date = $row1['Application_Date'];
                              $newdate = strtotime($date);
                              $date1 = date('M d Y', $newdate);

                              $dob = $row1['DOB'];
                              $newdate = strtotime($dob);
                              $date2 = date('M d Y', $newdate);
                              $image = $row1['Picture'];
                          echo '<div class = "col-md-4">
                                <label for="">Date of Registration:</label>
                                <input type="text" value = "'.$date1.'" class = "form-control" readonly>
                          </div>';

                          echo '<div class = "col-md-4">
                                <label>Active School Year:</label>
                                <input type="text" value = "'.$row1['SY'].'" class = "form-control" readonly placeholder = "No Active School Year">
                                </div>';

                          echo '<div class = "col-md-4">
                                <label>Active Semester:<small>[For SHS Only]</small></label>
                                <input type="text" class = "form-control" readonly placeholder = "No Active School Year"
                                value = "'.$row1['Semester'].'">
                                </div>
                                </div>
                                <hr>
                                <hr>';

                          echo '<div class="row">';
                          echo '<div class="form-group col-md-3">
                                <label for="">Last Name:</label>
                                <input type="text" readonly name = "lastname" value = "'.$row1['Lastname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                          <label for="">First Name:</label>
                          <input type="text" readonly name = "firstname" value = "'.$row1['Firstname'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Middle Name:</label>
                                <input type="text" readonly name = "middlename" value = "'.$row1['Middlename'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                          <label for="">Suffix:</label>
                          <input type="text" readonly name = "suffix" value = "'.$row1['Suffix'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Date of Birth:</label>
                          <input type="text" readonly name = "" value = "'.$date2.'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">Age:</label>
                                <input type="text" readonly  name = "age" value = "'.$row1['Age'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Place of Birth</label>
                          <input type="text" readonly name = "birth" value = "'.$row1['POB'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Gender:</label>
                          <input type="text" readonly name = "gender" value = "'.$row1['Gender'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">Status:</label>
                                <input type="text" readonly name = "status" value = "'.$row1['Status'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Nationality</label>
                          <input type="text" readonly name = "nationality" value = "'.$row1['Nationality'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Address:</label>
                          <input type="text" readonly name = "address" value = "'.$row1['Address'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">Permanent Address:</label>
                                <input type="text" readonly name = "status" value = "'.$row1['Address'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">LRN</label>
                          <input type="text" readonly name = "lrn" value = "'.$row1['LRN'].'" class = "form-control" placeholder="Not Available">
                          </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Student Type:</label>
                          <input type="text" readonly name = "stype" value = "'.$row1['Student_Type'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">Grade Applying:</label>
                                <input type="text" readonly name = "grade" value = "'.$row1['Grade'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Strand</label>
                          <input type="text" readonly name = "strand" value = "'.$row1['Strand'].'" class = "form-control" placeholder="Not Available">
                          </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">School Last Attended:</label>
                          <input type="text" readonly name = "SLA" value = "'.$row1['SLA'].'" class = "form-control">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">School Year Last Attended:</label>
                                <input type="text" readonly name = "sy" value = "'.$row1['LSYA'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">General Average</label>
                          <input type="text" name = "genAve" readonly value = "'.$row1['Gen_Ave'].'" class = "form-control" placeholder="Not Available">
                          </div>';

                          echo '<div class="form-group col-md-4">
                                <label for="">Contact Number:</label>
                                <input type="text" readonly name = "sphone" value = "'.$row1['Phone'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-4">
                          <label for="">Email</label>
                          <input type="text" readonly name = "email" value = "'.$row1['Email'].'" class = "form-control" placeholder="Not Available">
                          </div>';


                          echo '<div class="form-group col-md-4"><br>
                                  <img id="output" src="../assets/upload/'.$image.'?>" class="rounded-corncers" style="width:150px; height:150px;" />
                                  </div>';


                          echo '<div class="col-md-12 text-center" style="color:red">
                                <hr>
                                <h3> Guardians Information</h3>
                                <hr>
                                </div>';


                          echo '<div class="form-group col-md-3">
                                <label for="">Father Last Name:</label>
                                <input type="text" readonly name = "flastname" value = "'.$row1['F_Lastname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Father First Name:</label>
                                <input type="text" readonly name = "ffirstname" value = "'.$row1['F_Firstname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Father Middle Name:</label>
                                <input type="text" readonly name = "fmiddlename" value = "'.$row1['F_Middlename'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Father Contact:</label>
                                <input type="text" readonly name = "fnum" value = "'.$row1['F_Contact'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Mother Last Name:</label>
                                <input type="text" readonly name = "mlastname" value = "'.$row1['M_Lastname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Mother First Name:</label>
                                <input type="text" readonly name = "mfirstname" value = "'.$row1['M_Firstname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Mother Middle Name:</label>
                                <input type="text" readonly name = "mmiddlename" value = "'.$row1['M_Middlename'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Mother Contact:</label>
                              <input type="text" readonly name = "mnum" value = "'.$row1['M_Contact'].'" class = "form-control">
                              </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Guardian Last Name:</label>
                                <input type="text" readonly name = "glastname" value = "'.$row1['G_Lastname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Guardian First Name:</label>
                                <input type="text" readonly name = "gfirstname" value = "'.$row1['G_Firstname'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Guardian Middle Name:</label>
                                <input type="text" readonly name = "gmiddlename" value = "'.$row1['G_Middlename'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-3">
                                <label for="">Guardian Contact:</label>
                                <input type="text" readonly name = "gnum" value = "'.$row1['G_Contact'].'" class = "form-control">
                                </div>';

                          echo '<div class="form-group col-md-12"><hr><hr></div>';
                         

                          echo '<div class="form-group col-md-6">
                                <h4>Requirements:</h4>
                                <hr>
                                <ul style="list-style-type:square">
                                <li>Photocopy OF:</li>
                                </ul>

                                  <ul class="list">
                                    <b><li>PSA Birth Certificate</li></b>
                                    <b><li>Baptismal/ Confirmation Certificate</li></b>
                                    <b><li>Good Moral</li></b>
                                    <b><li>SF 9(Form 138</li></b>
                                    <b><li>SF 10(Form 137)</li></b>
                                    <b><li>2pc 2x2 picture</li></b>
                                    <b><li>Certificate of Completion</li></b>
                                  </ul>
                                </div>';

                          echo '<div class="form-group col-md-6">
                                <h4>Assessment of Fees:</h4>
                                <hr>
                                <table class="table table-striped">
                                <thead>
                                     <tr>
                                         <th>Type</th>
                                         <th>Amount</th>
                                     </tr>
                                </thead>
                                     <tbody>
                                     <tr>
                                         <td>Tuition Fee:</td>
                                         <td>P8,000.00</td>
                                     </tr>

                                     <tr>
                                         <td>Miscellaneous Fee:</td>
                                         <td>P3,000.00</td>
                                     </tr>

                                     <tr>
                                         <td>Registration Fee:</td>
                                         <td>P150.00</td>
                                     </tr>

                                     <tr>
                                         <td>Others Fee:</td>
                                         <td>P2,000.00</td>
                                     </tr>

                                     <tr>
                                         <td>Total:</td>
                                         <td>P13,150.00</td>
                                     </tr>

                                </tbody>
                      
                                </table>
                                </div>';

                          echo '<div class="form-group col-md-12"><hr><hr></div>';

                          echo '<div class="col-md-12">';
                          if ($row1['Enrollment_Status'] == "Pending") {
                              echo "<table>
                                          <tr>
                                                <td style='width:50%'><hr/></td>
                                                <td style='vertical-align:middle; text-align: center;'>
                                                <p  class='btn'>Pending</P>
                                                </td>
                                                <td style='width:50%'><hr/></td>
                                          </tr>
                                    </table>";
                        }

                        if ($row1['Enrollment_Status'] == "To Pay") {
                              echo "<table>
                              <tr>
                                    <td style='width:50%'><hr/></td>
                                    <td style='vertical-align:middle; text-align: center;'>
                                    <p  class='btn'>Proceed To Payment</P>
                                    </td>
                                    <td style='width:50%'><hr/></td>
                              </tr>
                        </table>";
                        }

                        echo '</div>';

                        echo '<div class="col-md-12">';

                        if ($row1['Enrollment_Status'] == "Pending") {
                        echo "<input type='button' onclick='submitData($reg_num)' value = 'Update' class='form-control btn-info'>";
                        }

                        echo '</div>';

                        echo '</div>';




                          



                        }

                      }



                  }
                  
                  ?>
                  

           </div>

            </form>
            

  </section>
  <!-- END ON ENROLLMENT FORM-->


  </div>

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

 
