<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h5 class="text-uppercase">Selamat datang <?=$nama?>, Anda Login sebagai <?=$level?></h5>
      <h1>Dashboard
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title text-center">Master Data</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <a href="<?=site_url()?>/Welcome/crud/view_all/pasien">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Pasien</span>
                  <span class="info-box-number"><h3 id="pasien"></h3></span>
                </div>
              </div>  
              </a>
            </div>
            <?php if ($level == 'admin'): ?>
            <div class="col-md-3">
              <a href="<?=site_url()?>/Welcome/crud/view_all/dokter">
              <div class="info-box bg-light-blue">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Dokter</span>
                  <span class="info-box-number"><h3 id="dokter"></h3></span>
                </div>
              </div>  
              </a>
            </div>
            <?php endif ?>

            <div class="col-md-3">
              <a href="<?=site_url()?>/Welcome/crud/view_all/obat">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-th-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Obat</span>
                  <span class="info-box-number"><h3 id="obat"></h3></span>
                </div>
              </div>  
              </a>
            </div>
            <?php if ($level == 'admin'): ?>
            <div class="col-md-3">
              <a href="<?=site_url()?>/Welcome/crud/view_all/poliklinik">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-home"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Poli Klinik</span>
                  <span class="info-box-number"><h3 id="poliklinik"></h3></span>
                </div>
              </div>  
              </a>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title text-center">Navigasi Menu</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <?php if ($level == 'dokter'): ?>
            <div class="col-md-4">
               <a href="<?=site_url()?>/Welcome/diagnosa/open_form">
                <div class="info-box bg-blue">
                  <span class="info-box-icon"><i class="fa fa-search"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text text-center"><h4>DIAGNOSA</h4></span>
                    <span class="info-box-text text-center"><h4>AWAL</h4></span>
                  </div>
                </div>  
              </a>
            </div>
            <div class="col-md-4">
               <a href="<?=site_url()?>/Welcome/crud/view_all/perawatan">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="fa fa-plus"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text text-center"><h4>PERAWATAN</h4></span>
                    <span class="info-box-text text-center"><h4>PASIEN</h4></span>
                  </div>
                </div>  
              </a>
            </div>
            <?php endif; ?>
            <div class="col-md-4">
               <a href="<?=site_url()?>/Welcome/crud/view_one/rekam_medik">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="fa fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text text-center"><h4>REKAM MEDIK</h4></span>
                    <span class="info-box-text text-center"><h4>PASIEN</h4></span>
                  </div>
                </div>  
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <footer class="main-footer">
    <strong>Copyright</strong> Teknik Informatika&copy;2019. 
  </footer>
</div>
<!-- ./wrapper -->

<?php $this-> load-> view('template/footer') ?>
</body>
</html>

<script type="text/javascript">
  $.ajax({
    url     : '<?=site_url()?>/Welcome/jml_data_home',
    type    : 'ajax',
    dataType: 'json',
    async   : false,
    success  : function(data) {
      $('#pasien').html(data['pasien']);
      $('#dokter').html(data['dokter']);
      $('#obat').html(data['obat']);
      $('#poliklinik').html(data['poliklinik']);
    }
  })
  
</script>