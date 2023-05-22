<?php
include_once('../database/connection.php');

if (isset($_POST['archived'])) {
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);

    $query_archived = mysqli_query($con, "UPDATE admin Set Archived = '1' Where Admin_ID = '$admin_id'");

    if ($query_archived) {
        $query_user = mysqli_query($con, "UPDATE user Set AStatus = '0' Where Username = '$admin_id'");
        if ($query_user) {
            echo '<script>
            alert("Administrator Deleted!")
            window.location.href="../admin/admin.php"
            </script>';
        }
    }
}
?>