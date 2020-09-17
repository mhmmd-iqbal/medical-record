<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Pasien
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Master Data </li>
        <li class="active">Data Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <?php if ($level_user == 'admin'): ?>
            <div class="col-md-3">
              <a href="<?=site_url()?>/Welcome/crud/open_form/pasien" class="btn btn-success">Create New</a> 
            </div>  
            <?php endif ?>
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
                <table class="table table-hover table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Pasien</th>
                      <th>NIK</th>
                      <th>Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pasien as $data ): ?>
                    <tr>
                      <td><?=$no ?></td>
                      <td><?=$data['kode_pasien'] ?></td>
                      <td><?=$data['nama_pasien'] ?></td>
                      <td><?=$data['nik_pasien'] ?></td>
                      <td><div class="label label-<?=$data['label_color']?>"><?=$data['stat_perawatan'] ?></div></td>
                      <td class="text-center">
                        <a href="#detail" class="btn btn-sm btn-warning" onclick="detail(<?=$data['kode_pasien']?>)" data-toggle="modal"><i class="fa fa-eye"></i></a>
                        <?php if ($level_user == 'admin'): ?>
                        <a href="<?=site_url()?>/Welcome/crud/edit/pasien/<?=$data['kode_pasien'] ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                        <a href="#modaldelete<?=$data['kode_pasien']?>" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>  
                        <?php endif; ?>
                      </td>
                    </tr>

                    <!-- MODAL HAPUS -->
                    <div class="modal fade" id="modaldelete<?=$data['kode_pasien']?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Hapus Data <?=$data['nama_pasien']?></h4>
                          </div>
                          <div class="modal-body">
                            <h5>Apakah anda yakin akan menghapus data ini ?</h5>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <a href="<?=site_url()?>/Welcome/crud/delete/pasien/<?=$data['kode_pasien']?>" class="btn btn-danger">Hapus</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END MODAL HAPUS -->

                    <?php $no++; endforeach ?>
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

<div class="modal fade" id="detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title text-center" id="kodepasien"></h3>
      </div>
      <div class="modal-body">
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">Nama</h5></div>
          <div class="col-md-9"><h5 id="nama"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">NIK</h5></div>
          <div class="col-md-9"><h5 id="nik"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">Agama</h5></div>
          <div class="col-md-3"><h5 id="agama"></h5></div>
          <div class="col-md-3"><h5 style="font-weight: bold">Jenis Kelamin</h5></div>
          <div class="col-md-3"><h5 id="jns_klm"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">Tempat Tanggal Lahir</h5></div>
          <div class="col-md-9"><h5 id="ttl"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">Pekerjaan</h5></div>
          <div class="col-md-9"><h5 id="pekerjaan"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-3"><h5 style="font-weight: bold">Status Perkawinan</h5></div>
          <div class="col-md-9"><h5 id="status"></h5></div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-12 text-center"><h4 style="font-weight: bold">Daftar Perawatan Intensif Yang Pernah Dilakukan</h4></div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Dokter Yang Menangani</th>
                  <th>Diagnosis</th>
                  <th>Lama Perawatan (hari)</th>
                  <th>Keadaan Setelah Dirawat</th>
                </tr>
              </thead>
              <tbody id="perawatan"></tbody>
            </table>
          </div>
        </div>
        <div class="row" style="padding-bottom: 5px">
          <div class="col-md-12 text-center"><h4 style="font-weight: bold">Konsultasi Yang Pernah Dilakukan</h4></div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Dokter Yang Menangani</th>
                  <th>Diagnosis</th>
                </tr>
              </thead>
              <tbody id="konsultasi"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">tutup Modal</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function detail(kode_pasien) {
    console.log(kode_pasien);
    $.ajax({
      url       : '/Project_Medis/index.php/Welcome/getWhere/'+kode_pasien,
      type      : 'ajax',
      dataType  : 'json',
      success   : function(data){
        console.log(data.kode_pasien);
        $('#kodepasien').html('Kode Pasien '+data.kode_pasien);
        $('#nama').html(data.nama_pasien);
        $('#nik').html(data.nik_pasien);
        $('#jns_klm').html(data.gender);
        $('#agama').html(data.agama);
        $('#pekerjaan').html(data.pekerjaan);
        $('#status').html(data.status);
        $('#ttl').html(data.ttl);

        perawatan(data.kode_pasien);
        konsultasi(data.kode_pasien);
      }
    });    
  }

  function perawatan(kode_pasien){
    $.ajax({
      url       : '/Project_Medis/index.php/Welcome/daftar_perawatan/'+kode_pasien,
      type      : 'ajax',
      dataType  : 'json',
      success   : function(data){
        var dataperawatan ='';
        var no =1;
        for (var i = 0; i < data.length; i++) {
          dataperawatan +=
          '<tr>'+
            '<td>'+no+'</td>'+
            '<td>'+data[i].tanggal+'</td>'+
            '<td>'+data[i].dokter+'</td>'+
            '<td>'+data[i].diagnosa_utama+'</td>'+
            '<td>'+data[i].lama_perawatan+'</td>'+
            '<td>'+data[i].keadaan_keluar+'</td>'+
          '</tr>';
          no++;
        }
        $('#perawatan').show();
        $('#perawatan').html(dataperawatan);
      },
      error     : function(data){
        $('#perawatan').hide();
      }
    })    
  }

  function konsultasi(kode_pasien){
    $.ajax({
      url       : '/Project_Medis/index.php/Welcome/daftar_konsultasi/'+kode_pasien,
      type      : 'ajax',
      dataType  : 'json',
      success   : function(data){
        var datakonsultasi ='';
        var no =1;
        for (var i = 0; i < data.length; i++) {
          datakonsultasi +=
          '<tr>'+
            '<td>'+no+'</td>'+
            '<td>'+data[i].tanggal+'</td>'+
            '<td>'+data[i].dokter+'</td>'+
            '<td>'+data[i].diagnosa_utama+'</td>'+
          '</tr>';
          no++;
        }
        $('#konsultasi').show();
        $('#konsultasi').html(datakonsultasi);
      },
      error     : function(data){
        $('#konsultasi').hide();
      }
    });
  }
</script>