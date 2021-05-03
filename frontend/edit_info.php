<?php
include "config.php";

$ssn = $_GET['input-ssn'];

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
		<div class="jumbotron">
			<div class="row">
				<div class="col-sm-6">
					<div class="thumbnail">
						<img class="img img-responsive img-thumbnail"
							src="https://dlyhjlf6lts50.cloudfront.net/app/uploads/2020/09/what_services_do_in_home_caregivers_provide-1024x683.jpg"
							alt="This is some text">
						
					</div>
				</div>
            <div class="col-sm-6">
                <p>Hello!</p>
				</div>
            <div class="col-sm-6">
                <p>SSN: <?php echo "$ssn"?></p>
				</div>
            <div class="col-sm-6">
                <p>First Name: 
                    <?php
                        
                        $stmt1 = mysqli_prepare($con, "select first_name from People where ssn=?");
                        mysqli_stmt_bind_param($stmt1, "s", $ssn);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1, $fn);
                        mysqli_stmt_fetch($stmt1);
                        printf("%s\n", $fn);
                        mysqli_stmt_close($stmt1);


                    ?>
                </p>
				</div>
            <div class="col-sm-6">
                <p>Last Name: 
                    <?php
                        
                        $stmt2 = mysqli_prepare($con, "select last_name from People where ssn=?");
                        mysqli_stmt_bind_param($stmt2, "s", $ssn);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $ln);
                        mysqli_stmt_fetch($stmt2);
                        printf("%s\n", $ln);
                        mysqli_stmt_close($stmt2);
                        

                    ?>
                </p>
            </div>
            <div class="col-sm-6">
                <p>Address: 

                    <?php
                        
                        $stmt3 = mysqli_prepare($con, "select address, city, country from Patient where ssn=?");
                        mysqli_stmt_bind_param($stmt3, "s", $ssn);
                        mysqli_stmt_execute($stmt3);
                        mysqli_stmt_bind_result($stmt3, $addr, $city, $country);
                        mysqli_stmt_fetch($stmt3);
                        printf("%s, %s, %s\n", $addr, $city, $country);
                        mysqli_stmt_close($stmt3);

                    ?>    

                </p>
				</div>
            <div class="col-sm-6">
                <p>Phone: 
                    <?php

                        $stmt4 = mysqli_prepare($con, "select number from Phone where ssn=?");
                        mysqli_stmt_bind_param($stmt4, "s", $ssn);
                        mysqli_stmt_execute($stmt4);
                        mysqli_stmt_bind_result($stmt4, $phone);
                        mysqli_stmt_fetch($stmt4);
                        printf("%s\n", $phone);
                        mysqli_stmt_close($stmt4);

                    ?>

                </p>
				</div>
            <div class="col-sm-6">
                <button onclick="location.href = './new_user.html'" value="Edit" id="edit-button">Edit</button>
				</div>

         </div>


		</div>
	</div>
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
