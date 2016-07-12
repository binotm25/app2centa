<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institute';
    protected $fillable = [
        'name','type','country','state','city','fee_range'
    ];
}
