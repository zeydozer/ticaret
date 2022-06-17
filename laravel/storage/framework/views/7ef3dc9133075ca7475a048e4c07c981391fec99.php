<?php $__env->startSection('header', 'Ayarlar'); ?>
<?php $__env->startSection('optional', 'Slider'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <select name="id" id="id" class="form-control" 
                        onchange='location.href = "/admin/ayar/slide/"+ value'>
                            <option value="" selected>+ Yeni</option>
                            <?php if(count($slides) > 0): ?>
                            <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php  $select = $gelen->id == $slide->id ? 'selected' : '';  ?>
                            <option value="<?php echo e($slide->id); ?>" <?php echo e($select); ?>><?php echo e($slide->id); ?> (Sıra: <?php echo e($slide->sira); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <?php if($gelen->foto): ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/<?php echo e($gelen->foto); ?>" data-fancybox>
                                <img src="/img/<?php echo e($gelen->foto); ?>" height="300">
                            </a>
                        </div>
                    </div>
                    <hr>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="foto">Fotoğraf</label>
                        <input type="file" name="foto" id="foto" class="form-control" <?php if(!$gelen->id): ?> required <?php endif; ?>>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" value="<?php echo e($gelen->link); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sira">Sıra</label>
                        <input type="number" required name="sira" id="sira" class="form-control" value="<?php echo e($gelen->sira); ?>">
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
    <?php if(DB::table('slide')->count() > 0): ?>
    <div class="col-md-4">
		<div class="box box-solid sira-container">
			<div class="box-header with-border">
				<h4 class="box-title">Sıralama</h4>
			</div>
			<div class="box-body">
				<ul id="sortable" style="list-style: none; padding-left: 0">
				  <?php $__currentLoopData = DB::table('slide')->orderBy('sira')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <li class="ui-state-default external-event bg-light-blue" id="<?php echo e($slide->id); ?>">
				  	<span class="ui-icon ui-icon-arrowthick-2-n-s" style="color: orange"><?php echo e($i + 1); ?>) </span>
                    <?php echo e($slide->id); ?> (Sıra: <?php echo e($slide->sira); ?>)
				  </li>
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /. box -->
	</div>
    <?php endif; ?>
</div>

</section>
<!-- /.content -->

<style>

    img
    {
        width: 100%;
        object-fit: contain;
        object-position: left;
    }

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>