<?php $__env->startSection('title', $urun->isim); ?>

<?php $__env->startSection('content'); ?>

<?php if(isset($breadcrumb)): ?>
<div class="container">
    <div class="row breadcrumb-row align-items-center my-2">
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/urunler">Ürünler</a></li>

                    <?php $i = 1 ?>

                    <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="breadcrumb-item <?php if($i == count($breadcrumb)): ?> active <?php endif; ?>"
                    <?php if($i == count($breadcrumb)): ?> aria-current="page" <?php endif; ?>>
                        <a href="<?php echo e($url); ?>"><?php echo e($name); ?></a>
                    </li>

                    <?php $i++ ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </nav>
        </div>
        
        <?php $limit = \DB::table('ayar')->where('tip', 'ucretsiz')->first()->data ?>
        
        <?php if(($urun->indirim && $urun->indirim >= $limit) || ($urun->fiyat >= $limit)): ?>
        <div class="col-md-3 text-md-right text-left mt-md-0 mt-2">
            <h3>Ücretsiz Kargo</h3>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<div style="height: 30px"></div>
<?php endif; ?>

<div class="container">
    <div class="row mb-lg-5 mb-md-4 mb-5">
        <div class="col-xl-6 col-lg-5 col-md-4">
            <div class="detail-slide">
                <?php if(count($fotolar) > 0 || strpos($urun->video, '/watch?v=') !== false): ?>
                <?php if(count($fotolar) > 0): ?>
                <?php $__currentLoopData = $fotolar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="">
                    <img src="/img/<?php echo e($foto->deger); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if(strpos($urun->video, '/watch?v=') !== false): ?>
                <div class="">
                    
                    <?php $temp = explode('/watch?v=', $urun->video) ?>                    
                    
                    <iframe src="//www.youtube.com/embed/<?php echo e($temp[1]); ?>?rel=0&showinfo=0" allowfullscreen></iframe>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <div class="">
                    <img src="/img/logo.png" class="img-fluid" alt="<?php echo e($urun->isim); ?>"
                    width="85%" style="opacity: .5">
                </div>
                <?php endif; ?>
            </div>
            <?php if(count($fotolar) > 1): ?>
            <div class="row thumbnails">
                <div class="col-10 m-auto">
                    <div class="row justify-content-center">
                        <?php if(count($fotolar) > 0 || strpos($urun->video, '/watch?v=') !== false): ?>
                        <?php if(count($fotolar) > 0): ?>
                        <?php $__currentLoopData = $fotolar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-2 col-md-4 col-3 px-0">
                            <a href="/img/<?php echo e($foto->deger); ?>" data-fancybox="gallery">
                                <img src="/img/<?php echo e($foto->deger); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>">
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(strpos($urun->video, '/watch?v=') !== false): ?>
                        <div class="col-lg-2 col-md-4 col-3 px-0">
                            <a href="//www.youtube.com/embed/<?php echo e($temp[1]); ?>?rel=0&showinfo=0" data-fancybox="gallery">
                                <img src="//img.youtube.com/vi/<?php echo e($temp[1]); ?>/hqdefault.jpg" class="img-fluid" alt="<?php echo e($urun->isim); ?>">
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php else: ?>
                        <div class="col-lg-2 col-md-4 col-3 px-0">
                            <a href="/img/logo.png" data-fancybox="gallery">
                                <img src="/img/logo.png" class="img-fluid" alt="<?php echo e($urun->isim); ?>">
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-6 col-lg-7 col-md-8 detail-content mb-0">
          <!-- <h1><?php echo e($urun->isim); ?></h1> -->
          <?php if($urun->marka): ?>
          <a href="/urunler?marka[]=<?php echo e($urun->marka); ?>" class="brand"><?php echo e($urun->marka); ?></a>
          <?php endif; ?>
            <h1>
                <?php echo e($urun->isim); ?>

                <!-- <?php if($urun->kod): ?>
                <small><?php echo e($urun->kod); ?></small>
                <?php endif; ?> -->
            </h1>

            <?php if($urun->on_aciklama): ?>
            <div class="mt-3"></div>
            <?php echo $urun->on_aciklama ?>
            <?php endif; ?>
            <?php if($urun->indirim > 0): ?>
            <div class="prices d-flex align-items-center">
                <span class="old"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                <span class="product-price"><?php echo e(number_format($urun->indirim, 2, ',', '.')); ?> TL</span>
            </div>

            <?php $oran = 100 - ($urun->indirim / $urun->fiyat * 100); ?>

            <span class="winnings">Kazancınız %<?php echo e(intval($oran)); ?></span>
            <?php else: ?>
            <div class="prices d-flex align-items-center">
                <span class="product-price"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
            </div>
            <?php endif; ?>
            <?php if(!$urun->set): ?>
                <?php if(!$urun->paket): ?>
                    <?php if($urun->stok > 0): ?>
                        <form class="add-basket d-flex">
                            <div class="basket-select-amount">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="adet">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" name="adet" class="form-control input-number" value="1" min="1" max="<?php echo e($urun->stok); ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="adet">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                            <button class="add-basket-button">SEPETE EKLE</button>
                        </form>
                    <?php else: ?>
                        <div class="add-basket d-flex">
                            <div class="basket-select-amount">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="adet">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" name="adet" class="form-control input-number" value="0" min="0" max="0" disabled>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="adet">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                            <button class="add-basket-button" disabled>STOKTA YOK</button>
                        </div>
                    <?php endif; ?>

                    <?php

                    $variants = \App\Urun::select('urun.*', 'foto.deger AS profil')
                        ->join('foto', function($join)
                        {
                            $join->on('foto.urun_id', '=', 'urun.id')->where('foto.profil', 1);
                        })
                        ->where('urun.model_kod', '!=', null)
                        ->where('urun.model_kod', $urun->model_kod)
                        ->where('urun.id', '!=', $urun->id)
                        ->where('urun.sil', 0)
                        // ->limit(15)
                        ->inRandomOrder()
                        ->get()

                    ?>

                    <?php if(count($variants) > 0): ?>
                    <h4 class="mt-3 mb-0">Diğer Modeller</h4>
                    <div class="d-flex flex-wrap mb-3" style="margin-left: -.5rem; margin-right: -.5rem">
                        <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="/urun/<?php echo e($variant->url); ?>" class="d-block mx-2 mt-1">
                            <img src="/img/<?php echo e($variant->profil); ?>" class="img-fluid" alt="<?php echo e($variant->isim); ?>"
                            style="height: 75px; object-fit: contain; width: 75px">
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                <?php else: ?>

                    <?php $setler = \App\Urun::where('set', 'like', '%"'. $urun->id .'"%')->where('sil', 0)->get() ?>

                    <div class="py-3">
                        Paket ürünüdür, tek olarak satılamaz.
                        <?php if(count($setler) > 0): ?>
                        Ürünün bulunduğu paketler;
                        <?php endif; ?>
                    </div>

                    <?php if(count($setler) > 0): ?>
                        <?php $__currentLoopData = $setler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun_s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="add-basket row mx-0 align-items-center py-1">
                            <div class="product-name col-md-9">
                                <a href="/urun/<?php echo e($urun_s->url); ?>"><?php echo e($urun_s->isim); ?></a>
                            </div>
                            <button class="add-basket-button col-md-3" disabled>
                                <?php echo e(number_format($urun_s->indirim, 2, '.', ',')); ?> TL
                            </button>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="py-2"></div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="py-2"></div>
                <?php $__currentLoopData = json_decode($urun->set); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $urun_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $urun_s = \App\Urun::find($urun_id) ?>

                <form class="add-basket row mx-0 align-items-center py-1" data="<?php echo e($urun_s->id); ?>">
                    <div class="product-name col-md-7 col-12">
                        <a href="/urun/<?php echo e($urun_s->url); ?>"><?php echo e($urun_s->isim); ?></a>
                    </div>
                    <div class="basket-select-amount col-md-2 col-6 px-0">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="adet-<?php echo e($i); ?>">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="adet-<?php echo e($i); ?>" class="form-control input-number w-100"
                        <?php if ($urun_s->stok) : ?> value="1" min="1" max="<?php echo e($urun_s->stok); ?>" <?php else : ?>
                        value="0" min="0" max="0" disabled <?php endif ?>>
                        <input type="hidden" name="adet" value="<?php echo e($urun_s->stok ? 1 : 0); ?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="adet-<?php echo e($i); ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                    <button class="add-basket-button col-md-3 col-6" disabled>
                        <?php echo e(number_format($urun_s->indirim > 0 ? $urun_s->indirim : $urun_s->fiyat, 2, '.', ',')); ?> TL
                    </button>
                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="py-3">
                    <button class="add-basket-button">SEPETE EKLE</button>
                </div>
            <?php endif; ?>

            <?php if($urun->ozellik): ?>
            <ul class="inf">
                <?php $__currentLoopData = json_decode($urun->ozellik); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ozellik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($ozellik); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
            <div class="share-products <?php if(!$urun->ozellik): ?> mt-0 <?php endif; ?>">
                <span>Bu Ürünü Paylaş</span>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row sub-features mb-lg-5 mb-md-4 text-center">
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb1.svg" alt="<?php echo e($limit); ?> TL ÜSTÜ ÜCRETSİZ KARGO">
              <h4><?php echo e($limit); ?> TL ÜSTÜ ÜCRETSİZ KARGO</h4>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb2.svg" alt="KOLAY İADE İMKANI">
              <h4>KOLAY İADE İMKANI</h4>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb6.svg" alt="24 SAAT İÇİNDE KARGO">
              <h4>24 SAAT İÇİNDE KARGO</h4>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb5.svg" alt="VADE FARKSIZ 3 TAKSİT">
              <h4>VADE FARKSIZ 3 TAKSİT</h4>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb4.svg" alt="GÜVENLİ ALIŞVERİŞ">
              <h4>GÜVENLİ ALIŞVERİŞ</h4>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="features-item">
              <img src="/assets/images/icb7.svg" alt="KAPIDA ÖDEME İMKANI">
              <h4>KAPIDA ÖDEME İMKANI</h4>
            </div>
        </div>
    </div>
