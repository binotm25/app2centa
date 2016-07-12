<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registration';
    protected $fillable = [
        'user_id', 'session_id', 'title','f_name','l_name','dob','hel','degree','degree_others','prev_participate','heard_from',
        'ref_code','noa','category','supplemental','others'
    ];

    protected $dates = [
        'dob'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
