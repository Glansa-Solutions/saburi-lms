<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Courses List report</h4>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Topic Name</th>
                                    <th>Sub Topic Name</th>
                                    <th>Course Name</th>
                                    <!-- <th>No. of chapters</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($fetch_course_list_report) {
                                    $i =0;
                                    while ($row = mysqli_fetch_array($fetch_course_list_report)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?= $i?></td>
                                            <td>
                                                <?php echo $row['topicName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['subTopicName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['courseName']; ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
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