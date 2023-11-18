<?php
include("includes/header.php");
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
                                <div class="woocommerce-notices-wrapper"></div>
                                <form class="woocommerce-cart-form" action="" method="">
                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                        cellspacing="0">
                                        <thead>
                                            <tr>

                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-subtotal">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Place this script within your HTML file -->
                                            <script>
                                            // Retrieve cart data from localStorage
                                            var cart = JSON.parse(localStorage.getItem('cart')) || [];

                                            // Reference to the cart table body
                                            var tableBody = document.querySelector(
                                                '.woocommerce-cart-form__contents tbody');

                                            // Initialize the total price
                                            var totalPrice = 0;

                                            // Loop through the cart items and display them in the table
                                            cart.forEach(function(course) {
                                                // Create a new row for the item
                                                var row = document.createElement('tr');
                                                row.className = 'woocommerce-cart-form__cart-item cart_item';

                                                // Column 1: Product Name
                                                var column1 = document.createElement('td');
                                                column1.className = 'product-name';
                                                var productNameLink = document.createElement('a');
                                                productNameLink.href = '#';
                                                productNameLink.textContent = course.name;
                                                column1.appendChild(productNameLink);
                                                row.appendChild(column1);

                                                // Column 2: Price
                                                var column2 = document.createElement('td');
                                                column2.className = 'product-price';
                                                var priceSpan = document.createElement('span');
                                                priceSpan.className = 'woocommerce-Price-amount amount';
                                                var priceCurrencySymbol = document.createElement('span');
                                                priceCurrencySymbol.className =
                                                    'woocommerce-Price-currencySymbol';
                                                priceCurrencySymbol.innerHTML = '&#8377;';
                                                var priceAmount = document.createElement('span');
                                                priceAmount.textContent = course.price;
                                                priceSpan.appendChild(priceCurrencySymbol);
                                                priceSpan.appendChild(priceAmount);
                                                column2.appendChild(priceSpan);
                                                row.appendChild(column2);

                                                // Column 3: Quantity
                                                var column3 = document.createElement('td');
                                                column3.className = 'product-quantity';
                                                var quantityInput = document.createElement('input');
                                                quantityInput.type = 'number';
                                                quantityInput.value = 1; // Set the quantity input to 1
                                                quantityInput.addEventListener('input', function() {
                                                    // Update the quantity when the input changes
                                                    course.quantity = parseInt(quantityInput.value, 10);
                                                    updateCart(cart);

                                                    // Calculate the updated itemTotal based on the updated quantity
                                                    var updatedItemTotal = course.price * course.quantity;

                                                    // Update the totalAmount span to display the new itemTotal
                                                    totalAmount.textContent = updatedItemTotal.toFixed(2);

                                                    updateTotals(cart);
                                                });
                                                column3.appendChild(quantityInput);
                                                row.appendChild(column3);

                                                // Column 4: Total
                                                var column4 = document.createElement('td');
                                                column4.className = 'product-subtotal';
                                                var totalSpan = document.createElement('span');
                                                totalSpan.className = 'woocommerce-Price-amount amount';
                                                var totalCurrencySymbol = document.createElement('span');
                                                totalCurrencySymbol.className =
                                                    'woocommerce-Price-currencySymbol';
                                                priceCurrencySymbol.innerHTML = '&#8377;';
                                                var totalAmount = document.createElement('span');
                                                var itemTotal = course.price * course.quantity;
                                                totalAmount.textContent = itemTotal.toFixed(2);
                                                totalSpan.appendChild(totalCurrencySymbol);
                                                totalSpan.appendChild(totalAmount);
                                                column4.appendChild(totalSpan);
                                                row.appendChild(column4);

                                                // 

                                                // Column 5: Remove
                                                var column5 = document.createElement('td');
                                                column5.className = 'product-remove';
                                                var removeLink = document.createElement('a');
                                                removeLink.href = '#';
                                                removeLink.className = 'remove';
                                                removeLink.setAttribute('aria-label', 'Remove this item');
                                                removeLink.setAttribute('data-product_id', course.id);
                                                removeLink.setAttribute('data-product_sku', '');
                                                removeLink.textContent = '×';

                                                // Add a click event listener to the remove link
                                                removeLink.addEventListener('click', function() {
                                                    // Remove the item from the cart
                                                    var index = cart.findIndex(function(cartItem) {
                                                        return cartItem.id === course.id;
                                                    });
                                                    if (index !== -1) {
                                                        cart.splice(index, 1);
                                                        updateCart(cart);
                                                        updateTotals(cart);
                                                        // Remove the row from the table
                                                        tableBody.removeChild(row);
                                                    }
                                                });

                                                column5.appendChild(removeLink);
                                                row.appendChild(column5);

                                                // Add the row to the table body
                                                tableBody.appendChild(row);

                                                // Calculate item total and add it to the totalPrice
                                                totalPrice += itemTotal;
                                            });

                                            // Calculate the total of all item totals
                                        
                                            var totalItemCount = cart.reduce(function(total, course) {
                                                return total + course.price * course.quantity;
                                            }, 0);

                                            // Function to update the cart data in localStorage
                                            function updateCart(cartData) {
                                                localStorage.setItem('cart', JSON.stringify(cartData));
                                            }

                                            // Function to update the cart totals
                                            function updateTotals(cartData) {
                                                // Calculate the total quantity and price
                                                var totalQuantity = cartData.reduce(function(total, course) {
                                                    return total + course.quantity;
                                                }, 0);

                                                // Update the DOM with the new totals
                                                document.getElementById('total-quantity').textContent = totalQuantity;
                                                document.getElementById('total-price').textContent = totalPrice.toFixed(
                                                    2);
                                                // document.getElementById('total-price-subtotal').textContent = totalPrice.toFixed(2);
                                                document.getElementById('total-count').textContent = totalItemCount
                                                    .toFixed(2); // Update Total Count
                                            }

                                            // Initialize the cart totals when the page loads
                                            updateTotals(cart);
                                            </script>

                                        </tbody>

                                    </table>
                                </form>
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
                            <div class="wc-proceed-to-checkout">
                                <a href="checkouts.php" class="checkout-button button alt wc-forward">
                                    Proceed to checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Update the DOM with the new totals
// document.getElementById('total-quantity').textContent = totalQuantity; // Update total quantity

// Function to update the cart totals
// Function to update the cart totals
// Function to update the cart totals
// function updateTotals(cartData) {
//     // Calculate the total quantity and price
//     var totalQuantity = 0;
//     var totalPrice = 0;

//     cartData.forEach(function(course) {
//         totalQuantity += course.quantity;
//         totalPrice += course.price * course.quantity;
//     });

//     var totalPriceFormatted = totalPrice.toFixed(2);

//     // Update the DOM with the new totals
//     document.getElementById('total-quantity').textContent = totalQuantity; // Update total quantity
//     document.getElementById('total-price').textContent = totalPriceFormatted; // Update total price
//     document.getElementById('total-price-subtotal').textContent = totalPriceFormatted; // Update subtotal as well
// }

// // Initialize the cart totals when the page loads
// updateTotals(cart);
function calculateTotal() {
    var total = 0;

    cart.forEach(function(course) {
        var itemTotal = course.price * course.quantity;
        total += itemTotal;
    });

    return total;
}

// Call the calculateTotal function to get the total
function updateGrandTotal() {
    var grandTotal = calculateTotal();
    document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
}

// Call the updateGrandTotal function to initially set the grand total
updateGrandTotal();
</script>

<!--shop category end-->

<?php
include("includes/footer.php");
?>