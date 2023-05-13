<?php
    if(!isset($_SESSION))include("session.php");
  
    shuffle($prdcts_shuffle);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (!isset($_POST['products1_submit'])){
        // call method addToCart
        $cart->addToCart( $_POST['uid'], $_POST['item_id']);
    
  }
}
?>
<section id="top-sale">
      <div class="container futura_meduim py-5">
        <h4 class="futura_meduim">Best Selling Teas</h4>
      <hr>
      <!--Crousel OWL-->
      <div class="owl-carousel owl theme">
      <?php 
            foreach($prdcts_shuffle as $item){
      ?>
        <div class="item py-2">
          <div class="product">
            <a href="<?php printf('%s?item_id=%s','Product_Details.php',$item['Product_ID'])?>"><img src="<?php 
                        $images = scandir($item["image_file"]);
            
                        foreach ($images as $pic)
                        {
                            if($pic !== "." && $pic !== "..")
                            {
                              echo $item["image_file"].$pic;
                              break;
                            }
                        }
                        ?>"alt="product1" class="img-fluid poducts"></a>
            <div class="text-center">
              <h6 style="white-space: pre-line"><?php echo $item['Name']?? "Apple and Vanilla Crumble";?></h6>
              
              <div class="price py-2">
                <span>$<?php echo $item['Price']?? "0";?></span>
              </div>
              <form method="POST">
              <input type="hidden" name="item_id" value="<?php echo $item['Product_ID']??'1' ?>">
              <input type="hidden" name="uid" value="1"> 
              <?php
                    if (in_array($item['Product_ID'], $cart->getCartId($prdct->getdata('cart')) ?? [])){
                        echo '<button type="submit" disabled class="btnn btn-background-slide font-size-12">In the Cart</button>';
                    }else{
                        echo '<button type="submit" name="top_sale_submit" class="btnn btn-background-slide font-size-12">Add to Cart</button>';
                    }
                    ?>
              </form>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
</section>
