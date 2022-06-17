<?php

$seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

$iletisim = json_decode(\App\Ayar::where('tip', 'iletisim')->first()->data, true);

?>

<link href="//fonts.googleapis.com/css?family=Baloo+2:400,500,600,700" rel="stylesheet">

<table style="
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    font-family: 'Baloo 2';
    border-spacing: 0;
    ">
    <tbody>
        <tr>
            <td colspan="4" style="
                padding: 15px 0;
                background: #330138;
                color: #fff;
                text-align: center;
                font-weight: bold;
                font-size: 10pt;
                ">
                <a href="#" style="
                    text-decoration: none;
                    color: #fff;
                    ">
                    Bu e-postayı görüntüleyemiyorsanız lütfen tıklayınız.
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="4" style="
                text-align: center;
                padding: 10px 0;
                ">
                <img src="<?php echo e(url('/')); ?>/img/logo.png" style="
                    height: 80px;
                    ">
            </td>
        </tr>
        <tr style="
            text-align: center;
            text-transform: capitalize;
            background: #4f0159;
            ">
            <td style="
                padding: 10px 0;
                "><a href="<?php echo e(url('/')); ?>/urunler" style="
                text-decoration: none;
                color: #fff;
                font-weight: 600;
                ">Ürünler</a></td>
            <td style="
                padding: 10px 0;
                "><a href="<?php echo e(url('/')); ?>/urunler?ozellik[]=indir" style="
                text-decoration: none;
                color: #fff;
                font-weight: 600;
                ">İndirimdekiler</a></td>
            <td style="
                padding: 10px 0;
                "><a href="<?php echo e(url('/')); ?>/urunler?ozellik[]=vitrin" style="
                text-decoration: none;
                color: #fff;
                font-weight: 600;
                ">Öne Çıkanlar</a></td>
            <td style="
                padding: 10px 0;
                "><a href="<?php echo e(url('/')); ?>/urunler?ozellik[]=yeni" style="
                text-decoration: none;
                color: #fff;
                font-weight: 600;
                ">Yeni Gelenler</a></td>
        </tr>

        <?php echo $__env->yieldContent('content'); ?>

        <tr style="
            background: #F2F2F2;
            vertical-align: bottom;
            text-align: center;
            ">
            <td style="padding: 15px"><img src="<?php echo e(url('/')); ?>/img/mail/1.png"></td>
            <td style="padding: 15px"><img src="<?php echo e(url('/')); ?>/img/mail/2.png"></td>
            <td style="padding: 15px"><img src="<?php echo e(url('/')); ?>/img/mail/3.png"></td>
            <td style="padding: 15px"><img src="<?php echo e(url('/')); ?>/img/mail/4.png"></td>
        </tr>
        <tr style="
            background: #330138;
            color: #fff;
            ">
            <td colspan="2" style="
                padding: 15px;
                font-weight: 600;
                font-size: 10pt;
                width: 50%;
                ">
                <?php echo e($iletisim['adres']); ?>

            </td>
            <td style="
                font-weight: bold;
                width: 25%;
                ">
                <!-- <img src="<?php echo e(url('/')); ?>/img/mail/tel.png" style="width: 100%"> -->
            </td>
            <td style="
                font-weight: 600;
                text-align: center;
                width: 50%;
                ">
                <img src="<?php echo e(url('/')); ?>/img/mail/fb.png">
                <img src="<?php echo e(url('/')); ?>/img/mail/ins.png">
                <img src="<?php echo e(url('/')); ?>/img/mail/twit.png">
                <img src="<?php echo e(url('/')); ?>/img/mail/link.png">
                <?php echo e(str_replace(['.', 'http://', 'https://'], ['', '', ''], url('/'))); ?>

            </td>
        </tr>
    </tbody>
</table>
