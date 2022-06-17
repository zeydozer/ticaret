<?php $__env->startSection('title', 'Şifre İşlemi'); ?>

<?php $__env->startSection('process'); ?>

<div class="row forms m-0">
    <div class="col-lg-6 m-auto">
        <form id="sifre-form" action="/hesap/sifre">
            <div class="form-line">
                <input type="password" name="eski" placeholder="Mevcut Şifre" required>
            </div>
            <div class="form-line">
                <input type="password" name="sifre" placeholder="Yeni Şifre" required>
            </div>
            <div class="form-line">
                <input type="password" name="tekrar" placeholder="Şifre Tekrar" equired>
            </div>
            <div class="form-line-no-line">
                <button class="ml-0">Kaydet</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra'); ?>

<style>

    @media (max-width: 767px)
    {
        .forms button
        {
            width: 100%;
        }
    }

</style>

<script>

    $(function()
    {
        $('#sifre-form').submit(function(e) 
        {
            e.preventDefault();

            var _this = $(this);
                button_value = _this.find('button').html();
                form_data = new FormData(this);

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
                    _this.find('button').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
                    
                    _this.find('*').attr('disabled', 'disabled');
                },
                success: function(cevap) 
                {                    
                    uyari(cevap.status, cevap.message);

                    if (cevap.status.indexOf('fa-check') != -1)
                    
                        _this[0].reset();
                },
                complete: function() 
                {                    
                    _this.find('button').html(button_value);
                    
                    _this.find('*').removeAttr('disabled');
                }
            });
        });
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('hesap.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>