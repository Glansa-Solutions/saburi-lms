<?php
include("includes/header.php");
?>

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
                                            Have a coupon? <a href="#" name="couponcode" class="showcoupon">Click here
                                                to enter your code</a>
                                        </div>
                                    </div>

                                    <form class="checkout_coupon woocommerce-form-coupon"
                                        action="core/checkoutFunction.php" method="post">

                                        <p>If you have a coupon code, please apply it below.</p>

                                        <p class="form-row form-row-first">
                                            <input type="text" name="couponcode" class="input-text"
                                                placeholder="Coupon code" id="coupon_code" value="">
                                        </p>

                                        <p class="form-row form-row-last">
                                            <button type="submit" class="button" name="apply_coupon"
                                                value="Apply coupon">Apply coupon</button>
                                        </p>

                                        <div class="clear"></div>
                                    </form>
                                    <div class="woocommerce-notices-wrapper"></div>
                                    <form name="checkout" method="post" class="checkout woocommerce-checkout row"
                                        action="core/checkoutFunction.php" enctype="multipart/form-data"
                                        novalidate="novalidate">
                                        <input type="hidden" name="courseIds" id="courseIds" value="">



                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                            <h3 id="order_review_heading">Your order</h3>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Product</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart-details">
                                                    <!-- This is where cart details will be inserted dynamically -->
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="woocommerce-Price-amount amount"><span
                                                                    class="woocommerce-Price-currencySymbol">&#8377;
                                                                </span><span id="cart-subtotal">0.00</span></span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td><strong><span class="woocommerce-Price-amount amount"><span
                                                                        class="woocommerce-Price-currencySymbol">&#8377;
                                                                    </span><span
                                                                        id="cart-total" name="cart_total">0.00</span></span></strong></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div id="payment" class="woocommerce-checkout-payment">
                                                <ul class="wc_payment_methods payment_methods methods">
                                                    <li class="wc_payment_method payment_method_cod">
                                                        <input id="payment_method_cod" type="radio" class="input-radio"
                                                            name="payment_method" value="cod" checked="checked"
                                                            data-order_button_text="" style="display: none;">

                                                        <label for="payment_method_cod">
                                                            Cash on delivery </label>
                                                        <div class="payment_box payment_method_cod">
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="form-row place-order">
                                                    <noscript>
                                                        Since your browser does not support JavaScript, or it is
                                                        disabled, please ensure you click the <em>Update Totals</em>
                                                        button before placing your order. You may be charged more than
                                                        the amount stated above if you fail to do so. <br>
                                                        <button type="submit" class="button alt"
                                                            name="woocommerce_checkout_update_totals"
                                                            value="Update totals">Update totals</button>
                                                    </noscript>

                                                    <div class="woocommerce-terms-and-conditions-wrapper">
                                                        <div class="woocommerce-privacy-policy-text">
                                                            <p>Your personal data will be used to process your order,
                                                                support your experience throughout this website, and for
                                                                other purposes described in our <a href="#"
                                                                    class="woocommerce-privacy-policy-link"
                                                                    target="_blank">privacy policy</a>.</p>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="button alt"
                                                        name="woocommerce_checkout_place_order" id="place_order"
                                                        value="Place order" data-value="Place order">Place
                                                        order</button>
                                                        <input type="hidden" name="cart" id="cart" value=""> <!-- Leave the value empty in the HTML -->

                                                    <input type="hidden" id="woocommerce-process-checkout-nonce"
                                                        name="insert_place_order" value="c75f934b1d"><input
                                                        type="hidden" name="_wp_http_referer"
                                                        value="/?wc-ajax=update_order_review">
                                                </div>
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

<script>
// document.addEventListener("DOMContentLoaded", function() {
//     // Retrieve cart data from localStorage
//     var cart = JSON.parse(localStorage.getItem('cart')) || [];

//     // Reference to the cart details table body and subtotal/total elements
//     var cartDetailsBody = document.getElementById('cart-details');
//     var cartSubtotal = document.getElementById('cart-subtotal');
//     var cartTotal = document.getElementById('cart-total');

//     var subtotal = 0;

//     // Iterate through the cart items and populate the cart details table
//     cart.forEach(function(item) {
//         var row = document.createElement('tr');
//         var itemTotal = item.price * item.quantity;
//         subtotal += itemTotal;

//         row.innerHTML = `
//                     <td class="product-name">${item.name}<strong class="product-quantity">× ${item.quantity}</strong></td>
//                     <td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span>${itemTotal.toFixed(2)}</span></td>
//                 `;
//         cartDetailsBody.appendChild(row);
//     });
   
//     // Update subtotal and total dynamically
//     cartSubtotal.textContent = subtotal.toFixed(2);
//     cartTotal.textContent = subtotal.toFixed(2);

//     document.getElementById('cart').value = JSON.stringify(cart);
   

// });
document.addEventListener("DOMContentLoaded", function() {
    // Retrieve cart data from localStorage
    var cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Reference to the cart details table body and subtotal/total elements
    var cartDetailsBody = document.getElementById('cart-details');
    var cartSubtotal = document.getElementById('cart-subtotal');
    var cartTotal = document.getElementById('cart-total');

    var subtotal = 0;

    // Iterate through the cart items and populate the cart details table
    cart.forEach(function(item) {
        var row = document.createElement('tr');
        var itemTotal = item.price * item.quantity;
        subtotal += itemTotal;

        row.innerHTML = `
            <td class="product-name">${item.name}<strong class="product-quantity">× ${item.quantity}</strong></td>
            <td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span>${itemTotal.toFixed(2)}</span></td>
        `;
        cartDetailsBody.appendChild(row);
    });

    // Update subtotal and total dynamically
    cartSubtotal.textContent = subtotal.toFixed(2);
    cartTotal.textContent = subtotal.toFixed(2);

    // Create an array to store courseIds
    var courseIds = [];

    // Iterate through the cart items to extract courseIds
    cart.forEach(function(item) {
        courseIds.push(item.id);
    });

    // Set the 'cart' input field value to the JSON representation of the cart items
    document.getElementById('cart').value = JSON.stringify(cart);

    // Set the 'courseIds' input field value to the JSON representation of courseIds
    document.getElementById('courseIds').value = JSON.stringify(courseIds);
});
</script>





<?php
include("includes/footer.php");
?>