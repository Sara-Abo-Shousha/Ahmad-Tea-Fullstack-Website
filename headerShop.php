<?php if(!isset($_SESSION))include("session.php");
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Shop</title>
      <!--Boostrap CDN-->
      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- Owl-carousel CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

      <!--Font Awsome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />



      <!--Css -->
      <link rel="stylesheet" href="./style/shop2.css" type="text/css" >
      <link rel="stylesheet" href="./style/slider.css" type="text/css" >

      <?php
        require './Database/functions.php'
      ?>
    </head>
<body>

<header id="header" class="m-auto">
  
<!--Navgation-->
  <nav class="navbar navbar-expand-lg navbar-light white mt-3">
    <a href="index.php"><img src="resources/img/ahmadtea-logo.png" alt="ahmad-logo" style="width:125px;	height:67;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav color-secondary m-auto futura_meduim text-center" style="font-size: 20px;">
        
          <li class="nav-item  ">
            <a class="nav-link color-secondary" href="WhoWeAre.php">Who We Are <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item  ">
            <a class="nav-link color-secondary" href="ContactUS.php">Contact Us <span class="sr-only">(current)</span></a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link color-secondary" href="shop.php">Shop</a>
          </li>
            <?php
              if(isset($_SESSION['Password'])){
                echo   '<li class="nav-item"> <a class="nav-link color-secondary" href="account.php">Account</a>
                        </li>
                        </ul>';
              
              }
              else{ 
                echo   '<li class="nav-item"> <a class="nav-link color-secondary" href="sign.php">Sign</a>
                </li> </ul>';
              }
            ?>
        <form action="#">
              <a href="cart.php" class="py-2 rounded-pill dark-shade ">
                  <span class="px-1 text-white"><i class="fas fa-shopping-cart"></i></span>
                  <span class="px-4 py-2 rounded-pill text-dark bg-light"><?php echo count($prdct->getdata('cart'));?></span>
              </a>

        </form>
      </div>
  </nav>

  <!--navigation ends-->
</br>
</br>
<div class="header2"></div> 
</header> 

