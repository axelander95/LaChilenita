<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CircleUser extends Model
{
    public $timestamps = false;
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
    public function circle() 
    {
        return $this->belongsTo('App\Models\Circle');
    }
    protected $fillable = [
        'circle_id', 'user_id'
    ];
    protected $hidden = [
        
    ];
}
