<?php $__env->startSection('header', 'Ayarlar'); ?>
<?php $__env->startSection('optional', 'Banka'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <select name="id" class="form-control" onchange="location.href = '/admin/ayar/banka/'+ value">
                            <option value="" selected>+ Yeni</option>
                            <?php if(count($bankalar) > 0): ?>
                            <?php $__currentLoopData = $bankalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php $select = $gelen->id == $banka->id ? 'selected' : ''; ?>
                            
                            <option value="<?php echo e($banka->id); ?>" <?php echo e($select); ?>><?php echo e(json_decode($banka->data)->isim); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>İsim</label>
                                <input type="text" name="isim" class="form-control" value="<?php echo e($temp->isim); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Şube</label>
                                <input type="text" name="sube" class="form-control" value="<?php echo e($temp->sube); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Şube Kodu</label>
                                <input type="number" name="kod" class="form-control" value="<?php echo e($temp->kod); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>IBAN</label>
                        <input type="text" name="iban" class="form-control" value="<?php echo e($temp->iban); ?>" required>
                    </div>
                    <?php if($temp->foto): ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/<?php echo e($temp->foto); ?>" data-fancybox>
                                <img src="/img/<?php echo e($temp->foto); ?>" height="150">
                            </a>
                        </div>
                    </div>
                    <hr>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Fotoğraf</label>
                                <input type="file" name="foto" id="foto" class="form-control" <?php if(!$gelen->id): ?> required <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sıra</label>
                                <input type="number" name="sira" class="form-control" value="<?php echo e($gelen->data_2); ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                    <?php if($gelen->id): ?>
                    <button type="submit" class="btn btn-danger" value="Sil" onclick="return confirm('Emin misiniz?')">Sil</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->

<style>

    img
    {
        width: 80%;
        object-fit: contain;
        object-position: left;
    }

    @media (min-width: 992px)
    {
        .col-md-6:first-child,
        .col-md-4:first-child
        {
            padding-right: 7.5px;
        }

        .col-md-6:last-child,
        .col-md-4:last-child
        {
            padding-left: 7.5px;
        }

        .col-md-4:nth-child(2)
        {
            padding-left: 7.5px;
            padding-right: 7.5px;
        }
    }
    
    @media (max-width: 991px)
    {
        .col-md-6, 
        .col-md-4
        {
            padding-right: 15px;
            padding-left: 15px;
        }
    }

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>