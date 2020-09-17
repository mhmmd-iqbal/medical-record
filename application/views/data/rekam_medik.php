<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Rekam Medik Pasien
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Navigasi </li>
        <li class="active">Rekam Medik </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-12 text-center">
              <h4 style="font-weight: bold">REKAM MEDIK PASIEN RS CUT MEUTIA</h4>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>KODE PASIEN</label>
              </div>
              <div class="col-md-4">
                <input type="" placeholder="Scan ID Card Pasien..." onmousemove="isi_otomatis()"  name="" id="kode" class="form-control">
                <!-- <input type="hidden" value="101156245200"  name="" id="kode" class="form-control"> -->
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>NAMA</label>
              </div>
              <div class="col-md-4">
                <input type="" disabled name="" id="nama" class="form-control">
              </div>
              <div class="col-md-2">
                <label>NIK</label>
              </div>
              <div class="col-md-4">
                <input type="" disabled name="" id="nik" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>TEMPAT DAN TANGGAL LAHIR</label>
              </div>
              <div class="col-md-4">
                <input type="" disabled name="" id="ttl" class="form-control">
              </div>
              <div class="col-md-2">
                <label>JENIS KELAMIN</label>
              </div>
              <div class="col-md-4">
                <input type="" disabled name="" id="jk" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>AGAMA</label>
              </div>
              <div class="col-md-2">
                <input type="" disabled name="" id="agama" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>STATUS</label>
              </div>
              <div class="col-md-2">
                <input type="" disabled name="" id="status_pernikahan" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>NO HP</label>
              </div>
              <div class="col-md-4">
                <input type="" disabled name="" id="hp" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label>ALAMAT</label>
              </div>
              <div class="col-md-10">
                <input type="" disabled name="" id="alamat" class="form-control">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box" id="content-perawatan" hidden="">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-12 text-center">
              <h4 style="font-weight: bold">DAFTAR PERAWATAN PASIEN</h4>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
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
                    <th>Perawatan</th>
                    <th>Total Biaya</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="perawatan"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="box" id="content-konsultasi" hidden="">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-12 text-center">
              <h4 style="font-weight: bold">DAFTAR KONSULTASI PASIEN</h4>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Dokter Yang Menangani</th>
                    <th>Diagnosis</th>
                    <th>Total Biaya</th>
                    <th>Daftar Obat</th>
                  </tr>
                </thead>
                <tbody id="konsultasi"></tbody>
              </table>
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

<div class="modal fade" id="obat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">PERAWATAN HARIAN PASIEN</h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Kondisi</th>
              <th>Daftar Obat Yang Digunakan</th>
            </tr>
          </thead>
          <tbody id="list-perawatan-harian"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalobat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">DAFTAR OBAT YANG DIGUNAKAN</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div id="listobat"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <script type="text/javascript" src="http://localhost:4000/socket.io/socket.io.js"></script>
  <script>
    $(document).ready(function(){
      var socket = io.connect('http://localhost:4000');
      socket.on('connect', function () {
        socket.on('message', function (msg) {
          $('#kode').val(msg);  
        });
      });
    });
    </script>

