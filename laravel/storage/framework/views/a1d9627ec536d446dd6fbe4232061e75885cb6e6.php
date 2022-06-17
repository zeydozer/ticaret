<?php $__env->startSection('header', 'Kategori'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="<?php if($gelen->id): ?> col-md-9 <?php else: ?> col-md-12 <?php endif; ?>">
                                <select name="id" id="id" class="form-control select2" 
                                onchange='location.href = "/admin/kategori/"+ value'>
                                    <option value="" selected>+ Yeni</option>
                                    <?php if(count($kategoriler) > 0): ?>
                                    <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat_id => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php $select = $gelen->id == $kat_id ? 'selected' : ''; ?>
                                    
                                    <option value="<?php echo e($kat_id); ?>" <?php echo e($select); ?>><?php echo e($kategori); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <?php if($gelen->id): ?>
                            <div class="col-md-3">
                                <a href="/admin/urun?kat_id=<?php echo e($gelen->id); ?>" class="btn btn-primary btn-block">
                                    Ürünler &nbsp;&nbsp; <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(count($kategoriler) > 0): ?>
                    <div class="form-group">
                        <label for="bagli-id">Bağlı Olduğu Kategori</label>
                        <select name="bagli_id" id="bagli-id" class="form-control select2">
                            <option value="" selected>- Yok</option>
                            <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat_id => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php 
                            
                            if ($gelen->id == $kat_id) continue; 
                            
                            $select = $gelen->bagli_id == $kat_id ? 'selected' : ''; 
                            
                            ?>
                            
                            <option value="<?php echo e($kat_id); ?>" <?php echo e($select); ?>><?php echo e($kategori); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="isim">İsim</label>
                        <input type="text" required name="isim" id="isim" class="form-control" value="<?php echo e($gelen->isim); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sira">Sıra</label>
                        <input type="number" required name="sira" id="sira" class="form-control" value="<?php echo e($gelen->sira); ?>">
                    </div>
                    <?php if($gelen->foto): ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/<?php echo e($gelen->foto); ?>" data-fancybox>
                                <img src="/img/<?php echo e($gelen->foto); ?>" height="150">
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
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ana" <?php if($gelen->ana): ?> checked <?php endif; ?>>
                                Anasayfa
                            </label>
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
    <?php if(DB::table('kategori')->where('bagli_id', $gelen->bagli_id)->count() > 0): ?>
    <div class="col-md-4">
		<div class="box box-solid sira-container">
			<div class="box-header with-border">
				<h4 class="box-title">Sıralama</h4>
			</div>
			<div class="box-body">
				<ul id="sortable" style="list-style: none; padding-left: 0">
				  <?php $__currentLoopData = DB::table('kategori')->where('bagli_id', $gelen->bagli_id)->orderBy('sira')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <li class="ui-state-default external-event bg-light-blue" id="<?php echo e($kategori->id); ?>">
				  	<span class="ui-icon ui-icon-arrowthick-2-n-s" style="color: orange"><?php echo e($i + 1); ?>) </span><?php echo e($kategori->isim); ?>

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