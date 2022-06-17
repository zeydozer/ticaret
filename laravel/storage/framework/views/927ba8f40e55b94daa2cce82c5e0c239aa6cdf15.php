<?php $__env->startSection('header', 'Üyeler'); ?>

<?php $tip = Request::has('tip') ? Request::get('tip') : 'hepsi' ?>

<?php $__env->startSection('optional', ucfirst($tip)); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Toplam: <?php echo e($toplam); ?></h3>
          <div class="box-tools">
            <form class="input-group input-group-sm" style="width: 130px;" 
            method="get" action="/admin/uye" id="arama">
              <input type="hidden" name="tip" value="<?php echo e($tip); ?>">
              <input type="text" name="aranan" class="form-control pull-right" required>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
              <input type="hidden" name="sira" value="<?php echo e(implode(' ', $sira)); ?>">
              <input type="hidden" name="sayfa" value="1">
            </form>
          </div>
        </div>
        <div class="box-body no-padding table-responsive">
          <table class="table">
            <tr>
              <th>#</th>
              <th sort="isim">Ad Soyad</th>
              <th sort="mail">E-Posta</th>
              <th sort="tel">Telefon</th>
              <th sort="onay">Aktivasyon</th>
              <th sort="sil">Arşiv</th>
              <td></td>
            </tr>
            <?php $__currentLoopData = $uyeler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $uye): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><b><?php echo e($limit + $i + 1); ?>)</b></td>
              <td><?php echo e($uye->isim); ?></td>
              <td><a href="mailto:<?php echo e($uye->mail); ?>"><?php echo e($uye->mail); ?></a></td>
              <td><a href="tel:<?php echo e($uye->tel); ?>"><?php echo e($uye->tel); ?></a></td>
              <td><i class="fa fa-<?php echo e($uye->onay ? 'check' : 'minus'); ?>"></i></td>
              <td><i class="fa fa-<?php echo e($uye->sil ? 'check' : 'minus'); ?>"></i></td>
              <td>
                <a href="/admin/uye/<?php echo e($uye->id); ?>">
                  <i class="fa fa-pencil"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        </div>
        <?php if($toplam > $goster): ?>
        <div class="box-footer clearfix">
          <?php echo $sayfala ?> &nbsp;&nbsp;&nbsp;
          <?php echo e($sayfa_no = ceil($toplam / $goster)); ?> Sayfa
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <style>
    tr td {
      vertical-align: middle !important
    }

    tr th {
      white-space: nowrap
    }

    tr th[sort] {
      cursor: pointer;
    }

    tr td img {
      width: 100px;
      display: block;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .box-footer {
      color: #337ab7;
    }

    .box-footer select {
      display: inline-block;
      width: auto;
    }

    .box-footer a {
      cursor: pointer;
    }

    .box-footer a:first-child {
      margin-right: 10px;
    }

    .box-footer a:last-child {
      margin-left: 10px;
    }
  </style>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>