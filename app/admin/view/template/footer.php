            <!-- partial:partials/_footer.html -->
            <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
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
    <script src="<?=base_url();?>assets/min/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?=base_url();?>assets/min/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=base_url();?>assets/min/js/off-canvas.js"></script>
    <script src="<?=base_url();?>assets/min/js/hoverable-collapse.js"></script>
    <script src="<?=base_url();?>assets/min/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?=base_url();?>assets/min/js/dashboard.js"></script>
    <script src="<?=base_url();?>assets/min/js/todolist.js"></script>
    <script src="<?=base_url();?>assets/min/js/moment-with-locales.min.js"></script>
    <script src="<?=base_url();?>assets/min/js/bootstrap-datepicker.min.js"></script>
    <!-- End custom js for this page -->
    <?php echo !empty($javascript) ? '<!-- Load js for this page -->'. $javascript. '<!--  END Load  js for this page -->' : "" ; // echo 'uwais';?>
    <!-- <?php // include 'script.php';?> -->
  </body>
</html>