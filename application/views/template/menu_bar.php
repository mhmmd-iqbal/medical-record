<?php
$level_user = $this->session->userdata('level');
if (isset($level_user)) {
  $data['level_user'] = $this->session->userdata('level');
}
?>

<header class="main-header">
    <!-- Logo -->
    <a href="<?=site_url()?>" class="logo">
      <div class="row">
        <div class="col-md-2">
          <!-- <img src="" width="40px" height=""> -->
        </div>
        <div class="col-md-10">
          <b>Rekam Medik</b>
        </div>
      </div>
    </a>
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="<?=site_url()?>/Welcome/logout" class="btn"><i class="fa fa-power-off"></i> Keluar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HOME</li>
        <li><a href="<?=site_url()?>/Welcome/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if ($level_user == 'admin'): ?>
            <li><a href="<?=site_url()?>/Welcome/crud/view_all/spesialis"><i class="fa fa-circle-o"></i>Data Spesialis</a></li>
            <li><a href="<?=site_url()?>/Welcome/crud/view_all/poliklinik"><i class="fa fa-circle-o"></i>Data Poliklinik</a></li>
            <li><a href="<?=site_url()?>/Welcome/crud/view_all/dokter"><i class="fa fa-circle-o"></i>Data Dokter</a></li>  
            <?php endif; ?>
            <li><a href="<?=site_url()?>/Welcome/crud/view_all/obat"><i class="fa fa-circle-o"></i>Data Obat</a></li>
            <li><a href="<?=site_url()?>/Welcome/crud/view_all/pasien"><i class="fa fa-circle-o"></i>Data Pasien</a></li>
          </ul>
        </li>        
        <li class="header">NAVIGASI</li>
        <?php if ($level_user == 'dokter'): ?>
        <li><a href="<?=site_url()?>/Welcome/diagnosa/open_form"><i class="fa fa-search"></i> <span>Diagnosa Awal</span></a></li>
        <li><a href="<?=site_url()?>/Welcome/crud/view_all/perawatan"><i class="fa fa-plus"></i> <span>Perawatan Pasien</span></a></li>
        <?php endif ?>
        <li><a href="<?=site_url()?>/Welcome/crud/view_one/rekam_medik"><i class="fa fa-user"></i> <span>Rekam Medik Pasien</span></a></li>
        <li><a href="<?=site_url()?>/Welcome/logout"><i class="fa fa-power-off"></i> <span>Keluar</span></a></li>
      </ul>
    </section>
  </aside>