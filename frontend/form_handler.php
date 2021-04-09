<?php
header('Access-Control-Allow-Origin: *');
echo "This is the form handler. username and password inputted: \n";
$username = $_GET['input-username'];
echo $username;
$password = $_GET['input-password'];
echo $password;

$link = mysqli_connect('localhost', 'mrauch2', 'frc254') or die ('died');

mysqli_select_db($link, 'mrauch2');

echo "We selected the db\n";

$stmt = mysqli_prepare($link, "insert into logins (username, password) values (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

?>
