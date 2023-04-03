<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Show</title>
	<link rel="stylesheet" type="text/css" href="style.css"><link rel="stylesheet" type="text/css" href="nav.css">
  <link rel="stylesheet" type="text/css" href="cstyle.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<?php include('nav_admin.php') ?>
	<style>
		.header {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Create Show</h2>
	</div>
	<form method="post" action="create_show.php" enctype="multipart/form-data">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Movie Name</label>
			<input type="text" name="moviename" value="<?php echo $moviename; ?>">
		</div>
		<div class="input-group">
			<?php include('date_show.php'); ?>
        </div>
		<div class="input-group">
			<label>ShowTime</label>
			<input type="timing" name="timing" placeholder="HH:MM:SS" value="<?php echo $show_timing; ?>">
		</div>
		<div class="input-group">
			<label>Screen</label>
			<input type="text" name="screen" value="<?php echo $screen; ?>">
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="text" name="price" value="<?php echo $price; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="show_btn"> + Add Show</button>
		</div>
	</form>
</body>
</html>