</div>

<?php $pos_info = json_decode(\App\Ayar::where('tip', 'pos')->first()->data, true) ?>

<div class="detail-tabs">
    <div class="container text-center">
        <ul class="list-inline">
            <li class="list-inline-item active">
                <a href="#tab-1">Ürün Açıklaması</a>
            </li>
            <?php if($pos_info['banka'] == 'iyzico'): ?>
            <li class="list-inline-item">
                <a href="#tab-5">Taksit</a>
            </li>
            <?php endif; ?>
            <?php if($urun->video): ?>
            <li class="list-inline-item">
                <a href="#tab-2">Video</a>
            </li>
            <?php endif; ?>
            <li class="list-inline-item">
                <a href="#tab-3">Yorumlar</a>
            </li>
            <li class="list-inline-item">
                <a href="#tab-4">İade Koşulları</a>
            </li>
        </ul>
    </div>
</div>

<div class="container detail-tabs-content fade show" id="tab-1">
    <div class="detail-tab-content">

        <?php if($urun->aciklama): ?>
        <?php echo $urun->aciklama ?>
        <?php endif; ?>

        <?php if($urun->teknik): ?>
        <div class="row">
            <div class="col-12">
                <ul class="mb-0">
                    <?php $__currentLoopData = json_decode($urun->teknik); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isim => $aciklama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="title"><?php echo e($isim); ?>:</span>
                        <span class="list-content"><?php echo e($aciklama); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php if($urun->foto): ?>
        <?php $__currentLoopData = json_decode($urun->foto); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="image-content">
            <img src="/img/<?php echo e($foto); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!$urun->aciklama && !$urun->teknik && !$urun->foto): ?>
        <div class="row">
            <div class="col-12">
                Bu ürün için açıklama girilmedi..
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php if($urun->video): ?>
<div class="container detail-tabs-content fade" id="tab-2">
    <div class="detail-tab-content">

        <?php $temp = explode('/watch?v=', $urun->video) ?>

        <iframe src="https://www.youtube.com/embed/<?php echo e($temp[1]); ?>?rel=0&showinfo=0" allowfullscreen></iframe>
    </div>
