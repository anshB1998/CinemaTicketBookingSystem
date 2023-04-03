<?php include('functions.php'); ?>
<!DOCTYPE  html>
<html>
<head>
	<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
	<link rel="stylesheet" type="text/css" href="cstyle.css"  />
	<?php include('nav2.php') ?>
	<title>Profie Page</title>
	<style>
		/* Popup container - can be anything you want */
		.popup {
		  position: relative;
		  display: inline-block;
		  cursor: pointer;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		}

		/* The actual popup */
		.popup .popuptext {
		  visibility: hidden;
		  width: 160px;
		  background-color: #555;
		  color: #fff;
		  text-align: center;
		  border-radius: 6px;
		  padding: 8px 0;
		  position: absolute;
		  z-index: 1;
		  bottom: 125%;
		  left: 50%;
		  margin-left: -80px;
		}

		/* Popup arrow */
		.popup .popuptext::after {
		  content: "";
		  position: absolute;
		  top: 100%;
		  left: 50%;
		  margin-left: -5px;
		  border-width: 5px;
		  border-style: solid;
		  border-color: #555 transparent transparent transparent;
		}

		/* Toggle this class - hide and show the popup */
		.popup .show {
		  visibility: visible;
		  -webkit-animation: fadeIn 1s;
		  animation: fadeIn 1s;
		}

		/* Add animation (fade in the popup) */
		@-webkit-keyframes fadeIn {
		  from {opacity: 0;} 
		  to {opacity: 1;}
		}

		@keyframes fadeIn {
		  from {opacity: 0;}
		  to {opacity:1 ;}
		}
	</style>
</head>
<body>
	<div id="contentbox">
		<div id="signup">
			<div id="signup-st">
				<form action="" method="POST" id="signin" id="reg">
					<div id="reg-head" class="headrg">Your Profile</div>
					<table border="0" align="center" cellpadding="2" cellspacing="0">
						<tr id="lg-1">
							<td class="tl-1">
								<div align="left" id="tb-name"><b>Username: </b></div>
							</td>
							<td class="tl-4"><?php echo $_SESSION['user']['username']; ?></td>
						</tr>
						<tr id="lg-1">
							<td class="tl-1">
								<div align="left" id="tb-name"><b>Email ID: </b></div>
							</td>
							<td class="tl-4"><?php echo $_SESSION['user']['email']; ?></td>
						</tr>
					</table>
				</form>
 			</div>
		</div>
	</div>

	<?php
		$map = array(1 => "A1", 2 => "A2", 3 => "A3", 4 => "A4", 5 => "A5",
					 6 => "B1", 7 => "B2", 8 => "B3", 9 => "B4", 10 => "B5",
					 11 => "C1", 12 => "C2", 13 => "C3", 14 => "C4", 15 => "C5",
					 16 => "D1", 17 => "D2", 18 => "D3", 19 => "D4", 20 => "D5",
					 21 => "E1", 22 => "E2", 23 => "E3", 24 => "E4", 25 => "E5");

		$user = $_SESSION['user']['username'];
		$query = "SELECT movieName, movieId AS mid, seat.bookingId, COUNT(seatId) AS cnt, screen, showTiming FROM seat JOIN booking USING (bookingId) JOIN shows ON (booking.showId = shows.showId) JOIN movie USING (movieId) WHERE username = '$user' AND seat.bookingId <> 0 GROUP BY movieName, mid, seat.bookingId, showTiming, screen";
		$result = mysqli_query($db, $query);
	?>	
 	<div>
		<form action="profile.php" method="POST" name="display">
			<div align="left" id="tb-name"><h4>Booked Tickets: </h4>
				<?php
					$i = 0;
					while ($row = $result->fetch_assoc()) {
						$i += 1;
						$booking_id = $row["bookingId"];
						$mid = $row["mid"];
						$seat_query = "SELECT seatId FROM seat WHERE bookingId = '$booking_id'";
						$seat_result = mysqli_query($db, $seat_query);
						$seats = "";
						while($curr_seat = $seat_result->fetch_assoc()) {
							$seats .= $map[$curr_seat["seatId"]]." ";
						}
						echo '<b>', "".$row["movieName"]."<br>", '</b>', "Screen: ".$row["screen"]."<br>", "Show Time: ".$row["showTiming"]."<br>", '<div class="popup" onclick="popup('.$i.')">', $row["cnt"]." seat(s)", '<span class="popuptext" id="myPopup'.$i.'">', "".$seats."", '</span></div>';
						// echo '<div><button type="submit" class="btn" name="mail_btn">Mail Tickets</button></div><p>';
						echo '<div><button type="submit" class="btn" value="', "".$booking_id."", '" name="del_btn">Delete Booking</button></div>';

						mysqli_free_result($seat_result);
						mysqli_next_result($db);
						$rec_result = mysqli_query($db, "CALL movie_rec('$mid')");
						$recommended = $rec_result->fetch_assoc();
						$mov_id = $recommended["movieName"];
						mysqli_free_result($rec_result);
						mysqli_next_result($db);
						$mov_result = mysqli_query($db, "SELECT movieName FROM movie WHERE movieId = '$mov_id'");
						echo '<b>Similar Movie: </b>'.$mov_result->fetch_assoc()["movieName"].'<br>';
						echo '<br>';
					}
				?>
			</div>
		</form>
	</div>
	<?php
		if (isset($_POST['del_btn'])) {
			del_booking($_POST['del_btn']);
		}
		// if (isset($_POST['mail_btn'])) {
		// 	echo $seats;
		// 	mail_tickets($row["movieName"], $row["screen"], $row["showTiming"], $seats);
		// }
	?>
	<script>
		function popup(id) {
			var ID = "myPopup" + id;
		  	var popup = document.getElementById(ID);
		  	popup.classList.toggle("show");
		}
	</script>
</body>
</html>