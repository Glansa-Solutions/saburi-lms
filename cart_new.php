<?php
include("includes/header.php");

if (isset($_SESSION['role_id'])) {
    $role_id = $_SESSION['role_id'];
	$role = $_SESSION['role'];
}
?>
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
                            <img class="search-close" src="assets/images/close.png"
                                srcset="assets/images/close%402x.png 2x" alt="">
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
                    <h1>Cart</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Cart
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
        <div class="container sm-center">
            <div class="row">
                <div class="col-lg-8">
                    <article id="post-6" class="post-6 page type-page status-publish hentry">
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper">
                                    <div class="container">
                                        <div class="container-fluid bg-light py-2">
                                            <!-- <h3>Cart</h3> -->
                                            <div class="group_of_cart">
                                                <div class="conainter">
                                                    <div class="col-lg-12 d-flex">
                                                        <div class="col-md-4 justify-content-center align-items-center">
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="woocommerce-cart-form" action="" method="">
                                            <table
                                                class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>

                                                        <th class="product-name">Course</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product-quantity">Quantity</th>
                                                        <th class="product-subtotal">Total</th>
                                                        <th class="product-subtotal">Action</th>
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody class="tableBody">
                                                    
                                                    


                                                </tbody>

                                            </table>
                                        </form>
                                    </div>

                                </div>
                            </div><!-- .entry-content -->
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="cart-collaterals">
                        <div class="cart_totals">
                            <h2>Cart totals</h2>
                            <table cellspacing="0" class="shop_table shop_table_responsive">
                                <tbody>
                                    <!-- <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol">$</span>
                                                <span id="total-price-subtotal">0.00</span> 
                                            </span>
                                        </td>
                                    </tr> -->
                                    <tr class="order-total">
                                        <th>Grand Total</th>
                                        <td data-title="Grand Total">
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">₹</span>
                                                    <span id="grand-total">0.00</span>
                                                </span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if (isset($_SESSION['role_id'])) { ?>
                            <div class="wc-proceed-to-checkout">
                                <a href="<?= $mainlink ?>checkouts" class="checkout-button button alt wc-forward">
                                    Proceed to checkout
                                </a>
                            </div>
                            <?php
                            } else { ?>
                            <div class="wc-proceed-to-checkout">
                                <a href="<?= $mainlink ?>log_reg" class="checkout-button button alt wc-forward">
                                    Proceed to checkout
                                </a>
                            </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    




</script>

<?php
include("includes/footer.php");
?>