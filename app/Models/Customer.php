<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'identification', 'name', 'address', 'reference', 'latitude', 'longitude'
    ];
    protected $hidden = [
        
    ];
    public $dates = [
        'deleted_at'
    ];
}
