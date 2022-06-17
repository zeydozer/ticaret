@if ($konu == 'aktivasyon')

Değerli {{ $uye->isim }}; <br>
Üyeliğin için aktivasyon işlemi başarı ile gerçekleşmiştir. <br>
Girmiş olduğunun üye bilgilerini dilediğin zaman güncelleyebilirsin.

@elseif ($konu == 'unuttum')

Değerli {{ $uye->isim }}, aşağıdaki bağlantıya giderek şifreni yenileyebilirsin. <br><br>
<a href="{{ url('token?token='. $uye->token) }}">{{ url('token?token='. $uye->token) }}</a>

@elseif ($konu == 'sifirla')

Değerli {{ $uye->isim }} şifren başarıyla değiştirildi, yeni şifren: <b>{{ $sifre }}</b>

@elseif ($konu == 'iletisim')

<span style="color: red">Ad & Soyad: </span> {{ $mesaj->isim }} <br><br>
<span style="color: red">E-Posta: </span> {{ $mesaj->mail }} <br><br>
<span style="color: red">Telefon: </span> {{ $mesaj->tel }} <br><br>
<span style="color: red">Şirket: </span> {{ $mesaj->sirket ? $mesaj->sirket : '-' }} <br><br>

{{ $mesaj->mesaj }}

@elseif ($konu == 'siparis')

Sayın {{ $siparis->isim }}, {{ $siparis->id }} numaralı siparişiniz başarıyla alındı. <br>

@if (Cookie::has('uye'))
Gelişmeleri <a href="{{ url('hesap/siparis') }}">hesap sayfanızdan</a> takip edebilirsiniz. <br>
@endif

<br><b>Teşekkür Ederiz</b>

@endif