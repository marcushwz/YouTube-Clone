<?php 
ob_start(); //Turns on output buffering

date_default_timezone_set("Asia/Kuala_Lumpur");

try {
    $con = new PDO("mysql:dbname=VideoTube;host=localhost","root",""); // connect to database
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
