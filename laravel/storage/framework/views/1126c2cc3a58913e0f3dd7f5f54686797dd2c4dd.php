<?php $__env->startSection('content'); ?>

<tr>
    <td colspan="4" style="
        padding: 30px;
        text-align: center;
        font-size: 10pt;
        ">
        <h1 style="
            margin: 0 0 15px 0;
            ">Sipariş Takibi</h1>
        
        <?php
        
        $img = 
        [
            'Onay Bekliyor' => 'basarili',
            'Onaylandı' => 'basarili',
            'Kargoya Verildi' => 'kargo',
            'Tamamlandı' => 'tamam',
            'İptal Edildi' => 'iptal',
        ];
        
        ?>

        <img src="<?php echo e(url('/')); ?>/img/mail/<?php echo e($img[$siparis->durum]); ?>.png" style="
            display: block;
            margin: 0 auto;
            margin-bottom: 15px;
        ">
        Sayın <?php echo e($siparis->isim); ?>; <br> 
        <?php echo e($siparis->id); ?> numaralı siparişinizin durumu: <b><?php echo e($siparis->durum); ?></b> <br>
        <?php if($siparis->kargo_no && $siparis->durum == 'Kargoya Verildi'): ?>
        <b>Kargo No:</b> <?php echo e($siparis->kargo_no); ?> <br>
        <?php endif; ?>
        <?php if(is_numeric($siparis->uye_id)): ?>
        Gelişmeleri hesap sayfanızdan takip edebilirsiniz. <br>
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