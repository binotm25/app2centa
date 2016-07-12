<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    protected $table = 'address';
    protected $fillable = [
        'registration_id','country','state','city','pin'
    ];

    public function registration()
    {
        return $this->belongsTo('App\Models\Registration');
    }
}
