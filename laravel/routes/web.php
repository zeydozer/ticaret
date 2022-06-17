<?php

Route::any('/', 'SiteC@anasayfa');

Route::any('giris', 'UyeC@giris');
Route::any('kayit', 'UyeC@kayit');
Route::get('cikis', 'UyeC@cikis');
Route::any('token', 'UyeC@token');
Route::any('adres', 'UyeC@adres');

Route::any('bize-ulasin', 'SiteC@iletisim');

Route::get('urunler/{url?}', 'UrunC@arama');
Route::get('urun/fiyat', 'UrunC@fiyat');
Route::get('urun/{url}', 'UrunC@detay');
Route::post('urun/{url}', 'UrunC@yorum');
Route::any('sepet', 'UrunC@sepet');
Route::any('teslimat', 'UrunC@teslimat');
Route::any('odeme', 'UrunC@odeme');
Route::post('kart', 'UrunC@kart');
Route::get('sonuc/{durum}', 'UrunC@sonuc');
Route::any('takip/{info?}', 'UrunC@takip');

$routes = 
[
    'hakkimizda',
	'kullanim-kosullari',
	'gizlilik-politikasi',
    'garanti-politikasi',
    'iptal-iade-degisim',
    'satis-sozlesmesi',
    'uyelik-sozlesmesi',
    'on-bilgilendirme-formu',
    'teslimat-kargo',
    'kvkk-beyani',
];

Route::get('{sayfa}', function() { return view('bilgi'); })
     ->where('sayfa', '('. implode('|', $routes) .')');

Route::group(['prefix' => 'hesap'], function()
{
    Route::get('siparis/{id?}', 'HesapC@siparis');
    Route::any('uyelik', 'HesapC@uyelik');
    Route::any('adres', 'HesapC@adres');
    Route::any('sifre', 'HesapC@sifre');
});

Route::group(['prefix' => 'admin'], function()
{
    Route::get('/', function() { return view('admin.ana'); });

    Route::any('giris', 'Admin\HesapC@giris');
    Route::get('cikis', 'Admin\HesapC@cikis');
    Route::any('unuttum', 'Admin\HesapC@unuttum');
    Route::any('sifirla/{token?}', 'Admin\HesapC@sifirla');

    Route::any('kategori/{id?}', 'Admin\UrunC@kategori');
    
    Route::group(['prefix' => 'ayar'], function()
    {
        Route::any('seo', 'Admin\SiteC@seo');
        Route::any('slide/{id?}', 'Admin\SiteC@slide');
        Route::any('iletisim', 'Admin\SiteC@iletisim');
        Route::any('odeme', 'Admin\SiteC@odeme');
        Route::any('pos', 'Admin\SiteC@pos');
        Route::any('banka/{id?}', 'Admin\SiteC@banka');
        Route::any('kargo', 'Admin\SiteC@kargo');
    });

    Route::any('uye/{id}', 'Admin\UyeC@detay');
    Route::get('uye', 'Admin\UyeC@liste');

    Route::group(['prefix' => 'urun'], function()
    {
        Route::any('hizli/{id}', 'Admin\UrunC@hizli');
        Route::any('foto/{id}', 'Admin\UrunC@foto');
        Route::any('fiyat', 'Admin\UrunC@fiyat');
        Route::any('{id}', 'Admin\UrunC@detay');
        Route::get('/', 'Admin\UrunC@liste');
    });

    Route::any('siparis/{id}', 'Admin\UrunC@detay_s');
    Route::get('siparis', 'Admin\UrunC@siparis');

    Route::any('yorum', 'Admin\UyeC@yorum');
});

Route::get('sira/{tip}', 'Controller@sira');

Route::any('redirect', 'UyeC@redirect');
Route::any('callback', 'UyeC@callback');

Route::any('taksit', 'Controller@taksit');

Route::any('sitemap.xml', 'Controller@sitemap');
Route::any('fb-feed.xml', 'Controller@fb_feed');

Route::any('test', 'Controller@test');