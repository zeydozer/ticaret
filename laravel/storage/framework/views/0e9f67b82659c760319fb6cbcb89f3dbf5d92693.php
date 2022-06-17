<?php $__env->startSection('header', 'Üyeler'); ?>
<?php $__env->startSection('optional', 'Düzenle'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <?php $__currentLoopData = ['isim' => 'Ad Soyad', 'mail' => 'Mail', 'tel' => 'Tel']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label for="<?php echo e($column); ?>"><?php echo e($name); ?></label>
                        <input type="text" name="<?php echo e($column); ?>" id="<?php echo e($column); ?>" 
                        class="form-control" value="<?php echo e($gelen->$column); ?>" required>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label for="sifre"><?php if($gelen->id): ?> Yeni <?php endif; ?> Şifre</label>
                        <input type="password" name="sifre" id="sifre" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="onay" <?php if($gelen->onay): ?> checked <?php endif; ?>>
                                Aktivasyon
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                    <button type="submit" class="btn btn-danger" value="<?php echo e(!$gelen->sil ? 'Sil' : 'Geri Al'); ?>" 
                        onclick="return confirm('Emin misiniz?')">
                        <?php echo e(!$gelen->sil ? 'Sil' : 'Geri Al'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>