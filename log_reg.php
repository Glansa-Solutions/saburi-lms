<?php include("includes/header.php"); ?>

<section class="section-padding">
    <div class="main">
        <div class="row">
            <div class="container">
                <div class="col-md-12 d-flex">
                    <div class="col-md-6 text-center">
                        <div class="student_button">
                            <a href="<?= $mainlink?>account?role=student">
                                <div class="card student_card">
                                    <div class="card-body">
                                        <h1 name="student" id="student">STUDENT</h1>
                                        <img class="scholar-hat img-fluid w-25" src="assets/images/scholar-hat-image.png" alt="Scholar Hat">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="company_button">
                            <a href="<?= $mainlink?>account?role=company">
                                <div class="card company_card">
                                    <div class="card-body">
                                        <h1>COMPANY</h1>
                                        <img class="business-icon img-fluid w-25" src="assets/images/business-icon.png" alt="Business Icon">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>