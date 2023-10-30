<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pending Subscriptions report</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Date Of Birth</th>
                                    <th>Subscribed for</th>
                                    <th>Start Date</th>
                                    <th>Email</th>
                                    <th>Pending Subscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>xyz</td>
                                    <td>987654320</td>
                                    <td>1/1/2001</td>
                                    <td>java</td>
                                    <td>1/1/2023</td>
                                    <td>xyz@gmail.com</td>
                                    <td> Yes </td>
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
