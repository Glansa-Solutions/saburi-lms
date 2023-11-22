<?php
 
include("includes/header.php");
include("./core/data_list_grid.php");

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
                    <h1>My Orders</h1>
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
                <div class="col-lg-12">
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
                                                <th class="serial">S.No</th>
                                                <th class="product-name">Course Name</th>
                                                <th class="product-price">Description</th>
                                                <!-- <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th> -->
                                                <th class="product-subtotal">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Place this script within your HTML file -->
                                            <?php
                                                if($fetch_list_order_query)
                                                {
                                                    $i = 1;
                                                    while($row=mysqli_fetch_assoc($fetch_list_order_query))
                                                    {
                                                        $id = $row['id'];
                                                        $courseName=$row['courseName'];
                                                        $courseDesc = $row['courseDesc'];
                                                    
                                                        ?>
                                                    <tr>
                                                        <td><?= $i;?></td>
                                                        <td class="edit_id" hidden><?= $id; ?>
                                                        <td><?= $courseName; ?></td>
                                                        <td><?= $courseDesc; ?></td>
                                                    
                                                        <td>
                                                            <a href="course_single?order_id=<?= $id; ?>" class="btn btn-primary text-white me-2 p-2 add-to-cart-button">View Course</a>
                                                        </td>

                                                    </tr>


                                                    <?php
                                                $i++;
                                                    }
                                                    
                                                }else {
                                                    echo "Query failed!";
                                                }
                                                ?>
                                        </tbody>

                                    </table>
                                </form>
                            </div>
                        </div><!-- .entry-content -->
                    </article>
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