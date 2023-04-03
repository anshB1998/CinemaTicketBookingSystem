<?php 
$db = mysqli_connect('localhost', 'root', '', 'movie_booking'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
 <section>
    <div class="image featured">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 850px; height: 360px; margin: 0 auto">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <a href="movie_info.php?parameter=<?php echo "Black Panther: Wakanda Forever"; ?>">
                        <img src="images/bp-carousel.png" alt="Black Panther: Wakanda Forever">
                    </a>
                    <div class="carousel-caption">
						<h2></h2>
					</div>
                </div>
                <div class="item">
                    <a href="movie_info.php?parameter=<?php echo "Black Adam"; ?>">
                    <img src="images/ba-carousel.jpg" alt="Black Adam" style="height: 360px; width: 850px;">
                    </a>
                    <div class="carousel-caption">
						<h2></h2>
					</div>
                </div>
                <div class="item">
                    <a href="movie_info.php?parameter=<?php echo "Ant Man and the Wasp: Quantamania"; ?>">
                    <img src="images/ant-carousel.jpeg" alt="Ant Man and the Wasp: Quantamania" style="height: 360px; width: 850px;">
                    </a>
                   	<div class="carousel-caption">
						<h2></h2>
					</div>
                </div>
                <div class="item">
                    <a href="movie_info.php?parameter=<?php echo "Avatar: The Way of Water"; ?>">
                    <img src="images/avatar-2-carousel.jpg" alt="Avatar: The Way of Water" style="height: 360px; width: 850px;">
                    </a>
                    <div class="carousel-caption">
                        <h2></h2>
                    </div>
                </div>
                <div>
                    <!-- LEFT AND RIGHT CONTROLS -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>