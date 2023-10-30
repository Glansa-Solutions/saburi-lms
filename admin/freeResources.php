<?php
include('includes/header.php');
include('includes/sidebar.php');
include('functions/list_grid.php');
?>


<!-- Main Content Panel -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Free Resources Page</h4>
                    <!-- <p class="card-description">
                        You can Write the content for about page.
                    </p> -->
                   
                    <form class="forms-sample" action="functions/functions" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading"
                                placeholder="Enter Heading">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title"
                                placeholder="Enter Title ">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*">
                        </div>
                       
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="rte" name="desc">
                                        Welcome to Saburi LMS
                                    </textarea>
                        </div>
                       
                        <button type="submit" class="btn btn-primary me-2" name="freeResources_manage">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Free Resources List</h4>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th> Heading </th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($fetch_list_freeResources_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_freeResources_query))
                                {
                                    $resourcesName=$row['resourcesName'];
                                    $title=$row['title'];
                                    $image=$row['bannerImage'];
                                    $description=$row['description'];
                                    // $desc=$row['courseDesc'];
                                    // $img=$row['bannerImage'];
                                    // $file=$row['uploadfile'];
                                    // $video=$row['video'];
                                    ?>
                                    <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $resourcesName; ?></td>
                                    <td><?= $title; ?></td>
                                    <td><?= $image; ?></td>
                                    <td><?= $description; ?></td>
                                    <!-- <td><?= $desc; ?></td>
                                    <td><?= $img; ?></td>
                                    <td><?= $file; ?></td>
                                    <td><?= $video; ?></td> -->
                                    <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2">Edit</button>
                                        <button class="btn btn-danger p-2">Delete</button>
                                    </td>
                                    </tr>
                                    <?php
                            $i++;
                                }
                                } else {
                                    echo "Query failed!";
                                }
                            ?>
                        </tbody>
                    </table>
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