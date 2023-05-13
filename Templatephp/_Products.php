<?php 
    $item_id=$_GET['item_id']??1;
    foreach($prdct->getdata() as $item):
     if($item['Product_ID']==$item_id):
       
    if(!isset($_SESSION))include("session.php");
  
    shuffle($prdcts_shuffle);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (!isset($_POST['products1_submit'])){
        // call method addToCart
        $cart->addToCart( $_POST['uid'], $_POST['item_id']);
    
  }
}
?>

<!--Product-->
    <div id="product"class="py-3">
        <div class="container ">
        <div class="row">
            <div class="col-sm-5">
            <img src="<?php 
                        $images = scandir($item["image_file"]);
            
                        foreach ($images as $pic)
                        {
                            if($pic !== "." && $pic !== "..")
                            {
                              echo $item["image_file"].$pic;
                              break;
                            }
                        }
                        ?>" class="img-fluid">
            <div class="form-row pt-4" style="margin-left:100px">
                    <form method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $item['Product_ID']??'1' ?>">
                    <input type="hidden" name="uid" value="1"> 
                    <?php
                            if (in_array($item['Product_ID'], $cart->getCartId($prdct->getdata('cart')) ?? [])){
                                echo '<button type="submit" disabled  style="width:256px;"class="btnn btn-background-slide font-size-12">In the Cart</button>';
                            }else{
                                echo '<button type="submit" name="top_sale_submit" style="width:256px" class="my-5 btnn btn-background-slide font-size-12">Add to Cart</button>';
                            }
                            ?>
                    </form>
            </div> 
            </div>
                <div class="col-sm-6 py-5">
                <h3 class="futura_meduim" style="font-style:italic"><?php echo $item['Name']?? "Apple and Vanilla Crumble";?></h3><span>                <small style="font-style:italic">Product no #<?php echo $item['Product_ID']?? 1;?></small></br>
</span>
                <span class="futura_meduim" style="font-style:italic; font-size:25px;"> Price €<?php echo $item['Price']?? "0";?></span>

                <hr class=>
                <table class=>
                    <tr>
                     
                        
                    </tr>
                    <tr>
                        
                        <div class="col-6">
                          <!--  <div class="qty d-flex">
                            <h6 class="px-5">Quantity</h6>
                        <button class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                            <input type="text" class="qty_input text-center border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                            <button class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                        </div>-->
                        
                    </tr>
                    <tr>
                    </br>
                    <h3 class="futura_regular">Product Description</h3>
                    <p style="white-space: pre-line" class="futura_meduim"><?php echo $item['Description']??"No Description Available";?></p>
                    </tr>
                 </table>
                 </div>
              
                <hr>

        </div>
        </div>
    </div>
<!--!Product-->
<?php
  endif;
 endforeach;
?>