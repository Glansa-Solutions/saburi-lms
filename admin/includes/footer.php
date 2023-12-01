<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
            BootstrapDash.</span> -->
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All
            rights reserved. Saburi LMS</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="./assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="./assets/vendors/chart.js/Chart.min.js"></script>
<script src="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="./assets/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="./assets/js/off-canvas.js"></script>
<script src="./assets/js/hoverable-collapse.js"></script>
<script src="./assets/js/template.js"></script>
<script src="./assets/js/settings.js"></script>
<script src="./assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="./assetsjs/jquery.cookie.js" type="text/javascript"></script>
<script src="./assetsjs/dashboard.js"></script>
<script src="./assetsjs/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->

<!-- Rich Text Editor -->
<script type="text/javascript" src="assets/vendors/richtexteditor/rte.js"></script>
<script type="text/javascript" src='assets/vendors/richtexteditor/plugins/all_plugins.js'></script>

<!-- data table -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#example');
</script>
<!-- flora scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>
<!-- <script type="text/javascript" src="./assets/vendors/summernote@0.8.18/js/summernote-lite.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function () {
        $(".mySummernote").summernote({
            height: 250
        });
        $('.dropdown-toggle').dropdown();
    });
    // accepting only numbers functions

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    // (function () {
    //     new FroalaEditor("#edit")
    //     new FroalaEditor("#edt")

    // })()
    //accepting only text functions

    function isText(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        // Allow letters and spaces
        if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode === 32) {
            return true;
        } else {
            return false;
        }
    }
</script>



<script>

</script>

</body>

</html>