<footer class="main-footer">
<strong>Copyright &copy; 2024 <a href="http://localhost/sismedoc/"> <?php echo $row['razon']?></a>.</strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="/sismedoc/public/assets/plugins/jquery/jquery.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="/sismedoc/public/assets/dist/js/adminlte.js"></script>
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/sismedoc/public/assets/js/main.js"></script> 
<!-- DataTables  & Plugins -->
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/sismedoc/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script>
 
  $('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    endDate: "<?php echo date("d/m/Y");?>",
    autoclose: true
  });

</script>
</html>
