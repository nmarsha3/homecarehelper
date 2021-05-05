<?php

include "config.php";

$question = mysqli_real_escape_string($con, $_GET['input-question']);
echo $question;

$file = fopen("./nlp/db.eng", "w") or die("Unable to open file!");

fwrite($file, $question);
fwrite($file, "\n");

fclose($file);

//$command = escapeshellcmd('python3 ./nlp/transformer_solution.py --load ./nlp/part2.model ./nlp/db.eng -o ./nlp/db.sql 2>&1');
//$command = '~dchiang/Public/python/bin/python3.7 ./nlp/transformer_solution.py --load ./nlp/part2.model ./nlp/db.eng -o ./nlp/db.sql 2>&1';
//echo $command;
//exec($command, $output, $status);
//$output = shell_exec($command);




//$command = escapeshellcmd('~dchiang/Public/python/bin/python3.7 ./nlp/transformer_solution.py --load ./nlp/part2.model ./nlp/db.eng -o ./nlp/db.sql');


$command = escapeshellcmd('~dchiang/Public/python/bin/python3.7 ./nlp/test.py 2>&1');
$output = shell_exec($command);
echo $output;
//echo $status;

/*$stmt = mysqli_prepare($con, "select name from Procedures where code = ?");
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $code);

mysqli_stmt_fetch($stmt);
echo $code;*/

?>
