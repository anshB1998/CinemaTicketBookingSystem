<?php 
include('functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Homepage</title>
	<link rel="stylesheet" type="text/css" href="cstyle.css">
	<?php include('nav_admin.php') ?>
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="content" style="width: 90%">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<div align="center">
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
					</small>
				<?php endif ?>
			</div>
		</div>
		<div>
		<?php
			$result = mysqli_query($db, "SELECT * FROM movie");
			$result1 = mysqli_query($db, "SELECT * FROM user");

			$c = "SELECT COUNT(movieId) FROM movie";
			$count = mysqli_query($db, $c);
			$f = $count->fetch_assoc();

			$c1 = "SELECT COUNT(*) FROM user";
			$count1 = mysqli_query($db, $c1);
			$f1 = $count1->fetch_assoc();

			echo "<div class='card' style='width: 25rem;float:left; margin-left:15%; margin-bottom:2%'>
			<div class='card-body'>
			  <h5 class='card-title btn btn-primary'>Users</h5>
			  <p class='card-text'>Number of users in the database are: ".$f1["COUNT(*)"];
			echo " </p></div></div>";
			echo "<div class='card' style='width: 25rem; float:left; margin-left:15%'>
			<div class='card-body'>
			  <h5 class='card-title btn btn-primary'>Movies</h5>
			  <p class='card-text'>Number of Movies in the database are: ".$f["COUNT(movieId)"];
			echo " </p></div></div>";

			echo "<table class='table caption-top'>
			<caption>List of movies</caption>
			<thead>
			  <tr>
				<th scope='col'>Movie Name</th>
				<th scope='col'>Release Date</th>
				<th scope='col'>Actions</th>
			  </tr>
			</thead><tbody>";

			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>".$row['movieName']."</td>";
				echo "<td>".$row['releaseDate']."</td>";
			    echo "<td>";
			    echo "<div>";
			    echo "<a href='./edit.php?id=".$row['movieId']."'> Update</a>";
			    echo "<a href='./delete.php?id=".$row['movieId']."'> Delete</a>";
			    echo "</div>";
			    echo "</td>";
				echo "</tr>";
			}
			echo "</tbody></table>"; ?>
		</div>
	</div>
</body>
</html>