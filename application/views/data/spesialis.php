<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Spesialisasi Kedokteran
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Master Data </li>
        <li class="active">Data Spesialisasi </li>
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
                      <th>Spesialisasi Kedokteran</th>
                      <th>Jumlah Spesialisasi Kedokteran</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($spesialis as $data): ?>
                    <tr>
                      <td><?=$no ?></td>
                      <td><?=$data['spesialisasi'] ?></td>
                      <td><?=($data['jumlah']>0?$data['jumlah']:'Tidak Ada')?> Dokter Spesialis</td>
                      <td class="text-center">
                        <a href="#edit<?=$no ?>" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        <a href="#hapus<?=$no ?>" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                      </td>
                    </tr>
                    <!-- EDIT -->
                     <div class="modal fade" id="edit<?=$no?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Edit Data Spesialisasi Kedokteran</h4>
                          </div>
                          <form action="<?=site_url()?>/Welcome/crud/edit/spesialisasi/<?=$data['id_spesialisasi']?>" method="POST" role="form">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Spesialisasi Kedokteran</label>
                                  <input type="text" maxlength="20" class="form-control" name="spesialisasi" value="<?=$data['spesialisasi']?>">
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
                            <h4 class="modal-title">Hapus Data Spesialisasi Kedokteran</h4>
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
                            <a href="<?=site_url()?>/Welcome/crud/delete/spesialisasi/<?=$data['id_spesialisasi']?>" class="btn btn-danger">Hapus Data</a>
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

 <!-- EDIT -->
                   

<div class="modal fade" id="create_new">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Data Spesialisasi Kedokteran</h4>
      </div>
      <form action="<?=site_url()?>/Welcome/crud/create_new/spesialisasi" method="POST" role="form">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Spesialisasi Kedokteran</label>
              <input type="text" maxlength="20" class="form-control" name="spesialisasi">
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