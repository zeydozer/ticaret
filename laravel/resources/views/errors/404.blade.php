<!DOCTYPE html>
<html lang="tr">

<?php $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true) ?>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sayfa Bulunamadı | {{ $seo['author'] }}</title>

    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">

    <link href="//fonts.googleapis.com/css?family=Baloo+2:400,500,600,700" rel="stylesheet">

</head>

<body>
    <div class="container">

        <section class="row payment_successful">

            <div class="col-xl-12 status text-center mb-0">
                <span class="logo"><img src="/img/logo.png" alt="{{ $seo['author'] }}"></span>
                <span class="result">Sayfa Bulunamadı</span>
                <span class="result-text">Aradığınız sayfa silinmiş veya hiç olmamış olabilir.</span>
            </div>

        </section>

    </div>
</body>

<style>

    @media (max-width: 767px)
    {
        .payment_successful .status img
        {
            height: auto;
            width: 100%;
        }

        .payment_successful .status .result
        {
            line-height: 1;
            margin: 30px 0;
        }
    }

</style>

</html>