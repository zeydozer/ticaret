<?php $__env->startSection('header', 'Ürünler'); ?>

<?php $tip = Request::has('tip') ? Request::get('tip') : 'hepsi' ?>

<?php $__env->startSection('optional', ucfirst(str_replace('-', ' ', $tip))); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Toplam: <?php echo e($toplam); ?></h3>
          <div class="box-tools">
            <form class="input-group input-group-sm" style="width: 130px;" 
            method="get" action="/admin/urun" id="arama">
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
              <th sort="kod">Stok <br> Kodu</th>
              <th sort="isim">İsim</th>
              <th sort="katg">Kategori</th>
              <?php if($tip != 'hazir-paket'): ?>
              <th sort="stok">Stok</th>
              <?php endif; ?>
              <th sort="fiyat">Fiyat</th>
              <th sort="indirim">İndirim</th>
              <?php if($tip != 'hazir-paket'): ?>
              <th sort="marka">Marka</th>
              <?php endif; ?>
              <th sort="vitrin">Öne <br> Çıkan</th>
              <th sort="yeni">Yeni <br> Gelen</th>
              <th sort="sil">Arşive <br> At</th>
              <th></th>
            </tr>
            <?php $__currentLoopData = $urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr data="<?php echo e($urun->id); ?>">
              <td><b><?php echo e($limit + $i + 1); ?>)</b></td>
              <td><?php echo $urun->kod ? $urun->kod : '<i class="fa fa-minus"></i>' ?></td>
              <td><?php echo e($urun->isim); ?></td>
              <td><?php echo $urun->katg ? $urun->katg : '<i class="fa fa-minus"></i>' ?></td>
              <?php if($tip != 'hazir-paket'): ?>
              <td>
                <input type="number" name="stok" class="form-control" 
                value="<?php echo e($urun->stok); ?>" min="0" step="1" required
                <?php if($urun->set): ?> readonly <?php endif; ?>>
              </td>
              <?php endif; ?>
              <td>
                <input type="number" name="fiyat" class="form-control" 
                value="<?php echo e($urun->fiyat); ?>" required min="1" step="0.01"
                <?php if($urun->set): ?> readonly <?php endif; ?>>
              </td>
              <td>
                <input type="number" name="indirim" class="form-control" 
                value="<?php echo e($urun->indirim); ?>" required min="1" step="0.01"
                <?php if($urun->set): ?> readonly <?php endif; ?>>
              </td>
              <?php if($tip != 'hazir-paket'): ?>
              <td><?php echo $urun->marka ? $urun->marka : '<i class="fa fa-minus"></i>' ?></td>
              <?php endif; ?>
              <td><i class="fa fa-<?php echo e($urun->vitrin ? 'check' : 'minus'); ?>"></i></td>
              <td><i class="fa fa-<?php echo e($urun->yeni ? 'check' : 'minus'); ?>"></i></td>
              <td>
                <a href="islem" data="Arşive At">
                  <i class="fa fa-<?php echo e($urun->sil ? 'check' : 'ban'); ?>"></i>
                </a>
              </td>
              <td>

                <?php $url = $urun->set ? $urun->id .'?set=true' : $urun->id ?>

                <a href="/admin/urun/<?php echo e($url); ?>">
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
      white-space: nowrap;
      vertical-align: middle !important
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

    tr td .form-control {
      width: 75px;
      font-size: 9pt;
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
<script>

    $(function()
    {
      function update(_this)
      {
        var id = _this.closest('tr').attr('data');
            url = '/admin/urun/hizli/'+ id;
            
        $.get(url, {name: _this.attr('name'), value: _this.val()});
      }

      $('.form-control').keyup(function()
      {
        update($(this));
      
      }).change(function()
      {
        update($(this));
      });

      $('[href="islem"]').click(function(e)
      {
          e.preventDefault();

          var id = $(this).closest('tr').attr('data'), islem = $(this).attr('data');

              datas = {id: id, _token: $('[name="csrf-token"]').attr('content'), yap: islem};

              _this = $(this); _class = $(this).find('i').attr('class');

          if (islem == 'sil')
          {
              if (confirm('Emin misiniz?'))
              {
                  $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');

                  $.post('/admin/urun/hizli/'+ id, datas, function(resp)
                  {
                      if (resp == 1) location.reload();

                      else _this.find('i').attr('class', _class);
                  });
              }
          }

          else
          {
              $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');
              
              $.post('/admin/urun/hizli/'+ id, datas, function(resp)
              {
                  if (resp == 1) location.reload();

                  else _this.find('i').attr('class', _class);
              });
          }
      });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>