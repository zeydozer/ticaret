<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detay extends Model
{
    protected $table = 'siparis_d';
    public $timestamps = false;
    protected $guarded = ['id'];
}
