<?php $__env->startSection('header', 'Yönetim Paneli'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e(\App\Kategori::count()); ?></h3>
                    <p>Kategori</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="/admin/kategori" class="small-box-footer">
                    Detaylar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e(\App\Urun::where('sil', 0)->count()); ?></h3>
                    <p>Ürün</p>
                </div>
                <div class="icon">
                    <i class="fa fa-th-large"></i>
                </div>
                <a href="/admin/urun" class="small-box-footer">
                    Detaylar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- ./row -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e(\App\Siparis::where('sil', 0)->count()); ?></h3>
                    <p>Sipariş</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="/admin/siparis" class="small-box-footer">
                    Detaylar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e(\App\Uye::where('sil', 0)->where('tip', 'user')->count()); ?></h3>
                    <p>Üye</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="/admin/uye" class="small-box-footer">
                    Detaylar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- ./row -->
</section>
<!-- /.content -->

<style> .small-box { margin-bottom: 30px } </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>