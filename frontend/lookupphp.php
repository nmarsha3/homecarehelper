<?php
header('Access-Control-Allow-Origin: *');
$code = $_GET['input-code'];

$link = mysqli_connect('localhost', 'mrauch2', 'frc254') or die ('died');

mysqli_select_db($link, 'mrauch2');

$stmt = mysqli_prepare($link, "select name from Procedures where code = ?");
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $code);

echo "<table>\n";
while(mysqli_stmt_fetch($stmt)){

   echo "<tr>\n";
   echo "<td>$code</td>";
   echo "</tr>\n";

}
echo "</table>\n";

header('Location: lookup.html'); die();

?>
