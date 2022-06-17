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
            ">Tebrikler</h1>
        <img src="{{ url('/') }}/img/mail/basarili.png" style="
            display: block;
            margin: 0 auto;
            margin-bottom: 15px;
        ">>
        Sayın {{ $siparis->isim }}, {{ $siparis->id }} numaralı siparişiniz başarıyla alındı. <br>
        @if (Cookie::has('uye'))
        Gelişmeleri hesap sayfanızdan takip edebilirsiniz. <br>
        @endif
        Teşekkür ederiz.
        @if (Cookie::has('uye'))
        <a href="{{ url('hesap/siparis') }}" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #046E71;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Sipariş Takip</a>
        @endif
    </td>
</tr>

@endsection