</div>
<?php endif; ?>

<div class="container detail-tabs-content fade" id="tab-3">
    <div class="detail-tab-content">
        <form class="row forms mt-4 mb-md-5" id="yorum-form">
            <div class="col-xl-8 col-lg-8 m-auto">
                <div class="row align-items-center">
                    <div class="col-md-8 pr-half">
                        <div class="form-line">
                            <label for="">Ad & Soyad</label>
                            <input type="text" name="isim" required>
                        </div>
                    </div>
                    <div class="col-md-4 pl-half">
                        <div class="form-line-no-line py-0">
                            <div class="stars m-auto" click="0">
                                <div style="overflow: hidden; width: 0">
                                    <img src="/img/stars-checked.png" height="30">
                                </div>
                            </div>
                            <input type="hidden" name="puan" required>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-line">
                            <label for="">Yorum</label>
                            <textarea name="yorum" required rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-line-no-line py-0 mb-0">
                            <button class="ml-0">GÖNDER</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php if(count($yorumlar) > 0): ?>
        <?php $__currentLoopData = $yorumlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $yorum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mt-<?php echo e($i == 0 ? 5 : 3); ?> yorum">
            <div class="col-xl-8 col-lg-8 m-auto">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <b><?php echo e($yorum->isim); ?></b><br>
                        <small class="d-block mt-2"><?php echo e(date('d/m/Y - H:i', strtotime($yorum->tarih))); ?></small>
                    </div>
                    <div class="col-md-4">
                        <div class="stars m-auto">
                            <div style="overflow: hidden; width: <?php echo e($yorum->puan * 20); ?>%">
                                <img src="/img/stars-checked.png" height="20">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mb-0 mt-3"><?php echo e($yorum->yorum); ?></p>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div style="height: 2rem" class="d-none d-md-block"></div>
        <?php endif; ?>
    </div>
</div>

