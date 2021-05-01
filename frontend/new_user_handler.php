<?php

include "config.php";

$ssn = mysqli_real_escape_string($con, $_GET['input-ssn']);
$addr = mysqli_real_escape_string($con, $_GET['input-address']);
$city = mysqli_real_escape_string($con, $_GET['input-city']);
$country = mysqli_real_escape_string($con, $_GET['input-country']);
$zip = mysqli_real_escape_string($con, $_GET['input-zip']);
$phone = mysqli_real_escape_string($con, $_GET['input-phone']);

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "select name from Procedures where code = ?");
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $code);

mysqli_stmt_fetch($stmt);
echo $code;

?>
