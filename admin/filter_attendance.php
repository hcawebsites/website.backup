<?php 
include_once('../database/connection.php');
extract($_POST);
$count = 1;
$date = $_POST['date'];
$output = "";

$get = mysqli_query($con, "SELECT * FROM emp_attendance WHERE Date = '$date'");
if (mysqli_num_rows($get) > 0) {
    while ($row = mysqli_fetch_assoc($get)) {
        $status = $row['Status'];
        $in = date('h:i A', strtotime($row['Time_In']));
        $out = date('h:i A', strtotime($row['Time_Out']));
        $log = date('F j, Y', strtotime($row['Date']));
        if ($status == 1) {
            $output .=
            '
                <tr>
                    <td scope="col" style="vertical-align: middle;">'.$count++.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Emp_ID'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Name'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$in.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$out.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$log.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Access'].'</td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><p style="background-color: #74fa5f">On Time</p></td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><button class="form-control btn btn-primary data" id="'.$row['Emp_ID'].'"><i class="fa fa-edit"></i></button></td>

                </tr>
            ';
        }elseif($status == 2){
            $output .=
            '
                <tr>
                    <td scope="col" style="vertical-align: middle;">'.$count++.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Emp_ID'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Name'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$in.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$out.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$log.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Access'].'</td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><p style="background-color: #b2c40e; color: #fff;">Late</p></td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><button class="form-control btn btn-primary data" id="'.$row['Emp_ID'].'"><i class="fa fa-edit"></i></button></td>

                </tr>
            ';
        }else{
            $output .=
            '
                <tr>
                    <td scope="col" style="vertical-align: middle;">'.$count++.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Emp_ID'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Name'].'</td>
                    <td scope="col" style="vertical-align: middle;">'.$in.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$out.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$log.'</td>
                    <td scope="col" style="vertical-align: middle;">'.$row['Access'].'</td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><p style="background-color: #fa5f5f; color: #fff;">Absent</p></td>
                    <td scope="col" style="vertical-align: middle;" class="text-center"><button class="form-control btn btn-primary data" id="'.$row['Emp_ID'].'"><i class="fa fa-edit"></i></button></td>

                </tr>
            ';
        }
    }
}else{
    $output .= '
        <tr>
            <td colspan="9" class="text-center">No Record Found!</td>
        </tr>
    ';
}

echo $output;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.data').click(function(){  
           var id = $(this).attr("id")
           $.ajax({  
                url:"view_attendance.php",  
                method:"POST",  
                data:{
                    id:id 
                },
                success: function(data) {
                   data = JSON.parse(data);
                   $('#editAttendance').modal("show");
                   $('.form-group img').attr("src", "../assets/upload/" + (data.image));
                   $('#salutation').val(data.salutation);
                   $('#lastname').val(data.lastname);
                   $('#firstname').val(data.firstname);
                   $('#in').val(data.time_in);
                   $('#out').val(data.time_out);
                   $('#date').val(data.date);
                   $('#status').val(data.status);
                   $('#id').val(id);
                   $('#access').val(data.access);
                }
           });  
        }); 
    })
</script>
