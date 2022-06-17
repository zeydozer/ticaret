<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Uye;

use Cookie;
use Mail;

class HesapC extends Controller
{
    public function giris(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $uye = Uye::where('tip', 'admin')->where('mail', $r->get('mail'))->where('sifre', md5($r->get('sifre')))->first();
            
            if (count($uye) > 0)
            {
                Cookie::queue(Cookie::forever('admin', json_decode(json_encode($uye))));
                
                return 'location.href = "'. url('admin') .'"';
            }
    
            else return 'alert("Girdiğiniz bilgiler hatalı!");';
        }

        else return view('admin.hesap');
    }

    public function unuttum(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $uye = Uye::where('tip', 'admin')->where('mail', $r->get('mail'))->first();
            
            if (count($uye) > 0)
            {
                $uye->token = md5(mt_rand());

                $data = ['konu' => 'unuttum', 'isim' => $uye->isim, 'token' => $uye->token];

                $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                $url = str_replace(['http://', 'https://'], '', url('/'));

                Mail::send(['html' => 'admin.mail'], $data, function($msg) use ($uye, $seo, $url)
                {
                    $msg->to($uye->mail, $uye->isim)->subject('Şifremi Unuttum');
                    
                    $msg->from('web@'. $url, $seo['author'] .' Panel');
                });

                $uye->save();

                return 'alert("Bağlantı mail adresinize gönderildi."); location.href="'. url('admin/giris') .'";';
            }
    
            else return 'alert("Mail adresi bulunamadı!");';
        }

        else return view('admin.hesap');
    }

    public function sifirla(Request $r, $token)
    {
        $kontrol = Uye::where('tip', 'admin')->where('token', $token)->count();
        
        if ($kontrol == 0) return redirect('admin/unuttum');

        if ($r->isMethod('post'))
        {
            $uye = Uye::where('tip', 'admin')->where('token', $token)->first();

            if (is_null($uye)) return 'alert("Yönetici bulunamadı!")';

            if ($r->get('sifre') != $r->get('tekrar')) return 'alert("Şifreler uyuşmuyor!")';

            $uye->sifre = md5($r->get('sifre')); $uye->token = null;

            $data = ['konu' => 'sifirla', 'isim' => $uye->isim, 'sifre' => $r->get('sifre')];

            $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

            $url = str_replace(['http://', 'https://'], '', url('/'));

            Mail::send(['html' => 'admin.mail'], $data, function($msg) use ($uye, $seo, $url)
            {
                $msg->to($uye->mail, $uye->isim)->subject('Şifremi Sıfırla');
                
                $msg->from('web@'. $url, $seo['author'] .' Panel');
            });

            $uye->save();

            return 'alert("Şifreniz başaryla değiştirildi."); location.href="'. url('admin/giris') .'";';
        }

        else return view('admin.hesap');
    }

    public function cikis()
    {
        if (Cookie::get('admin'))
        
            Cookie::queue(Cookie::forget('admin'));
        
        return redirect()->back();
    }
}
