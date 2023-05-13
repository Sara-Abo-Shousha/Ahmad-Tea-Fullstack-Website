<?php
  $prdcts_shuffle=$prdct->getdata();
?>
<section id="new-comers">
      <div class="container fixed py-5 futura_meduim">
        <h4 class="">Check The New Sping Collection !</h4>
      <hr>
      <!--Crousel OWL-->
      <div class="owl-carousel owl theme">
      <?php 
            foreach($prdcts_shuffle as $item){
      ?>
        <div class="item py-2">
          <div class="product">
            <a href="<?php printf('%s?item_id=%s','Product_Details.php',$item['prdct_id'])?>"><img src="<?php 
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
              <div class="rating text-warning">
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
                <span><i class="fas fa-star"></i></span>
              </div>
              <div class="price py-2">
                <span>$<?php echo $item['Price']?? "0";?></span>
              </div>
              <button type="submit" class="btnn btn-background-slide">Add to Cart</button>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
</section>
