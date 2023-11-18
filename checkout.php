

<?php

?>
<!-- Additional checkout form content here -->

 <!--search overlay start-->
 <div class="search-wrap">
    <div class="overlay">
        <form action="" class="search-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-9">
                        <h3>Search Your keyword</h3>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <div class="col-md-2 col-3 text-right">
                        <div class="search_toggle toggle-wrap d-inline-block">
                            <img class="search-close" src="assets/images/close.png" srcset="assets/images/close%402x.png 2x" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--search overlay end-->


<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1>Checkout</h1>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a href="#">Home</a>
              </li>
              <li class="list-inline-item">/</li>
              <li class="list-inline-item">
                  Checkout
              </li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</section>

    <main class="site-main woocommerce single single-product page-wrapper">
        <!--shop category start-->
        <section class="space-3">
            <div class="container">
                <div class="row">
                    <section id="primary" class="content-area col-lg-12">
                        <main id="main" class="site-main" role="main">
                            <article id="post-8" class="post-8 page type-page status-publish hentry">
                                <div class="entry-content">
                                    <div class="woocommerce">
                                        <div class="woocommerce-notices-wrapper"></div>
                                        <div class="woocommerce-form-coupon-toggle">
                                        <div class="woocommerce-info">
                                            Have a coupon? <a href="#" class="showcoupon">Click here to enter your code</a>
                                        </div>
                                    </div>

                                        <form class="checkout_coupon woocommerce-form-coupon" method="post">

                                            <p>If you have a coupon code, please apply it below.</p>

                                            <p class="form-row form-row-first">
                                                <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value="">
                                            </p>

                                            <p class="form-row form-row-last">
                                                <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
                                            </p>

                                            <div class="clear"></div>
                                        </form>
                                        <div class="woocommerce-notices-wrapper"></div>
                                        <form name="checkout" method="post" class="checkout woocommerce-checkout row" action="#" enctype="multipart/form-data" novalidate="novalidate">
                                           

                                            <!-- <div class="col-md-5"> -->
                                                <div id="order_review" class="woocommerce-checkout-review-order">
                                                    <h3 id="order_review_heading">Your order</h3>
                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                        <thead>
                                                        <tr>
                                                            <th class="product-name">Product</th>
                                                            <th class="product-total">Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $totalPrice = 0; // Initialize the total price variable
                                                        foreach ($cartItems as $item) {
                                                            $itemName = $item['name'];
                                                            $itemPrice = $item['price'];

                                                            // Calculate the total price for this item
                                                            $itemTotal = $itemPrice;

                                                            // Add the item total to the overall total
                                                            $totalPrice += $itemTotal;
                                                        ?>
                                                        <tr class="cart_item">
                                                                <td class="product-name">
                                                                    <?php echo $itemName; ?>
                                                                    <!-- <strong class="product-quantity">× <?php echo $itemQuantity; ?></strong> -->
                                                                </td>
                                                                <td class="product-total">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">&nbsp;&#8377; </span>
                                                                        <?php echo $itemPrice; ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                        <tfoot>

                                                        <!-- <tr class="cart-subtotal">
                                                            <th>Subtotal</th>
                                                            <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&nbsp;</span>54.00</span></td>
                                                        </tr> -->

                                                        <tr class="order-total">
                                                            <th>Total</th>
                                                            <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&nbsp;</span>&#8377; <?php echo $totalPrice; ?></span></strong> </td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>

                                                    <div id="payment" class="woocommerce-checkout-payment">
                                                        <ul class="wc_payment_methods payment_methods methods">
                                                            <li class="wc_payment_method payment_method_cod">
                                                                <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked="checked" data-order_button_text="" style="display: none;">

                                                                <label for="payment_method_cod">
                                                                    Cash on delivery 	</label>
                                                                <div class="payment_box payment_method_cod">
                                                                    <p>Pay with cash upon delivery.</p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="form-row place-order">
                                                            <noscript>
                                                                Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.			<br>
                                                                <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                                            </noscript>

                                                            <div class="woocommerce-terms-and-conditions-wrapper">
                                                                <div class="woocommerce-privacy-policy-text"><p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.</p>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>
                                                            <input type="hidden" id="woocommerce-process-checkout-nonce" name="woocommerce-process-checkout-nonce" value="c75f934b1d"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">	</div>
                                                    </div>

                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div><!-- .entry-content -->

                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </section>
                </div>
            </div>
        </section>
        <!--shop category end-->
    </main>

   

    

<?php
include("includes/footer.php");
?>