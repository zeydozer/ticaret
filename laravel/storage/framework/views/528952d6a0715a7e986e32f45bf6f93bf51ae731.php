<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    
    <?php if(isset($breadcrumb)): ?> 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/urunler">Ürünler</a></li>
            
            <?php $i = 1 ?>
            
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="breadcrumb-item <?php if($i == count($breadcrumb)): ?> active <?php endif; ?>" 
            <?php if($i == count($breadcrumb)): ?> aria-current="page" <?php endif; ?>>
                <a href="<?php echo e($url); ?>"><?php echo e($name); ?></a>
            </li>

            <?php $i++ ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
    <?php else: ?>
    <div class="d-none d-md-block" style="height: calc(30px + 1rem)"></div>
    <?php endif; ?>

    <section class="row products-list">
        <h1 class="text-uppercase"><?php echo e($title); ?></h1>
        <form name="search" class="col-xl-3 col-lg-3 col-md-4 filter" 
        action="/<?php echo e(Request::path()); ?>" method="get">
            <a href="#" class="filter-button">Filtrele</a>
            <?php if(isset($ustler) && count($ustler) > 0): ?>
            <div class="filter-item">
                <span class="title">Kategoriler</span>
                <?php $__currentLoopData = $ustler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/urunler/<?php echo e($kategori->url); ?>"><?php echo e($kategori->isim); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            <?php if(count($kategoriler) > 0): ?>
            <div class="filter-item">
                <span class="title">
                    <?php if(isset($ustler) && count($ustler) > 0): ?>
                    Alt
                    <?php endif; ?>
                    Kategoriler
                </span>
                <?php $__currentLoopData = $kategoriler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/urunler/<?php echo e($kategori->url); ?>"><?php echo e($kategori->isim); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            <div class="filter-item">
                <span class="title">İsim</span>
                <input type="text" name="ara" class="form-control" value="<?php echo e(Request::get('ara')); ?>">
            </div>
            <?php if($markalar[0] > 0): ?>
            <div class="filter-item">
                <span class="title">Marka</span>
                
                <?php $array = Request::has('marka') ? Request::get('marka') : [] ?>

                <?php $__currentLoopData = $markalar[1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $marka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="filter-line">
                    <input type="checkbox" value="<?php echo e($marka->isim); ?>" id="marka-<?php echo e($i); ?>" 
                    name="marka[]" <?php if(in_array($marka->isim, $array)): ?> checked <?php endif; ?>>
                    <label for="marka-<?php echo e($i); ?>"><?php echo e($marka->isim); ?></label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            <div class="filter-item">
                <span class="title">Fiyat</span>
                
                <?php 
                
                $fiyatlar = [[0, 50], [50, 100], [100, 250], [250, 500], [500, null]];
                
                $array = Request::has('fiyat') ? Request::get('fiyat') : [];

                ?>

                <?php $__currentLoopData = $fiyatlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $fiyat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="filter-line">
                    <input type="checkbox" value="<?php echo e(implode('-', $fiyat)); ?>" id="fiyat-<?php echo e($i); ?>" 
                    name="fiyat[]" <?php if(in_array(implode('-', $fiyat), $array)): ?> checked <?php endif; ?>>
                    <label for="fiyat-<?php echo e($i); ?>">
                        <?php echo e($fiyat[0]); ?> TL <?php if($fiyat[1]): ?> - <?php echo e($fiyat[1]); ?> TL <?php else: ?> ve üstü <?php endif; ?>
                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="filter-item">
                <span class="title">Özellik</span>

                <?php 
                
                $array = Request::has('ozellik') ? Request::get('ozellik') : [];

                $ozellikler = ['yeni' => 'Yeni Gelen', 'vitrin' => 'Öne Çıkan', 'indir' => 'İndirimli'];
                
                ?>

                <?php $__currentLoopData = $ozellikler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ozellik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="filter-line">
                    <input type="checkbox" value="<?php echo e($i); ?>" id="ozel-<?php echo e($i); ?>" 
                    name="ozellik[]" <?php if(in_array($i, $array)): ?> checked <?php endif; ?>>
                    <label for="ozel-<?php echo e($i); ?>"><?php echo e($ozellik); ?></label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <input type="hidden" name="sayfa" value="1">
            <input type="hidden" name="sira" value="<?php echo e($sira); ?>">
            <div class="filter-item">
                <button class="btn" type="submit">Ara</button>
            </div>
        </form>
        <div class="col-xl-9 col-lg-9 col-md-8">
            <?php if(count($urunler) > 0): ?>
            <div class="filter-top w-100 d-flex justify-content-between">
                <div class="ranking">
                    <select name="sirala">
                        <option value="id desc">Akıllı Sıralama</option>
                        <option value="isim asc">A-Z'ye Göre</option>
                        <option value="isim desc">Z-A'ya Göre</option>
                        <option value="fiyat_s asc">Fiyat Artan</option>
                        <option value="fiyat_s desc">Fiyat Azalan</option>
                    </select>
                </div>
                <?php if($toplam > $goster): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if($sayfa > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($sayfa - 1); ?>"><i class="fas fa-backward"></i></a>
                        </li>
                        <?php endif; ?>

                        <?php 

                        $basla = $sayfa == 1 ? 1 : $sayfa - 1;

                        $bitir = ceil($toplam / $goster) - $sayfa >= 3  ? $sayfa + 1 : ceil($toplam / $goster);

                        ?>

                        <?php if($sayfa >= 3): ?>
                        <li class="page-item"><a class="page-link" href="1">1</a></li>
                        <?php if($sayfa > 3): ?>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php for($i = $basla; $i <= $bitir; $i++): ?> 
                        <li class="page-item">
                            <a class="<?php echo e($i == $sayfa ? 'current' : ''); ?> page-link" href="<?php echo e($i); ?>"><?php echo e($i); ?></a>
                        </li>
                        <?php endfor; ?>
                        <?php if(ceil($toplam / $goster) - $sayfa >= 3): ?>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a href="<?php echo e(ceil($toplam / $goster)); ?>" class="page-link"><?php echo e(ceil($toplam / $goster)); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if($sayfa < ceil($toplam / $goster)): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($sayfa + 1); ?>"><i class="fas fa-forward"></i></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
            <div class="row list products">
                <?php $__currentLoopData = $urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xl-3 col-lg-4 col-md-6 list-item">
                    <a href="/urun/<?php echo e($urun->url); ?>">
                        <div class="product-container">

                            <?php 
                            
                            $profil = \App\Foto::where('profil', 1)
                                               ->where('urun_id', $urun->id)
                                               ->first();
                            
                            $profil = $profil ? $profil->deger : 'logo.png';

                            ?>

                            <img src="/img/<?php echo e($profil); ?>" class="img-fluid" alt="<?php echo e($urun->isim); ?>"
                            <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                            <h5>
                                <?php echo e($urun->isim); ?>

                                <!-- <?php if($urun->kod): ?>
                                <small><?php echo e($urun->kod); ?></small>
                                <?php endif; ?> -->
                            </h5>
                            <div class="prices text-center">
                                <?php if($urun->indirim > 0): ?>
                                <span class="old"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                                <span class="product-price"><?php echo e(number_format($urun->indirim, 2, ',', '.')); ?> TL</span>
                                <?php else: ?>
                                <span class="old invisible"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                                <span class="product-price"><?php echo e(number_format($urun->fiyat, 2, ',', '.')); ?> TL</span>
                                <?php endif; ?>
                            </div>
                            <?php if($urun->indirim > 0): ?>
                            <span class="winnings">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                            <?php else: ?>
                            <span class="winnings invisible">Kazancınız %<?php echo e(intval($urun->oran)); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="hover">
                        <?php if($urun->stok && !$urun->paket): ?>
                        <a href="<?php echo e($urun->id); ?>" class="add-basket">Sepete Ekle</a>
                        <?php endif; ?>
                        <a href="/urun/<?php echo e($urun->url); ?>">İncele</a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($toplam > $goster): ?>
            <div class="filter-top w-100 d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if($sayfa > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($sayfa - 1); ?>"><i class="fas fa-backward"></i></a>
                        </li>
                        <?php endif; ?>

                        <?php 

                        $basla = $sayfa == 1 ? 1 : $sayfa - 1;

                        $bitir = ceil($toplam / $goster) - $sayfa >= 3  ? $sayfa + 1 : ceil($toplam / $goster);

                        ?>

                        <?php if($sayfa >= 3): ?>
                        <li class="page-item"><a class="page-link" href="1">1</a></li>
                        <?php if($sayfa > 3): ?>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php for($i = $basla; $i <= $bitir; $i++): ?> 
                        <li class="page-item">
                            <a class="<?php echo e($i == $sayfa ? 'current' : ''); ?> page-link" href="<?php echo e($i); ?>"><?php echo e($i); ?></a>
                        </li>
                        <?php endfor; ?>
                        <?php if(ceil($toplam / $goster) - $sayfa >= 3): ?>
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a href="<?php echo e(ceil($toplam / $goster)); ?>" class="page-link"><?php echo e(ceil($toplam / $goster)); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if($sayfa < ceil($toplam / $goster)): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($sayfa + 1); ?>"><i class="fas fa-forward"></i></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
            <?php else: ?>
            Ürün bulunamadı.
            <?php endif; ?>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    .filter-item a
    {
        display: block;
        color: #212529;
    }

    .filter-item .form-control
    {
        border-color: #212529;
        max-width: 175px;
        border-radius: 0;
    }

    .filter-item .form-control:focus
    {
        outline: unset;
        box-shadow: unset;
    }

    [name="search"]
    {
        font-size: 14px;
    }

    [name="search"] .btn
    {
        width: 175px;
        background: #009498;
        color: #fff;
        font-weight: 900;
        border: none;
        padding: .5rem 0;
        font-size: 18px;
    }

    .products-list .products
    {
        margin-right: -7.5px;
        margin-left: -7.5px;
    }

    .products-list .list .list-item
    {
        margin-bottom: 15px;
        padding-left: 7.5px;
        padding-right: 7.5px;
    }

    .products a
    {
        display: block;
        border: 1px solid #707070;
        border-radius: 10px;
        padding: .5rem;
        height: 100%;
    }

    .products a:hover
    {
        border-color: #009498;
        box-shadow: 0 0 5px rgba(0, 0, 0, .25);
    }

    .products img
    {
        margin-bottom: 0;
        width: 100%;
    }

    .prices
    {
        line-height: 1;
    }

    .prices .old
    {
        display: table;
        margin: 0 auto;
        text-align: center;
        color: #383838;
        margin-bottom: 5px;
        width: auto;
    }

    .prices .old::after 
    {
        display: none;
    }

    .prices .old::before 
    {
        width: 120%;
        display: block;
        height: 1px;
        background: #ff0000;
        content: '';
        position: absolute;
        left: -10%;
        top: 50%;
    }
    
    .products .winnings
    {
        display: none;
        background: #ff0000;
        color: #fff;
        font-size: 10pt;
        padding: 5px 10px;
        margin-top: 10px;
    }

    .products h5
    {
        margin-bottom: 0;
        padding: 0 .5rem;
        color: #000;
        transition: .125s;
    }

    .products-list .list .list-item
    {
        position: relative;
    }

    .products .list-item:hover .hover
    {
        opacity: 1;
    }

    .products .hover
    {
        position: absolute;
        top: 0;
        left: 7.5px;
        right: 7.5px;
        height: 100%;
        /* background: rgba(255, 255, 255, .75); */
        transition: .25s;
        opacity: 0;
        border: 1px solid #707070;
        border-radius: 10px;
        display: none;
    }

    .products .hover a
    {
        height: auto;
        display: inline-block;
        background: #009498;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        width: 80%;
        font-size: 10pt;
        transition: .25s;
        border: none;
    }

    .products .hover a:hover
    {
        background: #ff0000;
        box-shadow: none;
    }

    .products .hover a:first-child
    {
        margin-bottom: 7.5px;
    }

    .filter-top.justify-content-end
    {
        margin-top: 15px;
    }

    .pagination
    {
        margin-bottom: 0;
        height: 42px;
    }

    .pagination .page-item:last-child
    {
        margin-right: 0
    }

    .pagination .page-item .page-link
    {
        height: 42px;
        line-height: calc(42px - 1rem);
    }

    @media (max-width: 767px)
    {
        .products-list
        {
            padding-top: 0;
            padding-bottom: 30px;
        }

        .products-list h1
        {
            font-size: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .products-list .filter-top:first-child
        {
            display: none !important;
        }

        .products-list .filter-top:last-child
        {
            margin-bottom: 0
        }

        .products .hover
        {
            display: none;
        }
    }

</style>

<script>

    $(function()
    {
        $(".filter-button").click(function()
        {
            $(".filter-item").toggle(1000);
        });

        $('.pagination a').click(function(e)
        {
            e.preventDefault();

            $('[name="sayfa"]').val($(this).attr('href'));

            $('[name="search"]').trigger('submit');
        });

        $('select').val($('[name="sira"]').val());

        $('select').change(function(e)
        {
            e.preventDefault();

            $('[name="sira"]').val($(this).val());

            $('[name="search"]').trigger('submit');
        });

        $('[name="search"] button').click(function()
        {
            $('[name="search"]').find('input').each(function()
            {
                if ($(this).val() == undefined || $.trim($(this).val()) == '')

                    $(this).attr('disabled', true);
            });
        });

        $('.filter-button').click(function(e)
        {
            e.preventDefault();
        });

        setTimeout(function()
        {

            $('.products .hover').each(function()
            {
                var height = $(this).find('a').outerHeight() * $(this).find('a').length + 15;
                    padding = ($(this).height() / 2) - (height / 2);

                $(this).css('padding-top', padding);
            });

        }, 250);

        $('.add-basket').click(function(e)
        {
            e.preventDefault();

            var form_data = new FormData();
                _this = $(this);

            form_data.append('id', $(this).attr('href'));
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');
            form_data.append('yap', 'ekle');
            
            $.ajax(
            {
                url: '/sepet',
                type: 'post',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function()
                {
                    _this.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                    _this.attr('disabled', 'disabled');
                },
                success: function(resp)
                {
                    $('.sepet-adet').html(resp);
                    
                    var isim = _this.closest('.col-xl-3').find('h5').text();

                    $('#sepet-sonuc .modal-body span').text(isim);
                    
                    $('#sepet-sonuc').modal('show');

                    setTimeout(function()
                    {
                        _this.html('Sepete Ekle').removeAttr('disabled');

                    }, 1000);
                }
            });
        });

        setTimeout(function()
        {
            $('.products-list .list .list-item').each(function()
            {
                if ($(this).find('a').eq(0).height() != $(this).find('.product-container').outerHeight())
                {
                    var height = $(this).find('a').eq(0).height() - $(this).find('.product-container').outerHeight();

                    $(this).find('h5').css('margin-bottom', height);
                }
            });

        }, 250);
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>