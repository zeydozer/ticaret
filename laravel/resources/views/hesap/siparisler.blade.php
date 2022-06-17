@extends('hesap.index')

@section('title', 'Siparişlerim')

@section('process')

@if (count($siparisler) > 0)
@foreach ($siparisler as $i => $siparis)
<div class="row purchased-product {{ $i > 0 ? 'mt-md-3 mt-4' : '' }}">
    <div class="col-md-8 purchased-name text-left">
        <div class="bilgi"><span class="order-status">İsim:</span> {{ $siparis->isim }}</div>
        <div class="bilgi"><span class="order-status">E-Posta:</span> {{ $siparis->mail }}</div>
        <div class="bilgi"><span class="order-status">Telefon:</span> {{ $siparis->tel }}</div>
        <div class="bilgi"><span class="order-status">Fatura Adresi:</span> {{ $siparis->fatura }}</div>
        <div class="bilgi"><span class="order-status">Teslimat Adresi:</span> {{ $siparis->teslimat }}</div>
        <a href="/hesap/siparis/{{ $siparis->id }}" class="d-none d-md-block"><i class="fa fa-eye"></i> Detaylar</a>
    </div>
    <div class="col-md-4">
        <span class="order-status">Durum: {{ $siparis->durum }}</span>

        <?php 

        $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

        $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

        ?>

        <span class="price">{{ number_format($tutar - $siparis->indirim, 2, ',', '.') }} TL</span>
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
        <a href="/hesap/siparis/{{ $siparis->id }}" class="d-block d-md-none"><i class="fa fa-eye"></i> Detaylar</a>
    </div>
</div>
@endforeach
@else
<div class="row">
    <div class="col-12">Sipariş bulunamadı.</div>
</div>
@endif

@endsection

@section('extra')

<style>

    .bilgi
    {
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .bilgi:not(:first-child)
    {
        margin-top: .25rem;
    }

    .purchased-name a
    {
        color: #2e2e2e;
        position: absolute;
        bottom: 0;
    }

    @media (max-width: 767px)
    {
        .user-panel
        {
            padding: 30px 0;
        }

        .purchased-product
        {
            padding-top: 0;
            padding-bottom: 0;
        }

        .purchased-product .col-md-4
        {
            padding-bottom: 1.5rem;
            border-bottom: solid 1px #707070;
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

@endsection