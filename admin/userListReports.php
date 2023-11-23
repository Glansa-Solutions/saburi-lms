<?php
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User List Report</h4>
                    <div clasas="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                <th>S.no</th>
                                    <th hidden></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone no</th>
                                    <th>Address</th>
                                    <th>UserType</th>
                                    

                                </tr>
                            </thead>
                            <?php
                            if($fetch_list_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_list_query))
                                {
                                    $id = $row['id'];
                                    $name=$row['Name'];
                                    $email = $row['Email'];
                                    $phone = $row['Phone'];
                                    $address = $row['Address'];
                                    $userType = $row['UserType'];
                                    
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td class="edit_id" hidden><?= $id; ?>
                                    <td><?= $name; ?></td>
                                    <td><?= $email; ?></td>
                                    <td><?= $phone; ?></td>
                                    <td><?= $address; ?></td>
                                    <td><?= $userType; ?></td>
                                    
                                    <!-- <td>
                                        <button type="submit" class="btn btn-primary me-2 p-2 edit-button"  data-bs-toggle="modal" data-bs-target="#editmodal"
                                        data-id="<?= $id; ?>">Edit</button>
                                        <button type="submit" class="btn btn-danger p-2 delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-id="<?= $id; ?>">Delete</button>

                                    </td> -->
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
