<?php $__env->startSection('header', 'Sipariş Detayı'); ?>
<?php $__env->startSection('optional', 'No: '. $siparis->id); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="info" style="margin-bottom: 30px">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Tarih:</b> <?php echo e(date('d.m.Y H:i', strtotime($siparis->tarih))); ?> <br>
                                <b>Üye:</b> 
                                <?php if(is_numeric($siparis->uye_id)): ?>
                                <a href="<?php echo e(url('admin/uye/'. $siparis->uye_id)); ?>">
                                    <?php echo e($siparis->isim); ?>

                                </a> 
                                <?php else: ?>
                                <?php echo e($siparis->isim); ?>

                                <?php endif; ?>
                                <br>
                                <b>E-Posta:</b> 
                                <a href="mailto: <?php echo e($siparis->mail); ?>">
                                    <?php echo e($siparis->mail); ?>

                                </a>
                                <br>
                                <b>Gsm:</b> 
                                <a href="tel: <?php echo e($siparis->tel); ?>">
                                    <?php echo e($siparis->tel); ?>

                                </a>
                                <br>
                                <b>Ödeme:</b> <?php echo e($siparis->odeme); ?>

                                <?php if($siparis->odeme != 'Kart'): ?>
                                <?php if($siparis->odeme != 'Kapıda Ödeme'): ?>
                                 - <?php echo $siparis->sekil ?>
                                <?php else: ?>
                                 - <?php echo e(floatval($siparis->sekil)); ?>₺
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <b>Fatura Adresi:</b> <br>
                                <?php echo $siparis->fatura ?> 
                                <br>
                                <b>Teslimat Adresi:</b> <br>
                                <?php echo $siparis->teslimat ?>
                            </div>
                        </div>
                    </div>
                    <div class="products">
                        <table class="table">
                            <tr>
                                <th colspan="2">Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                            </tr>

                            <?php $toplam = 0 ?>

                            <?php $__currentLoopData = $urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                            <?php $toplam += $urun->fiyat * $urun->adet ?>

                            <tr>
                                <td width="100"><img src="<?php echo e(asset('img/'. $urun->foto)); ?>"></td>
                                <td><?php echo e($urun->isim); ?></td>
                                <td><?php echo e(floatval($urun->fiyat)); ?></td>
                                <td><?php echo e($urun->adet); ?></td>
                                <td><?php echo e(floatval($urun->fiyat * $urun->adet)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th colspan="3"></th>
                                <th>Ara Toplam</th>
                                <th><?php echo e(floatval($toplam)); ?></th>
                            </tr>
                            <?php if($siparis->indirim > 0): ?>
                            <tr>
                                <th colspan="3"></th>
                                <th>İndirim</th>
                                <th><?php echo e(floatval($siparis->indirim)); ?></th>
                            </tr>
                            <?php endif; ?>
                            
                            <?php $toplam += $siparis->kargo ?>

                            <tr>
                                <th colspan="3"></th>
                                <th>Kargo</th>
                                <th><?php echo e(floatval($siparis->kargo)); ?></th>
                            </tr>
                            <?php if($siparis->odeme == 'Kapıda Ödeme'): ?>

                            <?php $toplam += $siparis->sekil ?>

                            <tr>
                                <th colspan="3"></th>
                                <th>Kapıda Ödeme</th>
                                <th><?php echo e(floatval($siparis->sekil)); ?></th>
                            </tr>
                            <?php endif; ?>

                            <tr>
                                <th colspan="3"></th>
                                <th>Toplam</th>
                                <th><?php echo e(floatval($toplam - $siparis->indirim)); ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="margin: 30px 0 0 0">
                                <label>Sipariş Durumu</label>
                                <select name="durum" class="form-control">
                                    <option value="Onay Bekliyor">Onay Bekliyor</option>
                                    <option value="Onaylandı">Onaylandı</option>
                                    <option value="Kargoya Verildi">Kargoya Verildi</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                    <option value="İptal Edildi">İptal Edildi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin: 30px 0 0 0">
                                <label>Kargo No</label>
                                <input type="text" class="form-control" name="kargo_no">
                            </div>
                        </div>
                    </div>                      
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

<style type="text/css">
    
    .table
    {
        margin-bottom: 0;
    }

    .table img
    {
        width: 100px;
        height: 75px;
        object-fit: contain;
    }

    .table > tbody > tr > th,
    .table > tbody > tr > td
    {
        vertical-align: middle;
    }

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    
    $('[name="durum"]').val('<?php echo e($siparis->durum); ?>');

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>