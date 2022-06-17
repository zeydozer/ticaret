<?php if($konu == 'aktivasyon'): ?>

Değerli <?php echo e($uye->isim); ?>; <br>
Üyeliğin için aktivasyon işlemi başarı ile gerçekleşmiştir. <br>
Girmiş olduğunun üye bilgilerini dilediğin zaman güncelleyebilirsin.

<?php elseif($konu == 'unuttum'): ?>

Değerli <?php echo e($uye->isim); ?>, aşağıdaki bağlantıya giderek şifreni yenileyebilirsin. <br><br>
<a href="<?php echo e(url('token?token='. $uye->token)); ?>"><?php echo e(url('token?token='. $uye->token)); ?></a>

<?php elseif($konu == 'sifirla'): ?>

Değerli <?php echo e($uye->isim); ?> şifren başarıyla değiştirildi, yeni şifren: <b><?php echo e($sifre); ?></b>

<?php elseif($konu == 'iletisim'): ?>

<span style="color: red">Ad & Soyad: </span> <?php echo e($mesaj->isim); ?> <br><br>
<span style="color: red">E-Posta: </span> <?php echo e($mesaj->mail); ?> <br><br>
<span style="color: red">Telefon: </span> <?php echo e($mesaj->tel); ?> <br><br>
<span style="color: red">Şirket: </span> <?php echo e($mesaj->sirket ? $mesaj->sirket : '-'); ?> <br><br>

<?php echo e($mesaj->mesaj); ?>


<?php elseif($konu == 'siparis'): ?>

Sayın <?php echo e($siparis->isim); ?>, <?php echo e($siparis->id); ?> numaralı siparişiniz başarıyla alındı. <br>

<?php if(Cookie::has('uye')): ?>
Gelişmeleri <a href="<?php echo e(url('hesap/siparis')); ?>">hesap sayfanızdan</a> takip edebilirsiniz. <br>
<?php endif; ?>

<br><b>Teşekkür Ederiz</b>

<?php endif; ?>