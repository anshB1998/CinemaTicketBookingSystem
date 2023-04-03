<?php include('functions.php') ?>
<?php
    if(!isset($_GET['id'])){
        die('ID not provided');
    }
     require_once('functions.php');
     $id = $_GET['id'];
     $sql = "SELECT * FROM movie WHERE movieId = '$id'";
     $result = mysqli_query($db,$sql);
     $data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Movie</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
  <?php include('nav_admin.php') ?>
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
	<div class="header">
		<h2>Admin - Edit Movie</h2>
	</div>
			<form action="./modify.php?id=<?= $id ?>" enctype="multipart/form-data" method="post">
        <div class="input-group">
          <label>Movie Name</label>
          <input type="text" name="movieName" id="movieName" value="<?= $data['movieName'] ?>">
        </div>
        <div class="input-group">
          <label>Description</label>
          <input type="text" name="description" id="description" value="<?= $data['description'] ?>">
        </div>
        <div class="input-group">
          <?php include('date.php'); ?>
        </div>
      	<div>
<!--           <label>Update Poster</label>
          <input name="uploadedimage" type="file"> -->
          <br>
          <button name="UpdateForm" type="submit" value="Upload Image" class="btn">Update Movie</button>
        </div>
      </form>
</body>
</html>