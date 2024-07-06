<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="supermart";

    $con= new mysqli($servername, $username, $password, $dbname);
   
    if($con->connect_error)
    {
        die("connection fail");
    }
    $today=date('Y-m-d');
    $time=date('H:i:s');
    $date_time=date('Y-m-d H:i:s');
?>