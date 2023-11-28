<?php include("includes/header.php");

?>

<section class="about-section section-padding about-2">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Hey User</span>
                    <h3>
                        Don't worry, you can get your password here.
                    </h3>
                </div>

                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#resetLoginModal">
                    <i class="fa fa-key mr-2"></i>Get Your Login Password
                </button>
                <div class="modal fade" id="resetLoginModal" tabindex="-1" aria-labelledby="resetLoginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter your registerd email Id</h4>
                                    <form>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email" placeholder="Enter your registerd email">
                                            <input type="hidden" class="form-control" id="f_role" value="<?= $_SESSION['f_role']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-saburi btn-sm p-2"
                                                id="submit_email_forgotPass">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-img2">
                    <img src="assets/images/bg/choose.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#submit_email_forgotPass').on('click', function () {
        var email = $('#email').val();
        var f_role = $('#f_role').val();
        $.ajax({
            method: 'POST',
            url: 'core/forgot_login.php',
            data: {
                'forgot_login_email': email,
                'f_role': f_role,
            },
            success: function (response) {
                window.location.href = './';
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
</script>
<?php include("includes/footer.php"); ?>