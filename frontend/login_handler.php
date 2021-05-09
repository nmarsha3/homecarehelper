<?php

include "config.php";

$ssn = mysqli_real_escape_string($con, $_GET['input_ssn']);

$stmt = mysqli_prepare($con, "select count(*) from Patient where ssn = ?");
mysqli_stmt_bind_param($stmt, "s", $ssn);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $patient);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

$stmt1 = mysqli_prepare($con, "select count(*) from Doctor where ssn = ?");
mysqli_stmt_bind_param($stmt1, "s", $ssn);
mysqli_stmt_execute($stmt1);
mysqli_stmt_bind_result($stmt1, $doctor);
mysqli_stmt_fetch($stmt1);
mysqli_stmt_close($stmt1);

$stmt2 = mysqli_prepare($con, "select count(*) from Caregivers where ssn = ?");
mysqli_stmt_bind_param($stmt2, "s", $ssn);
mysqli_stmt_execute($stmt2);
mysqli_stmt_bind_result($stmt2, $caregiver);
mysqli_stmt_fetch($stmt2);
mysqli_stmt_close($stmt2);

# this goes back to result in the javascript
if($patient == 1){
	echo 0;
} 

if($doctor == 1){
	echo 1;
}

if($caregiver == 1){
	echo 2;
}

?>
