<?php 
include("includes/header.php"); 
include("core/listgrid.php");

$query = "SELECT * FROM courses"; // Adjust the table name as needed

$conditions = []; // Array to store conditions

// Subtopic ID
if (isset($_GET['subtopicId']) && !empty($_GET['subtopicId'])) {
    $subtopicId = mysqli_real_escape_string($con, $_GET['subtopicId']);
    $conditions[] = "subTopicId = $subtopicId";
}

// Search term
if (isset($_GET['s']) && !empty($_GET['s'])) {
    $searchTerm = mysqli_real_escape_string($con, $_GET['s']);
    $conditions[] = "(courseName LIKE '%$searchTerm%' OR courseDesc LIKE '%$searchTerm%')";
}

// Combine conditions if any
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
    switch ($orderby) {
        case 'popularity':
            $query .= " ORDER BY popularity_column ASC";
            break;
        case 'average_rating':
            $query .= " ORDER BY rating_column ASC";
            break;
        case 'latest':
            $query .= " ORDER BY date_column DESC";
            break;
        case 'price_low_to_high':
            $query .= " ORDER BY courseCost ASC";
            break;
        case 'price_high_to_low':
            $query .= " ORDER BY courseCost DESC";
            break;
        // Add more cases as needed
        default:
            // Default case
            break;
    }
}

// echo $query;
$allcourse = mysqli_query($con, $query);

// Fetch topics
if ($fetch_list_topic_query) {
    while ($row = mysqli_fetch_assoc($fetch_list_topic_query)) {
        $id = $row['Id'];
        $topic_name = $row['topicName'];
    }
}

$recordsPerPage = 5; // Adjust this value based on your preference
$totalRecords = mysqli_num_rows($allcourse);
$totalPages = ceil($totalRecords / $recordsPerPage);

// Make sure the current page is within a valid range
$currentPage = max(1, min($totalPages, isset($_GET['page']) ? (int) $_GET['page'] : 1));
$offset = ($currentPage - 1) * $recordsPerPage;

// Modify the query to include LIMIT and OFFSET
$query .= " LIMIT $recordsPerPage OFFSET $offset";