<div class="container detail-tabs-content fade" id="tab-4">
    <div class="detail-tab-content">
        <div class="row" style="font-size: 10pt">
            <div id="primary" class="content-area col-xs-12">
                <main id="main" class="site-main" role="main">
                    <article id="post-20" class="post-20 page type-page status-publish hentry">
                        <p><strong>DEĞİŞİM</strong></p>
                        <p><strong>Ürünlerde Değişim Süresi Ne Kadar?</strong></p>
                        <p><?php echo e(str_replace(['http://', 'https://'], '', url('/'))); ?> adresinden satın almış olduğunuz ürünlerin kullanılmamış olması şartıyla değişim süresi fatura tarihinden itibaren “15 GÜN”dür.</p>
                        <p><strong>Değişim İşlemini Nasıl Gerçekleştirebilirim?</strong></p>
                        <p>1- Değişimini yapmak istediğiniz ürün/ürünleri faturası ile beraber, fatura üzerinde bulunan merkez adresimize anlaşmalı olduğumuz kargo firmamız Yurtiçi Kargo aracılığıyla göndermeniz gerekmektedir.</p>
                        <p>2- Gönderdiğiniz kargo bize ulaştıktan sonra değişim siparişinizi oluşturmak için istediğiniz ürünlerin stokları tükenmeden iletişim sayfamızdaki bilgilerden iletişime geçmelisiniz.</p>
                        <p>3- İlgili ekibimiz gönderdiğiniz ürün ve verdiğiniz sipariş doğrultusunda değişim işleminizi gerçekleştirecektir.</p>
                        <p><strong>Değişim İşleminde Kargo Ücreti Ödeyecek miyim?</strong></p>
                        <p>1- Satın alınmış ürün ayıplı/defolu/yanlış şekilde tarafınıza ulaştıysa ayıplı/defolu/yanlış ürünü bizim adresimize gönderirken anlaşmalı olduğumuz kargo firmasını kullanırsanız kargo ücretini biz karşılıyoruz. Farklı bir kargo firması ile gönderim yapmanız durumunda kargo ücretini karşılamamaktayız.</p>
                        <p>2- Ayıplı/Defolu/Yanlış olmayan ürünlerin değişim işlemlerinde tarafımıza gönderirken kargo ücretini siz karşılıyorsunuz, ürün değişim işleminden sonra size gönderilen yeni ürününüzün kargo ücreti tarafınıza yansıtılmaktadır.</p>
                        <p>3- Değişimine karar verdiğiniz ürününüzü tarafımıza gönderirken kargo ücretleri sizin tarafınızdan karşılanmaktadır. Yeni ürününüzü size gönderirken Kargo Ücreti Tarafınıza Yansıtılacaktır.</p>
                        <p>4- İndirimli ürünlerde değişim ve iade KESİNLİKLE YOKTUR.</p>
                        <p><strong>Kapıda Ödeme Hakkında Önemli Bilgilendirme</strong></p>
                        <p>Aşağıdaki bildiri sitemiz üzerinden kapıda ödeme yöntemiyle sipariş verip kargosunu hiçbir şekilde teslim almayanlar içindir.</p>
                        <p>Kapıda ödeme ile satın alınmış ürünlerin kargodan teslim alınması zorunludur. Teslim alınmayan ürünler iade edilemez. Teslim alınmayıp iade gelen paketler, firma tarafından kargo maliyeti eklenerek müşteriye tekrar gönderilmek üzere bekletilir.</p>
                        <p>Aynı şekilde ürün teslim alınmazsa satış sözleşmesi, onay alınması için telefon görüşmesi kayıtları ve alıcının beyan ettiği adresi, sipariş esnasında kullanılan bilgisayar yer adresi (IP/ MAC Adresi) delil olarak kullanılarak; Kapıda ödeme ile alışveriş imkanını kötüye kullanma, tedarikçi, kargo ve paketleme görevlisini gereksiz kullanma ve iş gücünü yavaşlatma sebepleriyle; kargo masrafları, işletme masraflarının tamamının yasal yollarla tazmini için hukuki işlem başlatılır.</p>
                        <p>Alıcı kapıda ödemeli olarak satın aldığı ve teslim almayarak şirketi zarara uğrattığı her malın ve kargo dahil fatura tutarının en az kırk (40) en fazla doksan (90) katı kadar tazminat bedelini site sahiplerine peşinen ödemeyi resmen beyan eder.</p>
                        <p><strong>Değiştirdiğim Ürün Gönderdiğim Üründen Daha Pahalı</strong></p>
                        <p>1- Değişim siparişinizdeki ürünlerin toplam tutarı gönderdiğiniz ürün/ürünlerin tutarından yüksek ise kalan tutar KAPIDA ÖDEME olarak size yansıtılacaktır.</p>
                        <p>2- KAPIDA ÖDEMELİ KARGO ÜCRETİ HİZMET BEDELİ DAHİL 5,00 TÜRK LİRASIDIR. TUTAR FARKI OLAN TÜM KARGOLARA 5,00 LİRA KARGO ÜCRETİ YANSITILIR VE ALICI TARAFINDAN KARŞILANIR.</p>
                        <p><strong>İPTAL &amp; İADE</strong></p>
                        <p>Siparişim ayıplı/defolu/yanlış gönderilmiş Ne yapmalıyım?</p>
                        <p>Satışa sunduğumuz tüm ürünler, kargoya teslim edilmek üzere paketlenirken hasar kontrolünden geçer. Nadiren yaşanılan ürün ayıplı/defolu/yanlış şekilde tarafınıza ulaştıysa böyle bir durumda süreç şu şekilde işlemektedir;</p>
                        <p>Siparişiniz kargo görevlisi tarafından adresinize ulaştırıldığında, ürünü teslim almadan önce mutlaka dış pakette hasar kontrolü yapın ve herhangi bir hasar gördüğünüz anda “Durum Tespit Tutanağı” hazırlatın.</p>
                        <p>Sipariş tesliminden sonra fark ettiğiniz bir hasar durumunda, ilgili kargo şubesiyle hemen iletişim kurmanız ve “Durum Tespit Tutanağı” hazırlamalarını istemeniz gerekir. Eğer kargo şubesi size bu konuda yardımcı olmuyorsa, lütfen en kısa sürede bizi bilgilendirin.</p>
                        <p>Hasar Tespit Tutanağı ile birlikte hasarlı ürünü … adresimize gönderdiğinizde ürün değişim ya da iade işlemleriniz hızla tamamlanır ve size bu konuda bilgi verilir.</p>
                        <p><strong>Ürün İadesi yaptığımda ödediğim tutar bana nasıl iade edilecek?</strong></p>
                        <p>Ürün iadesi yaptığınız zaman, ürün incelemeden kabul onayı aldıktan sonra, ödeme şeklinize sadık kalınarak paranız iade yapılmaktadır.</p>
                        <p>– Ödemenizi kredi kartıyla gerçekleştirdiyseniz, taksitli işlemleriniz taksitli olarak, tek çekim işlemleriniz tek çekim olarak 7 iş günü içerisinde kartınıza iade edilir.</p>
                        <p>– Ödemenizi debit kart ile gerçekleştirdiyseniz, tek çekim olan işleminiz banka hesabınıza havale / eft yoluyla 7 iş günü içerisinde iade edilir.</p>
                        <p>– Ödemenizi sanal kart ile gerçekleştirdiyseniz, tek çekim işleminiz kartınıza 7 iş günü içerisinde iade edilir.</p>
                        <p>– Kapıda ödeme seçeneği ile ödeme yaptıysanız tarafımıza ileteceğiniz IBAN numarasına 7 iş günü içerisinde iade edilir.</p>
                        <p>Ürün İadesi Hesabıma Neden Geçmedi?</p>
                        <p>Vermiş olduğunuz IBAN dan kaynaklı bir sorun olabilir. Detaylı bilgi için iletişim sayfamız üzerinden iletişime geçebilirsiniz.</p>
                        <p>* DEĞİŞİM İŞLEMLERİNDE FATURA İBRAZI ZORUNLUDUR.</p>
                        <p>* DEĞİŞİM VE İADE İŞLEMLERİNDE ANLAŞMALI KARGO FİRMAMIZ SÜRAT KARGO İLE GÖNDERİM YAPMANIZ GEREKMEKTEDİR. DİĞER KARGO FİRMALARI İLE GÖNDERİLEN GÖNDERİLERİN KARGO ÜCRETLERİ FİRMAMIZ TARAFINDAN KARŞILANMAMAKTADIR.</p>
                        <ul>
                            <li>OUTLET GRUBUNA GİREN ÜRÜNLERDE DEĞİŞİM BULUNMAMAKTADIR.</li>
                        </ul>
                        <p>….’ nin internet yüzü olan <?php echo e(str_replace(['http://', 'https://'], '', url('/'))); ?>’den yapmış olduğunuz siparişlerde yukarıdaki şartlar yerine getirildiği halde değişim ve iade hakkınızı kullanabilirsiniz.</p>
                    </article>
                    <!-- #post-## -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
    </div>
</div>

<?php if($pos_info['banka'] == 'iyzico'): ?>
<div class="container detail-tabs-content fade taksit" id="tab-5">

    <?php

    require_once(app_path('Http/Controllers/Iyzipay/IyzipayBootstrap.php'));

    \IyzipayBootstrap::init();

    $options = new \Iyzipay\Options();
    $options->setApiKey($pos_info['api_key']);
    $options->setSecretKey($pos_info['secret_key']);
    $options->setBaseUrl("https://api.iyzipay.com");

    $request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
    // $request->setLocale(\Iyzipay\Model\Locale::TR);
    // $request->setConversationId("123456789");
    // $request->setBinNumber("554960");

    $request->setPrice($urun->indirim > 0 ? $urun->indirim : $urun->fiyat);

    $installmentInfo = \Iyzipay\Model\InstallmentInfo::retrieve($request, $options);

    if ($installmentInfo->getStatus() != 'success') :

    ?>

    <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e($installmentInfo->getErrorMessage()); ?>


    <?php else : ?>

    <div class="row">

        <?php

        $bank_logo = ['Maximum.8a685c21', 'Cardfinans.71adfdda', 'Paraf.8d4eccff', 'World.59e42135', 'Axess.44ebaa70', 'Bonus.1439132b'];

        $installmentInfo = json_decode($installmentInfo->getRawResult());

        foreach ($installmentInfo->installmentDetails as $i => $installmentDetails) :

            if (!isset($bank_logo[$i]))

                continue;

        ?>

        <div class="col-md-4">
            <img src="//sandbox-merchant.iyzipay.com/static/media/<?php echo e($bank_logo[$i]); ?>.svg" alt="<?php echo e($installmentDetails->bankName); ?>">
            <table class="table-sm" width="100%">
                <tr>
                    <th>Taksit</th>
                    <th>Tutar</th>
                    <th>Toplam</th>
                </tr>

                <?php

                foreach ($installmentDetails->installmentPrices as $installmentPrices) :

                    if ($installmentPrices->installmentNumber == 1) continue;

                ?>

                <tr>
                    <td><?php echo e($installmentPrices->installmentNumber); ?></td>
                    <td><?php echo e($installmentPrices->installmentPrice); ?></td>
                    <td><?php echo e($installmentPrices->totalPrice); ?></td>
                </tr>

                <?php endforeach ?>

            </table>
        </div>

        <?php endforeach ?>

    </div>

    <?php endif ?>

