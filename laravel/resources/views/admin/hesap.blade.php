<!DOCTYPE html>
<html>
<head>

  @if (Cookie::has('admin'))
  <script type="text/javascript">window.location = "/admin";</script>
  @endif

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true) ?>

  <title>{{ $seo['author'] }} | Yönetim Paneli</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="/panel/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/panel/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/panel/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/panel/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/panel/plugins/iCheck/square/blue.css">

  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">

</head>
<body class="hold-transition login-page" style="height: auto">
<div class="login-box">
  <div class="login-logo">

    <?php $mini = explode(' ', $seo['author']) ?>

    <a href="/admin">
      <b>{{ $mini[0] }}</b>

      <?php unset($mini[0]) ?>

      @foreach ($mini as $temp)
       {{ $temp }}
      @endforeach
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    
    @if (Request::path() == 'admin/giris')
    
    <p class="login-box-msg">Oturum Aç</p>
    <form id="ajax-form" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="E-Posta Adresi" name="mail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Şifre" name="sifre" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8" style="line-height: 35px">
          <a href="/admin/unuttum">Şifremi Unuttum</a>
        </div>
        <!-- /.col -->
        <input type="hidden" name="unut_token" value="{{ md5(mt_rand()) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xs-4" style="padding-left: 0">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="Giriş">Giriş</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
    @elseif (Request::path() == 'admin/unuttum')
    
    <p class="login-box-msg">Şifremi Unuttum</p>
    <form id="ajax-form" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="E-Posta Adresi" name="mail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8" style="line-height: 35px">
          <a href="/admin/giris">Giriş Yap</a>
        </div>
        <!-- /.col -->
        <input type="hidden" name="unut_token" value="{{ md5(mt_rand()) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xs-4" style="padding-left: 0">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="Gönder">Gönder</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    @else

    <p class="login-box-msg">Şifremi Sıfırla</p>
    <form id="ajax-form" method="post">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="sifre" placeholder="Yeni Şifre" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="tekrar" placeholder="Yeni Şifre Tekrar" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xs-4 col-xs-offset-8" style="padding-left: 0">
          <button type="submit" class="btn btn-primary btn-block btn-flat" value="Sıfırla">Sıfırla</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    @endif

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- form sonucu -->
<div class="form-sonuc"></div>

<!-- jQuery 3 -->
<script src="/panel/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/panel/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/panel/plugins/iCheck/icheck.min.js"></script>
<script src="/panel/js/admin.js"></script>
</body>
</html>