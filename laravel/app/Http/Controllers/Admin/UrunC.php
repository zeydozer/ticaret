<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use App\Kategori;
use App\Urun;
use App\Foto;
use App\Siparis;

use DB;

class UrunC extends Controller
{
    public function kategori(Request $r, $id = null)
    {
        $kategori = $data['gelen'] = $id ? Kategori::find($id) : new Kategori;

        if ($r->isMethod('post'))
        {
            if ($r->get("yap") == 'Kaydet')
            {
                if ($r->hasFile('foto'))
                {
                    $foto = Controller::file($r->file('foto'));
                    
                    if (!$foto[0]) return 'alert("'. $foto[1] .'")';
                    
                    File::delete('img/'. $kategori->foto);

                    $kategori->foto = mt_rand() .'.'. $foto[1]->getClientOriginalExtension();
                    
                    $r->file('foto')->move('img/', $kategori->foto);
                }

                $columns = ['bagli_id', 'isim', 'sira'];

                foreach ($columns as $column) $kategori->$column = $r->get($column);

                $kategori->url = Controller::url('kategori', $kategori);

                $kategori->ana = $r->has('ana') ? 1 : 0;

                $kategori->save();

                return 'alert("Kaydedildi."); location.reload();';
            }

            else if ($r->get("yap") == 'Sil')
            {
                $GLOBALS['kategoriler'] = null;

                $kategoriler = $this->getir($kategori->id);
                
                $kategoriler[$kategori->id] = $kategori->isim;

                foreach ($kategoriler as $id => $isim)
                {
                    $temp = Kategori::find($id);

                    File::delete('img/'. $temp->foto);

                    $temp->delete();
                    
                    Urun::where('kat_id', $id)->update(['sil' => 1]);
                }

                return 'alert("Silindi."); location.href = "'. url('admin/kategori') .'";';
            }
        }

        else
        {
            $data['kategoriler'] = $this->getir();

            return view('admin.kategori', $data);
        }
    }

    public static function getir($bagli_id = null, $isim = null, $reset = false)
    {  
        global $kategoriler; if ($reset) $kategoriler = [];

        foreach (Kategori::where('bagli_id', $bagli_id)->orderBy('sira')->get() as $kategori)
        {
            $kategoriler[$kategori->id] = $isim ? $isim .' > '. $kategori->isim : $kategori->isim;

            self::getir($kategori->id, $kategoriler[$kategori->id]);
        }

        return $kategoriler;
    }

    public function liste(Request $r)
    {
        $sort = $data['sira'] = $r->has('sira') ? explode(' ', $r->get('sira')) : ['id', 'desc'];

        $goster = $data['goster'] = 25; $sayfa = $r->has('sayfa') ? $r->get('sayfa') : 1;
        
        $limit = $data['limit'] = ($sayfa * ($goster + 1)) - ($sayfa + $goster); 

        $where = [];

        if ($r->has('aranan'))
        {
        	$temp[] = 'urun.isim like "%'. $r->get('aranan') .'%"';
            $temp[] = 'urun.marka like "%'. $r->get('aranan') .'%"';
            $temp[] = 'kategori.isim like "%'. $r->get('aranan') .'%"';
        	
        	$where[] = '('. implode(' OR ', $temp) .')';
        }

        if ($r->has('kat_id')) $where[] = 'urun.kat_id = '. $r->get('kat_id');

        $tip = $r->has('tip') ? $r->get('tip') : 'hepsi';

        if ($tip == 'indirimli') $where[] = 'urun.indirim > 0';
        if ($tip == 'one-cikan') $where[] = 'urun.vitrin = 1';
        if ($tip == 'yeni-gelen') $where[] = 'urun.yeni = 1';
        if ($tip == 'hazir-paket') $where[] = 'urun.set is not null';
        if ($tip == 'paket-ozel') $where[] = 'urun.paket = 1';
        
        if ($tip == 'arsiv') $where[] = 'urun.sil = 1'; else if ($tip != 'hepsi') $where[] = 'urun.sil = 0';

        if (count($where) == 0) $where = '1 = 1';

        else $where = implode(' AND ', $where);

        $data['toplam'] = Urun::leftJoin('kategori', 'urun.kat_id', '=', 'kategori.id')
                              ->selectRaw('urun.*, kategori.isim as katg')
                              ->whereRaw($where)
                              ->count();

        $data['urunler'] = Urun::leftJoin('kategori', 'urun.kat_id', '=', 'kategori.id')
                               ->selectRaw('urun.*, kategori.isim as katg')
                               ->whereRaw($where)
                               ->orderBy($sort[0], $sort[1])
                               ->offset($limit)
                               ->limit($goster)
                               ->get();

        $data['sayfala'] = Controller::sayfala($data['toplam'], $goster, $sayfa);

        return view('admin.urunler', $data);
    }

