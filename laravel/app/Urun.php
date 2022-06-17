<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    protected $table = 'urun';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function profil()
    {
        $data = $this->hasOne('\App\Foto', 'urun_id', 'id')->where('profil', 1)->first();

        return isset($data->deger) ? $data->deger : 'logo.png';
    }

    public function icerik()
    {
        $data = $this->aciklama ? $this->aciklama : $this->on_aciklama;

        return $data ? $data : 'Girilmemiş..';
    }

    public function stok_durum()
    {
        return $this->stok > 0 ? 'in stock' : 'out of stock';
    }

    public function fotolar()
    {
        if (!$this->set)
        {
            $datas = $this->hasMany('\App\Foto', 'urun_id', 'id')->where('profil', 0)->orderBy('sira', 'ASC')->get();
        }

        else
        {
            $datas = [];

            foreach (json_decode($this->set) as $this_id)
            
                $datas[] = $this->hasOne('\App\Foto', 'urun_id', 'id')->where('profil', 1);

            $datas = array_filter($datas);
        }

        if (count($datas) > 0)
        {
            $temp = [];

            foreach ($datas as $data)

                $temp[] = url('img/'. $data->deger);

            return implode(',', $temp);
        }

        else return null;
    }

    public function marka_durum()
    {
        return $this->marka ? $this->marka : 'Belirtilmemiş';
    }
}
