<?php

include "config.php";

// Grab the question from the js
$question = mysqli_real_escape_string($con, $_GET['input-question']);

// Create the english file
$in_file = fopen("./nlp/db.eng", "w") or die("Unable to open file!");

fwrite($in_file, $question);
fwrite($in_file, "\n");

fclose($in_file);

// translate to sql
$command = '/var/www/html/cse30246/homecarehelper/nick/homecarehelper/frontend/nlp/venv/bin/python3 ./nlp/transformer_solution.py --load ./nlp/hch4.model ./nlp/db.eng -o ./nlp/db.sql 2>error.txt';
$output = shell_exec($command);

// grab the results string from the file
$out_file = fopen("./nlp/db.sql", "r") or die ("Unable to open file!");
$query_stmt = fgets($out_file);
fclose($out_file);

// Display the question
echo "Your question: $question";
echo "<br>";

// Correct the ssn if needed
$delimiter = ' ';
$query_words = explode($delimiter, $query_stmt);
$question_words = explode($delimiter, $question);

foreach($question_words as $word){
   if (strlen($word) == 9 && is_numeric(substr($word, 0, 1))){
      
      $correct_ssn = $word;
      
   }
}

$new_q = "";
foreach($query_words as $word){
   if (strlen($word) == 13 && substr($word, -2, 1) == ';'){
      $new_q = $new_q."'$correct_ssn';"; 
   }
   else{
    $new_q = $new_q.$word;
    $new_q = $new_q." ";
   }
}

// Display the query
echo "Your generated query: $new_q";
echo "<br>";

//$query_stmt = "select * from Treats where doctor_ssn = 100452540";

// query database
if ($result = $con->query($new_q)){
   if($result->num_rows == 0){
      echo "Empty Set Returned";
      echo "<br>"; 
   } 
   while ($row = mysqli_fetch_assoc($result)) {
      foreach($row as $element){
         echo "<br>";
         echo "$element";
         echo "<br>";
      }
   }
   $result -> free_result();
}
else{
   echo "Sadly we were unable to interpret your question, try rephrasing.\n";
}


$con -> close();



?>
