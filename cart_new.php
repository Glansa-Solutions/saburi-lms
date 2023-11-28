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
    $(document).ready(function () {
    var tableBody = $('.tableBody');
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var role = <?php echo json_encode($role); ?>

    // Function to update the cart, totals, and grand total
    function updateCartAndTotals(cartData) {
        updateCart(cartData);
        updateTotals(cartData);
        updateGrandTotal(cartData);
    }

    // Function to update the row and remove item from the cart
    function removeCartItem(row, course) {
        var index = cart.findIndex(function (cartItem) {
            return cartItem.id === course.id;
        });

        if (index !== -1) {
            cart.splice(index, 1);
            updateCartAndTotals(cart);

            // Remove the row from the table
            row.remove();
        }
    }
    
    function updateCart(cartData) {
        localStorage.setItem('cart', JSON.stringify(cartData));
    }
    function updateTotals(cartData) {
                                                        // Calculate the total quantity and price
        var totalQuantity = cartData.reduce(function(total, course) {
            return total + course.quantity;
        }, 0);
        
    }
    
    function updateGrandTotal(cartData) {
    var grandTotal = calculateTotal(cartData).toFixed(2);
    document.getElementById('grand-total').textContent = grandTotal ? grandTotal : 0;
}
function calculateTotal(cartData) {
    return cartData.reduce(function(total, course) {
        return total + course.price * course.quantity;
    }, 0);
    console.log(cartData);
}

    // Event handler for remove button
    tableBody.on('click', '.removeBtn', function () {
        var row = $(this).closest('tr');
        var courseId = $(this).data('id'); // Assuming productName contains the course ID

        // Find the corresponding course in the cart
        var course = cart.find(function (cartItem) {
            return cartItem.id === courseId;
        });

        if (course) {
            removeCartItem(row, course);
        }
    });

    // Event handler for quantity buttons
    tableBody.on('click', '.quantity-button', function () {
        var row = $(this).closest('tr');
        var courseId = $(this).data('id'); // Assuming productName contains the course ID

        // Find the corresponding course in the cart
        var course = cart.find(function (cartItem) {
            return cartItem.id === courseId;
        });

        if (course) {
            var quantityInput = row.find('.quantity-input');
            var currentQuantity = parseInt(quantityInput.val());

            if ($(this).hasClass('increment')) {
                currentQuantity++;
            } else if ($(this).hasClass('decrement') && currentQuantity > 1) {
                currentQuantity--;
            }

            // Update the quantity in the cart and UI
            course.quantity = currentQuantity;
            quantityInput.val(currentQuantity);

            // Update the total and grand total
            updateCartAndTotals(cart);
        }
    });

    // Iterate over the cart items and populate the table
    $.each(cart, function (index, row) {
        var newRow = $('<tr>');
        newRow.append('<td class="productName" >' + row.name + '</td>');
        newRow.append('<td class="price">' + '&#8377;' + (row.price) + '</td>');

        if (role == 'student') {
            newRow.append('<td class="product-quantity justify-content-center align-items-center" style="display: none;"></td>');
            $('.product-quantity').hide();
        } else {
            newRow.append('<td class="product-quantity justify-content-center align-items-center"><button class="quantity-button decrement" data-id="' + row.id + '">-</button><input type="number" class="quantity-input course-size" /><button class="quantity-button increment" data-id="' + row.id + '">+</button></td>');
        }

        newRow.append('<td id="woocommerce-Price-amount" class="amount course-size"></td>');
        newRow.append('<td><button class="fas fa-trash-alt bg-light removeBtn" data-id="' + row.id + '"></button></td>');

        // Set the value of the quantity input field for the current row
        newRow.find('.quantity-input').val(parseInt(row.quantity));

        var total = parseInt(row.price) * parseInt(row.quantity);
        newRow.find('#woocommerce-Price-amount').text('₹' + total);

        // Append the new row to the cart
        tableBody.append(newRow);
    });

    // Update the cart and totals when the page loads
    updateCartAndTotals(cart);
});




</script>

<?php
include("includes/footer.php");
?>