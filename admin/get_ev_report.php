<?php  
include_once '../database/connection.php';

extract($_POST);
if ($_POST) {
	$data = array();
	$get = mysqli_query($con ,"SELECT * from ev_answer inner join evaluation_list on ev_answer.Evaluation_ID = evaluation_list.Evaluation_ID WHERE Teacher_ID = '$teacher_id' AND Strand = '$strand' AND Class_ID = '$class_id' AND Subject = '$subject'");
	$answered = mysqli_query($con, "SELECT * FROM evaluation_list where Teacher_ID = '$teacher_id' and Subject = '$subject' and Class_ID = '$class_id' AND Strand = '$strand'");
	$rate = array();

		while($row = mysqli_fetch_assoc($get)){
			if(!isset($rate[$row['Questionnaire_ID']][$row['Rate']]))
			$rate[$row['Questionnaire_ID']][$row['Rate']] = 0;
			$rate[$row['Questionnaire_ID']][$row['Rate']] += 1;

			// $data[]= $row;
			$ta = $answered->num_rows;
			$r = array();
			foreach($rate as $rating => $rates){
				foreach($rates as $rk => $rv){
				$r[$rating][$rk] =($rate[$rating][$rk] / $ta) *100;
			}

		}
		$data['tse'] = $ta;
		$data['data'] = $r;
}
echo json_encode($data);
}

?>