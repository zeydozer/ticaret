<?php $__env->startSection('title', 'Sipariş Detayları'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">

    <section class="row payment_successful">

        <div class="col-xl-9 col-lg-9 col-md-9 m-auto">
            <h2>Sipariş Özeti</h2>
            <div class="row purchased-product">
                <div class="col-md-7 purchased-name text-left">
                    <div class="bilgi"><span class="order-status">İsim:</span> <?php echo e($siparis->isim); ?></div>
                    <div class="bilgi"><span class="order-status">E-Posta:</span> <?php echo e($siparis->mail); ?></div>
                    <div class="bilgi"><span class="order-status">Telefon:</span> <?php echo e($siparis->tel); ?></div>
                    <div class="bilgi"><span class="order-status">Fatura Adresi:</span> <?php echo e($siparis->fatura); ?></div>
                    <div class="bilgi"><span class="order-status">Teslimat Adresi:</span> <?php echo e($siparis->teslimat); ?></div>
                </div>
                <div class="col-lg-4 offset-lg-1 col-md-5">
                    <span class="order-status">Durum: <?php echo e($siparis->durum); ?></span>

                    <?php 

                    $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

                    $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

                    ?>

                    <span class="price d-lg-block d-none"><?php echo e(number_format($tutar - $siparis->indirim, 2, ',', '.')); ?> TL</span>
                    <div class="bilgi"><span class="order-status">No:</span> <?php echo e($siparis->id); ?></div>
                    <div class="bilgi"><span class="order-status">Tarih:</span> <?php echo e(date('d.m.Y', strtotime($siparis->tarih))); ?></div>
                    <div class="bilgi">
                        <span class="order-status">Ödeme:</span>
                        <?php echo e($siparis->odeme); ?>

                        <?php if($siparis->odeme != 'Kart'): ?>
                        <?php if($siparis->odeme != 'Kapıda Ödeme'): ?>
                            - <?php echo $siparis->sekil ?>
                        <?php else: ?>
                            - <?php echo e(floatval($siparis->sekil)); ?>₺
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 table-responsive">
                    <small class="d-block d-md-none mt-4">* Tabloyu sağa doğru kaydırın.</small>
                    <table class="table mt-4 mb-0">
                        <tr>
                            <th colspan="2">Ürün</th>
                            <th>Fiyat</th>
                            <th>Adet</th>
                            <th>Toplam</th>
                        </tr>

                        <?php $toplam = 0 ?>

                        <?php $__currentLoopData = $urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php $toplam += $urun->fiyat * $urun->adet ?>

                        <tr>
                            <td width="100"><img src="<?php echo e(asset('img/'. $urun->foto)); ?>"></td>
                            <td><?php echo e($urun->isim); ?></td>
                            <td><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</td>
                            <td><?php echo e($urun->adet); ?></td>
                            <td><?php echo e(number_format($urun->fiyat * $urun->adet, 2, ',', '.')); ?> TL</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Ara Toplam</th>
                            <th><?php echo e(number_format($toplam, 2, ',', '.')); ?> TL</th>
                        </tr>
                        <?php if($siparis->indirim > 0): ?>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">İndirim</th>
                            <th><?php echo e(number_format($siparis->indirim, 2, ',', '.')); ?> TL</th>
                        </tr>
                        <?php endif; ?>
                        
                        <?php $toplam += $siparis->kargo ?>

                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Kargo</th>
                            <th><?php echo e(number_format($siparis->kargo, 2, ',', '.')); ?> TL</th>
                        </tr>
                        <?php if($siparis->odeme == 'Kapıda Ödeme'): ?>

                        <?php $toplam += $siparis->sekil ?>

                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Kapıda Ödeme</th>
                            <th><?php echo e(number_format($siparis->sekil, 2, ',', '.')); ?> TL</th>
                        </tr>
                        <?php endif; ?>

                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Toplam</th>
                            <th><?php echo e(number_format($toplam - $siparis->indirim, 2, ',', '.')); ?> TL</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </section>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    .purchased-product table th 
    {
        padding-left: 0;
        padding-right: .5rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    .purchased-product table td
    {
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
        font-size: 13px;
        padding-bottom: 0;
        max-width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: .5rem;
        padding-top: .25rem;
        padding-bottom: .25rem;
    }

    .purchased-product table td img
    {
        width: 100px;
        height: 75px;
        object-fit: contain;
    }

    @media (max-width: 1199px)
    {
        .purchased-product table td img
        {
            width: 75px;
            height: 75px;
        }

        .purchased-product table td
        {
            max-width: 280px;
        }
    }

    @media (max-width: 767px)
    {
        .purchased-product table td img
        {
            width: 50px;
            height: 50px;
        }

        .purchased-product table td
        {
            max-width: 200px;
        }

        .user-panel
        {
            padding: 30px 0;
        }

        .purchased-product
        {
            padding-top: 0;
            padding-bottom: 0;
        }

        .purchased-product a
        {
            color: #009498;
            font-weight: 700;
            font-size: 18px;
            margin-top: 15px;
        }
    }

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>