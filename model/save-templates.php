<?php include_once '../database/connection.php';

$name = mysqli_real_escape_string($con, $_POST['name']);
$code = mysqli_real_escape_string($con, $_POST['template_code']);
$width =  mysqli_real_escape_string($con, $_POST['width']);
$height =  mysqli_real_escape_string($con, $_POST['height']);
$template_image =  mysqli_real_escape_string($con, $_POST['template_image']);

    $tid = "IMG-".(sprintf("%'.05d",rand(1,999999)).'.png');
	$img_src = '../assets/id-format/'.$tid;
    $decoded = base64_decode(str_replace(' ','+',explode(',', $template_image)[1]));
    $img = imagecreatefromstring($decoded);
	$img = imagescale($img , ($width * 200), ($height * 200));
	$template_image = imagepng($img,$img_src);

    if(empty($id)){
        $sql = "INSERT INTO id_format(ID_Format, Name, Width, Height, Code, Src, Status)VALUES('$tid','$name', '$width', '$height', '$code', '', 1)";
    }
    mysqli_query($con, $sql);


?>