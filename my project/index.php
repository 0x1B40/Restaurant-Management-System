<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Main Menu</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  	<link href="style.css" rel="stylesheet">
<script src="script.js"></script>

  </head>
  <body >
    <!-- Navigation -->
<?php
require("navigation.php");
?>
    <!-- end of Navigation -->
<div class="background">
<!-- Search Menu -->
<div class=" container-fluid searchMenu ">


  </div>




  <div class="container-fluid padding">
    <div class="row text-center padding">
      <div class="col-12">
        <h2> Welcome to Ali Chain restaurant</h2>
      </br>
      <h2> Our Top Dishes today</h2>
    </div>
  </div>
</div>





<!-- end of Search Menu -->
    <!--      image Slider      -->


<div align='center' class="container-fluid padding ">
    <div id="slides" class="carousel slide col-sm-3 " data-ride="carousel">
    <ul class="carousel-indicators">
    	<li data-target="#slides" data-slide-to="0" class="active"></li>
    	<li data-target="#slides" data-slide-to="1"></li>
    	<li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
    	<div class="carousel-item active">
    		<img src="carouselitem1.jpg">
    		<div class="carousel-caption">
    		<h1 class="display-2"> Dishes of the day</h1>
    		<h3> dishes of the day</h3>

    		</div>
    	 </div>
    	 <div class="carousel-item">
     		<img src="carouselitem2.jpg">

     	 </div>
    	 <div class="carousel-item">
     		<img src="carouselitem3.jpg">
     	 </div>
    </div>
     </div>
   </div>


    <!--   End of Image Slider      -->
    <!--- Fixed background -->
  <!--  <figure>
      <div class="fixed-wrap">
        <div id="fixed">
        </div>
      </div>
    </figure>-->
  <!--- Fixed background -->
    <!--- Jumbotron -->

<!--

    <div class="container-fluid">
    	<div class="row jumbotron jumbotron-fluid" id="jumbotron">
    		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
    			<p class="lead"> this website collections your information, please confirm that you accept our policy</p>
    		</div>
    		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xs-2">
    			<a href="#"> <button type="button" class="btn btn-outline-secondary btn-lg" id="cookie"> accept</button>
    			</a>
    	</div>
    </div>
  </div> -->
    <!-- end of jumbotron-->










    <!--- social media -->

    <div class="container-fluid padding">
    	<div class="row text-center padding">
    		<div class="col-12">
    			<h2> connect on social media</h2>
    	</div>
    	<div class="col-12 social padding">
    		<a href=""><i class="fab fa-facebook"></i></a>
    			<a href="#"><i class="fab fa-twitter"></i></a>
    				<a href="#"><i class="fab fa-google-plus-g"></i></a>
    					<a href="#"><i class="fab fa-instagram"></i></a>
    						<a href="#"><i class="fab fa-youtube"></i></a>
    </div>
  </div>
</div>
    <!-- end of social media-->
</div>
    <!--- Footer -->

<?php
require("footer.php");

?>
    <!-- end of footer-->

<!-- javascript code -->
<script src="script.js"></script>
<!-- End of javascript code -->




  </body>
</html>
