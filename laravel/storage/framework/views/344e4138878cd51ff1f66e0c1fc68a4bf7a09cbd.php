<?php $__env->startSection('header', 'Siparişler'); ?>

<?php 
            
$tipler = 
[
  'hepsi' => null,
  'bekliyor' => 'Onay Bekleyen', 
  'onaylandı' => 'Onaylanan',
  'kargo' => 'Kargoya Verilen',
  'tamam' => 'Tamamlanan',
  'iptal' => 'İptal Olan',
];

$tip = Request::has('tip') ? Request::get('tip') : 'hepsi';

?>

<?php $__env->startSection('optional', $tipler[$tip]); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Toplam: <?php echo e($toplam); ?></h3>
          <div class="box-tools">
            <form class="input-group input-group-sm" style="width: 130px;" method="get" action="<?php echo e(url('admin/siparis')); ?>"
              id="arama">
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
              <th sort="siparis.tarih">Tarih</th>
              <th sort="siparis.id">No</th>
              <th sort="uye.isim">İsim</th>
              <th sort="uye.mail">E-Posta</th>
              <th sort="uye.tel_gsm">Telefon</th>
              <th sort="siparis.odeme">Ödeme</th>
              <th>Tutar</th>
              <th sort="siparis.durum">Durum</th>
              <th></th>
            </tr>
            <?php $__currentLoopData = $siparisler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $siparis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php 

            $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

            $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

            ?>
            
            <tr>
              <td><b><?php echo e($limit + $i + 1); ?>)</b></td>
              <td><?php echo e(date('d.m.Y', strtotime($siparis->tarih))); ?></td>
              <td><?php echo e($siparis->id); ?></td>
              <td>
                <?php if(is_numeric($siparis->uye_id)): ?>
                <a href="<?php echo e(url('admin/uye/'. $siparis->uye_id)); ?>">
                  <?php echo e($siparis->isim); ?>

                </a>
                <?php else: ?>
                <?php echo e($siparis->isim); ?>

                <?php endif; ?>
              </td>
              <td><a href="mailto:<?php echo e($siparis->mail); ?>"><?php echo e($siparis->mail); ?></a></td>
              <td><a href="tel:<?php echo e($siparis->tel); ?>"><?php echo e($siparis->tel); ?></a></td>
              <td><?php echo e($siparis->odeme); ?></td>              
              <td><?php echo e(floatval($tutar - $siparis->indirim)); ?></td>
              <td><?php echo e($siparis->durum); ?></td>
              <td>
                <a href="<?php echo e(url('admin/siparis/'. $siparis->id)); ?>">
                  <i class="fa fa-eye"></i>
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