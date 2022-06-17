@extends('mailing.index')

@section('content')

<tr>
    <td colspan="4" style="
        padding: 30px;
        text-align: center;
        font-size: 10pt;
        ">
        <h1 style="
            margin: 0 0 15px 0;
            ">Sipariş Takibi</h1>

        <?php

        $img =
        [
            'Onay Bekliyor' => 'basarili',
            'Onaylandı' => 'basarili',
            'Kargoya Verildi' => 'kargo',
            'Tamamlandı' => 'tamam',
            'İptal Edildi' => 'iptal',
        ];

        ?>

        <img src="{{ url('/') }}/img/mail/{{ $img[$siparis->durum] }}.png" style="
            display: block;
            margin: 0 auto;
            margin-bottom: 15px;
        ">
        Sayın {{ $siparis->isim }}; <br>
        {{ $siparis->id }} numaralı siparişinizin durumu: <b>{{ $siparis->durum }}</b> <br>
        @if ($siparis->kargo_no && $siparis->durum == 'Kargoya Verildi')
        <b>Kargo No:</b> {{ $siparis->kargo_no }} <br>
        @endif
        @if (is_numeric($siparis->uye_id))
        Gelişmeleri hesap sayfanızdan takip edebilirsiniz. <br>
        <a href="{{ url('hesap/siparis') }}" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #330138;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Sipariş Takip</a>
        @endif
    </td>
</tr>

@endsection
