<script>
document.addEventListener('DOMContentLoaded',function() {
            // Add click event listener to the "Add to Cart" button
            var addToCartButton = document.querySelector('.add_to_cart_button');
            if
                (addToCartButton) {
                addToCartButton.addEventListener('click',
                    function
                        (event) {
                        //
                        Add
                        your
                        logic
                        to
                        handle
                        adding
                        the
                        item
                        to
                        the
                        cart
                        //
                        Display
                        the
                        success
                        message
                        using
                        SweetAlert
                        showSuccessMessage();
                    });
            }
            //
            Function
            to
            display
            the
            success
            message
            using
            SweetAlert
            function
                showSuccessMessage() {
                Swal.fire({
                    icon:
                        'success',
                    title:
                        'Course
Added
To
Cart
Successfully!',
showConfirmButton:
                    false,
                    timer:
                        3000
//
Hide
the
message
after
3
seconds
                });
            }
        });



</script>