<script type="text/javascript">
  function isi_otomatis(){
    var kode_pasien = $("#kode").val();
    if (kode_pasien != '') {
      $.ajax({
        url     : '<?=site_url()?>/Welcome/getWhere/'+kode_pasien,
        type    : 'ajax',
        dataType: 'json',
        success : function(data){
          $("#nama").val(data.nama_pasien);
          $("#nik").val(data.nik_pasien);
          $("#ttl").val(data.ttl);
          $("#jk").val(data.gender);
          $("#agama").val(data.agama);
          $("#status_pernikahan").val(data.status);
          $("#hp").val(data.no_hp);
          $("#alamat").val(data.alamat);
          if (data.kode_pasien != null) {
            $("#content-perawatan").fadeIn('slow');
            $("#content-konsultasi").fadeIn('slow');
          }
          else{
            $("#ttl").val('');
            $("#jk").val('');
            $("#content-perawatan").fadeOut('slow');
            $("#content-konsultasi").fadeOut('slow'); 
          }

          perawatan(data.kode_pasien);
          konsultasi(data.kode_pasien);
        },
        error   : function(data){
          $("#nama").val('');
          $("#nik").val('');
          $("#ttl").val('');
          $("#jk").val('');
          $("#agama").val('');
          $("#status_pernikahan").val('');
          $("#hp").val('');
          $("#alamat").val('');
          $("#content-perawatan").fadeOut('slow');
          $("#content-konsultasi").fadeOut('slow');
        } 
      });
    }
  }
  function konsultasi(kode_pasien){
    $.ajax({
      url     : '<?=site_url() ?>/Welcome/daftar_konsultasi/'+kode_pasien,
      type    : 'ajax',
      dataType: 'json',
      success : function(data){
        var datakonsultasi =''; var no = 1;
        for (var i = 0; i < data.length; i++) {
           datakonsultasi +=
          '<tr>'+
            '<td>'+no+'</td>'+
            '<td>'+data[i].tanggal+'</td>'+
            '<td>'+data[i].dokter+'</td>'+
            '<td>'+data[i].diagnosa_utama+'</td>'+
            '<td> Rp.'+data[i].total_biaya+'</td>'+
            '<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalobat" onclick="obat_konsultasi('+data[i].id_perawatan+')"><i class="fa fa-list"></i></button></td>'+
            '<td></td>'+
          '</tr>';
          no++;
        }
        $('#konsultasi').html(datakonsultasi);
      }
    });
  }

  function obat_konsultasi(id_perawatan){
    console.log(id_perawatan);
    $.ajax({
      url     : '<?=site_url()?>/Welcome/list_obat_konsultasi/'+id_perawatan,
      type    : 'ajax',
      dataType: 'json',
      success : function(data){
        console.log('oke');
        var list_obat = '';
        for (var i = 0; i < data.length; i++) {
          list_obat +=
          '<ul>'+
            '<li>'+data[i].nama_obat+' - '+data[i].penggunaan+'</li>'+
          '</ul>';
        }
        console.log(list_obat);
        $('#listobat').html(list_obat);
      } 
    });
  }

  function perawatan(kode_pasien){
    $.ajax({
      url     : '<?=site_url()?>/Welcome/daftar_perawatan/'+kode_pasien,
      type    : 'ajax',
      dataType: 'json',
      success : function(data){
        var list_perawatan = ''; var no =1;
        for (var i = 0; i < data.length; i++) {
          list_perawatan +=
          '<tr>'+
            '<td>'+no+'</td>'+
            '<td>'+data[i].tanggal+'</td>'+
            '<td>'+data[i].dokter+'</td>'+
            '<td>'+data[i].diagnosa_utama+'</td>'+
            '<td>'+data[i].lama_perawatan+'</td>'+
            '<td>'+data[i].keadaan_keluar+'</td>'+
            '<td>'+data[i].status_perawatan+'</td>'+
            '<td> Rp.'+data[i].total_biaya+'</td>'+
            '<td class="text-center"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#obat" onclick="obat_perawatan('+data[i].id_perawatan+')"><i class="fa fa-eye"></i></button></td>'+
            '<td><a class="btn btn-sm btn-success" href="<?=site_url()?>/C_cetak/cetak/'+data[i].id_perawatan+'"><i class="fa fa-print"></i></a></td>'+
          '</tr>';
          no++;
        }
        $('#perawatan').html(list_perawatan);
      },
      error   : function(data){
        $('#perawatan').html('');
      } 
    });
  }

  function obat_perawatan(id_perawatan){
    console.log(id_perawatan);
    $.ajax({
      url     : '<?=site_url()?>/Welcome/get_perawatan_harian/'+id_perawatan,
      type    : 'ajax',
      dataType: 'json',
      success : function(data){
        var list ='';
        for (var i = 0; i < data.length; i++) {
          list +=
          '<tr>'+
            '<td>'+data[i].tanggal+'</td>'+
            '<td>'+data[i].kondisi+'</td>'+
            '<td><a class="btn btn-primary btn-sm" href="#modalobat" onclick="list_obat('+data[i].id_harian+')" data-toggle="modal"><i class="fa fa-list"></i></a></td>'+
          '</tr>';
        }
        $('#list-perawatan-harian').html(list);
      }
    });
  }

  function list_obat(id_harian){
    $.ajax({
      url       : '<?=site_url() ?>/Welcome/list_obat/'+id_harian,
      type      : 'ajax',
      dataType  : 'json',
      success   : function(data){
        var list_obat = '';
        for (var i = 0; i < data.length; i++) {
          list_obat += "<ul><li>"+data[i].nama_obat+"</li></ul>";
          console.log(list_obat);
        }
        $('#listobat').html(list_obat);
      }
    });
  }
</script>