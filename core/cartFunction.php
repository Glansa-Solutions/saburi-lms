if (isset($_POST['cart'])) {
    // Get the updated cart from the AJAX request
    $updatedCart = $_POST['cart'];

    // Update the session cart with the updated cart
    $_SESSION['cart'] = $updatedCart;

    // You can also calculate the total or perform other cart-related actions here if needed
}

if (isset($_POST['remove_item'])) {
    $itemId = $_POST['remove_item'];
    // Remove the item from the cart based on its ID
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $itemId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    // Reset array keys after item removal
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}


if (isset($_POST['woocommerce_checkout_place_order'])) {
    // Data to be inserted into the 'Orders' table
    $orderdate = date('Y-m-d H:i:s'); // Get the current date and time
    $subscribedby = $_POST['subscribedby']; // Replace with how you determine this
    $subscriberid = $_POST['subscriberid']; // Replace with how you determine this
    $paymentstatus = 'notpaid';
    $paymentdetails = ''; // You can populate this with payment details
    $total = $_POST['total']; // Replace with how you calculate the total
    $couponcode = $_POST['couponcode']; // Get the coupon code from the form
    $discount = 0; // Calculate or set the discount amount
    $grandtotal = $total - $discount;

    $insertOrderQuery = "INSERT INTO Orders (orderdate, subscribedby, subscriberid, paymentstatus, paymentdetails, total, couponcode, discount, grandtotal,createdOn)
            VALUES ('$orderdate', '$subscribedby', '$subscriberid', '$paymentstatus', '$paymentdetails', '$total', '$couponcode', '$discount', '$grandtotal',NOW())";

    if ($con->query($insertOrderQuery) === TRUE) {
        $orderId = $con->insert_id; // Get the ID of the newly inserted order
        $cartData = json_decode($_POST['cart'], true);

        foreach ($cartData as $item) {
            $courseId = $item['id']; // Assuming your cart data has an 'id' field for course ID
            $qty = $item['quantity'];
            $rate = $item['price'];

            // Insert data into the 'Orderdetails' table for each item
            $insertOrderDetailsQuery = mysqli_query($con, "INSERT INTO Orderdetails (OrderId, CourseId, quantity, price, createdOn) VALUES ($orderId, $courseId, $qty, $rate,NOW())");
        
            if ($insertOrderDetailsQuery) {
                header("Location:../web/courselist.php");
            } else {
                echo "failed";
            }
        }

        // Redirect to a thank you page or show a success message
        echo "Order placed successfully!";
    } else {
        // Handle the error
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}

/// fetch.php

// Assuming you have a parameter like 'page' for pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5; // Number of courses per page

// Assuming you have the subtopic ID in $_GET['subtopicId']
$subtopicId = $_GET['subtopicId'];

// Calculate the offset based on the page number
$offset = ($page - 1) * $perPage;

// Query to fetch paginated courses for the selected subtopic
$query = mysqli_query($con, "SELECT * FROM courses WHERE subTopicId = $subtopicId LIMIT $perPage OFFSET $offset");

// Get the total number of courses for the selected subtopic
$totalCourses = mysqli_num_rows($query);

// Calculate the total number of pages
$totalPages = ceil($totalCourses / $perPage);

// Loop through the result and generate HTML for courses
// ... (similar to your existing code)

// Generate pagination links HTML
$paginationHTML = '<nav class="woocommerce-pagination">';
$paginationHTML .= '<ul class="page-numbers">';

// Generate Previous link
if ($page > 1) {
    $paginationHTML .= '<li><a class="page-numbers" href="?subtopicId=' . $subtopicId . '&page=' . ($page - 1) . '">←</a></li>';
}

// Generate individual page numbers
for ($i = 1; $i <= $totalPages; $i++) {
    $paginationHTML .= '<li><a class="page-numbers' . ($page == $i ? ' current' : '') . '" href="?subtopicId=' . $subtopicId . '&page=' . $i . '">' . $i . '</a></li>';
}

// Generate Next link
if ($page < $totalPages) {
    $paginationHTML .= '<li><a class="page-numbers" href="?subtopicId=' . $subtopicId . '&page=' . ($page + 1) . '">→</a></li>';
}

$paginationHTML .= '</ul></nav>';

// Echo the pagination HTML
echo $paginationHTML;

?>
<script>
$('.add_to_cart_button').click(function(e) {
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

$(document).ready(function() {
    updateCartCount(); // Call this on page load to set the initial cart count
});
function getCartItems() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

// Example: Get the cart items and do something with them
var cartItems = getCartItems();
cartItems.forEach(function(item) {
    // Do something with each item, e.g., display in a cart summary
});

// ...
</script>
