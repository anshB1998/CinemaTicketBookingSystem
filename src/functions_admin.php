<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'movie_booking');

// variable declaration
$username = "";
$email = "";
$moviename = "";
$movieid = "";
$description = "";
$errors = array(); 

if (isset($_POST['movie_btn'])) {
 	movies();
}

// escape string
function e1($val) {
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error1() {
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="error">';
		foreach ($errors as $error) {
			echo $error .'<br>';
		}
		echo '</div>';
	}
}

function movies() {
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $moviename, $movieid, $description;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$moviename = e1($_POST['moviename']);
	$movieid = e1($_POST['movieid']);
	$description = e1($_POST['description']);
	$rel_date = e1($_POST['rel_date']);

	// form validation: ensure that the form is correctly filled
	if (empty($moviename)) { 
		array_push($errors, "Title is required"); 
	}
	if (empty($movieid)) { 
		array_push($errors, "ID is required"); 
	}
	if (empty($description)) { 
		array_push($errors, "Description is required"); 
	}
	if (empty($rel_date)) { 
		array_push($errors, "Release date is required"); 
	}

	if (count($errors) == 0) {
		$query = "INSERT INTO movie (movieId, movieName, description, releaseDate) 
				  VALUES('$movieid', '$moviename', '$description', '$rel_date')";
		mysqli_query($db, $query);
		$_SESSION['success'] = "New movie successfully added!";
		header('location: home.php');
	}
}

