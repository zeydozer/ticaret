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
            ">Şifremi Sıfırla</h1>
        Değerli {{ $uye->isim }}, şifreniz başarıyla değiştirildi. <br>
        Yeni Şifreniz:
        <span style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #330138;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">{{ $sifre }}</span>
    </td>
</tr>

@endsection
