<?php
    require_once('functions.php');

    if(isset($_GET['id']) && isset($_POST['UpdateForm'])){

        $id = $_GET['id'];
        $moviename = e($_POST['movieName']);
        $description = e($_POST['description']);
        $rel_date = e($_POST['releaseDate']);
        $poster = e($_POST['poster']);

        $sql = "UPDATE movie SET movieName = '$moviename', description = '$description', releaseDate = '$rel_date'
--         `poster`='$'
        WHERE movieId = '$id'";

        if(mysqli_query($db, $sql) === TRUE){
            echo "Updated the data";
            $_SESSION['success'] = "Record was updated successfully";
            header('location: home.php');
        } else {
            echo "Something went wrong";
            $_SESSION['failure'] = "Something went wrong";
            header('location: home.php');
        }
    }
?>