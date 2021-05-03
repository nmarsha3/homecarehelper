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
$ssn = mysqli_real_escape_string($con, $_GET['input-ssn']);
echo $ssn;
$addr = mysqli_real_escape_string($con, $_GET['input-address']);
echo $addr;
$city = mysqli_real_escape_string($con, $_GET['input-city']);
echo $city;
$country = mysqli_real_escape_string($con, $_GET['input-country']);
echo $country;
$zip = mysqli_real_escape_string($con, $_GET['input-zip']);
echo $zip;
$phone = mysqli_real_escape_string($con, $_GET['input-phone']);
echo $phone;

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "update People set ssn = ?, first_name = ?, last_name = ?, birthday = ?");
mysqli_stmt_bind_param($stmt, "ssss", $ssn, $fn, $ln, $bday);
mysqli_stmt_execute($stmt);
if ($con->query($stmt) === TRUE) {
     echo "New record created successfully";
} else {
     echo "Error: <br>" . $con->error;
}
mysqli_stmt_close($stmt);

$stmt2 = mysqli_prepare($con, "update Patient set ssn = ?, address = ?, city = ?, country = ?, post_code = ?");
mysqli_stmt_bind_param($stmt2, "sssss", $ssn, $addr, $city, $country, $zip);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

$stmt3 = mysqli_prepare($con, "update Phone set ssn = ?, number = ?");
mysqli_stmt_bind_param($stmt3, "ss", $ssn, $phone);
mysqli_stmt_execute($stmt3);
mysqli_stmt_close($stmt3);

?>
