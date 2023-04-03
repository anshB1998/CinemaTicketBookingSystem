<?php 
session_start();

// Connect to database
$db = mysqli_connect('localhost', 'root', '', 'movie_booking');

// variable declaration
$username = "";
$email = "";
$moviename = "";
$movieid = "";
$description = "";
$target_path = "";
$temp_name = "";
$rel_date = "";
$search = "";
$show_date = "";
$movie_id = "";
$show_timing = "";
$screen = "";
$price = "";
$errors = array();

// Call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

if (isset($_POST['show_btn'])) {
	showtime();
}

if (isset($_POST['Upload_Now'])) {
	$host = "localhost";
  $databasename = "movie_booking";
  $user = "root";
  $pass = "";
  $conn = mysqli_connect($host, $user, $pass);

  if($conn) {
    $db_selected = mysqli_select_db($conn, $databasename);
    if (!$db_selected) {
      die ('Cant use foo: '.mysql_error());
    }
  }
  else {
    die('Not connected: '.mysql_error());
  }

  $moviename = e($_POST['movieName']);
	$description = e($_POST['description']);
	$rel_date = e($_POST['releaseDate']);
 	movies();
}

// REGISTER USER
function register() {
	// Call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// Receive all input values from the form. Call the e() function defined below to escape form values
	$username = e($_POST['username']);
	$email = e($_POST['email']);
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);

	// Form validation
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// Register user if there are no errors in the form
	if (count($errors) == 0) {
		// Encrypt the password before saving in the database
		$password = md5($password_1);
		$user_type = "user";
		if(isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
		}
		$query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['user'] = getUserByUsername($username);

		if ($user_type == "admin") {
			$currentDate = date("Y-m-d");
			$queryAdmin = "INSERT INTO admin (username, joiningDate) VALUES ('$username', '$currentDate')";
			mysqli_query($db, $queryAdmin);
			$_SESSION['user']['user_type'] = 'admin';
			$_SESSION['success'] = "New admin user successfully created";
			header('location: home.php');
		} else {
			// Put logged in user in session
			$_SESSION['user']['user_type'] = 'user';
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

// Return user array from their username
function getUserByUsername($id) {
	global $db;
	$query = "SELECT * FROM user WHERE username = '".$id."'";
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// Escape string
function e($val) {
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="error">';
		foreach ($errors as $error) {
			echo $error .'<br>';
		}
		echo '</div>';
	}
}

function isLoggedIn() {
	if (isset($_SESSION['user'])) {
		return true;
	} else{
		return false;
	}
}

// Log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// Call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login() {
	global $db, $username, $errors;

	// Grab form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// Form validation
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// Attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		$isAdminQuery = "SELECT * FROM user WHERE username = '$username' AND username IN (SELECT username FROM admin)";
		$resultsAdmin = mysqli_query($db, $isAdminQuery);

		$adminIdQuery = "SELECT adminId FROM admin WHERE username = '$username'";
		$resultsAdminId = mysqli_query($db, $adminIdQuery);
		$adminId = mysqli_fetch_assoc($resultsAdminId);

		// User found
		if (mysqli_num_rows($results) == 1) { 
			// Check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if (mysqli_num_rows($resultsAdmin) == 1) {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['user']['user_type'] = 'admin';
				$_SESSION['user']['username'] = $username;
				$_SESSION['user']['admin_id'] = $adminId["adminId"];
				$_SESSION['success']  = "You are now logged in";
				header('location: home.php');		  
			} else {
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['user']['user_type'] = 'user';
				$_SESSION['user']['username'] = $username;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin() {
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
		return true;
	}else{
		return false;
	}
}	


function movies() {
	// Call these variables with the global keyword to make them available in function
	global $db, $errors, $moviename, $movieid, $description, $temp_name, $target_path, $rel_date;

	// Form validation
	if (empty($moviename)) { 
		array_push($errors, "Title is required"); 
	}
	if (empty($description)) { 
		array_push($errors, "Description is required"); 
	}
	if (empty($rel_date)) { 
		array_push($errors, "Release date is required"); 
	}
	// if (count($errors == 0)) {
		if (!empty($_FILES["uploadedimage"]["name"])) {
	    $file_name = $_FILES["uploadedimage"]["name"];
	    $temp_name = $_FILES["uploadedimage"]["tmp_name"];
	    $imgtype = $_FILES["uploadedimage"]["type"];
	    $ext = GetImageExtension($imgtype);
	    $imagename = $_FILES["uploadedimage"]["name"];
	    $target_path = "images/".$imagename;
	    $admin_id = $_SESSION['user']['admin_id'];
	    $movieId = "m/100-".str_replace(' ', '_', $moviename);;
	    if(move_uploaded_file($temp_name, $target_path)) {
	      $query_upload = "INSERT INTO movie (movieId, movieName, description, releaseDate, adminId, poster) VALUES ('$movieId', '$moviename', '$description', '$rel_date', '$admin_id', '".$target_path."')";
	        mysqli_query($db, $query_upload) or die("error in $query_upload == ----> ".mysql_error());
	      $_SESSION['success'] = "Movie added successfully!!";
	    }
	    else {
	      exit("Error While uploading image on the server");
	    }
	  }
  // }
}

function GetImageExtension($imagetype) {
  if(empty($imagetype)) return false;
  switch($imagetype) {
    case 'image/bmp': return '.bmp';
    case 'image/gif': return '.gif';
    case 'image/jpeg': return '.jpg';
    case 'image/png': return '.png';
    default: return false;
  }
}

function seat_insertion($mov, $dat, $tim, $sid) {
	global $db;
	$mov_id = $mov;
	$num = $_SESSION['user']['username'];
	$selected = true;
	$checkbox1 = $_POST['chck1'];

	$q = 'SELECT MAX(bookingId) FROM booking';
	$res = mysqli_query($db, $q);
	$bid = $res->fetch_assoc();
	foreach ($bid as $value) {
	    $bidn = $value;
	}
	$bidn = (int)$bidn;
	$bidn = $bidn + 1;
	$ts = date('m-d-Y h:i:s', time());

	$q = "INSERT INTO booking VALUES('$bidn','$num', '$ts', '$sid')";
	mysqli_query($db, $q);

	for($i=0; $i<sizeof($checkbox1); $i++) {
	    $query = "UPDATE seat SET availability = 0 WHERE showId = '$sid' AND seatId = '$checkbox1[$i]'";
	    mysqli_query($db, $query);

	    $query1 = "UPDATE seat SET bookingId = '$bidn' WHERE showId = '$sid' AND seatId = '$checkbox1[$i]'";
	    mysqli_query($db, $query1);
	}
}

function seat_checked($mov, $dat, $tim, $s, $sid) {
    global $db;
    $q = "SELECT seatId FROM seat WHERE availability = 0 AND showId = '$sid' AND seatId = '$s'";
    $result = mysqli_query($db, $q);
    if($result->num_rows == 1){
        return "disabled";
    }
}

function showtime() {
	global $db, $errors;

	$moviename = e($_POST['moviename']);
	$show_timing = e($_POST['timing']);
	$show_date = e($_POST['show_date']);
	$screen = e($_POST['screen']);
	$price = e($_POST['price']);
	$admin_id = $_SESSION['user']['admin_id'];

	// Form validation
	if (empty($moviename)) {
		array_push($errors, "Movie name is required");
	}
	if (empty($show_date)) {
		array_push($errors, "Showdate is required");
	}
	if (empty($show_timing)) {
		array_push($errors, "Showtime is required");
	}
	if (empty($screen)) {
		array_push($errors, "Screen is required");
	}
	if (empty($price)) {
		array_push($errors, "Price is required");
	}

	$movieQuery = "SELECT movieId FROM movie WHERE movieName = '".$moviename."'";
	$result = mysqli_query($db, $movieQuery);
	$id = mysqli_fetch_assoc($result);
	$movie_id = $id["movieId"];

	$show_time = $show_date." ".$show_timing;

	if (count($errors) == 0) {
	$query = "INSERT INTO shows (movieId, showTiming, screen, price, adminId) VALUES ('$movie_id', '$show_time', '$screen', '$price', '$admin_id')";
	mysqli_query($db, $query);

	// Insert seats for this new show
	$showId = mysqli_insert_id($db);
	for($i=1; $i<26; $i++) {
		$query = "INSERT INTO seat (seatId, bookingId, showId, availability) VALUES ('$i', 0, '$showId', 1)";
		mysqli_query($db, $query);
	}
	$_SESSION['success'] = "New showtime successfully added";
	header('location: home.php');
	}
}

function del_booking($id) {
	global $db;
	$seat_unblock_query = "UPDATE seat SET availability = 1, bookingId = 0 WHERE bookingId = '$id'";
	mysqli_query($db, $seat_unblock_query);
	$q = "DELETE FROM booking WHERE bookingId = '$id'";
	$result = mysqli_query($db, $q);
}

// function mail_tickets($movie_name, $screen, $time, $seats) {
// 	$msg = "Your tickets for ".$movie_name." at AMC Theatres in Screen ".$screen." on ".$time." with seats: ".$seats." have been confirmed!";

// 	// use wordwrap() if lines are longer than 70 characters
// 	$msg = wordwrap($msg, 70);

// 	mail("anshbilimoria007@gmail.com", "My Tickets", $msg);
// 	$_SESSION['success'] = "Tickets mailed!";
// 	header('location: profile.php');
// }