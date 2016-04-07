<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'role_id', 'name', 'email', 'username', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role() 
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function circles() 
    {
        return $this->hasMany('App\Models\Circle');
    }
    public function user_circles()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\CircleUser');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\UserVisit');
    }
}
