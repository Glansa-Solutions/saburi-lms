<?php
include("includes/header.php");
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
                    <h1>Careers</h1>
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

<section class="section-padding course-grid">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="section-heading center-heading">
                    <span class="subheading">Top Trending Courses</span>
                    <h3>Over 200+ New Online Courses</h3>
                </div>
            </div>
        </div>
        <div class="text-center">
            <ul class="course-filter">
                <li class="active"><a href="#" data-filter="*"> All</a></li>
                <?php
                $counter = 0;
                    if ($categoryQuery->num_rows > 0) {
                    while ($row = $categoryQuery->fetch_assoc()) {
                        echo '<li><a href="#" data-filter=".'.$row['id'].'">' . $row['name']. '</a></li>';
                    }
                } else {
                    echo '<p>No Subtopics found.</p>';
                }
                ?>
            </ul>
        </div>
        
        <div class="row course-gallery ">
            <?php
                if ($careerQuery->num_rows > 0) {   
                              
                while ($row = $careerQuery->fetch_assoc()) {
                    $id=$row['Id']; 
                    echo '<div class="course-item '.$row['categoryId'].' col-lg-4 col-md-6">';
                    echo '<div class="course-block">';
                    echo '<div class="course-content">';
                    echo '<div class="course-price ">'.$row['Title'].'</div>';
                    echo 'Experience:'.$row['Experience'].'';
                    echo '<div class="rating">';
                    echo '</div>';
                    echo '<p>'. substr($row['Description'], 0, 100) .'</p>';
                    echo '<div class="course-footer d-lg-flex align-items-center">';
                    // echo '<div class="course-meta">';
                    // echo '</div>';

                    echo '<div class="buy-btn text-center"><a href="careerName.php?c_id=' . $id . '" class="btn btn-main-2 btn-small">Apply</a></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    
                }
            } else {
                echo '<p>No Courses found.</p>';
            }
            ?>
            </div>
        </div>
        </div>


<?php
include("includes/footer.php");
?>