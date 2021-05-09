<?php

include "config.php";

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
}
else{
   echo "Connection goodn\n";
}

$ssn = mysqli_real_escape_string($con, $_GET['patient_ssn']);
$doctor_ssn = mysqli_real_escape_string($con, $_GET['doctor_ssn']);
$med = mysqli_real_escape_string($con, $_GET['med']);
$start_date = mysqli_real_escape_string($con, $_GET['start_date']);
$end_date = mysqli_real_escape_string($con, $_GET['end_date']);
$times_taken = mysqli_real_escape_string($con, $_GET['times_taken']);
$notes = mysqli_real_escape_string($con, $_GET['notes']);

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "insert into Prescriptions values(?, ?, ?, ?, ?, ?, ?);");
mysqli_stmt_bind_param($stmt, "sssssss", $ssn, $doctor_ssn, $med, $start_date, $end_date, $times_taken, $notes);
mysqli_stmt_execute($stmt);
if ($con->query($stmt) === TRUE) {
     echo "New record created successfully";
} else {
     echo "Error: <br>" . $con->error;
}
mysqli_stmt_close($stmt);
?>
