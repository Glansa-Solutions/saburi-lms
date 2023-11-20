<?php
include("includes/header.php");
// include('../functions/list_grid.php');

if (isset($_GET['id'])) {
    $careerId = $_GET['id'];
    $fetch_list_career_query = mysqli_query($con, "SELECT * FROM careers WHERE Id = $careerId");

    if ($fetch_list_career_query) {
        $careerData = mysqli_fetch_assoc($fetch_list_career_query);
        $id = $careerData['Id'];
        $title = $careerData['Title'];
        $exp = $careerData['Experience'];
        $desc = $careerData['Description'];
        $createdOn = $careerData['CreatedOn'];
    } else {
        // Handle the case where the query fails
        echo "Error fetching career data: " . mysqli_error($con);
        // exit();
    }
} else {
    // Handle the case where 'id' is not set in the URL
    echo "No career ID specified.";
    // exit();
}
?>

<!-- Rest of your HTML code here -->

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
                    <h1>Careers Name</h1>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            <a href="#">Careers</a>
                        </li>
                        <li class="list-inline-item">/</li>
                        <li class="list-inline-item">
                            Careers Name
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-single">
                    <div class="post-thumb">
                        <img src="assets/images/course/course3.jpg" alt="" class="img-fluid ">
                    </div>

                    <div class="single-post-content">
                        <div class="post-meta mt-4">
                            <span class="post-date"><i class="fa fa-calendar-alt mr-2"></i><?= $createdOn?></span>
                            <span><a href="#" class="post-author"><i class="fa fa-user mr-2"></i>Admin</a></span>
                        </div>
                        <h4 class="mt-4"><?= $title?></h4>
                        <p><?= substr($careerData['Description'], 0, 100)?></p>
                    </div>
                    <div class="single-tags">
                        <a class="btn" href="#" data-toggle="modal" data-target="#exampleModal">Apply</a>
                    </div>

                    <!-- <blockquote> -->
                    <!-- <div class="bg-success p-4 rounded">
                        <h3 class="mt-4 text-white">Requirements:</h3>
                        <p class="text-white">▶ At least 2 years of experience building mobile apps using React
                            Native
                        </p>
                        <p class="text-white">▶ Experience using designs (PSD, Sketch etc) and converting them to React
                            Native or CSS components</p>
                        <p class="text-white">▶ XCode and Android Studio experience is a must</p>
                        <p class="text-white">▶ Android (Java) and iOS (Swift) background preferred</p>
                        <p class="text-white">▶ Intermediate to advanced level CSS</p>
                        
                    </div> -->
                    <!-- </blockquote> -->

                </div>

            </div>

            <div class="col-md-4">
                <div class="blog-sidebar mt-5 mt-lg-0 mt-md-0" style="position: sticky; top: 0;">


                    <div class="widget widget_news">
                        <h4 class="widget-title">Latest Job Posts</h4>
                        <ul class="recent-posts">
                            <?php
      
        $latestJobQuery = mysqli_query($con, "SELECT * FROM careers ORDER BY CreatedOn DESC LIMIT 2"); // Adjust the query as needed

       
        if ($latestJobQuery) {
            // Loop through the results and display each job post
            while ($jobPost = mysqli_fetch_assoc($latestJobQuery)) {
                echo '<li>';
                
                echo '<div class="widget-post-body">';
                echo '<span>' . $jobPost['Title'] . '</span>';
                echo '</div>';
                echo '</li>';
            }
        } else {
            // Handle the case where the query fails
            echo "Error fetching latest job posts: " . mysqli_error($con);
        }
        ?>
                        </ul>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" class="w-100 rounded-1 p-4 border bg-white" action="./core/functions.php"
                        enctype="multipart/form-data">
                        <input required name="CareerId" type="hidden" value="<?= $id ?>" class="form-control"
                            placeholder="Enter Your Name" />
                        <label class="d-block mb-4">
                            <span class="form-label d-block">Your name</span>
                            <input required name="name" type="text" class="form-control"
                                placeholder="Enter Your Name" />
                        </label>

                        <label class="d-block mb-4">
                            <span class="form-label d-block">Phone</span>
                            <input required name="phone" type="phone" class="form-control"
                                placeholder="Enter Your number" />
                        </label>

                        <label class="d-block mb-4">
                            <span class="form-label d-block">Email address</span>
                            <input required name="email" type="email" class="form-control"
                                placeholder="Enter Your Email" />
                        </label>

                        <label class="d-block mb-4">
                            <span class="form-label d-block">Years of experience</span>
                            <select required name="experience" class="form-select">
                                <option>Less than a year</option>
                                <option>1 - 2 years</option>
                                <option>2 - 4 years</option>
                                <option>4 - 7 years</option>
                                <option>7 - 10 years</option>
                                <option>10+ years</option>
                            </select>
                        </label>

                        <label class="d-block mb-4">
                            <span class="form-label d-block">Tell us more about yourself</span>
                            <textarea name="message" class="form-control" rows="3"
                                placeholder="What motivates you?"></textarea>
                        </label>

                        <label class="d-block mb-4">
                            <span class="form-label d-block">Your CV</span>
                            <input required name="cv" type="file" class="form-control" />
                        </label>

                </div>
            </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="apply_job"> Apply</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<?php
include("includes/footer.php");
?>