<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Uye;
use App\Adres;

use Socialite;
use Cookie;
use Session;
use Mail;

class UyeC extends Controller
{
    public function kayit(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            $uye = new Uye;

            $columns = ['isim', 'mail', 'sifre', 'tel'];

            foreach ($columns as $column) $uye->$column = $r->get($column);

            $kontrol = Uye::where('mail', $uye->mail)->count();

            if ($kontrol > 0) 
            {
                $result['message'] = 'Mail adresi başka üye tarafından kullanılıyor.';

                goto git;
            }
            
            if ($r->get('sifre') != $r->get('tekrar'))
            {
                $result['message'] = 'Şifreler uyuşmuyor.';

                goto git;
            }

            else $uye->sifre = md5($uye->sifre);

            $uye->onay = 1;

            // $uye->token = md5(mt_rand());

            try { $uye->save(); } 
            
            catch (\Exception $e) { return $e->getMessage(); }

            $data = ['uye' => $uye, 'konu' => 'aktivasyon'];

            $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

            $url = str_replace(['http://', 'https://'], '', url('/'));

            Mail::send(['html' => 'mailing.aktif'], $data, function($msg) use ($uye, $seo, $url)
            {
                $msg->to($uye->mail, $uye->isim)->subject('Hoşgeldiniz');
                
                $msg->from('web@'. $url, $seo['author']);
            });

            $result['status'] = '<i class="fas fa-check"></i> Başarılı';

            $result['message'] = 'Başarıyla kayıt oldunuz.<br>Aktivasyon maili gönderildi.';

            git: return $result;
        }

