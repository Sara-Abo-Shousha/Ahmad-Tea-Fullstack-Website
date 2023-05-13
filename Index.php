<!DOCTYPE html>
<html>
<head>
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
	<title>Welcome to Ahmad Tea</title>
	<link rel="stylesheet" href="css/index-style.css">
	<script src="javascript/index_script.js"></script>
	<link rel="icon" href="img/logo.jpg"> <!--This logo will appear in the tab beside the title-->
</head>
<body>
<?php include("top.php"); ?>
<div class="body" style="padding-top:200px"> <!--First main block-->
	<h3>Welcome to Ahmad Tea</h6>
	<h1>Learn all about us by clicking the button</h1>
<form action="WhoWeAre.html"><button class="button"> About us! </button></form>
</div>

<div class="body"> <!--second block-->
		<h3>Here is a taste of some of our products!</h3>
	<div id="products">
		<img src="img/products/p1.png" class="product">
		<img src="img/products/p2.png" class="product">
		<img src="img/products/p3.png" class="product">
	</div>
		<h3>Find more in the shop</h3>
	<form action="Shop.html">
		<button class="button">Search Here</button>
	</form>
</div>

<div class="body">
		<h2> Early in the life of Ahmad Tea, our Chairman, Mr Rahim Afshar, promised, “I will not sell anything that I would not drink at home.” </h2>
</div>

<div class="body">
		<h3> Learn how to make a proper tea with us!</h3>
		<iframe width="960" height="540" src="https://www.youtube.com/embed/AzqW965Dz64" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<?php include("end.php"); ?>
				  </body>
				  </html>
