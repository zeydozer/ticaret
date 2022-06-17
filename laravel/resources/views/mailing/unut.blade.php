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
            ">Şifremi Unuttum</h1>
        Değerli {{ $uye->isim }}, aşağıdaki bağlantıya giderek şifrenizi yenileyebilirsiniz.
        <a href="{{ url('token?token='. $uye->token) }}" style="
            display: block;
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background: #046E71;
            width: 150px;
            margin: 0 auto;
            margin-top: 15px;
            font-weight: bold;
            ">Şifre Sıfırla</a>
    </td>
</tr>

@endsection