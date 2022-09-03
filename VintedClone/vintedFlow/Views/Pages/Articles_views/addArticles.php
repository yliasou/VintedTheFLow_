<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>TheFlow Booking Hotels</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">
							<h1>Faite vos reservations d'hotel en 1 Clic</h1>
							<p> Tout dabord veuillez vous connectez ou inscrire pour accedez a nos listes d'hotel.
							</p>
						</div>
					</div>
					<div class="col-md-4 col-md-pull-7">
						<div class="booking-form">
							<form method="post" action="UploadHotelData.php"  enctype="multipart/form-data">
							<h2 style="text-align: center;">Integrer un Hotel</h2>  
								<div class="form-group">
									<span class="form-label">Nom de l'hotel</span>
									<input class="form-control" type="text" placeholder="Entrer le nom de l'hotel" name="hotelname">
									<br>
									<input class="form-control" type="number" placeholder="Prix" name="commandIDs">
									<br>
									<input class="form-control" type="text" placeholder="UserId" name="usersvalue" value="<?php echo $_SESSION['unique_id'];?>" hidden>
									<br>
									<input class="form-control" type="text" placeholder="UserId" name="Price" value="<?php echo rand(1, 999999999); ?>" hidden="hidden">
										
								</div>
								<label>Select Image File:</label>
								<input type="file" name="image">
								
								<!-- <div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Check In</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Check out</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
								</div> -->
								<div class="row">
									<div class="col-sm-4">
										<!-- <div class="form-group">
											<span class="form-label">Rooms</span>
											<select class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
											<span class="select-arrow"></span>
										</div> -->
									</div>
									<div class="col-sm-4">
										<!-- <div class="form-group">
											<span class="form-label">Adults</span>
											<select class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
											<span class="select-arrow"></span>
										</div> -->
									</div>
									<div class="col-sm-4">

									</div>
								</div>
								<div class="form-btn" style="text-align: center;">
								<br>
									<input type="submit" name="submit" value="Enregistrer">
									
								</div>
								<br>

								<div style="text-align: center; color: red;">
									<?php 
										if (empty($_GET['erreur']))
										{
										#Condition null !!
										} 
										else
										{
										echo $_GET['erreur'];

										} 					
									?>
								</div>
								<div style="text-align: center; color: green;">
									<?php 
										if (empty($_GET['validate']))
										{
										#Condition null !!
										} 
										else
										{
										echo $_GET['validate'];

										} 					
									?>
								</div>
								<br>
								<div style="text-align: center;">
									<a href="Inscription.php">Je n'ai pas de compte</a>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>