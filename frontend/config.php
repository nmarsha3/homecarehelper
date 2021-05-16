<?php

session_start();

$con = mysqli_connect('localhost', 'mrauch2', 'frc254', 'mrauch2');

if(!$con){
   die('Connection failed: ' . mysqli_connect_error());
}


?>
