<?php if(!isset($_SESSION))include("session.php");
    if(isset($_SESSION["Password"])){
?>
<link rel="stylesheet" type="text/css" href="css/top.css">

<div id="Header">
	<div> 
	<a href="index.php"><img src="img/ahmadtea-logo.png" alt="logo" class="logo"></a> <!--The logo in the header-->
	</div>
		<div id="float"> <!--This div is for the webpages. Each webpage is linked to its own link-->
			<a href="WhoWeAre.php" class="menubt">Who We Are</a> <!--When i click on WHO WE ARE in the header it will take me to this link-->
			<a href="ContactUS.php" class="menubt">Contact Us</a>
			<a href="Shop.php" class="menubt" id="shopbt">Shop</a>
			<a href="account.php" class="menubt">Account</a>
		</div>
</div>
<?php }else{ ?>
	<link rel="stylesheet" type="text/css" href="css/top.css">
    <div id="Header">
	<div> 
	<a href="index.php"><img src="img/ahmadtea-logo.png" alt="logo" class="logo"></a> <!--The logo in the header-->
	</div>
		<div id="float"> <!--This div is for the webpages. Each webpage is linked to its own link-->
			<a href="WhoWeAre.php" class="menubt">Who We Are</a> <!--When i click on WHO WE ARE in the header it will take me to this link-->
			<a href="ContactUS.php" class="menubt">Contact Us</a>
			<a href="Shop.php" class="menubt" id="shopbt">Shop</a>
			<a href="Sign.php" class="menubt">Sign</a>
		</div>
</div>

<?php } ?>