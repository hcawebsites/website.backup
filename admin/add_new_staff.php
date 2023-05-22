<?php include_once('main_head.php');?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>
<?php include_once('../database/connection.php');
date_default_timezone_set('Singapore');

$date = date("F j, Y h:i A");
$staff_id = "F-".(sprintf("%'.06d",rand(111111,999999)));
$myID = $_SESSION['admin_id'];
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Teacher
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Teacher</a></li>
            <li><a href="#">Add Teacher</a></li>
        </ol>
    </section>
    <section class="content">   
    <hr>
    <div class="table">
        <form action="" id="staff-form" method="POST" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="myID" id="myID" value="<?=$myID?>" readonly>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Registration Date:</label>
                    <input type="text" class="form-control" name="date" id="date" value="<?=$date?>" readonly>
                </div>

                <div class="col-md-3">
                    <label for="">Access:</label>
                    <select name="access" id="access" class="form-control" required>
                        <option value="" hidden selected>Please select here</option>
                        <option value="Admin">Administrator</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Librarian">Librarian</option>
                        <option value="Counselor">Counselor</option>
                        <option value="Nurse">Nurse</option>

                    
                        
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="">Access:</label>
                    <select name="position" id="position" class="form-control" required disabled>
                        <option value="" hidden selected>Please select here</option>
                        <option value="Cashier 1">Cashier 1</option>
                        <option value="Cashier 2">Cashier 2</option>

                    
                        
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="">Teacher ID:</label>
                    <input type="text" class="form-control" name="staff_id" id="staff_id" value="<?=$staff_id?>" readonly>
                </div>

                <div class="col-md-2">
                    <label for="">Salutation:</label>
                    <input type="text" class="form-control" name="salutation" id="salutation" required>
                </div>

                <div class="col-md-3">
                    <label for="">Lastname:</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                </div>

                <div class="col-md-3">
                    <label for="">Firstname:</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                </div>

                <div class="col-md-3">
                    <label for="">Middlename:</label>
                    <input type="text" class="form-control" name="middlename" id="middlename" required>
                </div>

                <div class="col-md-1">
                    <label for="">Suffix:</label>
                    <input type="text" class="form-control" name="suffix" id="suffix">
                </div>

                <div class="form-group col-md-4">
                    <label for="">Date of Birth:</label>
                    <input type= "date" name= "birthdate" id="birthdate" class = "form-control" onkeyup="AgeVal(0)" required>
                </div>

                 <div class="form-group col-md-4">
                    <label for="">Age:</label>
                    <input type= "number" name= "age" id="age" class = "form-control" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Gender:</label>
                    <select name="gender" id="gender" class = "form-control" required>
                        <option selected disabled> Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Status:</label>
                    <select name="status" id="status" class = "form-control" required>
                        <option selected disabled> Select Status</option>
                        <option value="Single">Single</option>
                        <option value="In a relationship">In a relationship</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Nationality:</label>
                    <input type= "text" name= "nationality" id="nationality" class = "form-control" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Contact:</label>
                    <input type="number" name="phone" id="phone"  class="form-control" max-length="11" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Address:</label>
                    <input type= "text" name= "address" id="address" class = "form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Email:</label>
                    <input type="email" name="email" id="email"  class="form-control" required>
                </div>

                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-3"></div>

                   <div class="form-group col-md-3">
                    <img id="output" class="rounded-corncers" style="width:150px; height:150px;" />
                    <input type="file" class="form-control" accept="image/*" name="my_image" id="my_image" onchange="loadFile(event)" style="margin-top:7px;" required />
                </div>

                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-3"></div>
                <div class="form-group col-md-3"></div>

                <div class="form-group col-md-3">
                   <button type="submit" name="add_teacher" class="form-control btn btn-success">Save</button>
                </div>

                
            </div>
        </form>
    </div>
        


    </section>


</div>

<script>
$(document).ready(function(){
    $('#staff-form').on('submit', function(e){
        e.preventDefault();
        start_load();
        var formData = new FormData(this);
	    var files = $('#my_image')[0].files;
	    formData.append('my_image', files[0]);
	    
	    $.ajax({
	        url: "../model/add_staff.php",
	        method: "POST",
	        data: formData,
	        contentType: false,
            processData: false,
            success:function(data){
                if(data == "success"){
                 const swalWithBootstrapButtons = Swal.mixin({
				  customClass: {
				    confirmButton: 'btn btn-success',
				  },
				  buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				  title: 'Data Saved Successfully',
				  text: "",
				  icon: 'success',
				  showCancelButton: false,
				  confirmButtonText: 'Close',
				}).then((result) => {
				  if (result.isConfirmed) {
				        location.reload();
				    }
				})
               }else{
                    Swal.fire(
    			      data,
    			      '',
    			      'warning'
    		    	)
                   end_load();
               }
            }
	    })
        
    })
})
    function formatDate(date){
            var date = new Date(date),
                month = '' + (date.getMonth() + 1),
                day = '' + date.getDate(),
                year = date.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');

        }

        function getAge(dateString){
            var birth = new Date().getTime();
            if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
                
                birth = new Date().getTime();
            }
            birth = new Date(dateString).getTime();
            var now = new Date().getTime();
           
            var n = (now - birth)/1000;
             if (n > 31562417){ 
              var year_n = Math.floor(n/31556926);
                if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                    return year_n = '';
                }else{
                    return year_n + '' + (year_n > 1 ? '' : '') + '';
                }
            }else{
                
            }
        }

        function AgeVal(pid){
            var birthd = formatDate(document.getElementById("birthdate").value);
            var count = document.getElementById("birthdate").value.length;
            if (count=='10'){
                var age = getAge(birthd);
                var str = age;
                var res = str.substring(0, 1);
                if (res =='-' || res =='0'){
                    document.getElementById("birthdate").value = "";
                    document.getElementById("age").value = "";
                    $('#birthdate').focus();
                    return false;
                }else{
                    document.getElementById("age").value = age;
                }
            }else{
                document.getElementById("age").value = "";
                return false;
            }
        }

    var loadFile = function(img) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function(){
    $('#access').change(function(){
        var selectedValue = $(this).val();
        if (selectedValue == "Cashier") {
            document.getElementById('position').disabled = false;
        }else{
            document.getElementById('position').disabled = true;
        }
    })
})
</script>
<?php include_once('footer.php');?>