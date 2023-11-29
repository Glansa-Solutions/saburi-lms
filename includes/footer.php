<?php

// Access the role_id from the session
if (isset($_SESSION['role_id'])) {
    $role_id = $_SESSION['role_id'];
	$role = $_SESSION['role'];
} else {
    // Default value or error handling
    $role_id = 0;
}
if($fetch_user_contact_details_query)
{
    while($fetch_user_contact_details_result = mysqli_fetch_assoc($fetch_user_contact_details_query))
    {
        $contact_id = $fetch_user_contact_details_result["id"];
        $contact_email = $fetch_user_contact_details_result["email"];
        $contact_phone = $fetch_user_contact_details_result["phone_no"];
        $contact_address = $fetch_user_contact_details_result["address"];
    }
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
                        <li><a href="<?= $mainlink;?>about">About us</a></li>
                        <li><a href="<?= $mainlink;?>contact">Contact us</a></li>
                        <li><a href="<?= $mainlink;?>project">Projects</a></li>
                        <li><a href="<?= $mainlink;?>">Terms & Condition</a></li>
                        <li><a href="<?= $mainlink;?>">Privacy policy</a></li>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-lg-2 col-sm-6 col-md-6">
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
			</div> -->
            <div class="col-lg-2 col-sm-6 col-md-6">
                <div class="footer-widget mb-5 mb-lg-0">
                    <h5 class="widget-title">Courses</h5>
                    <ul class="list-unstyled footer-links">
                        <?php
					$limit = 5; // Set the limit for the number of courses to display
					$fetch_courses_query = mysqli_query($con, "SELECT * FROM courses ORDER BY id DESC LIMIT $limit");
					
					while ($row = mysqli_fetch_assoc($fetch_courses_query)) {
						$courseName = $row['courseName'];
						// You can include other course details as needed
						$courseLink = "#"; // You should replace this with the actual link for the course
						
						echo "<li><a href='{$courseLink}'>{$courseName}</a></li>";
					}
					?>
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
                                <?= $contact_phone?>
                            </div>

                        </li>
                        <li> <i class="bi bi-envelop"></i>
                            <div>
                                <strong>Email Address</strong>
                                <?= $contact_email;?>
                            </div>
                        </li>
                        <li><i class="bi bi-location-pointer"></i>
                            <div>
                                <strong>Office Address</strong>
                                <?= $contact_address;?>
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

<script>
var quantityInput;
var roleId = <?php echo json_encode($role_id); ?>;

// console.log(roleId);
$(document).ready(function() {
    // Get the quantity input element
    quantityInput = $('#quantity');
    userId = sessionStorage.getItem("roleId");
    // console.log(userId);

    // Increase quantity
    $('#increase').click(function() {
        quantityInput.val(parseInt(quantityInput.val()) + 1);
    });

    // Decrease quantity
    $('#decrease').click(function() {
        var currentVal = parseInt(quantityInput.val());
        if (currentVal > 1) {
            quantityInput.val(currentVal - 1);
        }
    });
});

$('.add_to_cart_button').click(function(e) {
    e.preventDefault();
	console.log("hi");
    var roleId = <?php echo json_encode($role_id); ?> || '';
    var role = <?php echo json_encode($role); ?> || '';

    console.log(roleId);

    var product_id = $(this).data('product-id');
    var product_name = $(this).data('product-name');
    var product_price = $(this).data('product-price');
    var product_image = $(this).data('product-image');


    var selectedQuantity = quantityInput.val() ? parseInt(quantityInput.val()) : 1;

    // Check if there is an existing cart in local storage
    var cart = JSON.parse(localStorage.getItem('cart')) || [];

    var existingItem = cart.find(function(item) {
        return item.id === product_id && item.user_id === roleId && role === 'student';
    });

    if (existingItem) {
        alert("You have already added this item to cart");
    } else {
        existingItem = cart.find(function(item) {
            return item.id === product_id && item.user_id === roleId && role === 'company';
        });

        if (existingItem) {
            existingItem.quantity += selectedQuantity;
        } else {
            var cartItem = {
                user_id: roleId,
                id: product_id,
                name: product_name,
                price: product_price,
                image: product_image,
                quantity: selectedQuantity
            };
            cart.push(cartItem);
        }

        // Save the updated cart back to local storage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update the cart count in the header
        updateCartCount();
    }
});

function updateCartCount() {
    var cart = getCartItems();
    var totalQuantity = cart.reduce(function(acc, item) {
        return acc + parseInt(item.quantity);
    }, 0);
    $('#cart-count-container').text(' (' + totalQuantity + ')');
}

$(document).ready(function() {
    updateCartCount(); // Call this on page load to set the initial cart count
});

function getCartItems() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

// Example: Get the cart items and do something with them
var cartItems = getCartItems();
cartItems.forEach(function(item) {
    // Do something with each cart item
});
//***********  script for eye- password show hide starts************//
var passwordInput = document.getElementById('login-password');
var eyeIcon = document.getElementById('eye-icon');
var showPassword = document.getElementById('show-password');


showPassword.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
});
var confirmPasswordInput = document.getElementById('confirm-password');
var eyeIcon1 = document.getElementById('eye-icon1');
var showPassword1 = document.getElementById('show-password1');

showPassword1.addEventListener('click', function() {
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        eyeIcon1.classList.remove('fa-eye-slash');
        eyeIcon1.classList.add('fa-eye');
    } else {
        confirmPasswordInput.type = 'password';
        eyeIcon1.classList.remove('fa-eye');
        eyeIcon1.classList.add('fa-eye-slash');
    }
});

