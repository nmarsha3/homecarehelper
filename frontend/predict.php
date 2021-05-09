<?php
include "config.php";

$ssn = $_GET['input_ssn'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		body {
			background-image: url('https://images.immediate.co.uk/production/volatile/sites/4/2013/04/GettyImages-640318118-c83a508.jpg?quality=90&resize=940%2C400');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}

		.jumbotron {
			opacity: .95;
		}
	</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Care Helper</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   <nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Home Care Helper</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<?php
			$dict = array();

			$stmt1 = mysqli_prepare($con, "select item, severity from Allergies where patient_ssn=?");
            mysqli_stmt_bind_param($stmt1, "s", $ssn);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $allergy, $severity);

         $sa = array();
         while(mysqli_stmt_fetch($stmt1)){
            
            $sa[$allergy] =  $severity;
         
         }
         
         mysqli_stmt_close($stmt1);
			
			echo "<p style='color:white'><font size = '6'><strong>Predictions</strong></font></p>";
			echo "<p style='color:white'><font size = '4'>Based on your allergies and medications you may be at risk for the following conditions.</font></p>";
	
			$stmt3 = mysqli_prepare($con, "select diagnosis_code, count(*) from Allergies, Treats where item = ? and Allergies.patient_ssn = Treats.patient_ssn group by diagnosis_code order by count(*) desc");
         
         foreach($sa as $sev => $al){

            mysqli_stmt_bind_param($stmt3, "s", $allergy);
            mysqli_stmt_execute($stmt3);
				mysqli_stmt_bind_result($stmt3, $code, $total);
            
            while(mysqli_stmt_fetch($stmt3)){
                $dict[$code] =  $total;
				}

         }
         mysqli_stmt_close($stmt3);
         
			$stmt2 = mysqli_prepare($con, "select medicine from Prescriptions where patient_ssn = ?");
            mysqli_stmt_bind_param($stmt2, "s", $ssn);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $med);

            $meds = array();
            while(mysqli_stmt_fetch($stmt2)){
               
               $meds[$med] =  1;
          
            }

            mysqli_stmt_close($stmt2);

			
			$stmt4 = mysqli_prepare($con, "select diagnosis_code, count(*) from Prescriptions, Treats where medicine = ? and Prescriptions.patient_ssn = Treats.patient_ssn group by diagnosis_code order by count(*) desc");
            
         foreach($meds as $med => $k){

            mysqli_stmt_bind_param($stmt4, "s", $med);
            mysqli_stmt_execute($stmt4);
            mysqli_stmt_bind_result($stmt4, $code, $total);
            
            while(mysqli_stmt_fetch($stmt4)){
					if(array_key_exists($code, $dict)){
						$dict[$code] = $dict[$code] + $total;
					}
					else{
						$dict[$code] = $total;
					}
                
				}

         }
         mysqli_stmt_close($stmt4);
         
         
         $orig_dict = $dict;
         arsort($dict, SORT_NUMERIC); 
         $top3 = array_slice($dict, 0, 3);

			foreach($top3 as $key => $value){
            
			   $stmt5 = mysqli_prepare($con, "select name from Diagnoses where code = ?");
            mysqli_stmt_bind_param($stmt5, "s", $key);
            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $name);
            mysqli_stmt_fetch($stmt5);

				echo "<div class='jumbotron'>";
				echo "<div class='row'>";
            	echo "<div class='col-sm-6'>";
				echo "<p>$name <br />";
            	echo "</div></div></div>";
            mysqli_stmt_close($stmt5);
         }
 
		?>
	<footer class="footer">
		<div class="container">
			<hr>
			<p style=color:snow>Created by Nick Marshall, Greta Rauch, and Jacob Mazur</p>
			<p style=color:snow>2020-03-20</p>
		</div>
	</footer>
   <!--<script src="lookup.js" type="text/javascript"></script> -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
		crossorigin="anonymous"></script>
</body>

</html>
