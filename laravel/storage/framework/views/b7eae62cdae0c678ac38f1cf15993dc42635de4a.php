<!DOCTYPE html>
<html lang="tr">
<head>
  
  <?php if(!Cookie::has('admin')): ?>
  <script type="text/javascript">window.location = "/admin/giris";</script>
  <?php endif; ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  
  <?php $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true) ?>

  <title><?php echo e($seo['author']); ?> | Yönetim Paneli</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="/panel/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/panel/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/panel/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/panel/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/panel/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/panel/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/panel/css/jquery.fancybox.css">

  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
  
</head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->

      <?php $mini = explode(' ', $seo['author']) ?>

      <span class="logo-mini">
        <?php $__currentLoopData = $mini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><b><?php echo e($temp[0]); ?></b><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo e($seo['author']); ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="/admin/siparis?tip=bekliyor" title="Bekleyen">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-warning">
                <?php echo e(DB::table('siparis')->where('sil', 0)->where('durum', 'Onay Bekliyor')->count()); ?>

              </span>
            </a>
          </li>
          <li>
            <a href="/" target="_blank" title="Site"><i class="fa fa-globe"></i></a>
          </li>
          <li>
            <a href="/admin/cikis" title="Çıkış"><i class="fa fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview <?php if(strpos(Request::path(), 'siparis') !== false): ?> active <?php endif; ?>">
          <a href="#"><i class="fa fa-money"></i> <span>Siparişler</span>
            <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <?php 
            
            $tipler = 
            [
              'hepsi' => 'Hepsi', 
              'bekliyor' => 'Onay Bekleyen',
              'onaylandı' => 'Onaylanan',
              'kargo' => 'Kargoya Verilen',
              'tamam' => 'Tamamlanan',
              'iptal' => 'İptal Olan',
            ];
            
            ?>
            
            <?php $__currentLoopData = $tipler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'siparis?tip='. $url) !== false): ?> active <?php endif; ?>">
              <a href="/admin/siparis?tip=<?php echo e($url); ?>">
                <i class="fa fa-circle-o"></i> <span><?php echo e($tip); ?></span>
              </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
        <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'kategori') !== false): ?> active <?php endif; ?>">
          <a href="/admin/kategori"><i class="fa fa-list"></i> <span>Kategori</span></a>
        </li>
        <li class="treeview <?php if(strpos($_SERVER['REQUEST_URI'], 'urun') !== false): ?> active <?php endif; ?>">
          <a href="#"><i class="fa fa-th-large"></i> <span>Ürün</span>
            <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'urun/0') !== false && strpos($_SERVER['REQUEST_URI'], 'urun/0?set=true') === false): ?> active <?php endif; ?>">
              <a href="/admin/urun/0"><i class="fa fa-plus"></i> <span>Kayıt</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'urun/0?set=true') !== false): ?> active <?php endif; ?>">
              <a href="/admin/urun/0?set=true"><i class="fa fa-plus"></i> <span>Paket</span></a>
            </li>
            
            <?php 
            
            $tipler = 
            [
              'hepsi' => 'Hepsi', 
              'hazir-paket' => 'Paketler',
              'paket-ozel' => 'Pakete Özel',
              'indirimli' => 'İndirimli', 
              'one-cikan' => 'Öne Çıkan', 
              'yeni-gelen' => 'Yeni Gelen',
              'arsiv' => 'Arşiv',
            ];
            
            ?>
            
            <?php $__currentLoopData = $tipler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'urun?tip='. $url) !== false): ?> active <?php endif; ?>">
              <a href="/admin/urun?tip=<?php echo e($url); ?>">
                <i class="fa fa-circle-o"></i> <span><?php echo e($tip); ?></span>
              </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
        <li class="treeview <?php if(strpos($_SERVER['REQUEST_URI'], 'uye') !== false): ?> active <?php endif; ?>">
          <a href="#"><i class="fa fa-users"></i> <span>Üye</span>
            <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'uye/0') !== false): ?> active <?php endif; ?>">
              <a href="/admin/uye/0"><i class="fa fa-plus"></i> <span>Kayıt</span></a>
            </li>

            <?php 
            
            $tipler = 
            [
              'hepsi' => 'Hepsi', 
              'aktif' => 'Aktif', 
              'onayli' => 'Onaylı', 
              'onaysiz' => 'Onaysız',
              'arsiv' => 'Arşiv'
            ];
            
            ?>
            
            <?php $__currentLoopData = $tipler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'uye?tip='. $url) !== false): ?> active <?php endif; ?>">
              <a href="/admin/uye?tip=<?php echo e($url); ?>">
                <i class="fa fa-circle-o"></i> <span><?php echo e($tip); ?></span>
              </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
        <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'yorum') !== false): ?> active <?php endif; ?>">
          <a href="/admin/yorum"><i class="fa fa-comments-o"></i> <span>Yorum</span></a>
        </li>
        <li class="treeview <?php if(strpos($_SERVER['REQUEST_URI'], 'ayar') !== false): ?> active <?php endif; ?>">
          <a href="#"><i class="fa fa-cogs"></i> <span>Ayar</span>
            <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/seo') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/seo"><i class="fa fa-circle-o"></i> <span>Seo</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/slide') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/slide"><i class="fa fa-circle-o"></i> <span>Slider</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/iletisim') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/iletisim"><i class="fa fa-circle-o"></i> <span>İletişim</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/odeme') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/odeme"><i class="fa fa-circle-o"></i> <span>Ödeme</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/pos') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/pos"><i class="fa fa-circle-o"></i> <span>Sanal Pos</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/banka') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/banka"><i class="fa fa-circle-o"></i> <span>Banka</span></a>
            </li>
            <li class="<?php if(strpos($_SERVER['REQUEST_URI'], 'ayar/kargo') !== false): ?> active <?php endif; ?>">
              <a href="/admin/ayar/kargo"><i class="fa fa-circle-o"></i> <span>Kargo</span></a>
            </li>
          </ul>
        </li>
        <li><a href="/admin/cikis"><i class="fa fa-power-off"></i> <span>Çıkış</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $__env->yieldContent('header'); ?>
        <?php if (! empty(trim($__env->yieldContent('optional')))): ?>
        <small><?php echo $__env->yieldContent('optional'); ?></small>
        <?php endif; ?>
      </h1>
    </section>

    <?php echo $__env->yieldContent('content'); ?>
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <strong><a href="//hukumdar.com.tr">Hükümdar</a></strong>
    </div>
    <!-- Default to the left -->
    <strong>&copy; <?php echo e(date('Y') .' '. $seo['author']); ?></strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- form sonucu -->
