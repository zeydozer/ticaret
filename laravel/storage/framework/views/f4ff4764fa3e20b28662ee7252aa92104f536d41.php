<?php $__env->startSection('content'); ?>

<?php $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true) ?>

<tr>
    <td colspan="4" style="
        padding: 30px;
        text-align: center;
        font-size: 10pt;
        ">
        <h1 style="
            margin: 0 0 15px 0;
            ">Hoşgeldiniz</h1>
        <?php echo e($seo['author']); ?>'e üye olduğunuz için TEŞEKKÜRLER! <br>
        Güvenli ve uygun fiyatlı alışveriş için son bir adım kaldı!
        <a href="<?php echo e(url('giris?token='. $uye->token)); ?>" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #330138;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Aktivasyon Yap</a>
    </td>
</tr>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('mailing.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>