</div>
<?php endif; ?>

<div class="container">
    <?php if(isset($bakanlar)): ?>
    <section class="row products">
        <div class="box-title">
            <h2>BU ÜRÜNE BAKANLAR BU ÜRÜNLERE DE BAKTI</h2>
        </div>
        <?php $__currentLoopData = $bakanlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun_d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-6">
            <a href="/urun/<?php echo e($urun_d->url); ?>">
                <div class="product-container">

                    <?php

                    $profil = \App\Foto::where('profil', 1)
                                        ->where('urun_id', $urun_d->id)
                                        ->first();

                    $profil = $profil ? $profil->deger : 'logo.png';

                    ?>

                    <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun_d->isim); ?>"
                    <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                    <h5>
                        <?php echo e($urun_d->isim); ?>

                        <!-- <?php if($urun_d->kod): ?>
                        <small><?php echo e($urun_d->kod); ?></small>
                        <?php endif; ?> -->
                    </h5>
                    <div class="prices text-center">
                        <?php if($urun_d->indirim > 0): ?>
                        <span class="old"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun_d->indirim, 2, ',', '.')); ?> TL</span>
                        <?php else: ?>
                        <span class="old invisible"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <?php endif; ?>
                    </div>
                    <?php if($urun_d->indirim > 0): ?>
                    <span class="winnings">Kazancınız %<?php echo e(intval($urun_d->oran)); ?></span>
                    <?php else: ?>
                    <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun_d->oran)); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="hover">
                <?php if($urun_d->stok && !$urun_d->paket): ?>
                <a href="<?php echo e($urun_d->id); ?>" class="add-basket-d">Sepete Ekle</a>
                <?php endif; ?>
                <a href="/urun/<?php echo e($urun_d->url); ?>">İncele</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
    <?php if(isset($digerler) && $urun->kat_id): ?>
    <?php if(count($digerler) > 0): ?>
    <section class="row products">
        <div class="box-title">
            <h2>BU KATEGORİDEKİ DİĞER ÜRÜNLER</h2>
        </div>
        <?php $__currentLoopData = $digerler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun_d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-6 col-6">
            <a href="/urun/<?php echo e($urun_d->url); ?>">
                <div class="product-container">

                    <?php

                    $profil = \App\Foto::where('profil', 1)
                                        ->where('urun_id', $urun_d->id)
                                        ->first();

                    $profil = $profil ? $profil->deger : 'logo.png';

                    ?>

                    <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun_d->isim); ?>"
                    <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                    <h5>
                        <?php echo e($urun_d->isim); ?>

                        <!-- <?php if($urun_d->kod): ?>
                        <small><?php echo e($urun_d->kod); ?></small>
                        <?php endif; ?> -->
                    </h5>
                    <div class="prices text-center">
                        <?php if($urun_d->indirim > 0): ?>
                        <span class="old"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun_d->indirim, 2, ',', '.')); ?> TL</span>
                        <?php else: ?>
                        <span class="old invisible"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun_d->fiyat, 2, ',', '.')); ?> TL</span>
                        <?php endif; ?>
                    </div>
                    <?php if($urun_d->indirim > 0): ?>
                    <span class="winnings">Kazancınız %<?php echo e(intval($urun_d->oran)); ?></span>
                    <?php else: ?>
                    <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun_d->oran)); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="hover">
                <?php if($urun_d->stok && !$urun_d->paket): ?>
                <a href="<?php echo e($urun_d->id); ?>" class="add-basket-d">Sepete Ekle</a>
                <?php endif; ?>
                <a href="/urun/<?php echo e($urun_d->url); ?>">İncele</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<link rel="stylesheet" href="/css/slick.css">
<script src="/assets/js/slick.min.js"></script>

<link rel="stylesheet" href="/assets/css/jquery.fancybox.min.css">
<script src="/assets/js/jquery.fancybox.min.js"></script>

