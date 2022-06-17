<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adres extends Model
{
    protected $table = 'adres';
    public $timestamps = false;
    protected $guarded = ['id'];
}
