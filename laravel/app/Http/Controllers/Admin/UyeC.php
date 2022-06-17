<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Uye;

use DB;

class UyeC extends Controller
{
    public function liste(Request $r)
    {
        $sort = $data['sira'] = $r->has('sira') ? explode(' ', $r->get('sira')) : ['id', 'desc'];

        $goster = $data['goster'] = 25; $sayfa = $r->has('sayfa') ? $r->get('sayfa') : 1;
        
        $limit = $data['limit'] = ($sayfa * ($goster + 1)) - ($sayfa + $goster); 

        $where = 'tip != "admin"';

        if ($r->has('aranan'))
        {
        	$temp[] = 'isim like "%'. $r->get('aranan') .'%"';
        	$temp[] = 'mail like "%'. $r->get('aranan') .'%"';
        	$temp[] = 'tel like "%'. $r->get('aranan') .'%"';
        	
        	$where .= ' AND ('. implode(' OR ', $temp) .')';
        }

        $tip = $r->has('tip') ? $r->get('tip') : 'hepsi';

        if ($tip == 'aktif' ) $where .= ' AND sil = 0';
        if ($tip == 'onayli' ) $where .= ' AND onay = 1';
        if ($tip == 'onaysiz' ) $where .= ' AND onay = 0';
        if ($tip == 'arsiv' ) $where .= ' AND sil = 1';

        $data['toplam'] = Uye::whereRaw($where)->count();

        $data['uyeler'] = Uye::whereRaw($where)
                             ->orderBy($sort[0], $sort[1])
                             ->offset($limit)
                             ->limit($goster)
                             ->get();

        $data['sayfala'] = Controller::sayfala($data['toplam'], $goster, $sayfa);

        return view('admin.uyeler', $data);
    }

    public function detay(Request $r, $id = null)
    {
        $data['gelen'] = $uye = $id ? Uye::find($id) : new Uye;

        if (!$uye) return redirect('admin/uye');

        if ($r->isMethod('post'))
        {
            if ($r->get('yap') == 'Kaydet')
            {
                foreach (['isim', 'mail', 'tel'] as $name => $column)

                    $uye->$column = trim($r->get($column));

                if ($r->has('sifre')) $uye->sifre = md5($r->get('sifre'));

                $kontrol = Uye::where('mail', $uye->mail);

                if ($uye->id) $kontrol = $kontrol->where('id', '!=', $uye->id);

                $kontrol = $kontrol->count();

                if ($kontrol > 0) return 'alert("Mail adresini başka üye kullanıyor!")';                    

                $uye->onay = $r->has('onay') ? 1 : 0;

                $uye->save();

                return 'alert("Kaydedildi."); location.reload();';
            }

            else if ($r->get('yap') == 'Sil')
            {
                $uye->sil = 1; $uye->save();

                return 'alert("Silindi."); location.href = "'. url('admin/uye') .'";';
            }

            else if ($r->get('yap') == 'Geri Al')
            {
                $uye->sil = 0; $uye->save();

                return 'alert("Geri Alındı."); location.href = "'. url('admin/uye') .'";';
            }

            else return false;
        }

        else return view('admin.uye', $data);
    }

    public function yorum(Request $r)
    {
        if ($r->isMethod('get'))
        {
            $sort = $data['sira'] = $r->has('sira') ? explode(' ', $r->get('sira')) : ['tarih', 'desc'];

            $goster = $data['goster'] = 25; $sayfa = $r->has('sayfa') ? $r->get('sayfa') : 1;
            
            $limit = $data['limit'] = ($sayfa * ($goster + 1)) - ($sayfa + $goster); 

            $data['toplam'] = DB::table('yorum')->count();

            $data['yorumlar'] = DB::table('yorum')
                                  ->orderBy($sort[0], $sort[1])
                                  ->join('urun', 'yorum.urun_id', '=', 'urun.id')
                                  ->selectRaw('yorum.*, urun.id as id_u, urun.isim as isim_u')
                                  ->offset($limit)
                                  ->limit($goster)
                                  ->get();

            $data['sayfala'] = Controller::sayfala($data['toplam'], $goster, $sayfa);

            return view('admin.yorum', $data);
        }

        else
        {   
            $yorum = DB::table('yorum')->find($r->get('id'));

            $guncel = DB::table('yorum')->where('id', $r->get('id'));

            if ($r->get('konu') == 'onay')
            {
                $guncel->update(['onay' => $yorum->onay ? 0 : 1]);

                return 1;
            }

            else if ($r->get('konu') == 'sil')
            {
                $guncel->delete(); 
                
                return 1;
            }

            else return false;
        }
    }
}