    public function detay(Request $r, $id = null)
    {
        $data['gelen'] = $urun = $id ? Urun::find($id) : new Urun;

        if (!$urun) return redirect('admin/urun');

        if ($r->isMethod('post'))
        {
            if ($r->get('yap') == 'Kaydet')
            {
                $columns = ['isim', 'kat_id', 'fiyat', 'indirim', 'marka', 'on_aciklama', 
                            'aciklama', 'stok', 'kod', 'video'];

                foreach ($columns as $column)

                    $urun->$column = $r->has($column) ? trim($r->get($column)) : null;

                if (!$urun->stok) $urun->stok = 0;

                $urun->vitrin = $r->has('vitrin') ? 1 : 0;
                $urun->yeni = $r->has('yeni') ? 1 : 0;
                $urun->ana = $r->has('ana') ? 1 : 0;
                $urun->paket = $r->has('paket') ? 1 : 0;

                $urun->url = Controller::url('urun', $urun);

                if ($r->hasFile('profil'))
                {
                    $profil = Controller::file($r->file('profil'));
                        
                    if (!$profil[0]) return 'alert("'. $profil[1] .'")';
                }
                
                if ($r->hasFile('foto'))
                {
                    foreach ($r->file('foto') as $foto)
                    {
                        $foto = Controller::file($foto);
                        
                        if (!$foto[0]) return 'alert("'. $foto[1] .'")';
                    }
                }

                $temp = $urun->foto ? (array) json_decode($urun->foto) : [];

                if ($r->hasFile('foto-a'))
                {
                    $i = count($temp); $temp_d = [];

                    foreach ($r->file('foto-a') as $j => $foto)
                    {
                        $foto = Controller::file($foto); $i++;

                        if (!$foto[0]) return 'alert("'. $foto[1] .'")';

                        else
                        {
                            $temp[$i] = mt_rand() .'.'. $foto[1]->getClientOriginalExtension();

                            $temp_d[$j] = $temp[$i];
                        }
                    }
                }

                if ($r->has('foto-sil-a'))
                {
                    foreach ($r->get('foto-sil-a') as $foto)
                    {
                        $temp = array_filter($temp, function($var) use ($foto)
                        {
                            return ($var != $foto);
                        });
                    }
                }

                $urun->foto = count($temp) > 0 ? json_encode($temp) : null;

                $teknik = [];

                foreach ($r->get('ozel') as $i => $ozel)
                {
                    $deger = $r->get('deger')[$i];

                    if (!$ozel) $ozel = "-";
                    if (!$deger) $deger = "-";

                    $teknik[$ozel] = $deger;
                }

                if (count($teknik) == 1 && !$r->get('ozel')[0] && !$r->get('deger')[0]) $teknik = [];

                $urun->teknik = count($teknik) > 0 ? json_encode($teknik) : null;
                
                if ($r->has('ozellik'))
                {   
                    $temp = array_filter($r->get('ozellik'));

                    $urun->ozellik = count($temp) > 0 ? json_encode($temp) : null;
                }

                else $urun->ozellik = null;

                if ($r->has('set'))
                {   
                    $temp = array_filter($r->get('set'));

                    $urun->set = count($temp) > 0 ? json_encode($temp) : null;
                }

                else $urun->set = null;

                $urun->save();

                if ($urun->paket)
                {
                    $set = Urun::find($urun->set_id);

                    $ids = json_decode($set->set);

                    $set->fiyat = Urun::whereIn('id', $ids)->sum('fiyat');

                    $case_w = 

                    'SUM(CASE
                        WHEN indirim > 0 THEN indirim
                        ELSE fiyat
                    END) AS toplam';

                    $set->indirim = Urun::whereIn('id', $ids)->selectRaw($case_w)->first()->toplam;

                    $set->save();
                }

                if ($urun->set)
                {
                    $ids = json_decode($urun->set);

                    Urun::whereIn('id', $ids)->update(['set_id' => $urun->id]);
                }

                if ($r->hasFile('profil'))
                {
                    $profil = mt_rand() .'.'. $profil[1]->getClientOriginalExtension();

                    $r->file('profil')->move('img', $profil);

                    Foto::where('urun_id', $urun->id)->update(['profil' => 0]);

                    Foto::create(['urun_id' => $urun->id, 'deger' => $profil, 'profil' => 1]);
                }

                else
                {
                    Foto::where('urun_id', $urun->id)->update(['profil' => 0]);

                    if ($r->has('profil-sec'))
                
                        Foto::where('deger', $r->get('profil-sec'))->update(['profil' => 1]);
                }

                if ($r->hasFile('foto'))
                {
                    foreach ($r->file('foto') as $i => $foto)
                    {
                        $deger = mt_rand() .'.'. $foto->getClientOriginalExtension();

                        $r->file('foto')[$i]->move('img', $deger);

                        Foto::create(['urun_id' => $urun->id, 'deger' => $deger]);
                    }
                }

                if ($r->has('foto-sil'))
                {
                    foreach ($r->get('foto-sil') as $foto)
                    {
                        Foto::where('deger', $foto)->delete();

                        File::delete('img/'. $foto);
                    }
                }

                if ($r->hasFile('foto-a'))
                {
                    foreach ($temp_d as $i => $deger)
                    
                        $r->file('foto-a')[$i]->move('img', $deger);
                }

                if ($r->has('foto-sil-a'))
                {
                    foreach ($r->get('foto-sil-a') as $foto)
                    
                        File::delete('img/'. $foto);
                }

                return 'alert("Kaydedildi."); location.reload();';
            }

            else if ($r->get('yap') == 'Sil')
            {
                $kontrol = \App\Sepet::where('urun_id', $urun->id)->where('siparis', 1)->count();

                if ($kontrol > 0) return 'alert("Ürüne bağlı siparişler var! ('. $kontrol .')")';

                $fotolar = Foto::where('urun_id', $urun->id)->where('profil', 0)->orderBy('sira')->get();

                if (count($fotolar) > 0)
                {
                    foreach ($fotolar as $foto)
                    {
                        File::delete('img/'. $foto->deger);

                        $foto->delete();
                    }
                }

                $fotolar = json_decode($urun->foto);

                if (count($fotolar) > 0)
                {
                    foreach ($fotolar as $foto)
                    
                        File::delete('img/'. $foto);
                }

                DB::table('yorum')->where('urun_id', $urun->id)->delete();

                if ($urun->set) Urun::where('set_id', $urun->id)->update(['set_id' => null]);

                $urun->delete();

                return 'alert("Ürün silindi."); location.href = "'. url('admin/urun') .'";';
            }

            else if ($r->get('yap') == 'Arşive At')
            {
                $urun->sil = 1; $urun->save();

                return 'alert("Arşive atıldı."); location.reload();';
            }

            else if ($r->get('yap') == 'Geri Al')
            {
                $urun->sil = 0; $urun->save();

                return 'alert("Geri Alındı."); location.reload();';
            }

            else return false;
        }

