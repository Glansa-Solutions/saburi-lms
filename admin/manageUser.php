<?php
include('includes/header.php');
include('includes/sidebar.php');
include('functions/list_grid.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                    <!-- <h4 class="card-title">Default form</h4>
                        <p class="card-description">
                            Basic form layout
                        </p> -->
                    <form class="forms-sample row" action="functions/functions" method="POST">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" name="phoneNumber"
                                    placeholder="Enter Phone Number">
                            </div>

                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control" name="userType">
                                    <option value=-1>--select one--</option>
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userId">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                                <label for="userId">User ID</label>
                                <input type="text" class="form-control" name="user_id" placeholder="Enter user id">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control" name="address"
                                    placeholder="Enter Address"> </textarea>
                            </div>


                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2" name="user_manage">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage User</h4>

                    </style>
                    <div style="overflow-x: auto;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            if($fetch_list_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_query))
                                {
                                    $user_name=$row['Name'];
                                    $user_email = $row['Email'];
                                    $user_phone = $row['Phone'];
                                    $user_address = $row['Address'];
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $user_name; ?></td>
                                    <td><?= $user_email; ?></td>
                                    <td><?= $user_phone; ?></td>
                                    <td><?= $user_address; ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2">Edit</button>
                                        <button class="btn btn-danger p-2">Delete</button>
                                    </td>
                                </tr>


                                <?php
                            $i++;
                                }
                                
                            }else {
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

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html> -->

<?php

include('includes/footer.php');

?>