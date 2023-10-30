<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Student Details</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Date Of Birth</th>
                                    <th>State</th>
                                    <th>Institue Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Aadhar</th>
                                    <th>District</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pradip Kathar</td>
                                    <td>8446634534</td>
                                    <td>25/11/2000</td>
                                    <td>Maharastra</td>
                                    <td>NIT</td>
                                    <td>katharp25@gmail.com</td>
                                    <td>Male</td>
                                    <td>989809876567</td>
                                    <td>Pune</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2">Edit</button>
                                        <button class="btn btn-danger p-2">Delete</button>
                                        <button class="btn btn-success p-2">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
