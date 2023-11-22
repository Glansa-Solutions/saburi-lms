<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Bulk Registration</h4>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Company Name</th>
                                    <th>Contact Name</th>
                                    <th>Company Mobile</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>District</th>
                                    <th>Country Name</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Id Proof</th>
                                    <th>Id Proof Details</th>   
                                    <th>Action</th>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                                if ($fetch_list_company_query) {
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($fetch_list_company_query)) {
                                        $id = $row['id'];
                                        $companyName = $row['companyName'];
                                        $contactName = $row['contactName'];
                                        $companyPhone = $row['companyPhone'];
                                        $email = $row['email'];
                                        $address = $row['address'];
                                        $district = $row['district'];
                                        $country_id = $row['country_name'];
                                        $state = $row['state'];
                                        $pinCode = $row['pincode'];
                                        $idProof = $row['idProof'];
                                        $idProofDetails = $row['idProofDetails'];
                                        // $id = $row['id'];
                                ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td class="edit_id" hidden><?= $id;?></td>
                                            <td><?= $companyName; ?></td>
                                            <td><?= $contactName; ?></td>
                                            <td><?= $companyPhone; ?></td>
                                            <td><?= $email; ?></td>
                                            <td><?= $address; ?></td>
                                            <td><?= $district; ?></td>
                                            <td><?= $country_id; ?></td>
                                            <td><?= $state; ?></td>
                                            <td><?= $pinCode; ?></td>
                                            <td><?= $idProof; ?></td>
                                            <td><?= $idProofDetails; ?></td>
                                            <td>
                                        <!-- <button type="submit" class="btn btn-primary me-2 p-2 edit-button"  data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $id; ?>">Edit</button> -->
                                        <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-id="<?= $id; ?>">Delete</button>

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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../core/functions.php" method="POST">

                <div class="modal-body">

                    <input type="text" id="delete_id" name="delete_id">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="deletebulk">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-button').on('click', function (e) {
            e.preventDefault();
            var asses_id = $(this).closest('tr').find('.edit_id').text();

            console.log(asses_id);
            $('#delete_id').val(asses_id);
            $('#deleteModal').modal('show');

        });
    });
</script>
<?php
include('includes/footer.php');
?>
