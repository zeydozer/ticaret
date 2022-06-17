<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" value="<?php echo e(csrf_token()); ?>">

    <?php $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true) ?>

    <meta name="description" content="<?php echo e($seo['description']); ?>" />

    <?php if(strpos(Request::path(), 'urun/') !== false): ?>
    <?php 

    $url = str_replace('urun/', '', Request::path());

    $urun = \App\Urun::where('url', $url)->first();

     ?>
    <meta name="keywords" content="<?php echo e($urun->keyword); ?>" />
    <?php else: ?>
    <meta name="keywords" content="<?php echo e($seo['keywords']); ?>" />
    <?php endif; ?>

    <meta name="author" content="<?php echo e($seo['author']); ?>">

    <meta name="robots" content="index, follow" />

    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="//fonts.googleapis.com/css?family=Baloo+2:400,500,600,700" rel="stylesheet">

    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">

    <?php if(Request::path() == '/'): ?>

    <title><?php echo e($seo['author']); ?></title>

    <?php else: ?>

    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($seo['author']); ?></title>

    <?php endif; ?>

    <meta property="og:type" content="article" />
    <meta name="twitter:card" content="summary" />

    <?php if(Request::has('id')): ?>

    <?php

    $urun = \App\Urun::find(Request::get('id'));

    $profil = \App\Foto::where('profil', 1)
                       ->where('urun_id', $urun->id)
                       ->where('tip', 'foto')
                       ->first();

    $profil = $profil ? $profil->deger : 'logo.png';

    ?>

    <meta property="og:url" content="<?php echo e(Request::url()); ?>?id=<?php echo e(Request::get('id')); ?>" />
    <meta property="twitter:site" content="<?php echo e(Request::url()); ?>?id=<?php echo e(Request::get('id')); ?>" />
    <meta property="og:title" content="<?php echo e(strip_tags($urun->isim)); ?>" />
    <meta property="twitter:title" content="<?php echo e(strip_tags($urun->isim)); ?>" />
    <meta property="og:image" content="<?php echo e(url('img/'. $profil)); ?>" />
    <meta property="twitter:image" content="<?php echo e(url('img/'. $profil)); ?>" />

    <?php if($urun->ozellik): ?>

    <meta property="og:description" content="<?php echo e(strip_tags(implode(' || ', json_decode($urun->ozellik)))); ?>" />
	<meta property="twitter:description" content="<?php echo e(strip_tags(implode(' || ', json_decode($urun->ozellik)))); ?>" />

    <?php endif; ?>

    <?php endif; ?>

    <!-- New Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N43WNP3');</script>
    <!-- End Google Tag Manager -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-402712385"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-402712385');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '426448841694767');
        fbq('track', 'PageView');
        fbq('track', 'ViewContent');
    </script>

    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=426448841694767&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->

    <meta name="google-site-verification" content="XoKioh5MlNltSq7Lb8gqRwvpIoOcPN75P3WWw3VTzd4" />

    <!-- Hotjar Tracking Code for noone.com.tr -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2245136,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    <script>
      window.intercomSettings = {
        app_id: "o3h9z7nh"
      };
    </script>

    <script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/o3h9z7nh'
    (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/o3h9z7nh';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>

    <link rel="stylesheet" type="text/css" href="/assets/menu/css/component.css" />
    
    <script src="/assets/menu/js/modernizr-custom.js"></script>

    <style>
        
        .action--open
        {
            font-size: unset;
        }

        .menu
        {
            top: 0;
            left: -100%;
            right: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
            background: rgba(0, 0, 0, .95);
            transition: .25s;
        }

        .menu--open
        {
            left: 0;
        }

        .action--close
        {
            display: block;
            color: #eb5105;
        }

        .menu__breadcrumbs a
        {
            color: #eb5105;
            font-size: 12pt;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 85%;
        }

        .menu__breadcrumbs a:nth-child(1),
        .menu__breadcrumbs a:nth-child(2)
        {
            display: none;
        }

        .menu__link
        {
            color: #fff;
            padding-top: .5em;
            padding-bottom: .5em;
            overflow: hidden;
            text-overflow: ellipsis;
            text-transform: uppercase;
        }

        .menu__link[data-submenu]
        {
            white-space: nowrap;
            padding-right: 5em;
        }

        .menu__back,
        .menu__link[data-submenu]::after
        {
            color: #fff;
        }

        .menu__link[data-submenu]::after
        {
            line-height: .5;
        }

        .menu img
        {
            width: 75px;
            height: 75px;
            margin-right: .5em;
            object-fit: contain;
            object-position: right;
        }

        @media (max-width: 767px)
        {
            .menu__link
            {
                padding-top: .25em;
                padding-bottom: .25em;
            }
        }

    </style>
    
</head>

<body>
    <!-- New Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N43WNP3"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	
    <header>

        <?php $indirim = json_decode(DB::table('ayar')->where('tip', 'indirim')->first()->data, true) ?>

        <?php if($indirim['a'] > 0): ?>
        <div class="nav-campaign" style="background: #FF0000">
            <div class="container">
                <span>
                    <strong>
                        Şimdi üye olun, ilk alışverişinize özel <?php echo e($indirim['a']); ?> TL'ye
                        <?php echo e($indirim['b']); ?> TL kazanın!
                    </strong>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <?php $kargo = DB::table('ayar')->where('tip', 'ucretsiz')->first()->data ?>

        <?php if($kargo > 0): ?>
        <div class="nav-campaign">
            <div class="container">
                <span>
                    <strong><?php echo e($kargo); ?> TL ve üzeri alışverişlerinizde Kargo BEDAVA</strong>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <div class="nav-middle">
            <div class="container">
                <div class="row">
                    <a class="navbar-brand" href="/">
                        <img src="/img/logo.png" alt="<?php echo e($seo['author']); ?>">
                    </a>
                    <div class="search m-auto align-items-center">
                        <div class="search-top">
                            <ul class="list-inline">
                                <li class="list-inline-item d-none d-md-inline-block">
                                    <b>Popüler Aramalar:</b>
                                </li>
                                <?php for($i = 1; $i <= 3; $i++): ?>
                                <li class="list-inline-item">
                                    <a href="/urunler?ara=<?php echo e($seo['arama_'. $i]); ?>"><?php echo e($seo['arama_'. $i]); ?></a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="search-form">
                            <form class="form-inline" method="get" action="/urunler">
                                <input class="form-control mr-sm-2" type="search" placeholder="Ürünler içinde arayın.."
                                aria-label="Search" name="ara" required>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                    <img src="/assets/images/search_icon.svg" alt="">
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="user">
                        <ul class="list-inline">
                            <?php if(Cookie::has('uye')): ?>
                            <li class="list-inline-item">
                                <a href="/hesap/uyelik" title="">
                                    <span class="icon--top" data-toggle="tooltip" data-placement="left"
                                    title="<?php echo e(Cookie::get('uye')->isim); ?>">
                                        <img src="/assets/images/user_icon.svg" class="d-none d-lg-inline-block">
                                        <img src="/assets/images/user_icon-w.png" class="d-inline-block d-lg-none">
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="list-inline-item">
                                <?php if(!Cookie::has('uye')): ?>
                                <a href="/giris" title="">
                                    <span class="icon--top">
                                        <img src="/assets/images/user_icon.svg" class="d-none d-lg-inline-block">
                                        <img src="/assets/images/user_icon-w.png" class="d-inline-block d-lg-none">
                                    </span>
                                </a>
                                <?php else: ?>
                                <a href="/cikis" title="">
                                    <span class="icon--top">
                                        <img src="/assets/images/logout.svg" class="d-none d-lg-inline-block">
                                        <img src="/assets/images/logout-w.png" class="d-inline-block d-lg-none">
                                    </span>
                                </a>
                                <?php endif; ?>
                            </li>
                            <li class="list-inline-item">
                                <a href="/sepet" title="">
                                    <span class="icon--top">
                                        <img src="/assets/images/basket_icon.svg" class="d-none d-lg-inline-block">
                                        <img src="/assets/images/basket_icon-w.png" class="d-inline-block d-lg-none">

                                        <?php

                                        $uye_id = Cookie::has('uye') ? Cookie::get('uye')->id : Session::get('id');

                                        $sepet_adet = \App\Sepet::where('uye_id', $uye_id)->where('sil', 0)->sum('adet');

                                        ?>

                                        <span class="piece sepet-adet"><?php echo e($sepet_adet); ?></span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg">

            <div class="container">

                <button class="mobile-menu action--open">
                    <img src="/assets/images/menu.svg" alt="Menüyü Göster">
                    <span>Menü</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Ürünler
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="row dropdown-menu-multiply">
                                    <div class="col-md-8">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="/urunler" class="font-weight-bold">
                                                    <!-- <img src="/assets/images/favicon.png"> -->
                                                    Bütün Ürünler
                                                </a>
                                            </li>

                                            <?php $kategoriler = \App\Kategori::where('bagli_id', null)->orderBy('sira')->get() ?>

                                            <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="border-top" style="padding-top: 10px">
                                                <a href="/urunler/<?php echo e($kategori->url); ?>">
                                                    <!-- <img src="/img/<?php echo e($kategori->foto); ?>"> -->
                                                    <?php echo e($kategori->isim); ?>

                                                </a>
                                            </li>
                                            <?php  $altlar = \App\Http\Controllers\Controller::kat_getir($kategori->id, $kategori->isim, true)  ?>
                                            <?php if(count($altlar) > 0): ?>
                                            <?php $__currentLoopData = $altlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $isim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php  $kategori = \App\Kategori::find($id)  ?>
                                            <li>
                                                <a href="/urunler/<?php echo e($kategori->url); ?>" class="font-weight-normal">
                                                    <!-- <img src="/img/<?php echo e($kategori->foto); ?>"> -->
                                                    <?php echo e($kategori->isim); ?>

                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <div class="row">
                                            <?php 

                                            $markalar = DB::connection('integrated')
                                                ->table('brand')
                                                ->where('root_id', null)
                                                ->where('photo', '!=', null)
                                                ->orderBy('name')
                                                ->get();

                                             ?>
                                            <?php if(count($markalar) > 0): ?>
                                            <?php $__currentLoopData = $markalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-3 col-md-6 col-4">
                                                <a href="/urunler?marka[]=<?php echo e($marka->name); ?>" class="font-weight-bold">
                                                    <img src="//entegre.ruberu.com.tr/assets/images/brands/<?php echo e($marka->photo); ?>">
                                                    <!-- Bütün Ürünler -->
                                                </a>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/urunler?ozellik[]=indir" title="">İndirimdekiler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/urunler?ozellik[]=vitrin" title="">Öne Çıkanlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/urunler?ozellik[]=yeni" title="">Yeni Gelenler</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="/takip" class="nav-link">
                                <i class="fas fa-bullseye"></i>
                                Sipariş Takibi
                            </a>
                        </li>

                        <?php $iletisim = json_decode(\App\Ayar::where('tip', 'iletisim')->first()->data, true) ?>

                        <li class="nav-item mr-0">
                            <a href="//wa.me/9<?php echo e(str_replace(' ', '', $iletisim['whatsapp'])); ?>?text=Merhaba" class="nav-link">
                                <i class="fab fa-whatsapp"></i>
                                <?php echo e($iletisim['whatsapp']); ?>

                            </a>
                        </li>
                    </ul>

                    <button class="menu-close"><img src="/assets/images/close.svg" alt="Menüyü Kapat"></button>
                </div>

                <nav id="ml-menu" class="menu">
                    <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
                    <div class="menu__wrap">
                        <ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="Hepsi">
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler" data-submenu="submenu-all" aria-owns="submenu-all">Bütün Ürünler</a>
                            </li>
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler?ozellik[]=indir">İndirimdekiler</a>
                            </li>
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler?ozellik[]=vitrin">Öne Çıkanlar</a>
                            </li>
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler?ozellik[]=yeni">Yeni Gelenler</a>
                            </li>
                            <?php if(count($markalar) > 0): ?>
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler" data-submenu="submenu-brand" aria-owns="submenu-brand">Markalar</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <ul data-menu="submenu-all" id="submenu-all" class="menu__level" tabindex="-1" role="menu" aria-label="Hepsi">

                            <?php  $altlar = []  ?>

                            <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php  $altlar[$kategori->id] = \App\Http\Controllers\Controller::kat_getir($kategori->id, $kategori->isim, true)  ?>

                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler/<?php echo e($kategori->url); ?>" 
                                <?php if(count($altlar[$kategori->id]) > 0): ?> data-submenu="submenu-<?php echo e($kategori->id); ?>" aria-owns="submenu-<?php echo e($kategori->id); ?>" <?php endif; ?>>
                                    <?php echo e($kategori->isim); ?>

                                </a>
                            </li>                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php $__currentLoopData = $altlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $kategoriler): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($kategoriler) > 0): ?>

                        <?php  $kategori = \App\Kategori::find($id)  ?>

                        <ul data-menu="submenu-<?php echo e($id); ?>" id="submenu-<?php echo e($id); ?>" class="menu__level" tabindex="-1" role="menu" aria-label="<?php echo e($kategori->isim); ?>">
                            <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $isim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php  $kategori = \App\Kategori::find($id)  ?>
                            
                            <li class="menu__item" role="menuitem">
                                <a href="/urunler/<?php echo e($kategori->url); ?>" class="menu__link">
                                    <!-- <img src="/img/<?php echo e($kategori->foto); ?>"> -->
                                    <?php echo e($kategori->isim); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($markalar) > 0): ?>
                        <ul data-menu="submenu-brand" id="submenu-brand" class="menu__level" tabindex="-1" role="menu" aria-label="Markalar">
                            <?php $__currentLoopData = $markalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="menu__item" role="menuitem">
                                <a class="menu__link" href="/urunler?marka[]=<?php echo e($marka->name); ?>">
                                    <img src="//entegre.ruberu.com.tr/assets/images/brands/<?php echo e($marka->photo); ?>">
                                    <?php echo e($marka->name); ?>

                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </nav>

            </div>
        </nav>

    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <footer>

        <div class="footer-top"></div>

        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-6">
                                <ul class="list-unstyled">
                                    <li class="list-title">Kurumsal</li>
                                    <li><a href="/hakkimizda">Hakkımızda</a></li>
                                    <li><a href="/kullanim-kosullari">Kullanım Koşulları</a></li>
                                    <li><a href="/gizlilik-politikasi">Gizlilik Politikası</a></li>
                                    <li><a href="/garanti-politikasi">Garanti Politikası</a></li>
                                    <li><a href="/uyelik-sozlesmesi">Üyelik Sözleşmesi</a></li>
                                    <li><a href="/kvkk-beyani">KVKK Beyanı</a></li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6">
                                <ul class="list-unstyled">
                                    <li class="list-title">Ürünler</li>
                                    <li><a href="/urunler">Bütün Ürünler</a></li>
                                    <li><a href="/urunler?ozellik[]=indir">İndirimdekiler</a></li>
                                    <li><a href="/urunler?ozellik[]=vitrin">Öne Çıkan Ürünler</a></li>
                                    <li><a href="/urunler?ozellik[]=yeni">Yeni Gelen Ürünler</a></li>
                                    <?php for($i = 1; $i <= 2; $i++): ?>
                                    <li><a href="/urunler?ara=<?php echo e($seo['arama_'. $i]); ?>"><?php echo e($seo['arama_'. $i]); ?></a></li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6">
                                <ul class="list-unstyled">
                                    <li class="list-title">Hesabım</li>
                                    <li><a href="/hesap/uyelik">Üyelik Bilgilerim</a></li>
                                    <li><a href="/hesap/siparis">Siparişlerim</a></li>
                                    <!-- <li><a href="#">Ödeme Seçenekleri</a></li>
                                    <li><a href="#">Ürün-Stok Bildirimi</a></li> -->
                                    <li><a href="/hesap/sifre">Şifre İşlemlerim</a></li>
                                    <li><a href="/hesap/adres">Adreslerim</a></li>
                                    <li><a href="/takip">Sipariş Takibi</a></li>
                                </ul>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-6">
                                <ul class="list-unstyled">
                                    <li class="list-title">Yardım</li>
                                    <!-- <li><a href="#">Sıkça Sorulan Sorular</a></li> -->
                                    <li><a href="/teslimat-kargo">Teslimat ve Kargo</a></li>
                                    <li><a href="/iptal-iade-degisim">İptal / İade ve Değişim</a></li>
                                    <li><a href="/satis-sozlesmesi">Satış Sözleşmesi</a></li>
                                    <li><a href="/on-bilgilendirme-formu">Ön Bilgilendirme Formu</a></li>
                                    <li><a href="/bize-ulasin">Bize Ulaşın</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 d-none d-xl-block">
                        <img src="/img/3d.jpg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img src="/img/iyzico-2.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-campaign">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 m-auto d-lg-flex">
                        <div class="col-lg-8 px-lg-0 text-left">
                           <?php echo e($seo['author']); ?>

                        </div>
                        <div class="col-lg-4 px-lg-0 text-right"> Copyright &copy; <?php echo e(date('Y')); ?></a></div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <div class="golge"></div>

    <button class="btn btn-primary d-none" data-toggle="modal" data-target="#form-sonuc">
        Form Sonuç Penceresini Aç
    </button>

    <div class="modal fade" id="form-sonuc" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">...</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">...</div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary d-none" data-toggle="modal" data-target="#sepet-sonuc">
        Sepet Sonuç Penceresini Aç
    </button>

    <div class="modal fade" id="sepet-sonuc" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="/img/check.png" alt="">
                    <b>Sepete Eklendi</b>
                    <span>...</span>
                    <a href="/sepet">Sepete Git</a>
                    <a href="#" data-dismiss="modal">Alışverişe Devam Et</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery-2.1.0.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function () {

            /* $(".mobile-menu").click(function () {
                
                $("#navbarSupportedContent").addClass('show-time', 1000);
            });

            $(".menu-close").click(function () {
                
                $("#navbarSupportedContent").removeClass('show-time', 1000);
            }); */

            $('[data-toggle="tooltip"]').tooltip();

            if ($(document).width() < 992) {

                $('[data-toggle="dropdown"]').click(function () {

                    $('.dropdown-menu:not([aria-labelledby="' + $(this).attr('id') + '"])').slideUp(250);

                    $('[aria-labelledby="' + $(this).attr('id') + '"]').slideToggle(250);
                });
            }

            else {

                var width = $('nav .dropdown-menu').closest('.container').width();

                $('nav .dropdown-menu').css('width', width);

                var kontrol = false;

                setInterval(function() { kontrol = false; }, 100);

                $('[data-toggle="dropdown"]').click(function (e) {

                    if (!kontrol)

                        if ($(this).attr('href') != '#') location.href = $(this).attr('href');
                });

                $('.nav-item.dropdown, #alt-menu').find('[data-toggle="dropdown"]').mouseenter(function(e) {

                    kontrol = true;

                    $(this).css('outline', 'none').trigger('click');

                    $('.golge').fadeIn(250);

                    $('header .navbar, header .nav-middle').css('z-index', 2);
                });

                $('.nav-item.dropdown, .list-inline-item.dropdown').mouseleave(function() {

                    $(this).trigger('click');

                    $('.golge').fadeOut(250);

                    setTimeout(function()
                    {
                        $('header .navbar, header .nav-middle').css('z-index', 0);

                    }, 250);
                });
            }
        });

        function uyari(baslik, mesaj)
        {
            $('#form-sonuc .modal-title').html(baslik);

            $('#form-sonuc .modal-body').html(mesaj);

            $('[data-target="#form-sonuc"]').trigger('click');
        }

    </script>

    <style>

        header .navbar .nav-item .nav-link:hover:after
        {
            bottom: 4px;
        }

        .footer-middle .col-xl-2 img
        {
            width: 100%;
            border-radius: 5px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            height: 130px;
            object-fit: cover;
        }

        .footer-middle .col-md-12 img
        {
            width: 100%;
            height: 60px;
            object-fit: contain;
            margin-top: 1rem;
            background-color: #fff;
            padding: 1rem;
            border-radius: .25rem;
        }

        @media (max-width: 1199px)
        {
            .footer-middle .col-xl-2 img
            {
                width: 250px;
                height: 220px;
                margin-top: 20px;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
        }

        @media (min-width: 992px)
        {
            header .nav-middle
            {
                position: relative;
                background: #fff;
            }

            header .navbar .nav-item .dropdown-menu
            {
                border: none;
                /*padding-bottom: 10px;*/
                margin-top: -4px;
            }

            header .navbar .nav-item .dropdown-menu ul
            {
                column-count: 3;
            }

            header .navbar .nav-item .dropdown-menu ul li
            {
                padding-left: 0;
                overflow: hidden;
                /*white-space: nowrap;*/
                text-overflow: ellipsis;
            }

            header .navbar .nav-item .dropdown-menu img
            {
                position: relative;
                width: 35px;
                height: 35px;
                object-fit: contain;
                margin-right: 5px;
            }

            .golge
            {
                z-index: 1;
                position: fixed;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, .5);
                top: 0;
                display: none;
            }
        }

        @media (max-width: 991px)
        {
            header .navbar .nav-item .dropdown-menu
            {
                padding-bottom: 10px;
                margin-bottom: 15px !important;
                max-height: 300px;
                overflow-y: scroll;
            }
        }

        .modal .modal-content,
        .modal .modal-header,
        .modal .modal-body
        {
            border-radius: 0;
        }

        .modal .modal-header
        {
            background: #009498;
            color: #fff;
            font-weight: 600;
        }

        .modal .close
        {
            opacity: 1;
            color: #fff;
        }

        .modal .close:focus
        {
            outline: none;
        }

        .modal .modal-footer .btn
        {
            cursor: pointer;
            background: #009498;
            color: #ffffff;
            font-weight: 900;
            padding: 0 20px;
            line-height: 30px;
            border: none;
        }

        .modal .modal-footer .btn-warning
        {
            background: #FF0000;
        }

        header .nav-middle .search-top ul li b
        {
            display: block;
            font-size: 12px;
            color: #4A4A4A;
            margin: 0;
            padding: 0 5px;
            line-height: 12px;
            height: 12px;
        }

        header .navbar .nav-item .nav-link,
        header .navbar .nav-item .dropdown-menu ul li a
        {
            font-weight: 700;
            text-transform: uppercase;
        }

        @media (max-width: 991px)
        {
            header .navbar .mobile-menu,
            header .navbar .menu-close
            {
                background: none;
                border: none;
            }

            header .navbar
            {
                height: 55px;
            }

            header .navbar .mobile-menu
            {
                top: 15px;
            }

            header .navbar .menu-close
            {
                top: 60px;
                right: 60px;
            }

            header .nav-middle .user
            {
                top: <?php echo e($kargo > 0 ? '136px' : '106px'); ?>;
                z-index: 1;
            }

            header .nav-middle .user a .icon--top
            {
                border-color: #FFF;
            }

            header .nav-middle .search
            {
                margin-right: 0 !important
            }
        }

        @media (max-width: 767px)
        {
            header .nav-middle .user
            {
                top: <?php echo e($kargo > 0 ? '196px' : '166px'); ?>;
            }

            header .navbar .menu-close
            {
                top: 10px;
                right: 10px;
            }

            header .navbar .nav-item .dropdown-menu,
            header .navbar .nav-item .dropdown-menu ul,
            header .navbar .nav-item .dropdown-menu ul li:last-child
            {
                margin-bottom: 0;
                height: auto;
            }

            .footer-top
            {
                display: none;
            }

            footer .footer-middle
            {
                padding: 22.5px 0;
            }

            footer .footer-middle .col-6:nth-child(3) ul,
            footer .footer-middle .col-6:last-child ul
            {
                margin-bottom: 0;
            }

            footer .footer-middle .list-title
            {
                margin-bottom: 10px;
            }

            footer .nav-campaign
            {
                height: auto;
                line-height: unset;
                padding: 15px 0;
            }

            footer .nav-campaign *
            {
                text-align: center !important;
            }

            footer .nav-campaign .text-right
            {
                margin-top: 10px;
            }

            footer .footer-middle a
            {
                font-size: 10px;
            }

            .breadcrumb
            {
                margin-bottom: 0;
                font-size: 12px;
                text-align: center;
            }
        }

        footer .nav-campaign div
        {
            height: 100%;
            font-size: 10pt;
        }

        footer .nav-campaign a
        {
            color: #fff;
        }

        @media (max-width: 991px)
        {
            footer .nav-campaign
            {
                height: auto;
                line-height: auto;
                padding-top: 15px;
                padding-bottom: 15px;
            }

            footer .nav-campaign div
            {
                height: auto;
                line-height: initial;
                text-align: center !important;
            }

            footer .nav-campaign .text-right
            {
                margin-top: 15px;
            }
        }

        #sepet-sonuc
        {
            text-align: center;
        }

        #sepet-sonuc .modal-header
        {
            background: #fff;
            border: none;
            padding-bottom: 0;
        }

        #sepet-sonuc .close
        {
            color: #A7A7A7;
        }

        #sepet-sonuc img
        {
            display: block;
            margin: 0 auto;
            margin-top: -15px;
        }

        #sepet-sonuc b
        {
            display: block;
            margin-bottom: 15px;
            color: #009498;
            font-size: 20pt;
        }

        #sepet-sonuc .modal-body span
        {
            display: block;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 16pt;
            line-height: 1;
        }

        #sepet-sonuc a
        {
            display: block;
            width: 250px;
            margin: 0 auto;
            margin-top: 7.5px;
            padding: .5rem 1rem;
            color: #fff;
            background: #009498;
            text-transform: uppercase;
            border-radius: 8px;
        }

        #sepet-sonuc a:hover
        {
            background: #046E71;
        }

        header .navbar .nav-item .dropdown-menu .col-md-4 .row
        {
            margin-left: -7.5px;
            margin-right: -7.5px;
            margin-bottom: -15px;
        }

        header .navbar .nav-item .dropdown-menu .col-md-4 .col-lg-3
        {
            margin-bottom: 15px;
            padding-left: 7.5px;
            padding-right: 7.5px;
        }

        header .navbar .nav-item .dropdown-menu .col-md-4 img
        {
            width: 100%;
            height: 75px;
            object-fit: cover;
        }

        @media (max-width: 991px)
        {
            header .navbar .nav-item .dropdown-menu ul li
            {
                padding-left: 0;
            }

            header .navbar .nav-item .dropdown-menu .col-md-4 img
            {
                position: relative;
            }
        }

    </style>

    <?php echo $__env->yieldContent('custom'); ?>

    <?php if(Session::has('conversion')): ?>
    <script>

        gtag('event', 'conversion', 
        {
            'send_to': 'AW-402712385/V1JXCOWl5fwBEMHOg8AB',
            'value': Number('1.0'),
            'currency': 'TRY',
            'transaction_id': '<?php echo e(Session::get("conversion")); ?>'
        });

    </script>

    <?php Session::forget('conversion') ?>

    <?php endif; ?>

    <script src="/assets/menu/js/classie.js"></script>
    <script src="/assets/menu/js/dummydata.js"></script>
    <script src="/assets/menu/js/main.js"></script>
    
    <script>
    
        (function() {
            var menuEl = document.getElementById('ml-menu'),
                mlmenu = new MLMenu(menuEl, {
                    // breadcrumbsCtrl : true, // show breadcrumbs
                    initialBreadcrumb : 'hepsi', // initial breadcrumb text
                    backCtrl : true, // show back button
                    // itemsDelayInterval : 60, // delay between each menu item sliding animation
                    // onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
                });

            // mobile menu toggle
            var openMenuCtrl = document.querySelector('.action--open'),
                closeMenuCtrl = document.querySelector('.action--close');

            openMenuCtrl.addEventListener('click', openMenu);
            closeMenuCtrl.addEventListener('click', closeMenu);

            function openMenu() {
                classie.add(menuEl, 'menu--open');
                closeMenuCtrl.focus();
            }

            function closeMenu() {
                classie.remove(menuEl, 'menu--open');
                openMenuCtrl.focus();
            }

            // simulate grid content loading
            var gridWrapper = document.querySelector('.content');

            function loadDummyData(ev, itemName) {
                ev.preventDefault();

                closeMenu();
                gridWrapper.innerHTML = '';
                classie.add(gridWrapper, 'content--loading');
                setTimeout(function() {
                    classie.remove(gridWrapper, 'content--loading');
                    gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
                }, 700);
            }
        })();

    </script>

</body>

</html>
