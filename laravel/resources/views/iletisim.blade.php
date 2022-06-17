@extends('index')

@section('title', 'Bize Ulaşın')

@section('content')

<div class="container">

<section class="row user-panel">

    <div class="col-12 contact-us">
        <h2 class="center-headline">Bize Ulaşın</h2>
        <p class="w-50 m-auto">Ürünlerimiz hakkında bilgi almak, fikirlerinizi paylaşmak ve önerilerde bulunmak için bize ulaşabilirsiniz</p>

        <div class="row contact-content">
            <div class="col-xl-3 col-md-6 line">
                <img src="assets/images/marker_b@2x.png" alt="">
                <p><?php echo nl2br($iletisim->adres) ?></p>
            </div>
            <div class="col-xl-3 col-md-6 line">
                <img src="assets/images/phone_b@2x.png" alt="">
                <p class="phone">{{ $iletisim->tel }}</p>
            </div>
            <div class="col-xl-3 col-md-6 line">
                <img src="assets/images/mail_b@2x.png" alt="">
                <p class="big-text"><a href="mailto:{{ $iletisim->mail }}">{{ $iletisim->mail }}</a></p>
            </div>
            <div class="col-xl-3 col-md-6 social">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{ $iletisim->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $iletisim->instagram }}"><i class="fab fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $iletisim->twitter }}"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $iletisim->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
                <p class="big-text">{{ str_replace(['http://', 'https://'], '', url('/')) }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 map">
              <!--  <iframe src="https://yandex.com.tr/map-widget/v1/-/CCUAmJv9sC" width="100%" height="460" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe> -->
            </div>
            <div class="col-xl-6 col-lg-6 contact-form text-left">
                <h3>İletişim Formu</h3>
                <form id="iletisim" action="/bize-ulasin">
                    <div class="contact-form-line">
                        <input type="text" name="isim" placeholder="Ad & Soyad *" required>
                    </div>
                    <div class="contact-form-line">
                        <input type="email" name="mail" placeholder="E-Posta *" required>
                    </div>
                    <div class="contact-form-line">
                        <input type="text" name="tel" placeholder="Telefon *" required>
                    </div>
                    <div class="contact-form-line">
                        <input type="text" name="sirket" placeholder="Şirket">
                    </div>
                    <div class="contact-form-line">
                        <textarea name="mesaj" placeholder="Mesajınız *" required></textarea>
                    </div>
                    <div class="contact-form-line text-right">
                        <button>Gönder</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>

<section class="row sub-features">
    <div class="col-md-3 col-6">
        <div class="features-item">
            <img src="assets/images/icb1.svg" alt="">
            <h4>ÜCRETSİZ KARGO</h4>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="features-item">
            <img src="assets/images/icb2.svg" alt="">
            <h4>KOLAY İADE İMKANI</h4>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="features-item">
            <img src="assets/images/icb3.svg" alt="">
            <h4>TELEFON İLE SİPARİŞ</h4>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="features-item">
            <img src="assets/images/icb4.svg" alt="">
            <h4>GÜVENLİ ALIŞVERİŞ</h4>
        </div>
    </div>
</section>

</div>

@endsection

@section('custom')

<style>

    @media (max-width: 1199px)
    {
        .contact-content .line:first-child p
        {
            width: 50%;
            margin: auto;
            margin-bottom: 1rem;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(-n+2)
        {
            border-bottom: solid 1px #707070;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(3),
        .user-panel .contact-us .contact-content .col-md-6:nth-child(4)
        {
            padding-top: 20px;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(2),
        .user-panel .contact-us .contact-content .col-md-6:nth-child(4)
        {
            border-right: none;
        }
    }

    @media (max-width: 991px)
    {
        .user-panel
        {
            padding: 30px 0;
        }

        .sub-features
        {
            margin-bottom: 30px;
        }

        .contact-us p.w-50
        {
            width: 75% !important;
        }

        .user-panel .contact-us .contact-content
        {
            margin: 30px 0;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(1),
        .user-panel .contact-us .contact-content .col-md-6:nth-child(3)
        {
            border-right: solid 1px #707070 !important;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(3)
        {
            border-bottom: none;
        }

        .contact-form
        {
            margin-top: 30px;
        }

        .contact-form-line:nth-child(1),
        .contact-form-line:nth-child(2),
        .contact-form-line:nth-child(3),
        .contact-form-line:nth-child(4)
        {
            width: 49%;
            display: inline-block;
        }

        .contact-form-line:nth-child(2),
        .contact-form-line:nth-child(4)
        {
            margin-left: calc(1% - 2px);
        }
    }

    @media (max-width: 767px)
    {
        .user-panel .contact-us .contact-content .col-md-6 p
        {
            margin-bottom: 0;
            line-height: 1;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(1),
        .user-panel .contact-us .contact-content .col-md-6:nth-child(3)
        {
            border-right: none !important;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(3)
        {
            border-bottom: solid 1px #707070;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(2),
        .user-panel .contact-us .contact-content .col-md-6:nth-child(3)
        {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(1)
        {
            padding-top: 0;
            padding-bottom: 15px;
        }

        .user-panel .contact-us .contact-content .col-md-6:nth-child(4)
        {
            padding-top: 15px;
            padding-bottom: 0;
        }

        .contact-content .line:first-child p
        {
            width: 75%;
        }

        .contact-us p.w-50
        {
            width: 100% !important;
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
        $('#iletisim').submit(function(e)
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

@endsection
