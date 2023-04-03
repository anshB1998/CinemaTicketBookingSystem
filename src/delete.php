<?php
    require_once('functions.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        echo $id;
        $sql = "DELETE FROM movie WHERE movieId = '$id'";
        if(mysqli_query($db, $sql) === TRUE){
            echo "Deleted the data";
            $_SESSION['success']  = "Record was deleted successfully";
            header('location: home.php');
        } else {
            echo "Something went wrong";
            $_SESSION['failure'] = "Something went wrong";
            header('location: home.php');
        }
    } else {
        die('ID not provided');
    }

?>