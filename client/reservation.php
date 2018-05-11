<!DOCTYPE html>
<html>
	<?php require_once ('includes/head.inc.php')?>
	<body>
		<?php include_once ('includes/nav.inc.php')?>
		<!-- Main -->
		<div class="container">
			<div class="row">
				<div class="col-md jumbotron-fluid mainbox img-fluid" style="height:23em; border-style:solid;">
					<div class="">
						<h1>Reservation</h1>
						<div class="form-group">
							<label class="col-md-4 col-form-label">Check-in Date</label>
							<div class="col-md-3">
								<input type="date" class="form-control" name="checkin">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-form-label">Check-out Date</label>
							<div class="col-md-3">
								<input type="date" class="form-control" name="checkout">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<input type="radio" name="post-format" checked /> House
								&nbsp;&nbsp;
								<input type="radio" name="post-format" id="room" /> Rooms
								<div class="col-md-6" id="no_of_rooms">
									<label for="rooms" class="col-md-12 col-form-label">Number of rooms:</label>
									<select class="form-control col-md-3" id="rooms">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="js/roomreservation.js "></script>
</html>