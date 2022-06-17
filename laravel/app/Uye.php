<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uye extends Model
{
    protected $table = 'uye';
    public $timestamps = false;
    protected $guarded = ['id'];
}
