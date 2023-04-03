<?php 
  $db = mysqli_connect('localhost', 'root', '', 'movie_booking');
  $movies = "SELECT m.movieName as TopTrendingMovies
  FROM movie m JOIN shows s USING(movieId) JOIN booking b USING(showId)
  GROUP BY m.movieName
  ORDER BY SUM(b.bookingId) DESC
  LIMIT 15";

  $result = mysqli_query($db, $movies);
  $count = 30;
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        margin-bottom: 30px;
        margin-left: 30%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
        margin-left: 5px;
    }
    .TopTrendingContainer{
      width:100%;
    }

    button[name=info_btn] {
          padding: 2px 16px;
          margin-left: 20px;
          margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h3 align="center"><b>TOP TRENDING MOVIES</b></h3>
  <div class="TopTrendingContainer">
    <table class="table">
      <tbody>
        <?php for($i = 1; $i<=15; $i++) : ?> 
          <tr>
            <?php $row = $result->fetch_assoc(); ?>
                <?php if ($result->num_rows > 0) {
                  echo '<td>', $row["TopTrendingMovies"]."</td>";
                  $name = $row["TopTrendingMovies"];
                } ?> 
                <td>
                <!-- movie_info.php?parameter=<?php echo $name; ?> -->
                  <a href="movie_info.php?parameter=<?php echo $name; ?>"  >
                    <button type="submit" class="btn" name="info-btn-trend" style="margin-right:1%;">
                      Know More 
                    </button>
                  </a>
                </td>
          </tr>
        <?php endfor ?>
      </tbody>
    </table>
  </div>
</body>
</html>