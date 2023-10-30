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
                    <h4 class="card-title">Affiliate Page</h4>
                    <!-- <p class="card-description">
                        You can Write the content for about page.
                    </p> -->
                   
                    <form class="forms-sample row" action="functions/functions" method="POST">
                      <div class="col-md-6">
                      <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <input type="text" class="form-control" name="details"
                                placeholder="Enter Details ">
                        </div>
                        <div class="form-group">
                            <label for="contactdetails">Contact Details</label>
                            <input type="text" class="form-control" name="contactdetails"
                                placeholder="Enter Contact Details ">
                        </div>
                      </div>
                       <div class="col-md-6">
                       <div class="form-group">
                            <label for="contactPerson">Contact Person</label>
                            <input type="text" class="form-control" name="contactPerson"
                                placeholder="Enter Contact Person ">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control " name="address"
                                placeholder="Enter Address ">
                        </div>
                        <button type="submit" class="btn btn-primary me-2" name="affiliate_manage">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Affiliate Grid List</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th> Company Name </th>
                                <th>Details</th>
                                <th>Contact Details</th>
                                <th>Contact Person</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($fetch_list_affiliate_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_affiliate_query))
                                {
                                    $companyName=$row['companyName'];
                                    $details=$row['details'];
                                    $contactDetail=$row['contactDetail'];
                                    $contactPerson=$row['contactPerson'];
                                    $address=$row['address'];
                                    // $img=$row['bannerImage'];
                                    // $file=$row['uploadfile'];
                                    // $video=$row['video'];
                                    ?>
                                    <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $companyName; ?></td>
                                    <td><?= $details; ?></td>
                                    <td><?= $contactDetail; ?></td>
                                    <td><?= $contactPerson; ?></td>
                                    <td><?= $address; ?></td>
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