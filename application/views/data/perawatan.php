<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Data Pasien Perawatan
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Navigasi </li>
        <li class="active">Rawat Perawatan </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" >
      <div class="box">
        <div class="box-header with-border">
          <div class="row">
            <div class="col-md-3">
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
            <!-- <div class="col-md-4">
              <input type="text" name=""  id="kode" class="form-control" name="kode_pasien" placeholder="Scan ID Pasien..." onmousemove="isi_otomatis()">
            </div> -->
            <div class="col-md-4" id="isi-otomatis">
              <input type="text" id="kode" class="form-control" name="kode_pasien" placeholder="Scan ID Pasien..." >
            </div>
            <div class="col-md-4" id="gagal" hidden="">
              <h5 class="text-danger" style="font-weight: bold;">PASIEN TIDAK MELAKUKAN PERWATAN INTENSIF</h5>
            </div>
            <div class="col-md-8" id="button-obat"></div>
          </div>
          <hr>
          <div id="show" >
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Dokter yang menangani</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="nama_dokter"></div></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Nama Pasien</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="nama_pasien"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Pekerjaan</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="pekerjaan"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Status Perkawinan</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="status_nikah"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Jenis Kelamin</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="jns_klm"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Tempat/Tanggal Lahir</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="ttl"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Usia</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="usia"></div></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Status Perawatan</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="status_perawatan"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Tanggal Perawatan</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="tanggal_perawatan"></div></div>
            </div>
            <div class="row">
              <div class="col-md-2 col-sm-2 col-lg-2" style="font-weight: bold;"><p>Diagnosa Awal</p></div>
              <div class="col-md-8 col-sm-8 col-lg-8"><div id="diagnosa_awal"></div></div>
            </div>
          </div>
        </div>
      </div>
      <!-- OBAT -->
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center">PEMERIKSAAN DAN PENGOBATAN HARIAN</h4>
              </div>
              <div class="col-md-2">
                <h5 style="font-weight: bold;">Tanggal <?=date('D, d-m-Y')?></h5>
              </div>
              <div class="col-md-4" id="form-kondisi-terkini" hidden="">
                <input type="text" class="form-control" placeholder="kondisi pasien..." id="kondisipasien">
              </div>
              <div class="col-md-4" id="kondisi-terkini"></div>
            </div>
          </div>
          <div class="box-body">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Kondisi Pasien</th>
                  <th colspan="2" class="text-center">Cek Obat</th>
                </tr>
              </thead>
              <tbody id="perawatan"></tbody>
            </table>
            <div class="row">
              <div class="col-md-12">
                <small>*Tekan tombol dibawah ini apabila pasien sudah sembuh atau keluar dari rumah sakit</small>
              </div>
              <div class="col-md-12" id="tombol-konfirmasi" hidden="">
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#selesai">SELESAI PERAWATAN</button>
              </div>
            </div>
          </div>
        </div>
      <!-- END OBAT-->
    </div>
  <footer class="main-footer">
    <strong>Copyright</strong> Teknik Informatika&copy;2019. 
  </footer>
</div>
<!-- ./wrapper -->

<?php $this-> load-> view('template/footer') ?>
</body>
</html>