// ************showing the message alert script starts*************//
document.addEventListener("DOMContentLoaded", function() {
    var messageContainer = document.getElementById('message-container');
    var statusMessage = document.getElementById('status-message');

    if (statusMessage.innerHTML.trim() === "Your password was updated") {
        statusMessage.style.color = 'green';
    } else {
        statusMessage.style.color = 'red';
    }

    // Fade out the message after 3 seconds
    setTimeout(function() {
        messageContainer.style.opacity = '0';
        messageContainer.style.transition = 'opacity 1s';
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function() {
    var messageContainer = document.getElementById('getting-message-container');
    var statusMessage = document.getElementById('status-message');

    // Fade out the message after 3 seconds
    setTimeout(function() {
        messageContainer.style.opacity = '0';
        messageContainer.style.transition = 'opacity 1s';
    }, 3000);
});
// Wishlist Functionality



$('.add_to_wishlist_button').click(function(e) {
    e.preventDefault();
    alert("asdasd");

    var roleId = <?php echo json_encode($role_id); ?> || '';
    var role = <?php echo json_encode($role); ?> || '';

	if(roleId && role){
		var product_id = $(this).data('product-id');
    var product_name = $(this).data('product-name');
    var product_price = $(this).data('product-price');
    var product_image = $(this).data('product-image');
	// console.log(role);

    var selectedQuantity =  1;
	var wishlistItem = {
                user_id: roleId,
                id: product_id,
                name: product_name,
                price: product_price,
                image: product_image,
                role: role,
				'add_to_wishlist_button':true,
            };
			

    // Check if there is an existing cart in local storage
    // var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
		$.ajax({
			type: 'POST',
			url:"./core/wishlistFunctionality.php",
			data:wishlistItem,
			success:function(response){
					Swal.fire({
						icon: 'success',
						title: response,
						showConfirmButton: false,
						timer: 2000 // Hide the message after 3 seconds
					});
                    },
                    error: function(xhr, status, error){
                        console.error('AJAX Error:', status, error);
                    }
		})

    
    // var existingItem = wishlist.find(function(item) {
    //     return item.id === product_id && item.user_id === roleId;
    // });

    // if (existingItem) {
    //     // alert("You have already added this item to your wishlist");
	// 			Swal.fire({
	// 					icon: 'error',
	// 					title: 'You have already added this item to your wishlist',
	// 					showConfirmButton: false,
	// 					timer: 2000 
	// 				});
    // } else {
    //     $.ajax({
	// 		type:'POST',
	// 		url: './core/wishlistFunctionality.php',
	// 		data: wishlistItem,
	// 		success:function(response){
	// 					Swal.fire({
	// 					icon: 'success',
	// 					title: response,
	// 					showConfirmButton: false,
	// 					timer: 2000 // Hide the message after 3 seconds
	// 				});
    //                 },
    //                 error: function(xhr, status, error){
    //                     console.error('AJAX Error:', status, error);
    //                 }
	// 	});
    //     // wishlist.push(wishlistItem);
    //     // Save the updated cart back to local storage
    //     // localStorage.setItem('wishlist', JSON.stringify(wishlist));

    //     // Update the cart count in the header
    //     // updateWishlistCount();
    // }
	}else{
		Swal.fire({
						icon: 'error',
						title: "Please Login First",
						showConfirmButton: false,
						timer: 2000 // Hide the message after 3 seconds
					});

	}

    
});

// function updateWishlistCount() {
//     var wishlist = getWishlistItems();
//     var totalQuantity = wishlist.length;
//     // $('#wishlist-count-container').text(' (' + totalQuantity + ')');
// }

// $(document).ready(function() {
//     updateWishlistCount(); // Call this on page load to set the initial cart count
// });

// function getWishlistItems() {
//     return JSON.parse(localStorage.getItem('wishlist')) || [];
// }

// // Example: Get the cart items and do something with them
// var wishlistItems = getWishlistItems();
// wishlistItems.forEach(function(item) {
//     // Do something with each cart item
// });

// $(document).ready(function () {
//     // Load wishlist from localStorage
//     var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
//     console.log(wishlist);
//     updateWishlist();

//     // Event delegation for the remove button
//     $('.wishlist-card').on('click', '.remove', function () {
//         var indexToRemove = $(this).closest('.card').index();
//         wishlist.splice(indexToRemove, 1); // Remove item from wishlist array
//         localStorage.setItem('wishlist', JSON.stringify(wishlist)); // Update localStorage
//         updateWishlist(); // Update the displayed wishlist
//     });

//     function createCard(row) {
//         var card = $('<div class="card">');
//         var cardBody = $('<div class="card-body">');

//         cardBody.append('<img src="./uploads/images/' + row.image + '" alt="' + row.name + '">');
//         cardBody.append('<div class="bi bi-cross remove"></div>');
//         cardBody.append('<h3>' + row.name + '</h3>');
//         cardBody.append('<p>Price: &#8377;' + row.price + '</p>');
//         cardBody.append('<p>Quantity: ' + row.quantity + '</p>');

//         var cardFooter = $('<div class="card-footer">');
//         cardFooter.append(`
//             <a href="" class="btn btn-main btn-block add_to_cart_button"
//                 data-product-id="${row.id}" data-product-name="${row.name}"
//                 data-product-price="${row.price}" data-product-image="${row.image}">
//                 Add To Cart
//             </a>
//         `);

//         card.append(cardBody);
//         card.append(cardFooter);

//         return card;
//     }

//     function updateWishlist() {
//         $('.wishlist-card').empty(); // Clear the existing wishlist

//         $.each(wishlist, function (index, row) {
//             var card = createCard(row);
//             $('.wishlist-card').append(card);
//         });

//         // Update wishlist count
//         $('#wishlist-container').text(wishlist.length);
//     }
// });

// ...
</script>
<!-- Add this to your HTML to include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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