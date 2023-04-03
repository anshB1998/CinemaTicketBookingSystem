<?php include('functions.php'); ?>
<!DOCTYPE  html>
<html>
<head>
    <title>Movies</title>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <link rel="stylesheet" type="text/css" href="cstyle.css"/><link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="nav.css">
  <link rel="stylesheet" type="text/css" href="cstyle.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php include('nav2.php') ?>
    <style type="text/css">
        .content {
            width: 70%;
            height: 90%;
            margin: 0px auto;
            padding: 35px;
            border: 1px solid #B0C4DE;
            background: white;
        }
    </style>
</head>
<body>
    <?php
    $get = $_GET["parameter"];
    if($get) {
        $query = "SELECT movieId, movieName, description, releaseDate, poster FROM movie WHERE movieName='$get'";
        $result = mysqli_query($db, $query);
        $row = $result->fetch_assoc();
        $x = (string) $row["movieId"];
        $q = "SELECT m.movieName, s.showId, s.showTiming, s.screen, COUNT(seat.seatId) as Availability FROM movie m JOIN shows s USING(movieId) JOIN seat USING(showId) WHERE seat.availability = 1 AND movieName='$get' GROUP BY m.movieName, s.showTiming, s.screen";
        $r = mysqli_query($db, $q); 
    } ?>    
            <div class="content">
            <div align="left" id="tb-name"><p><img src="<?php echo $row["poster"];?>" style="height: 70%"></p></div>
            <div align="left" id="tb-name"><b><?php echo "".$row["movieName"]. "<br>" ."<br>"; ?></b></div>
            <div align="left" id="tb-name"><b>Summary: </b><?php echo "".$row["description"]."<br>"."<br>"; ?></div>
            <div align="left" id="tb-name"><b>Release Date: </b><?php echo "".$row["releaseDate"]."<br>"."<br>"; ?></div>
            <div><b>Show Times: </b><br>
                <?php while($row1 = $r->fetch_assoc()) :?>
                <?php echo "".$row1["showTiming"]."";
                    $date = $row1["screen"];
                    $sid = $row1['showId'];
                    $time = $row1["showTiming"];
                    $p = $x.'|'.$date.'|'.$time. '|'.$sid;
                ?>
                <a href = "seat.php?parameter= <?php echo $p; ?>" >
                <button type ="submit" class="btn" name="time_btn" style="margin-left:5%"><?php echo "Book (".$row1["Availability"]." Seats Available)" ;?></button><br><br>
                </a>
                <?php endwhile; ?> 
            </div>
            </div>
</body>
</html>