<style>

    .taksit
    {
        margin-bottom: -1rem;
    }

    .taksit [class^="col"]
    {
        margin-bottom: 1rem;
    }

    .taksit tr:nth-child(even)
    {
        background: #eee;
    }

    .taksit img
    {
        height: 50px;
        width: 100%;
        object-fit: contain;
        object-position: center top;
        margin-bottom: .5rem;
    }

    .taksit td,
    .taksit th
    {
        font-size: 10pt;
        padding: .25rem;
        text-align: center;
    }

    <?php if ($urun->set || $urun->paket) : ?>

    .product-name
    {
        border: solid 1px #046E71;
        border-right: none;
        height: 50px;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        padding: 0 7.5px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-name a
    {
        display: block;
        font-size: 10pt;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        line-height: 1.125;
        color: #000;
    }

    .product-name a:hover
    {
        color: #009498;
        text-decoration: none;
    }

    .input-number
    {
        border-radius: 0 !important;
    }

    <?php if (!$urun->paket) : ?>

    .add-basket-button
    {
        border-radius: 8px;
    }

    .add-basket-button:focus
    {
        outline: 0;
    }

    form .add-basket-button
    {
        border-radius: 0 8px 8px 0;
    }

    <?php endif ?>

    <?php endif ?>

    .input-number:focus
    {
        outline: unset;
        box-shadow: unset;
    }

    .detail-tabs-content
    {
        display: none;
        margin-bottom: 3rem;
    }

    .detail-tabs-content.show
    {
        display: block;
    }

    /*#tab-1 ul
    {
        column-count: 3;
    }*/

    .add-basket-button[disabled]
    {
        cursor: no-drop;
    }

    .forms
    {
        margin: -20px;
    }

    .forms .form-line,
    .forms .form-line-no-line
    {
        margin-bottom: 15px;
    }

    .forms .pr-half
    {
        padding-right: 7.5px;
    }

    .forms .pl-half
    {
        padding-left: 7.5px;
    }

    .stars
    {
        width: 160px;
        height: 30px;
        background: url('/img/stars.png');
        background-size: contain;
        cursor: pointer
    }

    .yorum
    {
        margin-left: 0;
        margin-right: 0;
    }

    .yorum .col-lg-8.m-auto
    {
        padding: 1rem;
        background: rgba(4, 110, 113, .25);
        font-size: 11pt;
    }

    .yorum .stars
    {
        height: 20px;
        width: calc(160px / 3 * 2);
        background: none;
    }

    .products a
    {
        display: block;
        border: 1px solid #707070;
        border-radius: 10px;
        padding: .5rem;
        height: 100%;
    }

    .products a:hover
    {
        border-color: #009498;
        box-shadow: 0 0 5px rgba(0, 0, 0, .25);
    }

    .products img
    {
        margin-bottom: 0;
        width: 100%;
    }

    .products .prices .old
    {
        display: table;
        margin: 0 auto;
        text-align: center;
        color: #383838;
        margin-bottom: 5px;
        width: auto;
    }

    .products .prices .old::after
    {
        display: none;
    }

    .products .prices .old::before
    {
        width: 120%;
        display: block;
        height: 1px;
        background: #ff0000;
        content: '';
        position: absolute;
        left: -10%;
        top: 50%;
    }

    .products h5
    {
        margin-bottom: 0;
        padding: 0 .5rem;
        margin-top: 10px;
        color: #000;
        transition: .125s;
    }

    .products .prices
    {
        padding-top: 10px;
        padding-bottom: 0;
        line-height: 1;
    }

    .products .winnings
    {
        display: none;
        background: #ff0000;
        color: #fff;
        font-size: 10pt;
        padding: 5px 10px;
        margin-top: 10px;
    }

    .products .col-xl-3
    {
        position: relative;
    }

    .products .col-xl-3:hover .hover
    {
        opacity: 1;
    }

    .products .hover
    {
        position: absolute;
        top: 0;
        left: 15px;
        right: 15px;
        height: 100%;
        /* background: rgba(255, 255, 255, .75); */
        transition: .25s;
        opacity: 0;
        border: 1px solid #707070;
        border-radius: 10px;
        display: none;
    }

    .products .hover a
    {
        height: auto;
        display: inline-block;
        background: #009498;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        width: 80%;
        font-size: 10pt;
        transition: .25s;
        border: none;
    }

    .products .hover a:hover
    {
        background: #ff0000;
        box-shadow: none;
    }

    .products .hover a:first-child
    {
        margin-bottom: 7.5px;
    }

    .detail-slide .slick-slide img
    {
        object-fit: contain;
        max-height: 400px;
    }

    .detail-slide button
    {
        top: calc(50% - 30px);
        background-color: unset;
        z-index: 1;
    }

    .detail-tab-content ul li
    {
        line-height: 1;
        margin-bottom: 10px;
    }

    .detail-tab-content ul li .title
    {
        width: auto;
    }

    .detail-tab-content iframe
    {
        width: 100%;
        height: 400px;
        border: none;
    }

    .detail-content .prices .old::after
    {
        display: none;
    }

    .detail-content .prices .old::before
    {
        width: 120%;
        display: block;
        height: 1px;
        background: #ff0000;
        content: '';
        position: absolute;
        left: -10%;
        top: 50%;
    }

    #tab-1 ul
    {
        padding-left: 1rem;
    }

    @media (max-width: 991px) and (min-width: 768px)
    {
        .products .col-md-6:nth-child(2),
        .products .col-md-6:nth-child(3)
        {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 991px)
    {
        <?php if ($urun->set || $urun->paket) : ?>

        .add-basket-button
        {
            padding: 0 15px;
        }

        .basket-select-amount input
        {
            font-size: 15px;
        }

        <?php endif ?>

        .detail-content .inf li
        {
            font-size: 12px;
        }

        .detail-slide .slick-slide img
        {
            min-height: auto;
        }

        .detail-slide button
        {
            top: calc(50% - 15px);
            background-size: auto 30px;
            background-repeat: no-repeat;
        }

        .detail-slide .slick-next
        {
            background-position-x: right;
        }

        .detail-slide .slick-prev
        {
            background-position-x: left;
        }

        .detail-tabs-content
        {
            margin-bottom: 1.5rem;
        }

        .yorum
        {
            margin-left: -5px;
            margin-right: -5px;
        }

        .box-title h2
        {
            margin-top: 15px;
        }

        .products
        {
            margin-bottom: 30px;
        }

        .breadcrumb
        {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px)
    {
        <?php if ($urun->set || $urun->paket) : ?>

        .add-basket-button
        {
            border-radius: 0;

            <?php if ($urun->set) : ?>

            width: 100%;

            <?php endif ?>
        }

        .product-name
        {
            border-right: solid 1px #046E71;
            border-radius: 8px 8px 0 0;
        }

        <?php if (!$urun->paket) : ?>

        form .add-basket-button
        {
            border-radius: 0 0 8px 0;
        }

        .input-number
        {
            border-radius: 0 0 0 8px !important;
        }

        <?php endif ?>

        <?php endif ?>

        .box-title h2
        {
            margin-top: 0;
        }

        .detail-content .prices .old
        {
            display: inline-block;
            width: auto;
        }

        .detail-content .prices .old,
        .detail-content .prices .product-price
        {
            text-align: left !important;
        }

        .products
        {
            margin-bottom: 30px;
        }

        .products h5
        {
            height: auto;
        }

        .products .col-md-6:not(:last-child)
        {
            margin-bottom: 15px;
        }

        .products .hover
        {
            display: none;
        }

        .sub-features .col-6:nth-child(1),
        .sub-features .col-6:nth-child(2),
        .sub-features .col-6:nth-child(3),
        .sub-features .col-6:nth-child(4)
        {
            margin-bottom: 30px;
        }

        .detail-tabs
        {
            height: auto;
            font-size: 14px;
        }

        .detail-tabs .container
        {
            padding: 0;
            margin-bottom: 15px;
        }

        .detail-tabs li
        {
            display: block;
            margin-right: 0 !important;
        }

        .detail-tabs li a
        {
            line-height: 40px;
            padding: 0;
        }

        .detail-tab-content
        {
            margin-bottom: 40px;
        }

        /*#tab-1 ul
        {
            column-count: 2;
        }*/

        .detail-tab-content ul li
        {
            font-size: 14px;
        }

        .forms
        {
            margin: -15px;
            margin-bottom: 30px;
        }

        .forms .pr-half
        {
            padding-right: 15px;
        }

        .forms .pl-half
        {
            padding-left: 15px;
        }

        .yorum .stars
        {
            margin: 0 !important;
        }

        #tab-4 .row
        {
            margin-left: 0;
            margin-right: 0;
        }

        .yorum
        {
            margin-left: 0;
            margin-right: 0;
        }

        .list-content
        {
            display: block;
            margin-top: 5px;
        }
    }

    .sub-features .features-item h4
    {
        padding: 0 20px;
    }

    .breadcrumb-row .breadcrumb
    {
        margin: 0;
    }

    .breadcrumb-row h3
    {
        font-size: 12pt;
        margin: 0;
        display: inline-block;
        background: #4F0259;
        color: #fff;
        padding: 5px 10px;
        border-radius: .25rem;
    }

    @media (max-width: 1199px)
    {
        .sub-features .features-item h4
        {
            padding: 0 5px;
        }
    }

    @media (max-width: 991px)
    {
        .sub-features .features-item h4
        {
            font-size: 9pt;
        }

        .sub-features .features-item img
        {
            width: 75px;
        }
    }

    @media (max-width: 767px)
    {
        .sub-features .features-item h4
        {
            font-size: 12pt;
            padding: 0 10px;
        }

        .products .col-xl-3:nth-child(2n+2)
        {
            padding-right: 7.5px;
        }

        .products .col-xl-3:nth-child(2n+1)
        {
            padding-left: 7.5px;
        }
    }

    #tab-1 .detail-tab-content
    {
        overflow-x: scroll;
    }

    iframe
    {
        width: 100%;
        height: 400px;
        border: none;
    }

</style>

<script>

    $(function()
    {
        <?php if(!$urun->set): ?>

        $('.add-basket').submit(function(e)
        {
            e.preventDefault();

            var form_data = new FormData(this), _this = $(this);
                urun_id = '<?php echo e($urun->id); ?>';

            form_data.append('id', urun_id);
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');
            form_data.append('yap', 'ekle');

            $.ajax(
            {
                url: '/sepet',
                type: 'post',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function()
                {
                    _this.find('.add-basket-button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                    _this.find('.add-basket-button').attr('disabled', 'disabled');
                },
                success: function(resp)
                {
                    $('.sepet-adet').html(resp);

                    $('#sepet-sonuc .modal-body span').text('<?php echo e($urun->isim); ?>');

                    $('#sepet-sonuc').modal('show');

                    setTimeout(function()
                    {
                        _this.find('.add-basket-button').html('SEPETE EKLE').removeAttr('disabled');

                    }, 1000);
                }
            });
        });

        <?php else: ?>

        $('.add-basket-button').click(function(e)
        {
            e.preventDefault();

            var _this = $(this);

            $('.add-basket').each(function()
            {
                var adet = $(this).find('[name="adet"]').val();

                if (adet == 0) $(this).find('[name="adet"]').val(1);

                var form_data = new FormData(this),
                    urun_id = $(this).attr('data');

                form_data.append('id', urun_id);
                form_data.append('_token', '<?php echo e(csrf_token()); ?>');
                form_data.append('yap', 'ekle');

                $.ajax(
                {
                    url: '/sepet',
                    type: 'post',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(resp)
                    {
                        $('.sepet-adet').html(resp);
                    }
                });
            });

            _this.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

            _this.attr('disabled', 'disabled');

            setTimeout(function()
            {
                _this.html('SEPETE EKLE').removeAttr('disabled');

            }, 1000);

            $('#sepet-sonuc .modal-body span').text('<?php echo e($urun->isim); ?>');

            $('#sepet-sonuc').modal('show');
        });

        <?php endif; ?>

        $('.detail-slide').slick();

        $('[data-fancybox]').fancybox();

        $('.btn-number').click(function (e)
        {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            input = $("input[name='" + fieldName + "']");
            currentVal = parseInt(input.val());

            if (!isNaN(currentVal))
            {
                if (type == 'minus')
                {
                    if (currentVal > input.attr('min'))

                        input.val(currentVal - 1).change();

                    if (parseInt(input.val()) < input.attr('max'))

                        $('[data-type="plus"]').removeAttr('disabled');

                    if (parseInt(input.val()) == input.attr('min'))

                        $(this).attr('disabled', true);
                }

                else if (type == 'plus')
                {
                    if (currentVal < input.attr('max'))

                        input.val(currentVal + 1).change();

                    if (parseInt(input.val()) > input.attr('min'))

                        $('[data-type="minus"]').removeAttr('disabled');

                    if (parseInt(input.val()) == input.attr('max'))

                        $(this).attr('disabled', true);
                }
            }

            else input.val(0);

            <?php if($urun->set): ?>

            $(this).closest('form').find('[name="adet"]').val(input.val());

            <?php endif; ?>
        });

        $('.input-number').focusin(function ()
        {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').keyup(function ()
        {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');

            if (valueCurrent >= minValue)

                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')

            else
            {
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Üzgünüz, minimum değere ulaşıldı.');

                // $(this).val($(this).data('oldValue'));

                $(this).val(minValue);
            }

            if (valueCurrent <= maxValue)

                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')

            else
            {
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Üzgünüz, maximum değere ulaşıldı.');

                // $(this).val($(this).data('oldValue'));

                $(this).val(maxValue);
            }
        });

        $(".input-number").keydown(function (e)
        {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39))

                return;

            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105))

                e.preventDefault();

        });

        $(".input-number").change(function()
        {
            <?php if(!$urun->set): ?>

            <?php if($urun->indirim > 0): ?>

            var fiyat = parseFloat('<?php echo e($urun->indirim); ?>');
                eski = parseFloat('<?php echo e($urun->fiyat); ?>');

            <?php else: ?>

            var fiyat = parseFloat('<?php echo e($urun->fiyat); ?>');

            <?php endif; ?>

            fiyat = ($(this).val() * fiyat).toFixed(2).replace('.', ',');

            $('.prices.d-flex .product-price').html(fiyat +' TL');

            <?php if($urun->indirim > 0): ?>

            eski = ($(this).val() * eski).toFixed(2).replace('.', ',');

            $('.prices.d-flex .old').html(eski +' TL');

            <?php endif; ?>

            <?php else: ?>

            var ids = [];

            $('.add-basket').each(function(i)
            {
                var adet = $(this).find('.input-number').val();

                if (adet == 0) adet = 1;

                ids[$(this).attr('data')] = adet;
            });

            $.ajax(
            {
                type: 'get',
                url: '/urun/fiyat',
                data: {ids: ids},
                success: function(resp)
                {
                    var oran = parseInt(100 - (resp.indirim / resp.fiyat * 100));

                    $('.winnings').html('Kazancınız %'+ oran);

                    var fiyat = resp.indirim.toFixed(2).replace('.', ',');

                    $('.prices.d-flex .product-price').html(fiyat +' TL');

                    var eski =  resp.fiyat.toFixed(2).replace('.', ',');

                    $('.prices.d-flex .old').html(eski +' TL');
                }
            });

            <?php endif; ?>
        });

        $('.detail-tabs a').click(function(e)
        {
            e.preventDefault();

            $('.detail-tabs li').removeClass('active');

            $(this).parent().addClass('active');

            $('.detail-tabs-content').removeClass('show');

            $($(this).attr('href')).addClass('show');
        });

        $('#yorum-form .stars').mousemove(function(e)
        {
            var width = e.pageX - $(this).offset().left;
                one_star = $(this).width() / 5;

            $(this).find("div").css("width", Math.ceil(width / one_star) * 20 +"%");

        }).mouseleave(function(e)
        {
            if ($(this).attr("click") == 0)

                $(this).find("div").css("width", 0);

            else $(this).find("div").css("width", $(this).attr("click") * 20 +"%");

        }).click(function(e)
        {
            var width = e.pageX - $(this).offset().left;
                one_star = $(this).width() / 5;
                value = Math.ceil(width / one_star);

            $(this).attr("click", value);
            $('[name="puan"]').val(value);
        });

        $('#yorum-form').submit(function(e)
        {
            e.preventDefault();

            var _this = $(this);
                button_value = _this.find('button').html();
                form_data = new FormData(this);

            if (!_this.find('[name="puan"]').val())
            {
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Puanlama yapmadınız.');

                return false;
            }

            form_data.append('urun_id', '<?php echo e($urun->id); ?>');
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');

            $.ajax(
            {
                type: 'post',
                url: '/urun/<?php echo e($urun->url); ?>',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function()
                {
                    _this.find('button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                    _this.find('*').attr('disabled', 'disabled');
                },
                success: function(cevap)
                {
                    uyari(cevap.title, cevap.message);

                    _this[0].reset();

                    _this.find('.stars').attr('click', 0).find('div').css('width', 0);

                    _this.find('[name="puan"]').removeAttr('value');
                },
                complete: function()
                {
                    _this.find('button').html(button_value);

                    _this.find('*').removeAttr('disabled');
                }
            });
        });

        setTimeout(function()
        {

            $('.products .hover').each(function()
            {
                var height = $(this).find('a').outerHeight() * $(this).find('a').length + 15;
                    padding = ($(this).height() / 2) - (height / 2);

                $(this).css('padding-top', padding);
            });

        }, 250);

        $('.add-basket-d').click(function(e)
        {
            e.preventDefault();

            var form_data = new FormData();
                _this = $(this);

            form_data.append('id', $(this).attr('href'));
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');
            form_data.append('yap', 'ekle');

            $.ajax(
            {
                url: '/sepet',
                type: 'post',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function()
                {
                    _this.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                    _this.attr('disabled', 'disabled');
                },
                success: function(resp)
                {
                    $('.sepet-adet').html(resp);

                    var isim = _this.closest('.col-xl-3').find('h5').text();

                    $('#sepet-sonuc .modal-body span').text(isim);

                    $('#sepet-sonuc').modal('show');

                    setTimeout(function()
                    {
                        _this.html('Sepete Ekle').removeAttr('disabled');

                    }, 1000);
                }
            });
        });

        setTimeout(function()
        {
            $('.products .col-md-6').each(function()
            {
                if ($(this).find('a').eq(0).height() != $(this).find('.product-container').outerHeight())
                {
                    var height = $(this).find('a').eq(0).height() - $(this).find('.product-container').outerHeight();

                    $(this).find('h5').css('margin-bottom', height);
                }
            });

        }, 250);

        $('.share-products a').click(function(e)
        {
            e.preventDefault();

            var social = $(this).find('i').attr('class').split('-')[1];

                links =
                {
                    facebook: 'https://www.facebook.com/sharer/sharer.php?u=',
                    twitter: 'https://twitter.com/intent/tweet?url=',
                    linkedin: 'https://www.linkedin.com/shareArticle?mini=true&url=',
                };

                id = '<?php echo e($urun->id); ?>';

            if (!links[social]) return false;

            window.open(links[social] +'<?php echo e(urlencode(Request::url() ."?id=")); ?>'+ id, '', 'width=600, height=400');
        });
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>