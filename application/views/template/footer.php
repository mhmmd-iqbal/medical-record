<!-- <script type="text/javascript" src="<?php echo base_url() ?>/assets/js/jquery.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets/template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/template/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>assets/template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function () {
    $('#tabel-data').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
  </script>
  <!-- BOOTSTRAP DATEPICKER PLUGIN -->
  <script type="text/javascript" src="<?=base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
  </script>
  <!-- SELECT2 PLUGIN -->
<script type="text/javascript" src="<?php echo base_url() ?>/assets/select2/dist/js/select2.js"></script>
<script>
  $(document).ready(function () {
      $("#penduduk").select2({
          // placeholder: "Please Select"
    });
  });
</script>
<script>
  $(document).ready(function () {
      $("#desa").select2({
          // placeholder: "Please Select"
    });
  });
</script>
<!-- SESUAIKAN UKURAN SELECT2 PLUGIN DI BOOTSTRAP -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#select2").select2();
    $(window).resize(function() {
      $('#select2').css('width', "100%");
    });
    })
</script>