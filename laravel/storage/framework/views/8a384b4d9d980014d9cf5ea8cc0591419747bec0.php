<?php $__env->startSection('title', 'Sepet'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mb-md-0 mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/sepet">Sepetim</a></li>
        </ol>
    </nav>
</div>

<div class="container">
    <section class="basket">
        <div class="row basket-tabs">
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_01.svg" alt=""></span>
                <span class="tab-text active">1 SEPETİM</span>
            </div>
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_02.svg" alt=""></span>
                <span class="tab-text">2 TESLİMAT</span>
            </div>
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_03.svg" alt=""></span>
                <span class="tab-text">3 ÖDEME</span>
            </div>
        </div>
        <?php if(count($sepettekiler) > 0): ?>
        <div class="basket-table">
            <div class="basket-tt">
                <div class="row title-line">
                    <div class="col-xl-6 col-lg-6 col-md-6 table-inner-line">
                        <span>Ürünler</span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-6 table-inner-line">
                        <span>Adet</span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-6 table-inner-line">
                        <span>Fiyat</span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 table-inner-line">
                        <span>Toplam</span>
                    </div>
                </div>

                <?php $toplam = 0; $adet = 0; ?>

                <?php $__currentLoopData = $sepettekiler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $sepet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php 
                    
                $urun = \App\Urun::find($sepet->urun_id);

                $profil = \App\Foto::where('profil', 1)
                                   ->where('urun_id', $urun->id)
                                   ->first();
                
                $profil = $profil ? $profil->deger : 'logo.png';

                $fiyat = $urun->indirim ? $urun->indirim : $urun->fiyat;

                $adet += $sepet->adet;

                $toplam += $fiyat * $sepet->adet;
                
                ?>

                <div class="row table-line <?php if(!$urun->stok): ?> bg-light <?php endif; ?>"
                <?php if (!$urun->stok) : ?> data-toggle="tooltip" data-placement="top" 
                title="Ürün stokta yok.." <?php endif ?>>
                    <div class="col-xl-6 col-lg-6 col-md-12 table-inner-line sepet-isim">
                        <span class="mobile-title mb-3">ÜRÜN ADI</span>
                        <a href="/urun/<?php echo e($urun->url); ?>">
                            <i class="fa fa-trash" data="<?php echo e($sepet->id); ?>"></i>
                            <img src="/img/<?php echo e($profil); ?>" alt="<?php echo e($urun->isim); ?>"
                            <?php if($profil == 'logo.png'): ?> style="opacity: .5" <?php endif; ?>>
                            <?php if($urun->paket): ?>
                            <b><?php echo e(\App\Urun::find($urun->set_id)->isim); ?> - </b>
                            <?php endif; ?>
                            <span><?php echo e($urun->isim); ?></span>
                        </a>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6 table-inner-line 
                    table-select-amount" data="<?php echo e($sepet->id); ?>">
                        <span class="mobile-title">ÜRÜN ADEDİ</span>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" 
                            data-type="minus" data-field="adet[<?php echo e($i); ?>]" sepet="--">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="adet[<?php echo e($i); ?>]" class="form-control input-number" 
                        value="<?php echo e($sepet->adet); ?>" min="1" max="<?php echo e($urun->stok ? $urun->stok : $sepet->adet); ?>">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default btn-number" 
                            data-type="plus" data-field="adet[<?php echo e($i); ?>]" sepet="++">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-6 table-inner-line">
                        <span class="mobile-title">FİYAT</span>
                        <span class="price"><?php echo e(number_format($fiyat, 2, ',', '.')); ?> TL</span>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 table-inner-line">
                        <span class="mobile-title">TOPLAM</span>
                        <span class="price total"><?php echo e(number_format($fiyat * $sepet->adet, 2, ',', '.')); ?> TL</span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php 
                    
                    $hasDiscount = false;

                    $indirim = json_decode(DB::table('ayar')->where('tip', 'indirim')->first()->data, true);
                    
                    if ($indirim['a'] > 0 && Cookie::has('uye'))
                    {
                        $uye_id = Cookie::get('uye')->id;

                        $user = \App\Uye::find($uye_id);
                        
                        if ($user)
                        {
                            if ($user->hasdiscount)
                            {
                                if ($toplam > $indirim['a'])
                                {
                                    $indirimsiz = $toplam;
                                    
                                    $indirimli = $toplam - $indirim['b'];
                                    
                                    $hasDiscount = true;
                                }
                            }
                        }
                    }

                ?>
                
                <div class="row table-line total-row">
                    <div class="col-xl-6 col-lg-6 col-md-12 table-inner-line text-right">
                        <span class="mobile-title mb-lg-3">TOPLAM</span>
                        <img src="/img/logo.png" class="invisible">
                        <a href="#" onclick="return false"><b>TOPLAM</b></a>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-12 table-inner-line table-select-amount">
                        <span class="mobile-title">ADET</span>
                        <input type="text" name="adet" class="form-control input-number" value="<?php echo e($adet); ?>" readonly>
                    </div>


                    <div class="col-xl-4 col-lg-4 col-md-8 table-inner-line prices" style="<?php if($hasDiscount): ?>
                    font-weight: 200; text-align: center; color: red; <?php endif; ?>">
                    	<?php if($hasDiscount): ?>
	                    <p style="margin-bottom: -2px;margin-block-start: 0;">İlk alışverişinize özel</p>
	                    <span style="font-weight: 800;"> <?php echo e($indirim['b']); ?> TL indirim kazandınız! </span>
	                    <span class="old" style="font-weight: 800; margin-top: 10px;"><?php echo e(number_format($indirimsiz, 2, ',', '.')); ?> TL</span>
	                    <span class="price total" style="line-height: 20px;"><?php echo e(number_format($indirimli, 2, ',', '.')); ?> TL</span>
                    	<?php else: ?>
                    	<span class="price total"><?php echo e(number_format($toplam, 2, ',', '.')); ?> TL</span>
                    	<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="basket-buttons d-md-flex justify-content-between">
                <a href="/urunler" class="ml-0">ALIŞVERİŞE DEVAM ET</a>
                <a href="/teslimat" class="devam">DEVAM ET</a>
            </div>
        </div>
        <?php else: ?>
        <h3 class="mb-5">Maalesef sepetiniz boş..</h3>
        <?php endif; ?>
    </section>
    <section class="row sub-features">
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb1.svg" alt="">
                <h4>ÜCRETSİZ KARGO</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb2.svg" alt="">
                <h4>KOLAY İADE İMKANI</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb3.svg" alt="">
                <h4>TELEFON İLE SİPARİŞ</h4>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="features-item">
                <img src="/assets/images/icb4.svg" alt="">
                <h4>GÜVENLİ ALIŞVERİŞ</h4>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>
    .basket .basket-table img
    {
        object-fit: contain;
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

    .input-number:focus
    {
        outline: unset;
        box-shadow: unset;
    }

    .basket .basket-table a i
    {
        margin-right: 20px;
        font-size: 16pt;
        border: 3px solid #009498;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        line-height: 35px;
        text-align: center;
    }

    #kontrol .modal-dialog
    {
        margin: 0 auto;
        top: 50%;
        transform: translateY(-50%);
    }

    #kontrol .modal-header
    {
        background: transparent;
        border: none;
        position: absolute;
        width: 100%;
        top: 0;
        z-index: 1;
    }

    #kontrol .modal-header .close
    {
        color: #009498;
    }

    #kontrol .modal-body
    {
        text-align: center;
    }

    #kontrol .modal-body a
    {
        display: block;
        width: 70%;
        text-align: center;
        margin: 0 auto;
        background: #009498;
        color: #fff;
        font-weight: 600;
        font-size: 16pt;
        padding: 10px 0;
    }

    #kontrol .modal-body img
    {
        margin-bottom: 15px;
    }

    #kontrol .modal-body a:last-child
    {
        margin-top: 15px;
    }

    @media (max-width: 991px)
    {
        .basket .basket-table a
        {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .basket .basket-table a i,
        .basket .basket-table a span
        {
            position: relative;
            top: 20px;
        }

        .basket .basket-table .total-row a,
        .basket .basket-table .total-row img
        {
            display: none;
        }
    }

    @media (max-width: 767px)
    {
        .basket .basket-tabs
        {
            margin-bottom: 1rem;
        }

        .basket .basket-tabs .tab-text
        {
            font-size: 12px;
        }

        .basket .basket-table a i 
        {
            float: right;
            margin-right: 0;
        }

        .basket .basket-table .table-line .table-inner-line a img 
        {
            float: left;
            margin-right: 0;
        }

        .basket .basket-table a span 
        {
            display: block;
            top: 0;
            margin-top: 90px;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .basket .basket-table .basket-tt .table-line .table-inner-line .price.total
        {
            line-height: 40px;
        }

        .basket .basket-table .basket-buttons a
        {
            width: 100%;
            text-align: center;
            margin-left: 0;
        }

        .sub-features .col-6:nth-child(1),
        .sub-features .col-6:nth-child(2)
        {
            margin-bottom: 15px;
        }
    }

</style>

<script>

    $(function()
    {
        $('.btn-number').click(function (e)
        {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            input = $("input[name='" + fieldName + "']");
            currentVal = parseInt(input.val());
            
            if (!isNaN(currentVal))
            {
                if (type == 'minus')
                {
                    if (currentVal > input.attr('min'))
                    
                        input.val(currentVal - 1);
                    
                    if (parseInt(input.val()) == input.attr('min'))
                    
                        $(this).attr('disabled', true);
                }
                
                else if (type == 'plus')
                {
                    if (currentVal < input.attr('max'))
                    
                        input.val(currentVal + 1);
                    
                    if (parseInt(input.val()) == input.attr('max'))
                    
                        $(this).attr('disabled', true);
                }
            }
            
            else input.val(1);

            input.trigger('keyup');
        });

        $('.input-number').focusin(function ()
        {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').keyup(function ()
        {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');

            if (valueCurrent >= minValue)
            
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            
            else
            {
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Üzgünüz, minimum değere ulaşıldı.');
                
                $(this).val(minValue);
            }

            if (valueCurrent <= maxValue)
            
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            
            else
            {
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Üzgünüz, maximum değere ulaşıldı.');

                $(this).val(maxValue);
            }

            var _this = $(this),

                datas = 
                {
                    yap: '++', 
                    id: $(this).closest('div').attr('data'),
                    _token: '<?php echo e(csrf_token()); ?>',
                    adet: parseInt($(this).val()),
                };

            $.post('/sepet', datas, function(resp)
            {
                $('.sepet-adet').html(resp.adet);
                    
                _this.closest('.row').find('.total').html(resp.toplam +' TL');
                
                $('.total-row input').val(resp.adet);

                <?php if (isset($hasDiscount)) : if ($hasDiscount) : ?> 

            	$('.total-row .old').html(resp.fiyat +' TL');	

            	resp.fiyat = resp.fiyat.replace('.', '').replace(',', '.');

            	resp.fiyat = parseFloat(resp.fiyat) - parseFloat('<?php echo e($indirim["b"]); ?>');

            	resp.fiyat = resp.fiyat.toFixed(2).replace('.', ',');

            	<?php endif; endif ?>

            	$('.total-row .total').html(resp.fiyat +' TL');

            }, 'json');
        });

        $(".input-number").keydown(function (e)
        {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39))
            
                return;
            
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105))
            
                e.preventDefault();
        });

        $('.basket .basket-table a i').click(function(e)
        {
            e.preventDefault();

            var kontrol = $(this).closest('.sepet-isim').find('b').length, text;

            if (kontrol != 0)
            
                text = $(this).closest('.sepet-isim').find('b').text().replace(' - ', '') +' paketindeki tüm ürünler';

            else text = 'Ürün';

            $('#sepet-sil .modal-body span').text(text);

            $('#sepet-sil').attr('data', $(this).attr('data')).modal('show');
        });

        $('#sepet-sil').submit(function(e)
        {
            e.preventDefault();

            var datas = 
            {
                yap: 'sil', 
                id: $(this).attr('data'),
                _token: '<?php echo e(csrf_token()); ?>',
            };

            $.post('/sepet', datas, function(resp)
            {
                $('#sepet-sil').modal('hide');

                if (resp == 1) location.reload();

                else uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Hata oluştu..');
            });
        });

        $('[data-toggle="tooltip"]').tooltip();

        <?php if(!Cookie::has('uye')): ?>

        $('.devam').click(function(e)
        {
            e.preventDefault();

            $('#kontrol').modal('show');
        });

        <?php endif; ?>
    });

</script>

<form class="modal fade" id="sepet-sil" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uyarı</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span></span> sepetinizden silinecek. Onaylıyor musunuz?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Evet</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Hayır</button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="kontrol" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="/img/logo.png" class="w-75">
                <a href="/giris">Üye Ol veya Giriş Yap</a>
                <a href="/teslimat">Üye Olmadan Devam Et</a>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>