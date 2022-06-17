@if ($konu == 'unuttum')

Sayın {{ $isim }}, aşağıdaki bağlantıya giderek şifrenizi yenileyebilirsiniz. <br><br> 
<a href="{{ url('admin/sifirla') .'/'. $token }}">{{ url('admin/sifirla/') .'/'. $token }}</a>

@elseif ($konu == 'sifirla')

Sayın {{ $isim }}, şifreniz başarıyla değiştirildi. <br><br> 
Yeni Şifreniz: <b>{{ $sifre }}</b>

@elseif ($konu == 'siparis')

Sayın {{ $siparis->isim }}, <br><br>

{{ $siparis->id }} numaralı siparişinizin durumu: <b>{{ $siparis->durum }}</b> <br>

@if (is_numeric($siparis->uye_id))
Gelişmeleri <a href="{{ url('hesap/siparis') }}">hesap sayfanızdan</a> takip edebilirsiniz. <br>
@endif

@endif