        else
        {
            $data['kategoriler'] = $this->getir();

            $data['fotolar'] = Foto::where('urun_id', $urun->id)->orderBy('sira')->get();

            $data['fotolar_a'] = json_decode($urun->foto);

            $data['teknik'] = $urun->teknik ? json_decode($urun->teknik) : [null => null];
            
            $data['ozellik'] = $urun->ozellik ? json_decode($urun->ozellik) : [null];

            $data['set'] = $r->get('set') == 'true' ? true : false;

            if ($data['set']) 
            {
                $where = 'set_id IS NULL';

                if ($urun->id) $where .= ' OR set_id = '. $urun->id;

                $data['urunler'] = Urun::where('sil', 0)->where('paket', 1)->whereRaw($where)->orderBy('isim')->get();
            }

            $data['set_urun'] = $urun->set ? json_decode($urun->set) : [null];

            return view('admin.urun', $data);
        }
    }

    public function foto(Request $r, $id)
    {
        $urun = Urun::find($id);

        $urun->foto = json_encode($r->all());

        $urun->save();
    }

    public function hizli(Request $r, $id)
    {
        if ($r->isMethod('post'))
        {
            $urun = Urun::find($id);

            if ($r->get('yap') == 'Sil')
            {
                $fotolar = Foto::where('urun_id', $urun->id)->where('profil', 0)->orderBy('sira')->get();

                if (count($fotolar) > 0)
                {
                    foreach ($fotolar as $foto)
                    {
                        File::delete('img/'. $foto->deger);

                        $foto->delete();
                    }
                }

                $fotolar = json_decode($urun->foto);

                if (count($fotolar) > 0)
                {
                    foreach ($fotolar as $foto)
                    
                        File::delete('img/'. $foto);
                }

                DB::table('yorum')->where('urun_id', $urun->id)->delete();

                $urun->delete();

                return 1;
            }

            else if ($r->get('yap') == 'Arşive At')
            {
                $urun->sil = $urun->sil ? 0 : 1; 
                
                $urun->save();

                return 1;
            }

            else return false;
        }

        else
        {
            $urun = Urun::find($id);

            $urun->update([$r->get('name') => $r->get('value')]);

            if ($urun->paket)
            {
                if ($r->get('name') == 'fiyat' || $r->get('name') == 'indirim')
                {
                    $set = Urun::find($urun->set_id);

                    $ids = json_decode($set->set);

                    $set->fiyat = Urun::whereIn('id', $ids)->sum('fiyat');

                    $case_w = 

                    'SUM(CASE
                        WHEN indirim > 0 THEN indirim
                        ELSE fiyat
                    END) AS toplam';

                    $set->indirim = Urun::whereIn('id', $ids)->selectRaw($case_w)->first()->toplam;

                    $set->save();
                }
            }
        }
    }

    public function siparis(Request $r)
    {
        $sort = $data['sira'] = $r->has('sira') ? explode(' ', $r->get('sira')) : ['tarih', 'desc'];

        $goster = $data['goster'] = 25; $sayfa = $r->has('sayfa') ? $r->get('sayfa') : 1;
        
        $limit = $data['limit'] = ($sayfa * ($goster + 1)) - ($sayfa + $goster); $where = '';

        if ($r->has('aranan'))
        {
            $temp[] = 'siparis.isim like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.mail like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.tel like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.odeme like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.sekil like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.fatura like "%'. $r->get('aranan') .'%"';
            $temp[] = 'siparis.teslimat like "%'. $r->get('aranan') .'%"';

            $where = '('. implode(' OR ', $temp) .')';
        }

        $tip = $r->has('tip') ? $r->get('tip') : 'hepsi';

        if ($tip != 'hepsi') 
        {
            if ($where != '') $where .= ' AND ';

            $where .= 'siparis.durum like "%'. $tip .'%"';
        }

        if ($where == '') $where = '1 = 1';

        $data['toplam'] = Siparis::whereRaw($where)->count();

        $data['siparisler'] = Siparis::orderBy($sort[0], $sort[1])
                                     ->whereRaw($where)
                                     ->offset($limit)
                                     ->limit($goster)
                                     ->get();

        $data['sayfala'] = Controller::sayfala($data['toplam'], $goster, $sayfa);

        return view('admin.siparisler', $data);
    }

    public function detay_s(Request $r, $id)
    {
        $siparis = $data['siparis'] = Siparis::find($id);

        if (!$siparis->id) return redirect('admin/siparisler');

        if ($r->isMethod('post'))
        {
            $urunler = \App\Detay::where('siparis_id', $siparis->id)
                                 ->join('sepet', 'sepet.id', '=', 'siparis_d.sepet_id')
                                 ->join('urun', 'urun.id', '=', 'sepet.urun_id')
                                 ->selectRaw('siparis_d.adet, urun.stok, urun.id, siparis_d.isim')
                                 ->get();

            if (in_array($r->get('durum'), ['Onaylandı', 'Kargoya Verildi', 'Tamamlandı']))
            {
                if (in_array($siparis->durum, ['Onay Bekliyor', 'İptal Edildi']))
                {
                    foreach ($urunler as $urun)
                    {
                        if ($urun->stok < $urun->adet)

                            return 'alert("'. $urun->isim .' stok yeterli değil. ('. $urun->stok .')")';
                    }

                    foreach ($urunler as $urun)
                    
                        Urun::find($urun->id)->update(['stok' => $urun->stok - $urun->adet]);
                }
            }

            else
            {
                if (in_array($siparis->durum, ['Onaylandı', 'Kargoya Verildi', 'Tamamlandı']))
                {
                    foreach ($urunler as $urun)
                    
                        Urun::find($urun->id)->update(['stok' => $urun->stok + $urun->adet]);
                }
            }

            $siparis->kargo_no = $r->has('kargo_no') ? $r->get('kargo_no') : null;

            if ($siparis->durum != $r->get('durum'))
            {
                $siparis->durum = $r->get('durum');

                $data = ['konu' => 'siparis', 'siparis' => $siparis];

                $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

                $url = str_replace(['http://', 'https://'], '', url('/'));

                \Mail::send(['html' => 'mailing.durum'], $data, function($msg) use ($siparis, $seo, $url)
                {
                    $msg->to($siparis->mail, $siparis->isim)->subject('Sipariş Takibi');
                    
                    $msg->from('web@'. $url, $seo['author']);
                });
            }

            $siparis->save();

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $data['urunler'] = \App\Detay::where('siparis_id', $siparis->id)->orderBy('sira')->get();

            return view('admin.siparis', $data);
        } 
    }

    public function fiyat(Request $r)
    {
        $ids = array_filter($r->get('ids'));

        $toplam['fiyat'] = Urun::whereIn('id', $ids)->sum('fiyat');

        $case_w = 

        'SUM(CASE
            WHEN indirim > 0 THEN indirim
            ELSE fiyat
        END) AS toplam';

        $toplam['indirim'] = Urun::whereIn('id', $ids)->selectRaw($case_w)->first()->toplam;

        return $toplam;
    }
}
