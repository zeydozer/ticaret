<?php $__env->startSection('content'); ?>

<tr>
    <td colspan="4" style="
        padding: 30px;
        text-align: center;
        font-size: 10pt;
        ">
        <h1 style="
            margin: 0 0 15px 0;
            ">Tebrikler</h1>
        <img src="<?php echo e(url('/')); ?>/img/mail/basarili.png" style="
            display: block;
            margin: 0 auto;
            margin-bottom: 15px;
        ">>
        Sayın <?php echo e($siparis->isim); ?>, <?php echo e($siparis->id); ?> numaralı siparişiniz başarıyla alındı. <br>
        <?php if(Cookie::has('uye')): ?>
        Gelişmeleri hesap sayfanızdan takip edebilirsiniz. <br>
        <?php endif; ?>
        Teşekkür ederiz.
        <?php if(Cookie::has('uye')): ?>
        <a href="<?php echo e(url('hesap/siparis')); ?>" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #046E71;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Sipariş Takip</a>
        <?php endif; ?>
    </td>
</tr>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('mailing.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>