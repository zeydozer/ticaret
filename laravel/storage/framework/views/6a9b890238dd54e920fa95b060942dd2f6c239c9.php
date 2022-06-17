<?php $__env->startSection('content'); ?>

<?php if(!Cookie::has('uye')): ?>
<script type="text/javascript">window.location = "/giris";</script>
<?php endif; ?>

<div class="container">

    <section class="row user-panel" id="p-menu">
        <div class="col-xl-3 col-lg-3 col-md-3">
            <ul class="list-unstyled left-list">
                <li><a href="/hesap/siparis">SİPARİŞLER</a></li>
                <li><a href="/hesap/uyelik">ÜYELİK BİLGİLERİ</a></li>
                <li><a href="/hesap/adres">ADRESLER</a></li>
                <li><a href="/hesap/sifre">ŞİFRE İŞLEMİ</a></li>
                <li><a href="/hesap/iade">İADE VE DEĞİŞİM</a></li>
                <li><a href="/hesap/talep">TALEPLERİM</a></li>
            </ul>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-9">
            
            <?php echo $__env->yieldContent('process'); ?>
        
        </div>
    </section>

    <section class="row sub-features">
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb1.svg" alt="">
                <h4>ÜCRETSİZ KARGO</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb2.svg" alt="">
                <h4>KOLAY İADE İMKANI</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb3.svg" alt="">
                <h4>TELEFON İLE SİPARİŞ</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb4.svg" alt="">
                <h4>GÜVENLİ ALIŞVERİŞ</h4>
            </div>
        </div>
    </section>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    @media (max-width: 991px)
    {
        .sub-features
        {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px)
    {
        .sub-features .col-6:nth-child(1),
        .sub-features .col-6:nth-child(2)
        {
            margin-bottom: 15px;
        }

        .user-panel
        {
            padding: 30px 0;
        }
    }

</style>

<script>

    $(function()
    {
        $('#p-menu li a').each(function()
        {
            var href = $(this).attr('href');
                path = '/<?php echo e(Request::path()); ?>';

            if (path.indexOf(href) != -1)

                $(this).closest('li').addClass('active');
        });
    });

</script>

<?php echo $__env->yieldContent('extra'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>