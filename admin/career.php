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
                    <h4 class="card-title">Career Page</h4>
                    
                   
                    <form class="forms-sample" action="functions/functions" method="POST">
                    <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title"
                                placeholder="Enter Title ">
                        </div>
                    <div class="form-group">
                            <label for="exp">Years of Experience	</label>
                            <input type="number" class="form-control" name="exp"
                                placeholder="Enter Years of Experience">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="rte" name="desc">
                                        Welcome to Saburi LMS
                                    </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary me-2" name="career_manage">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Career List</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th> Title </th>
                                <th> Years Of Exp </th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($fetch_list_careers_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_careers_query))
                                {
                                    $title=$row['Title'];
                                    $experience=$row['Experience'];
                                    $description=$row['Description'];
                                    ?>
                                    <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $title; ?></td>
                                    <td><?= $experience; ?></td>
                                    <td><?= $description; ?></td>
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
<!-- Main Content ends -->

<?php

include('includes/footer.php');

?>