<?php

// Access the role_id from the session
if (isset($_SESSION['role_id'])) {
	$role_id = $_SESSION['role_id'];
} else {
	// Default value or error handling
	$role_id = 0;
}
?>
<section class="cta-2">
	<div class="container">
		<div class="row align-items-center subscribe-section ">
			<div class="col-lg-6">
				<div class="section-heading white-text">
					<span class="subheading">Newsletter</span>
					<h3>Join our community of students</h3>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="subscribe-form">
					<form action="./core/allmailfun.php" method="POST">
						<input type="email" class="form-control" name="email" placeholder="Email Address">
						<button type="submit" class="btn btn-main" name="send_email">Send Newsletter<i
								class="fa fa-angle-right ml-2"></i></button>
						<!-- <a href="#" class="btn btn-main" name ="send_email">Subscribe<i class="fa fa-angle-right ml-2"></i> </a> -->
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="footer pt-120">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mr-auto col-sm-6 col-md-6">
				<div class="widget footer-widget mb-5 mb-lg-0">
					<h5 class="widget-title">About Us</h5>
					<p class="mt-3">We operate in the fields of pre-primary, primary, secondary and higher secondary
						schools in the areas of school reform, quality assessment, professional development of teachers
						and Academic & Institutional Audit of Schools</p>
					<ul class="list-inline footer-socials">
						<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"> <a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
						<!-- <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li> -->
					</ul>
				</div>
			</div>

			<div class="col-lg-2 col-sm-6 col-md-6">
				<div class="footer-widget mb-5 mb-lg-0">
					<h5 class="widget-title">Company</h5>
					<ul class="list-unstyled footer-links">
						<li><a href="#">About us</a></li>
						<li><a href="#">Contact us</a></li>
						<li><a href="#">Projects</a></li>
						<li><a href="#">Terms & Condition</a></li>
						<li><a href="#">Privacy policy</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-sm-6 col-md-6">
				<div class="footer-widget mb-5 mb-lg-0">
					<h5 class="widget-title">Courses</h5>
					<ul class="list-unstyled footer-links">
						<li><a href="#">Classroom Management</a></li>
						<li><a href="#">Inclusive Education</a></li>
						<li><a href="#">Learning and Teamwork</a></li>
						<li><a href="#">Study Skills and Time Management</a></li>
						<li><a href="#">Growth Mindset Training</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-md-6">
				<div class="footer-widget footer-contact mb-5 mb-lg-0">
					<h5 class="widget-title">Contact </h5>

					<ul class="list-unstyled">
						<li><i class="bi bi-headphone"></i>
							<div>
								<strong>Phone number</strong>
								7780290335
							</div>

						</li>
						<li> <i class="bi bi-envelop"></i>
							<div>
								<strong>Email Address</strong>
								info@saburilms.com
							</div>
						</li>
						<li><i class="bi bi-location-pointer"></i>
							<div>
								<strong>Office Address</strong>
								Hyderabad,Madhapur
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-btm">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6">
					<div class="footer-logo">
						<img src="assets/images/saburi-logo-150x150.png" alt="Edutim" class="img-fluid"
							style="width:12%">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="copyright text-lg-center">
						<p>@ Copyright reserved to Glansa Solutions<a href="https://themeturn.com"> Saburi LMS</a> </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="fixed-btm-top">
	<a href="#top-header" class="js-scroll-trigger scroll-to-top"><i class="fa fa-angle-up"></i></a>
</div>
<script src="./assets/vendors/swal/sweetalert2@10.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		// Add click event listener to the "Add to Cart" button
		var addToCartButton = document.querySelector('.add_to_cart_button');
		if (addToCartButton) {
			addToCartButton.addEventListener('click', function (event) {
				showSuccessMessage();
			});
		}


		// Function to display the success message using SweetAlert
		function showSuccessMessage() {
			Swal.fire({
				icon: 'success',
				title: 'Course added to cart successfully!',
				showConfirmButton: false,
				timer: 3000 // Hide the message after 3 seconds
			});
		}
	});

</script>
<script>
	var quantityInput;
	var roleId = <?php echo json_encode($role_id); ?>;

	console.log(roleId);
	$(document).ready(function () {
		// Get the quantity input element
		quantityInput = $('#quantity');
		userId = sessionStorage.getItem("roleId");
		// console.log(userId);

		// Increase quantity
		$('#increase').click(function () {
			quantityInput.val(parseInt(quantityInput.val()) + 1);
		});

		// Decrease quantity
		$('#decrease').click(function () {
			var currentVal = parseInt(quantityInput.val());
			if (currentVal > 1) {
				quantityInput.val(currentVal - 1);
			}
		});
	});

	$('.add_to_cart_button').click(function (e) {
		e.preventDefault();

		var product_id = $(this).data('product-id');
		var product_name = $(this).data('product-name');
		var product_price = $(this).data('product-price');
		var product_image = $(this).data('product-image');

		var selectedQuantity = quantityInput.val();

		// Check if there is an existing cart in local storage
		var cart = JSON.parse(localStorage.getItem('cart')) || [];

		// Create a new cart item with user_id
		var cartItem = {
			user_id: roleId,
			id: product_id,
			name: product_name,
			price: product_price,
			image: product_image,
			quantity: selectedQuantity
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

<script src="./core/action.js"></script>
<!-- 
	Essential Scripts
	=====================================-->

<!-- Main jQuery -->
<script src="assets/vendors/jquery/jquery.js"></script>
<!-- Bootstrap 4.5 -->
<script src="assets/vendors/bootstrap/bootstrap.js"></script>
<!-- Counterup -->
<script src="assets/vendors/counterup/waypoint.js"></script>
<script src="assets/vendors/counterup/jquery.counterup.min.js"></script>
<script src="assets/vendors/jquery.isotope.js"></script>
<script src="assets/vendors/imagesloaded.js"></script>
<!--  Owlk Carousel-->
<script src="assets/vendors/owl/owl.carousel.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>