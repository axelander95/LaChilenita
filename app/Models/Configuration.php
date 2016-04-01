<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'installed'
    ];
    protected $hidden = [
        
    ];
    public function user() 
    {
        return $this->hasOne('App\Models\User');
    }
}
