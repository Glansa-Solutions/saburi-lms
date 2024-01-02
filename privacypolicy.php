<?php
include("includes/header.php");
if ($fetch_privacy_query) {
    $row = mysqli_fetch_assoc($fetch_privacy_query);
    $title = $row['Title'];
    $desc_content = $row['Description'];
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
                    <h1>
                        <?= $filename; ?>
                    </h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">

                            <a href="<?= $mainlink; ?>">Home</a>
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
<section class="py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1>PrivacyPolicy</h1>
                <p class="mt-4 ">
                    <?= $desc_content; ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php
include("includes/footer.php");
?>