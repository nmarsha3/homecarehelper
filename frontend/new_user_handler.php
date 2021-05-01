<?php

include "config.php";

$fn = mysqli_real_escape_string($con, $_GET['input-first-name']);
echo $fn;
$ln = mysqli_real_escape_string($con, $_GET['input-last-name']);
echo $ln;
$bday = mysqli_real_escape_string($con, $_GET['input-birthday']);
$ssn = mysqli_real_escape_string($con, $_GET['input-ssn']);
$addr = mysqli_real_escape_string($con, $_GET['input-address']);
$city = mysqli_real_escape_string($con, $_GET['input-city']);
$country = mysqli_real_escape_string($con, $_GET['input-country']);
$zip = mysqli_real_escape_string($con, $_GET['input-zip']);
$phone = mysqli_real_escape_string($con, $_GET['input-phone']);

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "insert into People values(?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $snn, $fn, $ln, $bday);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt2 = mysqli_prepare($con, "insert into Patient values(?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt2, "sssss", $snn, $addr, $city, $counry, $zip);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

$stmt3 = mysqli_prepare($con, "insert into Phone values(?, ?)");
mysqli_stmt_bind_param($stmt3, "ss", $snn, $phone);
mysqli_stmt_execute($stmt3);
mysqli_stmt_close($stmt3);

?>
