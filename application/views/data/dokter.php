<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Dokter
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Master Data </li>
        <li class="active">Data Dokter </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-3">
              <?php if($level_user == 'admin'):?>
              <a href="#create_new" data-toggle="modal" class="btn btn-success">Create New</a>          
              <?php endif; ?>
            </div>
            <div class="col-md-9">
              <?php if(isset($sukses)): ?>
              <h5 class="text-success"><?=$sukses?> </h5>
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
                      <th>Kode</th>
                      <th>Nama Dokter</th>
                      <th>Spesialis</th>
                      <th>Klinik</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($dokter as $data): ?>
                    <tr>
                      <td><?=$no ?></td>
                      <td><?=$data['kode_dokter'] ?></td>
                      <td><?=$data['nama_dokter'] ?></td>
                      <td><?=$data['spesialisasi'] ?></td>
                      <td><?=$data['nama_klinik'] ?></td>
                      <td class="text-center">
                        <a href="#detail<?=$no?>" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                        <?php if($level_user == 'admin'):?>
                        <a href="#edit<?=$no?>" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        <a href="#reset<?=$no?>" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <!-- MODAL DETAIL START -->
                    <div class="modal fade" id="detail<?=$no?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center">Dokter <?=$data['nama_dokter']?></h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3"><b>Kode Dokter</b></div>
                              <div class="col-md-3"><?=$data['kode_dokter']?></div>
                              <div class="col-md-3"><b>Spesialisasi</b></div>
                              <div class="col-md-3"><?=$data['spesialisasi']?></div>
                            </div>
                            <div class="row">
                              <div class="col-md-3"><b>Klinik</b></div>
                              <div class="col-md-9"><?=$data['nama_klinik']?></div>
                            </div>
                            <div class="row">
                              <div class="col-md-3"><b>Jenis Kelamin</b></div>
                              <div class="col-md-9"><?=($data['jnsklmn_dokter']=='L')?'Laki-Laki':'Wanita'?></div>
                            </div>
                            <div class="row">
                              <div class="col-md-3"><b>Kontak HP</b></div>
                              <div class="col-md-9"><?=$data['hp_dokter']?></div>
                            </div>
                            <div class="row">
                              <div class="col-md-3"><b>Alamat</b></div>
                              <div class="col-md-9"><?=$data['alamat_dokter']?></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- MODAL DETAIL END -->

                    <!-- MODAL KONFIRMASI RESET PASSWORD START -->
                    <div class="modal fade" id="reset<?=$no?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Reset Password <?=$data['kode_dokter'] ?> ?</h4>
                          </div>
                          <div class="modal-body">
                            <small style="font-style: italic;">Password yang direset akan disesuaikan dengan 12345</small>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
                            <a href="<?=site_url()?>/Welcome/konfirmasi/<?=$data['kode_dokter']?>" class="btn btn-danger">Reset Password</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- MODAL KONFIRMASI RESET PASSWORD END -->
                    <!-- MODAL EDIT DATA START -->
                    <div class="modal fade" id="modal-id">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modal title</h4>
                          </div>
                          <div class="modal-body">
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- MODAL EDIT DATA END -->
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
        <h4 class="modal-title">Tambah Data Dokter</h4>
      </div>
      <form action="<?=site_url()?>/Welcome/crud/create_new/dokter" method="POST" role="form">
      <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Kode Dokter</label>
                <input type="text" class="form-control" name="kode" required="" maxlength="12" minlength="12">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" required="" maxlength="40">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <label for="">Spesialisasi</label>
                <select name="id_spesialis" class="form-control"> 
                <option disabled="" selected="">--Spesialisasi Dokter--</option>
                <?php foreach ($spesialis as $data): ?>
                  <option value=<?=$data['id_spesialisasi'] ?>> <?=$data['spesialisasi'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <label for="">Klinik</label>
                <select name="id_klinik" class="form-control"> 
                <option disabled="" selected="">--Poli Klinik--</option>
                <?php foreach ($poliklinik as $data): ?>
                  <option value=<?=$data['id_klinik'] ?>> <?=$data['nama_klinik'] ?></option>
                <?php endforeach ?>
                </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-4">
              <input type="radio" name="jns_klm" value="L" checked="">Laki - Laki
              <input type="radio" name="jns_klm" value="P">Perempuan
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <label for="">HP</label>
                <input type="text" name="hp" class="form-control" maxlength="15">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <label for="">Alamat</label>
                <textarea  name="alamat" class="form-control"></textarea>
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