<div class="modal fade" id="detailobat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">DAFTAR OBAT YANG DIGUNAKAN</h4>
      </div>
      <div class="modal-body">
        <select class="form-control tab" name="obat" id="obat">
          <option disabled="" selected="">-- PILIH OBAT --</option>
          <?php foreach ($obat as $data ): ?>
            <option value="<?=$data['id_obat']?>"><?=$data['nama_obat']?></option>
          <?php endforeach ?>
        </select>
        <br>
        <h4 id="list-obat"></h4>
      </div>
      <div class="modal-footer">
        <div id="tombol"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="selesai">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-uppercase">Formulir Selesai Dari Perawatan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label>Diagnosa Utama</label>
            <input type="text" id="diagnosa_utama" name="" class='form-control'>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Penanggung Jawab Pasien</label>
            <input type="text" id="pj" name="" class='form-control'>
          </div>
          <div class="col-md-6">
            <label>HP Penanggung Jawab Pasien</label>
            <input type="text" id="hp_pj" name="" class='form-control'>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Cara Keluar</label>
          </div>
          <div class="col-md-3">
            <input type="radio" name="cara_keluar" selected id="cara_keluar" value="diijinkan pulang">Diijinkan Pulang
          </div>
          <div class="col-md-3">
            <input type="radio" name="cara_keluar" id="cara_keluar" value="pulang paksa">Pulang Paksa
          </div>
          <div class="col-md-3">
            <input type="radio" name="cara_keluar" id="cara_keluar" value="lari">Lari
          </div>
          <div class="col-md-3">
            <input type="radio" name="cara_keluar" id="cara_keluar" value="pindah rs">Pindah RS Lain
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Keadaan Keluar</label>
          </div>
          <div class="col-md-3">
            <input type="radio" name="keadaan_keluar" selected id="keadaan_keluar" value="sembuh">Sembuh
          </div>
          <div class="col-md-3">
            <input type="radio" name="keadaan_keluar" id="keadaan_keluar" value="membaik">Membaik
          </div>
          <div class="col-md-3">
            <input type="radio" name="keadaan_keluar" id="keadaan_keluar" value="belum sembuh">Belum Sembuh
          </div>
          <div class="col-md-3">
            <input type="radio" name="keadaan_keluar" id="keadaan_keluar" value="meninggal">Meninggal Dunia
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Biaya Perawatan (Rp.)</div>
          <div class="col-md-8">
            <input type="number" name="biaya_perawatan" id="biaya_perawatan" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="col-md-12" id="submit"></div>
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
      $('#isi-otomatis').on('mousemove', function(){
        var kode = $("#kode").val();
        $.ajax({
        url     : '<?php echo site_url('Welcome/perawatan_pasien/') ?>'+kode,
        dataType: 'json',
        type    : 'ajax',
        async   : false, 
        success : function(data){
            if (data.kode_pasien != null) {
              $('#gagal').hide();
              $('#nama_pasien').html(data.nama_pasien);
              $('#pekerjaan').html(data.pekerjaan);
              $('#status_nikah').html(data.status_nikah);
              $('#jns_klm').html(data.jns_klm);
              $('#nama_dokter').html(data.nama_dokter);
              $('#diagnosa_awal').html(data.diagnosa_awal);
              $('#tanggal_perawatan').html(data.tanggal_mulai);
              $('#ttl').html(data.tmp_lahir+"/"+data.tgl_lahir);
              if (data.status_perawatan == 'inap') {
                $('#status_perawatan').html('Pasien Rawat Inap');
              }
              else{
                $('#status_perawatan').html('Pasien Rawat Jalan');
              }
              $('#usia').html(data.usia);

              var dataop ='';
              for (var i = 0; i < data['perawatan'].length; i++){
                dataop  += 
                  '<tr>'+
                    '<td>'+data['perawatan'][i].no+'</td>'+
                    '<td>'+data['perawatan'][i].tanggal+'</td>'+
                    '<td>'+data['perawatan'][i].kondisi+'</td>'+
                    '<td class="text-center"><button onclick="detailobat('+data['perawatan'][i].id_harian+')" data-toggle="modal" data-target="#detailobat" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>'+
                    '</td>'+
                    '<td class="text-center">'+ 
                      '<button onclick="deletekondisi('+data['perawatan'][i].id_harian+')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>'+
                    '</td>'+
                  '</tr>';
              }
              $('#perawatan').html(dataop);
              $('#form-kondisi-terkini').show();
              $('#tombol-konfirmasi').show();
              $('#kondisi-terkini').html(
                '<button class="btn btn-primary" onclick="addkondisi('+data.id_perawatan+')">Submit</button>'
                );
              $('#submit').html(
                '<button onclick="selesai('+data.id_perawatan+')" class="btn btn-primary">KONFIRMASI</button>');
            }
            else{
              $('#nama_pasien').html('');
              $('#pekerjaan').html('');
              $('#status_nikah').html('');
              $('#jns_klm').html('');
              $('#nama_dokter').html('');
              $('#usia').html('');
              $('#diagnosa_awal').html('');
              $('#status_perawatan').html('');
              $('#button-obat').html('');
              $('#tanggal_perawatan').html('');
              $('#gagal').show();
              $('#perawatan').html('');
              $('#ttl').html('');
              $('#form-kondisi-terkini').hide();
              $('#tombol-konfirmasi').hide();
              // $('#kondisi-terkini').hide();
            }
          },
        error: function(data){
              $('#nama_pasien').html('');
              $('#pekerjaan').html('');
              $('#status_nikah').html('');
              $('#jns_klm').html('');
              $('#nama_dokter').html('');
              $('#usia').html('');
              $('#diagnosa_awal').html('');
              $('#status_kondisi-terkini').html('');
              $('#button-obat').html('');
              $('#gagal').hide();
              $('#perawatan').html('');
              $('#form-kondisi-terkini').hide();
              $('#tombol-konfirmasi').hide();
              // $('#kondisi-terkini').hide();
          }
        });
      });
      function isi_otomatis(){
      }
  </script>
  <script type="text/javascript">
    function deletekondisi(id_harian){
       $.ajax({
        url     : '<?php echo site_url('Welcome/delete_perawatan_harian/') ?>'+id_harian,
        dataType: 'json',
        type    : 'ajax',
        async   : false, 
        success : function(data){
          isi_otomatis();
        }
      });
    }
    function addkondisi(id_perawatan){
      kondisi = $('#kondisipasien').val();
      $.ajax({
        type    : 'POST',
        data    : {kondisi:kondisi},
        url     : '<?php echo site_url('Welcome/add_perawatan_harian/') ?>'+id_perawatan,
        dataType: 'json',
        async   : false, 
        success : function(data){
          isi_otomatis();
        }
      });
    }
    function selesai(id_perawatan){
      var diagnosa_utama    = $('#diagnosa_utama').val();
      var cara_keluar       = $('input:radio[name=cara_keluar]:checked').val();
      var keadaan_keluar    = $('input:radio[name=keadaan_keluar]:checked').val();
      var pj                = $('#pj').val();
      var hp_pj             = $('#hp_pj').val();
      var biaya_perawatan   = $('#biaya_perawatan').val();
      var keadaan_perawatan = 'tidak dalam perawatan';
      console.log(biaya_perawatan);
      $.ajax({
        type    : 'POST',
        data    : {diagnosa_utama:diagnosa_utama,
                  cara_keluar:cara_keluar,
                  keadaan_keluar:keadaan_keluar,
                  pj:pj,
                  hp_pj:hp_pj,
                  biaya_perawatan:biaya_perawatan,
                  keadaan_perawatan:keadaan_perawatan
                  },
        url     : '<?php echo site_url('Welcome/update_perawatan/') ?>'+id_perawatan,
        dataType: 'json',
        async   : false, 
        success : function(data){
          window.location.href = "<?php echo site_url('Welcome/crud/view_all/pasien') ?>";
        }
      });
    }
  </script>
  <script type="text/javascript">
    function tambahobat(id_harian){
      var id_obat   = $('#obat').val();
      var id_harian = id_harian
      $.ajax({
        type    : 'POST',
        data    : {id_obat:id_obat},
        url     : '<?php echo site_url('Welcome/add_list_obat/') ?>'+id_harian,
        dataType: 'json',
        async   : false, 
        success : function(data){
          detailobat(id_harian);
          }
      });
      return false;
    }
    function detailobat(id_harian){
      $.ajax({
        url     : '<?php echo site_url('Welcome/list_obat/') ?>'+id_harian,
        dataType: 'json',
        type    : 'ajax',
        async   : false, 
        success : function(data){
          var dataop = ""; var total = 0;
          for (var i = 0; i < data.length; i++){
             dataop += "<ul><li>"+data[i].nama_obat+" .Harga Obat : Rp."+data[i].harga+"</li></ul>";
             total  += parseInt(data[i].harga);
          }
          dataop += '<hr> <b>Total Harga : Rp. '+total+'</b>';
          $('#list-obat').html(dataop);
          $('#tombol').html('<button type="button" class="btn btn-danger" onclick="tambahobat('+id_harian+')">Tambah Obat</button>'+'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
        },
        error: function(data){
            $('#list-obat').html('');
            $('#tombol').html('<button type="button" class="btn btn-danger" onclick="tambahobat('+id_harian+')">Tambah Obat</button>'+'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
        }
      });
    }
  </script>