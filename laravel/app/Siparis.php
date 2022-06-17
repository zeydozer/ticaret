<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siparis extends Model
{
    protected $table = 'siparis';
    public $timestamps = false;
    protected $guarded = ['id'];
}
