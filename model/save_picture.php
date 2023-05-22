<?php include_once '../database/connection.php';  


if (isset($_POST['save'])) {
	$img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = '../image/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $get = mysqli_query($con, "SELECT * from sys_image");

        if (mysqli_num_rows($get) > 0) {
        	$insert = mysqli_query($con, "INSERT INTO sys_image (Image, Status) Values ('$new_img_name', '0')");
        	if ($insert) {
        		echo "<script>
					alert('Image successfully uploaded!');
					window.location.href = '../admin/system-setting.php';
				</script>";
        	}
        }else{
        	$insert = mysqli_query($con, "INSERT INTO sys_image (Image, Status) Values ('$new_img_name', '1')");
        	if ($insert) {
        		echo "<script>
					alert('Image successfully uploaded!');
					window.location.href = '../admin/system-setting.php';
				</script>";
        	}
        }

    }
}



?>