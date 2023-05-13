
    <!--Header-->
    <?php
    ob_start();


    ?>
    <!--Products-->
    <?php
      include 'headerShop.php';
      include './Templatephp/_Products.php'
    ?>
      <!--Products-ends-->
    <!--Top-Sale-->
    <?php
       include './Templatephp/_NewComers.php';
    ?>
    <!--Top-Sale-ends-->
 <?php
      include 'footerShop.php'
      ?>

