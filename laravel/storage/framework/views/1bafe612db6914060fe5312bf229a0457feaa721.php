<?php $__env->startSection('title', 'Ödeme'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mb-md-0 mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/sepet">Sepetim</a></li>
            <li class="breadcrumb-item"><a href="/teslimat">Teslimat</a></li>
            <li class="breadcrumb-item"><a href="/odeme">Ödeme</a></li>
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
                <span class="tab-text">2 TESLİMAT</span>
            </div>
            <div class="col-4">
                <span class="icon"><img src="/assets/images/basket_icon_03.svg" alt=""></span>
                <span class="tab-text active">3 ÖDEME</span>
            </div>
        </div>

        <?php if($kontrol > 0): ?>
        <div class="row forms">

            <div class="col-xl-6 col-lg-8 m-auto">
                <div class="row registered-card mb-md-5 mb-3 mt-0 align-items-center">
                    <h2>Sipariş Özeti</h2>
                    <div class="col-md-4 pr-half text-md-right">
                        <b>Fatura Adresi:</b>
                    </div>
                    <div class="col-md-8 pl-half">
                        <?php echo e(Session::get('fatura')); ?>

                    </div>
                    <div class="col-xl-12 mt-3"></div>
                    <div class="col-md-4 pr-half text-md-right">
                        <b>Teslimat Adresi:</b>
                    </div>
                    <div class="col-md-8 pl-half">
                        <?php echo e(Session::has('teslimat') ? Session::get('teslimat') : 'Fatura adresi ile aynı'); ?>

                    </div>
                    <div class="col-xl-12 mt-3"></div>
                    <div class="col-md-4 pr-half text-md-right">
                        <b>Ara Toplam:</b>
                    </div>
                    <div class="col-md-8 price pl-half">
                        <?php echo e(number_format($toplam, 2, ',', '.')); ?> TL
                    </div>
                    <div class="col-md-4 pr-half text-md-right mt-md-0 mt-1">
                        <b>Kargo:</b>
                    </div>
                    <div class="col-md-8 price pl-half">
                        <?php echo e(number_format($kargo, 2, ',', '.')); ?> TL
                    </div>
                    <div class="col-md-4 pr-half text-md-right mt-md-0 mt-1">
                        <b>Toplam:</b>
                    </div>
                    <div class="col-md-8 price pl-half">
                        <?php echo e(number_format($toplam + $kargo, 2, ',', '.')); ?> TL
                    </div>
                </div>

                <?php if(in_array(1, $odeme)): ?>
                <form class="row" action="/odeme" method="post">
                    <h2>Ödeme Şekli</h2>
                    <div class="col-lg-12 col-md-8 m-auto">
                        <div class="form-line-no-line row text-center">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                <input type="radio" name="odeme" id="tab-pill-1" value="kart" 
                                <?php if ($odeme['kart'] == 0) { ?> disabled <?php } ?>>
                                <label for="tab-pill-1" style="<?php if($odeme['kart'] == 0): ?> cursor: no-drop <?php endif; ?>">
                                    Kart
                                </label>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                <input type="radio" name="odeme" id="tab-pill-2" value="havale"
                                <?php if ($odeme['havale'] == 0) { ?> disabled <?php } ?>>
                                <label for="tab-pill-2" style="<?php if($odeme['havale'] == 0): ?> cursor: no-drop <?php endif; ?>">
                                    Havale / EFT
                                </label>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                <input type="radio" name="odeme" id="tab-pill-3" value="kapi"
                                <?php if ($odeme['kapi'] == 0) { ?> disabled <?php } ?>>
                                <label for="tab-pill-3" style="<?php if($odeme['kapi'] == 0): ?> cursor: no-drop <?php endif; ?>">
                                    Kapıda Ödeme
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="tab-1" class="tab col-xl-12">
                        <div class="row">
                            <div class="col-xl-12 card-wrapper mb-4"></div>
                            <div class="col-md-6 pr-half">
                                <div class="form-line">
                                    <label for="">Kartın Üzerindeki İsim</label>
                                    <input type="text" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6 pl-half">
                                <div class="form-line">
                                    <label for="">Kart No</label>
                                    <input type="text" name="number" required>
                                </div>
                            </div>
                            <div class="col-md-3 pr-half">
                                <div class="form-line">
                                    <label for="">Ay</label>
                                    <input type="text" name="expiry_month" placeholder="**" required maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-3 pr-half">
                                <div class="form-line">
                                    <label for="">Yıl</label>
                                    <input type="text" name="expiry_year" placeholder="****" required maxlength="4">
                                </div>
                                <p style="font-size: 14px; color: #009498; margin-top: -10px;">Örn. 2020</p>
                            </div>
                            <div class="col-md-6 pl-half">
                                <div class="form-line">
                                    <label for="">CCV</label>
                                    <input type="text" name="ccv" required>
                                </div>
                            </div>
                        </div>
                        <?php if($pos_info['banka'] == 'iyzico'): ?>
                        <div class="row text-center">
                            <div class="col-12 taksit">
                                
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div id="tab-2" class="tab col-lg-12 col-md-9 m-auto">
                        <?php $__currentLoopData = $bankalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $id = $banka->id; $banka = json_decode($banka->data); ?>
                        <div class="row align-items-center mb-3" style="font-size: 10pt">
                            <div class="col-md-1 col-6">
                                <input type="radio" name="havale" id="banka-<?php echo e($id); ?>" value="<?php echo e($id); ?>">
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="banka-<?php echo e($id); ?>" class="mb-0 mb-md-2">
                                    <img src="/img/<?php echo e($banka->foto); ?>" class="w-100">
                                </label>
                            </div>
                            <div class="col-md-7 mt-md-0 mt-2">
                                <label for="banka-<?php echo e($id); ?>">
                                    <h6><?php echo e($banka->isim); ?></h6>
                                    <b>Şube:</b> <?php echo e($banka->sube); ?> <br>
                                    <b>Kod:</b> <?php echo e($banka->kod); ?> <br><br>
                                    <?php echo e($banka->iban); ?>

                                </label>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div id="tab-3" class="tab col-lg-12 col-md-8 m-auto">
                        Kapıda Ödeme: <span class="price price mb-md-0 mb-2"><?php echo e(number_format($kapi, 2, ',', '.')); ?> TL</span>
                        <br class="d-none d-md-block">
                        Ödenecek Toplam Tutar: <span class="price"><?php echo e(number_format($toplam + $kargo + $kapi, 2, ',', '.')); ?> TL</span>
                    </div>
                    <div class="col-xl-12 button">
                        <div class="form-line-no-line text-center">
                            <button class="m-auto">TAMAMLA</button>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>

        </div>
        <?php else: ?>
        <h3 class="mb-5">Maalesef sepetiniz boş..</h3>
        <?php endif; ?>

    </section>
    <section class="row sub-features">
        <div class="col-6 col-md-3">
            <div class="features-item">
                <img src="/assets/images/icb1.svg" alt="">
                <h4>ÜCRETSİZ KARGO</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="features-item">
                <img src="/assets/images/icb2.svg" alt="">
                <h4>KOLAY İADE İMKANI</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="features-item">
                <img src="/assets/images/icb3.svg" alt="">
                <h4>TELEFON İLE SİPARİŞ</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="features-item">
                <img src="/assets/images/icb4.svg" alt="">
                <h4>GÜVENLİ ALIŞVERİŞ</h4>
            </div>
        </div>
    </section>
</div>

<?php

if ($pos_info['banka'] != 'iyzico') :
                      
    $clientId = $pos_info['numara'];

    $amount = str_replace(',', '', number_format($toplam + $kargo, 2));

    $okUrl = $failUrl = url('kart');

    $oid = $rnd = md5(rand() . rand());

    $taksit = '';

    $islemtipi = 'Auth';

    $storekey = $pos_info['3d_sifre'];
    $storetype = $pos_info['3d_tip'];

    $hashstr = $clientId . $oid . $amount . $okUrl . $failUrl . $rnd  . $storekey;

    $hash = base64_encode(pack('H*', sha1($hashstr)));

?>

<form id="ajax-3d" class="d-none" action="https://<?php echo e($bank_url[$pos_info['banka']]); ?>/fim/est3Dgate" method="post">
    <input type="hidden" name="pan">
    <input type="hidden" name="cv2">
    <input type="hidden" name="Ecom_Payment_Card_ExpDate_Month">
    <input type="hidden" name="Ecom_Payment_Card_ExpDate_Year">
    <input type="hidden" name="clientid" value="<?php echo e($clientId); ?>">
    <input type="hidden" name="amount" value="<?php echo e($amount); ?>">
    <input type="hidden" name="oid" value="<?php echo e($oid); ?>">
    <input type="hidden" name="okUrl" value="<?php echo e($okUrl); ?>">
    <input type="hidden" name="failUrl" value="<?php echo e($failUrl); ?>">
    <input type="hidden" name="rnd" value="<?php echo e($rnd); ?>">
    <input type="hidden" name="hash" value="<?php echo e($hash); ?>">
    <input type="hidden" name="storetype" value="<?php echo e($storetype); ?>">
    <input type="hidden" name="lang" value="tr">
    <input type="hidden" name="currency" value="949">
</form>

<?php endif ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom'); ?>

<style>
    
    .taksit label
    {
        margin-left: .5rem;
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

    .forms label
    {
        cursor: pointer;
    }

    .price
    {
        font-size: 22px;
        font-weight: 900;
        color: #009498;
    }

    .forms .tab
    {
        display: none;
    }

    #tab-3
    {
        margin-bottom: 1rem !important
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

        .button .form-line-no-line
        {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        [action="/odeme"] .form-line-no-line
        {
            padding-top: 0;
        }

        [action="/odeme"] h2
        {
            margin-bottom: 10px;
        }

        #tab-1
        {
            padding-left: 0;
            padding-right: 0;
        }

        #tab-3
        {
            font-size: 12px;havale / eeft
        }

        #tab-3 .price 
        {
            display: block;
        }
    }

    @media (max-width: 344px)
    {
        .card-wrapper, 
        .jp-card-container, 
        .jp-card
        {
            min-width: auto !important;
        }
    }

</style>

<script src="/js/jquery.card.js"></script>
<link rel="stylesheet" href="/css/card.css">

<script>

    $(function()
    {
        var options =
        {
            container: '.card-wrapper',
            placeholders: 
            {
                number: '•••• •••• •••• ••••',
                name: 'Ad Soyad',
                expiry: '••/••••',
                cvc: '•••'
            },
            formSelectors: 
            {
                numberInput: '[name="number"]',
                expiryInput: '[name="expiry_month"],[name="expiry_year"]',
                cvcInput: '[name="ccv"]',
                nameInput: '[name="name"]',
            }
        };

        if ($(document).width() < 345)

            options.width = 290;

        $(this).card(options);

        $("[name='odeme']").change(function()
        {
            $('.tab').slideUp(250).find('input').removeAttr('required');

            $('#'+ $(this).attr('id').replace('pill-', '')).slideDown(250).find('input').attr('required', true);
        });

        <?php if ($odeme['kart'] == 1) : ?>

        $('[value="kart"]').attr('checked', true).trigger('change');

        <?php elseif ($odeme['havale'] == 1) : ?>

        $('[value="havale"]').attr('checked', true).trigger('change');

        <?php elseif ($odeme['kapi'] == 1) : ?>

        $('[value="kapi"]').attr('checked', true).trigger('change');

        <?php endif ?>

        $('form.row').submit(function(e) 
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
                    if ($('[name="odeme"]:checked').val() == 'kart')
                    {
                        <?php if ($pos_info['banka'] != 'iyzico') : ?>

                        var expiry_month = _this.find('[name="expiry_month"]').val().split(' / ');
                        var expiry_year = _this.find('[name="expiry_year"]').val().split(' / ');

                        $('[name="pan"]').val($('[name="number"]').val());
                        $('[name="cv2"]').val($('[name="ccv"]').val());

                        $('[name="Ecom_Payment_Card_ExpDate_Month"]').val(expiry_month);
                        $('[name="Ecom_Payment_Card_ExpDate_Year"]').val(expiry_year);

                        setTimeout(function()
                        {
                        	$('#ajax-3d').submit();

                        }, 1000);

                        <?php else : ?>

                        if (cevap.sonuc != undefined)

                            location.href = cevap.html;

                        else uyari(cevap.title, cevap.mess);

                        <?php endif ?>
                    }

                    else if (cevap.sonuc == undefined)

                        uyari(cevap.title, cevap.mess);

                    else location.href = cevap.sonuc;

                    if (cevap.go != undefined) 
                    {
                        setTimeout(function()
                        {
                            location.href = cevap.go;

                        }, 2000);
                    }
                },
                complete: function() 
                {                    
                    _this.find('button').html(button_value);
                    
                    $('form *').removeAttr('disabled');
                },
                error: function()
                {
                    uyari('<i class="fas fa-bomb"></i> Hata', 'Bilinmeyen hata. Tekrar deneyin..');

                    _this.find('button').html(button_value);
                    
                    $('form *').removeAttr('disabled');
                }
            });
        });

        <?php if ($pos_info['banka'] == 'iyzico') : ?>

        $('[name="number"]').keyup(function()
        {
            var value = $(this).val().replace(' ', '');

                price = Number('<?php echo e($toplam + $kargo); ?>');

            if (value.length == 6)
            {
                $.get('/taksit', {number: value.substr(0, 6), price: price}, function(resp)
                {
                    if (resp != false)
                    {
                        $('.taksit').html(null);

                        var html, hesap;

                        for (var i = 0; i < resp.length; i++)
                        {
                            if (i != 0)

                                hesap = resp[i].installmentNumber +' x '+ resp[i].installmentPrice +'₺ = '+ resp[i].totalPrice +'₺';

                            else hesap = 'Tek Çekim '+ resp[i].totalPrice +'₺';

                            html = '<div class="custom-control custom-radio pl-0">';

                            html += '<input type="radio" name="taksit" id="taksit-'+ i +'" value="'+ resp[i].installmentNumber +'">';

                            html += '<input type="hidden" name="taksitli['+ resp[i].installmentNumber +']" value="'+ resp[i].totalPrice +'">';

                            html += '<label for="taksit-'+ i +'">'+ resp[i].installmentNumber +' Taksit ('+ hesap +')</label></div>';

                            $('.taksit').append(html);
                        }
                    }
                });
            }

            else if (value.length < 6)

                $('.taksit').html(null);
        });

        <?php endif ?>  
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>