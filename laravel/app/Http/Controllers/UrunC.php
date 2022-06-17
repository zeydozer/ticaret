<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urun;
use App\Sepet;
use App\Kategori;
use App\Foto;
use App\Adres;
use App\Siparis;
use App\Detay;

use Cookie;
use Session;
use DB;

class UrunC extends Controller
{
    public function arama(Request $r, $url = null)
    {
        $sayfa = $r->has('sayfa') ? str_replace('/', '', $r->get('sayfa')) : 1;
        
        if (!is_numeric($sayfa)) $sayfa = 1; $goster = $data['goster'] = 20;
        
        $limit = $data['limit'] = ($sayfa * ($goster + 1)) - ($sayfa + $goster);

        $sira = $r->has('sira') ? explode(' ', $r->get('sira')) : ['stok', 'desc'];

        $data['sayfa'] = $sayfa; $data['sira'] = implode(' ', $sira);

        $case_w = 

        '(CASE
            WHEN indirim > 0 
            THEN 100 - (indirim / fiyat * 100)
            ELSE 0
        END) AS oran,
        
        (CASE
            WHEN indirim > 0 THEN indirim
            ELSE fiyat
        END) AS fiyat_s';

        $data['urunler'] = Urun::selectRaw('urun.*, '. $case_w)
                                ->where('sil', 0)
                                ->orderBy($sira[0], $sira[1])
                                ->leftJoin('kategori', 'kategori.id', '=', 'urun.kat_id')
                                ->where('urun.set_id', null);

        if ($url)
        {
            $kategori = Kategori::where('url', $url)->first();

            if (!$kategori) return redirect('urunler');

            $bagli = Controller::kat_getir($kategori->id);

            if (count($bagli) > 0) $ids = array_keys($bagli);

            $ids[] = $kategori->id;

            $where = ['kat_id IN ('. implode(', ', $ids) .')'];

            foreach ($ids as $id)

                $where[] = 'kat_id_diger REGEXP "[[:<:]]'. $id .'[[:>:]]"';

            $data['urunler'] = $data['urunler']->whereRaw('('. implode(' OR ', $where) .')');

            $data['title'] = $kategori->isim;

            $kok = $kategori;

            while (1)
            {
                $data['breadcrumb']['/urunler/'. $kok->url] = $kok->isim;

                if (!$kok->bagli_id) break;

                else $kok = Kategori::find($kok->bagli_id);
            }

            $data['breadcrumb'] = array_reverse($data['breadcrumb']);

            $data['ustler'] = Kategori::where('bagli_id', $kategori->bagli_id)->orderBy('sira')->get();
        }

        else 
        {
            $ozellik = $r->has('ozellik') ? $r->get('ozellik') : [];

            if (count($ozellik) == 1 && $ozellik[0] == 'indir')

                $data['title'] = 'İndirimdekiler';

            else if (count($ozellik) == 1 && $ozellik[0] == 'yeni')

                $data['title'] = 'Yeni Gelenler';

            else if (count($ozellik) == 1 && $ozellik[0] == 'vitrin')

                $data['title'] = 'Öne Çıkanlar';

            else $data['title'] = 'Bütün Ürünler';
        }

        $bagli_id = $url ? $kategori->id : null;

        $data['kategoriler'] = Kategori::where('bagli_id', $bagli_id)->orderBy('sira')->get();

        $data['markalar'] = 
        [
            Urun::selectRaw('count(distinct marka) as adet')->where('sil', 0)->where('marka', '!=', null),
            Urun::selectRaw('distinct marka as isim')->where('sil', 0)->where('marka', '!=', null)->orderBy('marka'),
        ];

        if ($url)
        {
            $data['markalar'][1] = $data['markalar'][1]->where('kat_id', $kategori->id);            

            $data['markalar'][0] = $data['markalar'][0]->where('kat_id', $kategori->id);            
        }

        $data['markalar'][0] = $data['markalar'][0]->first()->adet;        

        $data['markalar'][1] = $data['markalar'][1]->get();        

        $where = [];

        if ($r->has('ara'))
        {
            $temp =
            [
                'urun.isim like "%'. $r->get('ara') .'%"',
                'urun.isim like "%'. mb_strtoupper($r->get('ara')) .'%"',
                'aciklama like "%'. $r->get('ara') .'%"',
                'ozellik like "%'. $r->get('ara') .'%"',
                'kategori.isim like "%'. $r->get('ara') .'%"',
                'kategori.isim like "%'. mb_strtoupper($r->get('ara')) .'%"',
            ];

            $where[] = '('. implode(' OR ', $temp) .')';
        }

        if ($r->has('marka'))
        {
            $temp = [];

            foreach ($r->get('marka') as $marka) 

                $temp[] = 'marka LIKE "%'. $marka .'%"';

            $where[] = '('. implode(' OR ', $temp) .')';
        }

