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
            <form method="post" action="">
				<?php
					echo "SSN: <input type=text class=textbox name=input_ssn id=input_ssn value=$ssn readonly></p>";
				?>
            <br>
            <div class="col-sm-6">
               First Name: <input type="text" class="textbox" name="input-first-name" id="input-first-name"/>
            <br>
				</div>
            <div class="col-sm-6">
               Last Name: <input type="text" class="textbox" name="input-last-name" id="input-last-name"/>
            <br>
				</div>
            <div class="col-sm-6">
               Birthday: <input type="text" class="textbox" name="input-birthday" id="input-birthday"/>
            <br>
				</div>
            <div class="col-sm-6">
               Specialty: <input type="text" class="textbox" name="input-address" id="input-specialty"/>
            <br>
				</div>
            <div class="col-sm-6">
               Phone: <input type="text" class="textbox" name="input-phone" id="input-phone"/>
            <br>
				</div>
            <div class="col-sm-6">
                    <input type="button" value="Submit" id="submit-button">
				</div>
            
          </form>

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
   <script src="edit_info_doctor.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
		crossorigin="anonymous"></script>
</body>

</html>
