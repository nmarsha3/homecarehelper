<?php
header('Access-Control-Allow-Origin: *');
echo "This is the form handler. username and password inputted: ";
$username = $_GET["username"];
echo $username;
$password = $_GET["password"];
echo $password;

$link = mysqli_connect('localhost', 'mrauch2', 'frc254') or die ('died');

mysqli_select_db($link, 'mrauch2');

$stmt = mysqli_prepare($link, "insert into logins (username) values (?)");
mysqli_stmt_bind_param($stmt, "i", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($link, "insert into logins (password) values (?)");
mysqli_stmt_bind_param($stmt, "i", $password);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($link, "insert into logins (type) values (?)");
mysqli_stmt_bind_param($stmt, "i", "Patient");
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>