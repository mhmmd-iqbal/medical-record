<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In Sistem Informasi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/template//bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/template//bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/template//dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>/assets/template//plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=site_url()?>"><b>Sistem Informasi</b><br>Rekam Medis RS. Cut Meutia</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login Untuk Masuk Kedalam Sistem</p>

    <form action="<?=site_url()?>/Welcome/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="username" required="" maxlength="16">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="password " required="" maxlength="16">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group">
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
      </div>
      </div>
      <div class="form-group">
      <div class="row">
        <div class="col-xs-12">
          <a href="<?=site_url()?>" class="btn btn-danger btn-block btn-flat">Kembali</a>
        </div>
      </div>
      </div>
    </form>
  </div>
  <?php if(isset($gagal)) :?>
    <h4 class="text-center text-uppercase text-red"><?=$gagal ?></h4>
  <?php endif; ?>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>/assets/template//bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>/assets/template//bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>/assets/template//plugins/iCheck/icheck.min.js"></script>

</body>
</html>
