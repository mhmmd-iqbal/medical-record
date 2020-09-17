<!DOCTYPE html>
<html>
<?php $this-> load-> view('template/header') ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php $this->load->view('template/menu_bar') ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h5 class="text-uppercase"></h5>
      <h1>Diagnosa Pasien
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Navigasi </li>
        <li class="active">Diagnosa </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title text-center">Diagnosa Awal Pasien Rawat Inap</h4>
          <h5 style="float: right;"><?=date('D, d-m-Y')?></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <form action="<?=site_url()?>/Welcome/crud/create_new/perawatan" method="POST" role="form">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dokter Yang Menangani</label>
                      <input type="" name="" class="form-control" disabled="" value="<?=$sess['sess_name']?>">
                      <input type="hidden" name="kode_dokter" id="kode_dokter" value="<?=$sess['sess_id']?>">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h4 class="text-center text-danger" hidden="" id="kosong">Kode Pasien Belum Terdaftar !</h4>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Kode Pasien</label>
                      <input type="text" class="form-control" name="kode_pasien" id="kode"  onmousemove="isi_otomatis()">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nama Pasien</label>
                      <input type="text" class="form-control" id="nama" disabled="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">NIK</label>
                      <input type="text" class="form-control" id="nik" disabled="">
                    </div>
                  </div>
                </div>  
                <div class="row" id="cara_masuk">
                  <div class="col-md-12">
                    <label>Cara Masuk Inap</label>
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="cara_masuk" value="dokter">Arahan Dokter
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="cara_masuk" value="puskesmas">Dari Puskesmas
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="cara_masuk" value="rs">Dari Rumah Sakit Lain
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="cara_masuk" value="instansi">Dari Instansi Lain
                  </div>
                  <div class="col-md-2">
                    <input type="radio" name="cara_masuk" value="sendiri" checked="">Datang Sendiri
                  </div>
                </div>  
                <div class="row">
                  <div class="col-md-12" style="padding-top: 10px">
                    <div class="form-group">
                      <label>Diagnosa Awal</label>
                      <input type="text" class="form-control" name="diagnosa_awal">
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-md-12">
                    <label>Perawatan Lanjutan</label>
                  </div> 
                  <div class="col-md-4">
                    <input type="radio" name="status_perawatan" id="perawatan" value="inap" checked="" onclick="buka_form(this.value)" >Rawat Inap
                  </div>
                  <div class="col-md-4">
                    <input type="radio" name="status_perawatan" id="perawatan" value="jalan" onclick="buka_form(this.value)">Rawat Jalan
                  </div>  
                  <div class="col-md-4">
                    <input type="radio" name="status_perawatan" id="perawatan" value="konsultasi" onclick="buka_form(this.value)">Tidak Perlu Perawatan Lanjutan
                  </div>  
                </div>    
                <br>  
                <!-- Diagnosa Munculkan -->
                <div class="row" id="obat" hidden>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Diagnosa Utama</label>
                          <input type="text" name="diagnosa_utama" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>   
                <!-- Diagnosa End -->
                <!-- Biaya Munculkan -->
                <div class="row" id="biaya" hidden>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Biaya Perawatan (Rp. )</label>
                          <input type="number" name="biaya_perawatan" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>   
                <!-- Biaya End -->
                <div class="row">
                  <div class="col-md-12">
                  <small>Periksa kembali data submit pasien perawatan</small>
                    <button type="submit" class="btn btn-primary btn-block">Upload Data</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- LIST OBAT UNTUK KONSULTASI -->
        <div class="box-body" id="show-selected-medicine" hidden>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4" style="padding-bottom: 5px">
                    <select name="id_obat" class="form-control" id="id_obat">
                      <option value="" disabled="" selected="">--Obat Yang Diperlukan--</option>
                      <?php foreach ($obat as $data): ?>
                      <option value="<?=$data['id_obat']?>"><?=$data['nama_obat']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-md-5" style="padding-bottom: 5px">
                    <input type="" name="" id="penggunaan" class="form-control" placeholder="Penggunaan Perhari..">
                  </div>
                  <div class="col-md-3">
                    <a name="" class="btn btn-primary btn-block" id="submit-obat">Submit Obat</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Obat</th>
                          <th>Harga</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="list-obat"></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END LIST OBAT UNTUK KONSULTASI -->
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
  <script type="text/javascript" src="http://localhost:4000/socket.io/socket.io.js"></script>
  <script>
    $(document).ready(function(){
    
      var socket = io.connect('http://localhost:4000');
      socket.on('connect', function () {
        socket.on('message', function (msg) {
          // $('#data_value').html(msg);
          $('#kode').val(msg);
          
        });
      });
    });
    </script>
    <script type="text/javascript">
      function isi_otomatis(){
        var kode_pasien = $("#kode").val();
          $.ajax({
          url     : '<?php echo site_url() ?>/Welcome/getWhere/'+kode_pasien,
          dataType: 'json',
          type    : 'ajax',
          async   : false, 
          success: function(data){
              $('#nama').val(data.nama_pasien);
              $('#nik').val(data.nik_pasien);
              if (data.nama_pasien == null) {
                $('#kosong').fadeIn();
              }
              else{
                $('#kosong').hide();
              }
            },
            error : function(){
              $('#nama').val('');
              $('#nik').val('');
              $('#kosong').fadeIn();
            }
          });
      }
    </script>
    
  <script type="text/javascript">
    function buka_form(value){
      var perawatan = value;
      if (perawatan == 'konsultasi') {
        $("#obat").fadeIn(); 
        $("#biaya").fadeIn(); 
        $("#show-selected-medicine").show();
        $("#cara_masuk").hide(); 
      }
      else{
        $("#show-selected-medicine").hide();
        $("#obat").hide(); 
        $("#biaya").hide(); 
        $("#cara_masuk").fadeIn(); 
      }
    }
  </script>

  <script type="text/javascript">
   $('#submit-obat').on('click', function() {
      var kode_pasien = $('#kode').val();
      var kode_dokter = $('#kode_dokter').val();
      var id_obat     = $('#id_obat').val();
      var penggunaan  = $('#penggunaan').val();

      $.ajax({
        type    : 'POST',
        data    : { kode_pasien:kode_pasien, 
                    kode_dokter:kode_dokter, 
                    id_obat:id_obat, 
                    penggunaan:penggunaan },
        url     : '<?php echo site_url('Welcome/add_tmp_list_obat/')?>',
        dataType: 'json', 
        async   : false,
        success : function(data){
          list_obat();
        },
        error   : function(){
          console.log('gagal');
        }
      });
   });
  </script>

  <script type="text/javascript">
    list_obat();
    function list_obat(){
      var kode_pasien = $('#kode').val();
      var kode_dokter = $('#kode_dokter').val();
      $.ajax({
          type    : 'ajax',
          url     : '<?php echo site_url()?>/Welcome/get_tmp_list_obat/'+kode_pasien+'/'+kode_dokter,
          dataType: 'json', 
          async   : false,
          success : function(data){
            var tbody = '';
            for (var i = 0; i < data.length; i++) {
              tbody += 
                '<tr>'+
                  '<td>'+data[i].no+'</td>'+
                  '<td>'+data[i].nama_obat+'</td>'+
                  '<td>'+data[i].harga+'</td>'+
                  '<td>'+data[i].penggunaan+'</td>'+
                  '<td>'+
                  '<a class="btn btn-danger btn-sm" id="deletetmp" onclick=deletetmp('+data[i].id_tmp_obat+')><i class="fa fa-times"></i></a>'+
                  '</td>'+
                '</tr>';
            }
            $('#list-obat').html(tbody);
          },
          error   : function(data){
            $('#list-obat').html('');            
          }
        });
    }
      
      function deletetmp(id_tmp_obat){
        console.log(id_tmp_obat);
        $.ajax({
          type    : 'ajax',
          url     : '<?php echo site_url()?>/Welcome/delete_tmp_list_obat/'+id_tmp_obat,
          dataType: 'json',
          success : function(data){
            list_obat();
          }
        });
      }
  </script>
  