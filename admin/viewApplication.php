<?php 
include('includes/header.php');
include('includes/sidebar.php');
include('../core/listgrid.php');


if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = mysqli_query($con, "SELECT * FROM careersapplications WHERE CareerId=$id");
    // $result = $con->query($sql);
    
}
 ?>
<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Application List</h4>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Experience</th>
                                <th>Attachment</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($sql)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($sql))
                                {
                                    $id=$row['Id'];
                                    $Name=$row['Name'];
                                    $Phone=$row['Phone'];
                                    $email=$row['Email'];
                                    $Experience=$row['Experience'];
                                    $Attachment=$row['Attachment'];
                                    // $description=$row['Email'];
                                    ?>
                            <tr>
                                <td><?= $i;?></td>
                                
                                <td><?= $Name; ?></td>
                                <td><?= $Phone; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $Experience; ?></td>
                                <td>
                                    <!-- Add a link to a download script -->
                                    <a href="<?= $Attachment ?>" download>

                                        <?= $Attachment; ?>
                                    </a>
                                
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