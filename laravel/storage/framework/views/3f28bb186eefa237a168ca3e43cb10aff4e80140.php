<?php $__env->startSection('header', 'Ayarlar'); ?>
<?php $__env->startSection('optional', 'İletişim'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <?php $__currentLoopData = $iletisim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label><?php echo e(ucfirst($name)); ?></label>
                        <?php if($name != 'adres'): ?>
                        <input type="text" name="<?php echo e($name); ?>" class="form-control" value="<?php echo e($value); ?>" required>
                        <?php else: ?>
                        <textarea name="<?php echo e($name); ?>" class="form-control" required 
                        rows="3" style="resize: none"><?php echo $value ?></textarea>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- Google Maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyw0CFUi4wM_RXPL0kSV9-rmHrJBqm4vo&callback=initMap&libraries=places&language=tr"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>