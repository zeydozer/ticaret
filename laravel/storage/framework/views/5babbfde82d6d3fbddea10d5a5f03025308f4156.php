<?php $__env->startSection('title', 'Giriş & Kayıt'); ?>

<?php $__env->startSection('content'); ?>

<?php if(Cookie::has('uye')): ?> 

<script>location.href = '/hesap/uyelik';</script> 

<?php endif; ?>

<?php $path = explode('/', Request::path())[0]; ?>

<div class="container">

    <?php if($path != 'token'): ?>

    <div class="row user-login forms">

        <div class="col-md-6 text-center">
            <h2>Üye Girişi</h2>
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
                <div class="col-lg-6">
                    <div class="form-line-no-line">
                        <button class="ml-0">GİRİŞ</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-line-no-line text-right">
                        <a href="/redirect" class="fb-login">
                            <i class="fab fa-facebook"></i>
                            İLE GİRİŞ
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-center">
            <h2>Üye Ol</h2>
            <form class="row" action="/kayit">
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Ad & Soyad</label>
                        <input type="text" name="isim" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>E-Posta</label>
                        <input type="email" name="mail" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Cep Telefonu</label>
                        <input type="text" name="tel" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Şifre</label>
                        <input type="password" name="sifre" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Şifre Tekrar</label>
                        <input type="password" name="tekrar" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <p class="mb-0">
                        Sisteme kaydolarak 
                        <a href="/kullanim-kosullari" target="_blank">Kullanım Koşulları</a>'nı ve 
                        <br class="d-lg-block d-none">
                        <a href="/uyelik-sozlesmesi" target="_blank">Üyelik Sözleşmesi</a>'ni 
                        kabul etmiş olursunuz.
                    </p>
                </div>
                <div class="col-xl-12">
                    <div class="form-line-no-line text-center">
                        <button class="m-auto">ÜYE OL</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php else: ?>

    <div class="row user-login forms">

        <div class="col-md-6 offset-md-3 text-center">
            <h2>Şifremi <?php echo e($token ? 'Sıfırla' : 'Unuttum'); ?></h2>
            <form class="row" action="/token">
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>E-Posta</label>
                        <input type="email" name="mail" required>
                    </div>
                </div>
                <?php if($token): ?>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Şifre</label>
                        <input type="password" name="sifre" required>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-line">
                        <label>Şifre Tekrar</label>
                        <input type="password" name="tekrar" required>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                <?php endif; ?>
                <div class="col-xl-12">
                    <div class="form-line-no-line text-center">
                        <button class="m-auto"><?php echo e($token ? 'SIFIRLA' : 'GÖNDER'); ?></button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>

    .fb-login
    {
        display: inline-block;
        line-height: 50px;
        color: #ffffff;
        border: none;
        font-weight: 700;
        font-size: 16px;
        padding: 0 40px;
        background: #4267b2;
        letter-spacing: 2px;
        margin-top: 30px;
    }

    .fb-login:hover
    {
        background: #046E71;
        color: #fff;
    }

    @media (max-width: 991px)
    {
        [action="/giris"] .col-lg-6 div
        {
            text-align: center !important;
        }

        .fb-login
        {
            margin-top: 15px;
        }
    }

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

        <?php if(($path == 'giris' && isset($status)) || strpos($path, 'callback') !== false): ?>

        uyari('<?php echo $status ?>', '<?php echo $message ?>');

        <?php if(isset($go)): ?> setTimeout(function() { location.href = '<?php echo e($go); ?>'; }, 4000); <?php endif; ?>

        <?php endif; ?>
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>