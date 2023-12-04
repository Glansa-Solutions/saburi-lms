<?php include("includes/header.php");
$srole = "students";
$crole = "company";
?>
<section class="section-padding">
    <div class="main">
        <div class="container mb-3">
            <div class="col-md-12 text-left">
                <div class="container-fluid">
                    <div class="saburi-text">Login as..</div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="container">
                <div class="col-md-12 d-flex">
                    <div class="col-md-6 text-center">
                        <div class="student_button">
                            <form id="studentForm" method="post" action="<?= $mainlink ?>core/sessions">
                                <input type="hidden" name="role" value="<?= $srole ?>">
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('studentForm').submit();">
                                    <div class="card student_card">
                                        <div class="card-body">
                                            <h1 name="student" id="student">STUDENT</h1>
                                            <img class="scholar-hat img-fluid w-25"
                                                src="assets/images/scholar-hat-image.png" alt="Scholar Hat">
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <div class="company_button">
                            <form id="companyForm" method="post" action="<?= $mainlink ?>core/sessions">
                                <input type="hidden" name="role" value="<?= $crole ?>">
                                <a href="javascript:void(0);"
                                    onclick="document.getElementById('companyForm').submit();">
                                    <div class="card company_card">
                                        <div class="card-body">
                                            <h1>COMPANY</h1>
                                            <img class="business-icon img-fluid w-25"
                                                src="assets/images/business-icon.png" alt="Business Icon">
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>