

<?php $__env->startSection('header', 'Ayarlar'); ?>
<?php $__env->startSection('optional', 'Pos'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">

                    <?php $temps = json_decode(\App\Ayar::find(14)->data, true) ?>

                    <?php $__currentLoopData = $pos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label><?php echo e(ucwords(str_replace('_', ' ', $name))); ?></label>
                        <?php if($name == 'banka'): ?>
                        <select class="form-control" name="banka" required>
                            <?php $__currentLoopData = $temps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $selected = $value == $bank ? 'selected' : null ?>

                            <option value="<?php echo e($bank); ?>" <?php echo e($selected); ?>><?php echo e(ucwords(str_replace('_', ' ', $bank))); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php else: ?>
                        <input type="text" name="<?php echo e($name); ?>" class="form-control" value="<?php echo e($value); ?>">
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
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>