<?php 
include("db_config.php");

//Course List functions start

if (isset($_GET['subtopicId'])) {   
$targetId = $_GET['subtopicId'];
$query = "SELECT courses.* FROM courses
              WHERE courses.subTopicId = $targetId";

    $result = mysqli_query($con, $query);

    if ($result) {
        $courses = [];
        // Open the HTML block
        echo '<ul class="products columns-3">';

        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = $row;
            $id = $row['id'];
            $courseImage = $row['bannerImage'];
            $courseName = $row['courseName'];
            $courseCost = $row['courseCost'];
        
            // Output each course as HTML
            echo '<li class="product" style="margin-right:2%;">
                <div class="product-wrap">
                    <a href="#" class="">
                        <img src="uploads/images/' . $courseImage . '" alt="">
                    </a>
                    <div class="product-btn-wrap">
                        <a href="cart.php?id=' . $id . '&name=' . $courseName . '&price=' . $courseCost . '&image=' . $courseImage . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart" 
                            data-product-id="' . $id . '"
                            data-product-name="' . $courseName . '"
                            data-product-price="' . $courseCost . '"
                            data-product-image="' . $courseImage . '">
                            <i class="fa fa-shopping-basket"></i>
                        </a>
                        <a href="#" class="button wish-list"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
                <div class="woocommerce-product-title-wrap">
                    <h2 class="woocommerce-loop-product__title">
                        <a href="#">' . $courseName . '</a>
                    </h2>
                </div>
                <span class="price">
                    <ins>
                        <span class="woocommerce-Price-amount amount">
                            <span class="woocommerce-Price-currencySymbol">$</span>' . $courseCost . '
                        </span>
                    </ins>
                </span>
                <div class="star-rating"></div>
            </li>';
        }
        

        // Close the HTML block
        echo '</ul>';
    } else {
        echo 'No courses found.';
    }
}



//Course List functions end