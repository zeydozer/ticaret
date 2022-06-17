<?php $__env->startSection('title', 'Siparişlerim'); ?>

<?php $__env->startSection('process'); ?>

<?php if(count($siparisler) > 0): ?>
<?php $__currentLoopData = $siparisler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $siparis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row purchased-product <?php echo e($i > 0 ? 'mt-md-3 mt-4' : ''); ?>">
    <div class="col-md-8 purchased-name text-left">
        <div class="bilgi"><span class="order-status">İsim:</span> <?php echo e($siparis->isim); ?></div>
        <div class="bilgi"><span class="order-status">E-Posta:</span> <?php echo e($siparis->mail); ?></div>
        <div class="bilgi"><span class="order-status">Telefon:</span> <?php echo e($siparis->tel); ?></div>
        <div class="bilgi"><span class="order-status">Fatura Adresi:</span> <?php echo e($siparis->fatura); ?></div>
        <div class="bilgi"><span class="order-status">Teslimat Adresi:</span> <?php echo e($siparis->teslimat); ?></div>
        <a href="/hesap/siparis/<?php echo e($siparis->id); ?>" class="d-none d-md-block"><i class="fa fa-eye"></i> Detaylar</a>
    </div>
    <div class="col-md-4">
        <span class="order-status">Durum: <?php echo e($siparis->durum); ?></span>

        <?php 

        $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

        $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

        ?>

        <span class="price"><?php echo e(number_format($tutar - $siparis->indirim, 2, ',', '.')); ?> TL</span>
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
        <a href="/hesap/siparis/<?php echo e($siparis->id); ?>" class="d-block d-md-none"><i class="fa fa-eye"></i> Detaylar</a>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="row">
    <div class="col-12">Sipariş bulunamadı.</div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra'); ?>

<style>

    .bilgi
    {
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .bilgi:not(:first-child)
    {
        margin-top: .25rem;
    }

    .purchased-name a
    {
        color: #2e2e2e;
        position: absolute;
        bottom: 0;
    }

    @media (max-width: 767px)
    {
        .user-panel
        {
            padding: 30px 0;
        }

        .purchased-product
        {
            padding-top: 0;
            padding-bottom: 0;
        }

        .purchased-product .col-md-4
        {
            padding-bottom: 1.5rem;
            border-bottom: solid 1px #707070;
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
<?php echo $__env->make('hesap.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>