<div class="form-sonuc"></div>

<!-- REQUIRED JS SCRIPTS -->

<script src="/panel/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/panel/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/panel/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/panel/dist/js/adminlte.min.js"></script>
<script src="/panel/bower_components/ckeditor/ckeditor.js"></script>
<script src="/panel/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/panel/js/jquery.fancybox.js"></script>
<script src="/panel/js/admin.js"></script>

<?php echo $__env->yieldContent('script'); ?>

<style>
@media (max-width: 767px)
{
  .box-title
  {
    display: block !important;
    text-align: center !important;
    float: initial !important;
    padding: 5px !important;
  }

  .box-header > .box-tools
  {
    position: relative;
    display: block;
    left: 0;
    right: 0;
  }

  #arama, #arama input
  {
    width: 100% !important;
  }

  .form-group small
  {
    display: block !important;
  }

  form.input-group
  {
    margin: 0 !important;
  }

  form.input-group select
  {
    width: 145px !important;
  }

  form.input-group [type="text"]
  {
    width: 85px !important;
  }

  .pagination
  {
    display: table;
    text-align: center;
    margin: 0 auto !important;
    float: none !important;
  }

  .btn
  {
    width: 100%;
  }

  .input-group-btn .btn
  {
    width: auto !important
  }
  
  .btn:not(:last-child)
  {
    margin-bottom: 10px;
  }

  small .list-inline
  {
    display: block !important;
    left: 0 !important;
    top: 10px !important;
    text-align: center !important;
  }
}
</style>

</body>
</html>