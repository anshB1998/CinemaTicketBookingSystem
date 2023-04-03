<?php
    $con = mysqli_connect("localhost", "root", "", "movie_booking");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="cstyle.css"/>
    <?php include('nav2.php') ?>
</head>
<body>
<?php
    // gets value sent over search form
    $query = $_GET['query']; 

    $min_length = 3;

    if(strlen($query) >= $min_length) {
        // Changes characters used in html to their equivalents, for example: < to &gt;
        $query = htmlspecialchars($query); 

        // Makes sure nobody uses SQL injection
        $query = mysqli_real_escape_string($con, $query);

        $raw_results = mysqli_query($con, "SELECT * FROM movie WHERE (`movieName` LIKE '%".$query."%')") or die(mysql_error());

        if(mysqli_num_rows($raw_results) > 0) {
            while($results = mysqli_fetch_array($raw_results)) { ?>
                <div>
                    <form action="movie_info.php" method="POST" name="display">
                        <div align="left" id="tb-name"><p><img alt="Poster Not Available" src="<?php echo $results["poster"];?>" style="height: 70%"></p></div>
                        <div align="left" id="tb-name"><b><?php echo "".$results["movieName"]."<br>"."<br>"; ?></b></div>
                        <div align="left" id="tb-name"><b>Summary: </b><?php echo "".$results["description"]."<br>"."<br>"; ?></div>
                        <div align="left" id="tb-name"><b>Release Date: </b><?php echo "".$results["releaseDate"]."<br>"."<br>"; ?></div>
                    </form>
                </div>
            <?php  }
        }
        // If there are no matching rows
        else {
            echo "No results";
        }
    }
    // If query length is less than minimum
    else {
        echo "Please enter a valid string!";
    }
?>
</body>
</html>