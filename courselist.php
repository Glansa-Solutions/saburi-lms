<?php include("includes/header.php"); ?>

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
                    <h1>Course List</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Course List
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<main class="site-main page-wrapper  woocommerce">
    <!--product section start-->
    <section class="space-2">
        <div class="container">
            <div class="row">
                <!-- product section end-->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="section-title">
                        <h2 class="title d-block text-left-sm">Courses</h2>
                        <p class="woocommerce-result-count"> Showing 1–16 of 17 results</p>
                        <form class="woocommerce-ordering float-lg-right" method="get">
                            <select name="orderby" class="orderby form-control" aria-label="Shop order">
                                <option value="" selected="selected">Default sorting</option>
                                <option value="">Sort by popularity</option>
                                <option value="">Sort by average rating</option>
                                <option value="">Sort by latest</option>
                                <option value="">Sort by price: low to high</option>
                                <option value="">Sort by price: high to low</option>
                            </select>
                            <input type="hidden" name="paged" value="1">
                        </form>
                    </div>

                    <ul class="products columns-3">
                        <?php
                        foreach ($query as $product) {
                            $id = $product['id'];
                            $courseImage = $product['bannerImage'];
                            $courseName = $product['courseName'];
                            $courseCost = $product['courseCost'];
                            ?>
                            <li class="product" style="margin-right:2%;">
                                <div class="product-wrap">
                                    <a href="course_single.php?id=<?= $id ?>">
                                        <img src="uploads/images/<?= $courseImage ?>" alt="">
                                    </a>
                                    <div class="product-btn-wrap">
                                        <a href="course_single.php?id=<?= $id ?>"
                                            class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                            data-product-id="<?= $id ?>" data-product-name="<?= $courseName ?>"
                                            data-product-price="<?= $courseCost ?>"
                                            data-product-image="<?= $courseImage ?>">
                                            <i class="fa fa-shopping-basket"></i>
                                        </a>
                                        <a href="" class="button wish-list"><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="woocommerce-product-title-wrap">
                                    <h2 class="woocommerce-loop-product__title">
                                        <a href="#">
                                            <?= $courseName ?>
                                        </a>
                                    </h2>
                                </div>
                                <span class="price">
                                    <ins>
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">₹</span>
                                            <?= $courseCost ?>
                                        </span>
                                    </ins>
                                </span>
                                <div class="star-rating"></div>
                            </li>

                            <?php
                        }
                        ?>

                    </ul>

                    <?php if ($totalCourses > 0): ?>
                        <!-- Display pagination only if there are courses to show -->
                        <nav class="woocommerce-pagination">
                            <ul class="page-numbers">
                                <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                    <li>
                                        <?php if ($page == $currentPage): ?>
                                            <span aria-current="page" class="page-numbers current">
                                                <?= $page ?>
                                            </span>
                                        <?php else: ?>
                                            <a class="page-numbers" href="?page=<?= $page ?>">
                                                <?= $page ?>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
                <!-- product Sidebar start-->
                <div class="col-lg-4 widget-area ">
                    <section id="woocommerce_product_search-2" class="widget woocommerce widget_product_search">
                        <form role="search" method="get" class="woocommerce-product-search" action="#">
                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">
                                Search for:</label>
                            <input type="search" id="woocommerce-product-search-field-0" class="search-field"
                                placeholder="Search products…" value="" name="s">
                            <button type="submit" value="Search">Search</button>
                            <input type="hidden" name="post_type" value="product">
                        </form>
                    </section>

                    <section id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
                        <h3 class="widget-title">Course Topics</h3>
                        <div class="edutim-course-topic">
                            <div class="accordion" id="accordionExample">
                                <?php $index = 0; ?>
                                <?php foreach ($fetch_list_topic_query as $row): ?>
                                    <div class="card">
                                        <div class="card-header" id="heading<?= $index ?>">
                                            <h2 class="mb-0">
                                                <button class="btn-block text-left curriculmn-title-btn" type="button"
                                                    data-toggle="collapse" data-target="#collapse<?= $row['Id'] ?>">
                                                    <h4 class="curriculmn-title">
                                                        <?= $row['topicName'] ?>
                                                    </h4>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse<?= $row['Id'] ?>" class="collapse"
                                            data-parent="#accordionExample">
                                            <div class="course-lessons">
                                                <?php foreach ($fetch_list_subtopic_query as $subtopic): ?>
                                                    <?php if ($subtopic['topicId'] == $row['Id']): ?>
                                                        <div class="single-course-lesson">
                                                            <div class="course-topic-lesson">
                                                                <a href="core/functions.php?subtopicId=<?= $subtopic['id']; ?>">
                                                                    <?= $subtopic['subTopicName'] ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $index++; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                    <section id="woocommerce_top_rated_products-2" class="widget woocommerce widget_top_rated_products">
                        <h3 class="widget-title">Top rated products</h3>
                        <ul class="product_list_widget">
                            <li>
                                <a href="#">
                                    <img width="300" height="300" src="assets/images/shop/p1.jpg"
                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                                    <span class="product-title">V-Neck T-Shirt</span>
                                </a>

                                <span class="woocommerce-Price-currencySymbol">data</span>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="300" height="300" src="assets/images/shop/p1.jpg"
                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                                    <span class="product-title">V-Neck T-Shirt</span>
                                </a>

                                <span class="woocommerce-Price-currencySymbol">data</span>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="300" height="300" src="assets/images/shop/p1.jpg"
                                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                                    <span class="product-title">V-Neck T-Shirt</span>
                                </a>

                                <span class="woocommerce-Price-currencySymbol">data</span>
                            </li>
                        </ul>
                    </section>
                </div>



            </div>
        </div>
    </section>
    <!-- product section end-->


</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Get all subtopic links
    // Get all subtopic links
    var subtopicLinks = document.querySelectorAll('.course-topic-lesson a');

    // Attach a click event handler to each subtopic link
    subtopicLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the target subtopic ID from the link's href
            var href = this.getAttribute('href');
            var targetId = href.split('=')[1]; // Extract the subtopic ID from the query parameter
            console.log(targetId);

            // Make an AJAX request to the server to fetch courses based on the selected subtopic
            $.ajax({
                type: 'GET',
                url: 'core/functions.php',
                data: {
                    subtopicId: targetId
                }, // Pass the subtopic ID as a parameter
                success: function (response) {
                    // Handle the response and update the course list
                    $('.products').html(response);
                }
            });
        });
    });

    $("#target").on("click", function () {
        alert("Handler for `click` called.");
    });
    // AJAX request to add a product to the cart
    $('.add_to_cart_button').click(function (e) {
        e.preventDefault();

        var product_id = $(this).data('product-id');
        var product_name = $(this).data('product-name');
        var product_price = $(this).data('product-price');
        var product_image = $(this).data('product-image');

        // Check if there is an existing cart in local storage
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Create a new cart item
        var cartItem = {
            id: product_id,
            name: product_name,
            price: product_price,
            image: product_image
        };

        // Add the new item to the cart
        cart.push(cartItem);

        // Save the updated cart back to local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update the cart count in the header
        updateCartCount();
    });

    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartCount = cart.length;
        $('#cart-count-container').text(' (' + cartCount + ')');
    }

    $(document).ready(function () {
        updateCartCount(); // Call this on page load to set the initial cart count
    });

    function getCartItems() {
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    // Example: Get the cart items and do something with them
    var cartItems = getCartItems();
    cartItems.forEach(function (item) {
        // Do something with each item, e.g., display in a cart summary
    });

    // ...
</script>
<?php include("includes/footer.php"); ?>