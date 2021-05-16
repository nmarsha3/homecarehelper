<?php

include "config.php";

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
}
else{
   echo "Connection goodn\n";
}

$fn = mysqli_real_escape_string($con, $_GET['input-first-name']);
echo $fn;
$ln = mysqli_real_escape_string($con, $_GET['input-last-name']);
echo $ln;
$bday = mysqli_real_escape_string($con, $_GET['input-birthday']);
echo $bday;
$ssn = mysqli_real_escape_string($con, $_GET['input_ssn']);
echo $ssn;
$specialty = mysqli_real_escape_string($con, $_GET['input-specialty']);
echo $specialty;
$phone = mysqli_real_escape_string($con, $_GET['input-phone']);
echo $phone;

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "update People set first_name = ?, last_name = ?, birthday = ? where ssn = ?");
mysqli_stmt_bind_param($stmt, "ssss", $fn, $ln, $bday, $ssn);
mysqli_stmt_execute($stmt);
if ($con->query($stmt) === TRUE) {
     echo "New record created successfully";
} else {
     echo "Error: <br>" . $con->error;
}
mysqli_stmt_close($stmt);

$stmt2 = mysqli_prepare($con, "update Doctor set specialty = ? where ssn = ?");
mysqli_stmt_bind_param($stmt2, "ss", $specialty, $ssn);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

$stmt3 = mysqli_prepare($con, "update Phone set number = ? where ssn = ?");
mysqli_stmt_bind_param($stmt3, "ss", $phone, $ssn);
mysqli_stmt_execute($stmt3);
mysqli_stmt_close($stmt3);

?>
