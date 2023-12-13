<?php
include('includes/header.php');
include('includes/sidebar.php');
// include('../core/listgrid.php');
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
                                    $state = $row['stateName'];
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

<?php
include('includes/footer.php');
?>