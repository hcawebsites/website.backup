<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php')?>


<div class="content-wrapper">
    <section class="content-header">
    	<h1>
        	Dashboard
        	<small>Preview</small>
      </h1>

        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
    	</ol>
      <hr>
	</section>
	 <section class="content">
      <div class="row">

      <!-- Number of Users -->
      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-user">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-primary">Total Registered Users</div>
                <div class="col-auto">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM user WHERE Access = 'Admin'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Total Admin: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Number of Admission -->

      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-admission">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-danger">Enrollment Request</div>
                <div class="col-auto">
                    <i class="fa fa-file-text-o fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM student Where Enrollment_Status = 'Pending'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Total Request: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--End-->

      <!-- Number of Student -->
      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-student">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-success">Total Student Enrolled</div>
                <div class="col-auto">
                    <i class="fa fa-graduation-cap fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM student WHERE Enrollment_Status ='Enrolled'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Total Student: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END-->

      <!--Number of Teacher-->
      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-teacher">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-info">Total Registered Teachers</div>
                <div class="col-auto">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM teacher_tb";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Total Teacher: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END-->

        <!--Borrowed Books-->
      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-teacher">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-info">Total borrowed books </div>
                <div class="col-auto">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM borrow_books WHERE Status = '1'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Borrowed Books: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END-->

      <!--Return Books-->
      <div class="col-xl-3 col-md-4 mb-4 h1">
        <div class="info-box-teacher">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="text text-info">Total Return books </div>
                <div class="col-auto">
                    <i class="fa fa-user fa-2x"></i>
                </div>
                <div class="body">

                <?php 
                  $sql="SELECT count(id) FROM borrow_books WHERE Status = '0'";
                  $total_count1=0;
                  $result=mysqli_query($con,$sql);
                  $row=mysqli_fetch_assoc($result);
                  $total_count=$row['count(id)'];
                  echo '<h4> Returned Books: '.$total_count.'</h4>';
                ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--END-->
      </div>
      <hr>
    </section>

    <div class="row">
        <div class="col-md-7">
          <h4 class="text-center">Monthly Student Registration</h4>
          <canvas id="lineChart" width = "100%" height="60%"></canva>
        </div>

        <div class="col-md-5 text-center">
            <h4>Population Per Gender</h4>
            <canvas id="piechart" width = "100%" height="75%" style="padding-left: 2%;"></canva>
            
        </div>
    </div>

    
    <div class="row">

    <div class="col-md-7">
          <h4 class="text-center">Population Per Grade</h4>
          <canvas id="gradechart" width = "100%" height="60%"></canva>
    </div>

    <div class="col-md-5 text-center">
            <h4>Population Per Strand</h4>
            <canvas id="strandchart" width = "100%" height="75%" style="padding-left: 2%;"></canva>
            
    </div>

    </div>


<!-- Population Per Gender-->
<script>
 function showLineChart(population_per_gender){	
 
 var population_per_gender1 = JSON.parse("[" + population_per_gender + "]");

 new Chart(document.getElementById("piechart"), {
   type: 'doughnut',
   data: {
     labels: ["Male", "Female"],
     datasets: [
     {
       label: "Total Students",
       backgroundColor: [
        'blue',
        'pink',
      ],

      borderColor: [
        'blue',
        'pink',
      ],
       fill: false,
       data: population_per_gender1
      
     }
     ]
   },
   options: {
     legend: { display: true },
     title: {
     display: true,
     text: ''
     },
   }
 });

};
    </script>

    <?php
    $prefix="";
    $population_per_gender="";
    
    $gender=array("Male", "Female");
    
    for($i=0; $i<count($gender); $i++){
      $sql="SELECT Gender, COUNT(*) as Number FROM student WHERE Gender = '$gender[$i]' AND Enrollment_Status ='Enrolled'";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_assoc($result);
      $population_per_gender.=$prefix.'"'.$row['Number'].'"';
      $prefix=',';
      
    }
    echo "<script>showLineChart('$population_per_gender');</script>";
    ?>


<!-- END -->

<!-- Population Per Grade -->

