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
        'arrival_time', 'route', 'detail', 'circle_id'
    ];
    protected $hidden = [
        
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function circle() 
    {
        return $this->belongsTo('App\Models\Circle');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function visit_status()
    {
        return $this->belongsTo('App\Models\VisitStatus');
    }
}
