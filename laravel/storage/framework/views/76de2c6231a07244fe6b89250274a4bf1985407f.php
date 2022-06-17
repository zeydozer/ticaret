<?php $__env->startSection('title', 'Sipariş Takibi'); ?>

<?php $__env->startSection('content'); ?>

<?php if(Cookie::has('uye')): ?> 

<script>location.href = '/hesap/siparis';</script> 

<?php endif; ?>

<div class="container">

    <div class="row user-login forms">

        <div class="col-md-6 text-center">
            <h2>Üye İseniz</h2>
            <form class="row" action="/giris">
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>E-Posta</label>
                        <input type="email" name="mail" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Şifre</label>
                        <input type="password" name="sifre" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <p class="mb-0"><a href="/token">Şifremi Unuttum</a></p>
                </div>
                <div class="col-xl-12">
                    <div class="form-line-no-line text-center">
                        <button class="m-auto">GİRİŞ</button>
                    </div>
                </div>
                <input type="hidden" name="takip" value="1">
            </form>
        </div>
        <div class="col-md-6 text-center">
            <h2>Üye Değilseniz</h2>
            <form class="row" action="/takip">
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>E-Posta</label>
                        <input type="email" name="mail" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Sipariş No</label>
                        <input type="text" name="no" required>
                    </div>
                </div>
                <div class="col-xl-12 invisible d-none d-md-block">
                    <p class="mb-0"><a href="/token">Şifremi Unuttum</a></p>
                </div>
                <div class="col-xl-12">
                    <div class="form-line-no-line text-center">
                        <button class="m-auto">SORGULA</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    @media (max-width: 767px)
    {
        .forms
        {
            margin: 30px 0;
        }

        [action="/giris"]
        {
            margin-bottom: 30px;
        }
    }

</style>

<script>

    $(function()
    {
        $('form').submit(function(e) 
        {
            e.preventDefault();

            var _this = $(this);
                button_value = _this.find('button').html();
                form_data = new FormData(this);

            form_data.append('_token', $('[name=csrf-token]').attr('value'));

            $.ajax(
            {
                type: 'post',
                url: _this.attr('action'),
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function() 
                {
                    _this.find('button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                    
                    $('form *').attr('disabled', 'disabled');
                },
                success: function(cevap) 
                {                    
                    uyari(cevap.status, cevap.message);
                },
                complete: function() 
                {                    
                    _this.find('button').html(button_value);
                    
                    $('form *').removeAttr('disabled');
                }
            });
        });
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>