<?php
include("includes/header.php");

if (isset($_SESSION['role_id'])) {
    $role_id = $_SESSION['role_id'];
	$role = $_SESSION['role'];
}
?>
<!--search overlay start-->
<a href="" class="btn btn-main btn-block add_to_cart_button" data-product-id="3" data-product-name="Angular" data-product-price="4500" data-product-image="angular.png">
            Add To Cart
        </a>

<?php
include("includes/footer.php");
?>