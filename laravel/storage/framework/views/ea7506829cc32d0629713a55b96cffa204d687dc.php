<?php $__env->startSection('header', 'Yorumlar'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Toplam: <?php echo e($toplam); ?></h3>
              <div class="box-tools" style="display: none">
                <form class="input-group input-group-sm" style="width: 130px;" method="get" 
                action="/admin/yorum" id="arama">
                  <input type="hidden" name="sira" value="<?php echo e(implode(' ', $sira)); ?>">
                  <input type="hidden" name="sayfa" value="1">
                </form>
              </div>
            </div>
            <div class="box-body no-padding table-responsive">
              <table class="table">
                <tr>
                  <th>#</th>
                  <th sort="tarih">Tarih</th>
                  <th sort="isim_u">Ürün</th>
                  <th sort="isim">İsim</th>
                  <th sort="yorum">Yorum</th>
                  <th sort="puan">Puan</th>
                  <th></th>
                  <th></th>
                </tr>
                <?php $__currentLoopData = $yorumlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $yorum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data="<?php echo e($yorum->id); ?>">
                  <td><b><?php echo e($limit + $i + 1); ?>)</b></td>
                  <td><?php echo e(date('d.m.Y H:i', strtotime($yorum->tarih))); ?></td>
                  <td><a href="/admin/urun/<?php echo e($yorum->id_u); ?>"><?php echo e($yorum->isim_u); ?></a></td>
                  <td><?php echo e($yorum->isim); ?></td>
                  <td><?php echo e($yorum->yorum); ?></td>
                  <td><?php echo e($yorum->puan); ?></td>
                  <td>
                    <a href="islem" data="onay">
                      <i class="fa fa-<?php echo e($yorum->onay ? 'check' : 'ban'); ?>"></i>
                    </a>
                  </td>
                  <td>
                    <a href="islem" data="sil">
                      <i class="fa fa-trash"></i>
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

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    
    $('[href="islem"]').click(function(e)
    {
        e.preventDefault();

        var id = $(this).closest('tr').attr('data'), islem = $(this).attr('data');

            datas = {id: id, _token: $('[name="csrf-token"]').attr('content'), konu: islem};

            _this = $(this); _class = $(this).find('i').attr('class');

        if (islem == 'sil')
        {
            if (confirm('Emin misiniz?'))
            {
                $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');

                $.post(location.pathname, datas, function(resp)
                {
                    if (resp == 1) location.reload();

                    else _this.find('i').attr('class', _class);
                });
            }
        }

        else
        {
            $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');
            
            $.post(location.pathname, datas, function(resp)
            {
                if (resp == 1) location.reload();

                else _this.find('i').attr('class', _class);
            });
        }
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>