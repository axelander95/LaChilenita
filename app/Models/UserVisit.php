<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserVisit extends Model
{
    use SoftDeletes;
    public $dates = [
        'deleted_at'
    ];
    protected $fillable = [
        'customer_id', 'user_id', 'visit_status_id', 'programmed_date', 'programmed_time', 'arrival_date',
        'arrival_time', 'route', 'detail'
    ];
    protected $hidden = [
        
    ];
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function customer()
    {
        return $this->hasOne('App\Models\Customer');
    }
    public function visit_status()
    {
        return $this->hasOne('App\Models\VisitStatus');
    }
}
