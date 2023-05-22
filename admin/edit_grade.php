<?php  
include_once '../database/connection.php';

if ($_POST) {
	$std_id = $_POST['std_id'];
	$code = $_GET['code'];
	
	$get = mysqli_query($con, "SELECT Department, concat(Firstname, ' ' , Lastname) as name from grade inner join student_grade on grade.ID = student_grade.Class_ID inner join student on student_grade.Student_ID = student.Student_ID Where student_grade.Student_ID = '$std_id'");
	$row = mysqli_fetch_assoc($get);
	$dept = $row['Department'];
	$name = $row['name'];

	if ($dept == "SHSDEPT") {
		$get_grade = mysqli_query($con, "SELECT * from shs_grade inner join subjects on shs_grade.Subject = subjects.Subject_Code WHERE Student_ID = '$std_id' And Subject = '$code'");

		while($row = mysqli_fetch_assoc($get_grade)){
			$data['name'] = $name;
			$data['subject'] = $row['Subject'];
			$data['description'] = $row['Description'];
			$data['prelim'] = $row['Prelim'];
			$data['midterm'] = $row['Midterm'];
			$data['final'] = $row['Final'];
			$data['overall'] = $row['Overall'];
		}
	}else{
		$get_grade = mysqli_query($con, "SELECT * from std_grade inner join subjects on std_grade.Subject = subjects.Subject_Code WHERE Student_ID = '$std_id' And Subject = '$code'");

		while($row = mysqli_fetch_assoc($get_grade)){
			$data['name'] = $name;
			$data['subject'] = $row['Subject'];
			$data['description'] = $row['Description'];
			$data['first'] = $row['First'];
			$data['second'] = $row['Second'];
			$data['third'] = $row['Third'];
			$data['fourth'] = $row['Fourth'];
			$data['final'] = $row['Final'];
		}
	}

	echo json_encode($data);
}
?>