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
                    <h4 class="card-title">Testimonials</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th hidden></th>
                                    <th>Subscribed By</th>
                                    <th>Subscribed Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <?php
                            if($fetch_testimonials_query)
                            {
                                $i = 1;
                                while($row=mysqli_fetch_assoc($fetch_testimonials_query))
                                {
                                    $id = $row['id'];
                                    $subscribedBy=$row['subscribedBy'];
                                    $name=$row['name'];
                                    $companyName = $row['companyName'];
                                    $title = $row['title'];
                                    $description = $row['description'];
                                    $isActive = $row['isActive'];
                                    ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td class="edit_id" hidden><?= $id; ?>
                                    <td><?= $subscribedBy; ?></td>
                                    <td><?= $name ? $name : $companyName; ?></td>
                                    <td><?= $title; ?></td>
                                    <td><?= $description; ?></td>
                                    <td><?= $isActive == 1 ? 'Approved' : ($isActive == 2 ? 'Rejected' : 'Pending'); ?></td>
                                    
                                    <td>
                                    <button type="button" class="btn btn-success me-2 p-2 approval-btn"
                                                    data-id="<?= $id; ?>">Approval
                                            </button>
                                            <button type="button" class="btn btn-danger p-2 rejection-btn"
                                                    data-id="<?= $id; ?>">Rejected
                                            </button>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   $(document).ready(function () {
    $(".approval-btn").click(function () {
        var testimonialId = $(this).closest('tr').find('.edit_id').text();
        updateStatus(testimonialId, 1); // 'Approval' represents the status for approval
    });

    $(".rejection-btn").click(function () {
        var testimonialId = $(this).closest('tr').find('.edit_id').text();
        updateStatus(testimonialId, 2); // 'Pending' represents the status for rejection
    });

    function updateStatus(id, status) {
        $.ajax({
            type: "POST",
            url: "../core/testimonials.php",
            data: {id: id, status: status},
            success: function (response) {
                // Update the UI based on the response (if needed)
                console.log(response);
                window.location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Error updating status:", error);
            }
        });
    }
});

</script>
<?php
include('includes/footer.php');
?>
