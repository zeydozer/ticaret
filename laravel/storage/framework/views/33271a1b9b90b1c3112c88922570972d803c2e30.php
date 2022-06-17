<?php $__env->startSection('content'); ?>

<?php if(count($slides) > 0): ?>
<div class="main-slider">
    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="slider-item">
        <a href="<?php echo e($slide->link); ?>">
            <img src="/img/<?php echo e($slide->foto); ?>" alt="">
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<style>

    .main-content { top: 15px; margin-bottom: 0; }

    @media (max-width: 767px)
    {
        .features { margin-top: -15px !important; }
    }

</style>
<?php endif; ?>

<div class="container main-content">

    <section class="row features">
        <div class="col-xl-3 col-lg-3 col-md-3 col-6 main-features">
            <div class="features-item">
                <img src="/assets/images/ic1.svg" class="d-none d-md-block">
                <img src="/assets/images/icb1.svg" class="d-block d-md-none">
                <h4>ÜCRETSİZ KARGO</h4>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-6 main-features">
            <div class="features-item">
                <img src="/assets/images/ic2.svg" class="d-none d-md-block">
                <img src="/assets/images/icb2.svg" class="d-block d-md-none">
                <h4>KOLAY İADE İMKANI</h4>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-6 main-features">
            <div class="features-item">
                <img src="/assets/images/ic3.svg" class="d-none d-md-block">
                <img src="/assets/images/icb3.svg" class="d-block d-md-none">
                <h4>TELEFON İLE SİPARİŞ</h4>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-6 main-features">
            <div class="features-item">
                <img src="/assets/images/ic4.svg" class="d-none d-md-block">
                <img src="/assets/images/icb4.svg" class="d-block d-md-none">
                <h4>GÜVENLİ ALIŞVERİŞ</h4>
            </div>
        </div>
    </section>

    <div class="box-title">
        <h2>SİZİN İÇİN SEÇTİK</h2>
    </div>
    <section class="row main-products-a">
        <a class="col-lg-6" href="https://noone.com.tr/urun/mutlu-bulutlar-donence-ve-uyku-arkadasi">
            <img src="/img/Fisher-Price-Mutlu-Bulutlar-Donence-ve-Uyku-Arkadasi- Besik-icin-Ses-Makinesi-GRP99-2.jpg" alt="Paket 1">
          <!--  <div class="price-box">
                <div class="price">
                    <span class="old">319,00₺</span>
                    <span class="product-price">289,99₺</span>
                </div>
                <span class="discount">%9</span>
            </div> -->
        </a>
        <a class="col-lg-6" href="https://noone.com.tr/urun/barbie-nin-malibu-evi">
            <img src="/img/Barbie-nin-Muhtesem-Malibu-Evi-yaratici-donusumler-ve-pek-cok-hikaye-ogesiyle-cocuklarin-hayal-gucunu-harekete-gecirmeye-hazir.jpg" alt="Paket 2">
            <!-- <div class="price-box">
               <div class="price">
                    <span class="old">899,99₺</span>
                    <span class="product-price">799,99₺</span>
                </div>
                <span class="discount">%14</span>
            </div>  -->
        </a>
        <!-- <a class="col-lg-4" href="#">
            <img src="#" alt="Paket 3">
            <div class="price-box">
                <div class="price">
                    <span class="old">50₺</span>
                    <span class="product-price">25₺</span>
                </div>
                <span class="discount">%50</span>
            </div>
        </a> -->
    </section>


    <?php if(isset($one_cikan)): ?>
    <?php if(count($one_cikan) > 0): ?>
    <div class="box-title">
        <h2>ÖNE ÇIKAN ÜRÜNLER</h2>
    </div>
    <section class="row products justify-content-center">
        <?php $__currentLoopData = $one_cikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <a href="/urun/<?php echo e($urun->url); ?>">
                <div class="product-container">

                    <?php

                    $profil = \App\Foto::where('profil', 1)
                                        ->where('urun_id', $urun->id)
                                        ->first();

                    $profil = $profil ? $profil->deger : 'logo.png';

                    ?>

                    <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>"
                    <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                    <h5><?php echo e($urun->isim); ?></h5>
                    <div class="prices text-center">
                        <?php if($urun->indirim > 0): ?>
                        <span class="old"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->indirim, 2, ',', '.')); ?> TL</span>
                        <?php else: ?>
                        <span class="old invisible"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <?php endif; ?>
                    </div>
                    <?php if($urun->indirim > 0): ?>
                    <span class="winnings">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php else: ?>
                    <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="hover">
                <?php if($urun->stok > 0 && !$urun->paket): ?>
                <a href="<?php echo e($urun->id); ?>" class="add-basket">Sepete Ekle</a>
                <?php endif; ?>
                <a href="/urun/<?php echo e($urun->url); ?>">İncele</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($yeni_gelen)): ?>
    <?php if(count($yeni_gelen) > 0): ?>
    <div class="box-title">
        <h2>YENİ GELEN ÜRÜNLER</h2>
    </div>
    <section class="row products justify-content-center">
        <?php $__currentLoopData = $yeni_gelen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <a href="/urun/<?php echo e($urun->url); ?>">
                <div class="product-container">

                    <?php

                    $profil = \App\Foto::where('profil', 1)
                                        ->where('urun_id', $urun->id)
                                        ->first();

                    $profil = $profil ? $profil->deger : 'logo.png';

                    ?>

                    <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>"
                    <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                    <h5><?php echo e($urun->isim); ?></h5>
                    <div class="prices text-center">
                        <?php if($urun->indirim > 0): ?>
                        <span class="old"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->indirim, 2, ',', '.')); ?> TL</span>
                        <?php else: ?>
                        <span class="old invisible"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <?php endif; ?>
                    </div>
                    <?php if($urun->indirim > 0): ?>
                    <span class="winnings">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php else: ?>
                    <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="hover">
                <?php if($urun->stok > 0 && !$urun->paket): ?>
                <a href="<?php echo e($urun->id); ?>" class="add-basket">Sepete Ekle</a>
                <?php endif; ?>
                <a href="/urun/<?php echo e($urun->url); ?>">İncele</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
    <?php endif; ?>

    <?php $ktgler = \App\Kategori::where('ana', 1)->orderBy('sira')->get() ?>

    <?php if(count($ktgler) > 0): ?>
    <?php $__currentLoopData = $ktgler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ktg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php  $result = kat_urun($ktg->id)  ?>
    <?php if(count($result['urunler']) > 0): ?>
    <div class="box-title">
        <h2 class="text-uppercase"><?php echo e($result['title']); ?></h2>
    </div>
    <section class="row products justify-content-center">
        <?php $__currentLoopData = $result['urunler']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <a href="/urun/<?php echo e($urun->url); ?>">
                <div class="product-container">

                    <?php

                    $profil = \App\Foto::where('profil', 1)
                                        ->where('urun_id', $urun->id)
                                        ->first();

                    $profil = $profil ? $profil->deger : 'logo.png';

                    ?>

                    <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>"
                    <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                    <h5>
                        <?php echo e($urun->isim); ?>

                        <!-- <?php if($urun->kod): ?>
                        <small><?php echo e($urun->kod); ?></small>
                        <?php endif; ?> -->
                    </h5>
                    <div class="prices text-center">
                        <?php if($urun->indirim > 0): ?>
                        <span class="old"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->indirim, 2, ',', '.')); ?> TL</span>
                        <?php else: ?>
                        <span class="old invisible"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <span class="product-price"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                        <?php endif; ?>
                    </div>
                    <?php if($urun->indirim > 0): ?>
                    <span class="winnings">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php else: ?>
                    <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="hover">
                <?php if($urun->stok > 0 && !$urun->paket): ?>
                <a href="<?php echo e($urun->id); ?>" class="add-basket">Sepete Ekle</a>
                <?php endif; ?>
                <a href="/urun/<?php echo e($urun->url); ?>">İncele</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    .main-content
    {
        top: 0;
        margin-bottom: 0;
    }

    .main-slider .slider-item
    {
        height: auto;
    }

    .main-slider .slider-item img
    {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .features
    {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .products
    {
        margin-bottom: 45px;
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

    .products h5
    {
        margin-top: 10px;
        color: #000;
        margin-bottom: 0;
        transition: .125s;
    }

    .prices
    {
        padding-top: 10px;
        padding-bottom: 0;
        line-height: 1;
    }

    .prices .old
    {
        display: table;
        margin: 0 auto;
        text-align: center;
        color: #383838;
        margin-bottom: 5px;
        width: auto;
    }

    .prices .old::after
    {
        display: none;
    }

    .prices .old::before
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

    .products .winnings
    {
        display: none;
        background: #ff0000;
        color: #fff;
        font-size: 10pt;
        padding: 5px 10px;
        margin-top: 10px;
    }

    .slick-slide:focus
    {
        outline: none;
        border: none;
    }

    .products h5
    {
        margin-bottom: 0;
        padding: 0 .5rem;
        color: #000;
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

    .main-slider .slick-dots
    {
        list-style: none;
        position: absolute;
        bottom: 30px;
        margin-bottom: 0;
        padding-left: 0;
        left: 50%;
        transform: translateX(-50%);
    }

    .main-slider .slick-dots li
    {
        float: left;
    }

    .main-slider .slick-dots li:not(:first-child)
    {
        margin-left: 5px;
    }

    .main-slider .slick-dots li::before
    {
        content: '\f111';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #FFF;
        font-size: 10pt;
    }

    .main-slider .slick-dots .slick-active::before
    {
        content: '\f111';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #009498;
        font-size: 10pt;
    }

    .main-slider .slick-dots button
    {
        background: none;
        border: none;
        display: none;
    }

    .main-slider .slick-arrow
    {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 50pt;
        color: #fff !important;
        z-index: 1;
        cursor: pointer;
    }

    .main-slider .slick-arrow:hover
    {
        color: #009498 !important;
    }

    .main-slider .slick-prev
    {
        left: 30px;
    }

    .main-slider .slick-next
    {
        right: 30px;
    }

    .products .slick-arrow
    {
        border: none;
        font-size: 50pt;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: table !important;
        cursor: pointer;
        z-index: 1;
    }

    .products .slick-arrow:hover
    {
        box-shadow: unset;
    }

    .products .slick-prev
    {
        left: -60px;
    }

    .products .slick-next
    {
        right: -60px;
    }

    .products .slick-slide img
    {
        display: unset;
    }

    .main-products-a
    {
        margin-left: -35px;
        margin-right: -35px;
        padding: 0 15px 45px;
    }

    .main-products-a img
    {
        width: 100%;
    }

    .main-products-a .price-box
    {
        width: 120px;
        height: 120px;
        -webkit-border-radius: 60px;
        -moz-border-radius: 60px;
        border-radius: 60px;
        background: #ffffff;
        position: absolute;
        right: 30px;
        top: 15px;
        padding: 9px;
        color: #009498;
        transition: .25s;
    }

    .main-products-a a:hover .price-box
    {
        transform: scale(1.2);
    }

    .main-products-a .price
    {
        border: dashed 2px #009498;
        width: 100%;
        height: 100%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        text-align: center;
        padding-top: 25px;
    }

    .main-products-a .old
    {
        font-size: 14px;
        position: relative;
        text-decoration: line-through;
    }

    .main-products-a .product-price
    {
        font-size: 20px;
        line-height: 0;
    }

    .main-products-a .discount
    {
        position: absolute;
        height: 30px;
        width: 30px;
        background: #046E71;
        color: #ffffff;
        font-size: 10px;
        line-height: 30px;
        text-align: center;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        border-radius: 15px;
        right: 0;
        top: 85px;
    }

    @media (max-width: 1199px)
    {
        .main-products-a .price-box
        {
            right: 20px;
            top: 10px;
        }
    }

    @media (max-width: 1100px)
    {
        .products .slick-arrow
        {
            display: none !important;
        }
    }

    @media (max-width: 991px)
    {
        .main-content
        {
            margin-bottom: -30px;
        }

        .box-title h2
        {
            margin-top: 0
        }

        .main-products-a a:not(:first-child)
        {
            margin-top: 30px;
        }

        .main-products-a .price-box
        {
            width: 100px;
            height: 100px;
            border-radius: 50px;
            right: 30px;
            top: 15px;
        }

        .main-products-a .price
        {
            padding-top: 17.5px;
        }

        .main-products-a .old
        {
            display: block;
        }

        .main-products-a .discount
        {
            top: 70px;
        }
    }

    @media (max-width: 991px) and (min-width: 768px)
    {
        .products .col-md-6:nth-child(2),
        .products .col-md-6:nth-child(3)
        {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px)
    {
        .main-slider .slider-item,
        .main-slider .slider-item img
        {
            height: auto;
        }

        .features .features-item
        {
            background: none;
            height: 155px;
        }

        .features .features-item img
        {
            left: 50%;
            transform: translateX(-50%);
            top: 20px;
            width: 75px;
        }

        .features .features-item h4
        {
            color: #008C90;
            font-size: 14pt;
        }

        .main-content
        {
            overflow: hidden;
            margin-bottom: -15px;
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
            margin-right: 45px;
            margin-left: 45px;
        }

        .products .hover
        {
            display: none;
        }

        .main-slider .slick-dots
        {
            bottom: 0;
        }

        .main-slider .slick-arrow
        {
            font-size: 20pt;
        }

        .main-slider .slick-prev
        {
            left: 10px;
        }

        .main-slider .slick-next
        {
            right: 10px;
        }

        .products .slick-arrow
        {
            display: table !important;
            font-size: 40pt;
        }

        .products .slick-prev
        {
            left: 0;
        }

        .products .slick-next
        {
            right: 0;
        }

        .main-products-a
        {
            margin-left: -30px;
            margin-right: -30px;
        }

        .main-products-a a:not(:first-child)
        {
            margin-top: 15px;
        }

        .main-products-a .price-box
        {
            width: 100px;
            height: 100px;
            border-radius: 50px;
            right: 20px;
            top: 5px;
        }

        .main-products-a .price
        {
            padding-top: 7.5px;
        }

        .main-products-a .discount
        {
            top: 60px;
            height: 35px;
            width: 35px;
            line-height: 35px;
            border-radius: 17.5px;
        }

        .footer-middle .col-md-12 img
        {
            height: 45px;
        }
    }

</style>

<link rel="stylesheet" href="/css/slick.css">
<script src="/assets/js/slick.min.js"></script>

<script>

    $(document).ready(function () {

        $('.main-slider').slick(
        {
            draggable: true,
            arrows: true,
            dots: true,
            fade: true,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 1000,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<a class="slick-prev"><i class="fa fa-chevron-left"></i></a>',
            nextArrow: '<a class="slick-next"><i class="fa fa-chevron-right"></i></a>',
        });

        var show = $(window).width() >= 992 ? 4 : 2;

        if ($(window).width() < 768) show = 1;

        $('.products').each(function()
        {
            if ($(this).find('.col-xl-3').length > show)
            {
                $(this).slick(
                {
                    draggable: true,
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 1000,
                    infinite: true,
                    slidesToShow: show,
                    slidesToScroll: 1,
                    prevArrow: '<a class="slick-prev"><i class="fa fa-chevron-left"></i></a>',
                    nextArrow: '<a class="slick-next"><i class="fa fa-chevron-right"></i></a>',
                });

                var height = 0;

                $(this).find('.col-xl-3').each(function()
                {
                    if ($(this).height() > height)

                        height = $(this).height();

                }).height(height);
            }
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

        $('.add-basket').click(function(e)
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
    });

</script>

<?php $__env->stopSection(); ?>

<?php

function kat_urun($id)
{
    $kategori = \App\Kategori::find($id);

    if (!$kategori) return false;

    $case_w =

    '(CASE
        WHEN indirim > 0
        THEN 100 - (indirim / fiyat * 100)
        ELSE 0
    END) AS oran,

    (CASE
        WHEN indirim > 0 THEN indirim
        ELSE fiyat
    END) AS fiyat_s';

    $urunler = \App\Urun::selectRaw('urun.*, '. $case_w)
        ->where('sil', 0)
        ->orderBy('id', 'DESC')
        ->leftJoin('kategori', 'kategori.id', '=', 'urun.kat_id')
        ->where('urun.set_id', null)
        ->where('kat_id', $kategori->id)
        ->inRandomOrder()
        ->limit(10)
        ->get();

    return
    [
        'title' => $kategori->isim,
        'urunler' => $urunler
    ];
}

?>

<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>