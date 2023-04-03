<?php 
$db = mysqli_connect('localhost', 'root', '', 'movie_booking');
$movies = "SELECT * FROM movie ORDER BY releaseDate DESC LIMIT 30";
$result = mysqli_query($db, $movies);

// Showing latest 30 movies
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
    width: 45%;
    margin-bottom: 30px;
    margin-left: 5% !important;
    float: left !important;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container {
    padding: 2px 16px;
    margin-left: 5px;
  }

  button[name = info_btn] {
    padding: 2px 16px;
    margin-left: 20px;
    margin-bottom: 10px;
  }
</style>
</head>
<body>

<h2 align="center"><b>UPCOMING MOVIES</b></h2>
<?php for($i = 0; $i<$count; $i++): ?>
  <div class="card">
    <table>
      <tr>
      <th></th>
      <th></th>
      </tr>
      <tr>
      	<?php $row = $result->fetch_assoc(); ?>
        <td>
          <img src="<?php echo $row["poster"];?>" alt="Poster Not Available" style="height: 50%">
        </td>
        <td>
        <div >
          <?php if ($result->num_rows > 0) {
            echo '<p><b>', "".$row["movieName"]."<br>", '</b></p>', "Release Date: ".$row["releaseDate"]."<br>"."<br>";
            $name = $row["movieName"];
          } ?> 
        </div>
      <div class="input-group">
        <a href="movie_info.php?parameter=<?php echo $name; ?>"  >
          <button type="submit" class="btn" name="info_btn">Know More</button>
        </a>
      </div></td>
      </tr>
    </table>
  </div>
<?php endfor ?>
</body>
</html> 