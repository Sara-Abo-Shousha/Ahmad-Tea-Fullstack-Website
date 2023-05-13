<?php
        require 'DBcontrol.php';
        require 'fetchprdcts.php';
        require 'Database/Cart.php';
        $db=new DBControl();
        $prdct=new fetchprdcts($db);
        $cart=new Cart($db);  
        $prdcts_shuffle=$prdct->getdata();
?>
