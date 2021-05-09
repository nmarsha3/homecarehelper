<?php

include "config.php";

// Check connection
if ($con->connect_error) {
   die("Connection failed: " . $con->connect_error);
}
else{
   echo "Connection goodn\n";
}

$ssn = mysqli_real_escape_string($con, $_GET['input_ssn']);
echo $ssn;
$item = mysqli_real_escape_string($con, $_GET['input_item']);
echo $item;
$severity = mysqli_real_escape_string($con, $_GET['input_severity']);
echo $severity;

# TODO: Insert above information into db!!
$stmt = mysqli_prepare($con, "insert into Allergies values(?, ?, ?);");
mysqli_stmt_bind_param($stmt, "sss", $ssn, $item, $severity);
mysqli_stmt_execute($stmt);
if ($con->query($stmt) === TRUE) {
     echo "New record created successfully";
} else {
     echo "Error: <br>" . $con->error;
}
mysqli_stmt_close($stmt);
?>
