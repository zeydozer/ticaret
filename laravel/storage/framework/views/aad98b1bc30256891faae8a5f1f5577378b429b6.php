<?php $__env->startSection('content'); ?>

<tr>
    <td colspan="4" style="
        padding: 30px;
        text-align: center;
        font-size: 10pt;
        ">
        <h1 style="
            margin: 0 0 15px 0;
            ">Şifremi Unuttum</h1>
        Değerli <?php echo e($uye->isim); ?>, aşağıdaki bağlantıya giderek şifrenizi yenileyebilirsiniz.
        <a href="<?php echo e(url('token?token='. $uye->token)); ?>" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #046E71;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Şifre Sıfırla</a>
    </td>
</tr>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('mailing.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>