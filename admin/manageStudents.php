<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student List Report</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date Of Birth</th>
                                    <th>District</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Gender</th>
                                    <th>Phone no</th>
                                    <th>Email</th>
                                    <th>Id Proof</th>
                                    <th>ID Proof Details</th>
                                    <th>Action</th> 

                                </tr>
                            </thead>
                            <?php
                            if($fetch_list_student_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_student_query))
                                {
                                    $id = $row['id'];
                                    $name=$row['name'];
                                    $dob = $row['DOB'];
                                    $address = $row['address'];
                                    $dist = $row['district'];
                                    $state = $row['state'];
                                    $pincode = $row['pincode'];
                                    $gender = $row['gender'];
                                    $user_phone = $row['phoneNumber'];
                                    $email = $row['email'];
                                    $idProof = $row['idProof'];
                                    $idProofDetails = $row['idProofDetails'];
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td class="edit_id" hidden><?= $id; ?>
                                    <td><?= $name; ?></td>
                                    <td><?= $address; ?></td>
                                    <td><?= $dob; ?></td>
                                    <td><?= $dist; ?></td>
                                    <td><?= $state; ?></td>
                                    <td><?= $pincode; ?></td>
                                    <td><?= $gender; ?></td>
                                    <td><?= $user_phone; ?></td>
                                    <td><?= $email; ?></td>
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
            <form action="../core/admin_functions.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" id="delete_id" name="delete_id">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="deleteStudent" id="delete_id">Delete</button>
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
