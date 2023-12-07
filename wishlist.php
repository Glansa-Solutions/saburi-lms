<?php
include("includes/header.php");

if (isset($_SESSION['role_id'])) {
    $role_id = $_SESSION['role_id'];
	$role = $_SESSION['role'];
}else{
    $role="";
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
                    <h1>Wishlist</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Wishlist
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
                                        <div class="wishlist-card row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                                    <?php
                                                        if ($query_fetch_wishlist) {
                                                            while ($row = mysqli_fetch_assoc($query_fetch_wishlist)) {
                                                                $id = $row['id'];
                                                                $userId = $row['userId'];
                                                                $role = $row['role'];
                                                                $courseId = $row['courseId'];
                                                                $courseName = $row['courseName'];
                                                                $price = $row['price'];
                                                                $image = $row['image'];
                                                    ?>
                                                    <div class="col">
                                                        <div class="card">
                                                            <img src="./uploads/images/<?= $image ?>" class="card-img-top" alt="<?= $courseName ?>">
                                                            <div class="card-body">
                                                                <div class="bi bi-cross remove" data-id="<?= $id ?>"></div>
                                                                <h5 class="card-title"><?= $courseName ?></h5>
                                                                <p class="card-text">Price: &#8377; <?= $price ?></p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="#" class="btn btn-main btn-block move_to_cart add_to_cart_button"
                                                                    data-product-id="<?= $courseId ?>" data-product-name="<?= $courseName ?>"
                                                                    data-product-price="<?= $price ?>" data-product-image="<?= $image ?>" data-id="<?= $id ?>">
                                                                    Add To Cart
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                            }
                                                        } else {
                                                            echo "Query failed!";
                                                        }
                                                    ?>
                                                </div>

                                        </form>
                                    </div>

                                </div>
                            </div><!-- .entry-content -->
                    </article>
                </div>
                


            </div>
        </div>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


$(document).ready(function () {
    $('.move_to_cart').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
        type:"POST",
        url:"./core/wishlistFunctionality.php",
        data:{'move_to_cart':true,
            id:id        
        },
        context: this,
        success:function(response){
            Swal.fire({
						icon: 'success',
						title: response,
						showConfirmButton: false,
						timer: 2000
					});
                    $(this).closest('.card').remove();
        },
        
    });
    });

    $('.remove').on('click', function () {
    var id = $(this).data('id'); // Assuming 'id' is the correct attribute name

    $.ajax({
        type: "POST",
        url: "./core/wishlistFunctionality.php",
        data: {
            'remove': true,
            'id': [id] // Send 'id' as an array
        },
        context: this, // Set the context to 'this' for the success callback
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: response,
                showConfirmButton: false,
                timer: 2000
            });
            $(this).closest('.col').remove(); // Now 'this' refers to the clicked element
        }
    });
});



    
});
    
//     $(document).ready(function () {
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
//     var card = $('<div class="card"></div>');  // Create a new card element
//     var cardBody = $('<div class="card-body"></div>');  // Create a new card body element

//     // Concatenate the HTML content instead of overwriting it
//     cardBody.html(
//         '<img src="./uploads/images/' + row.image + '" alt="' + row.name + '">' +
//         '<div class="bi bi-cross remove"></div>' +
//         '<h3>' + row.name + '</h3>' +
//         '<p>Price: &#8377;' + row.price + '</p>' +
//         '<p>Quantity: ' + row.quantity + '</p>'
//     );

//     var cardFooter = $('<div class="card-footer"></div>');  // Create a new card footer element
//     cardFooter.html(`
//         <a href="" class="btn btn-main btn-block add_to_cart_button"
//             data-product-id="${row.id}" data-product-name="${row.name}"
//             data-product-price="${row.price}" data-product-image="${row.image}">
//             Add To Cart
//         </a>
//     `);

//     card.append(cardBody);
//     card.append(cardFooter);

//     return card;
// }




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

</script>
<style>
    .wishlist-container {
    max-width: 800px;
    margin: auto;
}


.card {
    margin-bottom: 20px;
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05);
}

.remove {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: black;
    background-color:"gray";
}

</style>

<?php
include("includes/footer.php");
?>