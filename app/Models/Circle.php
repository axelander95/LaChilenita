<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Circle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'name', 'description'
    ];
    protected $hidden = [
        
    ];
    public $dates = [
        'deleted_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function users()
    {
        return $this->hasMany('App\Models\CircleUser');
    }
}
