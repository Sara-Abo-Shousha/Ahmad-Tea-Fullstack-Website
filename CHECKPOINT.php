<?php
 include ('headerShop.php');

if (isset($_SESSION['Password'])) {

    ?>
    <section>
    <div style="margin-left:600px; margin-bottom:45px;">
    <div class="col-sm-3">
    <img src="./resources/img/Check.png" >
    
    </div>
  
    </div>
    <h3 class="text-center futura_meduim">Your Order has replaced<br>
    it will take 3-4 business days to arrive
    </h3>
    </section>
    <?php
    session_destroy();
} else {?>
    <section>
    <div style="margin-left:600px; margin-bottom:45px;">
    <div class="col-sm-3">
    <img src="./resources/img/uncheck.png" >
    
    </div>
  
    </div>
    <h3 class="text-center futura_meduim">Please Login or Creat an Account</br>
     to place your order
    </h3>
    </section>
    <?php
}
?>