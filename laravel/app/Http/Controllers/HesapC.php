<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Siparis;
use App\Detay;
use App\Adres;
use App\Uye;

use Cookie;

class HesapC extends Controller
{
    public function siparis($id = null)
    {
        $uye = Cookie::has('uye') ? Uye::find(Cookie::get('uye')->id) : new Uye;

        if ($id)
        {
            $siparis = $data['siparis'] = Siparis::find($id);

            if (!$siparis->id) return redirect('hesap/siparis');

            if ($siparis->uye_id != $uye->id) return redirect('hesap/siparis');

            if ($siparis->sil) return redirect('hesap/siparis');

            $data['urunler'] = Detay::where('siparis_id', $siparis->id)->orderBy('sira')->get();

            return view('hesap.siparis', $data);
        }

        else
        {
            $data['siparisler'] = Siparis::orderBy('tarih', 'desc')
                                         ->where('uye_id', $uye->id)
                                         ->get();

            return view('hesap.siparisler', $data);
        }
    }

    public function uyelik(Request $r)
    {
        $uye = $data['uye'] = Cookie::has('uye') ? Uye::find(Cookie::get('uye')->id) : new Uye;

        if ($r->isMethod('post'))
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            $columns = ['isim', 'mail', 'tel'];

            foreach ($columns as $column) $uye->$column = $r->get($column);

            $kontrol = Uye::where('mail', $uye->mail)->where('id', '!=', $uye->id)->count();

            if ($kontrol > 0) 
            {
                $result['message'] = 'Mail adresi başka üye tarafından kullanılıyor.';

                goto git;
            }

            try { $uye->save(); } 
            
            catch (\Exception $e) { return $e->getMessage(); }

            $result['status'] = '<i class="fas fa-check"></i> Başarılı';

            $result['message'] = 'Bilgileriniz başarıyla kaydedildi.';

            git: return $result;
        }

        else return view('hesap.uyelik', $data);
    }

    public function adres(Request $r)
    {
        $uye = Cookie::has('uye') ? Uye::find(Cookie::get('uye')->id) : new Uye;

        if ($r->isMethod('post'))
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            $adres = $r->has('id') ? Adres::find($r->get('id')) : new Adres;

            if ($adres->id && $adres->uye_id != $uye->id) return false;

            if ($r->get('yap') == 'Kaydet')
            {
                $columns = ['tanim', 'isim', 'tel', 'vergi_d', 'vergi_n', 'adres']; 

                foreach ($columns as $column) $adres->$column = $r->get($column);

                $kontrol = Adres::where('uye_id', $uye->id)
                                    ->where('sil', 0)
                                    ->where('tanim', $adres->tanim)
                                    ->where('id', '!=', $adres->id)
                                    ->count();

                if ($kontrol > 0)
                {
                    $result['message'] = 'Adres tanımı kullanılıyor.';

                    goto git;
                }

                $adres->ilce = \DB::table('ilce')->find($r->get('ilce'))->isim;
                $adres->il = \DB::table('il')->find($r->get('il'))->isim;

                $adres->uye_id = $uye->id;

                try { $adres->save(); } 
                
                catch (\Exception $e) { return $e->getMessage(); }

                $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                $result['message'] = 'Adres başarıyla kaydedildi.';

                $result['go'] = url('hesap/adres?no='. $adres->id);
            }

            else if ($r->get('yap') == 'Sil')
            {
                if (!$adres->id) return false;

                try { $adres->sil = 1; $adres->save(); } 
                
                catch (\Exception $e) { return $e->getMessage(); }

                $result['status'] = '<i class="fas fa-check"></i> Başarılı';

                $result['message'] = 'Adres başarıyla silindi.';

                $result['go'] = url('hesap/adres');
            }

            else return false;

            git: return $result;
        }

        else 
        {
            $data['adresler'] = Adres::where('uye_id', $uye->id)
                                     ->where('sil', 0)
                                     ->orderBy('isim')
                                     ->get();

            return view('hesap.adres', $data);
        }
    }

    public function sifre(Request $r)
    {
        $uye = Cookie::has('uye') ? Uye::find(Cookie::get('uye')->id) : new Uye;

        if ($r->isMethod('post'))
        {
            $result['status'] = '<i class="fas fa-exclamation"></i> Uyarı';

            if (md5($r->get('eski')) != $uye->sifre)
            {
                $result['message'] = 'Mevcut şifreniz hatalı.';

                goto git;
            }

            if ($r->get('sifre') != $r->get('tekrar'))
            {
                $result['message'] = 'Şifreler uyuşmuyor.';

                goto git;
            }

            $uye->sifre = md5($r->get('sifre'));

            try { $uye->save(); } 
            
            catch (\Exception $e) { return $e->getMessage(); }

            $result['status'] = '<i class="fas fa-check"></i> Başarılı';

            $result['message'] = 'Şifreniz başarıyla değiştirildi.';

            git: return $result;
        }

        else return view('hesap.sifre');
    }
}
