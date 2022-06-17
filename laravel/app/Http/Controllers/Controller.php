<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Socialite;
use Session;
use DB;

$pieces = [];

$keyspace = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$max = mb_strlen($keyspace, '8bit') - 1;

for ($i = 0; $i < 45; ++$i) $pieces[] = $keyspace[random_int(0, $max)];

$rand = implode('', $pieces);

if (!Session::has('id')) Session::put('id', $rand);

date_default_timezone_set('Europe/Istanbul');

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(Request $r)
    {
        //
    }

    public function sitemap()
    {
        header('Content-type: text/xml');

        echo

        '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $xml = simplexml_load_string(file_get_contents(url('general.xml'))) or die('Error: Cannot create object');
        
        foreach ($xml as $data)
        {
            foreach (['urun/', 'urunler/', 'urunler?marka[]='] as $pass)
            {
                if (strpos($data->loc, $pass) !== false)

                    goto next;
            }

            echo

            '<url>
                <loc>'. htmlspecialchars($data->loc) .'</loc>
                <lastmod>'. $data->lastmod .'</lastmod>
                <priority>'. $data->priority .'</priority>
            </url>';

            next:
        }

        $datas = \App\Urun::where('sil', 0)->orderBy('isim')->get();

        if (count($datas) > 0) :

            foreach ($datas as $data)
            {
                echo

                '<url>
                    <loc>'. url('urun/'. htmlspecialchars($data->url)) .'</loc>
                    <lastmod>'. date('Y-m-d') .'T'. date('H:i:s+00:00') .'</lastmod>
                    <priority>0.8</priority>
                </url>';
            }

        endif;

        $datas = \App\Kategori::orderBy('isim')->get();

        if (count($datas) > 0) :

            foreach ($datas as $data)
            {
                echo

                '<url>
                    <loc>'. url('urunler/'. htmlspecialchars($data->url)) .'</loc>
                    <lastmod>'. date('Y-m-d') .'T'. date('H:i:s+00:00') .'</lastmod>
                    <priority>0.8</priority>
                </url>';
            }

        endif;

        $datas = \App\Urun::selectRaw('DISTINCT marka AS isim')->where('sil', 0)->where('marka', '!=', null)->orderBy('marka')->get();

        if (count($datas) > 0) :

            foreach ($datas as $data)
            {
                echo

                '<url>
                    <loc>'. url('urunler?marka[]='. urlencode(htmlspecialchars($data->isim))) .'</loc>
                    <lastmod>'. date('Y-m-d') .'T'. date('H:i:s+00:00') .'</lastmod>
                    <priority>0.8</priority>
                </url>';
            }

        endif;

        echo

        '</urlset>';
    }

    public static function kat_getir($bagli_id = null, $isim = null, $reset = false)
    {  
        global $kategoriler; if ($reset) $kategoriler = [];

        foreach (\App\Kategori::where('bagli_id', $bagli_id)->orderBy('sira')->get() as $kategori)
        {
            $kategoriler[$kategori->id] = $isim ? $isim .' > '. $kategori->isim : $kategori->isim;

            self::kat_getir($kategori->id, $kategoriler[$kategori->id]);
        }

        return $kategoriler;
    }

    public function sira(Request $r, $tip)
    {
        if (in_array($tip, ['kategori', 'slide', 'foto']))
        {
            foreach ($r->all() as $id => $sira)
            
                DB::table($tip)->where('id', $id)->update(['sira' => $sira]);
        }

        else return false;

        return 'tamam';
    }

    public static function url($table, $data, $limit = 255)
    {
        $turkce = array("ş", "Ş", "ı", "ü", "Ü", "ö", "Ö", "ç", "Ç", "ş", "Ş", "ı", "ğ", "Ğ", "İ", "ö", "Ö", "Ç", "ç", "ü", "Ü");
        $duzgun = array("s", "S", "i", "u", "U", "o", "O", "c", "C", "s", "S", "i", "g", "G", "I", "o", "O", "C", "c", "u", "U");
        
        $text = str_replace($turkce, $duzgun, $data->isim);
        
        $text = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i",  " ",  $text);
        
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        
        $text = trim($text, '-');
        
        $text = mb_strtolower($text);
        
        $text = preg_replace('~[^-\w]+~', '', $text);
        
        if (empty($text)) return false;

        $kontrol = DB::table($table)->where('url', $text)->where('id', '!=', $data->id)->count();
        
        if ($kontrol > 0) $text .= '-'. md5(mt_rand());

        return $text;
    }

    public static function file($data)
    {
        $file_type = strtolower($data->getClientOriginalExtension());
        
        if ($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif")
        
            return array(false, 'Dosya jpg, jpeg, gif veya png formatında olmalı!');

        if ($data->getSize() > 2048000)

            return array(false, 'Dosya boyutu max. 2MB olmalı!');

        return array(true, $data);
    }

    public static function sayfala($adet, $goster, $sayfa, $url = null)
    {
        $sonuc = '';

        if ($adet > $goster) 
        {
            $sayfa_no = ceil($adet / $goster);

            if ($sayfa > 1)

                $sonuc .= '<a git="'. ($sayfa - 1) .'"><i class="fa fa-arrow-left"></i></a>';
            
            $sonuc .= '<select class="form-control sayfa">';

            for ($i = 1; $i <= $sayfa_no; $i++) 
            {
                if ($i == $sayfa) 
                
                    $sonuc .= '<option selected value="'. $i .'">'. $i .'</option>';

                else $sonuc .= '<option value="'. $i .'">'. $i .'</option>';
            }

            $sonuc .= '</select>';

            if ($sayfa < $sayfa_no)

                $sonuc .= '<a git="'. ($sayfa + 1) .'"><i class="fa fa-arrow-right"></i></a>';        	
        }

        return $sonuc;
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $r)
    {
        var_dump($r->all());
    }

    public function integrate_sync(Request $r)
    {
        $temps = DB::connection('integrated')
            ->table('product AS p')
            ->leftJoin('brand AS b', 'b.id', '=', 'p.brand_id')
            ->leftJoin('category AS c', function($join)
            {
                $join->on('c.id', '=', 'p.category_id')
                    ->where('c.del', 0);
            })
            ->select('p.*', 'b.name AS brand', 'c.id AS cat_id')
            ->get();

        foreach ($temps as $temp)
        {
            $data = \App\Urun::find($temp->id);

            if (!$data)

                $data = new \App\Urun;

            $columns = 
            [
                'id' => 'id',
                'code' => 'kod',
                'name' => 'isim',
                'price' => 'fiyat',
                'discount' => 'indirim',
                'stock' => 'stok',
                'pre_description' => 'on_aciklama',
                'description' => 'aciklama',
                'brand' => 'marka',
                'category_id' => 'kat_id',
                'keyword' => 'keyword',
                'del' => 'sil',
            ];

            foreach ($columns as $key => $column)

                $data->$column = $temp->$key;

            $temps_b = DB::connection('integrated')
                ->table('product_a')
                ->where('product_a.product_id', $temp->id)
                ->join('attribute', 'attribute.id', '=', 'product_a.attribute_id')
                ->select('attribute.name', 'product_a.value')
                ->get();

            if (count($temps_b) > 0)
            {
                $data_b = $temp->bullet ? json_decode($temp->bullet, true) : [];

                foreach ($temps_b as $temp_b)
                
                    $data_b[] = $temp_b->name .': '. $temp_b->value;

                $data->ozellik = json_encode($data_b);
            }

            $data->url = self::url('urun', $data);

            $data->save();
        }
        
        $temps = DB::connection('integrated')->table('category')->where('del', 0)->get();

        foreach ($temps as $temp)
        {
            $data = \App\Kategori::find($temp->id);

            if (!$data)

                $data = new \App\Kategori;

            $columns = 
            [
                'id' => 'id',
                'root_id' => 'bagli_id',
                'name' => 'isim',
            ];

            foreach ($columns as $key => $column)

                $data->$column = $temp->$key;

            $kontrol = DB::connection('integrated')->table('category')->find($temp->root_id);

            if (!$kontrol) 

                $data->bagli_id = null;

            else if ($kontrol->del) 

                $data->bagli_id = null;

            $data->url = self::url('kategori', $data);

            $data->save();
        }

        $temps = DB::connection('integrated')->table('photo')->get();

        foreach ($temps as $temp)
        {
            $data = \App\Foto::find($temp->id);

            if (!$data)

                $data = new \App\Foto;

            $columns = 
            [
                'id' => 'id',
                'product_id' => 'urun_id',
                'name' => 'deger',
                'profile' => 'profil',
                'order' => 'sira',
            ];

            foreach ($columns as $key => $column)

                $data->$column = $temp->$key;

            $data->save();
        }
    }

    public function taksit(Request $r)
    {
        $pos_info = json_decode(\App\Ayar::where('tip', 'pos')->first()->data, true);

        require_once(app_path('Http/Controllers/Iyzipay/IyzipayBootstrap.php'));

        \IyzipayBootstrap::init();

        $options = new \Iyzipay\Options();
        $options->setApiKey($pos_info['api_key']);
        $options->setSecretKey($pos_info['secret_key']);
        $options->setBaseUrl("https://api.iyzipay.com");

        $request = new \Iyzipay\Request\RetrieveInstallmentInfoRequest();
        // $request->setLocale(\Iyzipay\Model\Locale::TR);
        // $request->setConversationId("123456789");
        $request->setBinNumber($r->get('number'));
        
        $request->setPrice($r->get('price'));

        $installmentInfo = \Iyzipay\Model\InstallmentInfo::retrieve($request, $options);

        if ($installmentInfo->getStatus() == 'success') :

            $installmentInfo = json_decode($installmentInfo->getRawResult());

            return isset($installmentInfo->installmentDetails[0]->installmentPrices) ? 

                $installmentInfo->installmentDetails[0]->installmentPrices :

                false;

        else : return false;

        endif;
    }

    public function fb_feed()
    {
        header('Content-type: text/xml');

        $seo = json_decode(\App\Ayar::where('tip', 'seo')->first()->data, true);

        echo

        '<?xml version="1.0"?>
        <rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
            <channel>
                <title>'. $seo['author'] .'</title>
                <link>'. url('/') .'</link>
                <description>'. $seo['description'] .'</description>';

        $datas = \App\Urun::where('sil', 0)->orderBy('id', 'DESC')->get();

        if (count($datas) > 0) :

            $kategoriler = self::kat_getir();

            foreach ($datas as $data)
            {
                echo

                '<item>
                    <g:id>'. $data->id .'</g:id>
                    <g:title><![CDATA['. $data->isim .']]></g:title>
                    <g:description><![CDATA['. $data->icerik() .']]></g:description>
                    <g:availability>'. $data->stok_durum() .'</g:availability>
                    <g:condition>new</g:condition>
                    <g:price>'. $data->fiyat .'</g:price>
                    <g:link><![CDATA['. url('urun/'. $data->url) .']]></g:link>
                    <g:image_link><![CDATA['. url('img/'. $data->profil()) .']]></g:image_link>
                    <g:brand><![CDATA['. $data->marka_durum() .']]></g:brand>';

                if ($data->indirim > 0)
                {
                    echo 
                    
                    '<g:sale_price>'. $data->indirim .'</g:sale_price>';
                }

                if ($data->model_kod)
                {
                    echo 
                    
                    '<g:item_group_id><![CDATA['. $data->model_kod .']]></g:item_group_id>';
                }

                $fotolar = $data->fotolar();

                if ($fotolar)
                {
                    echo 
                    
                    '<g:additional_image_link><![CDATA['. $fotolar .']]></g:additional_image_link>';
                }

                if ($data->kat_id_google)
                {
                    echo 
                    
                    '<g:google_product_category>'. $data->kat_id_google .'</g:google_product_category>';
                }

                else
                {
                    echo 
                    
                    '<g:google_product_category>2847</g:google_product_category>';
                }

                if ($data->kat_id && isset($kategoriler[$data->kat_id]))
                {
                    echo 
                    
                    '<g:product_type><![CDATA['. $kategoriler[$data->kat_id] .']]></g:product_type>';
                }

                else
                {
                    echo 
                    
                    '<g:product_type><![CDATA[Oyuncak]]></g:product_type>';   
                }

                echo

                '</item>';
            }

        endif;

        echo

            '</channel>
        </rss>';
    }
}
