<?php  
include_once '../database/connection.php';
$count = 1;
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    } 

    $fileName = "books-data_" . date('Y-m-d') . ".xls";

    $fields = array('#','ISBN', 'Title', 'Author', 'Category', 'Total', 'Available', 'Call Number', 'Date Publish');
    $excelData = implode("\t", array_values($fields)) . "\n"; 

    $get = mysqli_query($con, "SELECT * from books");
    if (mysqli_num_rows($get) > 0) {
        while ($row = mysqli_fetch_assoc($get)) {
        	$date = date("F j, Y", strtotime($row['Date_Publish']));

            $data = array(''.$count++.'',''.$row['ISBN'].'', ''.$row['Title'].'', ''.$row['Author'].'', ''.$row['Category'].'', ''.$row['Total'].'', ''.$row['Available'].'', ''.$row['Call_Number'].'', ''.$date.'');
            array_walk($data, 'filterData'); 
            $excelData .= implode("\t", array_values($data)) . "\n"; 
        }
    }
	else{ 
        $excelData .= 'No records found...'. "\n"; 
    } 

    header("Content-Type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=\"$fileName\""); 
    
    // Render excel data 
    echo $excelData; 
    
    exit;


?>