// Execute the modified query
$allcourse = mysqli_query($con, $query);

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
                        <p class="woocommerce-result-count"> Showing 1–
                            <?php echo mysqli_num_rows($allcourse); ?> of
                            <?php echo mysqli_num_rows($allcourse); ?> results
                        </p>
                        <form class="woocommerce-ordering float-lg-right" method="get">
                            <select name="orderby" class="orderby form-control" aria-label="Shop order"
                                onchange="handleSortChange(this)">
                                <option value="" selected="selected">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                <option value="average_rating">Sort by average rating</option>
                                <option value="latest">Sort by latest</option>
                                <option value="price_low_to_high">Sort by price: low to high</option>
                                <option value="price_high_to_low">Sort by price: high to low</option>
                            </select>
                        </form>
                    </div>

                    <ul class="products columns-3">
                        <?php
                        if (isset($_GET['subtopicId']) && isset($_GET['orderby']) && !empty($_GET['subtopicId']) && !empty($_GET['orderby'])) {
                            $subtopicId = $_GET['subtopicId'];

                            // Use $subtopicId in your query to fetch filtered courses
                            $filteredCourses = mysqli_query($con, "SELECT * FROM courses WHERE subtopicId = $subtopicId ORDER BY courseCost ASC");

                            // Loop through and display filtered courses
                            while ($row = mysqli_fetch_array($filteredCourses)) {
                                $coursename = $row["courseName"];
                                $coursePrice = $row["courseCost"];
                                $courseDes = $row["courseDesc"];
                                $bannerImage = $row["bannerImage"];
                                // echo $bannerImage;
                                ?>
                        <li class="product" style="margin-right:2%;">
                            <div class="product-wrap">
                                <a href="course_single?course_id=<?= $id ?>">
                                    <img src="uploads/images/<?= $bannerImage ?>" alt="">
                                </a>
                                <div class="product-btn-wrap">
                                            <!-- Add to cart and wishlist buttons -->
                                            <!-- <a href="" class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                data-product-id="<?= $id ?>" data-product-name="<?= $coursename ?>"
                                                data-product-price="<?= $coursePrice ?>"
                                                data-product-image="<?= $bannerImage ?>">
                                                <i class="fa fa-shopping-basket"></i>
                                            </a>
                                            <a href="#" class="button wish-list"><i class="fa fa-heart"></i></a> -->
                                        </div>
                            </div>
                            <div class="woocommerce-product-title-wrap">
                                <h2 class="woocommerce-loop-product__title">
                                    <a href="#">
                                        <?= $coursename ?>
                                    </a>
                                </h2>
                            </div>
                            <span class="price">
                                <ins>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">₹</span>
                                        <?= $coursePrice ?>
                                    </span>
                                </ins>
                            </span>
                            <div class="star-rating"></div>
                        </li>
                        <?php
                            }
                        } else {
                            while ($row = mysqli_fetch_array($allcourse)) {
                                $id = $row['id'];
                                $coursename = $row["courseName"];
                                $coursePrice = $row["courseCost"];
                                $courseDes = $row["courseDesc"];
                                $bannerImage = $row["bannerImage"];
                                ?>
                        <li class="product" style="margin-right:2%;">
                            <div class="product-wrap">
                                <a href="course_single?course_id=<?= $id ?>">
                                    <img src="uploads/images/<?= $bannerImage ?>" alt="">
                                </a>
                                <div class="product-btn-wrap">
                                    <!-- <a href="#" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
                                                <i class="fa fa-shopping-basket"></i>
                                            </a> -->
                                            <!-- <a href="#" class=""></a> -->
                                            <a href="#" class="button add_to_wishlist_button"
                                            data-product-id="<?= $id ?>" data-product-name="<?= $coursename ?>"
                                            data-product-price="<?= $coursePrice ?>" data-product-image="<?= $bannerImage ?>">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                </div>
                            </div>
                            <div class="woocommerce-product-title-wrap">
                                <h2 class="woocommerce-loop-product__title">
                                    <a href="#">
                                        <?= $coursename ?>
                                    </a>
                                </h2>
                            </div>
                            <span class="price">
                                <ins>
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">₹</span>
                                        <?= $coursePrice ?>
                                    </span>
                                </ins>
                            </span>
                            <div class="star-rating"></div>
                        </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>

                    <nav class="woocommerce-pagination">
                        <ul class="page-numbers">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li>
                                <a class="page-numbers"
                                    href="?page=<?php echo $i; ?><?php echo isset($_GET['subtopicId']) ? '&subtopicId=' . $_GET['subtopicId'] : ''; ?><?php echo isset($_GET['s']) ? '&s=' . $_GET['s'] : ''; ?><?php echo isset($_GET['orderby']) ? '&orderby=' . $_GET['orderby'] : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
                <!-- product Sidebar start-->
                <div class="col-lg-4 widget-area">
                    <section id="woocommerce_product_search-2" class="widget woocommerce widget_product_search">
                        <form role="search" method="get" class="woocommerce-product-search" action="#">
                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search
                                for:</label>
                            <input type="search" id="woocommerce-product-search-field-0" class="search-field"
                                placeholder="Search products…" value="" name="s">

                            <!-- Include hidden fields for existing query parameters -->
                            <?php
                            if (isset($_GET['subtopicId'])) {
                                echo '<input type="hidden" name="subtopicId" value="' . htmlspecialchars($_GET['subtopicId']) . '">';
                            }
                            if (isset($_GET['orderby'])) {
                                echo '<input type="hidden" name="orderby" value="' . htmlspecialchars($_GET['orderby']) . '">';
                            }
                            ?>

                            <button type="submit" value="Search" id="searchButton">Search</button>
                            <!-- <input type="hidden" name="post_type" value="product"> -->
                        </form>
                    </section>

                    <section id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
                        <h3 class="widget-title">Courses categories</h3>
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
                                                    <!-- <i class="fab fa-youtube"></i> -->

                                                    <!-- <a href="<?= $subtopic['id']; ?>"><?= $subtopic['subTopicName'] . $subtopic['id'] ?></a> -->
                                                    <!-- Change the subtopic link in your PHP code -->
                                                    <a href="#" class="subtopic-link"
                                                        data-subtopic-id="<?= $subtopic['id']; ?>">
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
                        <h3 class="widget-title">Top Rated Course</h3>
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
$(document).ready(function () {
    // Add a click event to all elements with the class 'subtopic-link'
    var subtopicLinks = $('.subtopic-link');

    subtopicLinks.on('click', function (event) {
        event.preventDefault();

        // Get the subtopicId from the clicked element
        var subtopicId = $(this).data('subtopicId');

        // Update the URL and content
        updateUrlAndContent(subtopicId);
    });

    var searchInput = $('.search-field');
    searchInput.on('input', function () {
        updateUrlAndContent();
    });

    var sortingSelect = $('.orderby');
    sortingSelect.on('change', function () {
        updateUrlAndContent();
    });

    function updateUrlAndContent(subtopicId) {
        var searchTerm = searchInput.val().trim();
        var selectedValue = sortingSelect.val();

        // If subtopicId is provided, include it in the state object
        var stateObj = { s: searchTerm, orderby: selectedValue };
        if (subtopicId) {
            stateObj.subtopicId = subtopicId;
        }else{
            stateObj.subtopicId = '';
        }

        // Update the URL with the new state
        history.pushState(stateObj, '', '?' + $.param(stateObj));

        // Update the content
        updateContent();
    }

    // Function to update the content without reloading
    function updateContent() {
        // Use AJAX to fetch and update the content based on the current URL
        $.ajax({
            url: window.location.href,
            type: 'GET',
            success: function (data) {
                // Update the content of the relevant container (e.g., '.products')
                $('.products').html($(data).find('.products').html());
            },
            error: function () {
                alert('Error updating content');
            }
        });
    }
});




</script>


<?php include("includes/footer.php"); ?>
