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
      <h1>Pasien
        <small>Selamat Datang Pada Aplikasi Rekam Medik Rumah Sakit Cut Meutia </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Master Data </li>
        <li class="active">Pasien</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title text-center">Buat Data Pasien Baru</h4>
          <h5 style="float: right;"><?=date('D, d-m-Y')?></h5>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <?php 
                if($edit=='1'){
                  $link='edit/edit_pasien/'.$pasien['kode_pasien'];
                }else{
                  $link='create_new/pasien';}
              ?>
              <form action="<?=site_url()?>/Welcome/crud/<?=$link?>" method="POST" role="form">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group" onmousemove="ganti()">
                      <label for="">Kode Pasien</label>
                      <!-- <input type="text" class="form-control" id="kode" name="kode_pasien"  placeholder="Harap scan ID Card baru..." disabled="" value="<?=($edit=='1')?$pasien['kode_pasien']:''?>"> -->
                      <input type="text" class="form-control" id="kode" name="kode_pasien"  placeholder="Harap scan ID Card baru..." value="<?=($edit=='1')?$pasien['kode_pasien']:''?>">
                      <!-- <input type="hidden" name="kode_pasien" class="kode" id="kode"> -->
                    </div>
                  </div>
                  <div class="col-md-8">
                    <?php if($edit != '1'): ?>
                    <h4 id="error" class="text-danger text-center" hidden="" style="font-weight: bold;">KODE PASIEN SUDAH DIGUNAKAN</h4>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-goup">
                      <label>NIK</label>
                      <input type="text" name="nik" id="nik" class="form-control" minlength="16" maxlength="16" required placeholder="NIK wajib diisi..." value="<?=($edit=='1')?$pasien['nik_pasien']:''?>">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-goup">
                      <label>Nama</label>
                      <input type="text" id="nama" name="nama" class="form-control" maxlength="40" value="<?=($edit=='1')?$pasien['nama_pasien']:''?>">
                    </div>
                  </div>
                </div>              
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-goup">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tmp_lahir" id="tmp_lahir" maxlength="60" class="form-control" value="<?=($edit=='1')?$pasien['tmp_lahir']:''?>">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-goup">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" id="tgl_lahir" value="<?=($edit=='1')?$pasien['tgl_lahir']:''?>" class="form-control datepicker">
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Jenis Kelamin</label>
                      </div>
                      <div class="col-md-12">
                        <input type="radio" name="jns_klm" id="L" value="L" checked="">Laki - Laki
                        <input type="radio" name="jns_klm" id="P" value="P" <?=(($edit=='1')AND($pasien['jnsklmn_pasien']=='P'))?'checked':''?>>Perempuan
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Status Pernikahan</label>
                    <select name="status_perkawinan" id="status" class="form-control">
                      <option selected="" disabled="">-- STATUS PERNIKAHAN --</option>
                      <option <?=(($edit=='1')AND($pasien['status_perkawinan']=='Kawin'))?'selected':''?> value="Kawin">Kawin</option>
                      <option <?=(($edit=='1')AND($pasien['status_perkawinan']=='Belum Kawin'))?'selected':''?> value="Belum Kawin">Belum Kawin</option>
                      <option <?=(($edit=='1')AND($pasien['status_perkawinan']=='Duda'))?'selected':''?> value="Duda">Duda</option>
                      <option <?=(($edit=='1')AND($pasien['status_perkawinan']=='Janda'))?'selected':''?> value="Janda">Janda</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Agama</label>
                    <select name="agama" id="agama" class="form-control">
                      <option selected="" disabled="">-- AGAMA --</option>
                      <option <?=(($edit=='1')AND($pasien['agama']=='Islam'))?'selected':''?> value="Islam">Islam</option>
                      <option <?=(($edit=='1')AND($pasien['agama']=='Kristen'))?'selected':''?> value="Kristen">Kristen</option>
                      <option <?=(($edit=='1')AND($pasien['agama']=='Protestan'))?'selected':''?> value="Protestan">Protestan</option>
                      <option <?=(($edit=='1')AND($pasien['agama']=='Hindu'))?'selected':''?> value="Hindu">Hindu</option>
                      <option <?=(($edit=='1')AND($pasien['agama']=='Buddha'))?'selected':''?> value="Buddha">Buddha</option>
                    </select>
                  </div>
                </div> 
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-11">
                      <label>Pekerjaan</label>
                      <input type="text" id="pekerjaan" value="<?=($edit=='1')?$pasien['pekerjaan']:''?>" name="pekerjaan" maxlength="30" class="form-control">
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-11">
                      <label>Alamat</label>
                      <textarea class="form-control" name="alamat" maxlength="60" rows="2" id="alamat"><?=($edit=='1')?$pasien['alamat_pasien']:''?></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-11">
                    <div class="form-goup">
                      <label>Contact HP</label>
                      <input type="text" name="hp" value="<?=($edit=='1')?$pasien['no_hp']:''?>" class="form-control" id="no_hp" maxlength="15">
                    </div>
                  </div>
                </div>

                <br>
                <button type="text" class="btn btn-primary"><?=($edit=='1')?'Edit Data Pasien':'Tambah Data Pasien Baru'?></button>
              </form>
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
      // $('#agama').change(function(event) {
      //   var agama = $("#agama option:selected" ).val();
      //   console.log(agama);
      // });

      function ganti(){
      var kode_pasien = $('#kode').val();
        $.ajax({
          url     : '<?php echo site_url() ?>/Welcome/getWhere/'+kode_pasien,
          dataType: 'json',
          type    : 'ajax',
          async   : false, 
          success : function(data){
              $('#nama').val(data.nama_pasien);
              $('#nik').val(data.nik_pasien);
              $('#pekerjaan').val(data.pekerjaan);
              $('#agama').val(data.agama).trigger('change');
              $('#tmp_lahir').val(data.tmp_lahir);
              $('#tgl_lahir').val(data.tgl_lahir);
              $('input:radio[name=jns_klm][value='+data.jns_klm+']')[0].checked = true;
              $('#status').val(data.status).trigger('change');
              $('#alamat').html(data.alamat);
              $('#no_hp').val(data.no_hp);
              $('#error').fadeIn();
            },
          error   : function(data){
              $('#nama').val('');
              $('#nik').val('');
              $('#pekerjaan').val('');
              $('#agama').val('').trigger('change');
              $('#tmp_lahir').val('');
              $('#tgl_lahir').val('');
              $('input:radio[name=jns_klm][value=]')[0].checked = true;
              $('#status').val('').trigger('change');
              $('#alamat').html('');
              $('#no_hp').val('');
              $('#error').hide();
          }
        });
      }
  </script>