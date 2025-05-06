<footer class="main-footer">
  <strong>Copyright &copy; <?= date('Y')?> <a href="https://adminlte.io">DigitalShakha</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <!-- <b>Version</b> 3.1.0 -->
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/jquery/jquery.js") ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url("assets/plugins/jquery-ui/jquery-ui.min.js") ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url("assets/plugins/chart.js/Chart.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url("assets/dist/js/adminlte.js") ?>"></script>
<!-- AdminLTE for demo purposes -->

<script src="<?php echo base_url("assets/plugins/sweetalert2/sweetalert.min.js") ?>"></script>

<!-- overlayScrollbars -->
<script src="<?php echo base_url("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") ?>"></script>

<script src="<?php echo base_url("assets/plugins/datatables/jquery.dataTables.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-buttons/js/dataTables.buttons.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-buttons/js/buttons.html5.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-buttons/js/buttons.print.min.js") ?>"></script>
<script src="<?php echo base_url("assets/plugins/datatables-buttons/js/buttons.colVis.min.js") ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


<script>
  // code for dynamic sidebar active //
  document.addEventListener("DOMContentLoaded", function() {
    const currentUrl = window.location.href;
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
      if (link.href === currentUrl) {
        // Make the current link active
        link.classList.add('active');

        // Find the parent <li> with class 'nav-item'
        const parentNavItem = link.closest('.nav-base');

        if (parentNavItem) {
          parentNavItem.classList.add('menu-open'); // Keep parent menu expanded

          // Find the parent link with class 'nav-parent'
          const parentLink = parentNavItem.querySelector('.nav-parent');
          if (parentLink) {
            parentLink.classList.add('active');
          }
        }
      }
    });
  });
</script>
</body>

</html>