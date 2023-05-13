<?php
  $prdcts_shuffle=$prdct->getdata();

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['products2_submit'])){
        // call method addToCart
        $cart->addToCart($_POST['uid'], $_POST['item_id']);
    
  }
}
?>
<section id="special-price">
        <div class="container futura_meduim" py-5">
          <div id="filter" class="btn-group float-right"  role="group" text-right">
            
            <button class="btn is-checked" data-filter="*">All </button>
            <button class="btn" data-filter=".Black">Black Teas</button>
            <button class="btn" data-filter=".Green">Green Teas</button>
            <button class="btn" data-filter=".Fruit">Fruit Blends</button>
            <button class="btn" data-filter=".Various">Various</button>
          </div>
          <h4>All products</h4>
          <div class="grid">
              <?php array_map(function($item){?>
          <div class="grid-item  border <?php echo $item['Category'] ?? "Tea"?>">
                  <div class="item py-2" style="width:200px">
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
                          <h6><?php echo $item['Name']?? "Apple and Vanilla Crumble";?></h6>
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
                          <form method="POST">
                            <input type="hidden" name="item_id" value="<?php echo $item['Product_ID']??'1' ?>">
                            <button type="submit" value="products2_submit"class="btnn btn-background-slide">Add to Cart</button>
                            </form>
                        </div>
                      </div>
                    </div>
                    </div>
          <?php },$prdcts_shuffle)?>
          </div>

          </div>
        </div>
</section>

