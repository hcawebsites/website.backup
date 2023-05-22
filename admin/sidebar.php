  
  <aside class="main-sidebar">
    
   
    <section class="sidebar">
<?php

$admin_id=$_SESSION["admin_id"];

include_once('../database/connection.php');

$sql="SELECT * FROM admin WHERE Admin_ID = '$admin_id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$firstname=$row['Firstname'];
$lastname=$row['Lastname'];
$image=$row['Picture'];

?>      

      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assets/upload/<?=$image?>" class="img-circle" >
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname , " ", $lastname; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="admin_dashboard.php">
            <img src="../assets/image/dashboard.png" style="margin-right: 3%;" class="circle"><span>Home</span>
          </a>
        </li>
        <li>
          <a href="enrollment_list.php">
             <img src="../assets/image/admission.png" style="margin-right: 3%;" class="circle"><span>Enrollment
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/student.png" class="circle" style="margin-right: 2%;">
            <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> 
                <span>Master List</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                <ul class="treeview-menu">
                  <li><a href="elementary.php"><i class="fa fa-circle-o"></i> Elementary Department</a></li>
                  <li><a href="junior_high.php"><i class="fa fa-circle-o"></i> Junior High Department</a></li>
                  <li><a href="senior_high.php"><i class="fa fa-circle-o"></i> Senior High Department</a></li>
                </ul>
              </a>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-money"></i> 
                <span>Payment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                <ul class="treeview-menu">
                  <li><a href="to_pay.php"><i class="fa fa-circle-o"></i> To Pay</a></li>
                  <li><a href="student_payment.php"><i class="fa fa-circle-o"></i> Payments</a></li>
                </ul>
              </a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/teacher.png" class="circle" style="margin-right: 2%;">
            <span>Teacher</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="teachers_list.php"><i class="fa fa-circle-o"></i>&nbspTeacher List</a></li>
            <li><a href="add_new_teacher.php"><i class="fa fa-circle-o"></i>&nbspAdd New Teacher</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/evaluation.png" class="circle" style="margin-right: 2%;">
            <span>Evaluation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="ev_reports.php"><i class="fa fa-circle-o"></i>&nbspEvaluation Reports</a></li> 
            <li><a href="ev_criteria.php"><i class="fa fa-circle-o"></i>&nbspEvaluation Criteria</a></li>
            <li><a href="ev_questionnaire.php"><i class="fa fa-circle-o"></i>&nbspEvaluation Questionaire</a></li>
            </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/staff.png" class="circle" style="margin-right: 2%;">
            <span>Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php"><i class="fa fa-circle-o"></i>&nbspAdministrator</a></li>
            <li><a href="staff.php"><i class="fa fa-circle-o"></i>&nbspStaff</a></li>
            <li><a href="add_new_staff.php"><i class="fa fa-circle-o"></i>&nbspAdd New Staff</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/file.png" class="circle" style="margin-right: 2%;">
            <span>Subjects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="subjectList.php"><i class="fa fa-circle-o"></i>&nbspSubject List</a></li>
            <li><a href="add-subject.php"><i class="fa fa-circle-o"></i>&nbspAdd Subject</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/schedule.png" class="circle" style="margin-right: 2%;">
            <span>Schedule</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="class_schedule.php"><i class="fa fa-circle-o"></i>&nbspAssign Schedule</a></li>
            <li><a href="faculty_schedule.php"><i class="fa fa-circle-o"></i>&nbspFaculty Schedule</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/library.png" class="circle" style="margin-right: 2%;">
            <span>Library</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="list_books.php"><i class="fa fa-circle-o"></i>&nbspManage Books</a></li>
            <li><a href="start_transaction.php"><i class="fa fa-circle-o"></i>&nbspStart Transaction</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/message.png" class="circle" style="margin-right: 2%;">
            <span>Message</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="message.php"><i class="fa fa-circle-o"></i> Send Message</a></li>
            <li><a href="retrieve_message.php"><i class="fa fa-circle-o"></i> Retrieve Message</a></li>
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/counseling.png" class="circle" style="margin-right: 2%;">
            <span>Guidance Counseling</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="counseling.php"><i class="fa fa-circle-o"></i>&nbspStudent Counseling</a></li>
            <li><a href="guidance.php"><i class="fa fa-circle-o"></i>&nbspGuidance Student Record</a></li>
            <li><a href="add_guidance_record.php"><i class="fa fa-circle-o"></i>&nbspAdd Record</a></li>
            
          </ul>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/user.png" class="circle" style="margin-right: 2%;">
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
            <li><a href="std_users.php"><i class="fa fa-circle-o"></i>&nbspStudent Users</a></li>
            <li><a href="users.php"><i class="fa fa-circle-o"></i>&nbspStaff Users</a></li>
            </ul>

          </a>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/clinic.png" class="circle" style="margin-right: 2%;">
            <span>Clinic</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="health_record.php"><i class="fa fa-circle-o"></i>&nbspStudent Health Record</a></li>
            </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <img src="../assets/image/settings.png" class="circle" style="margin-right: 2%;">
            <span>Account Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin_settings.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>

        <li>
          <a href="admin_profile.php">
            <img src="../assets/image/profile.png" class="circle" style="margin-right: 2%;"></i> <span>Profile</span>
          </a>
        </li>

        <li>
          <a href="#">
            <img src="../assets/image/wrench.png" class="circle" style="margin-right: 2%;">
            <span>System Maintenance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li><a href="curriculum.php"><i class="fa fa-circle-o"></i> Curriculum</a></li>
            <li><a href="grade.php"><i class="fa fa-circle-o"></i> Grade</a></li>
            <li><a href="strand.php"><i class="fa fa-circle-o"></i> Strand</a></li>
            <li><a href="department.php"><i class="fa fa-circle-o"></i> Department</a></li>
            <li><a href="academic_list.php"><i class="fa fa-circle-o"></i> Academic Year</a></li>
            <li><a href="system-setting.php"><i class="fa fa-circle-o"></i> System Settings</a></li>
            <li><a href="staff-attendance.php"><i class="fa fa-circle-o"></i> Attendance</a></li>
            </ul>
        </li>




    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>