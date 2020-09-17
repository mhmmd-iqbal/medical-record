<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Obat
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Master Data </li>
        <li class="active">Data Obat </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-3">
              <a href="#create_new" data-toggle="modal" class="btn btn-success">Create New</a>          
            </div>
            <div class="col-md-9">
              <?php if(isset($sukses)): ?>
              <h5 class="text-success"><?=$sukses?> </h5>
              <?php endif; ?>
              <?php if(isset($error)): ?>
              <h5 class="text-success"><?=$error?> </h5>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Obat</th>
                      <th>Harga Obat</th>
                      <th>Keterangan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($obat as $data): ?>
                    <tr>
                      <td><?=$no ?></td>
                      <td><?=$data['nama_obat'] ?></td>
                      <td>Rp. <?=$data['harga'] ?></td>
                      <td><?=$data['keterangan_obat'] ?></td>
                      <td class="text-center">
                        <a href="#edit<?=$no?>" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        <?php if ($level_user == 'admin'): ?>
                        <a href="#hapus<?=$no?>" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <div class="modal fade" id="edit<?=$no?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Tambah Data Obat</h4>
                          </div>
                          <form action="<?=site_url()?>/Welcome/crud/edit/obat/<?=$data['id_obat']?>" method="POST" role="form">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Nama Obat</label>
                                  <input type="text" value="<?=$data['nama_obat']?>" maxlength="20" class="form-control" name="nama_obat">
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Harga</label>
                                  <input type="number" value="<?=$data['harga']?>" maxlength="20" class="form-control" name="harga">
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Keterangan</label>
                                  <input type="text" value="<?=$data['keterangan_obat']?>" maxlength="20" class="form-control" name="keterangan_obat">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- HAPUS -->
                    <div class="modal fade" id="hapus<?=$no?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Hapus Data Obat</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <h5>Apakah anda yakin akan menghapus data ini ?</h5>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="<?=site_url()?>/Welcome/crud/delete/obat/<?=$data['id_obat']?>" class="btn btn-danger">Hapus Data</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
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

<div class="modal fade" id="create_new">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Data Obat</h4>
      </div>
      <form action="<?=site_url()?>/Welcome/crud/create_new/obat" method="POST" role="form">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nama Obat</label>
              <input type="text" maxlength="20" class="form-control" name="nama_obat">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Harga</label>
              <input type="number" maxlength="20" class="form-control" name="harga">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" maxlength="20" class="form-control" name="keterangan_obat">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>