        if ($r->has('fiyat'))
        {
            $temp = []; 

            $fiyat_s = '(CASE WHEN indirim > 0 THEN indirim ELSE fiyat END)';

            foreach ($r->get('fiyat') as $fiyat) 
            {
                $fiyat = array_filter(explode('-', $fiyat), 'is_numeric');

                if (isset($fiyat[1]))

                    $temp[] = '('. $fiyat_s .' >= '. $fiyat[0] .' AND '. $fiyat_s .' <= '. $fiyat[1] .')';

                else $temp[] = '('. $fiyat_s .' >= '. $fiyat[0] .')'; 
            }

            $where[] = '('. implode(' OR ', $temp) .') ';
        }

        if ($r->has('ozellik'))
        {
            $temp = [];

            foreach ($r->get('ozellik') as $ozellik) 
            
                $temp[] = $ozellik != 'indir' ? $ozellik .' = 1' : 'indirim > 0';

            $where[] = '('. implode(' OR ', $temp) .')';
        }

        if (count($where) > 0) $data['urunler'] = $data['urunler']->whereRaw(implode(' and ', $where));

        $data['toplam'] = $data['urunler']->count();

        $data['urunler'] = $data['urunler']->offset($limit)->limit($goster)->get();

        return view('urunler', $data);
    }

    public function detay($url)
    {
        $urun = $data['urun'] = Urun::where('url', $url)->first();

        if (!$urun) return redirect('urunler');

        if ($urun->sil == 1) return redirect('urunler');

        $no = Cookie::has('uye') ? Cookie::get('uye')->id : \Request::ip();

        $kontrol = DB::table('bakis')->where('urun_id', $urun->id)->where('no', $no)->count();

        if (!$kontrol) DB::table('bakis')->insert(['no' => $no, 'urun_id' => $urun->id]);

        // $data['breadcrumb'] = ['/urun/'. $urun->url => $urun->isim];

        if ($urun->kat_id)
        {
            $kok = Kategori::find($urun->kat_id);

            while (1)
            {
                $data['breadcrumb']['/urunler/'. $kok->url] = $kok->isim;

                if (!$kok->bagli_id) break;

                else $kok = Kategori::find($kok->bagli_id);
            }

            $data['breadcrumb'] = array_reverse($data['breadcrumb']);
        }

        if (!$urun->set)
        {
            $data['fotolar'] = Foto::where('urun_id', $urun->id)
                                   ->orderBy('profil', 'desc')
                                   ->orderBy('sira', 'asc')
                                   ->get();
        }

        else
        {
            $data['fotolar'][] = Foto::where('urun_id', $urun->id)
                                   ->orderBy('profil', 1)
                                   ->first();

            foreach (json_decode($urun->set) as $urun_id)
            {
                $data['fotolar'][] = Foto::where('urun_id', $urun_id)
                                         ->orderBy('profil', 1)
                                         ->first();
            }

            $data['fotolar'] = array_filter($data['fotolar']);
        }

        $numbers = DB::table('bakis')->selectRaw('group_concat(no separator ",") as numbers')
                                     ->where('urun_id', $urun->id)
                                     ->orderBy('id', 'desc')
                                     ->first()
                                     ->numbers;

        if ($numbers) 
        {
            $ids = DB::table('bakis')->selectRaw('group_concat(urun_id separator ",") as ids')
                                     ->whereIn('no', explode(',', $numbers))
                                     ->where('urun_id', '!=', $urun->id)
                                     ->first()
                                     ->ids;

            if ($ids)
            {
                $case_w = 

                '(CASE
                    WHEN indirim > 0 
                    THEN 100 - (indirim / fiyat * 100)
                    ELSE 0
                END) AS oran';

                $data['bakanlar'] = Urun::selectRaw('*, '. $case_w)
                                        ->whereIn('id', array_unique(explode(',', $ids)))
                                        ->where('sil', 0)
                                        ->where('set_id', null)
                                        ->orderBy('id', 'desc')
                                        ->limit(4)
                                        ->get();
            }
        }

        if ($urun->kat_id)
        {
            $case_w = 

            '(CASE
                WHEN indirim > 0 
                THEN 100 - (indirim / fiyat * 100)
                ELSE 0
            END) AS oran';

            $data['digerler'] = Urun::selectRaw('*, '. $case_w)
                                    ->where('kat_id', $urun->kat_id)
                                    ->where('id', '!=', $urun->id)
                                    ->where('sil', 0)
                                    ->where('set_id', null)
                                    ->orderBy('id', 'desc')
                                    ->limit(4)
                                    ->get();
        }

        $data['yorumlar'] = DB::table('yorum')
                              ->where('urun_id', $urun->id)
                              ->where('onay', 1)
                              ->orderBy('tarih', 'desc')
                              ->get();

        return view('urun', $data);
    }

    public function sepet(Request $r)
    {
        $uye_id = Cookie::has('uye') ? Cookie::get('uye')->id : Session::get('id');
        
        if ($r->isMethod('post'))
        {
            if ($r->get('yap') == 'ekle')
            {
                $urun = Urun::find($r->get('id')); 
                
                if (!$urun) return false;

                $sepet = Sepet::where('uye_id', $uye_id)
                              ->where('urun_id', $urun->id)
                              ->where('sil', 0)
                              ->first();

                if (!$sepet) $sepet = new Sepet;

                $adet = $r->has('adet') ? $r->get('adet') : 1;

                if ($adet < 1) $adet = 1; $sepet->adet += $adet;

                $sepet->uye_id = $uye_id; $sepet->urun_id = $urun->id;

                try { $sepet->save(); } catch(\Exception $e) { return $e->getMessage(); }

                return Sepet::where('uye_id', $uye_id)->where('sil', 0)->sum('adet');
            }

            else if ($r->get('yap') == '++' || $r->get('yap') == '--')
            {
                $sepet = Sepet::find((int) $r->get('id'));

                if (!$sepet) return false;

                if ($sepet->uye_id != $uye_id) return false;

                if ($r->get('yap') == '++') $sepet->adet++; else $sepet->adet--;

                if ($r->has('adet')) $sepet->adet = $r->get('adet');

                $sepet->save();

                $data['adet'] = Sepet::where('uye_id', $uye_id)->where('sil', 0)->sum('adet');

                $urun = Urun::find($sepet->urun_id);

                $fiyat = $urun->indirim ? $urun->indirim : $urun->fiyat;

                $data['toplam'] = $sepet->adet * $fiyat; $data['fiyat'] = 0;

                $data['toplam'] = number_format($data['toplam'], 2, ',', '.');

                $case_w = 

                '(CASE
                    WHEN urun.indirim > 0 THEN urun.indirim * sepet.adet
                    ELSE urun.fiyat * sepet.adet
                END) AS toplam';

                $sepet = Sepet::selectRaw($case_w)->join('urun', 'urun.id', '=', 'sepet.urun_id')
                              ->where('sepet.uye_id', $uye_id)->where('sepet.sil', 0)->get();

                foreach ($sepet as $toplam) $data['fiyat'] += $toplam->toplam;

                $hasDiscount = false;

                $indirim = json_decode(\DB::table('ayar')->where('tip', 'indirim')->first()->data, true);
                
                if ($indirim['a'] > 0 && Cookie::has('uye'))
                {
                    $user = \App\Uye::find($uye_id);
                    
                    if ($user)
                    {
                        if ($user->hasdiscount)
                        {
                            if ($data['fiyat'] > $indirim['a'])
                            {
                                $data['indirimsiz'] = $data['fiyat'];
                                
                                $data['indirimli'] = $data['fiyat'] - $indirim['b'];

                                $data['indirim_b'] = $indirim['b'];
                                
                                $hasDiscount = true;
                            }
                        }
                    }
                }

                $limit = \DB::table('ayar')->where('tip', 'ucretsiz')->first()->data;

                $toplam_k = $hasDiscount ? $data['indirimli'] : $data['fiyat'];

                $data['kargo'] = $toplam_k >= $limit ? 0 : \DB::table('ayar')->where('tip', 'kargo')->first()->data;

                if ($hasDiscount)
                {
                    $data['indirimsiz'] += $data['kargo'];

                    $data['indirimsiz'] = number_format($data['indirimsiz'], 2, ',', '.');
                                
                    $data['indirimli'] += $data['kargo'];

                    $data['indirimli'] = number_format($data['indirimli'], 2, ',', '.');
                }

                else $data['fiyat'] += $data['kargo'];

                $data['fiyat'] = number_format($data['fiyat'], 2, ',', '.');

                $data['kargo'] = number_format($data['kargo'], 2, ',', '.');

                return $data;
            }

            else if ($r->get('yap') == 'sil')
            {
                $sepet = Sepet::find($r->get('id'));

                if (!$sepet) return false;

                if ($sepet->uye_id != $uye_id) return false;

                $urun = Urun::find($sepet->urun_id);

                if ($urun->set_id)
                {
                    $set = Urun::find($urun->set_id);

                    $ids = json_decode($set->set);

                    Sepet::whereIn('urun_id', $ids)->where('uye_id', $uye_id)->update(['sil' => 1]);
                }

                else { $sepet->sil = 1; $sepet->save(); }
                
                return 1;
            }

            else return false;
        }

        else 
        {
            $sepet = Sepet::where('uye_id', $uye_id)->where('sil', 0)->orderBy('id', 'desc')->get();

            return view('sepet.sepet', ['sepettekiler' => $sepet]);
        }
    }

    public function teslimat(Request $r)
    {
        $uye_id = Cookie::has('uye') ? Cookie::get('uye')->id : Session::get('id');

        $data['adresler'] = Adres::where('uye_id', $uye_id)
                                 ->where('sil', 0)
                                 ->orderBy('isim')
                                 ->get();

        $data['kontrol'] = Sepet::where('uye_id', $uye_id)->where('sil', 0)->count();

        return view('sepet.teslimat', $data);
    }

    public function odeme(Request $r)
    {
        if (!Session::has('fatura')) return redirect('teslimat');

        $uye_id = Cookie::has('uye') ? Cookie::get('uye')->id : Session::get('id');

        $case_w = 

        'SUM((CASE
            WHEN urun.indirim > 0 THEN urun.indirim
            ELSE urun.fiyat
        END) * sepet.adet) AS toplam';

        $toplam = $data['toplam'] = Sepet::where('sepet.uye_id', $uye_id)
                                         ->where('sepet.sil', 0)
                                         ->join('urun', 'sepet.urun_id', '=', 'urun.id')
                                         ->selectRaw($case_w)
                                         ->first()
                                         ->toplam;
        
        $indirim = json_decode(DB::table('ayar')->where('tip', 'indirim')->first()->data, true);

        $indirim_kontrol = false;

        if ($indirim['a'] > 0 && Cookie::has('uye'))
        {
            $uye = Cookie::get('uye')->id;
            
            $user = \App\Uye::find($uye);
            
            if ($user)
            {
                if ($user->hasdiscount)
                {
                    if ($toplam > $indirim['a'])
                    {
                        $toplam = $data['toplam'] = $toplam - $indirim['b'];

                        $indirim_kontrol = true;
                    }
                }
            }
        }

        $limit = DB::table('ayar')->where('tip', 'ucretsiz')->first()->data;

        if ($data['toplam'] >= $limit) $data['kargo'] = $data['kapi'] = $kargo = $kapi = 0;

        else 
        {
            $data['kargo'] = $kargo = DB::table('ayar')->where('tip', 'kargo')->first()->data;

            $data['kapi'] = $kapi = DB::table('ayar')->where('tip', 'kapi')->first()->data;
        }

        $data['pos_info'] = $pos_info = json_decode(\App\Ayar::where('tip', 'pos')->first()->data, true);

        if ($r->isMethod('post'))
        {
            $result['title'] = '<i class="fas fa-exclamation"></i> Uyarı';

            $siparis = new Siparis;

            $siparis->id = substr(str_replace('.', '', microtime()), 0, 11);

            $siparis->uye_id = $uye_id;

            $siparis->fatura = Session::get('fatura');

            $siparis->teslimat = Session::has('teslimat') ? Session::get('teslimat') : 'Fatura adresi ile aynı';

            $siparis->kargo = $kargo;

            $odeme =
            [
                'kart' => 'Kart',
                'havale' => 'Havale / EFT',
                'kapi' => 'Kapıda Ödeme',
            ];

            $siparis->odeme = $odeme[$r->get('odeme')];

            $siparis->isim = Session::get('bilgi')['isim'];
            $siparis->mail = Session::get('bilgi')['mail'];
            $siparis->tel = Session::get('bilgi')['tel'];

            if ($indirim_kontrol) $siparis->indirim = $indirim['b'];

            $sepetler = Sepet::where('uye_id', $uye_id)->where('sil', 0)->orderBy('id', 'desc')->get();

            $kontrol = json_decode(\App\Ayar::where('tip', 'odeme')->first()->data, true);

            if ($r->get('odeme') == 'havale')
            {
                if ($kontrol['havale'] == 0) return false;

                $banka = DB::table('ayar')->find($r->get('havale')); 
                
                if (!$banka) return false; else $banka = json_decode($banka->data);

                $siparis->sekil = $banka->isim .' '. $banka->sube .' '. $banka->iban;

                $result = $this->siparis($siparis, $sepetler);
            }

            else if ($r->get('odeme') == 'kapi') 
            {
                if ($kontrol['kapi'] == 0) return false;

                $siparis->sekil = $kapi;

                $result = $this->siparis($siparis, $sepetler);
            }

            else 
            {
                if ($kontrol['kart'] == 0) return false;

                if ($pos_info['banka'] == 'iyzico')
                {
                    require_once('Iyzipay/IyzipayBootstrap.php');

                    \IyzipayBootstrap::init();

                    $options = new \Iyzipay\Options();
                    $options->setApiKey($pos_info['api_key']);
                    $options->setSecretKey($pos_info['secret_key']);
                    $options->setBaseUrl("https://api.iyzipay.com");
                            
                    $request = new \Iyzipay\Request\CreatePaymentRequest();
                    $request->setLocale(\Iyzipay\Model\Locale::TR);
                    $request->setConversationId($siparis->id);
                    $request->setPrice(str_replace(',', '', number_format($toplam, 2)));
                    
                    $paid_price = $r->has('taksit') ? 

                        $r->get('taksitli')[$r->get('taksit')] :

                        $toplam + $kargo;

                    $request->setPaidPrice(str_replace(',', '', number_format($paid_price, 2)));
                    $request->setCurrency(\Iyzipay\Model\Currency::TL);
                    $request->setInstallment($r->has('taksit') ? $r->get('taksit') : 1);
                    $request->setBasketId($siparis->id);
                    $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
                    $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
                    $request->setCallbackUrl(url('kart'));

                    $paymentCard = new \Iyzipay\Model\PaymentCard();
                    $paymentCard->setCardHolderName($r->get('name'));
                    $paymentCard->setCardNumber(str_replace(' ', '', $r->get('number')));
                    $paymentCard->setExpireMonth($r->get('expiry_month'));

                    $year = $r->get('expiry_year');
                    
                    if (strlen($r->get('expiry_year')) == 2)

                        $year = '20'. $r->get('expiry_year');

                    $paymentCard->setExpireYear($year);
                    $paymentCard->setCvc($r->get('ccv'));
                    $paymentCard->setRegisterCard(0);

                    $request->setPaymentCard($paymentCard);

                    $fatura_a = explode(' ', $siparis->fatura);

                    $buyer = new \Iyzipay\Model\Buyer();
                    $buyer->setId("1");
                    $buyer->setName($siparis->isim);
                    $buyer->setSurname($siparis->isim);
                    $buyer->setGsmNumber($siparis->tel);
                    $buyer->setEmail($siparis->mail);
                    $buyer->setIdentityNumber("11111111111");
                    $buyer->setRegistrationAddress(implode(' ', $fatura_a));
                    $buyer->setIp($r->ip());
                    $buyer->setCity(array_pop($fatura_a));
                    $buyer->setCountry("Türkiye");
                    
                    $request->setBuyer($buyer);

                    $billingAddress = new \Iyzipay\Model\Address();
                    $billingAddress->setContactName($siparis->isim);
                    $billingAddress->setCity(array_pop($fatura_a));
                    $billingAddress->setCountry("Türkiye");
                    $billingAddress->setAddress(implode(' ', $fatura_a));
                    
                    $request->setBillingAddress($billingAddress);

                    if (\Session::has('teslimat'))
                    {
                        $teslimat_a = explode(' ', $siparis->teslimat);

                        $shippingAddress = new \Iyzipay\Model\Address();
                        $shippingAddress->setContactName($siparis->isim);
                        $shippingAddress->setCity(array_pop($teslimat_a));
                        $shippingAddress->setCountry("Türkiye");
                        $shippingAddress->setAddress(implode(' ', $teslimat_a));
                        
                        $request->setShippingAddress($shippingAddress);
                    }

                    else $request->setShippingAddress($billingAddress);

                    $basket_price = 0;

                    foreach ($sepetler as $sepet)
                    {
                    	$urun = Urun::find($sepet->urun_id);
                    	
                    	$item_price = ($urun->indirim ? $urun->indirim : $urun->fiyat) * $sepet->adet;

                        $basket_price += $item_price;
                    }

                    if ($toplam != $basket_price)
                    {
                    	$fark = $toplam > $basket_price ? $toplam - $basket_price : $basket_price - $toplam;

                    	$fark = $fark / count($sepetler);
                    }

                    else $fark = 0;

                    $basketItems = array();

                    foreach ($sepetler as $sepet)
                    {
                        $urun = Urun::find($sepet->urun_id);

                        $temp = new \Iyzipay\Model\BasketItem();
                        $temp->setId($sepet->id);
                        $temp->setName($urun->isim);
                        
                        $kategori = Kategori::find($urun->kat_id);

                        if ($kategori)
                        {
                            if ($kategori->bagli_id)
                            {
                                $temp->setCategory2($kategori->isim);

                                $kategori = Kategori::find($kategori->bagli_id);

                                $temp->setCategory1($kategori->isim);
                            }

                            else $temp->setCategory1($kategori->isim);
                        }

                        else $temp->setCategory1("Kategori Yok");
                        
                        $temp->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
                        
                        // $secondBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);

                        $item_price = ($urun->indirim ? $urun->indirim : $urun->fiyat) * $sepet->adet;

                        $fiyat = number_format($item_price - $fark, 2);

                        $temp->setPrice(str_replace(',', '', $fiyat));

                        $basketItems[] = $temp;
                    }

                    $request->setBasketItems($basketItems);

                    $payment = \Iyzipay\Model\ThreedsInitialize::create($request, $options);

                    if ($payment->getStatus() == 'failure')
                    
                        $result['mess'] = $payment->getErrorMessage() .'.';

                    else
                    {
                        $result['sonuc'] = true;

                        $file = fopen(public_path('assets/'. $siparis->id .'.html'), 'w+');

                        fwrite($file, $payment->getHtmlContent());

                        fclose($file);

                        $result['html'] = url('assets/'. $siparis->id .'.html');

                        \Session::put('temp-s', $siparis);
                    }
                }
                
                else Session::put('temp-s', $siparis);
            }

            git: return $result;
        }

        else
        {
            $data['kontrol'] = Sepet::where('uye_id', $uye_id)->where('sil', 0)->count();

            $data['bankalar'] = DB::table('ayar')->where('tip', 'banka')->orderBy('data_2')->get();

            $data['odeme'] = json_decode(\App\Ayar::where('tip', 'odeme')->first()->data, true);

            $data['bank_url'] = json_decode(\App\Ayar::where('tip', 'url')->first()->data, true);

            return view('sepet.odeme', $data);
        }
    }

    public function kart(Request $r)
    {
        $pos_info = json_decode(\App\Ayar::where('tip', 'pos')->first()->data, true);

        if ($pos_info['banka'] != 'iyzico')
        {
            $hashparams = $r->get('HASHPARAMS');
            $hashparamsval = $r->get('HASHPARAMSVAL');
            $hashparam = $r->get('HASH');
            
            $storekey = $pos_info['3d_sifre'];
            
            $paramsval = '';
            
            $index1 = 0;
            $index2 = 0;

            while($index1 < strlen($hashparams))
            {
                $index2 = strpos($hashparams, ':', $index1);
                
                $vl = $r->get(substr($hashparams, $index1, $index2 - $index1));
                
                if ($vl == null) $vl = '';

                $paramsval = $paramsval . $vl; 
                
                $index1 = $index2 + 1;
            }

            $hashval = $paramsval . $storekey;  

            $hash = base64_encode(pack('H*', sha1($hashval)));
            
            /* if ($paramsval != $hashparamsval || $hashparam != $hash)
            {
                Session::put('mess', 'Güvenlik uyarısı: Sayısal imza geçerli değil!');

                return redirect('sonuc/false');
            } */

            $siparis = Session::get('temp-s');

            Session::forget('temp-s');

            if (in_array($r->get('mdStatus'), ['1', '2', '3', '4']))
            {
                $name = $pos_info['isim'];
                $password = $pos_info['sifre'];
                $clientid = $pos_info['numara'];
                $email = $siparis->mail;
                $type = 'Auth';
                        
                $request = 

                '<?xml version="1.0" encoding="ISO-8859-9"?>
                <CC5Request>
                    <Name>{NAME}</Name>
                    <Password>{PASSWORD}</Password>
                    <ClientId>{CLIENTID}</ClientId>
                    <IPAddress>{IP}</IPAddress>
                    <Email>{EMAIL}</Email>
                    <Mode>P</Mode>
                    <OrderId>{OID}</OrderId>
                    <GroupId></GroupId>
                    <TransId></TransId>
                    <UserId></UserId>
                    <Type>{TYPE}</Type>
                    <Number>{MD}</Number>
                    <Expires></Expires>
                    <Cvv2Val></Cvv2Val>
                    <Total>{TUTAR}</Total>
                    <Currency>949</Currency>
                    <Taksit></Taksit>
                    <PayerTxnId>{XID}</PayerTxnId>
                    <PayerSecurityLevel>{ECI}</PayerSecurityLevel>
                    <PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>
                    <CardholderPresentCode>13</CardholderPresentCode>
                </CC5Request>';

                $request = str_replace("{NAME}", $name, $request);
                $request = str_replace("{PASSWORD}", $password, $request);
                $request = str_replace("{CLIENTID}", $clientid, $request);
                $request = str_replace("{IP}", $r->ip(), $request);
                $request = str_replace("{EMAIL}", $email, $request);
                $request = str_replace("{OID}", $r->get('oid'), $request);
                $request = str_replace("{TYPE}", $type, $request);
                $request = str_replace("{MD}", $r->get('md'), $request);
                $request = str_replace("{TUTAR}", $r->get('tutar'), $request);
                $request = str_replace("{XID}", $r->get('xid'), $request);
                $request = str_replace("{ECI}", $r->get('eci'), $request);
                $request = str_replace("{CAVV}", $r->get('cavv'), $request);

                $bank_url = json_decode(\App\Ayar::where('tip', 'url')->first()->data, true);

                $url = "https://". $bank_url[$pos_info['banka']] ."/fim/api";

                $ch = curl_init();
            
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);            
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);            
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 90);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

                $result_c = curl_exec($ch);

                if (curl_errno($ch))
                {
                    Session::put('mess', (string) curl_error($ch));

                    return redirect('sonuc/false');
                }
                
                else curl_close($ch);

                $response_tag = "Response";
                $posf = strpos($result_c, ("<". $response_tag .">"));
                $posl = strpos($result_c, ("</". $response_tag .">"));
                $posf = $posf + strlen($response_tag) + 2;
                $response = substr($result_c, $posf, $posl - $posf);

                if ($response == 'Approved')
                {
                    $sepetler = Sepet::where('uye_id', $siparis->uye_id)->where('sil', 0)->orderBy('id', 'desc')->get();

                    $result = $this->siparis($siparis, $sepetler);

                    return redirect($result['sonuc']);
                }

                else
                {
                    $response_tag = "ErrMsg";
                    $posf = strpos($result_c, ("<". $response_tag .">"));
                    $posl = strpos($result_c, ("</". $response_tag .">"));
                    $posf = $posf + strlen($response_tag) + 2;
                    $response = substr($result_c, $posf, $posl - $posf);

                    Session::put('mess', $response);

                    return redirect('sonuc/false');
                }
            }

            else
            {
                Session::put('mess', '3d işlemi onaylanmadı.');

                return redirect('sonuc/false');
            }
        }

        else
        {
            $siparis = \Session::get('temp-s');

            \Session::forget('temp-s');

            $message =
            [
                '3-D Secure imzası geçersiz veya doğrulama',
                'Kart sahibi veya bankası sisteme kayıtlı değil',
                'Kartın bankası sisteme kayıtlı değil',
                'Doğrulama denemesi, kart sahibi sisteme daha sonra kayıt olmayı seçmiş',
                'Doğrulama yapılamıyor',
                '3-D Secure hatası',
                'Sistem hatası',
                'Bilinmeyen kart no',
            ];

            if ($r->get('mdStatus') == 1)
            {
                require_once('Iyzipay/IyzipayBootstrap.php');

                \IyzipayBootstrap::init();

                $options = new \Iyzipay\Options();
                $options->setApiKey($pos_info['api_key']);
                $options->setSecretKey($pos_info['secret_key']);
                $options->setBaseUrl("https://api.iyzipay.com");

                $request = new \Iyzipay\Request\CreateThreedsPaymentRequest();
                $request->setConversationId($r->get('conversationId'));
                $request->setPaymentId($r->get('paymentId'));
                $request->setConversationData($r->get('conversationData'));

                $payment = \Iyzipay\Model\ThreedsPayment::create($request, $options);

                if ($payment->getStatus() == 'failure')
                {
                    \Session::put('mess', $payment->getErrorMessage());

                    return redirect('sonuc/false');
                }

                else
                {
                    $sepetler = Sepet::where('uye_id', $siparis->uye_id)->where('sil', 0)->orderBy('id', 'desc')->get();

                    $result = $this->siparis($siparis, $sepetler);

                    if (isset($result['mess']))

                        \Session::put('mess', $result['mess']);

                    return redirect($result['sonuc']);
                }
            }

            else
            {
                \Session::put('mess', $message[$_POST['mdStatus']]);

                return redirect('sonuc/false');
            }
        }
    }

    public static function siparis($siparis, $sepetler)
    {   
        $result['title'] = '<i class="fas fa-exclamation"></i> Uyarı';

        try 
        { 
            $siparis->save();

            foreach ($sepetler as $sepet)
            {
                $detay = new Detay;

                $detay->siparis_id = $siparis->id;

                $detay->sepet_id = $sepet->id;

                $urun = Urun::find($sepet->urun_id);

                $foto = Foto::where('urun_id', $urun->id)->where('profil', 1)->first();

                $detay->foto = !$foto ? 'logo.png' : $foto->deger;

                $detay->isim = $urun->isim; 
                $detay->adet = $sepet->adet; 
                $detay->sira = $sepet->id;

                $detay->fiyat = $urun->indirim ? $urun->indirim : $urun->fiyat;
                
                $sepet->sil = $sepet->siparis = 1;

                $detay->save(); 
                $sepet->save();
            }

            $data = ['konu' => 'siparis', 'siparis' => $siparis];

            $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

            $url = str_replace(['http://', 'https://'], '', url('/'));      

            \Mail::send(['html' => 'mailing.siparis'], $data, function($msg) use ($siparis, $seo, $url)
            {
                $msg->to($siparis->mail, $siparis->isim);
                $msg->subject('Siparişiniz Alındı');
                $msg->cc('info@'. $url, $seo['author']);
                // $msg->cc('zeyd@'. $url, 'Zeyd ÖZER');
                $msg->from('web@'. $url, $seo['author']);
            });

            if ($siparis->odeme != 'Kart')
            {
                $result['title'] = '<i class="fas fa-check"></i> Başarılı';

                $result['mess'] = 'Siparişiniz başarıyla verildi. Yönlendiriliyorsunuz..';

                Session::put('conversion', $siparis->id);

                $result['go'] = Cookie::has('uye') ? url('hesap/siparis/'. $siparis->id) : url('/');
            }

            else
            {
                $mess = 'Ödemeniz başarıyla alındı. <br> ';

                if (Cookie::has('uye'))

                    $mess .= 'Siparişinizin durumunu hesap sayfanızdan takip edebilirsiniz.';

                else $mess .= 'Siparişinizin durumunu '. $siparis->mail .' e-posta hesabınızdan takip edebilirsiniz.';

                Session::put('mess', $mess); Session::put('sip-id', $siparis->id);

                $result['sonuc'] = url('sonuc/true');
            }
        }
            
        catch (\Exception $e) 
        { 
            $result['mess'] = $e->getMessage();

            if ($siparis->odeme == 'Kart')

                $result['sonuc'] = url('sonuc/false');
            
            foreach ($sepetler as $sepet)
            {
                Detay::where('sepet_id', $sepet->id)->delete();

                $sepet->sil = $sepet->siparis = 0;

                $sepet->save();
            }

            $siparis->delete();
        }

        return $result;
    }

    public function yorum(Request $r, $url)
    {
        $urun = Urun::where('url', $url)->first();

        if (!$urun) return false;

        $result['title'] = '<i class="fas fa-exclamation"></i> Uyarı';

        $yorum = new \stdclass();

        foreach ($r->all() as $name => $value)
        {
            if ($name == '_token') continue;

            $yorum->$name = $r->get($name);
        }

        try
        {
            DB::table('yorum')->insert((array) $yorum);

            $result['title'] = '<i class="fas fa-check"></i> Başarılı';

            $result['message'] = 'Yorumunuz için teşekkürler. <br> Onaylandıktan sonra yayınlanacaktır.';
        }

        catch(\Exception $e)
        {
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

    public function sonuc(Request $r, $durum)
    {
        if (!Session::has('mess')) return redirect('odeme');

        $data['durum'] = ($durum === 'true');

        if ($data['durum'])
        {
            $siparis = $data['siparis'] = Siparis::find(Session::get('sip-id'));

            Session::forget('sip-id');
        
            $data['urunler'] = Detay::where('siparis_id', $siparis->id)->orderBy('sira')->get();
            
            $toplam = 0;
            
            foreach ($data['urunler'] as $urun) 
                
                $toplam += $urun->fiyat * $urun->adet;

            $indirim = json_decode(DB::table('ayar')->where('tip', 'indirim')->first()->data, true);

            if ($indirim['a'] > 0 && Cookie::has('uye'))
            {
                $uye = Cookie::get('uye')->id;
                
                $user = \App\Uye::find($uye);
                
                if ($user)
                {
                    if ($user->hasdiscount)
                    {
                        if ($toplam > $indirim['a'])
                        {
                            $data['indirimli'] = $toplam - $indirim['b'];
                            
                            $user->hasdiscount = false;
                            
                            $user->save();
                        }
                    }
                }
            }
        }

        return view('sepet.sonuc', $data);
    }

    public function takip(Request $r, $info = null)
    {
        if ($info)
        {
            $info = explode('&&', urldecode($info));

            $siparis = $data['siparis'] = Siparis::where('mail', $info[0])->where('id', $info[1])->first();

            if (!$siparis) return redirect('takip');

            $data['urunler'] = Detay::where('siparis_id', $siparis->id)->orderBy('sira')->get();

            return view('sonuc', $data);
        }

        else 
        {
            if ($r->isMethod('post'))
            {
                $kontrol = Siparis::where('mail', $r->get('mail'))->where('id', $r->get('no'))->count();

                if ($kontrol == 0)
                {
                    $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

                    $result['message'] = 'Sipariş bulunamadı. <br> Bilgileri kontrol ederek tekrar deneyin.';
                }

                else
                {
                    $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                    $info = urlencode($r->get('mail') .'&&'. $r->get('no')); 

                    $result['message'] = 
                    
                    'Sipariş detaylarına yönlendiriliyorsunuz..
                    
                    <script>setTimeout(function() { location.href = "'. url('takip/'. $info) .'"; }, 2000);</script>';
                }

                return $result;
            }

            else return view('takip');
        }
    }

    public function fiyat(Request $r)
    {
        $ids = array_filter($r->get('ids'));
        
        $toplam['fiyat'] = $toplam['indirim'] = 0;

        foreach (Urun::whereIn('id', array_keys($ids))->get() as $urun)
        {
            $toplam['fiyat'] += $urun->fiyat * $ids[$urun->id];

            $toplam['indirim'] += $urun->indirim > 0 ? $urun->indirim * $ids[$urun->id] : $urun->fiyat * $ids[$urun->id];
        }

        return $toplam;
    }
}
