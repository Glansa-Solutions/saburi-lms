<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row1 d-flex">
                        <div class="form-group">
                            <label for="banner_title">Meta Title</label>
                            <input type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="Enter Meta Title">
                        </div>
                        <div class="form-group px-4">
                            <label for="banner_title">Main Title</label>
                            <input type="text" class="form-control" id="exampleInputUsername1"
                                placeholder="Enter Main Title">
                        </div>
                    </div>
                    <div class="row2 d-flex">
                        <div class="form-group">
                            <label for="banner_desc">Main Description</label>
                            <textarea class="rte">
                            Welcome to Saburi LMS
                                    </textarea>
                        </div>
                        <div class="form-group px-4">
                            <label for="banner_desc">Short Description</label>
                            <textarea class="rte">
                            Welcome to Saburi LMS
                                    </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content ends -->

<?php

include('includes/footer.php');

?>