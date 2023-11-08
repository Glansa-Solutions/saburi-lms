<?php include("includes/header.php"); ?>
<style>
.company_card,
.student_card {
    background-color: #ededed;
    border: none;
    border-radius: 0;
    position: relative;
    transition: transform 0.3s ease;
    /* Add a smooth transition for the transform property */
}

.company_card:hover {
    background-color: #E9770E;
    border-radius: 5px;
    color: white;
    transform: translateY(10px);
    /* Move the card down by 10px when hovered */
}

.student_card:hover {
    background-color: #E9770E;
    border-radius: 5px;
    color: white;
    transform: translateY(10px);
    /* Move the card down by 10px when hovered */
}

.student_card h1,
.company_card h1 {
    position: relative;
    z-index: 1;
}

.student_card .scholar-hat {
    position: absolute;
    top: -30px;
    /* Adjust the position as needed */
    left: 0;
    opacity: 0;
    transition: all 0.3s ease;
    /* Add a smooth transition */
}

.student_card:hover .scholar-hat {
    top: -60px;
    /* Adjust the position as needed */
    opacity: 1;
}

.company_card .business-icon {
    position: absolute;
    top: -30px;
    /* Adjust the position as needed */
    left: 0;
    opacity: 0;
    transition: all 0.3s ease;
    /* Add a smooth transition */
}

.company_card:hover .business-icon {
    top: -60px;
    /* Adjust the position as needed */
    opacity: 1;
}
</style>

<section class="section-padding">
    <div class="main">
        <div class="row">
            <div class="container">
                <div class="col-md-12 d-flex">
                    <div class="col-md-6 text-center">
                        <div class="student_button">
                            <a href="<?= $mainlink?>account">
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
                            <a href="<?= $mainlink?>account">
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