<?php require_once '../database/connection.php';  ?>
<?php
$myID = $_GET['admin_id'];
$sql="SELECT * FROM admin WHERE Admin_ID = '$myID'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$image = $row['Picture'];
$firstname = $row['Firstname'];
$lastname = $row['Lastname'];
?>

    <div class="row">
        <div class="col-md-4 text-center"
            style="padding: 50px 20px; background:; border-top-left-radius: 25px;">
            <img src="../assets/upload/<?=$image?>" class="img-thumbnail" id="output" alt="Cinque Terre" 
            style="width: 60%"><span><h4><?php echo $firstname ," ", $lastname;?></h4>
            <input type="file" accept="image/*" name="my_image" id="file" onchange="loadFile(event)" style="margin-top:7px;"  />
            <p style="margin-top:10px;"><b><?php echo $row['Admin_ID'];?></b></p></span>
        </div>

        <div class="col-md-8"
            style="padding: 20px; background:#D0D0D0; border-bottom-right-radius: 25px; 
            border-top-right-radius: 25px; ">
            <div class="col-md-12" style="color: red;">
                <h4>Teachers Profile:</h4>
                <hr>
            </div>
            <input type="hidden" name="myID" id="myID" class="form-control" 
                value="<?php echo $row['Admin_ID'];?>">

            <div class="form-group col-md-4">
                <label for="">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" 
                value="<?php echo $lastname;?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" 
                value="<?php echo $firstname;?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">Middle Name:</label>
                <input type="text" name="middlename" id="middlename" class="form-control" 
                value="<?php echo $row['Middlename'];?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">Date of Birth:</label>
                <input type="text" name="dob" id="dob" class="form-control" 
                value="<?php echo $row['DOB'];?>" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="">Age:</label>
                <input type="text" name="age" id="age" class="form-control" 
                value="<?php echo $row['Age'];?>">
            </div>

            <div class="form-group col-md-4">
                <label for="">Gender</label>
                <input type="text" name="gender" id="gender" class="form-control" 
                value="<?php echo $row['Gender'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="">Nationality:</label>
                <input type="text" name="nationality" id="nationality" class="form-control" 
                value="<?php echo $row['Nationality'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="">Address</label>
                <input type="text" name="address" id="address" class="form-control" 
                value="<?php echo $row['Address'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="">Contact:</label>
                <input type="text" name="contact" id="contact" class="form-control" 
                value="<?php echo $row['Contact'];?>">
            </div>

            <div class="form-group col-md-6">
                <label for="">Email:</label>
                <input type="email" name="email" id="email" class="form-control" 
                value="<?php echo $row['Email'];?>">
            </div>

            <div class="form-group col-md-12">
                <input type="submit" name="submit" value="Save" class="form-control btn-success">
            </div>


        </div>
    </div>
