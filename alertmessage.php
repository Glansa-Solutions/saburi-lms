<?php include("includes/header.php");
?>

<section class="about-section section-padding about-2" id="alert">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Thank you</span>
                    <h3>
                        <?= $_SESSION['login_else_message']; ?>
                    </h3>
                </div>

                <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#resetLoginModal">
                    <i class="fa fa-check mr-2"></i>Reset Login
                </button>
                <div class="modal fade" id="resetLoginModal" tabindex="-1" aria-labelledby="resetLoginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter Your Mail Id</h4>
                                    <form>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email"
                                                value="<?= $_SESSION['prev_email']; ?>">
                                            <input type="hidden" class="form-control" id="prev_user_role_id"
                                                value="<?= $_SESSION['role_id']; ?>">
                                            <input type="hidden" class="form-control" id="prev_user_role"
                                                value="<?= $_SESSION['role']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-saburi btn-sm p-2"
                                                id="submit_only_email">Submit</button>
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
    $('#submit_only_email').on('click', function () {
        var email = $('#email').val();
        // alert(email);
        var roleid = $('#prev_user_role_id').val();
        var role = $('#prev_user_role').val();
        $.ajax({
            method: 'POST',
            url: 'core/prev_login.php',
            data: {
                'prev_login_email': email,
                'prev_user_role_id': roleid,
                'prev_user_role': role,
            },
            success: function (response) {
                alert(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
</script>
<?php include("includes/footer.php"); ?>