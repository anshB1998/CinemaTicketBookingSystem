<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Movie</title>
	 <link rel="stylesheet" type="text/css" href="style.css"><link rel="stylesheet" type="text/css" href="nav.css">
  <link rel="stylesheet" type="text/css" href="cstyle.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<style>
    .header {
      background: #003366;
    }
    button[name=Upload_Now] {
      background: #003366;
      margin-top: 10px;
    }
	</style>
</head>
<body>
  <?php include('nav_admin.php') ?>
	<div class="header">
		<h2>Admin - Add Movie</h2>
	</div>
			<form action="home.php" enctype="multipart/form-data" method="post">
        <div class="input-group">
          <label>Movie Name</label>
          <input type="text" name="movieName" id="movieName" value="<?php echo $moviename ?>">
        </div>
        <div class="input-group">
          <label>Description</label>
          <input type="text" name="description" id="description" value="<?php echo $description ?>">
        </div>
        <div class="input-group">
        	<?php include('date.php'); ?>
        </div>
      	<div>
          <label>Insert Poster</label>
          <input name="uploadedimage" type="file">
          <button name="Upload_Now" type="submit" value="Upload Image" class="btn">Add Movie</button>
        </div>
      </form>
</body>
</html>