<?php
header('Access-Control-Allow-Origin: *');
$code = $_GET['input-code'];
echo $code;
$name = $_GET['input-name'];
echo $name;

$link = mysqli_connect('localhost', 'mrauch2', 'frc254') or die ('died');

mysqli_select_db($link, 'mrauch2');

$stmt = mysqli_prepare($link, "update Procedures set name = ? where code = ?");
mysqli_stmt_bind_param($stmt, "ss", $name, $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>
