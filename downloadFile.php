<?php 
require 'database/connection.php' ;

if(isset($_GET['download'])){
    $path =$_GET['download'];
    
    
    header('content-Disposition: attachment; filename = '.$path.'');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('content-Length='.filesize($path));
    readfile($path);
    exit;
}

?>