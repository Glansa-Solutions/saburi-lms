<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<!-- Include SheetJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="details d-flex justify-content-between mb-3">
                        <h4 class="card-title">Courses List report</h4>
                        <button class="btn btn-success" onclick="exportToExcel()">Export to Excel</button>
                    </div>

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
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($fetch_course_list_report)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $i ?>
                                            </td>
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
<script>
    function exportToExcel() {
        var table = document.getElementById("example");

        // Convert the table data to an array
        var data = [];
        var rows = table.getElementsByTagName("tr");
        var headerRow = [];
        // here taking the headers data and fetching the innertext--
        var headerCells = rows[0].getElementsByTagName("th");
        // console.log(headerCells);
        for (var k = 0; k < headerCells.length; k++) {
            headerRow.push(headerCells[k].innerText);
        }
        // pushing the headers
        data.push(headerRow);

        // Add data (td) to the data array
        for (var i = 1; i < rows.length; i++) {
            var row = [];
            var cells = rows[i].getElementsByTagName("td");
            for (var j = 0; j < cells.length; j++) {
                row.push(cells[j].innerText);
            }
            // pushing the rows data
            data.push(row);
        }

        // Creating a worksheet from the data push
        var ws = XLSX.utils.aoa_to_sheet(data);

        // Apply styles to the worksheet
        var range = XLSX.utils.decode_range(ws['!ref']);
        for (var R = range.s.r; R <= range.e.r; ++R) {
            for (var C = range.s.c; C <= range.e.c; ++C) {
                var cell_address = { c: C, r: R };
                var cell = ws[XLSX.utils.encode_cell(cell_address)];

                // Example: Apply border to all cells
                cell.s = { border: { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } } };
            }
        }

        // Create a workbook with the styled worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "CoursesListReport");

        // Save the workbook to a file
        XLSX.writeFile(wb, 'CoursesListReport.xlsx');
    }
</script>

<?php
include('includes/footer.php');
?>