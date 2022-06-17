<?php $__env->startSection('title', 'Teslimat'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mb-md-0 mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/sepet">Sepetim</a></li>
            <li class="breadcrumb-item"><a href="/teslimat">Teslimat</a></li>
        </ol>
    </nav>
</div>

<div class="container">
    <section class="basket">

        <div class="row basket-tabs">
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_01.svg" alt=""></span>
                <span class="tab-text">1 SEPETİM</span>
            </div>
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_02.svg" alt=""></span>
                <span class="tab-text active">2 TESLİMAT</span>
            </div>
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_03.svg" alt=""></span>
                <span class="tab-text">3 ÖDEME</span>
            </div>
        </div>

        <?php if($kontrol > 0): ?>
        <form class="row forms mb-0"  id="fatura-form">
            <div class="col-xl-6 col-lg-8 m-auto">
                <div class="row">
                    <h2>Fatura Adresi</h2>
                    <?php if(Cookie::has('uye')): ?>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Adres Seçin</label>
                            <select name="id">
                                <option value="">+ Yeni</option>
                                <?php $__currentLoopData = $adresler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($adres->id); ?>"><?php echo e($adres->tanim); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Adres Tanımı</label>
                            <input type="text" name="tanim" required>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-xl-12">
                        <div class="form-line">
                            <label for="">E-Posta</label>
                            <input type="email" name="mail" required>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Ad & Soyad</label>
                            <input type="text" name="isim" required>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Telefon</label>
                            <input type="text" name="tel" required>
                        </div>
                    </div>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">İl</label>
                            <select name="il" class="select2" required>
                                <option value="" selected disabled>- Seçin</option>
                                <?php $__currentLoopData = DB::table('il')->orderBy('isim')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $il): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($il->id); ?>"><?php echo e($il->isim); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">İlçe</label>
                            <select name="ilce" class="select2" required>
                                <option value="">- Seçin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Vergi Dairesi</label>
                            <input type="text" name="vergi_d" placeholder="- Kurumsal için zorunlu">
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Vergi No</label>
                            <input type="text" name="vergi_n" placeholder="- Şahıs için kimlik no">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-line">
                            <label for="">Adres</label>
                            <textarea name="adres" required rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-line-no-line">
                            <input type="checkbox" name="teslimat" id="teslimat">
                            <label for="teslimat">Teslimat Adresim Farklı</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="row forms mb-0" id="teslimat-form">
            <div class="col-xl-6 col-lg-8 m-auto">
                <div class="row">
                    <h2>Teslimat Adresi</h2>
                    <?php if(Cookie::has('uye')): ?>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Adres Seçin</label>
                            <select name="id">
                                <option value="">+ Yeni</option>
                                <?php $__currentLoopData = $adresler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($adres->id); ?>"><?php echo e($adres->tanim); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Adres Tanımı</label>
                            <input type="text" name="tanim" required>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-xl-12">
                        <div class="form-line">
                            <label for="">E-Posta</label>
                            <input type="email" name="mail" required>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Ad & Soyad</label>
                            <input type="text" name="isim" required>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Telefon</label>
                            <input type="text" name="tel" required>
                        </div>
                    </div>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">İl</label>
                            <select name="il" class="select2" required>
                                <option value="" selected disabled>- Seçin</option>
                                <?php $__currentLoopData = DB::table('il')->orderBy('isim')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $il): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($il->id); ?>"><?php echo e($il->isim); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">İlçe</label>
                            <select name="ilce" class="select2" required>
                                <option value="">- Seçin</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pr-half">
                        <div class="form-line">
                            <label for="">Vergi Dairesi</label>
                            <input type="text" name="vergi_d" placeholder="- Kurumsal için zorunlu">
                        </div>
                    </div>
                    <div class="col-md-6 pl-half">
                        <div class="form-line">
                            <label for="">Vergi No</label>
                            <input type="text" name="vergi_n" placeholder="- Şahıs için kimlik no">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-line">
                            <label for="">Adres</label>
                            <textarea name="adres" required rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row buttons forms mt-0">
            <div class="col-xl-6 col-lg-8 m-auto">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-line-no-line">
                            <a href="/sepet" class="ml-0">SEPETE DÖN</a>
                        </div>
                    </div>
                    <div class="col-md-6 devam">
                        <div class="form-line-no-line text-right">
                            <a href="/odeme">DEVAM ET</a>
                        </div>
                    </div>
                </div>
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

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<style>

    .forms a
    {
        display: inline-block;
        line-height: 50px;
        color: #ffffff;
        border: none;
        font-weight: 700;
        font-size: 16px;
        padding: 0 40px;
        background: #009498;
        letter-spacing: 2px;
        margin-left: 20px;
        cursor: pointer;
        transition: unset;
    }

    .forms a:hover
    {
        background: #046E71;
        transition: all 0.2s ease-in-out;
    }

    .forms .form-line
    {
        margin-bottom: 15px;
    }

    .forms .pr-half
    {
        padding-right: 7.5px;
    }

    .forms .pl-half
    {
        padding-left: 7.5px;
    }

    .select2-selection.select2-selection--single:focus,
    .select2-container--default .select2-selection--single:focus
    {
        outline: none;
    }

    .select2-container--default .select2-selection--single
    {
        border: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .select2-results,
    .select2-container--default .select2-search--dropdown .select2-search__field
    {
        padding: 0;
        width: 100%;
        border: none;
        font-size: 14px;
        outline: none;
        color: #009498;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field
    {
        border: solid 1px #707070;
        padding: 5px;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field,
    .select2-results
    {
        font-size: 12px
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

        .forms
        {
            margin: 0;
        }

        .forms h2
        {
            font-size: 25px;
        }

        .forms .pr-half,
        .forms .pl-half
        {
            padding-left: 15px;
            padding-right: 15px;
        }

        .sub-features
        {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .sub-features .col-6:nth-child(1),
        .sub-features .col-6:nth-child(2)
        {
            margin-bottom: 15px;
        }

        .buttons .form-line-no-line 
        {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .buttons .form-line-no-line a 
        {
            width: 100%;
            text-align: center;
            margin-left: 0;
        }
    }

</style>

<script>

    $(function()
    {
        $('#teslimat-form').hide();

        $('#teslimat').change(function()
        {
            if ($(this).is(':checked'))
            {
                $('#teslimat-form').slideDown(250);
                
                $('#teslimat-form').find('[name="il"], [name="ilce"]').select2();
            }

            else $('#teslimat-form').slideUp(250);
        });

        $('.select2').select2();

        $('[name="il"]').change(function()
        {
            var form = $(this).closest('.forms');            

            if (!$(this).val())
            {
                form.find('[name="ilce"]').html('<option selected value="">- Seçin</option>').trigger('change');

                return false;
            }

            $.get('/adres', {il_id: $(this).val()}, function(ilceler)
            {
                var options = '<option selected value="">- Seçin</option>';
                    options = options + ilceler;

                form.find('[name="ilce"]').html(options).select2();         
            });
        });

        $('[name="id"]').change(function()
        {
            var form = $(this).closest('.forms');

            if (!$(this).val())
            {
                form.find('select, input, textarea').val(null);

                form.find('[name="il"], [name="ilce"]').trigger('change');

                return false;
            }

            $.get('/adres', {adres_id: $(this).val()}, function(data)
            {
                $.each(data, function(name, value)
                {
                    form.find('[name="'+ name +'"]').val(value);

                    if (name == 'il')

                        form.find('[name="'+ name +'"]').trigger('change');

                    if (name == 'ilce')
                    {
                        setTimeout(function()
                        {
                            form.find('[name="'+ name +'"]').val(value).trigger('change');
                        
                        }, 500);
                    }
                });
            
            }, 'json');
        });

        $('.forms').find('[required]').closest('.form-line').find('label').each(function()
        {
            $(this).html($(this).html() +' *');
        });

        $('.devam a').click(function(e)
        {
            e.preventDefault(); 
            
            var kontrol = true, html = $(this).html();
            
            $(this).html('<i class="fas fa-spinner fa-pulse"></i>');

            $('#fatura-form').find('[required]').each(function()
            {
                if (!$(this).val() || $(this).val() == '')
                {
                    uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Zorunlu alanları boş bıraktınız.');

                    kontrol = false;
                }
            });

            if ($('#teslimat').is(':checked'))
            {
                $('#teslimat-form').find('[required]').each(function()
                {
                    if (!$(this).val() || $(this).val() == '')
                    {
                        uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Zorunlu alanları boş bıraktınız.');

                        kontrol = false;
                    }
                });
            }

            if (!kontrol) { $(this).html(html); return false; }

            var datas = {}, _this = $(this);
            
            $('#fatura-form').serializeArray().map(function(x) { datas[x.name] = x.value; }); 

            if ($('#teslimat').is(':checked'))
            {
                $('#teslimat-form').find('input, select, textarea').each(function()
                {
                    $(this).attr('name', 'teslimat-'+ $(this).attr('name'));
                
                }).serializeArray().map(function(x) { datas[x.name] = x.value; });
            }

            datas['_token'] = '<?php echo e(csrf_token()); ?>';

            $.post('/adres', datas, function()
            {
                location.href = _this.attr('href');                

            }).fail(function() 
            { 
                uyari('<i class="fas fa-exclamation"></i> Uyarı', 'Hata oluştu!');

                $('#teslimat-form').find('input, select, textarea').each(function()
                {
                    $(this).attr('name', $(this).attr('name').replace('teslimat-', ''));
                });

                _this.html(html);
            });
        });
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>