<script>
 function showLineChart(population_per_grade){	
 
 var population_per_grade1 = JSON.parse("[" + population_per_grade + "]");

 new Chart(document.getElementById("gradechart"), {
   type: 'bar',
   data: {
     labels: ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6 ", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"],
     datasets: [
     {
       label: "Total Students",
       backgroundColor: [
        'green',
        'blue',
        'orange',
        'red',
        'yellow',
        'violet',
        'purple',
        'brown',
        'black',
        'indigo',
        'black',
        'gold',
      ],

      borderColor: [
        'green',
        'blue',
        'orange',
        'red',
        'yellow',
        'violet',
        'purple',
        'brown',
        'black',
        'indigo',
        'black',
        'gold',
      ],
       fill: false,
       data: population_per_grade1
      
     }
     ]
   },
   options: {
     legend: { display: false },
     title: {
     display: true,
     text: ''
     },
     scales: {
       yAxes: [{
         ticks: {
           beginAtZero:true
         }
       }]
     }
   }
 });

};
    </script>

    <?php
    $prefix="";
    $population_per_grade="";
    
    $grade=array("Grade 1","Grade 2","Grade 3","Grade 4","Grade 5","Grade 6","Grade 7","Grade 8","Grade 9","Grade 10","Grade 11","Grade 12");
    
    for($i=0; $i<count($grade); $i++){
      $sql="SELECT COUNT(*) as Number FROM  student_grade  INNER JOIN student ON student_grade.Student_ID = student.Student_ID inner join grade on student_grade.Class_ID = grade.ID WHERE Name = '$grade[$i]' AND Enrollment_Status ='Enrolled'";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_assoc($result);
      $population_per_grade.=$prefix.'"'.$row['Number'].'"';
      $prefix=',';
      
    }
    echo "<script>showLineChart('$population_per_grade');</script>";
    ?>

<!-- END -->

<!-- Population Per Strand -->

<script>
 function showLineChart(population_per_grade){	
 
 var population_per_grade1 = JSON.parse("[" + population_per_grade + "]");

 new Chart(document.getElementById("strandchart"), {
   type: 'pie',
   data: {
     labels: ["GAS", "ABM", "HUMSS", "TVL"],
     datasets: [
     {
       label: "Total Students",
       backgroundColor: [
        'green',
        'blue',
        'orange',
        'red'
      ],

      borderColor: [
        'green',
        'blue',
        'orange',
        'red'
      ],
       fill: false,
       data: population_per_grade1
      
     }
     ]
   },
   options: {
     legend: { display: true },
     title: {
     display: true,
     text: ''
     },
   }
 });

};
    </script>

    <?php
    $prefix="";
    $population_per_grade="";
    
    $strand=array("GAS", "ABM", "HUMSS", "TVL");
    
    for($i=0; $i<count($strand); $i++){
      $sql="SELECT COUNT(*) as Number FROM student_grade INNER JOIN student ON student_grade.Student_ID = student.Student_ID WHERE student_grade.Strand = '$strand[$i]' AND Enrollment_Status ='Enrolled'";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_assoc($result);
      $population_per_grade.=$prefix.'"'.$row['Number'].'"';
      $prefix=',';
      
    }
    echo "<script>showLineChart('$population_per_grade');</script>";
    ?>


<!-- END -->

<script>
 function showLineChart(monthly_std_reg){	
 
 var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");

 new Chart(document.getElementById("lineChart"), {
   type: 'line',
   data: {
     labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
     datasets: [
     {
       label: "New Student Enrolled",
       borderColor: "blue",
       fill: false,
       data: monthly_std_reg1
      
     }
     ]
   },
   options: {
     legend: { display: true },
     title: {
     display: true,
     text: ''
     },
     scales: {
       yAxes: [{
         ticks: {
           beginAtZero:true
         }
       }]
     }
   }
 });

};
    </script>

    <?php 
    $current_year=date("Y");
    $prefix="";
    $monthly_std_reg="";
    
    $month=array("January","February","March","April","May","June","July","August","September","October","November","December");
    
    for($i=0; $i<count($month); $i++){
      $sql="SELECT COUNT(id) FROM student WHERE Enrolled_Year='$current_year' AND Enrolled_Month='$month[$i]' AND Enrollment_Status ='Enrolled'";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_assoc($result);
      $monthly_std_reg.=$prefix.'"'.$row['COUNT(id)'].'"';
      $prefix=',';
      
    }
    echo "<script>showLineChart('$monthly_std_reg');</script>";
    ?>


</div>

<?php include 'footer.php'?>
  </body>
    