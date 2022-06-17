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
        Değerli {{ $uye->isim }}; <br>
        Üyeliğiniz için aktivasyon işlemi başarı ile gerçekleşmiştir. <br>
        Noone ürünlerini hemen keşfetmeye başlayabilirsiniz.
        <a href="{{ url('/') }}" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #330138;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">{{ str_replace(['http://', 'https://'], ['', ''], url('/')) }}</a>
    </td>
</tr>

@endsection