        else return view('uye');
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $r)
    {
        $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

        try { $user = Socialite::driver('facebook')->user(); }

        catch (\Exception $e) { $result['message'] = $e->getMessage(); goto git; }

        $kontrol = Uye::where('mail', $user->email)->count();

        if ($kontrol > 0) 
        {
            $uye = Uye::where('mail', $user->email)
                      ->where('tip', 'user')
                      ->where('sil', 0)
                      ->first();

            if (count($uye) == 0)
            
            { $result['message'] = 'Üyeliğiniz askıya alınmış.'; goto git; }

            $sepettekiler = \App\Sepet::where('uye_id', Session::get('id'))->where('siparis', 0)->get();

            foreach ($sepettekiler as $eski)
            {
                $urun = \App\Urun::find($eski->urun_id);

                $sepet = \App\Sepet::where('uye_id', $uye->id)->where('urun_id', $urun->id)->where('sil', 0)->first();

                if (!$sepet)
                {
                    $eski->uye_id = $uye->id;

                    $eski->save();
                }

                else
                {
                    $sepet->adet += $eski->adet;

                    $eski->delete();

                    $sepet->save();
                }
            }

            Cookie::queue(Cookie::forever('uye', json_decode(json_encode($uye))));

            $result['status'] = '<i class="fas fa-check"></i> Başarılı';

            $result['message'] = 'Başarıyla giriş yaptınız.<br>Yönlendiriliyorsunuz..';

            $result['go'] = url('hesap/uyelik');

            goto git;
        }

        $uye = new Uye;

        $uye->isim = $user->name;
        $uye->mail = $user->email;
        $uye->onay = 1;

        $sifre = mt_rand();
        $uye->sifre = md5($sifre);

        try { $uye->save(); }
        
        catch (\Exception $e) { $result['message'] = $e->getMessage(); goto git; }

        $data = ['uye' => $uye, 'konu' => 'aktivasyon'];

        $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

        $url = str_replace(['http://', 'https://'], '', url('/'));

        Mail::send(['html' => 'mailing.aktif'], $data, function($msg) use ($uye, $seo, $url)
        {
            $msg->to($uye->mail, $uye->isim)->subject('Hoşgeldiniz');
            
            $msg->from('web@'. $url, $seo['author']);
        });

        $result['status'] = '<i class="fas fa-check"></i> Başarılı';

        $result['message'] = 'Başarıyla kayıt oldunuz.<br>Hesabınıza atanan şifre: <b>'. $sifre .'</b><br>Yönlendiriliyorsunuz..';

        $result['go'] = url('hesap/uyelik');

        Cookie::queue(Cookie::forever('uye', json_decode(json_encode($uye))));

        git: return view('uye', $result);
    }

    public function giris(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $uye = Uye::where('mail', $r->get('mail'))
                      ->where('sifre', md5($r->get('sifre')))
                      ->where('tip', 'user')
                      ->where('sil', 0)
                      ->first();

            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            if (count($uye) > 0)
            {
                if (!$uye->onay)
                
                { $result['message'] = 'Üyeliğiniz aktif değil.'; goto git; }

                $sepettekiler = \App\Sepet::where('uye_id', Session::get('id'))->where('siparis', 0)->get();

                foreach ($sepettekiler as $eski)
	            {
	                $urun = \App\Urun::find($eski->urun_id);

                    $sepet = \App\Sepet::where('uye_id', $uye->id)->where('urun_id', $urun->id)->where('sil', 0)->first();

                    if (!$sepet)
                    {
                        $eski->uye_id = $uye->id;

                        $eski->save();
                    }

                    else
                    {
                        $sepet->adet += $eski->adet;

                        $eski->delete();

                        $sepet->save();
                    }
	            }

                Cookie::queue(Cookie::forever('uye', json_decode(json_encode($uye))));
            }
    
            else { $result['message'] = 'Bilgiler hatalı.'; goto git; }

            $result['status'] = '<i class="fas fa-check"></i> Başarılı';

            $url = $r->has('takip') ? '"'. url('hesap/siparis') .'"' : 'document.referrer';

            $result['message'] = 
            
            'Başarıyla giriş yaptınız.<br>Yönlendiriliyorsunuz..
            
            <script>setTimeout(function() { location.href = '. $url .'; }, 2000);</script>';

            git: return $result;
        }

        else 
        {
            $data = [];

            if ($r->has('token'))
            {
                $uye = Uye::where('token', $r->get('token'))->where('onay', 0)->where('sil', 0)->first();

                if ($uye) 
                { 
                    if ($uye->onay == 1) return redirect('giris');

                    $uye->onay = 1; $uye->token = null; $uye->save();

                    $data = ['uye' => $uye, 'konu' => 'aktivasyon'];

                    $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                    $url = str_replace(['http://', 'https://'], '', url('/'));

                    Mail::send(['html' => 'mailing.aktif'], $data, function($msg) use ($uye, $seo, $url)
                    {
                        $msg->to($uye->mail, $uye->isim)->subject('Aktivasyon');
                        
                        $msg->from('web@'. $url, $seo['author']);
                    });

                    $data['status'] = '<i class="fas fa-check"></i> Başarılı';

                    $data['message'] = 'Üyeliğiniz başarıyla onaylandı, giriş yapabilirsiniz.';
                }
            }

            return view('uye', $data);
        }
    }

    public function cikis(Request $r)
    {
        if (Cookie::get('uye'))
        
            Cookie::queue(Cookie::forget('uye'));
        
        return redirect()->back();
    }

    public function token(Request $r)
    {
        $token = $r->has('token') ? $r->get('token') : null;

        if ($token)
        {
            $kontrol = Uye::where('token', $token)->count();

            if ($kontrol == 0) return redirect('token');
        }

        if ($r->isMethod('post'))
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            if ($token)
            {
                $uye = Uye::where('token', $token)->where('sil', 0)->first();

                if (is_null($uye)) { $result['message'] = 'Mail adresi kayıtlı değil.'; goto git; }

                if ($r->get('sifre') != $r->get('tekrar')) { $result['message'] = 'Şifreler uyuşmuyor.'; goto git; }

                else $uye->sifre = md5($r->get('sifre'));
                
                $uye->token = null;

                $data = ['konu' => 'sifirla', 'uye' => $uye, 'sifre' => $r->get('sifre')];

                $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                $url = str_replace(['http://', 'https://'], '', url('/'));

                Mail::send(['html' => 'mailing.sifir'], $data, function($msg) use ($uye, $seo, $url)
                {
                    $msg->to($uye->mail, $uye->isim)->subject('Şifremi Sıfırla');
                    
                    $msg->from('web@'. $url, $seo['author']);
                });

                $uye->save();

                $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                $result['message'] = 
                
                'Şifreniz başarıyla değiştirildi.<br>Yönlendiriliyorsunuz..
                
                <script>setTimeout(function() { location.href = "'. url('giris') .'"; }, 2000);</script>';
            }

            else
            {
                $uye = Uye::where('mail', $r->get('mail'))->where('sil', 0)->first();

                if (is_null($uye)) { $result['message'] = 'Mail adresi kayıtlı değil.'; goto git; }

                $uye->token = md5(mt_rand());

                $data = ['konu' => 'unuttum', 'uye' => $uye];

                $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                $url = str_replace(['http://', 'https://'], '', url('/'));

                Mail::send(['html' => 'mailing.unut'], $data, function($msg) use ($uye, $seo, $url)
                {
                    $msg->to($uye->mail, $uye->isim)->subject('Şifremi Unuttum');
                    
                    $msg->from('web@'. $url, $seo['author']);
                });

                $uye->save();

                $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                $result['message'] = 'Şifre sıfırlama bağlantısı mailinize gönderildi.';
            }

            git: return $result;
        }

        else return view('uye', ['token' => $token]);
    }

    public function adres(Request $r)
    {
        $uye_id = Cookie::has('uye') ? Cookie::get('uye')->id : Session::get('id');

        if ($r->isMethod('post'))
        {
            $adres = [];

            $adres['isim'] = $r->get('isim');
            $adres['tel'] = $r->get('tel');
            $adres['vergi_d'] = $r->get('vergi_d');
            $adres['vergi_n'] = $r->get('vergi_n');
            $adres['adres'] = $r->get('adres');
            $adres['ilce'] = \DB::table('ilce')->find($r->get('ilce'))->isim;
            $adres['il'] = \DB::table('il')->find($r->get('il'))->isim;

            Session::put('fatura', implode(' ', array_filter($adres)));

            if (Cookie::has('uye'))
            {
                $kontrol = false;

                $eski = Adres::where('uye_id', $uye_id)
                             ->where('tanim', $r->get('tanim'))
                             ->first();

                if ($eski)
                {
                    foreach ($eski as $name => $value)
                    {
                        if ($r->has($name))
                        {
                            if ($adres[$name] != $eski->$name)

                                $kontrol = true;
                        }
                    }

                    if ($kontrol) $eski->update($adres);
                }

                else
                {
                    $adres['uye_id'] = $uye_id;

                    $adres['tanim'] = $r->get('tanim');

                    Adres::create($adres);
                }
            }

            $bilgiler = 
            [
                'isim' => Cookie::has('uye') ? Cookie::get('uye')->isim : $r->get('isim'),
                'mail' => Cookie::has('uye') ? Cookie::get('uye')->mail : $r->get('mail'),
                'tel' => Cookie::has('uye') ? Cookie::get('uye')->tel : $r->get('tel'),
            ];

            Session::put('bilgi', $bilgiler);

            if ($r->has('teslimat'))
            {
                $adres = [];

                $adres['isim'] = $r->get('teslimat-isim');
                $adres['tel'] = $r->get('teslimat-tel');
                $adres['vergi_d'] = $r->get('teslimat-vergi_d');
                $adres['vergi_n'] = $r->get('teslimat-vergi_n');
                $adres['adres'] = $r->get('teslimat-adres');
                $adres['ilce'] = \DB::table('ilce')->find($r->get('teslimat-ilce'))->isim;
                $adres['il'] = \DB::table('il')->find($r->get('teslimat-il'))->isim;

                Session::put('teslimat', implode(' ', array_filter($adres)));

                if (Cookie::has('uye'))
                {
                    $kontrol = false;

                    $eski = Adres::where('uye_id', $uye_id)
                                ->where('tanim', $r->get('teslimat-tanim'))
                                ->first();

                    if ($eski)
                    {
                        foreach ($eski as $name => $value)
                        {
                            if ($r->has('teslimat-'. $name))
                            {
                                if ($adres[$name] != $eski->$name)

                                    $kontrol = true;
                            }
                        }

                        if ($kontrol) $eski->update($adres);
                    }

                    else
                    {
                        $adres['uye_id'] = $uye_id;

                        $adres['tanim'] = $r->get('teslimat-tanim');

                        Adres::create($adres);
                    }
                }
            }

            else Session::forget('teslimat');
        }

        else
        {
            if ($r->has('il_id'))
            {
                $ilceler = \DB::table('ilce')->where('il_id', $r->get('il_id'))->orderBy('isim')->get();

                foreach ($ilceler as $ilce) echo '<option value="'. $ilce->id .'">'. $ilce->isim .'</option>';
            }

            else if ($r->has('adres_id'))
            {
                $adres = Adres::find($r->get('adres_id'));

                if (!$adres) return false;

                if (Cookie::has('uye') && $adres->uye_id != $uye_id) return false;

                $select = 'adres.tanim, adres.isim, adres.tel, il.id as il, ilce.id as ilce';
                $select .= ', adres.vergi_d, adres.vergi_n, adres.adres';

                return Adres::where('adres.id', $r->get('adres_id'))
                            ->selectRaw($select)
                            ->join('il', 'il.isim', '=', 'adres.il')
                            ->join('ilce', 'ilce.isim', '=', 'adres.ilce')
                            ->first()
                            ->toArray();
            }
        }
    }
}
