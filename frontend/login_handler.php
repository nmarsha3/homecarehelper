<?php

include "config.php";

$code = mysqli_real_escape_string($con, $_GET['input-ssn']);

$stmt = mysqli_prepare($con, "select name from logins where code = ?");
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $code);

mysqli_stmt_fetch($stmt);
echo $code;

?>
