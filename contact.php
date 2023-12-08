<?php
include("includes/header.php");
include("core/listgrid.php");

if($fetch_user_contact_details_query) {
    while($row = mysqli_fetch_assoc($fetch_user_contact_details_query)) {
        $id = $row['id'];
        $email = $row['email'];
        $phone_no = $row['phone_no'];
        $address = $row['address'];

    }
}
?>

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
                    <h1>Contact Us</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            <?= $filename; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-info section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading center-heading">
                    <span class="subheading">Contact Us</span>
                    <h3>Have any query?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur
                        adipisicing elit.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="contact-item">
                            <p>Email Us</p>
                            <h4>
                                <?= $email; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="contact-item">
                            <p>Make a Call</p>
                            <h4>
                                <?= $phone_no; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="contact-item">
                            <p>Corporate Office</p>
                            <h4>
                                <?= $address; ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form class="form-row" method="POST" action="core/allmailfun.php">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Your Name">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Email Address">
                                <input type="hidden" id="email" name="admin_email" placeholder="Enter Your Email"
                                    class="form-control" value="<?= $email; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Subject">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea id="message" name="message" cols="30" rows="6" class="form-control"
                                    placeholder="Your Message"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mt-4 text-right">
                            <button class="btn btn-main" type="submit" name="add">Send Message <i
                                    class="fa fa-angle-right ml-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center">

        </div>
    </div>
</section>
<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 4px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');
        var submitButton = document.querySelector('button[type="submit"]');

        function displayError(inputElement, errorMessage) {
            // Remove existing error message, if any
            var existingError = inputElement.nextElementSibling;
            if (existingError && existingError.classList.contains('error-message')) {
                existingError.remove();
            }

            // Create a new error message element
            var errorElement = document.createElement('div');
            errorElement.classList.add('error-message');
            errorElement.textContent = errorMessage;

            // Insert the error message below the input element
            inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
        }

        function removeError(inputElement) {
            // Remove existing error message, if any
            var existingError = inputElement.nextElementSibling;
            if (existingError && existingError.classList.contains('error-message')) {
                existingError.remove();
            }
        }

        function validateName() {
            var name = document.getElementById('name').value.trim();
            if (name === '') {
                displayError(document.getElementById('name'), 'Please enter your name.');
                return false;
            }
            // Check if the name contains any numbers
            if (/.*\d.*/.test(name)) {
                displayError(document.getElementById('name'), 'Name should not contain numbers.');
                return false;
            }
            removeError(document.getElementById('name'));
            return true;
        }

        function validateEmail() {
            var email = document.getElementById('email').value.trim();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '' || !emailRegex.test(email)) {
                displayError(document.getElementById('email'), 'Please enter a valid email address.');
                return false;
            }
            removeError(document.getElementById('email'));
            return true;
        }

        function validateSubject() {
            var subject = document.getElementById('subject').value.trim();
            if (subject === '') {
                displayError(document.getElementById('subject'), 'Please enter the subject.');
                return false;
            }
            removeError(document.getElementById('subject'));
            return true;
        }

        function validateMessage() {
            var message = document.getElementById('message').value.trim();
            if (message === '') {
                displayError(document.getElementById('message'), 'Please enter your message.');
                return false;
            }
            removeError(document.getElementById('message'));
            return true;
        }

        function validateForm() {
            var isNameValid = validateName();
            var isEmailValid = validateEmail();
            var isSubjectValid = validateSubject();
            var isMessageValid = validateMessage();

            if (!isNameValid || !isEmailValid || !isSubjectValid || !isMessageValid) {
                Swal.fire({
                    icon: 'error',
                    title: "Please fill in all required fields.",
                    showConfirmButton: false,
                    timer: 2000
                }); 
                return false;
            }

            return true;
        }

        submitButton.addEventListener('click', function (event) {
            // Validate the form before submitting
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        document.getElementById('name').addEventListener('blur', validateName);
        document.getElementById('email').addEventListener('blur', validateEmail);
        document.getElementById('subject').addEventListener('blur', validateSubject);
        document.getElementById('message').addEventListener('blur', validateMessage);
    });
</script>



<?php
include("includes/footer.php");
?>