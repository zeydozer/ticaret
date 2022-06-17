<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sepet extends Model
{
    protected $table = 'sepet';
    public $timestamps = false;
    protected $guarded = ['id'];
}
