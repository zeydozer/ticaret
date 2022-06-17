@extends('hesap.index')

@section('title', 'Üyelik Bilgileri')

@section('process')

<div class="row forms m-0">
    <div class="col-lg-6 m-auto">
        <form id="uyelik" action="/hesap/uyelik">
            <div class="form-line">
                <input type="text" name="isim" placeholder="Ad & Soyad" value="{{ $uye->isim }}" required>
            </div>
            <div class="form-line">
                <input type="email" name="mail" placeholder="E-Posta" value="{{ $uye->mail }}" required>
            </div>
            <div class="form-line">
                <input type="text" name="tel" placeholder="Telefon" value="{{ $uye->tel }}" required>
            </div>
            <div class="form-line-no-line">
                <button class="ml-0">Kaydet</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('extra')

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
        $('#uyelik').submit(function(e) 
        {
            e.preventDefault();

            var _this = $(this);
                button_value = _this.find('button').html();
                form_data = new FormData(this);

            form_data.append('_token', '{{ csrf_token() }}');

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

@endsection