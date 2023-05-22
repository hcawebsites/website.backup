<?php  
include_once '../database/connection.php';

if(isset($_POST['save'])){
	$file_name = $_FILES['video']['name'];
	$file_temp = $_FILES['video']['tmp_name'];
	$file_size = $_FILES['video']['size'];
	if ($file_size < 50000000) {
		$file = explode('.', $file_name);
		$end = end($file);
		$allowed_exs = array('avi', 'flv', 'wmv', 'mov', 'mp4', 'mkv');

		if (in_array($end, $allowed_exs)) {
			$name = date("Y-m-d").".".$end;
			$location = '../video/'.$name;
			if (move_uploaded_file($file_temp, $location)) {
				$check = mysqli_query($con, "SELECT * FROM sys_video");
				if (mysqli_num_rows($check) > 0) {
					$save_video = mysqli_query($con, "INSERT INTO sys_video (Video, Status) Values ('$name', '0')");

					if ($save_video) {
						echo "<script>
							alert('Video successfully uploaded!');
							window.location.href = '../admin/system-setting.php';
						</script>";
					}
				}else{
					$save_video = mysqli_query($con, "INSERT INTO sys_video (Video, Status) Values ('$name', '1')");

					if ($save_video) {
						echo "<script>
							alert('Video successfully uploaded!');
							window.location.href = '../admin/system-setting.php';
						</script>";
					}
				}

			}
		}else{
			echo "<script>
				alert('Video format incorrect!');
				window.location.href = '../admin/system-setting.php';
			</script>";
		}
	}else{
		echo "<script>
			alert('File is too large  to upload!');
			window.location.href = '../admin/system-setting.php';
		</script>";
	}
}
?>