<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete-cart-submit'])) {
        $deletedrecord = $cart->deleteCart($_POST['item_id']);
    }
}

?>


<!-- Shopping cart section  -->
<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class=" font-size-20">Shopping Cart</h5>

        <!--  shopping cart items   -->
        <div class="row">
            <div class="col-sm-9">
                <?php
                foreach ($prdct->getdata('cart') as $item) :
                    $Cart = $prdct->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item) {

                ?>
                        <div class="row border-top py-3 mt-3">
                            <div class="col-sm-2">
                                <img src="<?php
                                            $images = scandir($item["image_file"]);

                                            foreach ($images as $pic) {
                                                if ($pic !== "." && $pic !== "..") {
                                                    echo $item["image_file"] . $pic;
                                                    break;
                                                }
                                            }
                                            ?>" style="height: 120px;" alt="Cart1" class="img-fluid">
                            </div>
                            <div class="col-sm-8">
                                <h5 class=" font-size-20"><?php $item['Name'] ?? "Peach and Passion Cold Brew Iced Tea" ?></h5>
                                <small><?php echo $item['Name'] ?? "Apple and Vanilla Crumble"; ?></small>


                                <!-- product qty -->
                                <div class="qty d-flex pt-2">
                                <p class = "futura_meduim">Due to the pandemic we cannot ship more than 1 quantity per product</p>

                                    <form method="post">
                                        <input type="hidden" value="<?php echo $item['Product_ID'] ?? 0; ?>" name="item_id">
                                        <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                    </form>
                                </div>
                                <!-- !product qty -->
                            </div>
                            <div class="col-sm-2 text-right">
                                <div class="font-size-20 text-danger ">
                                    $<span class="product_price"><?php echo $item['Price'] ?? "0"; ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- !Cart item -->

                <?php
                        return $item['Price'];
                    }, $Cart);

                endforeach;

                ?>
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal ( <?php echo isset($subTotal) ?
                                                                            count($subTotal) : 0; ?> item):&nbsp; <span class="text-danger">$
                                <span class="text-danger" id="deal-price">
                                    <?php echo isset($subTotal) ? $cart->getSum($subTotal) : 0; ?></span> </span> </h5>
                        <form action="CHECKPOINT.php" method="POST">
                            <button type="submit" name="order-submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
        <!--  !shopping cart items   -->
    </div>
</section>