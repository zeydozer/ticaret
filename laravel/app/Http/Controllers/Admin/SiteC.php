<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

use App\Slide;
use App\Ayar;

class SiteC extends Controller
{
    public function seo(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $seo = [];

            foreach ($r->all() as $name => $value)
            {
                if (in_array($name, ['yap', '_token'])) continue;

                $seo[$name] = $value;
            }

            Ayar::where('id', 11)->update(['data' => json_encode($seo, JSON_NUMERIC_CHECK)]);

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $seo = (array) json_decode(Ayar::find(11)->data);

            return view('admin.seo', ['seo' => $seo]);
        }
    }

    public function slide(Request $r, $id = null)
    {
        $slide = $data['gelen'] = $id ? Slide::find($id) : new Slide;

        if ($r->isMethod('post'))
        {
            if ($r->get("yap") == 'Kaydet')
            {
                if ($r->hasFile('foto'))
                {
                    $foto = Controller::file($r->file('foto'));
                    
                    if (!$foto[0]) return 'alert("'. $foto[1] .'")';
                    
                    File::delete('img/'. $slide->foto);

                    $slide->foto = mt_rand() .'.'. $foto[1]->getClientOriginalExtension();
                    
                    $r->file('foto')->move('img/', $slide->foto);
                }

                $slide->link = $r->has('link') ? $r->get('link'): null;
                
                $slide->sira = $r->get('sira');

                $slide->save();

                return 'alert("Kaydedildi."); location.reload();';
            }

            else if ($r->get("yap") == 'Sil')
            {
                File::delete('img/'. $slide->foto);
        
                $slide->delete();

                return 'alert("Silindi."); location.href = "'. url('admin/ayar/slide') .'";';
            }
        }

        else
        {
            $data['slides'] = Slide::all();

            return view('admin.slide', $data);
        }
    }

    public function iletisim(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $iletisim = [];

            foreach ($r->all() as $name => $value)
            {
                if (in_array($name, ['yap', 'konum', '_token'])) continue;

                $iletisim[$name] = $value;
            }

            $iletisim['adres'] = strip_tags(nl2br($r->get('adres')));

            Ayar::where('id', 1)->update(['data' => json_encode($iletisim, JSON_UNESCAPED_UNICODE)]);

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $iletisim = (array) json_decode(Ayar::find(1)->data);

            return view('admin.iletisim', ['iletisim' => $iletisim]);
        }
    }

    public function odeme(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $odeme = [];

            foreach (['kart', 'havale', 'kapi'] as $name)
            
                $odeme[$name] = $r->has($name) ? 1 : 0;

            Ayar::where('id', 13)->update(['data' => json_encode($odeme, JSON_NUMERIC_CHECK)]);

            $indirim = ['a' => $r->get('a'), 'b' => $r->get('b')];

            Ayar::where('id', 17)->update(['data' => json_encode($indirim, JSON_NUMERIC_CHECK)]);

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $odeme = (array) json_decode(Ayar::find(13)->data);

            $indirim = (array) json_decode(Ayar::find(17)->data);

            return view('admin.odeme', ['odeme' => $odeme, 'indirim' => $indirim]);
        }
    }

    public function pos(Request $r)
    {
        if ($r->isMethod('post'))
        {
            $pos = [];

            foreach ($r->all() as $name => $value)
            {
                if (in_array($name, ['yap', '_token'])) continue;

                $pos[$name] = $value;
            }

            Ayar::where('id', 12)->update(['data' => json_encode($pos, JSON_NUMERIC_CHECK)]);

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $pos = (array) json_decode(Ayar::find(12)->data);

            return view('admin.pos', ['pos' => $pos]);
        }
    }

    public function banka(Request $r, $id = null)
    {
        $banka = $data['gelen'] = $id ? Ayar::find($id) : new Ayar;
        
        $temp = $data['temp'] = $banka->id ? 
        
                json_decode($banka->data) : 
                
                (object) ['isim' => null, 'sube' => null, 'kod' => null, 'iban' => null, 'foto' => null];

        if ($r->isMethod('post'))
        {
            if ($r->get("yap") == 'Kaydet')
            {
                $banka->tip = 'banka';

                if ($r->hasFile('foto'))
                {
                    $foto = Controller::file($r->file('foto'));
                    
                    if (!$foto[0]) return 'alert("'. $foto[1] .'")';
                    
                    File::delete('img/'. $temp->foto);

                    $temp->foto = mt_rand() .'.'. $foto[1]->getClientOriginalExtension();
                    
                    $r->file('foto')->move('img', $temp->foto);
                }

                $temp->isim = $r->has('isim') ? $r->get('isim'): null;
                $temp->sube = $r->has('sube') ? $r->get('sube'): null;
                $temp->kod = $r->has('kod') ? $r->get('kod'): null;
                $temp->iban = $r->has('iban') ? $r->get('iban'): null;
                
                $banka->data = json_encode((array) $temp);
                $banka->data_2 = $r->has('sira') ? $r->get('sira'): 0;
                                
                $banka->save();

                return 'alert("Kaydedildi."); location.reload();';
            }

            else if ($r->get("yap") == 'Sil')
            {
                File::delete('img/'. $temp->foto);

                $banka->delete();

                return 'alert("Silindi."); location.href = "'. url('admin/ayar/banka') .'";';
            }
        }

        else
        {
            $data['bankalar'] = Ayar::where('tip', 'banka')->orderBy('data_2')->get();

            return view('admin.banka', $data);
        }
    }

    public function kargo(Request $r)
    {
        if ($r->isMethod('post'))
        {
            foreach (['kargo', 'kapi', 'ucretsiz'] as $tip)

                Ayar::where('tip', $tip)->update(['data' => $r->get($tip)]);

            return 'alert("Kaydedildi."); location.reload();';
        }

        else
        {
            $data['ayar']['kargo'] = Ayar::where('tip', 'kargo')->first()->data;
            $data['ayar']['kapi'] = Ayar::where('tip', 'kapi')->first()->data;
            $data['ayar']['ucretsiz'] = Ayar::where('tip', 'ucretsiz')->first()->data;

            $data['ayar'] = (object) $data['ayar'];

            return view('admin.kargo', $data);
        }
    }
}
