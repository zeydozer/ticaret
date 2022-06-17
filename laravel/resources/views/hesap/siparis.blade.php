@extends('hesap.index')

@section('title', 'Sipariş Detay | No: '. $siparis->id)

@section('process')

<div class="row purchased-product">
    <div class="col-md-7 purchased-name text-left">
        <div class="bilgi"><span class="order-status">İsim:</span> {{ $siparis->isim }}</div>
        <div class="bilgi"><span class="order-status">E-Posta:</span> {{ $siparis->mail }}</div>
        <div class="bilgi"><span class="order-status">Telefon:</span> {{ $siparis->tel }}</div>
        <div class="bilgi"><span class="order-status">Fatura Adresi:</span> {{ $siparis->fatura }}</div>
        <div class="bilgi"><span class="order-status">Teslimat Adresi:</span> {{ $siparis->teslimat }}</div>
    </div>
    <div class="col-lg-4 offset-lg-1 col-md-5">
        <span class="order-status">Durum: {{ $siparis->durum }}</span>

        <?php 

        $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

        $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

        ?>

        <span class="price d-lg-block d-none">{{ number_format($tutar - $siparis->indirim, 2, ',', '.') }} TL</span>
        <div class="bilgi"><span class="order-status">No:</span> {{ $siparis->id }}</div>
        <div class="bilgi"><span class="order-status">Tarih:</span> {{ date('d.m.Y', strtotime($siparis->tarih)) }}</div>
        <div class="bilgi">
            <span class="order-status">Ödeme:</span>
            {{ $siparis->odeme }}
            @if ($siparis->odeme != 'Kart')
            @if ($siparis->odeme != 'Kapıda Ödeme')
                - <?php echo $siparis->sekil ?>
            @else
                - {{ floatval($siparis->sekil) }}₺
            @endif
            @endif
        </div>
    </div>
    <div class="col-12 table-responsive">
        <small class="d-block d-md-none mt-4">* Tabloyu sağa doğru kaydırın.</small>
        <table class="table mt-4 mb-0">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Fiyat</th>
                <th>Adet</th>
                <th>Toplam</th>
            </tr>

            <?php $toplam = 0 ?>

            @foreach ($urunler as $i => $urun)

            <?php $toplam += $urun->fiyat * $urun->adet ?>

            <tr>
                <td width="100"><img src="{{ asset('img/'. $urun->foto) }}"></td>
                <td>{{ $urun->isim }}</td>
                <td>{{ number_format($urun->fiyat, 2, ',', '.') }} TL</td>
                <td>{{ $urun->adet }}</td>
                <td>{{ number_format($urun->fiyat * $urun->adet, 2, ',', '.') }} TL</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="2"></th>
                <th colspan="2">Ara Toplam</th>
                <th>{{ number_format($toplam, 2, ',', '.') }} TL</th>
            </tr>
            @if ($siparis->indirim > 0)
            <tr>
                <th colspan="2"></th>
                <th colspan="2">İndirim</th>
                <th>{{ number_format($siparis->indirim, 2, ',', '.') }} TL</th>
            </tr>
            @endif
            
            <?php $toplam += $siparis->kargo ?>

            <tr>
                <th colspan="2"></th>
                <th colspan="2">Kargo</th>
                <th>{{ number_format($siparis->kargo, 2, ',', '.') }} TL</th>
            </tr>
            @if ($siparis->odeme == 'Kapıda Ödeme')

            <?php $toplam += $siparis->sekil ?>

            <tr>
                <th colspan="2"></th>
                <th colspan="2">Kapıda Ödeme</th>
                <th>{{ number_format($siparis->sekil, 2, ',', '.') }} TL</th>
            </tr>
            @endif

            <tr>
                <th colspan="2"></th>
                <th colspan="2">Toplam</th>
                <th>{{ number_format($toplam - $siparis->indirim, 2, ',', '.') }} TL</th>
            </tr>
        </table>
    </div>
</div>

@endsection

@section('extra')

<style>

    .bilgi
    {
        font-size: 13px;
    }

    .bilgi:not(:first-child)
    {
        margin-top: .25rem;
    }

    .purchased-product table th 
    {
        padding-left: 0;
        padding-right: .5rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    .purchased-product table td
    {
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
        font-size: 13px;
        padding-bottom: 0;
        max-width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-right: .5rem;
        padding-top: .25rem;
        padding-bottom: .25rem;
    }

    .purchased-product table td img
    {
        width: 100px;
        height: 75px;
        object-fit: contain;
    }

    @media (max-width: 1199px)
    {
        .purchased-product table td img
        {
            width: 75px;
            height: 75px;
        }

        .purchased-product table td
        {
            max-width: 280px;
        }
    }

    @media (max-width: 767px)
    {
        .purchased-product table td img
        {
            width: 50px;
            height: 50px;
        }

        .purchased-product table td
        {
            max-width: 200px;
        }

        .user-panel
        {
            padding: 30px 0;
        }

        .purchased-product
        {
            padding-top: 0;
            padding-bottom: 0;
        }

        .purchased-product a
        {
            color: #009498;
            font-weight: 700;
            font-size: 18px;
            margin-top: 15px;
        }
    }

</style>

@if (Session::has('conversion'))
<script>

    gtag('event', 'conversion', 
    {
        'send_to': 'AW-402712385/V1JXCOWl5fwBEMHOg8AB',
        'value': Number('{{ $toplam - $siparis->indirim }}'),
        'currency': 'TRY',
        'transaction_id': '{{ $siparis->id }}'
    });

</script>

<?php Session::forget('conversion') ?>

@endif

@endsection