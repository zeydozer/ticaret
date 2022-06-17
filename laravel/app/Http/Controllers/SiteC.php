<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Urun;

use Mail;

class SiteC extends Controller
{
    public function anasayfa()
    {
        $data['slides'] = \App\Slide::orderBy('sira')->get();
        
        $case_w = '*, (CASE WHEN indirim > 0 THEN 100 - (indirim / fiyat * 100) ELSE 0 END) AS oran';

        $urunler = Urun::selectRaw($case_w)->where('sil', 0)->orderBy('id', 'desc')->limit(10);
        $data['one_cikan'] = $urunler->where('vitrin', 1)->where('set_id', null)->get();

        $urunler = Urun::selectRaw($case_w)->where('sil', 0)->orderBy('id', 'desc')->limit(10);
        $data['yeni_gelen'] = $urunler->where('yeni', 1)->where('set_id', null)->get();

        $data['ana_urun'] = Urun::selectRaw($case_w)
                                ->where('sil', 0)
                                ->where('ana', 1)
                                ->orderBy('id', 'desc')
                                ->where('set_id', null)
                                ->limit(2)
                                ->get();

        return view('ana', $data);
    }

    public function iletisim(Request $r)
    {
        if ($r->isMethod('get'))
        {
            $iletisim = \App\Ayar::where('tip', 'iletisim')->first()->data;

            $data['iletisim'] = json_decode($iletisim);

            return view('iletisim', $data);
        }

        else 
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            $mesaj = new \stdClass();

            foreach ($r->all() as $name => $value)
            {
                if ($name == '_token') continue;

                $mesaj->$name = $r->has($name) ? $value : null;
            }

            try
            {
                $data = ['konu' => 'iletisim', 'mesaj' => $mesaj];

                $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                $url = str_replace(['http://', 'https://'], '', url('/'));

                Mail::send(['html' => 'mail'], $data, function($msg) use ($mesaj, $seo, $url)
                {
                    $msg->to('info@noone.com.tr', $seo['author']);
                    $msg->subject('Bize Ulaşın');
                    $msg->cc('zeyd@'. $url, 'Zeyd ÖZER');
                    $msg->from('web@'. $url, $seo['author']);
                });

                $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                $result['message'] = 'Mesajınız başarıyla iletildi.';
            }

            catch (\Exception $e) { $result['message'] = $e->getMessage(); }

            git: return $result;
        }
    }
}
