<?php $__env->startSection('title', 'Adresler'); ?>

<?php $__env->startSection('process'); ?>

<form class="row forms m-0" id="adres-form" action="/hesap/adres">
    <div class="col-xl-8 col-lg-12 m-auto">
        <div class="row">
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
                <div class="form-line-no-line">
                    <button class="ml-0">Kaydet</button>
                    <button style="display: none">Sil</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra'); ?>

<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<style>

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

    .forms button:last-child
    {
        margin-left: 15px;
    }

    @media (max-width: 767px)
    {
        .forms .pr-half,
        .forms .pl-half
        {
            padding-left: 15px;
            padding-right: 15px;
        }

        .forms button
        {
            display: block;
            width: 100%;
        }

        .forms button:last-child
        {
            margin-left: 0;
            margin-top: 5px;
        }
    }

</style>

<script>

    $(function()
    {
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

                form.find('button').eq(1).fadeOut(250);

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

                form.find('button').eq(1).fadeIn(250);
            
            }, 'json');
        });

        $('.forms').find('[required]').closest('.form-line').find('label').each(function()
        {
            $(this).html($(this).html() +' *');
        });

        $('#adres-form button').click(function()
        {
            $(this).attr('click', 1);
        });

        $('#adres-form').submit(function(e) 
        {
            e.preventDefault();

            var _this = $(this);
                button_value = _this.find('[click="1"]').html();
                form_data = new FormData(this);

            form_data.append('yap', button_value);
            form_data.append('_token', '<?php echo e(csrf_token()); ?>');

            $.ajax(
            {
                type: 'post',
                url: _this.attr('action'),
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function() 
                {
                    _this.find('[click="1"]').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                    
                    _this.find('*').attr('disabled', 'disabled');
                },
                success: function(cevap) 
                {                    
                    uyari(cevap.status, cevap.message);

                    if (cevap.status.indexOf('fa-check') != -1)
                    {
                        setTimeout(function()
                        {
                            location.href = cevap.go;
                        
                        }, 1500);
                    }
                },
                complete: function() 
                {                    
                    _this.find('[click="1"]').html(button_value);
                    
                    _this.find('*').removeAttr('disabled').removeAttr('click');
                }
            });
        });

        <?php if(Request::has('no')): ?>

        $('[name="id"]').val('<?php echo e(Request::get("no")); ?>').trigger('change');

        <?php endif; ?>
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('hesap.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>